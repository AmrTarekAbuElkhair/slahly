<?php
namespace App\Http\Eloquent\Mobile\User;

use App\Http\Interfaces\Mobile\User\BookingRepositoryInterface;
use App\Http\Resources\AdResource;
use App\Http\Resources\ServiceResource;
use App\Models\Ad;
use App\Models\CancellationReason;
use App\Models\Description;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Notification;
use App\Models\NotificationContent;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderPackageService;
use App\Models\ProviderOffer;
use App\Models\PushNotification;
use App\Models\ReasonTranslation;
use App\Models\Service;
use App\Models\ServiceTranslation;
use App\Models\TitleTranslation;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\WorkerPrice;
use App\Models\CountryTranslation;
use Illuminate\Support\Facades\Request;

class BookingRepository implements BookingRepositoryInterface
{
    protected $user_Ob;

    public function __construct(User $user)
    {
        $this->user_Ob = $user;
    }

    public function getHome($lang,$user)
    {
        $ads=Ad::whereDate('start_date', '<=',Carbon::now()->toDateString())
            ->whereDate('end_date', '>=',Carbon::now()->toDateString())->where('status','1')->inRandomOrder()->limit(3)->get();
        $services=Service::where('status','1')->get();
        $notificationsCount=NotificationContent::where('user_id',$user->id)->count();
        $data=[
            'ads'=>AdResource::collection($ads),
            'services'=>ServiceResource::collection($services),
            'notifications_count'=>$notificationsCount,
        ];
        return $data;
    }

    public function getAllProvidersService($service_id,$request,$user)
    {
        if ($request->offer_id==0){
        $providers = User::where('service_id',$service_id)->where('type_id',1)->
        where('verified_status','1')->where('status','1')->
        where('available','1')->
        // where('city',$user->city)->
        where('country_id',$user->country_id)->
        selectRaw("( FLOOR(6371 * ACOS( COS( RADIANS( $user->lat) ) * COS( RADIANS( lat ) ) *
        COS( RADIANS( lng ) - RADIANS($user->lng) ) + SIN( RADIANS($user->lat) ) * SIN( RADIANS( lat ) ) )) )
        distance,users.id,users.name,users.image,users.bio,users.rate")
            ->havingRaw("distance <= 50000")
            ->get();
        return $providers;
        }else{
            $workers=ProviderOffer::where('offer_id',$request->offer_id)->pluck('worker_id');
            $providers = User::whereIn('id',$workers)->where('service_id',$service_id)->where('type_id',1)->
            where('verified_status','1')->where('status','1')->
            where('available','1')->
            // where('city',$user->city)->
            where('country_id',$user->country_id)->
            selectRaw("( FLOOR(6371 * ACOS( COS( RADIANS( $user->lat) ) * COS( RADIANS( lat ) ) *
        COS( RADIANS( lng ) - RADIANS($user->lng) ) + SIN( RADIANS($user->lat) ) * SIN( RADIANS( lat ) ) )) )
        distance,users.id,users.name,users.image,users.bio,users.rate")
                ->havingRaw("distance <= 50000")
                ->get();
            return $providers;
        }
    }

    public function providerData($provider,$user,$lang)
    {
        $unit='K';
        $theta = $user->lng - $provider->lng;
        $dist = sin(deg2rad($user->lat)) * sin(deg2rad($provider->lat)) +  cos(deg2rad($user->lat)) * cos(deg2rad($provider->lat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K")
        {
            $distance=($miles * 1.609344);
        }
        else if ($unit == "N")
        {
            $distance=($miles * 0.8684);
        }
        else
        {
            $distance=$miles;
        }
        $provider=User::where('id',$provider->id)->first();
        $evaluations=round(Evaluation::where('provider_id',$provider->id)->avg('user_rate'),2);
        $data['provider_main_data'] = array(
            'id' => $provider->id,
            'name' => $provider->name,
            'image' => $provider->image,
            'bio'=> $provider->bio,
            'join_date'=> date('Y', strtotime($provider->created_at)),
            'distance'=>floor($distance),
            'provider_type'=>$provider->type_id,
            'rate' => isset($evaluations)?$evaluations:0,
            'price_hour' => WorkerPrice::where('worker_id',$provider->id)->first()->price,
            'jobs' => Order::where('provider_id',$provider->id)->where('status','4')->count(),
            'service_id'=>$provider->service_id,
            'service_name'=>ServiceTranslation::where('service_id',$provider->service_id)->where('locale',$lang)->first()->name,
            'is_fav'=>Favorite::where('worker_id',$provider->id)->where('user_id',$user->id)->first()!=null?1:0,
            'fav_id'=>Favorite::where('worker_id',$provider->id)->where('user_id',$user->id)->first()!=null?
                Favorite::where('worker_id',$provider->id)->where('user_id',$user->id)->first()->id:0,
        );
        $works=Work::where('worker_id',$provider->id)->orderBy('id','desc')->get();
        $allworks = array();
        $i = 0;
        foreach ($works as $work) {
            $allworks[$i]['id'] = $work->id;
            $allworks[$i]['image'] = $work->image;
            $i++;
        }
        $data['all_works']=$allworks;

        $reviews=Evaluation::where('provider_id',$provider->id)->where('user_id','!=',null)->orderBy('id','desc')->get();
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
        $data['reviews']=$allreviews;

        return $data;
    }

    public function getFavoriteList($user_id){
        $user=User::where('id',$user_id)->first();
        $getfavs=Favorite::where('user_id',$user->id)->orderBy('id','desc')->get();
        $res_item = [];
        $res_list  = [];
        foreach ($getfavs as $fav) {
            $res_item['id'] = $fav->id;
            $providers=User::where('id',$fav->worker_id)->get();
            foreach ($providers as $provider) {
                $res_item['provider_id'] = $provider->id;
                $res_item['provider_name'] = $provider->name;
                $res_item['provider_image'] = $provider->image;
                $res_item['provider_bio'] = $provider->bio;
                $res_item['provider_rate'] = $provider->rate;
            }
            $res_list[] = $res_item;
        }
        return $res_list;
    }

    public function addFavorite($user_id,$worker_id){
        Favorite::create(
            array(
                'user_id'=>$user_id,
                'worker_id'=>$worker_id
            )
        );
        return "true";

    }

    public function deleteFav($user,$fav_id)
    {
        Favorite::where('user_id',$user)->where('id',$fav_id)->delete();
    }
    public function CreateOrder($request){
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $digits = 5;
        $code=rand(pow(10, $digits-1), pow(10, $digits)-1);
        if($request->provider_id!=null){
            $provider=User::where('id',$request->provider_id)->first();
            if(isset($provider)){
                if($provider->type_id=='1'){
                    $order=Order::create(
                        array(
                            'user_id'=>$request->user_id,
                            'provider_id' => $provider->id,
                            'mobile'=> $request->mobile,
                            'service_id' => $provider->service_id,
                            'payment'=>$request->payment,
                            'order_number'=>$code,
                            'time'=>$request->time,
                            'date' => $request->date,
                            'title'=>$request->title,
                            'city'=>$request->city,
                            'lat' => $request->lat,
                            'lng' => $request->lng,
                            'notes'=>$request->notes,
                            'apartment_no'=>$request->apartment_no,
                            'floor_no'=>$request->floor_no,
                            'mark'=>$request->mark,
                            'offer_id'=>$request->offer_id!=0?$request->offer_id:null,
                            'package_id'=>$request->package_id!=0?$request->package_id:null,

                        )
                    );
                }
                else{
                    $order=Order::create(
                        array(
                            'user_id'=>$request->user_id,
                            'provider_id' =>$provider->id,
                            'mobile'=> $request->mobile,
                            'service_id' => $provider->service_id,
                            'payment'=>$request->payment,
                            'order_number'=>$code,
                            'time'=>$request->time,
                            'date' => $request->date,
                            'title'=>$request->title,
                            'city'=>$request->city,
                            'lat' => $request->lat,
                            'lng' => $request->lng,
                            'notes'=>$request->notes,
                            'apartment_no'=>$request->apartment_no,
                            'floor_no'=>$request->floor_no,
                            'mark'=>$request->mark,
                            'offer_id'=>$request->offer_id!=0?$request->offer_id:null,
                            'package_id'=>$request->package_id!=0?$request->package_id:null,
                        )
                    );
                    if ($request->package_id!=null){
                        $packageServices=Description::where('package_id',$request->package_id)->pluck('service_id');
                        for ($i=0;$i<sizeof($packageServices);$i++){
                            OrderPackageService::create([
                                'package_id'=>$request->package_id,
                                'service_id'=>$packageServices[$i],
                                'order_id'=>$order->id
                            ]);
                        }
                        Order::where('id',$order->id)->update(['status'=>'0']);
                    }
                }
                $token=User::where('id',$provider->id)->first()->firebase_token;
                $notify=Notification::where('type',0)->where('redirect',0)->first();
                NotificationContent::create([
                    'notification_id'=>12,'order_id'=>$order->id,
                    'provider_id'=>$request->provider_id,
                ]);
                pushnotification($token,$notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,0);
            }
        }else{
            $order=Order::create(
                array(
                    'user_id'=>$request->user_id,
                    'mobile'=> $request->mobile,
                    'service_id' => $request->service_id,
                    'payment'=>$request->payment,
                    'order_number'=>$code,
                    'time'=>$request->time,
                    'date' => $request->date,
                    'title'=>$request->title,
                    'city'=>$request->city,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'notes'=>$request->notes,
                    'apartment_no'=>$request->apartment_no,
                    'floor_no'=>$request->floor_no,
                    'mark'=>$request->mark,
                    'offer_id'=>$request->offer_id!=0?$request->offer_id:null,
                    'package_id'=>$request->package_id!=0?$request->package_id:null,
                )
            );
        }
    }
    public function getOrderDetails($order_id,$lang){
        $order= Order::where('id',$order_id)->first();
        $cancellation=CancellationReason::where('order_id',$order->id)->first();
        $data['main_data']= array(
            'order_id'=>$order->id,
            'service_id'       => $order ->service_id,
            'service_name'     => ServiceTranslation::where('service_id',$order->service_id)->where('locale',$lang)->first()->name,
            'service_desc'     => ServiceTranslation::where('service_id',$order->service_id)->where('locale',$lang)->first()->desc,
            'service_icon' =>Service::where('id',$order->service_id)->first()->icon,
            'order_number'=>$order->order_number,
            'order_price'=>$order->price,
            'order_status'=>$order->status,
            'user_address'=>$order->title.",".$order->city.",".CountryTranslation::where('country_id',$order->user->country_id)->where('locale',$lang)->first()->name,
            'user_lat' =>$order->lat,
            'user_lng' =>$order->lng,
            'date'=>$order->date!= null ? $order->date : "",
            'time'=>$order->time!= null ? $order->time : "",
            'payment'=>$order->payment,
            'is_rated'=>Evaluation::where('order_id', $order->id)->first() != null ? true : false,
            'is_refused' => CancellationReason::where('order_id', $order->id)->first() != null ? true : false,
            'reason' => isset($cancellation)?ReasonTranslation::where('reason_id',$cancellation->reason_id)->where('locale',$lang)->first()->text:"",
        );
        $package=OrderPackageService::where('order_id',$order_id)->get();
        $data['package']= isset($package) ? $package: [];
        return $data;
    }

    public function getOrders($user,$lang)
    {
        $finishedOrders=Order::where('user_id',$user)->where('status',6)->where('provider_id','!=',null)->orderBy('id','desc')->get();
        $allfinishedOrders = array();
        $i = 0;
        foreach ($finishedOrders as $f) {
            $allfinishedOrders[$i] = array(
                'order_id'=>$f->id,
                'service_id'       => $f ->service_id,
                'service_name'     => ServiceTranslation::where('service_id',$f->service_id)->where('locale',$lang)->first()->name,
                'service_icon' =>Service::where('id',$f->service_id)->first()->icon,
                'order_number'=>$f->order_number,
                'date'=>$f->date!= null ? $f->date : "",
                'order_price'=>$f->price,
                'order_status'=>$f->status,
                'is_rated'=>Evaluation::where('order_id', $f->id)->first() != null ? true : false ,
            );
            $i++;
        }
        $data['finished']=$allfinishedOrders;

        $recentlyOrders=Order::where('user_id',$user)->where('provider_id','!=',null)->orderBy('id','desc')->get();
        $allrecentlyOrders = array();
        $i = 0;
        foreach ($recentlyOrders as $r) {
            $allrecentlyOrders[$i] = array(
                'order_id'=>$r->id,
                'service_id'       => $r ->service_id,
                'service_name'     => ServiceTranslation::where('service_id',$r->service_id)->where('locale',$lang)->first()->name,
                'service_icon' =>Service::where('id',$r->service_id)->first()->icon,
                'order_number'=>$r->order_number,
                'date'=>$r->date!= null ? $r->date : "",
                'order_price'=>$r->price,
                'order_status'=>$r->status,
                'is_rated'=>Evaluation::where('order_id', $r->id)->first() != null ? true : false,
            );
            $i++;
        }
        $data['maintenance']=$allrecentlyOrders;

        return $data;
    }

    public function rateOrder($request){
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $rate=Evaluation::where('order_id',$request->order_id)->first();
        $order=Order::where('id',$request->order_id)->first();
        if($order->worker_id!=null){
            if(!isset($rate)){
                Evaluation::create([
                    'user_id'=>$request->user_id,
                    'order_id'=>$request->order_id,
                    'user_rate'=>$request->rate,
                    'user_comment'=>$request->comment
                ]);
            }else{
                $rate->update([
                    'user_id'=>$request->user_id,
                    'order_id'=>$request->order_id,
                    'user_rate'=>$request->rate,
                    'user_comment'=>$request->comment
                ]);
            }
            $provider=Order::where('id',$request->order_id)->pluck('provider_id');
            $evaluations=round(Evaluation::where('provider_id',$provider)->avg('user_rate'),2);
            User::where('id',$provider)->update(['rate'=>$evaluations]);
        }else{
            if(!isset($rate)){
                Evaluation::create([
                    'user_id'=>$request->user_id,
                    'order_id'=>$request->order_id,
                    'user_rate'=>$request->rate,
                    'user_comment'=>$request->comment
                ]);
            }else{
                $rate->update([
                    'user_id'=>$request->user_id,
                    'order_id'=>$request->order_id,
                    'user_rate'=>$request->rate,
                    'user_comment'=>$request->comment
                ]);

            }
            $provider=Order::where('id',$request->order_id)->pluck('provider_id');
            $evaluations=round(Evaluation::where('provider_id',$provider)->avg('user_rate'),2);
            User::where('id',$provider->id)->update(['rate'=>$evaluations]);
        }

    }

    public function cancelOrder($request){
         $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $order=Order::where('id',$request->order_id)->first();

                $order->update(
                    [
                        'status' => -1,
                    ]
                );

            CancellationReason::create([
                'order_id'=>$order->id,
                'provider_id'=>$order->provider_id,
                'reason_id'=>$request->reason_id,
                'user_type'=>'user',
                'user_id'=>$request->user_id,
            ]);
        $content=NotificationContent::where('order_id',$order->id)->where('provider_id',$order->provider_id)->first();
        $content->delete();
        NotificationContent::create([
            'notification_id'=>2,'order_id'=>$order->id,
            'provider_id'=>$order->provider_id]);

	    	$notify=Notification::where('type',2)->where('redirect',0)->first();
            $token=User::where('id',$order->provider_id)->first()->firebase_token;
            pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,-1);
            $getcontent=NotificationContent::where('order_id',$order->id)->where('user_id',$order->user_id)->first();
            if(isset($getcontent)){
                $getcontent->update(["notification_id"=>2]);
            }else{
            NotificationContent::create(['notification_id'=>2,'order_id'=>$order->id,'user_id'=>$order->user_id,]);
            }
            User::where('id',$order->provider_id)->update(['available'=>1]);
    }

    public function getWallet($user,$lang)
    {
        $data['total_price']=Wallet::where('worker_id',$user->id)->
        where('status','1')->select('price')->sum('price');
        $firstops=Wallet::where("worker_id",$user->id)->where("type","0")->where("status","0")->orWhere("status","2")->orderBy('id','desc')->get();
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

        $secondops=Wallet::where('user_id',$user->id)->where('status','1')->where('type','1')->orderBy('id','desc')->get();
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
            'user_id'=>$request->user_id,
            'price'=>$request->price,
            'account_number'=>$request->account_number,
            'type'=>0,
            'status'=>0,
            'op_number'=>rand(pow(10, 9-1), pow(10, 9)-1),
            'title_id'=>1
        ]);
    }

    public function finishOrder($request,$lang)
    {
        $order=Order::where('user_id',$request->user_id)
            ->where('id',$request->order_id)->first();
        $order->update(['status'=>4]);
        $token=User::where('id',$order->provider_id)->first()->firebase_token;
        $notify=Notification::where('type',7)->where('redirect',1)->first();
        NotificationContent::where('order_id',$request->order_id)->where('provider_id',$order->provider_id)->update(['notification_id'=>14]);
        //NotificationContent::where('order_id',$request->order_id)->where('user_id',$request->user_id)->update(['notification_id'=>11]);
        // $content=NotificationContent::where('order_id',$order->id)->where('worker_id',$order->worker_id)->
        // orWhere('company_id',$order->company_id)->first();
        // $content->delete();
        // NotificationContent::create(['order_id'=>$order->id,'worker_id'=>$order->worker_id,'company_id'=>$order->company_id,'notification_id'=>7]);
        // $getcontent=NotificationContent::where('order_id',$request->order_id)->where('user_id',$request->user_id)->first();
        // $getcontent->delete();
        // NotificationContent::create(['order_id'=>$order->id,'user_id'=>$order->user_id,'notification_id'=>11]);
		pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,4);
    }

    public function summary($order_id, $lang)
    {
        $order=Order::where('id',$order_id)->first();
        return array(
            'provider_name' => User::where('id',$order->provider_id)->first()->name,
            'provider_id' => User::where('id',$order->provider_id)->first()->id,
            'start_time'=>$order->time,
            'finish_time'=>$order->finish_time,
            'working_hours'=>$order->working_hours,
            'provider_price'=>WorkerPrice::where('worker_id',$order->provider_id)->first()->price,
            'total_price'=>$order->price,
            'payment_type'=>$order->payment,
        );
    }

    public function checkout($request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $order = Order::where('id', $request->order_id)->where('user_id',$request->user_id)->first();
        $order->update(['status'=>6]);
		$token=User::where('id',$request->user_id)->first()->firebase_token;
        $providerFirebase=User::where('id',$order->provider_id)->first()->firebase_token;
        $notify=Notification::where('type',7)->where('redirect',0)->first();
        $n=Notification::where('type',7)->where('redirect',1)->first();

        NotificationContent::where('order_id',$request->order_id)->where('user_id',$request->user_id)->update(['notification_id'=>7]);

		  pushnotification($token , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,9);
          pushnotification($providerFirebase , $notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,6);
        $paid=$request->paid_amount;
        $totalPrice=$order->price;
        if($paid>$totalPrice){
            $amount=$paid-$totalPrice;
            Wallet::create([
                'user_id'=>$request->user_id,
                'title_id'=>2,
                'type'=>1,
                'status'=>1,
                'op_number'=>rand(pow(10, 9-1), pow(10, 9)-1),
                'price'=>$amount
            ]);
        }
        User::where('id',$order->provider_id)->update(['available'=>1]);
    }
}

