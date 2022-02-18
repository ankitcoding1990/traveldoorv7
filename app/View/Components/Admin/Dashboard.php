<?php

namespace App\View\Components\Admin;
use Illuminate\Support\Facades\Schema;

use Illuminate\View\Component;
use App\Models\Agent;
use App\Models\Supplier;
use App\Models\Bookings;
use App\Models\BookingCustomer;
use App\Models\Activity;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
     public $no_of_agents;
     public $no_of_suppliers;
     public $no_of_b2b;
     public $no_of_b2c;
     public $no_of_activities;
    public function __construct()
    {

      $this->no_of_agents = Schema::hasTable('agents') ? Agent::all()->count() : 0;
      $this->no_of_suppliers = Schema::hasTable('suppliers') ? Supplier::all()->count() : 0;
      $this->no_of_b2b = Schema::hasTable('bookings') ? Bookings::all()->count() : 0;
      $this->no_of_b2c = Schema::hasTable('booking_customer') ? BookingCustomer::all()->count() : 0;
      $this->no_of_activities = Schema::hasTable('activities') ? Activity::all()->count() : 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.dashboard');
    }
}
