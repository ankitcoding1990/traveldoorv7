<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierService extends Model
{
    use MyModel, SoftDeletes;
    protected $table    = 'supplier_services';
    protected $fillable = [
        'supplier_id',
        'service_id',
        'admin_markup',
        'supplier_markup',
        'status'
    ];
}
