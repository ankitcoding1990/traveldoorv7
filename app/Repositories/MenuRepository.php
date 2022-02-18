<?php
namespace App\Repositories;

use App\Models\Menu;
/**
 *
 MenuRepository.php
 */
class MenuRepository
{
  protected $menu;
  function __construct(Menu $menu)
  {
    $this->menu = $menu;
  }
  function store($data){
    try {
      $model = $this->menu->create($data);
      return ['status' => true, 'message' => 'Menu Added', 'data' => $model];
    } catch (\Exception $e) {
      return ['status' => false, 'message' => $e->getMessage()];
    }
  }

  function update($data, $id){
    try {
      $model = $this->menu->find($id);
      if ($model) {
        $model->update($data);
        return ['status' => true, 'message' => 'Menu Updated', 'menu' => $model];
      }
      throw new \Exception("Menu Not found!", 1);
    } catch (\Exception $e) {
      return ['status' => false, 'message' => $e->getMessage()];
    }
  }


}

 ?>
