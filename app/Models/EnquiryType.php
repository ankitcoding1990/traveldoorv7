<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnquiryType extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="enquiry_type";

    protected $fillable = [
        'enquiry_type_name',
        'enquiry_type_status',
        'enquiry_type_created_by',
    ];
}
