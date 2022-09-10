<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\OrdersExport;
use App\Exports\OrdersManagementExport;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\NotificationContent;
use App\Models\Order;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Session;

class OrdersManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::whereNull('provider_id')->pluck('id');
        return view('pages.orders-management.index',compact('orders'));
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
        $order=Order::find($id);
        $providers = User::whereNotNull('type_id')->get();
        return view('pages.orders-management.show',compact('order','providers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::findOrFail($id);
        $providers = User::whereNotNull('type_id')->get();
        return view('pages.orders-management.edit',compact('order','providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $lang=(Session::get('lang')) ? Session::get('lang') : 'en';
        $order=Order::findOrFail($id);
        $order->update(['provider_id'=>$request->provider_id]);
        $token=User::where('id',$request->provider_id)->first()->firebase_token;
        $notify=Notification::where('type',0)->where('redirect',0)->first();
        NotificationContent::create([
            'notification_id'=>12,'order_id'=>$order->id,
            'provider_id'=>$request->provider_id,
        ]);
        pushnotification($token,$notify->getTranslation($lang)->title, $notify->getTranslation($lang)->desc,$order->id,0);
        Toastr::success('تم اسناد الطلب بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('orders-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        $order->delete();
        NotificationContent::whereIn('order_id',$id)->get()->delete();
        Toastr::success('تم حذف الطلب بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('orders-management.index');
    }
    public function export()
    {
        return Excel::download(new OrdersManagementExport(), 'orders.xlsx');
    }
    public function dataTable()
    {
        $orders = Order::whereNull('provider_id')->get();

        return DataTables::of($orders)
            ->editColumn('user_id', function ($model) {
                if(isset($model->user->name)){
                    return $model->user->name;
                }else{
                    return "user not found";
                }
            })
            ->editColumn('provider_id', function ($model) {
                if(isset($model->provider->name)){
                    return $model->provider->name;
                }else{
                    return "provider not found";
                }
            })

            ->editColumn('service_id', function ($model) {
                if (isset($model->service->name)){
                    return $model->service->name;
                }else{
                    return "service not found";
                }
            })
            ->addColumn('select',function ($row){
                return '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" value="'.$row->id.'" id="'.$row->id.'ch"/>
                                        <span></span>
                                    </label>';
            })
            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-info"  data-placement="top" href = "' . route('orders-management.show' , $model->id) . '"   class="btn btn-sm btn-outline-info controllerCustom" style="margin-left: 10px"><i class="fas fa-eye"></i></a> ';
                $all .= '<a data-toggle="tooltip" data-skin-class="tooltip-warning"  data-placement="top" href = "' . route('orders-management.invoice' , $model->id) . '"   class="btn btn-sm btn-outline-warning controllerCustom" style="margin-left: 10px"><i class="fas fa-print"></i></a> ';
                $all .= '<a data-toggle="tooltip" data-skin-class="tooltip-secondary"  data-placement="top" href = "' . route('orders-management.invoice.download' , $model->id) . '"   class="btn btn-sm btn-outline-secondary controllerCustom" style="margin-left: 10px"><i class="fas fa-download"></i></a> ';
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/orders-management/' . $model->id . '/delete') . '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:10px 0 10px 10px"><i class="fas fa-trash"></i></a></p>';
//                $all .= '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/orders-management/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';

                return $all;
            })
            ->rawColumns(['select','control'])->make(true);
    }
    public function orderInvoice($id)
    {
        $order=Order::findOrFail($id);
        return view('pages.orders-management.invoice',compact('order'));
    }

    function generatePdf($id) {
        $order=Order::findOrFail($id);
        $pdf = Pdf::loadView('pages.orders-management.invoice',compact('order'));
        return $pdf->download($order->id. '.' .'order_invoice.pdf');
    }

    public function deleteAll()
    {
        foreach (Order::whereNull('provider_id')->get() as $order) {
            $order->delete();
        }
        Toastr::success('تم حذف كل الطلبات بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function getDistanceTechnicians($distance,$id)
    {
        $order=Order::where('id',$id)->first();
        $providers = User::where('service_id',$order->service_id)->where('type_id',1)->
        where('verified_status','1')->where('status','1')->
        where('available','1')->
        where('country_id',$order->user->country_id)->
        selectRaw("( FLOOR(6371 * ACOS( COS( RADIANS( $order->lat) ) * COS( RADIANS( lat ) ) *
        COS( RADIANS( lng ) - RADIANS($order->lng) ) + SIN( RADIANS($order->lat) ) * SIN( RADIANS( lat ) ) )) )
        distance,users.id,users.name")
            ->havingRaw("distance <= $distance")
            ->pluck('id','name')->toArray();

        return response()->json($providers);
    }
}
