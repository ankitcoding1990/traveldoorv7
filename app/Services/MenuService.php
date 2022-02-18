<?php
namespace App\Services;
use App\Repositories\MenuRepository;
/**
 *
 MenuService.php
 */
class MenuService
{

  function __construct(MenuRepository $menuRepo)
  {
    $this->menuRepo = $menuRepo;
  }
  function store($request){
      return $this->menuRepo->store($request->all());
  }
  function update($request, $id){
      $new_window = 0;
      if ($request->has('newwindow')) {
        $new_window = 1;
      }
      $request->request->add(['newwindow' => $new_window]);
      return $this->menuRepo->update($request->all(), $id);
  }

}

 ?>
