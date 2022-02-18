<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingTargetCommission extends Model
{
    use MyModel, SoftDeletes;
    protected $table="setting_target_commission";

    protected $fillable = [
        'st_amount',
        'st_commission_per',
        'st_status',
        'st_created_by'
    ];
}
