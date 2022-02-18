<?php

namespace Modules\Agent\Http\Controllers\Auth;

use Exception;
use App\Models\Agent;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function RestPassword(Request $request)
    {
        Validator::make($request->all(),[
            'password' => 'requiredconfirm',
            're_password' => 'required',
        ]);
        $email = PasswordReset::where('token',$request->email_token)->first();
        try{
            Agent::where('email',$email->email)->update(['password' => Hash::make($request->password),'password_hint' => $request->password]);
            DB::table('password_resets')->where('email',$email->email)->delete();
            return response(['status' => true, 'message' => 'Password Has Been Updated Successfully','redirect' => route('agent.login')],200);
        }
        catch (Exception $err){
            return response(['status' => false, 'message' => $err->getMessage()],200);
        }
        
    }
}
