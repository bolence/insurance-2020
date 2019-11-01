<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasko extends Model
{

    use SoftDeletes;

    public $table = 'kasko';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = ['id'];

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
