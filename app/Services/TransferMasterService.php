<?php

namespace App\Services;

use App\Repositories\TransferMasterRepository;

class TransferMasterService {
    public function __construct(TransferMasterRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('master_name','master_country','master_city','master_type','master_created_by');
        $data['master_status'] = 1;
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function ChangeState($id, $status)
    {
        return $this->repo->ChangeState($id, $status);
    }
}
