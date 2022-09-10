<?php

namespace App\Http\Controllers\Apis\Mobile\Provider;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\Provider\WorksRepositoryInterface;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorksController extends Controller
{
    protected $worksObject;

    public function __construct(WorksRepositoryInterface $worksObject)
    {
        $this->worksObject = $worksObject;
    }
    public function getWorks(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->first();
        if ($provider == 'false') {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
        $result = $this->worksObject->getWorks($provider->id);
        return response(res($lang, success(),200,'all_works', $result));
    }

    public function storeWorks(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->first();
        if ($provider == 'false') {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
        $validator = Validator::make($request->all(),
            [
                'image' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $this->worksObject->storeWorks($provider->id,$request);
        return response(res_msg($lang, success(),200,'done'));
    }

    public function deleteWork(Request $request)
    {
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $provider = User::where('id',$request->user()->id)->first();
        if ($provider == 'false') {
            return response()->json(res_msg($lang, failed(), 401, 'provider_not_found'));
        }
        $validator = Validator::make($request->all(),
            [
                'work_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['code'=>401,'status' => 'failed', 'msg' => $validator->errors()->first()]);
        }
        $work_id=Work::where('id',$request->work_id)->where('worker_id',$provider->id)->first();
        if (!isset($work_id)){
            return response()->json(res_msg($lang, failed(), 401, 'work_not_found'));
        }else{
            $this->worksObject->deleteWork($provider->id,$work_id->id);
            return response(res_msg($lang, success(),200,'deleted'));
        }
    }
}
