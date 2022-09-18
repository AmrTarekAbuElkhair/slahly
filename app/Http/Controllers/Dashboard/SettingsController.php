<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings=Setting::find(1);
        return view('pages.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings=Setting::findOrFail(1);
        $settings->logo=$request->logo;
        $settings->default_image=$request->default_image;
        $settings->phone=$request->phone;
        $settings->email=$request->email;
        $settings->address=$request->address;
        $settings->youtube=$request->youtube;
        $settings->whatsapp=$request->whatsapp;
        $settings->help_phone=$request->help_phone;
        $settings->management_phone=$request->management_phone;
        $settings->android_version_user=$request->android_version_user;
        $settings->android_version_provider=$request->android_version_provider;
        $settings->ios_version_user=$request->ios_version_user;
        $settings->ios_version_provider=$request->ios_version_provider;
        $settings->save();
        $data = [
            'en' => [
                'desc' => $request->input('en.desc'),
                'terms'=> $request->input('en.terms'),
                'about'=> $request->input('en.about'),
                'privacy_users'=> $request->input('en.privacy_users'),
                'privacy_providers'=> $request->input('en.privacy_providers'),
            ],
            'ar' => [
                'desc' => $request->input('ar.desc'),
                'terms'=> $request->input('ar.terms'),
                'about'=> $request->input('ar.about'),
                'privacy_users'=> $request->input('ar.privacy_users'),
                'privacy_providers'=> $request->input('ar.privacy_providers'),
            ],
        ];
        $settings->update($data);
        Toastr::success('تم تعديل بيانات التطبيق بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
