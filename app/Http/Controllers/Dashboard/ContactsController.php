<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $contacts = ContactUs::pluck('id');
        return view('pages.contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
        Toastr::success('تم حذف رسالة الاتصال بنجاح!', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dataTable()
    {
        $contacts = ContactUs::all();
        return DataTables::of($contacts)
            ->editColumn('name', function ($model) {
                if (isset($model->user->name)) {
                    return $model->user->name;
                } else {
                    return "user not found";
                }
            })
            ->editColumn('email', function ($model) {
                if (isset($model->user->email)) {
                    return $model->user->email;
                } else {
                    return "email not found";
                }
            })
            ->editColumn('control', function ($model) {
                $all = '<p class="fControllers"><a onClick="return confirm(\'Are You Sure You Want To Delete This Record ?  \')"  data-toggle="tooltip" data-skin-class="tooltip-danger"  data-placement="top" href = "' . url('admin/contacts/' . $model->id . '/delete') . '"  class="btn btn-sm btn-outline-danger controllerCustom" style="margin:0 10px"><i class="fas fa-trash"></i></a></p>';
                $all .= '<p class="fControllers"><a data-toggle="tooltip" data-skin-class="tooltip-primary"  data-placement="top"  href = "' . url('admin/contacts/' . $model->id . '/reply') . '"   class="btn btn-sm btn-outline-primary controllerCustom"><i class="fas fa-reply"></i></a> ';
                $all .= '<a type="button" class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal' . $model->id . '"><i class="fas fa-envelope"></i></a>
                <div class="modal fade" id="exampleModal' . $model->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel' . $model->id . '">Message show</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   <form method="post" action="' . route('contacts.read', $model->id) . '">
     <input type="hidden" name="_token" value=" ' . csrf_token() . ' ">
      <div class="modal-body">
       ' . $model->user_message . '
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
';
                return $all;
            })
            ->rawColumns(['name', 'email', 'control'])->make(true);
    }

    public function read($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->read = 1;
        $contact->save();
        Toastr::success('تم قراءة الرسالة بنجاح', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function replyForm($id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('pages.contacts.reply', compact('contact'));
    }

    public function storeReply(Request $request, $id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->admin_id = Auth::guard('admin')->user()->id;
        $contact->admin_message = $request->admin_message;
        $contact->save();
        $getphone = '2' . substr($contact->user->mobile, 3);
        $user = User::where('id', $contact->user_id)->first();
        if ($request->send_by == 'sms') {
            _fireSMS($getphone, $request->admin_message);
        }
        if($request->send_by == 'gmail') {
            $data = array('name' => $contact->user->name, 'message' => $request->admin_message);
            Mail::send('mail', $data, function ($message) use ($user) {
                $message->to($user->email)->subject
                ('Reply message');
                $message->from('int412@yahoo.com', 'Slahly w shatably Application');
            });
        }
    }
}
