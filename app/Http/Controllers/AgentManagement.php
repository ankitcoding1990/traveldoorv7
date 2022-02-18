<?php

namespace App\Http\Controllers;
use App\Users;
use App\Models\Countries;
use App\Models\Cities;
use App\Currency;
use App\UserRights;

use App\Agents_log;
use App\Suppliers;
use App\Activities;
use App\Transport;
use App\Hotels;
use App\AgentWallet;
use App\DataTables\AgentDataDatatables;
use App\SavedItinerary;
use Session;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMailable;
use App\Services\AgentManagementService;
use App\Http\Requests\AgentManagementRequest;

use App\Models\Agent;

class AgentManagement extends Controller
{
    protected $agentManagementService;
    protected $agentRoute;
    public function __construct(AgentManagementService $agentManagementService)
    {
        $this->agentManagementService = $agentManagementService;
        date_default_timezone_set('Asia/Dubai');
        $this->routeName = 'agents.index';

    }


   public function index(AgentDataDatatables $datatables)
   {
        $routeName = $this->routeName;
        $agents = Agent::get();
        $agents = Agent::where('created_user_id',auth()->id())->get();
        return $datatables->render('mains.agents.index', compact('agents','routeName'));
   }
    public function create(Request $request)
    {
        if (auth()->user()->hasAddPermission($this->agentRoute)) {
            return view('mains.agents.create')->with(['agentRoute' => $this->agentRoute]);
        }
        return abort(403,'Have no permission');

    }
    public function ValidateRequest($request){
        return $request->validate([
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
    }
    public function store(Request $request)
    {
       $this->ValidateRequest($request);
        $res = $this->agentManagementService->store($request);
        return $res;
    }
    public function edit($id)
    {
        // /dd($id);
       $id = decrypt($id);
        $agent  = Agent::where('id',$id)->firstOrFail();
        return view('mains.agents.create',compact('agent'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->ValidateRequest($request);
        $return = $this->agentManagementService->update($request,$id);
        return $return;
    }
    public function agent_details($agent_id)
    {
         if(session()->has('travel_users_id'))
        {
             $rights=$this->rights('agent-management');
            $currency=Currency::get();
            $countries=Countries::get();
            $emp_id=session()->get('travel_users_id');
             if(strpos($rights['admin_which'],'view')!==false)
            {
                $get_agent=Agents::where('agent_id',$agent_id)->first();
            }
            else
            {
                $get_agent=Agents::where('agent_id',$agent_id)->where('agent_created_by',$emp_id)->first();
            }
            $agent_id=base64_encode(base64_encode($agent_id));
            if($get_agent)
            {
                return view('mains.agents.show')->with(compact('get_agent','countries','currency','rights'))->with('agent_id',$agent_id);
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->route('index');
        }
    }

    public function show($id)
    {
       
        $id = decrypt($id);
        $agent = Agent::where('id',$id)->firstOrFail();
        if($agent) {
            return view('mains.agents.profile.profile',compact('id','agent'));
        }
    }
    public function update_agent_active_inactive(Request $request)
    {
        $message = $this->agentManagementService->statechanger($request->id);
        if($message['type'] == 'success') {
            event(new \App\Events\SendMail($message));
            return $message;
        } else {
            return $message;
        }
    }
    public function bankIndex($id){
       $id  = decrypt($id);
       if($id){
           $agent = Agent::where('id', $id)->firstOrFail();
           return view('mains.agents.profile.banks',compact('agent','id'));
       }
    }
    public function servicesIndex($id){
        $id = decrypt($id);
        if($id){
            $agent = Agent::findOrFail($id);
            return view('mains.agents.profile.services', compact('agent', 'id'));
        }
    }
    public function contactsIndex($id){
        $id = decrypt($id);
        if($id){
            $agent = Agent::findOrFail($id);
            return view('mains.agents.profile.contactpersons', compact('agent', 'id'));
        }
    }
    // public function passwordIndex($id){
    //     $id = decrypt($id);
    //     if($id){
    //         $agent = Agent::findOrFail($id);
    //         return view('mains.agents.profile.password', compact('agent', 'id'));
    //     }
    // }
    public function agent_home(Request $request)
    {
         if(session()->has('travel_agent_id'))
          {

            $countries=Countries::get();
            $cities=Cities::get();
            $agent_id=session()->get('travel_agent_id');
            $get_itinerary=SavedItinerary::where('itinerary_status',1)->paginate(9);
            $get_activities=Activities::where('activity_status',1)->paginate(9);
            $get_transport=Transport::where('transfer_status',1)->paginate(9);
            $get_hotels=Hotels::where('hotel_status',1)->paginate(9);


           return view('agent.home')->with(compact('countries','cities','agent_id','get_itinerary','get_activities','get_transport','get_hotels'));
        }
        else
        {
         return redirect()->route('/agent');
        }
    }

    public function changePasswordIndex($id)
{
    //dd('change Password');
    $id = decrypt($id);
    if($id) {
        return view('mains.agents.password',compact('id'));
    }

}



 public function agents_wallet(Request $request)
    {
    if(session()->has('travel_users_id'))
    {
     $rights=$this->rights('agents-wallet');

      $agents=Agents::orderBy('agent_status','desc')->orderBy('agent_id','desc')->get();
      $agents_wallet_data=array();
      $count=0;
     foreach($agents as $agent)
     {

      $agents_wallet_data[$count]['agent_id']=$agent->agent_id;
      $agents_wallet_data[$count]['agent_fullname']=$agent->agent_name;
      $agents_wallet_data[$count]['agent_company']=$agent->company_name;
      $agents_wallet_data[$count]['agent_status']=$agent->agent_status;

        $get_commission_total=AgentWallet::select(\DB::raw("(COALESCE(sum(age_wallet_credit_amount), 0)-COALESCE(sum(age_wallet_debit_amount), 0)) as total_wallet_amount"))->where('age_wallet_agent_id',$agent->agent_id)->where('age_wallet_status',1)->groupBy('age_wallet_agent_id')->first();


    if(!empty($get_commission_total))
    {
    $agents_wallet_data[$count]['agent_total_wallet_amount']="GEL ".$get_commission_total->total_wallet_amount;
    }
    else
    {
     $agents_wallet_data[$count]['agent_total_wallet_amount']="GEL 0";
    }

    $count++;

     }
    return view('mains.my-wallet-agents')->with(compact('rights','agents_wallet_data'));

  }
  else
  {
    return redirect()->route('index');
  }


    }

    public function own_wallet_agent(Request $request)
    {
       if(session()->has('travel_users_id'))
       {
        $agent_id=$request->get('agent_id');
            $rights=$this->rights('agents-wallet');
                $withdaw_yes="1";
            $month_numeric=date('m');
            $yearname=date('Y');
             $get_wallet=AgentWallet::where('age_wallet_agent_id',$agent_id)->orderBy('age_wallet_id','desc')->paginate(10);
            $get_commission_total=AgentWallet::select(\DB::raw("(COALESCE(sum(age_wallet_credit_amount), 0)-COALESCE(sum(age_wallet_debit_amount), 0)) as total_wallet_amount"))->where('age_wallet_agent_id',$agent_id)->where('age_wallet_status',1)->groupBy('age_wallet_agent_id')->first();

            $get_commission_total_withdraw=AgentWallet::select(\DB::raw("(COALESCE(sum(age_wallet_credit_amount), 0)-COALESCE(sum(age_wallet_debit_amount), 0)) as total_wallet_amount"))->where('age_wallet_agent_id',$agent_id)->where('age_wallet_status','!=',2)->groupBy('age_wallet_agent_id')->first();

             $get_commission_all=AgentWallet::select(\DB::raw("(COALESCE(sum(age_wallet_credit_amount), 0)) as amount_credited"),\DB::raw("(COALESCE(sum(age_wallet_debit_amount), 0)) as amount_withdrawn"))->where('age_wallet_agent_id',$agent_id)->where('age_wallet_status',1)->groupBy('age_wallet_agent_id')->first();
                 $get_commission_month=AgentWallet::select(\DB::raw("(COALESCE(sum(age_wallet_credit_amount), 0)) as amount_credited"),\DB::raw("(COALESCE(sum(age_wallet_debit_amount), 0)) as amount_withdrawn"))->where('age_wallet_agent_id',$agent_id)->where('age_wallet_month',$month_numeric)->where('age_wallet_year',$yearname)->where('age_wallet_status',1)->groupBy('age_wallet_agent_id')->first();

            if(!empty($get_commission_total))
                $total_amount=$get_commission_total->total_wallet_amount;
            else
               $total_amount=0;

               if(!empty($get_commission_total_withdraw))
                $total_amount_withdraw=$get_commission_total_withdraw->total_wallet_amount;
            else
               $total_amount_withdraw=0;

              if(!empty($get_commission_all))
             {
                $total_amount_credited_all=$get_commission_all->amount_credited;
                $total_amount_withdrawn_all=$get_commission_all->amount_withdrawn;
            }
            else
            {
                $total_amount_credited_all=0;
                $total_amount_withdrawn_all=0;
            }

             if(!empty($get_commission_month))
             {
                $total_amount_credited_month=$get_commission_month->amount_credited;
                $total_amount_withdrawn_month=$get_commission_month->amount_withdrawn;
            }
            else
            {
                $total_amount_credited_month=0;
                $total_amount_withdrawn_month=0;
            }





        return view('mains.my-wallet-own-agent')->with(compact('rights','get_wallet','total_amount','total_amount_credited_all','total_amount_withdrawn_all','total_amount_credited_month','total_amount_withdrawn_month','total_amount_withdraw'));
    }
    else
    {
        return redirect()->route('index');
    }
}


public function agents_operation(Request $request)
{
  $agent_id=$request->get('action_id');
  $operation=$request->get('operation');
  $operation_remarks=$request->get('remarks');
  $operation_amount=$request->get('operation_amount');

  if($operation=="credit" || $operation=="debit")
  {
    $operation_performed="";
          $insert_age_wallet=new AgentWallet;
          $insert_age_wallet->age_wallet_agent_id=$agent_id;
          if($operation=="credit")
          {
             $insert_age_wallet->age_wallet_credit_amount=round($operation_amount);
             $insert_age_wallet->age_wallet_remarks="Money Added";
             $operation_performed='credited';
          }
          else
          {
             $insert_age_wallet->age_wallet_debit_amount=round($operation_amount);
             $insert_age_wallet->age_wallet_remarks="Money Deducted";
             $operation_performed='debited';
          }

          $insert_age_wallet->age_wallet_date=date('Y-m-d');
          $insert_age_wallet->age_wallet_time=date('H:i:s');
          $insert_age_wallet->age_wallet_approve_reject_remarks=$operation_remarks;
          if($insert_age_wallet->save())
          {

            //SEND EMAIL TO AGENT
           $payment_amount=$operation_amount;
           $fetch_agent=Agents::where('agent_id',$agent_id)->first();

           $data = array(
              'name' => $fetch_agent->agent_name,
              'email' =>$fetch_agent->company_email
          );
           if($operation=="credit")
           {
             $htmldata='<p>Dear '.$fetch_agent->agent_name.',</p><p>Congratulations!</p><p>Traveldoor admin has successfully '.$operation_performed.' <b>GEL '.$payment_amount.'</b> into your wallet.</p>
           ';
             Mail::send('email.htmldata', ['htmldata' => $htmldata], function ($m) use ($data) {
              $m->from(config('mail.from.address'), config('mail.from.name'));
              $m->to($data['email'], $data['name'])->subject('MONEY ADDED INTO WALLET');
          });
         }
         else
         {
             $htmldata='<p>Dear '.$fetch_agent->agent_name.',</p><p>Congratulations!</p><p>Traveldoor admin has successfully '.$operation_performed.' <b>GEL '.$payment_amount.'</b> from your wallet.</p>
           ';
           Mail::send('email.htmldata', ['htmldata' => $htmldata], function ($m) use ($data) {
              $m->from(config('mail.from.address'), config('mail.from.name'));
              $m->to($data['email'], $data['name'])->subject('MONEY DEBITED FROM WALLET');
          });

       }

            //SEND EMAIL TO ADMIN
       $fetch_admin=Users::where('users_pid',0)->first();

       $data_admin= array(
          'name' => $fetch_admin->users_fname." ".$fetch_admin->users_lname,
        //   'email' =>$fetch_admin->users_email
        'email'=> [$fetch_admin->users_email,'operations@traveldoor.ge', 'reservation@traveldoor.ge']
      );
       if($operation=="credit")
       {
         $htmldata='<p>Dear Admin,</p><p>You have successfully '.$operation_performed.' <b>GEL '.$payment_amount.'</b> from agent '.$fetch_agent->agent_name.' \'s wallet. </p>';
         Mail::send('email.htmldata', ['htmldata' => $htmldata], function ($m) use ($data_admin) {
          $m->from(config('mail.from.address'), config('mail.from.name'));
          $m->to($data_admin['email'], $data_admin['name'])->subject('MONEY ADDED TO WALLET');
      });
     }
     else
     {
         $htmldata='<p>Dear Admin,</p><p>You have successfully '.$operation_performed.' <b>GEL '.$payment_amount.'</b> from agent '.$fetch_agent->agent_name.' \'s wallet. </p>';
      Mail::send('email.htmldata', ['htmldata' => $htmldata], function ($m) use ($data_admin) {
          $m->from(config('mail.from.address'), config('mail.from.name'));
          $m->to($data_admin['email'], $data_admin['name'])->subject('MONEY DEBITED FROM WALLET');
      });

  }


             $get_commission_total=AgentWallet::select(\DB::raw("(COALESCE(sum(age_wallet_credit_amount), 0)-COALESCE(sum(age_wallet_debit_amount), 0)) as total_wallet_amount"))->where('age_wallet_agent_id',$agent_id)->where('age_wallet_status',1)->groupBy('age_wallet_agent_id')->first();

               if(!empty($get_commission_total))
                $total_amount="GEL ".$get_commission_total->total_wallet_amount;
            else
               $total_amount="GEL 0";

            echo "success_".$total_amount;
          }
          else
          {
            echo "fail";
          }

  }
  else
  {
    echo "fail";
  }





}

}
