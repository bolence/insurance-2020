<?php

namespace App;

use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'datum_isticanja_osiguranja'];



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


    // public function getDatumIsticanjaOsiguranjaAttribute($value) {

    //     return Carbon::parse($value)->format('d.m.Y');
    // }

    /**
     * Format date
     *
     * @param Date
     * @return void
     */
    public function setDatumIsticanjaOsiguranjaAttribute($value) {
        $this->attributes['datum_isticanja_osiguranja'] = Carbon::parse($value)->addYear()->format('Y-m-d');
    }



}
