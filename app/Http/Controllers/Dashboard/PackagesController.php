<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\CarType;
use App\Models\Package;
use App\Models\PackageCarType;
use App\Models\PackageCompany;
use App\Models\PackageService;
use App\Models\Service;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = User::where('type_id', 2)->get();
        return view('pages.packages.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $data = $request->validated();
        $package = Package::create($data);
        $providers_id = $request->provider_id;
        for ($i = 0; $i < count($providers_id); $i++) {
            PackageCompany::create(
                array(
                    'provider_id' => $providers_id[$i],
                    'package_id' => $package->id,
                )
            );
        }
        Toastr::success('تم اضافة الباقة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('packages.index');
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
        $providers = User::where('type_id', 2)->get();
        $package = Package::findOrFail($id);
        $packageProviders=PackageCompany::where('package_id',$package->id)->pluck('provider_id');
        return view('pages.packages.edit', compact('package', 'providers','packageProviders'));
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
        $package = Package::findOrFail($id);
        $data = [
            'en' => [
                'name' => $request->input('en.name'),
            ],
            'ar' => [
                'name' => $request->input('ar.name'),
            ],
            'status' => $request->status,
            'image' => $request->image,
            'price' => $request->price,
        ];
        $package->update($data);
        $providers_id = $request->provider_id;
        if (isset($providers_id)) {
            PackageCompany::where('package_id', $package->id)->delete();
            for ($i = 0; $i < count($providers_id); $i++) {
                PackageCompany::create(
                    array(
                        'provider_id' => $providers_id[$i],
                        'package_id' => $package->id,
                    )
                );
            }
        }
        Toastr::success('تم تعديل الباقة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        Toastr::success('تم حذف الباقة بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dataTable()
    {
        $packages = Package::all();
        return DataTables::of($packages)
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('control', function ($model) {
                $all = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/packages/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                if ($model->status == 1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذه الباقة ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('packages.deactivate', $model->id) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else {
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذه الباقة ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('packages.activate', $model->id) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'هل انت متأكد انك تريد حذف هذه الباقة ؟ \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placem= "Delete" href = "' . url('admin/packages/' . $model->id . '/delete') . '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a></p>';
                return $all;
            })
            ->rawColumns(['name', 'control'])->make(true);
    }

    public function activate($id)
    {
        $package = Package::findOrFail($id);
        $package->status = 1;
        $package->save();
        Toastr::success('تم تعديل حالة الباقة بنجاح', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $package = Package::findOrFail($id);
        $package->status = 0;
        $package->save();
        Toastr::success('تم تعديل حالة الباقة بنجاح', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
