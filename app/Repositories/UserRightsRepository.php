<?php
namespace App\Repositories;

use App\Models\UserRight;

class UserRightsRepository
{
    function __construct(UserRight $userRight)
    {
        $this->userRight = $userRight;
    }
    function updateOrCreate($request){
        try{
            if(isset($request->rights) && is_array($request->rights)){
                $menu_ids = array_keys($request->rights);
                foreach($request->rights as $menu_id => $right){
                    $model = $this->userRight->updateOrCreate(
                      [
                        'user_id'   =>  $request->user_id,
                        'menu_id'   =>  $menu_id,
                      ],
                      [
                        'full'  =>  $right['full'] ?? 0,
                        'add'   =>  $right['add'] ?? 0,
                        'view'  =>  $right['view'] ?? 0,
                        'edit'  =>  $right['edit'] ?? 0,
                        'delete'    =>  $right['delete'] ?? 0,
                        'report'    =>  $right['report'] ?? 0,
                        'admin' =>  $right['admin'] ?? 0,
                        'admin_roles'   =>  $right['admin_roles'] ?? null
                      ]
                    );
                }
                $this->userRight->where('user_id', $request->user_id)->whereNotIn('menu_id', $menu_ids)->delete();
                return ['status' => true, 'message' => 'User Rights Updated'];
            }else{
                $this->userRight->where('user_id', $request->user_id)->delete();
                return ['status' => true, 'message' => 'All Rights Removed'];
            }

        }catch(\Exception $e){
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}

?>
