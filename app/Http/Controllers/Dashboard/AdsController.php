<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdsController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $data=$request->validated();
        if (isset($request->url)){
        $data['url']=$request->url;
        }
        if ($request->addstype==0){
            $data['offer_id']=$request->offer_id;
            $data['package_id']=null;
        }else{
            $data['package_id']=$request->package_id;
            $data['offer_id']=null;
        }
        Ad::create($data);
        Toastr::success('تم اضافة اعلان بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('ads.index');
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
        $ad=Ad::where('id',$id)->first();
        return view('pages.ads.edit',compact('ad'));
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
        $ad=Ad::where('id',$id)->first();
        $ad->status=$request->status;
        $ad->url=$request->url;
        $ad->image=$request->image;
        $ad->type=$request->type;
        $ad->start_date=$request->start_date;
        $ad->end_date=$request->end_date;
        $ad->save();
        if ($request->addstype==0){
            Ad::where('id',$id)->update(['offer_id'=>$request->offer_id,'package_id'=>null]);
        }
        else{
            Ad::where('id',$id)->update(['package_id'=>$request->package_id,'offer_id'=>null]);
        }
        Toastr::success('تم تعديل الاعلان بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad=Ad::where('id',$id)->first();
        $ad->delete();
        Toastr::success('تم مسح الاعلان بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dataTable()
    {
        $ads = Ad::all();
        return DataTables::of($ads)
            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/ads/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                  if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذا الاعلان ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('ads.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذا الاعلان ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('ads.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'هل تريد حذف هذ الاعلان ؟  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/ads/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a> </p>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }
      public function activate($id)
    {
        $ad=Ad::findOrFail($id);
        $ad->status = 1;
        $ad->save();
        Toastr::success('تم تعديل حالة الاعلان بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $ad=Ad::findOrFail($id);
        $ad->status = 0;
        $ad->save();
        Toastr::success('تم تعديل حالة الاعلان بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
