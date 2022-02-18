<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourType extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="tour_type";
    protected $fillable = [
        'tour_type_name',
        'tour_type_status',
        'tour_type_created_by',
    ];
    public function scopeActive($query){
        return $query->where('tour_type_status',1);
    }
}
