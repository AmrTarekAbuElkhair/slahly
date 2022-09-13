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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.New Record')}}</h5>
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
                                @can('offers.index')
                                <a href="{{route('offers.index')}}" class="text-muted">{{__('dashboard.offers')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('offers.create')
                                <a href="" class="text-muted">{{__('dashboard.Create offer')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Create offer')}}</h3>
                                    <span
                                        class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.create new offer')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('offers.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <!--begin::Heading-->
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.offer type')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select id="addstype" name="type"
                                                    class="form-control form-control-lg form-control-solid">
                                                <option value="0" status="0">{{__('dashboard.service')}}</option>
                                                <option value="1" status="1">{{__('dashboard.package')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="services" class="form-group row showOrHide">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select service')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="service_id"
                                                    class="form-control form-control-lg form-control-solid">
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id="packages" class="form-group row showOrHide" style="display: none">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select package')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="package_id"
                                                    class="form-control form-control-lg form-control-solid">
                                                @foreach($packages as $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.percentage')}}</label>
                                        <div class="col-lg-9 col-xl-9">

                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                   placeholder="{{__('dashboard.percentage')}}" name="percentage"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.price_before_sale')}}</label>
                                        <div class="col-lg-9 col-xl-9">

                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                   placeholder="{{__('dashboard.price_before_sale')}}"
                                                   name="price_before_sale"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.price_after_sale')}}</label>
                                        <div class="col-lg-9 col-xl-9">

                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                   placeholder="{{__('dashboard.price_after_sale')}}"
                                                   name="price_after_sale"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select provider')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select id="provider_id" name="provider_id[]"
                                                    class="form-control form-control-lg form-control-solid" multiple>
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Image')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper"
                                                     style="background-image: url({{asset('assets/dist/assets/media/users/blank.png')}})"></div>
                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title=""
                                                    data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                                    <input type="hidden" name="image"/>
                                                </label>
                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            </div>
                                            <span
                                                class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-success mr-2">{{__('dashboard.save')}}</button>

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
        $(document).ready(function () {
            $("#addstype").on('change', function () {
                var addstype = $(this).val();
                if (addstype == 0) {
                    //stores
                    $("#services").css('display', '');
                    $("#packages").css('display', 'none');
                }
                if (addstype == 1) {
                    $("#packages").css('display', '');
                    $("#services").css('display', 'none');
                }

            });

        });
    </script>

@endsection
