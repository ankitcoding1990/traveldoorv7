<?php

namespace Modules\Agent\Http\Controllers\Profile;

use Exception;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\AgentBankDetail;
use App\Repositories\AgentManagementRepository;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(AgentManagementRepository $agentManagementRepo)
    {
        $this->agentManagementRepo = $agentManagementRepo;
    }
    public function index()
    {
        return view('agent::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id)
    {
        $agent = Agent::find($id);
        $html = view('agent::pages.profile.banks.bank-form', compact('agent'));
        return response(['html' => $html->render()], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, $agentId)
    {
        $request->validate([
            'bank_account_number'   =>  'required',
            'bank_name' =>  'required',
            'bank_ifsc' =>  'required', 
            'bank_iban' => 'required',
            'bank_currency_id' => 'required'
        ]);
        $bankData = [
            'agent_id' => $agentId,
            'account_number' => $request->bank_account_number,
            'name' => $request->bank_name,
            'ifsc' => $request->bank_ifsc,
            'iban' => $request->bank_iban,
            'currency_id' => $request->bank_currency_id
        ];
        $bankInsert = $this->agentManagementRepo->storeBankDetail($bankData);
       return $bankInsert;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('agent::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $bank = AgentBankDetail::find($id);
            if($bank){
                $html = view('agent::pages.profile.banks.bank-form', compact('bank'));
                return response(['html' => $html->render()], 200);
            }
            throw new Exception("Bank Detail Not Found", 1);
            
        } catch (\Exception $e) {
            return response(['html' => $e], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'bank_account_number'   =>  'required',
            'bank_name' =>  'required',
            'bank_ifsc' =>  'required', 
            'bank_iban' => 'required',
            'bank_currency_id' => 'required'
        ]);
        $bankData = [
            'account_number' => $request->bank_account_number,
            'name' => $request->bank_name,
            'ifsc' => $request->bank_ifsc,
            'iban' => $request->bank_iban,
            'currency_id' => $request->bank_currency_id
        ];
        $bankUpdate = $this->agentManagementRepo->storeBankDetail($bankData,$id);
        return $bankUpdate;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
