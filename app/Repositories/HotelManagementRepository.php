<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Models\HotelAmenity;

use function PHPSTORM_META\type;

class HotelManagementRepository
{
    public function __construct(Hotel $model, HotelAmenity $hotelAmenities)
    {
        $this->model = $model;
        $this->hotelAmenities = $hotelAmenities;
    }
    public function store($data)
    {
        // dd($data['blackout_dates']);
        try {
            $data = $this->model->Create($data);
            $id = encrypt($data->id);
            if ($data) {
                return ['title' => 'Success', 'message' => 'Hotel basic details added', 'type' => 'success', 'redirect' => route('hotels.amenities.create', $id), 'id' => $id];
            }
        } catch (\Exception $e) {
            return ['title' => 'Failed', 'message' => 'Failed! due to ' . $e->getMessage(), 'type' => 'error'];
        }
    }

    public function update($data, $id)
    {
        try {
            $this->model->updateOrCreate(['id' => $id],$data);
            $id = encrypt($id);
            return ['title' => 'Success', 'message' => 'Hotel basic details updated', 'type' => 'success', 'redirect' => route('hotels.amenities.edit', $id), 'id' => $id];
        } catch (\Throwable $th) {
            return ['title' => 'Failed', 'message' => 'Failed! due to ' . $th->getMessage(), 'type' => 'error'];
        }
    }
    public function storeAmenities($policy, $amenities, $id)
    {
        try {
            $this->model->where('id', $id)->update($policy);
            $this->hotelAmenities->where('hotel_id',$id)->delete();
            foreach($amenities['hotel'] as $key => $amenity){
                if(isset($amenity['sub_amenity'])){
                    foreach($amenity['sub_amenity'] as $k => $sub_amenity){
                        $this->hotelAmenities->updateOrCreate([
                            'hotel_id' => $id,
                            'sub_amenity_id' => $sub_amenity
                        ],[
                            'amenity_id' => $amenity['amenity']
                        ]);
                    }
                }
                else{
                    $this->hotelAmenities->updateOrCreate([
                        'hotel_id' => $id,
                        'sub_amenity_id' => null
                    ],[
                        'amenity_id' => $amenity['amenity']
                    ]);
                }
            }
            $id = encrypt($id);
            return ['title' => 'Success', 'message' =>  'Amenities got saved!', 'type' => 'success', 'redirect' => route('hotels.images.upload', $id), 'id' => $id];
        } catch (\Throwable $th) {
            return ['title' => 'Failed','message' => 'Failed! due to '.$th->getMessage(), 'type' => 'error'];
        }
    }
    public function updateDescription($data, $id)
    {
        try {
            $data = $this->model->where('id', $id)->update($data);
            if ($data) {
                return ['title' => 'Success', 'message' => 'Hotel details has been stored & publish', 'type' => 'success', 'redirect' => route('hotels.index')];
            }
        } catch (\Exception $e) {
            return ['title' => 'Failed', 'message' => 'Failed to store the hotel Management due to ' . $e->getMessage(), 'type' => 'error'];
        }
    }
    public function changeState($id, $column, $bool)
    {
        try {
            if ($this->model->where('id', $id)->firstOrFail()) {
                $data =  $this->model->where('id', $id)->update([$column => $bool]);
                if ($column == 'admin_approval') {
                    $status = 'Pending';
                    if ($bool == 1) {
                        $status = 'Approved';
                    } else if ($bool == 2) {
                        $status = 'Blocked';
                    }
                } else {
                    $status = 'Inactive';
                    if ($bool == 1) {
                        $status = 'Active';
                    }
                }
                return ['title' => 'Success', 'subject' => $status, 'type' => 'success'];
            }
        } catch (\Exception $err) {
            return ['title' => 'Failed', 'subject' => 'Fail to ' . $bool == 1 ? 'activated ' : 'inactivated ' . $column . ' due to ' . $err->getMessage(), 'type' => 'error'];
        }
    }
    public function delete($id)
    {
        try {
            $this->model->where('id', $id)->delete();
            return ['title' => 'Success', 'subject' => 'Sightseeing services delete successfully', 'type' => 'success'];
        } catch (\Exception $err) {
            return ['title' => 'Failed',  'subject' => 'Error Occurred..! Please Try Again', 'type' => 'error'];
        }
    }
}
