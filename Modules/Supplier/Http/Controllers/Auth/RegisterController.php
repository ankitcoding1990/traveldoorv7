<?php

namespace Modules\Supplier\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Supplier;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\SupplierManagementService;
use Modules\Supplier\Http\Requests\SupplierValidation;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $SupplierManagementService;
    public function __construct(SupplierManagementService $SupplierManagementService)
    {
        $this->SupplierManagementService = $SupplierManagementService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return true;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(SupplierValidation $req)
    {
        $message = $this->SupplierManagementService->store($req);
        if($message['type'] == 'success') {
            event(new \App\Events\SendMail($message));
            return $message;
        } else {
            return $message;
        }
    }

    public function showRegistrationForm()
    {
        $users = User::whereNotNull('users_role')->pluck('name','id');
        return view('supplier::auth.register',compact('users'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'company_contact' => 'required', 
            'address' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'operating_weekdays' => 'required',
            'operating_weekdays.*' => 'required',
            'opr_currency' => 'required|array',
            'opr_countries' => 'required|array',
        ]);
        $message = $this->SupplierManagementService->update($request,$id);
        if($message['status']) {
            return ['status' => true, 'message' => 'Record Updated', 'redirect' => '/supplier/profile', 'type' => 'success'];
        }
    }
}
