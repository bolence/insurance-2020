<?php

namespace App;

use App\Vehicle;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];



    public static function boot()
    {

        parent::boot();

        static::creating( function() {
            Cache::forget('vehicles');
        });

        static::updating( function() {
            Cache::forget('vehicles');
        });
    }


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
