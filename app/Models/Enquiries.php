<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiries extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="enquiries";

    protected $guarded = [];

    protected $primaryKey = 'enq_id';

     public function getEnquiryType()
    {
        return $this->belongsTo('App\Models\EnquiryType', 'enquiry_type', 'enquiry_type_id');
    }
}
