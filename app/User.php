<?php

namespace App;


use App\Traits\CustomPermission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,CustomPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $defaultPassword = '123456';
    protected $fillable = [
        'name', 'email', 'password','users_pid','users_empcode','users_fname','users_lname','username','users_contact','users_password_hint','users_assigned_role','users_role','users_status','last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function isAdmin(){
      if (strtolower($this->users_role) == 'Admin' || $this->users_role == null) {
        return true;
      }
      return false;
    }
    function subUser(){
      if ($this->users_role == 'Sub-User') {
        return true;
      }
      return false;
    }
    function isActiveUser(){
      if ($this->users_status == 1) {
        return true;
      }
      return false;
    }

    public function scopeActiveUsers($query){
      return $query->whereNull('users_status');
    }
    public function scopeAdminUsers($query){
      return $query->whereNull('users_role');
    }
    public static function scopeInActiveUsers($query){
      return $query->whereNotNull('users_status');
    }

    public static function scopeRole($query, $role){
      return $query->where('users_role', $role);
    }

    function getFullNameAttribute(){
      $full_name =$this->users_fname .' '.$this->users_lname;
      return $full_name;
    }
    function setNameAttribute($value){
      $name = $this->users_fname. ' '.$this->users_lname;
      $this->attributes['name'] = $name;
    }
    function setPasswordAttribute($value){
      $password = $this->defaultPassword;
      if (!empty($value)) {
        $password = $value;
      }
      $this->attributes['password'] = Hash::make($password);
    }
    function setUsersPasswordHintAttribute($value){
      $password = $this->defaultPassword;
      if (!empty($value)) {
        $password = $value;
      }
      $this->attributes['users_password_hint'] = $password;
    }

    function parentMenus(){
      return $this->belongsToMany('App\Models\Menu', 'App\Models\UserRight')->where('menu_pid', null);
    }
    function rights($menuId = null){
      if($menuId != null){
        return $this->hasMany('App\Models\UserRight', 'user_id')->where('menu_id', $menuId)->first();
      }
      return $this->hasMany('App\Models\UserRight', 'user_id');
    }

    function user(){
      return $this->belongsTo('App\User', 'users_pid');
    }
}
