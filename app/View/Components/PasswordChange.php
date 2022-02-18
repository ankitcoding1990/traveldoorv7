<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PasswordChange extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $model;
    public $type;
    public $password;
    public function __construct($type, $model = null)
    {
        $this->model = $model;
        $this->type = $type;
        $this->password = $this->model->password_hint;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.password-change');
    }
}
