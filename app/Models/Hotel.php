<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use MyModel, SoftDeletes;
    protected $fillable = [
        'hotel_name', 'hotel_type_id', 'supplier_id', 'hotel_contact', 'location', 'hotel_rating', 'country_id', 'city_id', 'currency_id', 'reasons_to_book', 'season_details', 'blackout_dates', 'markup_details', 'surcharge_details', 'allocation_details', 'promotion_details', 'addon_details', 'booking_validity_from', 'booking_validity_to', 'description', 'other_policies', 'inclusions', 'exclusions', 'terms_conditions', 'cancel_policy', 'confirm_message', 'supplier_term_conditions', 'supplier_cancel_policy', 'supplier_confirmation_msg', 'created_admin_id', 'show_order', 'status', 'best_status', 'popular_status', 'draft_status', 'admin_approval', 'is_cloned'
    ];
    public function setBlackoutDatesAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['blackout_dates'] = json_encode($value, true);
        } else {
            $this->attributes['blackout_dates'] = null;
        }
    }
    public function getBlackoutDatesAttribute($value)
    {
        if ($value) {
            return json_decode($value, true);
        }
    }
    public function setReasonsToBookAttribute($value)
    {
        if (!empty($value) && is_array($value)) {
            $this->attributes['reasons_to_book'] = json_encode($value, true);
        } else {
            $this->attributes['reasons_to_book'] = null;
        }
    }
    public function getReasonsToBookAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value, true);
        }
        return null;
    }

    public function setOtherPoliciesAttribute($value)
    {
        if (!empty($value) && is_array($value)) {
            $this->attributes['other_policies'] = json_encode($value, true);
        } else {
            $this->attributes['other_policies'] = null;
        }
    }
    public function getOtherPoliciesAttribute($value)
    {
        if (!empty($value)) {
            return json_decode($value, true);
        }
        return null;
    }

    public function amenity()
    {
        return $this->hasMany('App\Models\HotelAmenity', 'hotel_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ServiceImages','hotel_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo('App\User', 'created_admin_id', 'id');
    }
    public function hotelType()
    {
        return $this->belongsTo('App\Models\HotelType', 'hotel_type_id', 'id');
    }
    public function getCountry()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id', 'id');
    }
}
