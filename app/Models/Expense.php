<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="expenses";

    protected $fillable = [
        'expense_type','expense_category_id','expense_occured_on','expense_amount','expense_remarks','expense_created_by'
    ];
    public function get_expense_category()
    {
    	return $this->belongsTo('App\Models\IncomeExpenseCategory','expense_category_id','id');
    }
}
