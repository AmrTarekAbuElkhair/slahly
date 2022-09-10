<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        return view('pages.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == "5") {
            User::whereNull('type_id')->chunk(50, function($users) use ($request) {
                foreach ($users as $user) {
                    NotificationContent::create([
                        'notification_id'=> 5,
                        'user_id'=> $user->id,
                    ]);
                    $notify=Notification::where('type',5)->first();
                    pushnotification($user->firebase_token , $notify->title, $notify->desc,0,5);
                }
            });
        }else{
            User::whereNull('type_id')->chunk(50, function($users) use ($request) {
                foreach ($users as $user) {
                    NotificationContent::create([
                        'notification_id'=> 6,
                        'user_id'=> $user->id,
                    ]);
                    $notify=Notification::where('type',6)->first();
                    pushnotification($user->firebase_token , $notify->title, $notify->desc,0,6);
                }
            });
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
        $notifications = NotificationContent::where('notification_id',[5,6])->get();
        return DataTables::of($notifications)
            ->editColumn('title', function ($model) {
                if (isset($model->notification->title)){
                    return $model->notification->title;
                }else{
                    return "title not found";
                }
            })
            ->rawColumns(['title'])
            ->make(true);
    }
}
