<?php

namespace Modules\Agent\Http\Controllers\Auth;
use Carbon\Carbon;
use App\Models\Agent;
use App\Models\PasswordReset;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\AgentResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use SendsPasswordResetEmails;

    public function ForgetPassword()
    {
       return view('agent::auth.forgetpassword');
    }
    public function ForgetPasswordMail(Request $request)
    {
       $tokenFromMail = $request->get('token');
       $tokenFromDb = PasswordReset::where('token',$tokenFromMail)->firstOrFail();
        if($tokenFromDb){
            if(Carbon::now() <= $tokenFromDb->expire_at){
                return view('agent::auth.resetpassword',compact('tokenFromMail'));
            }
            
            abort(403, 'Page Expired');
        }
        else{
            return redirect()->route('agent.forget-password');
        }
    }
    public function reset(Request $request)
    {
        $this->validate($request, ['email'=>'required|email']);
        $email = $request->get('email');
        $random_text = time().'-'.(rand(0,99)*40);
        $token = Hash::make($random_text);
        $check_user = Agent::where('email', $email)->where('status',1)->first();
        if($check_user){        
            $data = [
                'title' => 'Forget Your Password?',
                'description'   =>  'We recevied a request to reset the password for your account.
                 To reset your password, click on the button below:',
                'url'   =>  route('agent.forget-password-mail').'/?token='.$token,
            ];  
            DB::table('password_resets')->insert(['email' => $check_user->email,'token' => $token,'created_at'=> Carbon::now(), 'expire_at' => Carbon::now()->addMinutes(10)]);
            //PasswordReset::create(['email' => $check_user->email,'token' => $token]);
            Mail::to($check_user->email)->send(new AgentResetPasswordMail($data));
            return response(['status' => true, 'message' => 'Password send to your register email Address'],200);
        }else{
            return response(['status' => false, 'message' => 'Email address not found in our record'],200);
        }  
    }
}
