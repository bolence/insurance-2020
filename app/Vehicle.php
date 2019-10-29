<?php

namespace App;

use App\Insurance;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id'];


    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }

}
