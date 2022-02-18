<?php
namespace App\Services;

use App\Repositories\UserRightsRepository;
use Exception;

class UserRightsService
{
    protected $userRightRepo;
    function __construct(UserRightsRepository $userRightRepo)
    {
        $this->userRightRepo = $userRightRepo;
    }
    function updateOrCreate($request){
        return $this->userRightRepo->updateOrCreate($request);
    }

}


?>