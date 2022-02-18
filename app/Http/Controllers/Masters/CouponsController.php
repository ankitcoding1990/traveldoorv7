<?php

namespace App\Http\Controllers\Masters;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Services\CouponService;
use App\DataTables\CouponsDatatable;
use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $routeName;
    public function __construct(CouponService $service)
    {
        $this->service = $service;
        $this->routeName = 'coupon.index';
    }
    public function index(CouponsDatatable $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)) {
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.coupon.index',compact('routeName'));
        } else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.coupon.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generateCouponCode(Request $request)
    {
        $coupan_name = $request->get('data');
        $code = "TD".substr($coupan_name,0,2).rand(1111,9999);
        $coupan_code = strtoupper($code);
        return $coupan_code;
    }
    public function create()
    {
        return view('mains.masters.coupon.create');
    }

    public function changeState(Request $request)
    {
        $message = $this->service->statechanger($request->id);
        return $message;
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
            'coupan_type' => 'required',
            'coupan_name' => 'required',
            'no_of_person' => 'required|numeric',
            'min_value' => 'required|numeric',
            'coupan_validity_from' => 'required|date',
            'coupan_validity_to' => 'required|date|after_or_equal:coupan_validity_from',
            'coupan_amount_type' => 'required',
            'coupan_amount' => 'required|numeric',
            'coupan_code' => 'required',
        ]);

        $message = $this->service->store($request);
        session()->flash('status', $message);
        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = Coupon::Where('id',$id)->firstOrFail();
        return view('mains.masters.coupon.details',compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::where('id',$id)->firstOrFail();
        return View('mains.masters.coupon.create',compact('coupon'));
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
            'coupan_type' => 'required',
            'coupan_name' => 'required',
            'no_of_person' => 'required|numeric',
            'min_value' => 'required|numeric',
            'coupan_validity_from' => 'required',
            'coupan_validity_to' => 'required',
            'coupan_amount_type' => 'required',
            'coupan_amount' => 'required|numeric',
            'coupan_code' => 'required',
        ]);

        $message = $this->service->store($request);
        session()->flash('status', $message);
        return redirect()->route('coupon.index');
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
