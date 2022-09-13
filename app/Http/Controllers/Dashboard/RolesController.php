<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('pages.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
        Toastr::success('role added successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('roles.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();
        return view('pages.role.edit',compact('role','rolePermissions','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $role=Role::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        if($role->type!='fixed'){
            $role->update($request->only('name'));
            $role->syncPermissions($request->get('permission'));
        }
        Toastr::success('role updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        Toastr::success('role deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function dataTable()
    {
        $cities = Role::where('guard_name' , '!=' , 'web')->get();
        return DataTables::of($cities)
            ->editColumn('control', function ($model) {
                $all  = '<a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" title = "Edit" href = "' . url('admin/roles/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a> ';
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" title = "Delete" href = "' . url('admin/roles/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger" style="margin:0 10px"><i class="fas fa-trash"></i></a>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }

}
