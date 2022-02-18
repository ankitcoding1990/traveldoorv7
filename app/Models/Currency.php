<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable= [
      'name',
      'code',
      'symbol'
    ];
    function scopeActive($query){
      return $query->where('status',1);
    }

    function getFullNameAttribute(){
      return $this->name. " (".$this->code.")";
    }
}
