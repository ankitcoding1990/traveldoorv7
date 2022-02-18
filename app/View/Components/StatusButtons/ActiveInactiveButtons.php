<?php

namespace App\View\Components\StatusButtons;

use Illuminate\View\Component;

class ActiveInactiveButtons extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $model;
    public $table;
    public $column;
    public function __construct($model, $table, $column='deleted_at')
    {
        $this->model=$model;
        $this->table=$table;
        $this->column=$column;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.status-buttons.active-inactive-buttons');
    }
}
