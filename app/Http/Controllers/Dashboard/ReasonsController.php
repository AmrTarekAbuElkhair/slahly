<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReasonRequest;
use App\Models\Reason;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.reasons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.reasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReasonRequest $request)
    {
        $data=$request->validated();
        Reason::create($data);
        Toastr::success('تم اضافة سبب بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('reasons.index');
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
        $reason=Reason::findOrFail($id);
        return view('pages.reasons.edit',compact('reason'));
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
        $reason=Reason::findOrFail($id);
        $data = [
            'en' => [
                'text'       => $request->input('en_text'),
            ],
            'ar' => [
                'text'       => $request->input('ar_text'),
            ],
            'status'=>$request->status,
        ];
        $reason->update($data);
        Toastr::success('تم تعديل السبب بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('reasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reason=Reason::findOrFail($id);
        $reason->delete();
        Toastr::success('تم حذف السبب بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function dataTable()
    {
        $reasons = Reason::all();
        return DataTables::of($reasons)
            ->editColumn('text', function ($model) {
                return strip_tags($model->text);
            })
            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/reasons/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذا السبب ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('reasons.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذا السبب ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('reasons.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/reasons/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a></p>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }

    public function activate($id)
    {
        $reason=Reason::findOrFail($id);
        $reason->status = 1;
        $reason->save();
        Toastr::success('تم تعديل حالة السبب بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $reason=Reason::findOrFail($id);
        $reason->status = 0;
        $reason->save();
        Toastr::success('تم تعديل حالة السبب بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
