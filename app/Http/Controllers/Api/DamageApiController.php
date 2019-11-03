<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\DamageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveDamageRequest;

class DamageApiController extends Controller
{
    protected $damage;

    /**
     * Undocumented function
     *
     * @param DamageService $damage
     */
    public function __construct( DamageService $damage )
    {
        $this->damage = $damage;
    }

    /**
     * View all damges
     *
     * @return void
     */
    public function index()
    {
        return $this->damage->get();
    }

    /**
     * View damage
     *
     * @param integer $damage_id
     * @return void
     */
    public function show( $damage_id )
    {
        return $this->damage->show( $damage_id );
    }

    public function store( SaveDamageRequest $request )
    {
        return $this->damage->save( $request );
    }


    public function update(SaveDamageRequest $request, $damage_id)
    {
        return $this->damage->update( $request, $damage_id );
    }

    /**
     * Delete damage
     *
     * @param integer $damage_id
     * @return void
     */
    public function destroy( $damage_id )
    {
        return $this->damage->delete( $damage_id );
    }

}
