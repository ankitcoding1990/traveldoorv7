<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Bank;
use App\Models\Countries;
use App\Traits\MyModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Authenticatable
{
    use MyModel, SoftDeletes;
    use Notifiable;
    protected $table="suppliers";
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = [
        'supplier_id', 'name',
        'company_name','email',
        'password','password_hint',
        'company_contact', 'company_fax',
        'user_ref_id', 'address', 'country_id',
        'city_id', 'corporate_reg_no', 'corporate_desc',
        'skype_id', 'fuel_info', 'operating_hrs_from', 'operating_hrs_to', 'operating_weekdays',
        'certificate_corp','logo', 'opr_currency', 'opr_countries',
        'blackout_dates', 'bank_details', 'contact_persons',
        'created_by','supplier_status'];

    function setOprCurrencyAttribute($value){
        // dd($value);
        if (isset($value) && is_array($value)) {
            $this->attributes['opr_currency'] = json_encode($value,true);

        }else{
            $this->attributes['opr_currency'] = null;
        }
    }

    function getOprCurrencyAttribute($value){
        if ($value != null) {
            return json_decode($value, true);
        }
        return null;
    }

    function setOprCountriesAttribute($value){

        if (isset($value) && is_array($value)) {
            $this->attributes['opr_countries'] = json_encode($value,true);
        }else{
            $this->attributes['opr_countries'] = null;
        }
    }

    function getOprCountriesAttribute($value){
        if ($value != null) {
            return json_decode($value, true);
        }
        return null;
    }

    function setOperatingWeekdaysAttribute($value)
    {

        if (isset($value) && is_array($value)) {
            $this->attributes['operating_weekdays'] = json_encode($value,true);
        }else{
            $this->attributes['operating_weekdays'] = null;
        }
    }

    function getOperatingWeekdaysAttribute($value){
        if ($value != null) {
            return json_decode($value,true);
        }
        return null;
    }

    public function BankDetails()
    {
        return $this->hasMany(Bank::class,'supplier_id','id');
    }

    public function supplierOprCountry()
    {
        return $this->belongsTo('App\Models\Countries','opr_countries','id');
    }

    function getBlackoutDatesAttribute($value)
    {
        if ($value != null) {
            return $value;
        }
        return null;
    }

    function getBlackoutDatesArrayAttribute(){
        return ($this->blackout_dates != null) ? explode(',', $this->blackout_dates) : [];
    }

    public function services()
    {
       return $this->belongsToMany('App\Models\OurService', 'App\Models\SupplierService', 'supplier_id','service_id');
    }

    public function supplierContactPerson()
    {
        return $this->hasMany('App\Models\SupplierContactDetail','supplier_id','id');
    }

    function operateCountries(){
        $oprCountries = $this->opr_countries;
        if($oprCountries != null){
            return Countries::whereIn('id', $oprCountries)->get();
        }
        return collect([]);
    }
    function operateCurrency(){
        $oprCurrency = $this->opr_currency;
        if($oprCurrency != null){
            return Currency::whereIn('id', $oprCurrency)->get();
        }
        return collect([]);
    }


    public function supplierCountry()
    {
        return $this->belongsTo('App\Models\Countries','country_id','id');
    }

    public function supplierCity()
    {
        return $this->belongsTo('App\Models\Cities','city_id','id');
    }

    function contacts(){
        return $this->hasMany('App\Models\Contact','supplier_id');
    }

    public function checkActiveSupplier()
    {
        if ($this->status != NULL) {
            return true;
        }
        return false;
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
