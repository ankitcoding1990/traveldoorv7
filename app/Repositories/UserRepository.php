<?php
namespace App\Repositories;
use App\User;
/**
 *
 */
class UserRepository
{
  protected $user;
  function __construct(User $user)
  {
    $this->user = $user;
  }
  function create($data){
    try {
      $user = $this->user->create($data);
      return ['status' => true, 'message' => 'User Created','user' => $user];
    } catch (\Exception $e) {
      return ['status' => false, 'message' => $e->getMessage()];
    }
  }
  function update($data, $id){
    try {
      $user = $this->user->find($id);
      if ($user) {
          $user->update($data);
          return ['status' => true, 'message' => 'User Updated','user' => $this->user->find($id)];
      }
      throw new \Exception("user not found!", 1);
    } catch (\Exception $e) {
      return ['status' => false, 'message' => $e->getMessage()];
    }
  }

}

 ?>
