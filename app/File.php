<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class)
    }

}
