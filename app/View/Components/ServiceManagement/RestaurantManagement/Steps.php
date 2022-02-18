<?php

namespace App\View\Components\ServiceManagement\RestaurantManagement;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class Steps extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $restaurant;
     public $status;
     public $currentRoute;
    public function __construct($restaurant = null, $status = null)
    {
        $this->restaurant = $restaurant;
        $this->status = $status;
        $this->currentRoute = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.restaurant-management.steps');
    }
}
