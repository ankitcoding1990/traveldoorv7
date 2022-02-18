<?php

namespace Modules\Agent\Http\Controllers\Auth;

use App\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Agent\Http\Requests\AgentRequest;
use App\Services\AgentManagementService;

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
    // public $AgentManagementRepository;
    // public function __construct(AgentManagementRepository $AgentManagementRepository)
    // {
    //     $this->AgentManagementRepository = $AgentManagementRepository;
        
    // }
    public function __construct(AgentManagementService $agentService)
    {
        $this->agentService = $agentService;
        //$this->middleware('guest');
    }
    function showRegistrationForm(){
       
        return view('agent::auth.register');
    }
    public function create(Request $request) //AgentRequest
    {
        // dd($request->all());
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
            'opr_countries.*' => 'required|array',
        ]);
        $message = $this->agentService->store($request);
        return $message;
    }
    public function update(Request $request, $id)
    {
        //dd('ok');
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
            'opr_countries.*' => 'required|array',
        ]);
    //    $request->validate([
    //     'name' => 'required|string|max:255',
    //     'company_name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255',
    //     'company_email' => 'required|string|email|max:255',
    //     'company_contact' => 'required',
    //     'company_fax' => '',
    //     'address' => 'required',
    //     'country_id' => 'required',
    //     'city_id' => 'required',
    //     'corporate_reg_no' => 'required',
    //     'skype_id' => '',
    //     'corporate_desc' => '',
    //     'operating_hrs_from' => '',
    //     'operating_hrs_to' => '',
    //     'operating_weekdays.*' => 'required',
    //     'opr_currency.*' => 'required',
    //     'operate_country_id.*' => 'required',
    //    ]);
       $updateProfile = $this->agentService->update($request, $id);
        return $updateProfile;
    }
}
