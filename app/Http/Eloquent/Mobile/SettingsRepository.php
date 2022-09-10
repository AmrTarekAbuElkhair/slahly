<?php
namespace App\Http\Eloquent\Mobile;
use App\Http\Interfaces\Mobile\SettingsRepositoryInterface;
use App\Models\Country;
use App\Models\Instruction;
use App\Models\Reason;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Social;
use App\Models\Type;
use App\Models\ContactUs;
use App\Models\NotificationContent;
use App\Models\Notification;
use App\Models\NotificationTranslation;
use App\Models\User;
use App\Models\Order;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Validator;

class SettingsRepository implements SettingsRepositoryInterface
{
    public function getAboutUs($lang){
        $settings = Setting::find(1);
        return  array('text' =>$settings->getTranslation($lang)->about);
    }

    public function getTerms($lang)
    {
        $settings = Setting::find(1);
            return array('text' =>$settings->getTranslation($lang)->terms);
    }


    public function getPrivacy($lang)
    {
        $settings = Setting::find(1);
            return array('text' =>$settings->getTranslation($lang)->privacy);
    }

    public function getSocialMedia()
    {
        $socials = Social::orderBy('id','desc')->get();
        $allsocials = array();
        $i = 0;
        foreach ($socials as $social) {
            $allsocials[$i] = array(
                'id'=>$social->id,
                'url' => $social->url,
                'logo'=> $social->logo,
                );
            $i++;
        }
        return $allsocials;
    }

    public function getReasons($lang)
    {
        $reasons = Reason::where('status','1')->orderBy('id','desc')->get();
        $allreasons = array();
        $i = 0;
        foreach ($reasons as $reason) {
            $allreasons[$i] = array(
                'id'=>$reason->id,
                'reason' => $reason->getTranslation($lang)->text);
            $i++;
        }
        return $allreasons;
    }

    public function getServices($lang)
    {
        $services = Service::where('status','1')->orderBy('id','desc')->get();
        $allservices = array();
        $i = 0;
        foreach ($services as $service) {
            $allservices[$i] = array(
                'id'=>$service->id,
                'service' => $service->getTranslation($lang)->name
            );
            $i++;
        }
        return $allservices;
    }

    public function getCountries($lang)
    {
        $countries = Country::where('status','1')->orderBy('id','desc')->get();
        $allcountries = array();
        $i = 0;
        foreach ($countries as $country) {
            $allcountries[$i] = array(
                'id'=>$country->id,
                'logo' => $country->logo,
                'code' => $country->code,
                'digits'=> $country->digits,
                'name' => $country->getTranslation($lang)->name
            );
            $i++;
        }
        return $allcountries;
    }

    public function getProviderTypes($lang)
    {
        $types = Type::where('status','1')->get();
        $alltypes = array();
        $i = 0;
        foreach ($types as $type) {
            $alltypes[$i] = array(
                'id'=>$type->id,
                'name' => $type->getTranslation($lang)->name
            );
            $i++;
        }
        return $alltypes;
    }

    public function insertContactForm($request)
    {
        ContactUs::create(array_merge($request->all(),[
            'user_id' => $request->user_id,
            'phone'=>$request->phone,
            'user_message'=>$request->message,
        ]));
        return 'true';
    }

    public function getAllNotifications($lang,$user)
    {
        $userData=User::where('id',$user)->first();
        $notifications = NotificationContent::where('user_id',$userData->id)
            ->orWhere('provider_id',$userData->id)
            ->orderBy('id','desc')->get();
        if ($userData->type_id==null){
            $allnotifications = array();
            $i = 0;
            foreach ($notifications as $notification) {
                $allnotifications[$i] = array(
                    'id'=>$notification->id,
                    'title' => NotificationTranslation::where('notification_id',$notification->notification_id)->where('locale',$lang)->first()->title,
                    'desc' =>  NotificationTranslation::where('notification_id',$notification->notification_id)->where('locale',$lang)->first()->desc,
                    'type' => $notification->notification->type,
                    'order_id'=>$notification->order_id,
                    'user_id'=>$userData->id,
                    'user_name'=>$userData->name,
                    'user_mobile'=>$userData->mobile,
                    'user_image'=>$userData->image,
                    'user_lat'=>$userData->lat,
                    'user_lng'=>$userData->lng,
                    'provider_id'=>isset($notification->order->provider->id)?$notification->order->provider->id:"",
                    'provider_name'=>isset($notification->order->provider->name)?$notification->order->provider->name:"",
                    'provider_mobile'=>isset($notification->order->provider->mobile)?$notification->order->provider->mobile:"",
                    'provider_lat'=>isset($notification->order->provider->lat)?$notification->order->provider->lat:"",
                    'provider_lng'=>isset($notification->order->provider->lng)?$notification->order->provider->lng:"",
                    'provider_image'=>isset($notification->order->provider->image)?$notification->order->provider->image:"",
                    'order_status'=>Order::where('id',$notification->order_id)->first()->status,
                    'is_rated' => Evaluation::where('order_id', $notification->order_id)->where('user_id',$userData->id)->first() != null ? true : false,
                    'created_at' => $notification->created_at,
                );
                $i++;
            }
            return $allnotifications;
        }else{
            $allnotifications = array();
            $i = 0;
            foreach ($notifications as $notification) {
                $allnotifications[$i] = array(
                    'id'=>$notification->id,
                    'title' => NotificationTranslation::where('notification_id',$notification->notification_id)->where('locale',$lang)->first()->title,
                    'desc' =>  NotificationTranslation::where('notification_id',$notification->notification_id)->where('locale',$lang)->first()->desc,
                    'type' => $notification->notification->type,
                    'order_id'=>$notification->order_id,
                    'user_id'=>$notification->order->user_id,
                    'user_name'=>$notification->order->user->name,
                    'user_mobile'=>$notification->order->user->mobile,
                    'user_image'=>$notification->user_id!=null?User::where('id',$notification->order->user_id)->first()->image:"",
                    'user_lat'=>$notification->order->user->lat,
                    'user_lng'=>$notification->order->user->lng,
                    'provider_id'=>$userData->id,
                    'provider_name'=>$userData->name,
                    'provider_mobile'=>$userData->mobile,
                    'provider_lat'=>$userData->lat,
                    'provider_lng'=>$userData->lng,
                    'provider_image'=>$userData->image,
                    'order_status'=>Order::where('id',$notification->order_id)->first()->status,
                    'is_rated' => Evaluation::where('order_id', $notification->order_id)->where('provider_id',$userData->id)->first() != null ? true : false,
                    'created_at' => $notification->created_at,
                );
                $i++;
            }
            return $allnotifications;
        }
    }
    public function getInstructions($lang)
    {
        $insts = Instruction::where('status','1')->orderBy('id','desc')->get();
        $allinstructions = array();
        $i = 0;
        foreach ($insts as $inst) {
            $allinstructions[$i] = array(
                'id'=>$inst->id,
                'text' => $inst->getTranslation($lang)->text
            );
            $i++;
        }
        return $allinstructions;
    }

    public function config($user){
        $availability = User::where('id',$user)->first()->availability;
        $count=NotificationContent::where('provider_id',$user)->orWhere('user_id',$user)->count();
            return array('availability' => $availability!=null?$availability:0,
            'notifications_count'=>$count
            );
    }
}
