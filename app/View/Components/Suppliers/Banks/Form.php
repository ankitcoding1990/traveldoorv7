<?php

namespace App\View\Components\Suppliers\Banks;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $currenies;
    public function __construct()
    {
        $this->currenies = Currency::get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.suppliers.banks.form');
    }
}
