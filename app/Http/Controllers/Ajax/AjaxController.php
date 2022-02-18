<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Supplier;
use App\Traits\MyModel;
use App\User;
use DB;
use Str;

class AjaxController extends Controller
{
  use MyModel;
    function __construct(Countries $country){
      $this->country=$country;
    }

    function getCountries(Request $request){
      $countries = Supplier::where('id',$request->supplier_id)->first()->operateCountries();
      $selected_country=$request->country_id;
      $html = view('ajax.supplier.countries', compact('countries', 'selected_country'));
      return response(['status' => true, 'html' => $html->render()]);
    }

    function getCitites(Request $request){
      $cities=$this->country->where('id', $request->country_id)->first()->cities;
      $selected_city=$request->city_id;
      $html = view('ajax.cities.select-html', compact('cities','selected_city'));
      return response(['status' => true, 'html' => $html->render()]);
    }

    function getRoleUsers(Request $request){
      $users = User::where('users_role', $request->role)->where('users_status', null)->get();
      $html = view('ajax.users.role-users', compact('users'));
      return response(['status' => true, 'html' => $html->render()]);
    }

    function activeOrInactive(Request $request, $id){
      $model_name = $request->model_name;
      $column = $request->column;
      $status = $request->status;
      // $modelName = 'App\\Models\\' . Str::studly(Str::singular($model_name));
      $modelName = 'App\\Models\\' .$model_name;
      $model = $modelName::withTrashed()->find($id);
      $res = $model->softDeletes($id, $status);
      if ($res['status']) {
          return response($res, 200);
      }
      return response($res, 401);

    }

}
