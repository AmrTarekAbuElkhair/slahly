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
                                @can('notifications.index')
                                <a href="{{route('notifications.index')}}"
                                   class="text-muted">{{__('dashboard.notifications')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('notifications.create')
                                <a href="" class="text-muted">{{__('dashboard.Create notifications')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Create notifications')}}</h3>
                                    <span
                                        class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.create new notification')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('notifications.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <!--begin::Heading-->

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.notification_type')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="type" class="form-control form-control-lg form-control-solid">
                                                <option value="5">{{__('dashboard.notification')}}</option>
                                                <option value="6">{{__('dashboard.offer')}}</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.title in english')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="{{__('dashboard.title in english')}}" name="en[title]"/>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.title in arabic')}}</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder="{{__('dashboard.title in arabic')}}" name="ar[title]" />

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.Text in english')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
                                            <textarea class="ckeditor form-control" name="en[desc]"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-lg-3 col-sm-12 text-right">{{__('dashboard.Text in arabic')}}</label>
                                        <div class="col-lg-7 col-md-9 col-sm-12">
                                            <textarea class="ckeditor form-control" name="ar[desc]"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row " >
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.users type')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select id="usertype" name="user_type" class="form-control form-control-lg form-control-solid">
                                                <option value="0" status="0">{{__('dashboard.one user')}}</option>
                                                <option value="1" status="1">{{__('dashboard.all users')}}</option>
                                                <option value="2" status="2">{{__('dashboard.one provider')}}</option>
                                                <option value="3" status="3">{{__('dashboard.all providers')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="users" class="form-group row showOrHide">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select user')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="user_id" class="form-control form-control-lg form-control-solid">
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="providers" class="form-group row showOrHide" style="display: none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Select provider')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="provider_id" class="form-control form-control-lg form-control-solid">
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
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
    <script>
        $(document).ready(function(){
            $("#usertype").on('change',function(){
                var usertype = $(this).val();
                if(usertype == 0){
                    //stores
                    $("#users").css('display','');
                    $("#providers").css('display','none');
                }
                if(usertype == 1){
                    $("#users").css('display','none');
                    $("#providers").css('display','none');
                }
                if(usertype == 2){
                    $("#providers").css('display','');
                    $("#users").css('display','none');
                }
                if(usertype == 3){
                    $("#users").css('display','none');
                    $("#providers").css('display','none');
                }
            });

        });
    </script>

@endsection
