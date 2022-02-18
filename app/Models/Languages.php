<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Languages extends Model
{
    use MyModel, SoftDeletes;

    protected $table="languages";
    protected $fillable = ['language_name','iso_639_no','language_created_by','status'];

    public function scopeActive($query){
        return $query->where('status',1);
    }

}
