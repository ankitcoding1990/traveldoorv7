<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerMarkup extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="customer_markup";

    protected $fillable = [
        'customer_markup',
        'customer_markup_cost',
        'customer_markup_created_by',
    ];

}
