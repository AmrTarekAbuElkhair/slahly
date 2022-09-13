<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageServiceRequest;
use App\Models\Description;
use App\Models\Package;
use App\Models\Service;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackageServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.packages-services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages=Package::all();
        $services=Service::all();
        return view('pages.packages-services.create', compact('packages','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageServiceRequest $request)
    {
        $data = $request->validated();
        Description::create($data);
        Toastr::success('تم اضافة خدمة الباقة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('packages-services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $packageService = Description::findOrFail($id);
        $packages=Package::all();
        $services=Service::all();
        return view('pages.packages-services.edit', compact('packageService', 'packages','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $packageService = Description::findOrFail($id);
        $data = [
            'en' => [
                'text' => $request->input('en.text'),
            ],
            'ar' => [
                'text' => $request->input('ar.text'),
            ],
            'package_id' => $request->package_id,
            'service_id' => $request->service_id,
        ];
        $packageService->update($data);
        Toastr::success('تم تعديل خدمة الباقة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('packages-services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packageService = Description::findOrFail($id);
        $packageService->delete();
        Toastr::success('تم حذف خدمة الباقة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dataTable()
    {
        $packagesServices = Description::all();
        return DataTables::of($packagesServices)
            ->editColumn('service_id', function ($model) {
                if($model->service_id!=null){
                    return $model->service->name;
                }else{
                    return "service not found";
                }
            })
            ->editColumn('package_id', function ($model) {
                if($model->package_id!=null) {
                    return $model->package->name;
                }else{
                    return "package not found";
                }
            })
            ->editColumn('control', function ($model) {
                $all = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/packages-services/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                $all .= '<a onClick="return confirm(\'هل انت متأكد انك تريد حذف هذه الباقة ؟ \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placem= "Delete" href = "' . url('admin/packages-services/' . $model->id . '/delete') . '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a></p>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }

}
