<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $data=$request->validated();
        Country::create($data);
        Toastr::success('تم اضافة الدولة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('countries.index');
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
        $country=Country::where('id',$id)->first();
        return view('pages.countries.edit',compact('country'));
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
        $country=Country::findOrFail($id);
        $data = [
            'en' => [
                'name'       => $request->input('en_name'),
            ],
            'ar' => [
                'name'       => $request->input('ar_name'),
            ],
            'digits'=>$request->digits,
            'logo'=>$request->logo,
            'code'=>$request->code,
            'status'=>$request->status,
        ];
        $country->update($data);
        Toastr::success('تم تعديل الدولة بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=Country::where('id',$id)->first();
        $country->delete();
        Toastr::success('تم مسح الدولة بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dataTable()
    {
        $countries = Country::all();
        return DataTables::of($countries)
            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/countries/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                 if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذه الدولة ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('countries.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذه الدولة ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top"  href="' . route('countries.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/countries/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a> </p>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }

          public function activate($id)
    {
        $country=Country::findOrFail($id);
        $country->status = 1;
        $country->save();
        Toastr::success('تم تعديل حالة الدولة بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $country=Country::findOrFail($id);
        $country->status = 0;
        $country->save();
        Toastr::success('تم تعديل حالة الدولة بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
