<?php

namespace App\View\Components\Main;

use Illuminate\View\Component;

use App\Models\Menu;
use App\UserRight;
use App\User;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $rights;
    public $routePermission;
    public $menus;
    public $ParentRights = array();

    public function __construct()
    {
      $this->user = auth()->user();
      $this->menus = Menu::where('menu_pid', null)->get();


      // foreach ($this->menus as $parent) {
      //   $SubMenus  = $parent->submenus();
      //   $right     = 0;
      //   foreach ($SubMenus as $SubMenu) {
      //     if(auth()->user()->hasSubAvailbleRoutes($SubMenus->menu_file))
      //     {
      //       $right++;
      //     }
      //   }
      //   if ($right != 0) {
      //     $this->ParentRights[] = 1;
      //   } else {
      //     $this->ParentRights[] = 0;
      //   }
      // }

      // dd($this->ParentRights);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
      return view('components.main.navbar');
    }
}
