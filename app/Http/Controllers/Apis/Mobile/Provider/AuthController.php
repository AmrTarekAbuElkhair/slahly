<?php

namespace App\Http\Controllers\Apis\Mobile\Provider;

use App\Events\SendLocation;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\Provider\AuthRepositoryInterface;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\UserResource;
use App\Models\Notification;
use App\Models\NotificationContent;
use App\Models\Order;
use App\Models\PushNotification;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use Stevebauman\Location\Location;
use Lang;

class AuthController extends Controller
{
    protected $authObject;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authObject = $authRepository;
    }

        public function signUp(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            array(
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'address' => 'required',
                'firebase_token' => 'required',
                'country_id' => 'required|exists:countries,id',
                'type_id'=>'required|exists:types,id',
                'bio'=> 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $emialex = User::whereEmail($request->email)->where('type_id','!=',null)->get();
        $mobileex = User::whereMobile($request->mobile)->where('type_id','!=',null)->get();
        if (isset($emialex) && count($emialex) > 0) {
            return response()->json(res_msg($request->header('lang'), failed(), 401, 'email_exist'));
        }
        if (isset($mobileex) && count($mobileex) > 0) {
            return response()->json(res_msg($request->header('lang'), failed(), 401, 'phone_exist'));
        }
       $getcountrycode=substr($request->mobile, 0, 3);
			$getphone = '2'.substr($request->mobile,3);
        $checkCode=Country::where('id',$request->country_id)->where('code',$getcountrycode)->first();
        if (!isset($checkCode)) {
            return response()->json(res_msg($request->header('lang'), failed(), 401, 'phone_number_not_belongs'));
        }
        $data = $request->all();
        $data['available'] = "1";
        $currentUserInfo = \Location::get(request()->ip());
        $data['city'] = $currentUserInfo->cityName;
        if ($request->type_id==1) {
            $validator = Validator::make($request->all(),
                array(
                'service_id' => 'required|exists:services,id',
                )
            );
            if ($validator->fails()) {
                return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
            }
                $data['service_id'] = $request->service_id;
        }
        $provider = User::create($data);
        if ($request->type_id==2){
            $services=Service::pluck('id');
            foreach ($services as $service){
            CompanyService::create([
                'service_id'=>$service,
                'company_id'=>$provider->id
            ]);
            }
        }
        $this->authObject->sendVerificationCode($provider);
        $code=Verification::where('user_id',$provider->id)->first();
        _fireSMS($getphone,$code->code);
		//        $provider_model = User::providerModel(null,$entity);
        return response(res($lang, success(), 200,'done', ['code' => "$code->code"]));
    }


    public function verifyCode(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            ['code' => 'required']
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $flag = $this->authObject->verifyCode($request);
        if (isset($flag->id)) {
            return response(res($lang, success(), 200, 'activated',new ProviderResource($flag)));
        } elseif ($flag == 'invalid_code') {
            return response(res_msg($lang, failed(), 401, 'invalid_code'));
        } elseif ($flag == 'provider_already_verified') {
            return response(res_msg($lang, failed(), 200, 'provider_already_verified'));
        }
    }

    public function login(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            [
                'mobile' => 'required',
                'firebase_token' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $provider = User::whereIn('type_id',['1','2'])->where('mobile',$request->mobile)->first();
        if (isset($provider)) {
            if($provider->status==1){
            $getcountrycode=substr($request->mobile, 0, 3);
			$getphone = '2'.substr($request->mobile,3);
			$checkCode=Country::where('id',$provider->country_id)->where('code',$getcountrycode)->first();
            if (!isset($checkCode)) {
                return response()->json(res_msg($lang, failed(), 401, 'phone_number_not_belongs'));
            }else{
            $entitytoverify = $provider;
            $entitytoverify->verified_status = 0;
            $entitytoverify->save();
            $verification_Ob = new Verification();
            $verification_Ob->user_id = $entitytoverify->id;
            $digits = 5;
            $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            $verification_Ob->code = $code;
            $verification_Ob->save();
           _fireSMS($getphone,$code);
           $provider->update(['firebase_token'=>$request->firebase_token]);
            return response(res($lang, success(), 200,'provider_not_verified', ['code' => "$code"]));
            }
            }else{
             return response()->json(res_msg($lang, failed(), 401, 'company_not_activated'));
            }
            }else{
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
    }



    public function logout(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if(!isset($user)){
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_verified'));
        }else{
            $user->update(['firebase_token' => null]);
            $request->user()->currentAccessToken()->delete();
            return response()->json(res_msg($lang, success(), 200, 'logout'));
        }
    }

    public function providerProfile(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if(!isset($provider)){
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_verified'));
        }else{
        return response()->json(res($lang, success(), 200, 'provider_profile', new ProviderResource($provider)));
        }
    }

    public function updateProviderProfile(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $data = $request->all();
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if ($provider) {
// 			if(isset($request->mobile)){
//             $getcountrycode=substr($request->mobile, 0, 3);
            $checkCode=Country::where('id',$provider->country_id)->first();
//             if (!isset($checkCode)) {
//                 return response()->json(res_msg($lang, failed(), 401, 'phone_number_not_belongs'));
//             }
// 			}
            $currentUserInfo = \Location::get(request()->ip());
            $data['city']=$currentUserInfo->cityName;
            $data['mobile']=$checkCode->code.$provider->mobile;
            $provider->update($data);
            return response()->json(res($lang, success(), 200, 'updated', new ProviderResource($provider)));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
    }
    public function updateProviderFirebase(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if ($provider) {
            $validator = Validator::make($request->all(),
                array(
                    'firebase_token' => 'required',
                )
            );
            if ($validator->fails()) {
                return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
            }
            $provider->update(['firebase_token'=>$request->firebase_token]);

            return response()->json(res_msg($lang, success(), 200, 'updated'));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
    }

    public function onlineOffline(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if ($provider) {
            $validator = Validator::make($request->all(),
                array(
                    'available' => 'required',
                )
            );
            if ($validator->fails()) {
                return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
            }
            $order=Order::whereIn('status',[1,2,3,4,5])->where('provider_id',$provider->id)->first();
            if(!$order){
            $provider->update(['available'=>$request->available]);
            return response()->json(res($lang, success(), 200, 'available',['available' => $provider->available]));
            }else{
              return response()->json(res_msg($lang, failed(), 401, 'not_available'));
            }
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
    }

    public function sendLocation(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!$provider) {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }else{
            $order=Order::where('id',$request->order_id)->first();
            $order->update(['status'=>1]);
            $token=User::where('id',$order->user_id)->first()->firebase_token;
            $notify=Notification::where('type',3)->where('redirect',0)->first();
            $content=NotificationContent::where('order_id',$order->id)->where('user_id',$order->user_id)->first();
			$content->notification_id="3";
			$content->save();
           // PushNotification::send_details($token,$order->status,$order->id,$notify->getTranslation($lang)->title,$notify->getTranslation($lang)->desc,3);
            pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,3);
			return response()->json(res_msg($lang, success(), 200, 'done'));

        }
    }

        public function updateLocation(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if ($provider) {
            $validator = Validator::make($request->all(),
                array(
                    'lat' => 'required',
                    'lng' => 'required',
                )
            );
            if ($validator->fails()) {
                return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
            }
            $provider->update(['lat'=>$request->lat,'lng'=>$request->lng]);

            return response()->json(res_msg($lang, success(), 200, 'updated'));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
    }
}
