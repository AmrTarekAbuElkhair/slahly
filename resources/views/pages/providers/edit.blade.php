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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.Edit Record')}}</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                @can('dashboard.index')
                                    <a href="{{route('dashboard.index')}}" class="text-muted">{{__('dashboard.Dashboard')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('providers.index')
                                    <a href="{{route('providers.index')}}" class="text-muted">{{__('dashboard.Providers')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('providers.edit')
                                    <a href="" class="text-muted">{{__('dashboard.Edit Provider')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Edit Provider')}}</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.Edit provider account settings')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('providers.update',$provider->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <!--begin::Heading-->
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h5 class="font-weight-bold mb-6">{{__('dashboard.Account')}}:</h5>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Name')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input  class="form-control form-control-lg form-control-solid" type="text" placeholder="{{__('dashboard.Name')}}" name="name" value="{{$provider->name}}"/>

                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Email')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">

                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="email" placeholder="{{__('dashboard.Email')}}" value="{{$provider->email}}"/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.phone')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="mobile" placeholder="{{__('dashboard.phone')}}" value="{{$provider->mobile}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.country')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="country_id"
                                                    class="form-control form-control-lg form-control-solid">
                                                @foreach(\App\Models\Country::all() as $country)
                                                    <option
                                                        {{ $country->id == $provider->country->id ? 'selected' : '' }} value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.address')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="address" placeholder="{{__('dashboard.address')}}" value="{{$provider->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.verified')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="verified_status"
                                                    class="form-control form-control-lg form-control-solid">
                                                <option value="0"
                                                        @if($provider->verified_status=='0')selected @endif>{{__('dashboard.no')}}</option>
                                                <option value="1"
                                                        @if($provider->verified_status=='1')selected @endif>{{__('dashboard.yes')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.is active')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="status"
                                                    class="form-control form-control-lg form-control-solid">
                                                <option value="0"
                                                        @if($provider->status=='0')selected @endif>{{__('dashboard.no')}}</option>
                                                <option value="1"
                                                        @if($provider->status=='1')selected @endif>{{__('dashboard.yes')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Image')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper" style="background-image: url({{$provider->image}})"></div>
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
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.offer')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="offer_id"
                                                    class="form-control form-control-lg form-control-solid">
                                                @foreach(\App\Models\Offer::get() as $offer)
                                                    <option
                                                        value="{{$offer->id}}">{{$offer->service->name}} - {{$offer->package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.package')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="package_id"
                                                    class="form-control form-control-lg form-control-solid">
                                                @foreach(\App\Models\Package::get() as $package)
                                                    <option
                                                        value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.price')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="number" placeholder="{{__('dashboard.price')}}" name="price" value="{{$price->price}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.code')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="number" placeholder="{{__('dashboard.code')}}" name="code" value="{{$code->code}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('dashboard.Password')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="password" placeholder="{{__('dashboard.Password')}}">
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
