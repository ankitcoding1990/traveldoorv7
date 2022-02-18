<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Contacts extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $model;
     public $contacts;
     public $type;
     public $id;
     public $isAgent;
     public $isSupplier;
    public function __construct($type, $model = null,$id = null, $isAgent = null, $isSupplier = null)
    {
        $this->isAgent    = $isAgent;
        $this->isSupplier    = $isSupplier;
        $this->model    = $model;  
        $this->type     = $type;
        $this->contacts = collect([]);
        $this->id       = $id;
        if ($type == 'agent' && $this->model != null) {
            $this->contacts = $this->model->contacts;
        }
        if ($this->type == 'supplier' && $this->model != null) {
            $this->contacts = $this->model->contacts;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.contacts');
    }
}
