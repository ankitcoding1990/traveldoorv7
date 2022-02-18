<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class AgentBankDetail extends Model
{
    use MyModel;
    use SoftDeletes;

    protected $fillable = [
        'agent_id',
        'account_number',
        'name',
        'ifsc',
        'iban',
        'currency_id'
    ];

    function myCurrency(){
        return $this->belongsTo('App\Models\Currency', 'currency_id');
    }

}
