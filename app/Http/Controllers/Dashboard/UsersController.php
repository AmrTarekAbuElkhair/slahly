<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Neighborhood;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNull('type_id')->pluck('id');
        return view('pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data= $request->validated();
        $data['password']=Hash::make($request->password);
        User::create($data);
        Toastr::success('تم انشاء حساب جديد للمستخدم!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        return view('pages.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $ns=User::where('id',$id)->get();
       return view('pages.users.edit',compact('user','ns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->mobile=$request->mobile;
        $user->country_id=$request->country_id;
        $user->city=$request->city;
        $user->address=$request->address;
        $user->verified_status=$request->verified_status;
        $user->status=$request->status;
        $user->image=$request->image;
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (isset($request->lat)){
        $user->lat=$request->lat;
        }
        if (isset($request->lng)){
        $user->lng=$request->lng;
        }
        $user->save();
        Toastr::success('تم تعديل بيانات المستخدم بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        Toastr::success('!تم حذف هذا المستخدم بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('users.index');

    }
    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
    public function dataTable()
    {
        $users = User::whereNull('type_id')->get();
        return DataTables::of($users)
            ->editColumn('status', function ($model) {
                if($model->status==1)
                    $all =  'activated';
                else
                    $all = 'deactivated';
                return $all;
            })
            ->editColumn('country', function ($model) {
                return $model->country->name;
            })
            ->editColumn('status', function ($model) {
                if($model->status==1)
                    $all =  'activated';
                else
                    $all = 'deactivated';
                return $all;
            })
            ->addColumn('select',function ($row){
                return '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" value="'.$row->id.'" id="'.$row->id.'ch"/>
                                        <span></span>
                                    </label>';
            })
           ->editColumn('control', function ($model) {

                $all  = '<P class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top"  href = "' . url('admin/users/' . $model->id . '/show') . '"   class="btn btn-sm btn-outline-primary controllerCustom"><i class="fas fa-eye"></i></a> ';
                if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حساب هذا المستخدم ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('users.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حساب هذا المستخدم ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('users.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all  .= '<a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/users/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom" style="margin-right:10px;margin-top: 10px"><i class="fas fa-edit"></i></a> ';

                $all .= '<a onClick="return confirm(\'هل تريد حذف حساب هذا المستخدم ؟  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/users/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin-left: -9px;margin-top: 10px;"><i class="fas fa-trash"></i></a></P>';



                return $all;
           })
            ->rawColumns(['select','status','control'])->make(true);
    }
    public function activate($id)
    {
        $user=User::findOrFail($id);
        $user->status = 1;
        $user->save();
        Toastr::success('تم تعديل حالة المستخدم بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $user=User::findOrFail($id);
        $user->status = 0;
        $user->save();
        Toastr::success('تم تعديل حالة المستخدم بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deleteAll()
    {
        foreach (User::whereNull('type_id')->get() as $user) {
            $user->delete();
        }
        Toastr::success('تم حذف كل المستخدمين بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
