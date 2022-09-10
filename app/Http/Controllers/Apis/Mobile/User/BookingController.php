<?php

namespace App\Http\Controllers\Apis\Mobile\User;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Notification;
use App\Models\NotificationContent;
use App\Models\Order;
use App\Models\PushNotification;
use App\Models\QrCode;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Interfaces\Mobile\User\AuthRepositoryInterface;
use App\Http\Interfaces\Mobile\User\BookingRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    protected $userObject;

    public function __construct(BookingRepositoryInterface $userObject)
    {
        $this->userObject = $userObject;
    }

    public function getHome(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->userObject->getHome($lang,$user);
        return response(res($lang, success(),200,'home', $result));
    }

    public function getAllProvidersService($service_id,Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->userObject->getAllProvidersService($service_id,$request,$user);
        return response(res($lang, success(), 200, 'all_providers', $result));
    }

    public function providerData($provider_id,Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $provider = User::where('id',$provider_id)->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
        }else{
        $result = $this->userObject->providerData($provider,$user,$lang);
        return response(res($lang, success(), 200, 'provider_data', $result));
        }
    }

    public function getFavoriteList(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->userObject->getFavoriteList($user->id);
        return response()->json(res($lang, success(), 200, 'all_fave', $result));
    }

    public function addFavorite(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'worker_id' => 'required|exists:users,id',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $fav = Favorite::where('worker_id', $request->worker_id)->where('user_id', $user->id)->first();
        if (isset($fav)) {
            return response()->json(res_msg($lang, failed(), 401, 'already_fav'));
        } else {
            $worker_id = $request->worker_id;
            $this->userObject->addFavorite($user->id,$worker_id);
            return response()->json(res_msg($lang, success(), 200, 'fave_done'));
        }
    }

    public function deleteFav(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'fav_id' => 'required|exists:favorites,id',
                'worker_id' => 'required|exists:users,id',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $fav = Favorite::where('id',$request->fav_id)
            ->where('worker_id', $request->worker_id)
            ->where('user_id', $user->id)->first();
        if (!isset($fav)) {
            return response()->json(res_msg($lang, failed(), 401, 'fav_not_found'));
        } else {
            $fav_id = $request->fav_id;
            $this->userObject->deleteFav($user->id,$fav_id);
            return response()->json(res_msg($lang, success(), 200, 'fave_deleted'));
        }
    }

    public function createOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                //'provider_id' => 'required',
                //'service_id'=> 'required',
                'mobile'=> 'required',
                'payment' => 'required',
                'time' => 'required',
                'date' => 'required',
                'title' => 'required',
                'city' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'notes' => 'required',
                'apartment_no' => 'required',
                'floor_no' => 'required',
                'mark' => 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $request['user_id'] = $user->id;
        if($request->provider_id!=null){
        $request['provider_id'] = $request->provider_id;
        }
        $this->userObject->createOrder($request);
        return response()->json(res_msg($lang, success(), 200, 'order_sent'));
    }

    public function getOrderDetails($order_id,Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $order=Order::where('id',$order_id)->first();
        if(!isset($order)){
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }else{
            $result = $this->userObject->getOrderDetails($order_id,$lang);
            return response()->json(res($lang, success(), 200, 'oneorder', $result));
        }
    }


    public function getOrders(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->userObject->getOrders($user->id,$lang);
        return response()->json(res($lang, success(), 200, 'all_orders', $result));
    }

    public function rateOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required|exists:orders,id',
                'rate' => 'required',
                'comment' => 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $order=order::where('id',$request->order_id)->where('status','6')->first();
        if (isset($order)){
            $request['user_id'] = $user->id;
            $result=$this->userObject->rateOrder($request);
            return response()->json(res_msg($lang, success(), 200, 'done'));
        }else{
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }
    }

    public function cancelOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required|exists:orders,id',
                'status'=> 'required',
                'reason_id'=> 'required|exists:reasons,id',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
       $order=Order::whereIn('status',[0,1,2])->where('id',$request->order_id)->where('user_id',$user->id)->first();
        if (!isset($order)){
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }else{
            $request['user_id']=$user->id;
            $request['order_id']=$request->order_id;
            $request['reason_id']=$request->reason_id;
            $this->userObject->cancelOrder($request);
            return response(res_msg($lang, success(), 200, 'done'));
        }
    }

    public function checkQrCode(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            array(
                'code' => 'required',
                'order_id'=> 'required',
                'current_time'=>'required'
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $code=QrCode::where('code',$request->code)->first();
        if(isset($code)){
            $provider=User::where('id',$code->worker_id)->first();
            if (isset($provider)){
                $order=Order::where('id',$request->order_id)->where('provider_id',$provider->id)->first();
                if (isset($order)&&$order->status==2){
                    $order->update(['time'=>$request->current_time,'status'=>3]);
                    $token=User::where('id',$code->worker_id)->first()->firebase_token;
                    $n=Notification::where('type',8)->where('redirect',0)->first();
                    $notify=Notification::where('type',8)->where('redirect',1)->first();

                    // NotificationContent::where('order_id',$request->order_id)->where('worker_id',$provider->id)->
                    // orWhere('company_id',$provider->id)->update(['notification_id'=>15]);

                    $nc=NotificationContent::where('order_id',$order->id)->where('provider_id',$provider->id)->first();
                    $nc->update(['notification_id'=>15]);


                    NotificationContent::where('order_id',$order->id)->where('user_id',$order->user_id)->update(['notification_id'=>10]);


                    pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,3);


					return response()->json(res($lang, success(), 200, 'provider_found', ['help_phone' => Setting::where('id',1)->first()->help_phone,
                        'management_phone'=>Setting::where('id',1)->first()->management_phone
                        ]));
                }else{
                    return response()->json(res($lang, failed(), 401, 'order_not_found', ['help_phone' => Setting::where('id',1)->first()->help_phone,
                        'management_phone'=>Setting::where('id',1)->first()->management_phone
                    ]));
                }
            }else{
                return response()->json(res($lang, failed(), 401, 'provider_not_found',['help_phone' => Setting::where('id',1)->first()->help_phone,
                    'management_phone'=>Setting::where('id',1)->first()->management_phone
                ]));
            }
        }else{
            return response()->json(res($lang, failed(), 401, 'invalid_code',['help_phone' => Setting::where('id',1)->first()->help_phone,
                'management_phone'=>Setting::where('id',1)->first()->management_phone
            ]));
        }
    }
    public function getWallet(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->userObject->getWallet($user,$lang);
        return response()->json(res($lang, success(), 200, 'wallet', $result));
    }

    public function withdraw(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id',$request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'price' => 'required',
                'account_number'=> 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $request['user_id']=$user->id;
        $this->userObject->withdraw($request);
        return response(res_msg($lang, success(), 200, 'done'));
    }

    public function finishOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required',
//                'finish_time' => 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $order = Order::where('id', $request->order_id)->where('user_id',$user->id)->where('status',3)->first();
        if (isset($order)) {
            $request['user_id'] = $user->id;
            $request['order_id'] = $order->id;
            $this->userObject->finishOrder($request,$lang);
            return response(res_msg($lang, success(), 200, 'done'));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }
    }

    public function summary($order_id,Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $order = Order::where('id', $order_id)->where('user_id',$user->id)->where('status',5)->first();
        if(isset($order)){
            $summary=$this->userObject->summary($order->id,$lang);
            return response(res($lang, success(), 200, 'summary',$summary));
    }else{
       return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
    }
    }

    public function checkout(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->whereNull('type_id')->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required',
                'paid_amount' => 'required',
				'type'=> 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
		if($request->type!="7"){
		return response()->json(res_msg($lang, failed(), 401, 'error'));
		}else{
        $order = Order::where('id', $request->order_id)->where('user_id',$user->id)->first();

        if (isset($order)) {
            $request['user_id'] = $user->id;
			$request['order_id'] = $order->id;
            $this->userObject->checkout($request);
            return response(res_msg($lang, success(), 200, 'done'));

        } else {
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }
		}
    }
}
