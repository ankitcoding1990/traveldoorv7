<?php

namespace App\Models;

use App\Models\Countries;
use App\Models\Currency;
use App\Traits\MyModel;

use function GuzzleHttp\json_decode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    use MyModel;
    use SoftDeletes;
    protected $table = "agents";

    protected $fillable = [
        'name',
        'email',
        'password',
        'verified_at',
        'password_hint',
        'company_name',
        'company_email',
        'company_contact',
        'company_fax',
        'user_ref_id',
        'address',
        'country_id',
        'city_id',
        'corporate_reg_no',
        'corporate_desc',
        'skype_id',
        'operating_hrs_from',
        'operating_hrs_to',
        'operating_weekdays',
        'certificate_corp',
        'agent_logo',
        'opr_currency',
        'operate_country_id',
        'agent_bank_details',
        'contact_persons',
        'created_user_id',
        'status'
    ];

    function setOprCurrencyAttribute($value)
    {
        //dd($value);
        if (isset($value) && is_array($value)) {
            $this->attributes['opr_currency'] = json_encode($value, true);
        } else {
            $this->attributes['opr_currency'] = null;
        }
    }
    function getOprCurrencyAttribute($value)
    {
        if ($value != null) {
            return json_decode($value, true);
        }
        return null;
    }
    function setOperateCountryIdAttribute($value)
    {
        if (isset($value) && is_array($value)) {
            $this->attributes['operate_country_id'] = json_encode($value, true);
        } else {
            $this->attributes['operate_country_id'] = null;
        }
    }
    function getOperateCountryIdAttribute($value)
    {
        if ($value != null) {
            return json_decode($value, true);
        }
        return null;
    }
    function setOperatingWeekdaysAttribute($value)
    {
        if (isset($value) && is_array($value)) {
            $this->attributes['operating_weekdays'] = json_encode($value, true);
        } else {
            $this->attributes['operating_weekdays'] = null;
        }
    }
    function getOperatingWeekdaysAttribute($value)
    {
        if ($value != null) {
            return json_decode($value, true);
        }
        return null;
    }

    //   function setServiceIdsAttributes($value){
    //     if(isset($value) && is_array($value)){
    //         $this->attributes['service_id'] = json_encode($value, true);
    //     }else{
    //         $this->attributes['service_id'] = null;
    //     }
    //   }
    //   function getServiceIdsAttributes($value){
    //     if ($value != null) {
    //         return json_decode($value);
    //     }
    //     return null;
    //   }

    function bankDetails()
    {
        return $this->hasMany('App\Models\Bank', 'agent_id');
    }
    function services()
    {
        return $this->belongsToMany('App\Models\OurService', 'App\Models\AgentService', 'agent_id', 'service_id');
    }
    function country()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id');
    }
    function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id');
    }
    function operateCountries()
    {
        $oprCountries = $this->operate_country_id;
        if ($oprCountries != null) {
            return Countries::whereIn('id', $oprCountries)->get();
        }
        return collect([]);
    }
    function operateCurrency()
    {
        $oprCurrency = $this->opr_currency;
        if ($oprCurrency != null) {
            return Currency::whereIn('id', $oprCurrency)->get();
        }
        return collect([]);
    }

    function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'agent_id');
    }
    function createdBy()
    {
        return $this->belongsTo('App\User', 'created_user_id');
    }

    function serviceMarkups()
    {
        return $this->belongsToMany('App\Models\OurService', 'App\Models\AgentService', 'agent_id', 'service_id')->withPivot('agent_markup');
    }
}
