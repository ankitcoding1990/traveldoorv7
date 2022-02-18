<?php

namespace App\View\Components\Helpers;

use Illuminate\View\Component;

class ActiveOrInactive extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $model;
     public $modelName;
     public $column;
     public $mail;
    public function __construct($model, $modelName, $column = 'deleted_at')
    {
        $this->model = $model;
        $this->modelName = $modelName;
        $this->column = $column;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.helpers.active-or-inactive');
    }
}
