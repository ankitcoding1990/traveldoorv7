<?php

namespace App\View\Components\serviceManagement\Sightseeing;

use Illuminate\View\Component;

class description extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $sightseeing;
    public function __construct($sightseeing = null)
    {
        $this->sightseeing =  $sightseeing;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.sightseeing.description');
    }
}
