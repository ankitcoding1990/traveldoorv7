<?php

namespace App\View\Components\Agents;

use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $agent;
    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.agents.navbar');
    }
}
