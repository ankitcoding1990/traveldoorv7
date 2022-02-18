<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuelType extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
        'fuel_type', 'fuel_type_cost', 'created_by'
    ];
    function scopeActive($query){
        return $query->where('status',1);
      }

}
