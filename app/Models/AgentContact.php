<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentContact extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
    'agent_id',
    'name',
    'number',
    'email'
    ];
}
