<?php

namespace App\View\Components\Suppliers;

use Illuminate\View\Component;

class Aside extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $services;
    public function __construct($supplier)
    {
        $this->supplier = $supplier;
        $this->services = $this->supplier->services;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.suppliers.aside');
    }
}
