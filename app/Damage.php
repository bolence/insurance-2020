<?php

namespace App;

use App\Vehicle;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Damage extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'datum_udesa'];


    public static function boot()
    {

        parent::boot();

        static::deleting( function() {
            Cache::forget('damages');
        });

        static::creating( function() {
            Cache::forget('damages');
        });

        static::updating( function() {
            Cache::forget('damages');
        });

    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
