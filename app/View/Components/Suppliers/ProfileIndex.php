<?php

namespace App\View\Components\suppliers;

use Illuminate\View\Component;

class ProfileIndex extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $supplier;
    public $country;
    public $city;
    public $isSupplier;
    public $oprCountries;
    public $oprCurrency;
    public function __construct($supplier,$isSupplier = null)
    {
        $this->supplier = $supplier;
        $this->country  = $this->supplier->supplierCountry;
        $this->city     = $this->supplier->supplierCity;
        $this->oprCountries   = $this->supplier->operateCountries();
        $this->oprCurrency    = $this->supplier->operateCurrency();
        $this->isSupplier     = $isSupplier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.suppliers.profileindex');
    }
}
