<?php

namespace App;

use App\Insurance;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{

    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id'];


    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }


    public static function boot()
    {

        parent::boot();

        static::deleting( function() {
            Cache::forget('vehicles');
        });

        static::creating( function() {
            Cache::forget('vehicles');
        });

        static::updating( function() {
            Cache::forget('vehicles');
        });
    }

}
