<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminTermsCancellationMaster extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
        'service_name',
        'terms_conditions',
        'cancel_policy',
        'confirm_msg'
    ];
}
