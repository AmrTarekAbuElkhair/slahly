@extends('layouts.app')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                    <!--end::Page Title-->

                </div>
                <!--end::Info-->

            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-12 col-xxl-4">
                        <!--begin::Mixed Widget 1-->
                        <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 bg-primary py-5">
                                <h3 class="card-title font-weight-bolder" style="color: white">Statistics</h3>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
{{--                            <div class="card-body p-0 position-relative overflow-hidden">--}}
{{--                                <!--begin::Chart-->--}}
{{--                                <div style="height: 75px"></div>--}}
{{--                                <!--end::Chart-->--}}
{{--                                <!--begin::Stats-->--}}
{{--                                <div class="card-spacer mt-n25">--}}
{{--                                    <!--begin::Row-->--}}
{{--                                    <div class="row m-0">--}}
{{--                                        <div class="col bg-primary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:{{ asset('assets/dist/assets/media/svg/icons/Media/Equalizer.svg') }}-->--}}
{{--                                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--        <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>--}}
{{--        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>--}}
{{--    </g>--}}
{{--</svg><!--end::Svg Icon--></span>--}}

{{--                                                                    <!--end::Svg Icon-->--}}
{{--                                                                    <h4 style="text-align: right;color: white">{{\App\Models\User::where('user_type','0')->count()}}</h4>--}}
{{--                                                            </span>--}}


{{--                                            <a href="#" class="text-light font-weight-bold font-size-h6">members </a>--}}
{{--                                        </div>--}}
{{--                                        <div class="col bg-primary px-6 py-8 rounded-xl mb-7">--}}
{{--	<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:{{ asset('assets/dist/assets/media/svg/icons/Media/Equalizer.svg') }}-->--}}
{{--                                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--        <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>--}}
{{--        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>--}}
{{--    </g>--}}
{{--</svg><!--end::Svg Icon--></span>--}}

{{--                                                                    <!--end::Svg Icon-->--}}
{{--                                                                    <h4 style="text-align: right;color: white">{{\App\Models\User::where('user_type','1')->count()}}</h4>--}}
{{--                                                            </span>--}}

{{--                                            <a href="#" class="text-light font-weight-bold font-size-h6 mt-2">entities</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Row-->--}}
{{--                                    <!--begin::Row-->--}}
{{--                                    <div class="row m-0">--}}
{{--                                        <div class="col bg-primary px-6 py-8 rounded-xl mr-7 mb-7">--}}
{{--	<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:{{ asset('assets/dist/assets/media/svg/icons/Media/Equalizer.svg') }}-->--}}
{{--                                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Selected-file.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--        <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--        <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>--}}
{{--        <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"/>--}}
{{--    </g>--}}
{{--</svg><!--end::Svg Icon--></span>--}}


{{--                                                                    <!--end::Svg Icon-->--}}
{{--															<h4 style="text-align: right;color: white">{{\App\Models\Opportunity::count()}}</h4>--}}
{{--                                                            </span>--}}
{{--                                            <a href="#" class="text-light font-weight-bold font-size-h6 mt-2">Opportunities</a>--}}
{{--                                        </div>--}}

{{--                                        <div class="col bg-primary px-6 py-8 rounded-xl mb-7">--}}
{{--	<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
{{--																<!--begin::Svg Icon | path:{{ asset('assets/dist/assets/media/svg/icons/Media/Equalizer.svg') }}-->--}}
{{--                                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--        <polygon points="0 0 24 0 24 24 0 24"/>--}}
{{--        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>--}}
{{--        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>--}}
{{--    </g>--}}
{{--</svg><!--end::Svg Icon--></span>--}}


{{--                                                                    <!--end::Svg Icon-->--}}
{{--															<h4 style="text-align: right;color: white">{{\App\Models\User::where('status','0')->where('user_type','0')->get()->count()}}</h4>--}}
{{--                                                            </span>--}}
{{--                                            <a href="#" class="text-light font-weight-bold font-size-h6 mt-2">Waiting Members</a>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                    <!--end::Row-->--}}
{{--                                </div>--}}
{{--                                <!--end::Stats-->--}}
{{--                            </div>--}}
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 1-->
                    </div>





                </div>
                <!--end::Row-->
                <!--begin::Row-->
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <!--begin::Advance Table Widget 4-->--}}
{{--                        <div class="card card-custom card-stretch gutter-b">--}}
{{--                            <!--begin::Header-->--}}
{{--                            <div class="card-header border-0 py-5">--}}
{{--                                <h3 class="card-title align-items-start flex-column">--}}
{{--                                    <span class="card-label font-weight-bolder text-dark">Last 5 Members</span>--}}
{{--                                </h3>--}}
{{--                            </div>--}}
{{--                            <!--end::Header-->--}}
{{--                            <!--begin::Body-->--}}
{{--                            <div class="card-body pt-0 pb-3">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <!--begin::Table-->--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="text-left text-uppercase">--}}
{{--                                                <th style="min-width: 100px">First Name</th>--}}
{{--                                                <th style="min-width: 100px">Last Name</th>--}}
{{--                                                <th style="min-width: 100px">email</th>--}}
{{--                                                <th style="min-width: 100px">phone</th>--}}
{{--                                                <th style="min-width: 100px">date of birth</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @foreach(\App\Models\User::where('user_type','0')->orderBy('id', 'desc')->take(5)->get() as $user)--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$user->fname}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$user->lname}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$user->email}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$user->mobile}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$user->birth_date}}</span>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Table-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Advance Table Widget 4-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--end::Row-->--}}
{{--                <!--end::Dashboard-->--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <!--begin::Advance Table Widget 4-->--}}
{{--                        <div class="card card-custom card-stretch gutter-b">--}}
{{--                            <!--begin::Header-->--}}
{{--                            <div class="card-header border-0 py-5">--}}
{{--                                <h3 class="card-title align-items-start flex-column">--}}
{{--                                    <span class="card-label font-weight-bolder text-dark">Last 5 Organizers</span>--}}
{{--                                </h3>--}}
{{--                            </div>--}}
{{--                            <!--end::Header-->--}}
{{--                            <!--begin::Body-->--}}
{{--                            <div class="card-body pt-0 pb-3">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <!--begin::Table-->--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="text-left text-uppercase">--}}
{{--                                                <th style="min-width: 100px">name</th>--}}
{{--                                                <th style="min-width: 100px">type</th>--}}
{{--                                                <th style="min-width: 100px">description</th>--}}
{{--                                                <th style="min-width: 100px">certification num</th>--}}
{{--                                                <th style="min-width: 100px">email</th>--}}
{{--                                                <th style="min-width: 100px">mobile</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @foreach(\App\Models\User::where('user_type','1')->orderBy('id', 'desc')->take(5)->get() as $entity)--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$entity->entity_name}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$entity->type->name}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$entity->desc}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$entity->certification_num}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$entity->email}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$entity->mobile}}</span>--}}
{{--                                                    </td>--}}

{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Table-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Advance Table Widget 4-->--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <!--begin::Advance Table Widget 4-->--}}
{{--                        <div class="card card-custom card-stretch gutter-b">--}}
{{--                            <!--begin::Header-->--}}
{{--                            <div class="card-header border-0 py-5">--}}
{{--                                <h3 class="card-title align-items-start flex-column">--}}
{{--                                    <span class="card-label font-weight-bolder text-dark">Last 5 Opportunities</span>--}}
{{--                                </h3>--}}
{{--                            </div>--}}
{{--                            <!--end::Header-->--}}
{{--                            <!--begin::Body-->--}}
{{--                            <div class="card-body pt-0 pb-3">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <!--begin::Table-->--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="text-left text-uppercase">--}}
{{--                                                <th style="min-width: 100px">date from</th>--}}
{{--                                                <th style="min-width: 100px">date to</th>--}}
{{--                                                <th style="min-width: 100px">address</th>--}}
{{--                                                <th style="min-width: 130px">capacity</th>--}}
{{--                                                <th style="min-width: 130px">title</th>--}}
{{--                                                <th style="min-width: 130px">entity</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @foreach(\App\Models\Opportunity::orderBy('id', 'desc')->take(5)->get() as $o)--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$o->date_from}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$o->date_to}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$o->address}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$o->capacity}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$o->title}}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$o->entity->entity_name}}</span>--}}
{{--                                                    </td>--}}

{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Table-->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Body-->--}}
{{--                        </div>--}}
{{--                        <!--end::Advance Table Widget 4-->--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

