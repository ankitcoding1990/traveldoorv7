<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuideExpense extends Model
{
    use MyModel;
    use SoftDeletes;
    protected $table="guide_expense";

    protected $fillable = [
        'guide_expense',
        'guide_expense_cost',
        'guide_expense_created_by'
    ];
}
