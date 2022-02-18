<?php

namespace App\View\Components\ServiceManagement;

use App\Models\Activity;
use Illuminate\Routing\Route;
use Illuminate\View\Component;

class ActivityNavbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $activity;
    public $id;
    public $activeNav;
    public $mode;
    public $route;
    public $supplier;
    public function __construct($mode = null, $id = null , $supplier = null)
    {
        $this->supplier = $supplier;
        $this->mode = $mode;
        $this->id = $id;
        if($this->id != null){
            $this->activity = Activity::find($this->id);
        }
        $this->route = request()->route()->getName();
        if($this->route == 'activities.create' || $this->route == 'activities.edit' || $this->route == 'activity.create' || $this->route == 'activity.edit'){
            $this->activeNav = 'basic';
        }
        elseif($this->route == 'activity.prices.create' || $this->route == 'activity.prices.edit' || $this->route == 'supplier.activity.prices.create' || $this->route == 'supplier.activity.prices.edit'){
            $this->activeNav = 'pricings';
        }
        elseif($this->route == 'activity.booking.create' || $this->route == 'activity.booking.edit' || $this->route == 'supplier.activity.booking.create' || $this->route == 'supplier.activity.booking.edit'){
            $this->activeNav = 'bookings';
        }
        elseif($this->route == 'activity-img-upload' || $this->route == 'supplier.activity.images.create' || $this->route == 'supplier.activity.images.edit'){
            $this->activeNav = 'images';
        }
        elseif($this->route == 'activity.description.create' || $this->route == 'activity.description.edit' || $this->route == 'supplier.activity.description.create' || $this->route == 'supplier.activity.description.edit'){
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
        return view('components.service-management.activity-navbar');
    }
}
