@extends('layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.countries')}}</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                            <li class="breadcrumb-item text-muted">
                                @can('dashboard.index')
                                    <a href="{{route('dashboard.index')}}" class="text-muted">{{__('dashboard.Dashboard')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('countries.index')
                                    <a href="{{route('countries.index')}}" class="text-muted">{{__('dashboard.countries')}}</a>
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

                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-favourite text-primary"></i>
											</span>
                            <h3 class="card-label">{{__('dashboard.countries Data')}}</h3>
                        </div>
                        <div class="card-toolbar">

                            <!--begin::Button-->
                            @can('countries.create')
                                <a href="{{route('countries.create')}}" class="btn btn-primary font-weight-bolder">
                                    <i class="la la-plus"></i>{{__('dashboard.New Record')}}</a>
                        @endcan
                        <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-bordered table-hover table-responsive" id="myTable"
                               style="margin-top: 13px !important">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('dashboard.Name')}}</th>
                                <th>{{__('dashboard.Created At')}}</th>
                                <th>{{__('dashboard.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection
@section('myjsfile')

    <script>
        $(document).ready(function () {
            var ajaxUrl = "countries";
            var data = [
                {data: 'id'},
                {data: 'name'},
                {data: 'created_at'},
                {data: 'control'},
            ];
            _DataTableHandler(ajaxUrl, data);
        });
    </script>
@endsection
