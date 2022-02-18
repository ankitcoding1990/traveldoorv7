<?php

namespace App\Services;

use App\Repositories\PdfMasterRepository;
use App\Traits\MyUpload;

class pdfMasterService{
    use MyUpload;
    public function __construct(PdfMasterRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request)
    {
        $data = $request->only('title','content_desciption','about_text','created_by','created_by_role');
        if($request->delContact){
            $data['contact_image'] = null;
        }
        if($request->delAbout){
            $data['about_image'] = null;
        }
        if($request->hasFile('contact_image')){
            $file = $request->file('contact_image');
            $path = public_path('/assets/uploads/pdf master/');
            $filename = Self::singleFile($file,$path,'pdf master');
            $data['contact_image'] = '/assets/uploads/pdf master/'.$filename;
        }
        if($request->hasFile('about_image')){
            $file = $request->file('about_image');
            $path = public_path('/assets/uploads/pdf master/');
            $filename = Self::singleFile($file,$path,'pdf master');
            $data['about_image'] = '/assets/uploads/pdf master/'.$filename;
        }
        $data['pdf_status'] = 1;

        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['PDF Got Updated', 'success'];
            }
            else{
                return ['Cannot Update the PDF', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New PDF Got Added', 'success'];
            }
            else{
                return ['Cannot Add New PDF','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['PDF Got Deleted', 'success'];
        }
        else{
            return ['Cannot Delete PDF','error'];
        }
    }

    public function statechanger($id)
    {
        $res = $this->repo->statechanger($id);
        if($res){
            return ['PDF Status Changed', 'success'];
        }
        else{
            return ['Cannot Change PDF Status','error'];
        }

    }
}
