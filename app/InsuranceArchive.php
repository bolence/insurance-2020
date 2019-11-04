<?php

namespace App;

use App\Vehicle;
use Carbon\Carbon;
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
    protected $dates = ['created_at', 'created_at', 'deleted_at', 'datum_isticanja_osiguranja'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }


    // public function setVisinaPremijeAttribute($value)
    // {
    //     $this->attributes['visina_premije'] = number_format($value, 2);
    // }


    public function setDatumIsticanjaOsiguranjaAttribute($value) {
        $this->attributes['datum_isticanja_osiguranja'] = Carbon::parse($value)->addYear()->format('Y-m-d');
    }

}
