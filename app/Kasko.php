<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasko extends Model
{

    use SoftDeletes;

    public $table = 'kasko';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'datum_isticanja_kasko'];

    protected $guarded = ['id'];


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
    public function setDatumIsticanjaKaskoAttribute($value) {
        $this->attributes['datum_isticanja_kasko'] = Carbon::parse($value)->addYear()->format('Y-m-d');
    }



    public function getDatumIsticanjaKaskoAttribute($value) {

        return Carbon::parse($value)->format('d.m.Y');
    }


    public function getVisinaPremijeKaskoAttribute($value) {

        return number_format($value, 2, ".", ',');
    }




}
