<?php
namespace App\Traits;
use App\Events\SendMail;

trait MyModel{

    function scopeActive($query){
        return $query->where('status',  1);
    }
    function scopeInactive($query){
        return $query->where('status',  0);
    }
    static function softDeletes($id, $status = 'delete'){
        $message = ['status'=> false, 'message' => 'Something went wrong! Please try again.'];
        if($status == 'delete'){
            $model = self::find($id);
            if($model != null){
                $model->delete();
                // event(new SendMail(''));
                $message = ['status' => true, 'message' => 'Inactivated!'];
            }
        }else if($status == 'permanent'){
            $model = self::withTrashed()->find($id);
            if($model != null){
                $model->forceDelete();
                $message = ['status' => true, 'message' => 'One Record Permanently Deleted!'];
            }
        }else if($status == 'restore'){
            $model = self::withTrashed()->find($id);
            if($model != null){
                $model->restore();
                $message = ['status' => true, 'message' => 'One Record Restored!'];
            }
        }
        return $message;
    }

}
?>