<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\NotificationContent;
use App\Models\Provider;
use App\Models\User;
use App\Models\UserNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers=User::whereNotNull('type_id')->get();
        $users=User::whereNull('type_id')->get();
        return view('pages.notifications.create',compact('providers','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
        if ($request->type == "5") {
            if ($request->user_type == '0') {
                $data=$request->validated();
                $data['type']="5";
                $data['redirect']="0";
                $notify=Notification::create($data);
                NotificationContent::create([
                    'notification_id' => $notify->id,
                    'user_id' => $request->user_id,
                ]);
                $user = User::where('id', $request->user_id)->first();
                pushnotification($user->firebase_token, $notify->title, $notify->desc, 0, 5);
            } elseif ($request->user_type == '1') {
                $data=$request->validated();
                $data['type']="5";
                $data['redirect']="0";
                $notify=Notification::create($data);
                User::whereNull('type_id')->chunk(50, function ($users) use ($notify) {
                    foreach ($users as $user) {
                        NotificationContent::create([
                            'notification_id' => $notify->id,
                            'user_id' => $user->id,
                        ]);
//                        $notify = Notification::where('type', 5)->first();
                        pushnotification($user->firebase_token, $notify->title, $notify->desc, 0, 5);
                    }
                });
            } elseif ($request->user_type == '2') {
                $data=$request->validated();
                $data['type']="5";
                $data['redirect']="1";
                $notify=Notification::create($data);
                NotificationContent::create([
                    'notification_id' => $notify->id,
                    'provider_id' => $request->provider_id,
                ]);
                $provider = User::where('id', $request->provider_id)->first();
                pushnotification($provider->firebase_token, $notify->title, $notify->desc, 0, 5);
            } else {
                $data=$request->validated();
                $data['type']="5";
                $data['redirect']="1";
                $notify=Notification::create($data);
                User::whereNotNull('type_id')->chunk(50, function ($providers) use ($notify) {
                    foreach ($providers as $provider) {
                        NotificationContent::create([
                            'notification_id' => $notify->id,
                            'provider_id' => $provider->id,
                        ]);
                        //$notify = Notification::where('type', 5)->first();
                        pushnotification($provider->firebase_token, $notify->title, $notify->desc, 0, 5);
                    }
                });
            }
        }else{
            if ($request->user_type == '0') {
                $data=$request->validated();
                $data['type']="6";
                $data['redirect']="0";
                $notify=Notification::create($data);
                NotificationContent::create([
                    'notification_id' => $notify->id,
                    'user_id' => $request->user_id,
                ]);
                $user = User::where('id', $request->user_id)->first();
                //$notify = Notification::where('type', 6)->first();
                pushnotification($user->firebase_token, $notify->title, $notify->desc, 0, 6);
            } elseif ($request->user_type == '1') {
                $data=$request->validated();
                $data['type']="6";
                $data['redirect']="0";
                $notify=Notification::create($data);
                User::whereNull('type_id')->chunk(50, function ($users) use ($notify) {
                    foreach ($users as $user) {
                        NotificationContent::create([
                            'notification_id' => $notify->id,
                            'user_id' => $user->id,
                        ]);
                       // $notify = Notification::where('type', 6)->first();
                        pushnotification($user->firebase_token, $notify->title, $notify->desc, 0, 6);
                    }
                });
            } elseif ($request->user_type == '2') {
                $data=$request->validated();
                $data['type']="6";
                $data['redirect']="1";
                $notify=Notification::create($data);
                NotificationContent::create([
                    'notification_id' =>$notify->id,
                    'provider_id' => $request->provider_id,
                ]);
                $provider = User::where('id', $request->provider_id)->first();
                //$notify = Notification::where('type', 6)->first();
                pushnotification($provider->firebase_token, $notify->title, $notify->desc, 0, 6);
            } else {
                $data=$request->validated();
                $data['type']="6";
                $data['redirect']="1";
                $notify=Notification::create($data);
                User::whereNotNull('type_id')->chunk(50, function ($providers) use ($notify) {
                    foreach ($providers as $provider) {
                        NotificationContent::create([
                            'notification_id' =>$notify->id,
                            'provider_id' => $provider->id,
                        ]);
                        //$notify = Notification::where('type', 5)->first();
                        pushnotification($provider->firebase_token, $notify->title, $notify->desc, 0, 6);
                    }
                });
            }
        }
        Toastr::success('تم ارسال الاشعارات بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('notifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $notification= Notification::findOrFail($id);
//        $notification->delete();
//        Toastr::success('notifications deleted successfully!','Success',["positionClass" => "toast-top-right"]);
//        return redirect()->back();
    }

    public function dataTable()
    {
        $notifications = Notification::where('type',[5,6])->get();
        return DataTables::of($notifications)
            ->editColumn('title', function ($model) {
                if (isset($model->title)){
                    return strip_tags($model->title);
                }else{
                    return "title not found";
                }
            })
            ->rawColumns(['title'])
            ->make(true);
    }
}
