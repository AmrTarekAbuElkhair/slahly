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
                                @can('contacts.reply')
                                <a href="{{route('contacts.reply',$contact->id)}}" class="text-muted">{{__('dashboard.reply')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('contacts.store.reply')
                                <a href="" class="text-muted">{{__('dashboard.send message')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.send message')}}</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.send message')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('contacts.store.reply',$contact->id)}}" method="post">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.text')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
                                            <textarea class="ckeditor form-control" name="admin_message"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.send by')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="send_by" class="form-control form-control-lg form-control-solid">
                                                <option value="0">sms</option>
                                                <option value="1">email</option>
                                            </select>
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
