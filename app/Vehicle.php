<?php

namespace App;

use Cache;
use App\File;
use App\Kasko;
use App\Damage;
use App\Insurance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{

    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id'];


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


       /**
     * Relationships with damages table
     *
     * @return HasMany
     */
    public function damages()
    {
        return $this->hasMany(Damage::class);
    }

    /**
     * Relationships with insurance table
     *
     * @return void
     */
    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }

    public function archive()
    {
        return $this->hasMany(InsuranceArchive::class);
    }

    /**
     * Relationships with kasko table
     *
     * @return HasOne
     */
    public function kasko()
    {
        return $this->hasOne(Kasko::class);
    }


    public function files()
    {
        return $this->hasMany( File::class );
    }


    public function register_changes()
    {
        return $this->hasMany(RegistrationChange::class);
    }


    public function napomene()
    {
        return $this->hasMany(Napomena::class);
    }

}
