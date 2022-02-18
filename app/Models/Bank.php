<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
        'supplier_id','agent_id','bank_account_number','bank_name','bank_ifsc','bank_iban','bank_currency_id','type'
    ];


    public function supplierCurreny()
    {
        return $this->belongsTo('App\Models\Currency','bank_currency_id','id');
    }
}
