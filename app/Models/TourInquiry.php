<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourInquiry extends Model
{
    use SoftDeletes, MyModel;
    protected $table="tour_inquiry";

    protected $primaryKey = 'tour_inquiry_id';

    protected $guarded = [];
}
