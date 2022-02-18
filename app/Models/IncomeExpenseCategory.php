<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeExpenseCategory extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="income_expense_category";

    protected $fillable = [
        'expense_category_name',
        'expense_category_created_by',
        'expense_category_status',
        'expense_category_type'
    ];

}
