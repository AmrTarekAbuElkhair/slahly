<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\AramexShipment;
use App\Models\Order;
use App\Models\NotificationContent;
use App\Models\OrderHasProduct;
use App\Models\OrderPerStore;
use App\Models\OrderProduct;
use App\Models\Payment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::whereNotNull('provider_id')->pluck('id');
        return view('pages.orders.index',compact('orders'));
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
        return view('pages.orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
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
        NotificationContent::where('order_id',$id)->delete();
        Toastr::success('تم حذف الطلب بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('orders.index');
    }
    public function export()
    {
        return Excel::download(new OrdersExport(), 'orders.xlsx');
    }
    public function dataTable()
    {
        $orders = Order::whereNotNull('provider_id')->get();
        return DataTables::of($orders)
            ->editColumn('user_id', function ($model) {
                if(isset($model->user->name)){
                    return $model->user->name;
                }else{
                    return "user not found";
                }
            })
            ->editColumn('provider_id', function ($model) {
                if($model->provider_id!=null){
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
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-info"  data-placement="top" href = "' . route('orders.show' , $model->id) . '"   class="btn btn-sm btn-outline-info controllerCustom" style="margin-left: 10px"><i class="fas fa-eye"></i></a> ';
                $all .= '<a data-toggle="tooltip" data-skin-class="tooltip-warning"  data-placement="top" href = "' . route('orders.invoice' , $model->id) . '"    class="btn btn-sm btn-outline-warning controllerCustom" style="margin-left: 10px"><i class="fas fa-print"></i></a> ';
                $all .= '<a data-toggle="tooltip" data-skin-class="tooltip-secondary"  data-placement="top" href = "' . route('orders.invoice.download' , $model->id) . '"   class="btn btn-sm btn-outline-secondary controllerCustom" style="margin-left: 10px"><i class="fas fa-download"></i></a> ';
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/orders/' . $model->id . '/delete') . '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:10px 0 10px 10px"><i class="fas fa-trash"></i></a></p>';
                return $all;
            })
            ->rawColumns(['select','control'])->make(true);
    }
    public function orderInvoice($id)
    {
        $order=Order::findOrFail($id);
        return view('pages.orders.invoice',compact('order'));
    }

    function generatePdf($id) {
        $order=Order::findOrFail($id);
        $pdf = Pdf::loadView('pages.orders.invoice',compact('order'));
        return $pdf->download($order->id. '.' .'order_invoice.pdf');
    }

    public function deleteAll()
    {
        foreach (Order::whereNotNull('provider_id')->get() as $order) {
            $order->delete();
        }
        Toastr::success('تم حذف كل الطلبات بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
