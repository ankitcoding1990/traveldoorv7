<?php
namespace App\Services;

use App\Repositories\ActivityTypeRepository;

class ActivityTypeService{

    public function __construct(ActivityTypeRepository $repo)
    {
        $this->repo = $repo;
    }
    public function store($request)
    {
        $data = $request->only('activity_type_name','activity_type_created_by');
        $data['activity_type_status'] = 1;
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Activity Type Updated Successfully!', 'success'];
            }
            else{
                return ['Fail To Update The Activity Type!', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Activity Type Added SuccussFully!', 'success'];
            }
            else{
                return ['Fail To Add New Activity Type! ', 'error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Activity Type Deleted Successfully', 'success'];
        }
        else{
            return ['Fail To Delete Activity Type', 'error'];
        }
    }
}
