<?php
namespace App\Repositories;
use App\Models\Languages;
use Exception;
use Illuminate\Support\Facades\DB;


class LanguageRepository
{
    public function __construct(Languages $model)
    {
        $this->model = $model;
    }
    public function update($data, $id)
    {
        try{
           $this->model->find($id)->update($data);
           return ['title' => 'Success', 'message' => 'Language got updated!', 'type' => 'success', 'redirect' => route('languages.index')];
        }
        catch (Exception $err){
            return ['title' => 'failed','message' => 'Failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }
    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success', 'message' => 'Language got added!', 'type' => 'success', 'table' => 'languages-table'];
        }
        catch (Exception $err){
            return ['title' => 'failed','message' => 'Failed! due to'. $err->getMessage(), 'type' => 'error'];
        }

    }

    public function changeState($id, $state)
    {
        try {
            $bool = $state == 'active' ? '1' : '0';
            $this->model->where('id',$id)->update(['status' =>  $bool]);
            return ['title' => 'success', 'subject' => 'Language '.$state.'d','type' => 'success'];
        } catch (\Throwable $th) {
            return ['title' => 'success', 'subject' => 'Failed! Due to '.$th->getMessage(), 'type' => 'error'];
        }
    }

}

?>
