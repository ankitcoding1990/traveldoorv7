<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityBooking extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $fillable = [
        'activity_id',
        'from_date',
        'to_date',
        'time_from',
        'time_to',
        'no_of_pax',
        'surge',
        'discount'
    ];

    public function setTimeFromAttribute($time_from)
    {
        if (isset($time_from) && is_array($time_from)) {
            $this->attributes['time_from'] = json_encode($time_from,true);
        }else{
            $this->attributes['time_from'] = null;
        }
    }

    public function setTimeToAttribute($time_to)
    {
        if (isset($time_to) && is_array($time_to)) {
            $this->attributes['time_to'] = json_encode($time_to,true);
        }else{
            $this->attributes['time_to'] = null;
        }
    }
    public function setNoOfPaxAttribute($no_of_pax)
    {
        if (isset($no_of_pax) && is_array($no_of_pax)) {
            $this->attributes['no_of_pax'] = json_encode($no_of_pax,true);
        }else{
            $this->attributes['no_of_pax'] = null;
        }
    }
    public function setSurgeAttribute($surge)
    {
        if (isset($surge) && is_array($surge)) {
            $this->attributes['surge'] = json_encode($surge,true);
        }else{
            $this->attributes['surge'] = null;
        }
    }
    public function setDiscountAttribute($discount)
    {
        if (isset($discount) && is_array($discount)) {
            $this->attributes['discount'] = json_encode($discount,true);
        }else{
            $this->attributes['discount'] = null;
        }
    }

    public function getTimeFromAttribute($value)
    {
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }

    public function getTimeToAttribute($value)
    {
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }

    public function getNoOfPaxAttribute($value)
    {
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }

    public function getSurgeAttribute($value)
    {
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }

    public function getDiscountAttribute($value)
    {
        if($value != null){
            return json_decode($value, true);
        }
        return null;
    }
}
