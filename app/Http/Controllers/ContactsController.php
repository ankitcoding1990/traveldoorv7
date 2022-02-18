<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Supplier;
use App\Models\Contact;
use App\Services\ContactsService;
use App\Http\Requests\ContactsRequest;


class ContactsController extends Controller
{
    protected $contactService;
    function __construct(ContactsService $contactService){
      $this->contactService = $contactService;
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
      $agent = null;
      $supplier = null;
      $type = request()->get('type');
      if ($type) {
        if ($type == 'agent') {
          $agent = Agent::find(request()->get('model_id'));
        }
        if ($type == 'supplier') {
          $supplier = Supplier::find(request()->get('model_id'));
        }
      }
      $html = view('common.contacts.form', compact('agent','supplier','type'));
      return response(['html' => $html->render()], 200);
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
    public function update(ContactsRequest $request, $id)
    {
      $res = $this->contactService->update($request, $id);
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
