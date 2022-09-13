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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.Providers')}}</h5>
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
                                @can('providers.index')
                                    <a href="{{route('providers.index')}}"
                                       class="text-muted">{{__('dashboard.Providers')}}</a>
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
                            <h3 class="card-label">{{__('dashboard.Providers Data')}}</h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i>{{__('dashboard.Export')}}</button>
                                <!--begin::Dropdown Menu-->
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <ul class="nav flex-column nav-hover">
                                        <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2">{{__('dashboard.Choose an option:')}}</li>

                                        <li class="nav-item">
                                            @can('providers.export')
                                                <a href="{{route('providers.export')}}" class="nav-link">
                                                    <i class="nav-icon la la-file-excel-o"></i>
                                                    <span class="nav-text">{{__('dashboard.Excel')}}</span>
                                                </a>
                                            @endcan


                                        </li>
                                    </ul>
                                </div>
                                <!--end::Dropdown Menu-->
                            </div>
                            <!--end::Dropdown-->
                            <!--begin::Button-->
                            @can('providers.create')
                            <a href="{{route('providers.create')}}" class="btn btn-primary font-weight-bolder">
                                <i class="la la-plus"></i>{{__('dashboard.New Record')}}</a>
                            @endcan

                            {{--    Sharaqi   --}}
                            @can('providers.all.delete')
                            <form action="{{route('providers.all.delete')}}" method="post" style="margin-left: 10px">
                                @csrf
                                <input id='deleteProvidersBtn' type="submit" class="btn btn-primary mr-2"
                                       value="delete all providers" disabled/>

                            </form>
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
                                @can('providers.all.delete')
                                <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input onclick="handleCkhk()" type="checkbox" class="group-checkable"
                                               data-set="#sample_1 .checkboxes" id="mainCh"/>
                                        <span></span>
                                    </label>
                                </th>
                                @endcan
                                <th>#</th>
                                <th>{{__('dashboard.Name')}}</th>
                                <th>{{__('dashboard.Email')}}</th>
                                <th>{{__('dashboard.phone')}}</th>
                                <th>{{__('dashboard.country')}}</th>
                                <th>{{__('dashboard.city')}}</th>
                                <th>{{__('dashboard.service')}}</th>
                                <th>{{__('dashboard.account_type')}}</th>
                                <th>{{__('dashboard.status')}}</th>
                                <th>{{__('dashboard.Created At')}}</th>
                                <th>{{__('dashboard.Actions')}}</th>
                            </tr>
                            </thead>

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
            var ajaxUrl = "providers";
            var data = [
                {data: "select", "searchable": false, "orderable": false},
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'mobile'},
                {data: 'country'},
                {data: 'city'},
                {data: 'service'},
                {data: 'account_type'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'control'},
            ];
            _DataTableHandler(ajaxUrl, data);
        });
    </script>

    <script>
        $("#sample_1").find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
        });
        $("#sample_1").on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    </script>


    {{--    Edited by Sharaqi   --}}
    <script>
        var x = [];
        var handleCkhk = () => {
            if (document.getElementById('mainCh').checked) {
                @foreach($providers as $provider)
                document.getElementById({{$provider}} + 'ch').checked = true;
                @endforeach
                document.getElementById('deleteProvidersBtn').disabled = false;
            } else {
                @foreach($providers as $provider)
                document.getElementById({{$provider}} + 'ch').checked = false;
                @endforeach
                document.getElementById('deleteProvidersBtn').disabled = true;
            }
            // document.getElementById('deleteUsersBtn').disabled = true

        }

        {{--var handeDeleteId = () => {--}}

        {{--    @foreach($users as $user)--}}
        {{--        console.log({{$user}})--}}
        {{--    @endforeach--}}
        {{--}--}}

        var handleForm = (event) => {
            event.preventDefault();
        }

    </script>

@endsection

