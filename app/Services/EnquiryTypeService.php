<?php

namespace App\Services;

use App\Repositories\EnquiryTypeRepository;

class EnquiryTypeService{

    public function __construct(EnquiryTypeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('enquiry_type_name', 'enquiry_type_created_by');
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function Changestate($id, $status)
    {
        return $this->repo->Changestate($id, $status);
    }
}
