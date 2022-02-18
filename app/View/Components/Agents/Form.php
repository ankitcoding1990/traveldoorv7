<?php

namespace App\View\Components\Agents;

use Illuminate\View\Component;
use App\Models\Countries;
use App\Models\Cities;
use  App\Models\Currency;
use App\User;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $countries;
    public $countries_operation;
    public $currency;
    public $users;
    public $agent;
    public $cities;
    public $isAdmin;
    public function __construct($agent = null,  $isAdmin = false )
    {
      $this->isAdmin = $isAdmin;
      $this->countries = Countries::get();
      $this->countries_operation = Countries::get();
      $this->currency = Currency::get();
      $this->users = User::ActiveUsers()->get();
      $this->agent = $agent;
      if ($this->agent != null) {
          $this->cities = Cities::join("states","states.id","=","cities.state_id")->where("states.country_id", $agent->agent_country)->select("cities.*")->orderBy('cities.name','asc')->get();
      }else{
          $this->cities = collect([]);
      }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.agents.form');
    }
}
