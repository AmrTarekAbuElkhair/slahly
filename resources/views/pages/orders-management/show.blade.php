@extends('layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
                            id="kt_subheader_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Mobile Toggle-->
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.Show Record')}}</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                @can('dashboard.index')
                                    <a href="{{route('dashboard.index')}}"
                                       class="text-muted">{{__('dashboard.Dashboard')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('orders-management.index')
                                    <a href="{{route('orders-management.index')}}"
                                       class="text-muted">{{__('dashboard.orders management')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('orders-management.show')
                                    <a href="{{route('orders-management.show',$order->id)}}"
                                       class="text-muted">{{__('dashboard.Show orders management')}}</a>
                                @endcan
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Profile Account Information-->
                <div class="d-flex flex-row">

                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Show orders management')}}</h3>
                                    <span
                                        class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.show orders management settings')}}</span>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <div class="card card-custom" style="margin-top: 20px">
                                <div class="card-header">
                                    <div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-favourite text-primary"></i>
											</span>
                                        <h3 class="card-label">{{__('dashboard.Order basic Data')}}</h3>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <!--begin::Heading-->

                                    <!--begin::Form Group-->

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.User')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="name"
                                                   type="text" placeholder="{{__('dashboard.User')}}" name="name"
                                                   value="@if(isset($order->user_id)){{$order->user->name}} @else user not found @endif"
                                                   readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.worker')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="name"
                                                   type="text" placeholder="{{__('dashboard.Provider')}}" name="name"
                                                   value="@if(isset($order->provider_id)){{$order->provider->name}} @else provider not found @endif"
                                                   readonly/>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.package')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="name"
                                                   type="text" placeholder="{{__('dashboard.package')}}" name="name"
                                                   value="@if(isset($order->package_id)) {{$order->package->name}} @else package not found @endif"
                                                   readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.service')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="name"
                                                   type="text" placeholder="{{__('dashboard.service')}}" name="name"
                                                   value="@if(isset($order->service_id)) {{$order->service->name}} @else service not found @endif"
                                                   readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.offer')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="name"
                                                   type="text" placeholder="{{__('dashboard.offer')}}" name="name"
                                                   value="@if(isset($order->offer_id)) {{$order->offer->name}} @else offer not found @endif"
                                                   readonly/>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.phone')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="mobile"
                                                   type="text" placeholder="{{__('dashboard.phone')}}" name="mobile"
                                                   value="{{$order->mobile}}" readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.order_number')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="order_number" type="text"
                                                   placeholder="{{__('dashboard.order_number')}}" name="order_number"
                                                   value="{{$order->order_number}}" readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.price')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="price"
                                                   type="text" placeholder="{{__('dashboard.price')}}" name="price"
                                                   value="{{$order->price}}" readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.status')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" id="status"
                                                   type="text" placeholder="{{__('dashboard.status')}}" name="status"
                                                   value="@if($order->status==0) new @elseif($order->status==1) in way @elseif($order->status==2) arrived @elseif($order->status==3) start processing @elseif($order->status==4) finished from user @elseif($order->status==5) finished from worker @elseif($order->status==6) paid @else cancelled @endif"
                                                   readonly/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.payment_status')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="payment_status" type="text"
                                                   placeholder="{{__('dashboard.payment_status')}}"
                                                   name="payment_status"
                                                   value="@if($order->payment_status==0) not paid yet @else paid @endif"
                                                   readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.payment')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="payment"
                                                   type="text" placeholder="{{__('dashboard.payment')}}" name="payment"
                                                   value="{{$order->payment}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.time')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="time"
                                                   type="text" placeholder="{{__('dashboard.time')}}" name="time"
                                                   value="{{$order->time}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.date')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="date"
                                                   type="text" placeholder="{{__('dashboard.date')}}" name="date"
                                                   value="{{$order->date}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.visit_time')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="visit_time" type="text"
                                                   placeholder="{{__('dashboard.visit_time')}}" name="visit_time"
                                                   value="{{$order->visit_time}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.visit_date')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="visit_date" type="text"
                                                   placeholder="{{__('dashboard.visit_date')}}" name="visit_date"
                                                   value="{{$order->visit_date}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.working_hours')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="working_hours" type="text"
                                                   placeholder="{{__('dashboard.working_hours')}}" name="working_hours"
                                                   value="{{intdiv($order->working_hours, 60).':'. ($order->working_hours % 60)}}"
                                                   readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.finish_time')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="finish_time" type="text"
                                                   placeholder="{{__('dashboard.finish_time')}}" name="finish_time"
                                                   value="{{$order->finish_time}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.title')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="title"
                                                   type="text" placeholder="{{__('dashboard.title')}}" name="title"
                                                   value="{{$order->title}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.city')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="city"
                                                   type="city" placeholder="{{__('dashboard.city')}}" name="city"
                                                   value="{{$order->city}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.notes')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="city"
                                                   type="notes" placeholder="{{__('dashboard.notes')}}" name="notes"
                                                   value="{{$order->notes}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.apartment_no')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid"
                                                   id="apartment_no" type="apartment_no"
                                                   placeholder="{{__('dashboard.apartment_no')}}" name="apartment_no"
                                                   value="{{$order->apartment_no}}" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.floor_no')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="floor_no"
                                                   type="floor_no" placeholder="{{__('dashboard.floor_no')}}"
                                                   name="floor_no" value="{{$order->floor_no}}" readonly/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.mark')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" id="mark"
                                                   type="mark" placeholder="{{__('dashboard.mark')}}" name="mark"
                                                   value="{{$order->mark}}" readonly/>
                                        </div>
                                    </div>

                                </div>

                                <!--end::Form-->
                            </div>


                                <div class="card card-custom">
                                    <!--begin::Header-->
                                    <div class="card-header py-3">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Edit order')}}</h3>
                                            <span
                                                class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.Edit Order data')}}</span>
                                        </div>

                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    <form class="form" action="{{route('orders-management.update',$order->id)}}"
                                          method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <!--begin::Heading-->

                                            <!--begin::Form Group-->

                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.distance')}}</label>
                                                <div class="col-lg-9 col-xl-6">

                                                    {{--                                                <input class="form-control form-control-lg form-control-solid" id="distance" type="number" placeholder="{{__('dashboard.distance')}}" name="distance" />--}}
                                                    <select name="distance" id="distance" class="form-control digits">
                                                        @for ($i=1;$i<=100;$i++){
                                                        <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select technician')}}</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <select name="provider_id" id="provider_id"
                                                            class="form-control form-control-lg form-control-solid">
                                                        @foreach($providers as $provider)
                                                            <option
                                                                value="{{$provider->id}}">{{$provider->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                    class="btn btn-success mr-2">{{__('dashboard.save')}}</button>

                                        </div>
                                    </form>
                                    <!--end::Form-->
                                </div>

                        <!--end::Card-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Profile Account Information-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->
        </div>
        @endsection
        @section('myjsfile')

            <script>
                $(document).on('change', '#distance', function () {
                    var distance = $(this).val();
                    //alert(company_id);
                    if (distance) {
                        $.ajax({
                            type: "GET",
                            // url:"{{url('get-distance-providers/')}}/?category_id="+category_id,
                            url: "/get-distance-providers/" + distance + "/" + {{$order->id}},
                            success: function (res) {
                                console.log(res);

                                if (res) {
                                    console.log(res);
                                    $("#provider_id").empty();
                                    $.each(res, function (key, value) {
                                        $("#provider_id").append('<option value="' + value + '" >' + key + '</option>');
                                    });
                                }
                                if (res.length === 0) {
                                    // $("#provider_id").empty();
                                    $("#provider_id").append('<option>' + 'no data found' + '</option>');
                                }
                            }
                        });
                    } else {
                        $("#provider_id").append('<option>' + 'no data found' + '</option>');
                    }
                });

            </script>

@endsection
