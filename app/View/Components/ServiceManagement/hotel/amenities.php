<?php

namespace App\View\Components\ServiceManagement\hotel;

use App\Models\Amenities as ModelsAmenities;
use Illuminate\View\Component;

class amenities extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $hotel;
    public $amenities;
    public function __construct($hotel)
    {
        $this->hotel = $hotel;
        $this->amenities = ModelsAmenities::get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.hotel.amenities');
    }
}
