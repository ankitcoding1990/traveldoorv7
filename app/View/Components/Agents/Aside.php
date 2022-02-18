<?php

namespace App\View\Components\Agents;

use Illuminate\View\Component;

class Aside extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $agent;
    public $services;
    public function __construct($agent)
    {
        $this->agent = $agent;
        $this->services = $agent->services;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.agents.aside');
    }
}
