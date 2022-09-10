<?php
namespace App\Http\Eloquent\Mobile\Provider;

use App\Http\Interfaces\Mobile\Provider\BookingRepositoryInterface;
use App\Models\CancellationReason;
use App\Models\CountryTranslation;
use App\Models\Evaluation;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PushNotification;
use App\Models\Reason;
use App\Models\ReasonTranslation;
use App\Models\ServiceTranslation;
use App\Models\User;
use App\Models\NotificationContent;
use App\Models\Wallet;
use App\Models\TitleTranslation;
use App\Models\WorkerPrice;
use Carbon\Carbon;


class BookingRepository implements BookingRepositoryInterface
{
    protected $provider_Ob;

    public function __construct(User $provider)
    {
        $this->provider_Ob = $provider;
    }

    public function getHome($lang, $provider)
    {
        $user=User::where('id',$provider)->first();
        $evaluations=round(Evaluation::where('provider_id',$user->id)->avg('user_rate'),2);
        if (isset($user)) {
            $data['provider_main_data'] = array(
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->image,
                'rate' => isset($evaluations)?$evaluations:0,
                'jobs' => Order::where('provider_id',$user->id)->where('status','4')->count(),
                'notifications_count' => NotificationContent::where('provider_id',$user->id)->count(),
                'reviews'=>Evaluation::where('provider_id',$user->id)->where('user_comment','!=','null')->count(),
                //wallet will be 0 now till get wallet api
                'wallet_balance'=>0,
                'available'=>$user->available,
            );

            $orders=Order::where('status','0')->where('service_id',$user->service_id)->where('provider_id',$user->id)->orderBy('id','desc')->get();
            $allorders = array();
            $i = 0;
            foreach ($orders as $order) {
                $allorders[$i]['order_id'] = $order->id;
                $allorders[$i]['user_id'] = $order->user_id;
                $allorders[$i]['user_name'] =User::where('id',$order->user_id)->first()->name;
                $allorders[$i]['user_image'] =User::where('id',$order->user_id)->first()->image;
                $allorders[$i]['user_lat'] =doubleval($order->lat);
                $allorders[$i]['user_lng'] =doubleval($order->lng);
                $allorders[$i]['user_mobile'] =$order->mobile;
                $allorders[$i]['user_address'] =$order->title.",".$order->city.",".CountryTranslation::where('country_id',$order->user->country_id)->where('locale',$lang)->first()->name;
                $allorders[$i]['order_status'] =$order->status;
                $allorders[$i]['created_at'] =$order->created_at;
                $i++;
            }
            $data['latest_orders']=$allorders;

            return $data;
        }else{
            return array();
        }
    }

    public function getOrders($lang, $provider)
    {
        $user=User::where('id',$provider)->first();
        $latestOrders=Order::where('status','1')->where('service_id',$user->service_id)->where('provider_id',$user->id)->orderBy('id','desc')->get();
        $alllatestorders = array();
        $i = 0;
        foreach ($latestOrders as $lorder) {
            $alllatestorders[$i]['order_id'] = $lorder->id;
            $alllatestorders[$i]['user_id'] = $lorder->user_id;
            $alllatestorders[$i]['user_name'] =User::where('id',$lorder->user_id)->first()->name;
            $alllatestorders[$i]['user_image'] =User::where('id',$lorder->user_id)->first()->image;
            $alllatestorders[$i]['user_lat'] =doubleval($lorder->lat);
            $alllatestorders[$i]['user_lng'] =doubleval($lorder->lng);
            $alllatestorders[$i]['user_address'] =$lorder->title.",".$lorder->city.",".CountryTranslation::where('country_id',$lorder->user->country_id)->where('locale',$lang)->first()->name;
            $alllatestorders[$i]['order_status'] =$lorder->status;
            $alllatestorders[$i]['created_at'] =$lorder->created_at;
            $i++;
        }
        $data['recently_orders']=$alllatestorders;

        $previousOrders=Order::whereIn("status",[6,-1])->
        where('service_id',$user->service_id)->
        where('provider_id',$user->id)->orderBy('id','desc')->get();
        $allpreviousorders = array();
        $i = 0;
        foreach ($previousOrders as $porder) {
            $allpreviousorders[$i]['order_id'] = $porder->id;
            $allpreviousorders[$i]['user_id'] = $porder->user_id;
            $allpreviousorders[$i]['user_name'] =User::where('id',$porder->user_id)->first()->name;
            $allpreviousorders[$i]['user_image'] =User::where('id',$porder->user_id)->first()->image;
            $allpreviousorders[$i]['user_lat'] =$porder->lat;
            $allpreviousorders[$i]['user_lng'] =$porder->lng;
             $allpreviousorders[$i]['user_mobile'] =$porder->mobile;
            $allpreviousorders[$i]['user_address'] =$porder->title.",".$porder->city.",".CountryTranslation::where('country_id',$porder->user->country_id)->where('locale',$lang)->first()->name;
            $allpreviousorders[$i]['order_number'] =$porder->order_number;
            $allpreviousorders[$i]['order_price'] =$porder->price;
            $allpreviousorders[$i]['order_status'] =$porder->status;
            $allpreviousorders[$i]['is_rated'] = Evaluation::where('order_id', $porder->id)->where('provider_id',$user->id)->first() != null ? true : false;
            $allpreviousorders[$i]['created_at'] =$porder->created_at;
            $i++;
        }
        $data['previous_orders']=$allpreviousorders;
        return $data;
    }

    public function getOrder($order_id,$provider,$lang)
    {
         $order=Order::where('id',$order_id)->first();
         $cancellation=CancellationReason::where('order_id',$order->id)->first();
         $rate=Evaluation::where('order_id',$order->id)->first();
        return array(
            'order_id'=>$order->id,
            'user_id'=>$order->user_id,
            'user_name'=>User::where('id',$order->user_id)->first()->name,
            'user_image'=>User::where('id',$order->user_id)->first()->image,
            'user_mobile'=>substr(User::where('id',$order->user_id)->first()->mobile, 3,20),
            'user_lat' =>doubleval($order->lat),
            'user_lng' =>doubleval($order->lng),
            'user_address'=>$order->title.",".$order->city.",".CountryTranslation::where('country_id',$order->user->country_id)->where('locale',$lang)->first()->name,
            'order_number'=>$order->order_number,
            'order_price'=>$order->price,
            'order_status'=>$order->status,
            'is_rated'=>$rate != null ? true : false,
            'order_notes'=>$order->notes,
            'date'=>$order->date!= null ? $order->date : "",
            'time'=>$order->time!= null ? $order->time : "",
            'finish_time'=>$order->finish_time!= null ? $order->finish_time : "",
            'working_hours'=>intdiv($order->working_hours, 60).':'.
            ($order->working_hours % 60),
            'payment'=>$order->payment,
            'service_id'       => $order ->service_id,
            'service_name'     => ServiceTranslation::where('service_id',$order->service_id)->where('locale',$lang)->first()->name,
            'service_desc'     => ServiceTranslation::where('service_id',$order->service_id)->where('locale',$lang)->first()->desc,
            'is_refused' => CancellationReason::where('order_id', $order->id)->where('provider_id',$provider->id)->first() != null ? true : false,
            'reason' => isset($cancellation)?ReasonTranslation::where('reason_id',$cancellation->reason_id)->where('locale',$lang)->first()->text:"",
            'created_at'=>$order->created_at,
            );
    }

    public function getReviews($provider)
    {
        $reviews=Evaluation::where('worker_id',$provider->id)->orderBy('id','desc')->get();
        $allreviews = array();
        $i = 0;
        foreach ($reviews as $review) {
            $allreviews[$i] = array(
                'id'=>$review->id,
                'user_id'=>$review->user_id!= null ? $review->user_id : null,
                'user_name'=>$review->user_id!= null ?User::where('id',$review->user_id)->first()->name:null,
                'user_image'=>$review->user_id!= null ?User::where('id',$review->user_id)->first()->image:null,
                'user_rate'=>$review->user_id!= null ? number_format($review->user_rate,1):null,
                'user_comment'=>$review->user_id!= null ?$review->user_comment:null,
                'created_at'=>$review->created_at,
            );
            $i++;
        }
        return $allreviews;
    }

    public function acceptOrder($request){
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $order=Order::where('id',$request->order_id)->where('status','0')->first();
        if(isset($order)) {
            $order->update(
                [
                    'provider_id' => $request->worker_id,
                    'status' => $request->status,
                ]
            );
            } else{
            return 'false';
        }
        $token=User::where('id',$order->user_id)->first()->firebase_token;
        $notify=Notification::where('type',1)->where('redirect',0)->first();
            NotificationContent::create([
            'notification_id'=>1,'order_id'=>$order->id,
            'user_id'=>$order->user_id
        ]);
		//PushNotification::send_details($token,$order->status,$order->id,$notify->getTranslation($lang)->title,$notify->getTranslation($lang)->desc,1);
            pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,1);
            User::where('id',$request->worker_id)->update(['available'=>0]);
	}

    public function rejectOrder($request){
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $order=Order::where('id',$request->order_id)->first();
            $order->update(
                [
                    'provider_id' => $request->worker_id,
                    'status' => -1,
                ]
            );
            CancellationReason::create([
               'order_id'=>$order->id,
               'provider_id'=>$request->worker_id,
               'reason_id'=>$request->reason_id,
               'user_type'=>'worker',
               'user_id'=>$order->user_id,
            ]);
            $token=User::where('id',$order->user_id)->first()->firebase_token;
            $notify=Notification::where('type',2)->where('redirect',0)->first();
            $content=NotificationContent::where('order_id',$order->id)->where('user_id',$order->user_id)->first();
            if(isset($content)){
// 			$content->notification_id=2;
// 			$content->save();
             $content->delete();
             NotificationContent::create(["notification_id"=>2,'order_id'=>$order->id,'user_id'=>$order->user_id]);
            }else{
             NotificationContent::create(["notification_id"=>2,'order_id'=>$order->id,'user_id'=>$order->user_id]);
            }
            //PushNotification::send_details($token,$order->status,$order->id,$notify->getTranslation($lang)->title,$notify->getTranslation($lang)->desc,2);
		        pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,2);
                $find=NotificationContent::where('order_id',$order->id)->where('provider_id',$request->worker_id)->first();
                $find->delete();
                NotificationContent::create(["notification_id"=>2,'order_id'=>$order->id,'provider_id'=>$request->worker_id]);
                User::where('id',$request->worker_id)->update(['available'=>1]);

    }

    public function rateOrder($request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->worker_id)->first();
        $rate = Evaluation::where('order_id', $request->order_id)->first();
        if ($user->type_id == '1') {
            if (isset($rate)) {
               $rate->update([
                    'provider_id' => $request->worker_id,
                    'order_id' => $request->order_id,
                    'provider_rate' => $request->rate,
                    'provider_comment' => $request->comment
                ]);
            } else {
                Evaluation::create([
                    'provider_id' => $request->worker_id,
                    'order_id' => $request->order_id,
                    'provider_rate' => $request->rate,
                    'provider_comment' => $request->comment
                ]);
            }
        } else {
            if (isset($rate)) {
                $rate->update([
                    'company_id' => $request->worker_id,
                    'order_id' => $request->order_id,
                    'provider_rate' => $request->rate,
                    'provider_comment' => $request->comment
                ]);
            } else {
                Evaluation::create([
                    'provider_id' => $request->worker_id,
                    'order_id' => $request->order_id,
                    'provider_rate' => $request->rate,
                    'provider_comment' => $request->comment
                ]);
            }
        }

    }

    public function getWallet($provider,$lang)
    {
        $data['total_price']=Wallet::where('worker_id',$provider->id)->
        where('status','1')->select('price')->sum('price');
        $firstops=Wallet::where("worker_id",$provider->id)->where("type","0")->where("status","0")->orWhere("status","2")->orderBy('id','desc')->get();
        $fops = array();
        $i = 0;
        foreach ($firstops as $fop) {
            $fops[$i] = array(
                'id'=>$fop->id,
                'status'=>$fop->status,
                'price'=>$fop->price,
                'type'=>$fop->type,
                'title'=>TitleTranslation::where('title_id',$fop->title_id)->where('locale',$lang)->first()->title,
                'op_number'=>$fop->op_number,
                'created_at'=>$fop->created_at,
            );
            $i++;
        }
        $data['withdraw']=$fops;

        $secondops=Wallet::where('worker_id',$provider->id)->where('status','1')->where('type','1')->orderBy('id','desc')->get();
        $sops = array();
        $i = 0;
        foreach ($secondops as $sop) {
            $sops[$i] = array(
                'id'=>$sop->id,
                'status'=>$sop->status,
                'price'=>$sop->price,
                'type'=>$sop->type,
                'title'=>TitleTranslation::where('title_id',$sop->title_id)->where('locale',$lang)->first()->title,
                'op_number'=>$sop->op_number,
                'created_at'=>$sop->created_at,
            );
            $i++;
        }
        $data['charging']=$sops;

        return $data;
    }

    public function withdraw($request){
            Wallet::create([
                'worker_id'=>$request->worker_id,
                'price'=>$request->price,
                'account_number'=>$request->account_number,
                'type'=>0,
                'status'=>0,
                'op_number'=>rand(pow(10, 9-1), pow(10, 9)-1),
                'title_id'=>1
            ]);
    }

    public function arrived($request,$lang)
    {
        $order=Order::where('id',$request->order_id)->first();
        $order->update(['status'=>2]);
        $token=User::where('id',$order->user_id)->first()->firebase_token;
        $notify=Notification::where('type',4)->where('redirect',0)->first();
        $content=NotificationContent::where('order_id',$order->id)->where('user_id',$order->user_id)->first();
		$content->notification_id="4";
		$content->save();
        //PushNotification::send_details($token,$order->status,$order->id,$notify->getTranslation($lang)->title,$notify->getTranslation($lang)->desc,4);
          pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,4);

	}

    public function finishOrder($request,$lang)
    {
        $order=Order::where('id',$request->order_id)->where('provider_id',$request->provider_id)->first();
        $price=WorkerPrice::where('worker_id',$order->worker_id)->first();
        $dt = Carbon::now();
        $t=$dt->toTimeString();
        $t1 = Carbon::parse("$order->date $order->time");
        $t2 = Carbon::parse("$order->date $t");
        $diff = $t1->diff($t2)->i;
        if($diff==0){
          $order->update(['finish_time'=>$t,'working_hours'=>$diff,'price'=>$price->price,'status'=>5]);
        }else{
        $total=$diff*$price->price;
		if($total>0){
          $order->update(['finish_time'=>$t,'working_hours'=>$diff,'price'=>$total,'status'=>5]);
		}else{
	 $order->update(['finish_time'=>$t,'working_hours'=>$diff,'price'=>$total,'status'=>5]);
		}
        }
     $token=User::where('id',$order->user_id)->first()->firebase_token;
        $notify=Notification::where('type',9)->where('redirect',0)->first();
        NotificationContent::where('order_id',$request->order_id)->where('provider_id',$order->worker_id)->update(['notification_id'=>7]);
        NotificationContent::where('order_id',$request->order_id)->where('user_id',$order->user_id)->where('notification_id',10)->update(['notification_id'=>11]);
		pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,9);
        User::where('id',$request->provider_id)->update(['available'=>0,'lat'=>$request->lat,'lng'=>$request->lng]);
    }
}
