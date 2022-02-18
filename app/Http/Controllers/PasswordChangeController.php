<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Contact;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Http\Requests\ContactsRequest;
use App\Services\PasswordChangeService;

class PasswordChangeController extends Controller
{
    protected $PasswordChangeService;
    function __construct(PasswordChangeService $PasswordChangeService){
      $this->PasswordChangeService = $PasswordChangeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactsRequest $request)
    {
        $res = $this->contactService->store($request);
        return response($res);
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
        $contact = Contact::find($id);
        $type = $contact->type;
        $agent = null;
        $supplier = null;
        if ($contact->type == 'agent') {
            $agent = $contact->agent;
        }
        if ($contact->type == 'supplier') {
            $supplier = $contact->supplier;
        }
        $html = view('common.contacts.form', compact('agent','supplier','type', 'contact'));
        return response(['html' => $html->render()], 200);

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
      if($request->has('admin')) {
        $request->validate([
          'password' => 'required|min:6|confirmed',
        ]);
      } else {
        $request->validate([
          'oldPassword' => 'required',
          'password' => 'required|min:6|confirmed',
        ]);
      }

      if($request->type == 'supplier') {
        if (auth()->guard('supplier')->user()) {
          $user = auth()->guard('supplier')->user();
        } else {
          $user = Supplier::where('id',$id)->firstOrFail();
        }
      } else if($request->type == 'agent') {
        if (auth()->guard('agent')->user()) {
          $user = auth()->guard('agent')->user();
        } else {
          $user = Agent::where('id',$id)->firstOrFail();
        }
      }

      if($user) {
        if (Hash::check($request->password, $user->password)) {
          return response(['message' => 'New Password Cannot be same as Old Password.'],500);
        }
      }

      $res = $this->PasswordChangeService->update($request, $id);
      return response($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $res = $this->contactService->delete($id);
      return response($res);
    }
}
