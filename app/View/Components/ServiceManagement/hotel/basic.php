<?php

namespace App\View\Components\ServiceManagement\hotel;

use Illuminate\View\Component;

class basic extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $hotel;
    public function __construct($hotel = null)
    {
        $this->hotel = $hotel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.hotel.basic');
    }
}
