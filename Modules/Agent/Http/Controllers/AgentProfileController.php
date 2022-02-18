<?php

namespace Modules\Agent\Http\Controllers;

use Exception;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use App\Repositories\AgentManagementRepository;

class AgentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
   
    public function index()
    {
      $agent = auth()->guard('agent')->user();
        return view('agent::pages.profile.index', compact('agent'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('agent::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $id = decrypt($id);
        $agent = Agent::findOrFail($id);
        return view('agent::pages.profile.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
       $id = decrypt($id);
     try {
        $agent = Agent::find($id);
         if($agent){
        
             return view('agent::profile', compact('agent'));
            //  $html = view('agent::profile', compact('agent'));
             //return response(['html' => $html->render()], 200);    
         }
         throw new Exception("Agent Details not found", 1);
         
     } catch (\Exception $e) {
         return $e->getMessage();
     }
        //return view('agent::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
       
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
    function banks($id){
      $id = decrypt($id);
      $agent = Agent::findOrFail($id);
      return view('agent::pages.profile.banks', compact('agent'));
    }
    function contacts($id){
      $id = decrypt($id);
      $agent = Agent::findOrFail($id);
      return view('agent::pages.profile.contacts', compact('agent'));
    }
    function services($id){
        
    $id = decrypt($id);
    $agent = Agent::findOrFail($id);
    return view('agent::pages.profile.services', compact('agent'));
    }
    function password($id){
        $id = decrypt($id);
        $agent = Agent::findOrFail($id);
        return view('agent::pages.profile.password', compact('agent'));
    }

}
