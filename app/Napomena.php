<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Napomena extends Model
{

    use SoftDeletes;

    public $table = 'napomena';

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'created_at', 'deleted_at'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
