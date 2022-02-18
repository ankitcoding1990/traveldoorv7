<?php

namespace App\Models;

use App\Traits\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Special_offers_inquiry extends Model
{
    use SoftDeletes, MyModel;
    protected $table="special_offer_inquiry";

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function getfullnameAttribute()
    {
        return $this->fname. " " . $this->lname;
    }

}
