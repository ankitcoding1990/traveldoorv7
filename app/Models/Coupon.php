<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable =[
        'coupan_type',
        'coupan_name',
        'no_of_person',
        'min_value',
        'coupan_code',
        'coupan_validity_from',
        'coupan_validity_to',
        'coupan_amount_type',
        'coupan_amount',
        'coupan_created_by',
        'coupan_status',
    ];
}
