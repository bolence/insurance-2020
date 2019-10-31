<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\VehiclePostRequest;

class VehicleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vehicles = Cache::remember('vehicles', 3600, function () {
            return Vehicle::with('insurance')->orderBy('id', 'desc')->get();
        });

        return response()->json(['vehicles' => $vehicles, 'count' => Vehicle::count()], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiclePostRequest $request)
    {

        try {

            Vehicle::create( $request->all() );

        } catch (\Throwable $th) {

            Log::error('Update vehicle error: '  . $th->getMessage() );
            return response()->json(['message' => 'Snimanje vozila nije uspešno'], 400);

        }

        return response()->json(['message' => 'Novo vozilo uspešno snimljeno', 'vehicles' => $this->return_vehicles_order_by(), 'count' => Vehicle::count() ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $vehicle = Vehicle::findOrFail($id);
        return response()->json(['vehicle' => $vehicle], 200);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehiclePostRequest $request, $id)
    {

        $vehicle = Vehicle::findOrFail($id);

        try {

            $vehicle->update( $request->all() );

        } catch (Throwable $th) {

            Log::error('Update vehicle error: '  . $th->getMessage() );
            return response()->json(['message' => 'Izmena vozila nije uspešna'], 400);

        }

        return response()->json(['message' => 'Uspešno izmenjeno vozilo', 'vehicles' => $this->return_vehicles_order_by(), 'count' => Vehicle::count() ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $vehicle = Vehicle::findOrFail($id);

        try {

            $vehicle->delete();

        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'errors' => $th->getMessage()], 400);

        }

        return response()->json([ 'vehicles' => $this->return_vehicles_order_by() , 'count' => Vehicle::count() ], 200);

    }

    /**
     * Helper function to return vehicles ordered by
     *
     * @return void
     */
    private function return_vehicles_order_by()
    {
        return Vehicle::orderBy('id', 'desc')->get();
    }
}
