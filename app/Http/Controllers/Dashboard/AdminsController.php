<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminsController extends Controller
{
    public function login_form()
    {
        return view('login.login');

    }

    public function login(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard.index');
        } else {
            Toastr::error('The email or password is incorrect', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function profileIndex()
    {
        return view('pages.admins.profile')->with('admin', Auth::guard('admin'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = Admin::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $request->image;
        if ($user->password != $request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($user->save()) {
            Toastr::success('Your Profile has been updated successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return back();
        }
        Toastr::error('Sorry! Something went wrong.', 'False', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allroles = Role::where('guard_name', 'admin')->get();
        return view('pages.admins.create', compact('allroles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        if (isset($request->image)) {
            $data['image'] = $request->image;
        }
        $admin = Admin::create($data);
        $admin->assignRole($request->role);
        \Brian2694\Toastr\Facades\Toastr::success('The admin account has been created successfully!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin['roles'] = DB::table('model_has_roles')->where('model_id', $id)
            ->where('model_type', 'App\Models\Admin')->
            select('role_id')->pluck('role_id');
        $allroles = Role::where('guard_name', 'admin')->get();
        return view('pages.admins.edit', compact('allroles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->image = $request->image;
        if ($admin->password != $request->password) {
            $admin->password = Hash::make($request->password);
        }
        if (isset($request->role)) {
            $admin->roles()->sync($request->role);
        }
        $admin->save();
        Toastr::success('The admin account has been updated successfully!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin->delete();
        Toastr::success('The admin account has been deleted successfully!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dataTable()
    {
        $admins = Admin::where('id', '!=', Auth::guard('admin')->user()->id)->with('roles')->get();
        return DataTables::of($admins)
            ->editColumn('image', function ($admins) {
                return '<img src=' . asset("$admins->image") . ' border="0" width="40" class="img-rounded" align="center" style="margin-left:20px;"/>';
            })
            ->editColumn('control', function ($model) {
                $all = '<a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/admins/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a> ';
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/admins/' . $model->id . '/delete') . '"  class="btn btn-sm btn-outline-danger" style="margin:0 10px"><i class="fas fa-trash"></i></a>';
                return $all;
            })
            ->rawColumns(['control', 'image'])->make(true);
    }
}
