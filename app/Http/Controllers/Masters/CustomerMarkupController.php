<?php

namespace App\Http\Controllers\Masters;

use App\Models\CustomerMarkup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Services\CustomerMarkupService;
use App\DataTables\CustomerMarkupDatatables;
use Illuminate\Contracts\Validation\Validator;

class CustomerMarkupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(CustomerMarkupService $service)
    {
        $this->service = $service;
        $this->routeName = 'customer_markup.index';
    }
    public function index(CustomerMarkupDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.customer_markup.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.customer_markup.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_markup' => 'required',
            Rule::unique('customer_markup')->where(function($query)use($request){
                return $query->where('customer_markup',$request->customer_markup);
            }),
            'customer_markup_cost' => 'required'
        ]);
        $count = CustomerMarkup::where('customer_markup',$request->customer_markup)->first();
        if($count){
            $message = ['Customer Markup Already Exists','error'];
        }
        else{
            $message = $this->service->store($request);
        }

        return $message;
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
        $routeName = $this->routeName;
        $customerMarkup = CustomerMarkup::where('id',$id)->firstOrFail();
        return view('mains.masters.customer_markup.index',compact('customerMarkup','routeName'));
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
        $request->validate([
            'customer_markup' => 'bail|required',
            Rule::unique('customer_markup')->where(function($query)use($request,$id){
                return $query->where('customer_markup',$request->customer_markup)->where('id','!=',$id);
            }),
            'customer_markup_cost' => 'bail|required'
        ]);

        $message = $this->service->store($request);
        session()->flash('status',$message);
        return redirect()->route('customer_markup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->service->delete($id);
        return $message;
    }
}
