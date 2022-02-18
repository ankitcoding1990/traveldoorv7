<?php
namespace App\Traits;
use App\Models\Menu;
/**
 *
 */
trait CustomPermission
{
    function hasRoutePermission($routeName){
      if ($this->isAdmin()) {
        return true;
      }
      if ($this->getRoutePermission($routeName)) {
        return true;
      }
      return false;
    }
    function getRoutePermission($routeName){
      $menu = Menu::where('menu_file', $routeName)->first();
      if ($menu == null) {
        return false;
      }
      $right = $this->rights->where('menu_id', $menu->id)->first();
      if ($right == null) {
        return false;
      }
      return $right;
    }
    function canPerform($routeName, $operation = 'view', $admin = null){
      if (auth()->user()->isAdmin()) {
        return true;
      }
      $right = $this->getRoutePermission($routeName);
      if ($right == false) {
        return false;
      }
      if ($admin != null) {
        if($right->admin == 1){
          return $this->adminCanPerform($right, $operation);
        }else{
          return false;
        }  
      }
      return ($right->$operation == 1);
    }
    function adminCanPerform($right, $operation = 'view'){
      if ($right != null && $right->admin) {
          $admin_roles = $right->admin_roles;
          if (in_array($operation,$admin_roles)) {
            return true;
          }
      }
      return false;
    }
    
    function hasAddPermission($routeName, $admin = null){
      return $this->canPerform($routeName, 'add', $admin);
    }
    function hasViewPermission($routeName,$admin = null){
      return $this->canPerform($routeName, 'view', $admin);
    }
    function hasEditPermission($routeName,$admin = null){
      return $this->canPerform($routeName, 'edit', $admin);
    }
    function hasDeletePermission($routeName,$admin = null){
      return $this->canPerform($routeName, 'delete',$admin);
    }
    function hasReportsermission($routeName,$admin = null){
      return $this->canPerform($routeName, 'report',$admin);
    }

    public function hasSubAvailbleRoutes($routes)
    {
      if ($this->isAdmin()) {
        return true;
      }
      foreach ($routes as $route) {
        $check = $this->getRoutePermission($route);
        if($check != false) {
          return true;
        } 
      }
        return false;
    }
}
?>
