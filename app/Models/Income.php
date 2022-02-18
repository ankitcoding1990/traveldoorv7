<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="incomes";
    protected $fillable = [
        'incomes_type','incomes_category_id','incomes_occured_on','incomes_amount','incomes_remarks','incomes_created_by'
    ];
    public function get_income_category()
    {
    	return $this->belongsTo('App\Models\IncomeExpenseCategory','incomes_category_id','id');
    }
}
