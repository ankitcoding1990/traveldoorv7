<?php
namespace App\Services;

use App\Repositories\CitiesRepository;
/**
 *
 */
class CitiesService
{
  protected $cityRepo;
  function __construct(CitiesRepository $cityRepo)
  {
    $this->cityRepo = $cityRepo;
  }

  function getCities(){
    return $this->cityRepo->getCities();
  }

  public function store($request)
  {
    $data = $request->only('state_id','name');
    $data['city_status'] = 1;
    if(!empty($request->id))
    {
        $data['id'] = $request->id;
        $res = $this->cityRepo->update($data);
        if($res){
            return ['City Updated!','success'];
        }
        else{
            return ['Fail To Update City','error'];
        }
    }
    else{
        $res = $this->cityRepo->insert($data);
        if($res){
            return ['City Added!','success'];
        }
        else{
            return ['Fail To Add New City','error'];
        }
    }
  }

  public function delete($id)
    {
        $res = $this->cityRepo->delete($id);
        if($res){
            return ['City Delete!','success'];
        }
        else{
            return ['Fail To Delete City','error'];
        }
    }

}
 ?>
