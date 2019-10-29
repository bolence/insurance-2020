<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }



}
