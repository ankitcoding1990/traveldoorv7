<?php

namespace App\View\Components\Agents;

use App\User;
use App\Models\Cities;
use App\Models\Currency;
use App\Models\Countries;
use Illuminate\View\Component;

class ProfileIndex extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $services;
    public $contactPerson;
    public $country;
    public $city;
    public $oprCountries;
    public $oprCurrency;
    public $agent;
    public $isAgent;
    public function __construct($agent, $isAgent = null )
    {
        $this->agent = $agent;
        $this->services = $agent->services;
        $this->contactPerson = $agent->contactPerson;
        $this->country = $agent->country;
        $this->city = $agent->city;
        $this->oprCountries = $agent->operateCountries();
        $this->oprCurrency = $agent->operateCurrency();
        $this->isAgent = $isAgent;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.agents.profile-index');
    }
}
