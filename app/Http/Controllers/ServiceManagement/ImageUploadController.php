<?php

namespace App\Http\Controllers\ServiceManagement;

use App\Traits\MyUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;

class ImageUploadController extends Controller
{
    use MyUpload;
    public function __construct(ImageUploadService $service)
    {
        $this->service = $service;
    }
    public function PostImages(Request $request)
    {
        return $this->service->UploadImages($request);
    }

    public function GetImages(Request $request)
    {
        return $this->service->fetchimages($request);
    }

    public function DeleteImages(Request $request)
    {
        return $this->service->deleteImage($request->id);
    }
}
