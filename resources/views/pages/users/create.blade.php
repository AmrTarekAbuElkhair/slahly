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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{__('dashboard.Create Record')}}</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                @can('dashboard.index')
                                    <a href="{{route('dashboard.index')}}" class="text-muted">{{__('dashboard.Dashboard')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('users.index')
                                <a href="{{route('users.index')}}" class="text-muted">{{__('dashboard.Users')}}</a>
                                @endcan
                            </li>
                            <li class="breadcrumb-item text-muted">
                                @can('users.create')
                                <a href="" class="text-muted">{{__('dashboard.Create User')}}</a>
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
                                    <h3 class="card-label font-weight-bolder text-dark">{{__('dashboard.Create User')}}</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">{{__('dashboard.Create user account settings')}}</span>
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <form class="form" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
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

                                            <input  class="form-control form-control-lg form-control-solid" type="text" placeholder="{{__('dashboard.Name')}}" name="name"/>

                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Email')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">

                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="email" placeholder="{{__('dashboard.Email')}}"/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.phone')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="mobile" placeholder="{{__('dashboard.phone')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.country')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="country_id"
                                                    class="form-control form-control-lg form-control-solid">
                                                @foreach(\App\Models\Country::get() as $country)
                                                    <option
                                                        value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.city')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="city" placeholder="{{__('dashboard.city')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.address')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <input  type="text" class="form-control form-control-lg form-control-solid" name="address" placeholder="{{__('dashboard.address')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.verified')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="verified_status"
                                                    class="form-control form-control-lg form-control-solid">
                                                <option value="0">{{__('dashboard.no')}}</option>
                                                <option value="1">{{__('dashboard.yes')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="display: none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">lat</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                   name="lat" id="lat" required/>

                                        </div>
                                    </div>

                                    <div class="form-group row" style="display: none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">lng</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                   name="lng" id="lng" required/>

                                        </div>
                                    </div>

                                    <div class="form-group row" style="display: none">
                                        <label class="col-xl-3 col-lg-3 col-form-label">radius</label>
                                        <div class="col-lg-9 col-xl-6">

                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                   name="radius" id="radius" required/>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.location')}}</label>
                                        <div id="map" style="height: 400px;width: 800px;"></div>
                                    </div>
                                    <script>
                                        function initMap() {
                                            var canvas = document.getElementById('map');
                                            var myLatlng = new google.maps.LatLng(30.033333, 31.233334);

                                            var mapOptions = {
                                                zoom: 8,
                                                center: myLatlng,
                                                mapTypeId: google.maps.MapTypeId.ROADMAP
                                            };
                                            var map = new google.maps.Map(canvas, mapOptions);

                                            var circleOptions = {
                                                draggable: true,
                                                editable: true,
                                                strokeColor: '#001aff',
                                                strokeOpacity: 0.8,
                                                strokeWeight: 1,
                                                fillColor: '#001aff',
                                                fillOpacity: 0.15,
                                                map: map,
                                                center: myLatlng,
                                                radius: 10000
                                            };
                                            var circle = new google.maps.Circle(circleOptions);

                                            google.maps.event.addListener(circle, 'center_changed', update);
                                            google.maps.event.addListener(circle, 'radius_changed', update);

                                            function update() {
                                                //  var debug = document.getElementById("debug");
                                                var d = Math.pow(10,5);
                                                // debug.innerHTML = "lat: " + Math.round(circle.getCenter().lat()*d)/d + "<br>";
                                                // debug.innerHTML += "lng: " + Math.round(circle.getCenter().lng()*d)/d + "<br>";
                                                // debug.innerHTML += "radius: " + Math.round(circle.getRadius()) + " m<br>";
                                                //       $('#lat').val(Math.round(circle.getCenter().lat()*d)/d)
                                                //       $('#lng').val(Math.round(circle.getCenter().lng()*d)/d)
                                                let lat = Math.round(circle.getCenter().lat()*d)/d
                                                let lng = Math.round(circle.getCenter().lng()*d)/d
                                                let radius = Math.round(circle.getRadius())
                                                $('#lat').val(lat)
                                                $('#lng').val(lng)
                                                $('#radius').val(radius)
                                            }

                                            update();

                                        }

                                    </script>
                                    <div class="form-group row">
                                        <label
                                            class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.is active')}}</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select name="status"
                                                    class="form-control form-control-lg form-control-solid">
                                                <option value="0">{{__('dashboard.no')}}</option>
                                                <option value="1">{{__('dashboard.yes')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--begin::Form Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">{{__('dashboard.Image')}}</label>
                                        <div class="col-lg-9 col-xl-6">
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
