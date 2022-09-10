<?php

namespace App\Http\Controllers\Apis\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\SettingsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Setting;

class SettingsController extends Controller
{
    protected $settingObject;

    public function __construct(SettingsRepositoryInterface $settingRepository)
    {
        $this->settingObject = $settingRepository;
    }

    public function getAboutUs(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getAboutUs($lang);
        return response(res($lang, success(), 200, 'about_us', $result));
    }

    public function getTerms(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getTerms($lang);
        return response(res($lang, success(), 200, 'terms_cond', $result));
    }


    public function getPrivacy(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getPrivacy($lang);
        return response(res($lang, success(), 200, 'privacy_data', $result));
    }

    public function getSocialMedia(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getSocialMedia($lang);
        return response(res($lang, success(), 200, 'social_media', $result));
    }

    public function getReasons(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getReasons($lang);
        return response(res($lang, success(), 200, 'all_reasons', $result));
    }

    public function getServices(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getServices($lang);
        return response(res($lang, success(), 200, 'all_services', $result));
    }

    public function getCountries(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getCountries($lang);
        return response(res($lang, success(), 200, 'all_countries', $result));
    }

    public function getProviderTypes(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getProviderTypes($lang);
        return response(res($lang, success(), 200, 'all_providers_types', $result));
    }

    public function insertContactForm(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            [
                'phone' => 'required',
                'message' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $user = $request->user();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $request['user_id'] = $user->id;
        $request['user_message'] = $request->message;
        $this->settingObject->insertContactForm($request);
        return response()->json(res_msg($lang, success(), 200, 'suggestion_sent'));
    }

    public function getAllNotifications(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->settingObject->getAllNotifications($lang, $user->id);
        return response(res($lang, success(), 200, 'all_notifications', $result));
    }

    public function getInstructions(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->settingObject->getInstructions($lang);
        return response(res($lang, success(), 200, 'instructions', $result));
    }

    public function checkVersion(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $validator = Validator::make($request->all(),
            [
                'version' => 'required',
                'device' => 'required',
                'app_type' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code' => 401, 'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $versionSettings = Setting::find('1');
        if ($request->device == '0') {
            if ($request->app_type == '0') {
                if ($request->version != $versionSettings->android_version_user) {
                    return response()->json(res_msg($lang, failed(), 401, 'update_version'));
                } else {
                    return response()->json(res_msg($lang, success(), 200, 'same_version'));
                }
            } else {
                if ($request->version != $versionSettings->android_version_ios) {
                    return response()->json(res_msg($lang, failed(), 401, 'update_version'));
                } else {
                    return response()->json(res_msg($lang, success(), 200, 'same_version'));
                }
            }
        }
    }


    public function config(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $user = User::where('id', $request->user()->id)->first();
        if ($user == 'false') {
            return response()->json(res_msg($lang, expired(), 403, 'user_not_found'));
        }
        $result = $this->settingObject->config($user->id);
        return response(res($lang, success(), 200, 'config', $result));
    }
}
