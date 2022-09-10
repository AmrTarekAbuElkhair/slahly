<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstructionRequest;
use App\Models\Instruction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InstructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.instructions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.instructions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructionRequest $request)
    {
        $data=$request->validated();
        Instruction::create($data);
        Toastr::success('تم اضافة تعليمات بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('instructions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instruction=Instruction::findOrFail($id);
        return view('pages.instructions.edit',compact('instruction'));
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
        $instruction=Instruction::findOrFail($id);
        $data = [
            'en' => [
                'text'       => $request->input('en_text'),
            ],
            'ar' => [
                'text'       => $request->input('ar_text'),
            ],
            'status'=>$request->status,
        ];
        $instruction->update($data);
        Toastr::success('تم تعديل التعليمات بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('instructions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instruction=Instruction::findOrFail($id);
        $instruction->delete();
        Toastr::success('تم حذف التعليمات بنجاح!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
    public function dataTable()
    {
        $instructions = Instruction::all();
        return DataTables::of($instructions)
            ->editColumn('text', function ($model) {
                return $model->text;
            })
            ->editColumn('control', function ($model) {
                $all  = '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top" href = "' . url('admin/instructions/' . $model->id . '/edit') . '"   class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-edit"></i></a> ';
                  if($model->status==1)
                    $all .= '<a onClick="return confirm(\'هل تريد ايقاف حالة هذه التعليمات ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href="' . route('instructions.deactivate' , $model->id ) . '"  class="btn btn-sm btn-outline-danger controllerCustom"><i class="fas fa-ban"></i></a>';
                else{
                    $all .= '<a onClick="return confirm(\'هل تريد تنشيط حالة هذه التعليمات ؟\')" data-toggle="tooltip" data-skin-class="tooltip-danger" data-placement="top" href="' . route('instructions.activate' , $model->id ) . '"  class="btn btn-sm btn-outline-success controllerCustom"><i class="fas fa-check"></i></a>';
                }
                $all .= '<a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/instructions/' . $model->id . '/delete'). '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a></p>';
                return $all;
            })
            ->rawColumns(['control'])->make(true);
    }

             public function activate($id)
    {
        $instruction=Instruction::findOrFail($id);
        $instruction->status = 1;
        $instruction->save();
        Toastr::success('تم تعديل حالة التعليمات بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $instruction=Instruction::findOrFail($id);
        $instruction->status = 0;
        $instruction->save();
        Toastr::success('تم تعديل حالة التعليمات بنجاح','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
