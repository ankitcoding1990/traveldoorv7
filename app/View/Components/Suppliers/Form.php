<?php

namespace App\View\Components\Suppliers;

use App\User;
use App\Models\Cities;
use App\Models\Currency;
use App\Models\Countries;
use App\Models\Services;
use App\Models\OurService;
use Illuminate\View\Component;
use PHPUnit\Framework\Constraint\Count;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */ public $countries;
        public $countries_operation;
        public $currency;
        public $users;
        public $supplier;
        public $cities;
        public $isAdmin;
        public $ourServices;
    public function __construct($supplier = null, $isAdmin = true)
    {
        $this->isAdmin = $isAdmin;
        $this->countries = Countries::get();
        $this->countries_operation = Countries::get();
        $this->currency = Currency::get();
        $this->users = User::where('users_role','subuser')->whereNull('users_status')->pluck('name','id');
        $this->supplier = $supplier;
        if($this->supplier != null){
            $this->cities = Cities::join("states","states.id","=","cities.state_id")->where('city_status',1)->get();
        }else{
            $this->cities = collect([]);
        }
        $this->ourServices = OurService::where('status',1)->pluck('name','id');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.suppliers.form');
    }
}
