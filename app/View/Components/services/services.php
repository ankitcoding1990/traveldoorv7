<?php

namespace App\View\Components\services;

use Illuminate\View\Component;

class services extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $agent, $supplier, $servicefor;
    public function __construct($type, $agent = null, $supplier = null, $servicefor=null)
    {
        $this->type = $type;
        $this->agent = $agent ?? $supplier;
        if($this->type=='agent' && $agent!=null){
            $this->servicefor = $agent->id;
        }
        else if($this->type == 'supplier' && $supplier!=null){
                $this->servicefor = $supplier->id;
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.services.services');
    }
}
