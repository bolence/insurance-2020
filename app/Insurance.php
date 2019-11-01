<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


    /**
     * Format date
     *
     * @param Date
     * @return void
     */
    public function setDatumIsticanjaOsiguranjaAttribute($value) {
        $this->attributes['datum_isticanja_osiguranja'] = date('Y-m-d', strtotime($value) );
    }



}
