<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceImages extends Model
{
    use MyModel, SoftDeletes;
    static $activity_path = 'service-management/activities';
    static $hotel_path = 'service-management/hotels';
    static $guide_path = 'service-management/guides';
    static $sightseeing_path = 'service-management/sightseeing';
    static $transfer_path = 'service-management/transfer';
    static $driver_path = 'service-management/driver';
    static $restaurant_path = 'service-management/restaurant';

    protected $fillable = [
        'hotel_id',
        'activity_id',
        'guide_id',
        'sightseeing_id',
        'trasfer_id',
        'driver_id',
        'restaurant_id',
        'image'
    ];

    public function getActivityImageUrlAttribute(){
        return asset('storage/uploads/'.self::$activity_path.'/'.$this->image);
    }

    public function getHotelImageUrlAttribute(){
        return asset('storage/uploads/'.self::$hotel_path.'/'.$this->image);
    }
    public function getGuideImageUrlAttribute(){
        return asset('storage/uploads/'.self::$guide_path.'/'.$this->image);
    }
    public function getSightSeeingImageUrlAttribute(){
        return asset('storage/uploads/'.self::$sightseeing_path.'/'.$this->image);
    }
    public function getTransferImageUrlAttribute(){
        return asset('storage/uploads/'.self::$transfer_path.'/'.$this->image);
    }
    public function getDriverImageUrlAttribute(){
        return asset('storage/uploads/'.self::$driver_path.'/'.$this->image);
    }
    public function getRestaurantImageUrlAttribute(){
        return asset('storage/uploads/'.self::$restaurant_path.'/'.$this->image);
    }



}

