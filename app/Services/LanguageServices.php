<?php
namespace App\Services;

use App\Repositories\LanguageRepository;



class LanguageServices{
    function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepo = $languageRepo;
    }
    public function store($request, $id = null)
    {
        $data = $request->only('language_name','iso_639_no','language_created_by');
        if($id != null){
            return $this->languageRepo->update($data, $id);
        }
        return $this->languageRepo->insert($data);
    }

    public function changeState($request)
    {
        return $this->languageRepo->changeState($request->id, $request->state);
    }
}
