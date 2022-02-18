<?php

namespace App\Services;

use App\Models\ServiceImages;
use App\Traits\MyUpload;
use App\Repositories\ImageUploadRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class ImageUploadService{
    use MyUpload;
    public function __construct(ImageUploadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function UploadImages($request)
    {
        if($request->hasFile('image')){
            $path = self::getFilePath($request->imageFor);
            $files = self::multipleFile($request->file('image'), $path['path'],$request->imageFor);
            $this->repo->store($files, $path['name'], $request->reference);
        }
    }

    public function fetchimages($request)
    {
        $column = self::getFilePath($request->imageFor);
        $object = $this->repo->fetchimages($column['name'], $request->reference);
        if(gettype($object) == 'object'){
            foreach($object as $key => $images){
                $files[] = self::sortObject($request->imageFor, $images);
            }
            return $files;
        }
        else{
            return $object;
        }
    }

    public function deleteImage($id)
    {
        return $this->repo->delete($id);
    }

    public static function getFilePath($name)
    {
        if($name == 'activity' || $name == 'activities'){
            $column['path'] = ServiceImages::$activity_path;
            $column['name'] = 'activity_id';
        }
        else if($name == 'hotel' || $name == 'hotels'){
            $column['path'] = ServiceImages::$hotel_path;
            $column['name'] = 'hotel_id';
        }
        else if($name == 'guide' || $name == 'guides'){
            $column['path'] = ServiceImages::$guide_path;
            $column['name'] = 'guide_id';
        }
        else if($name == 'sightseeing' || $name == 'sightseeings'){
            $column['path'] = ServiceImages::$sightseeing_path;
            $column['name'] = 'sightseeing_id';
        }
        else if($name == 'transfer' || $name == 'transfers'){
            $column['path'] = ServiceImages::$transfer_path;
            $column['name'] = 'transfer_id';
        }
        else if($name == 'driver' || $name == 'drivers'){
            $column['path'] = ServiceImages::$driver_path;
            $column['name'] = 'driver_id';
        }
        else if($name == 'restaurant' || $name == 'restaurants'){
            $column['path'] = ServiceImages::$restaurant_path;
            $column['name'] = 'restaurant_id';
        }
        else{
            $column['path'] = 'service-management/others';
            $column['name'] = null;
        }
        return $column;
    }

    public static function sortObject($imageFor, $object)
    {
        if($imageFor == 'activity' || $imageFor == 'activities'){
            $files['image'] = $object->activity_image_url;
            $files['ref_id'] = $object->activity_id;
            $files['id'] = $object->id;
        }
        else if($imageFor == 'hotel' || $imageFor == 'hotels'){
            $files['image'] = $object->hotel_image_url;
            $files['ref_id'] = $object->hotel_id;
            $files['id'] = $object->id;
        }
        else if($imageFor == 'guide' || $imageFor == 'guides'){
            $files['image'] = $object->guide_image_url;
            $files['ref_id'] = $object->guide_id;
            $files['id'] = $object->id;
        }
        else if($imageFor == 'sightseeing' || $imageFor == 'sightseeings'){
            $files['image'] = $object->sight_seeing_image_url;
            $files['ref_id'] = $object->sightseeing_id;
            $files['id'] = $object->id;
        }
        else if($imageFor == 'transfer' || $imageFor == 'transfers'){
            $files['image'] = $object->transfer_image_url;
            $files['ref_id'] = $object->transfer_id;
            $files['id'] = $object->id;
        }
        else if($imageFor == 'driver' || $imageFor == 'drivers'){
            $files['image'] = $object->driver_image_url;
            $files['ref_id'] = $object->driver_id;
            $files['id'] = $object->id;
        }
        else if($imageFor == 'restaurant' || $imageFor == 'restaurants'){
            $files['image'] = $object->restaurant_image_url;
            $files['ref_id'] = $object->restaurant_id;
            $files['id'] = $object->id;
        }
        return $files;
    }
}
