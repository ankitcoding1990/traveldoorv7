<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferMaster extends Model
{
    use MyModel, SoftDeletes;
    protected $table = 'transfer_master';

    protected $fillable = [
        'master_name',
        'master_country',
        'master_city',
        'master_type',
        'master_status',
        'master_created_by,'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Countries','master_country','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities','master_city','id');
    }
}
