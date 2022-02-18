<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcceptancePdfMaster extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="acceptance_pdf_master";
    protected $fillable = [
        'acceptance_pdf_english'
    ];
}
