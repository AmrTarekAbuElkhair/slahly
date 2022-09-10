<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $data=$request->validated();
        Service::create($data);
        return redirect()->route('services.index');
        Toastr::success('تم اضافة خدمة بنجاح!','Success',["positionClass" => "toast-top-right"]);
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
        $service=Service::findOrFail($id);
        return view('pages.services.edit',compact('service'));
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
        $service=Service::findOrFail($id);
        $data = [
            'en' => [
                'name'       => $request->input('en.name'),
                'desc'       => $request->input('en.desc'),
            ],
            'ar' => [
                'name'       => $request->input('ar.name'),
                'desc'       => $request->input('ar.desc'),
            ],
            'status'=>$request->status,
            'icon'=>$request->icon
        ];
        $service->update($data);
        Toastr::success('تم تعديل الخدمة بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service=Service::findOrFail($id);
        $service->delete();
        Toastr::success('تم حذف الخدمة بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function dataTable()
    {
        $services = Service::all();
        return DataTables::of($services)
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('icon', function ($services) {
                return '<img src='.asset("$services->icon").' border="0" width="40" class="img-rounded" align="center" style="display: block; margin: auto; background:black"/>'; })

            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/services/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                     if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذه الخدمة ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top"  href="' . route('packages.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذه الخدمة ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('packages.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'هل انت متأكد انك تريد حذف هذه الخدمة ؟  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/services/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a></p>';
                return $all;
            })
            ->rawColumns(['control','name','icon'])->make(true);
    }

    public function activate($id)
    {
        $service=Service::findOrFail($id);
        $service->status = 1;
        $service->save();
        Toastr::success('تم تعديل حالة الخدمة بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $service=Service::findOrFail($id);
        $service->status = 0;
        $service->save();
        Toastr::success('تم تعديل حالة الخدمة بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
