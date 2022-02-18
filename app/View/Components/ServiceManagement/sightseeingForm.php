<?php

namespace App\View\Components\serviceManagement;

use Illuminate\View\Component;

class sightseeingForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $routeName;
    public $model;
    public $layout;
    public $user;
    public $sightseeing;
    public function __construct($model = false, $layout='layouts.main', $user = null,  $sightseeing, $routeName)
    {
        $this->routeName = $routeName;
        $this->model = $model;
        $this->user = $user;
        $this->sightseeing = $sightseeing;    
        $this->layout = $layout;
      
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.sightseeing-form');
    }
}
