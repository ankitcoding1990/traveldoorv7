<?php
namespace App\Services;
use App\Repositories\UserRepository;
/**
 *
 */
class UserService
{
  protected $userRepo;
  function __construct(UserRepository $userRepo)
  {
    $this->userRepo = $userRepo;
  }
  function store($request){
    return $this->userRepo->create($request->all());
  }
  function userRequestPrepare(){
    // $request->request->add(
    //   [
    //   'password' => null,
    //   'users_password_hint' => null,
    //   'name' =>  $request->users_fname .' '. $request->users_lname
    //   ]
    // );
  }
  function update($request, $id){
    return $this->userRepo->update($request->all(), $id);
  }

}

 ?>
