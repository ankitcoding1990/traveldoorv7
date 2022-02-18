<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentService extends Model
{
    use MyModel;
    use SoftDeletes;
  protected $table = 'agent_services';
  protected $fillable = [
    'agent_id',
    'service_id',
    'admin_markup',
    'agent_markup',
    'status'
  ];
    public function service()
    {
        return $this->belongsTo('App\Models\OurService','service_id','id');
    }
}
