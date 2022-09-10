<?php

namespace App\Http\Controllers\Apis\Mobile\Provider;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\Provider\AuthRepositoryInterface;
use App\Http\Interfaces\Mobile\Provider\BookingRepositoryInterface;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class ProviderBookingController extends Controller
{
    protected $providerObject;

    public function __construct(BookingRepositoryInterface $providerObject)
    {
        $this->providerObject = $providerObject;
    }

    public function getHome(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }else{
        $result = $this->providerObject->getHome($lang,$provider->id);
        return response(res($lang, success(),200,'home', $result));
        }
    }

    public function getOrders(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }else{
        $result = $this->providerObject->getOrders($lang,$provider->id);
        return response(res($lang, success(),200,'all_orders', $result));
        }
    }

    public function getOrder($order_id,Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
        }else{
        $order=Order::where('id',$order_id)
            ->whereIn('status',['1','2','3','4','5','-1'])->first();
        if (isset($order)) {
            $result = $this->providerObject->getOrder($order_id,$provider,$lang);
            return response(res($lang, success(), 200, 'oneorder', $result));
        }else{
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }
        }
    }

    public function getReviews(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
        }else{
        $result = $this->providerObject->getReviews($provider);
        return response()->json(res($lang, success(), 200, 'all_reviews', $result));
        }
    }

    public function acceptOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required|exists:orders,id',
                'status'=> 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $order=Order::where('id',$request->order_id)->where('status','0')->first();
        if(!isset($order)){
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }else{
        $request['provider_id']=$provider->id;
        $this->providerObject->acceptOrder($request);
        return response(res_msg($lang, success(), 200, 'done'));
        }
    }

    public function rejectOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
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
        $order=Order::whereIn('status',[0,1,2])->where('id',$request->order_id)->where('provider_id',$provider->id)->first();
        if (!isset($order)){
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }else{
        $request['provider_id']=$provider->id;
        $request['order_id']=$request->order_id;
        $request['reason_id']=$request->reason_id;
        $this->providerObject->rejectOrder($request);
        return response(res_msg($lang, success(), 200, 'done'));
        }
    }

    public function rateOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
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
        $request['provider_id'] = $provider->id;
        $result=$this->providerObject->rateOrder($request);
        return response()->json(res_msg($lang, success(), 200, 'done'));
        }else{
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }
    }

    public function getWallet(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
        }else{
        $result = $this->providerObject->getWallet($provider,$lang);
        return response()->json(res($lang, success(), 200, 'wallet', $result));
        }
    }

    public function withdraw(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
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
            $request['worker_id']=$provider->id;
            $this->providerObject->withdraw($request);
            return response(res_msg($lang, success(), 200, 'done'));
    }

    public function arrived(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'provider_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required|exists:orders,id',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401 , 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $order=Order::where('id',$request->order_id)
            ->where('status','1')
            ->where('provider_id',$provider->id)
            ->first();
        if(!isset($order)){
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }else{
            $request['provider_id']=$provider->id;
            $this->providerObject->arrived($request,$lang);
            return response(res_msg($lang, success(), 200, 'done'));
        }
    }

    public function finishOrder(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id', $request->user()->id)->whereNotNull('type_id')->first();
        if (!isset($provider)) {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $validator = Validator::make($request->all(),
            array(
                'order_id' => 'required',
                'lat'=> 'required',
                'lng'=> 'required',
            )
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $order = Order::where('id', $request->order_id)->where('provider_id',$provider->id)->
        where('status',4)->first();

        if (isset($order)) {
            $request['provider_id'] = $provider->id;
            $request['order_id'] = $order->id;
            $request['lat'] = $request->lat;
            $request['lng'] = $request->lng;
            $this->providerObject->finishOrder($request,$lang);
            return response(res_msg($lang, success(), 200, 'done'));
        } else {
            return response()->json(res_msg($lang, failed(), 401, 'order_not_found'));
        }
    }
}
