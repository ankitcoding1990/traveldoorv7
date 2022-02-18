<?php

namespace App\View\Components\Bank;

use Illuminate\View\Component;

class Banks extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $agent;
    public $supplier;
    public $bankDetails;
    public $isSupplier;
    public $isAgent;
    public $id;
    public function __construct($type, $agent = null,$supplier = null,$isSupplier = null, $isAgent = false,$id = null)
    {
        $this->type  = $type;
        $this->agent = $agent;
        $this->supplier = $supplier;
        $this->isSupplier = $isSupplier;
        $this->isAgent = $isAgent;
        $this->id         = $id;
        if ($this->type == 'agent' && $agent != null) {
           $this->bankDetails = $agent->bankDetails;
        }

        if ($this->type == 'supplier' && $supplier != null) {
            $this->bankDetails = $supplier->bankDetails;
         }
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.bank.banks');
        //return view('components.agents.profile.banks');
    }
}
