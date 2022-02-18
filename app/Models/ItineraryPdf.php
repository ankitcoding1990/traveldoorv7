<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItineraryPdf extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'about_text',
        'content_desciption',
        'contact_image',
        'about_image',
        'pdf_status',
        'created_by',
        'created_by_role'
    ];
}
