<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    /**
     * Undocumented function
     *
     * @return void
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }



}
