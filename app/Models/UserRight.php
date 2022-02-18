<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function GuzzleHttp\json_decode;

class UserRight extends Model
{
    use MyModel, SoftDeletes;
    protected $fillable = [
        'user_id',
        'menu_id',
        'full',
        'add',
        'view',
        'edit',
        'delete',
        'report',
        'admin',
        'admin_roles',
        'status',
    ];
    function setAdminRolesAttribute($value){
        if(is_array($value)){
            $this->attributes['admin_roles'] = json_encode($value);
        }else{
            $this->attributes['admin_roles'] = null;
        }
    }
    function getAdminRolesAttribute($value){
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }
}
