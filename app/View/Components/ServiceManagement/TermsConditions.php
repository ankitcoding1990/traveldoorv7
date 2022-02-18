<?php

namespace App\View\Components\ServiceMangement;

use Illuminate\View\Component;

class TermsConditions extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $model;
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.terms-conditions');
    }
}
