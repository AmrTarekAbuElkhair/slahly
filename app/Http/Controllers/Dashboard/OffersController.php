<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Package;
use App\Models\Service;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.offers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services=Service::all();
        $packages=Package::all();
        return view('pages.offers.create',compact('services','packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        $data=$request->validated();
        Offer::create($data);
        Toastr::success('تم اضافة العرض بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('offers.index');
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
        $offer=Offer::findOrFail($id);
        $services=Service::all();
        $packages=Package::all();
        return view('pages.offers.edit',compact('offer','services','packages'));
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
        $offer=Offer::findOrFail($id);
        $offer->service_id=$request->service_id;
        $offer->package_id=$request->package_id;
        $offer->percentage=$request->percentage;
        $offer->image=$request->image;
        $offer->status=$request->status;
        $offer->price_before_sale=$request->price_before_sale;
        $offer->price_after_sale=$request->price_after_sale;
        $offer->save();
        Toastr::success('تم تعديل العرض بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer=Offer::findOrFail($id);
        $offer->delete();
        Toastr::success('تم حذف العرض بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function dataTable()
    {
        $offers = Offer::all();
        return DataTables::of($offers)
            ->editColumn('service_id', function ($model) {
                return $model->service->name;
            })
            ->editColumn('package_id', function ($model) {
                return $model->package->name;
            })
            ->editColumn('control', function ($model) {
                $all  = '<a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/offers/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a> ';
                    if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذا العرض ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('offers.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذا العرض ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('offers.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'هل انت متأكد هل تريد حذف هذا العرض ؟ \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/offers/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger" style="margin:0 10px"><i class="fas fa-trash"></i></a>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }

                public function activate($id)
    {
        $offer=Offer::findOrFail($id);
        $offer->status = 1;
        $offer->save();
        Toastr::success('تم تعديل حالة العرض بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $offer=Offer::findOrFail($id);
        $offer->status = 0;
        $offer->save();
        Toastr::success('تم تعديل حالة العرض بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
