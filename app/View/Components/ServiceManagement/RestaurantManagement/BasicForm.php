<?php

namespace App\View\Components\ServiceManagement\RestaurantManagement;

use Illuminate\View\Component;

class BasicForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $layout;
    public $restaurant;
    public $isSupplier;
    public function __construct($layout = 'layouts.main', $restaurant = null, $isSupplier=null)
    {
        $this->layout = $layout;
        $this->restaurant = $restaurant;
        $this->isSupplier = $isSupplier;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.service-management.restaurant-management.basic-form');
    }
}
