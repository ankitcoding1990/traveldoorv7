<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guide extends Model
{
    use MyModel;
    use SoftDeletes;
}
