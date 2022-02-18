<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurService extends Model
{
    use MyModel, SoftDeletes;
    protected $fillable = [
      'name',
      'slug',
      'status'
    ];

    function scopeActive($query){
      return $query->where('status',1);
    }

    function isActive(){
      return ($this->status == 1);
    }
}
