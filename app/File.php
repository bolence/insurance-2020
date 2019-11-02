<?php

namespace App;

use App\Vehicle;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{

    use SoftDeletes;

    public $table = 'vehicles_files';

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
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
