<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRequest;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\CompanyService;
use App\Models\Country;
use App\Models\Neighborhood;
use App\Models\PackageCompany;
use App\Models\ProviderOffer;
use App\Models\QrCode;
use App\Models\Service;
use App\Models\User;
use App\Models\Offer;
use App\Models\Package;
use App\Models\WorkerPrice;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\DataTables\Facades\DataTables;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = User::whereNotNull('type_id')->pluck('id');
        return view('pages.providers.index',compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        $data= $request->validated();
        $data['password']=Hash::make($request->password);
        $provider=User::create($data);
        WorkerPrice::create(['price'=>$request->price,'worker_id'=>$provider->id]);
        QrCode::create(['code'=>$request->code,'worker_id'=>$provider->id]);
        if (isset($request->package_id)){
            PackageCompany::create(['package_id'=>$request->package_id,'company_id'=>$provider->id]);
        }
        if (isset($request->offer_id)&&$request->type_id==1){
            ProviderOffer::create(['offer_id'=>$request->offer_id,'worker_id'=>$provider->id]);
        }
        if (isset($request->offer_id)&&$request->type_id==2){
            ProviderOffer::create(['offer_id'=>$request->offer_id,'company_id'=>$provider->id]);
            $services=Service::pluck('id');
            foreach ($services as $service){
                CompanyService::create([
                    'service_id'=>$service,
                    'company_id'=>$provider->id
                ]);
            }
        }
        Toastr::success('تم انشاء حساب الفني بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider=User::find($id);
        return view('pages.providers.show',compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider=User::find($id);
        $getOffers=ProviderOffer::where('worker_id',$provider->id)->orWhere('company_id',$provider->id)->pluck('offer_id');
        $offers=Offer::whereIn('id',$getOffers)->get();
        $getPackages=PackageCompany::where('company_id',$provider->id)->pluck('package_id');
        $packages=Package::whereIn('id',$getPackages)->get();
        $price=WorkerPrice::where('worker_id',$provider->id)->first();
        $code=QrCode::where('worker_id',$provider->id)->first();
        return view('pages.providers.edit',compact('provider','offers','packages','price','code'));
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
        $provider=User::find($id);
        $provider->name=$request->name;
        $provider->email=$request->email;
        $provider->mobile=$request->mobile;
        $provider->service_id=$request->service_id;
        $provider->type_id=$request->type_id;
        $provider->country_id=$request->country_id;
        $provider->city=$request->city;
        $provider->address=$request->address;
        $provider->address=$request->address;
        $provider->verified_status=$request->verified_status;
        $provider->status=$request->status;
        $provider->image=$request->image;
        if (isset($request->password)) {
            $provider->password = Hash::make($request->password);
        }
        $provider->bio=$request->bio;
        $provider->gender=$request->gender;
        $provider->save();
        if(isset($request->price)){
            WorkerPrice::where('worker_id',$provider->id)->update(['price'=>$request->price]);
        }
        if (isset($request->code)){
            QrCode::where('worker_id',$provider->id)->update(['code'=>$request->code]);
        }
//        WorkerPrice::create(['price'=>$request->price,'worker_id'=>$provider->id]);
        if (isset($request->package_id)){
            PackageCompany::where('company_id',$provider->id)->delete();
            PackageCompany::create(['package_id'=>$request->package_id,'company_id'=>$provider->id]);
        }
        if (isset($request->offer_id)&&$request->type_id==1){
            ProviderOffer::where('worker_id',$provider->id)->delete();
            ProviderOffer::create(['offer_id'=>$request->offer_id,'worker_id'=>$provider->id]);
        }
        if (isset($request->offer_id)&&$request->type_id==2){
            ProviderOffer::where('company_id',$provider->id)->delete();
            CompanyService::where('company_id',$provider->id)->delete();
            ProviderOffer::create(['offer_id'=>$request->offer_id,'company_id'=>$provider->id]);
            $services=Service::pluck('id');
            foreach ($services as $service){
                CompanyService::create([
                    'service_id'=>$service,
                    'company_id'=>$provider->id
                ]);
            }
        }
        Toastr::success('تم تعديل بيانات الفني بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('providers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider=User::find($id);
        $provider->delete();
        Toastr::success('تم حذف حساب الفني بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('providers.index');

    }
    public function export()
    {
        return Excel::download(new ProvidersExport(), 'providers.xlsx');
    }
    public function dataTable()
    {
        $providers = User::whereNotNull('type_id')->get();
        return DataTables::of($providers)
               ->editColumn('status', function ($model) {
                if($model->status==1)
                    $all =  'activated';
                else
                    $all = 'deactivated';
                return $all;
            })
            ->editColumn('country', function ($model) {
                return $model->country->name;
            })
            ->editColumn('service', function ($model) {
                if ($model->service_id!=null){
                return $model->service->name;
                }else{
                    return "service not found";
                }
            })
            ->editColumn('account_type', function ($model) {
                return $model->type->name;
            })
            ->editColumn('status', function ($model) {
                if($model->status==1)
                    $all =  'activated';
                else
                    $all = 'deactivated';
                return $all;
            })
            ->addColumn('select',function ($row){
                return '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" value="'.$row->id.'" id="'.$row->id.'ch"/>
                                        <span></span>
                                    </label>';
            })
            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top"  href = "' . url('admin/providers/' . $model->id . '/show') . '"   class="btn btn-sm btn-outline-primary controllerCustom"><i class="fas fa-eye"></i></a> ';
                if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حساب هذا الفني ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('providers.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حساب هذا الفني ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('providers.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all  .= '<a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/providers/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom" style="margin-right:10px;margin-top: 10px"><i class="fas fa-edit"></i></a> ';

                $all .= '<a onClick="return confirm(\'هل تريد حذف حساب هذا الفني ؟  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/providers/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin-left: -9px;margin-top: 10px;"><i class="fas fa-trash"></i></a> </p>';
                return $all;
            })
            ->rawColumns(['select','status','control'])->make(true);
    }
    public function activate($id)
    {
        $provider=User::findOrFail($id);
        $provider->status = 1;
        $provider->save();
        Toastr::success('تم تعديل حالة الفني بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $provider=User::findOrFail($id);
        $provider->status = 0;
        $provider->save();
        Toastr::success('تم تعديل حالة الفني بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deleteAll()
    {
        foreach (User::whereNotNull('type_id')->get() as $provider) {
            $provider->delete();
        }
        Toastr::success('تم حذف كل الفنيين بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
