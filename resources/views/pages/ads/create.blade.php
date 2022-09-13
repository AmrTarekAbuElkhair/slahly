@extends('layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
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
                                <a href="{{route('dashboard.index')}}" class="text-muted">{{__('dashboard.Dashboard')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('ads.index')
                                <a href="{{route('ads.index')}}" class="text-muted">{{__('dashboard.Advertisments')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('ads.create')
                                <a href="" class="text-muted">{{__('dashboard.Create Advertisment')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Create Advertisment')}}</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.create new Advertisment')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('ads.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <!--begin::Heading-->

                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.type')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="type" id="type"
                                                    class="form-control form-control-lg form-control-solid">
                                                <option value="0">{{__('dashboard.inside')}}</option>
                                                <option value="1">{{__('dashboard.outside')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Image')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper" style="background-image: url({{asset('assets/dist/assets/media/users/blank.png')}})"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="image" />
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            </div>
                                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Link')}}</label>
                                        <div class="col-lg-9 col-xl-9">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="{{__('dashboard.Link')}}" name="url"/>

                                        </div>
                                    </div>

                                    <div class="form-group row" style='display:none;' id='business'>
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.advertisment type')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select id="addstype" name="addstype" class="form-control form-control-lg form-control-solid">
                                                <option value="0" status="0" >{{__('dashboard.offer maintenance')}}</option>
                                                <option value="1" status="1">{{__('dashboard.offer package')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="offers" class="form-group row showOrHide" style="display: none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select offer')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="offer_id" class="form-control form-control-lg form-control-solid">
                                                @foreach(\App\Models\Offer::get() as $offer)
                                                    <option value="{{$offer->id}}">@if(isset($offer->service->name)){{$offer->service->name}}@else{{$offer->package->name}}@endif</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="packages" class="form-group row showOrHide" style="display: none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select package')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="package_id" class="form-control form-control-lg form-control-solid">
                                                @foreach(\App\Models\Package::all() as $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                </div>
                                    <button type="submit" class="btn btn-success mr-2">{{__('dashboard.save')}}</button>


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
        $(document).ready(function(){
            $('#type').on('change', function() {
                if ( this.value == '0')
                    //.....................^.......
                {
                    $("#business").show();
                }
                else
                {
                    $("#business").hide();
                    $("#packages").css('display', 'none');
                    $("#offers").css('display','none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#addstype").on('change',function(){
                var addstype = $(this).val();

                if(addstype == 0) {
                    //offers
                    $("#offers").css('display', '');
                    $("#packages").css('display', 'none');
                }else {
                    //packages
                    $("#packages").css('display','');
                    $("#offers").css('display','none');
                }

            });

        });
    </script>



@endsection
