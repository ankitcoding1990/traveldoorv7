<?php

namespace App\View\Components\Theme;

use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $type;
    public function __construct($type = 'admin')
    {
      $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.theme.footer');
    }
}
