<?php

namespace App\Traits;

Trait MyUpload
{
    public static function singleFile($file, $path, $name = null){
      $fileName = self::generateFileName($file->getClientOriginalName());
        if($file->isValid()){
            $file->storeAs('uploads/'.$path, $fileName);
            return $fileName;
        }
        return null;
    }
    public static function multipleFile($files,$path, $name = null){
      $myFiles = [];
      foreach ($files as $key => $file) {
        $myFiles[$key] = self::singleFile($file, $path, $name);
      }
      return array_filter($myFiles);
    }
    public static function generateFileName($name){
     $name = str_replace([' ', '&', '|'], ['', '_and_', '_or_'], $name);
     $name = 'traveldoor'.time().rand(9,99).$name;
      return strtolower($name);
    }

    public function deleteFile($paths){
      if(is_array($paths)){
        foreach ($paths as $key => $path) {
          @unlink($path);
        }
      }
      @unlink($path);
    }
}
?>
