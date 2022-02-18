<?php

namespace App\View\Components\Suppliers;

use Illuminate\View\Component;
use App\Models\Currency;

class Bank extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $supplier;
    public $bank;
    public function __construct($supplier, $bank = null)
    {
        $this->bank = $bank;
        $this->supplier = $supplier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.suppliers.banks.bank');
    }
}
