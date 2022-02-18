<?php

namespace App\View\Components\Agents\Profile;

use Illuminate\View\Component;

class ContactPerson extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $agent;
    public $contactPerson;
    public function __construct($agent)
    {
        $this->agent;
        $this->contactPerson = $agent->contactPerson;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.agents.profile.contact-person');
    }
}
