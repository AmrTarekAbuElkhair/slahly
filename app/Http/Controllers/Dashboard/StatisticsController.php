<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Package;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        $admins=Admin::where('id', '!=', Auth::guard('admin')->user()->id)->with('roles')->count();
        $users=User::whereNull('type_id')->count();
        $providers=User::whereNotNull('type_id')->count();
        $services=Service::count();
        $orders=Order::whereNotNull('provider_id')->count();
        $ordersManagement=Order::whereNull('provider_id')->count();
        $countries=Country::count();
        $offers=Offer::count();
        $packages=Package::count();
        return view('pages.home.dashboard',compact('users','providers','services','orders'
        ,'countries','offers','packages','ordersManagement','admins'));
    }
}
