<?php

namespace App\Http\Controllers\Apis\Mobile\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\User\AuthRepositoryInterface;
use App\Http\Resources\UserResource;
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
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
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
            )
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $emialex = User::whereEmail($request->email)->whereNull('type_id')->get();
        $mobileex = User::whereMobile($request->mobile)->whereNull('type_id')->get();
        if (isset($emialex) && count($emialex) > 0) {
            return response()->json(res_msg($request->header('lang'), failed(), 401, 'email_exist'));
        }
        if (isset($mobileex) && count($mobileex) > 0) {
            return response()->json(res_msg($request->header('lang'), failed(), 401, 'phone_exist'));
        }
        $getcountrycode=substr($request->mobile, 0, 3);
	    $getphone = '2'.substr($request->mobile,3);
        $checkCode = Country::where('id', $request->country_id)->where('code', $getcountrycode)->first();
        if (!isset($checkCode)) {
            return response()->json(res_msg($request->header('lang'), failed(), 401, 'phone_number_not_belongs'));
        }
        $data = $request->all();
        $currentUserInfo = \Location::get(request()->ip());
        $data['city'] = $currentUserInfo->cityName;
        $user = User::create($data);
        //$this->authObject->sendVerificationCode($user);
        //$code = Verification::where('user_id', $user->id)->first();
         $verification_Ob = new Verification();
                $verification_Ob->user_id = $user->id;
                $digits = 5;
                $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $verification_Ob->code = $code;
                $verification_Ob->save();
        _fireSMS($getphone,$code);
//        $provider_model = User::providerModel(null,$entity);
        return response(res($lang, success(), 200, 'done', ['code' => "$code"]));
    }

    public function verifyCode(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            ['code' => 'required']
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $flag = $this->authObject->verifyCode($request);
        if (isset($flag->id)) {
            return response(res($lang, success(), 200, 'activated', new UserResource($flag)));
        } elseif ($flag == 'invalid_code') {
            return response(res_msg($lang, failed(), 401, 'invalid_code'));
        } elseif ($flag == 'user_already_verified') {
            return response(res_msg($lang, failed(), 200, 'user_already_verified'));
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
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $user = User::where('mobile', $request->mobile)->first();
        if (isset($user)&&$user->type_id==null) {
            if($user->status==1){
            $getcountrycode=substr($request->mobile, 0, 3);
			$getphone = '2'.substr($request->mobile,3);
            $checkCode=Country::where('id',$user->country_id)->where('code',$getcountrycode)->first();
            if (!isset($checkCode)) {
                return response()->json(res_msg($lang, failed(), 401, 'phone_number_not_belongs'));
            }else{
                $usertoverify = $user;
                $usertoverify->verified_status = 0;
                $usertoverify->save();
                $verification_Ob = new Verification();
                $verification_Ob->user_id = $usertoverify->id;
                $digits = 5;
                $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $verification_Ob->code = $code;
                $verification_Ob->save();
                _fireSMS($getphone,$code);
                $user->update(['firebase_token'=>$request->firebase_token]);
                return response(res($lang, success(), 200, 'user_not_verified', ['code' => "$code"]));
            }
            }else{
              return response()->json(res_msg($lang, failed(), 401, 'company_not_activated'));
            }
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'user_not_found'));
        }
    }

    public function logout(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if (!isset($user)) {
            return response()->json(res_msg($lang, failed(), 401, 'user_not_verified'));
        } else {
            $user->update(['firebase_token' => null]);
            $request->user()->currentAccessToken()->delete();
            return response()->json(res_msg($lang, success(), 200, 'logout'));
        }
    }

    public function userProfile(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if(!isset($user)){
            return response()->json(res_msg($lang, failed(), 401, 'user_not_found'));
        }else{
        return response()->json(res($lang, success(), 200, 'user_profile', new UserResource($user)));
        }
    }

    public function updateUserProfile(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $data = $request->all();
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user) {
            // if(isset($request->mobile)){
            //     $getcountrycode=substr($request->mobile, 0, 3);
            $checkCode=Country::where('id',$user->country_id)->first();
            //     if (!isset($checkCode)) {
            //         return response()->json(res_msg($lang, failed(), 401, 'phone_number_not_belongs'));
            //     }
            // }
            $currentUserInfo = \Location::get(request()->ip());
            $data['city']=$currentUserInfo->cityName;
            $data['mobile']=$checkCode->code.$user->mobile;
            $user->update($data);
            return response()->json(res($lang, success(), 200, 'updated', new UserResource($user)));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'user_not_found'));
        }
    }
    public function updateUserFirebase(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user) {
            $validator = Validator::make($request->all(),
                array(
                    'firebase_token' => 'required',
                )
            );
            if ($validator->fails()) {
                return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
            }
            $user->update(['firebase_token' => $request->firebase_token]);

            return response()->json(res_msg($lang, success(), 200, 'updated'));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'user_not_found'));
        }
    }

}
