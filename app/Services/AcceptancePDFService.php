<?php
namespace App\Services;

use App\Repositories\AcceptancePDFRepository;

class AcceptancePDFService{
    protected $AcceptancePDFRepository;
    public function __construct(AcceptancePDFRepository $AcceptancePDFRepository)
    {
        $this->AcceptancePDFRepository = $AcceptancePDFRepository;
    }

    public function store($request)
    {
        $data = $request->only('acceptance_pdf_english','id');
        $res = $this->AcceptancePDFRepository->insert($data);
        if($res){
            return ['ACCEPTANCE PDF Added Successfully','success'];
        }
        else{
            return ['Fail To Add ACCEPTANCE PDF','error'];
        }
    }
}
