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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.Edit Settings')}}</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('dashboard.index')}}" class="text-muted">{{__('dashboard.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('settings.index')}}" class="text-muted">{{__('dashboard.Settings')}}</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted">{{__('dashboard.Edit Settings')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Edit Settings')}}</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.Edit Application settings')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('settings.update',$settings->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Logo')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper" style="background-image: url({{$settings->logo}});width:250px;"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="logo" />
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            </div>
                                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.default_image')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="image-input image-input-outline" id="kt_image_1">
                                                <div class="image-input-wrapper" style="background-image: url({{$settings->default_image}});width:250px;"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="default_image" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="default_image" />
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            </div>
                                            <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.phone')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="phone" name="phone" value="{{$settings->phone}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Email')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="email" name="email" value="{{$settings->email}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Address')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="address" name="address" value="{{$settings->address}}"/>

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.youtube')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="youtube" name="youtube" value="{{$settings->youtube}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.whatsapp')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="whatsapp" name="whatsapp" value="{{$settings->whatsapp}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.help_phone')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="help phone" name="help_phone" value="{{$settings->help_phone}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.management_phone')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="management phone" name="management_phone" value="{{$settings->management_phone}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.android_version_user')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="android version user" name="android_version_user" value="{{$settings->android_version_user}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.android_version_provider')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="android version provider" name="android_version_provider" value="{{$settings->android_version_provider}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.ios_version_user')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="ios version user" name="ios_version_user" value="{{$settings->ios_version_user}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.ios_version_provider')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="ios version provider" name="ios_version_provider" value="{{$settings->ios_version_provider}}"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.About In Arabic')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="ar[about]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('ar')->about}}</textarea>--}}
                                            <textarea class="ckeditor form-control" name="ar[about]">{{$settings->translate('ar')->about}}</textarea>
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.About In English')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="en[about]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('en')->about}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="en[about]">{{$settings->translate('en')->about}}</textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.Terms In Arabic')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="ar[terms]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('ar')->terms}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="ar[terms]">{{$settings->translate('ar')->terms}}</textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.Terms In English')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="en[terms]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('en')->terms}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="en[terms]">{{$settings->translate('en')->terms}}</textarea>

                                        </div>
                                    </div>





                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.desc In Arabic')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="ar[desc]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('ar')->desc}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="ar[desc]">{{$settings->translate('ar')->desc}}</textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.desc In English')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="en[desc]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('en')->desc}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="en[desc]">{{$settings->translate('en')->desc}}</textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.privacy In Arabic')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="ar[privacy]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('ar')->privacy}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="ar[privacy]">{{$settings->translate('ar')->privacy}}</textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.privacy In English')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
{{--                                            <textarea name="en[privacy]" class="form-control" data-provide="markdown" rows="10">{{$settings->translate('en')->privacy}}</textarea>--}}
{{--                                            <span class="form-text text-muted">Enter some markdown content</span>--}}
                                            <textarea class="ckeditor form-control" name="ar[privacy]">{{$settings->translate('en')->privacy}}</textarea>

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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
