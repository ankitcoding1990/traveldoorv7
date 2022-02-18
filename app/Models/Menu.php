<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use MyModel, SoftDeletes;
    protected $fillable = [
      'menu_pid',
      'order_id',
      'menu_name',
      'menu_file',
      'newwindow',
      'user_id',
      'status',
    ];

    function menu(){
       return $this->belongsTo('App\Models\Menu', 'menu_pid');
    }
    function user(){
      return $this->belongsTo('App\User', 'user_id');
    }
    function activeSubMenus($menuId){
        return $this->where('menu_pid', $menuId)->where('status',1)->get();
    }
    function submenus(){
      return $this->hasMany('App\Models\Menu', 'menu_pid')->where('status',1);
    }
}
