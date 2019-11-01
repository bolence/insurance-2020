<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceArchive extends Model
{

    use SoftDeletes;

    /** @var $table */
    public $table = 'insurance_archive';

    /** @var $guarded */
    protected $guarded = ['id'];

    /** @var $dates */
    protected $dates = ['created_at', 'created_at', 'deleted_at'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }


    public function setDatumIsticanjaOsiguranjaAttribute($value) {
        $this->attributes['datum_isticanja_osiguranja'] = date('Y-m-d', strtotime($value) );
    }

}
