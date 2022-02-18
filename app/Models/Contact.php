<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use MyModel;
    use SoftDeletes;
  protected $fillable = [
    'type',
    'agent_id',
    'supplier_id',
    'name',
    'phone',
    'whatsapp',
    'email',
    'status'
  ];

  function agent(){
    return $this->belongsTo('App\Models\Agent');
  }
  function supplier(){
    return $this->belongsTo('App\Models\Supplier');
  }
}
