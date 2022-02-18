<?php

namespace App\Services;

use App\Repositories\GuideExpensesRespository;

class GuideExpensesService{

    public function __construct(GuideExpensesRespository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request, $id = null)
    {
        $data = $request->only('guide_expense','guide_expense_cost','guide_expense_created_by');
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);

    }
}
