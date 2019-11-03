<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationChange extends Model
{

    use SoftDeletes;

    public $table = 'registration_changes';

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
