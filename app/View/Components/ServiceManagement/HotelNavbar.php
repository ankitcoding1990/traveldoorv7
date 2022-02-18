<?php

namespace App\View\Components\ServiceManagement;

use App\Models\Hotel;
use Illuminate\View\Component;

class HotelNavbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $hotel;
    public $id;
    public $activeNav;
    public $mode;
    public $route;
    public $supplier;
    public function __construct($mode = null, $id = null, $supplier = null)
    {
        $this->supplier = $supplier;
        $this->mode = $mode;
        $this->id = $id;
        if ($this->id != null) {
            $this->hotel = Hotel::find($this->id);
        }
        $this->route = request()->route()->getName();
        if ($this->route == 'hotels.create' || $this->route == 'hotels.edit' || $this->route == 'hotel.create' || $this->route == 'hotel.edit') {
            $this->activeNav = 'basic';
        } elseif ($this->route == 'hotels.amenities.create' || $this->route == 'hotels.amenities.edit' || $this->route == 'hotel.amenities.create' || $this->route == 'hotel.amenities.edit') {
            $this->activeNav = 'amenities';
        } elseif ($this->route == 'hotels.images.upload' || $this->route == 'hotels.images.edit') {
            $this->activeNav = 'images';
        } elseif ($this->route == 'hotels.description.create' || $this->route == 'hotels.description.edit' || $this->route == 'hotel.description.create' || $this->route == 'hotel.description.edit') {
            $this->activeNav = 'description';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.hotel-navbar');
    }
}
