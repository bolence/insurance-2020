<?php

namespace App\Service;

use Cache;
use Exception;
use App\Vehicle;
use App\Insurance;
use App\Service\LoggerService;


class InsuranceService {


    protected $logger;

    public function __construct(LoggerService $logger)
    {
        $this->logger = $logger;
    }


    public function save( $request )
    {

        try
        {
            $new_insurance = Insurance::create( $request->all() );
            Insurance::where('vehicle_id', '=', $request->get('vehicle_id'))->orderBy('id', 'asc')->first()->delete();
        }
        catch( Exception $e )
        {
            $this->logger->log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            return response()->json(['success' => false, 'message' => $e->getMessage() ], 400 );
        }

        $this->logger->log( 'Novo osiguranje u bazi ' . $new_insurance );

        return response()->json(['message' => 'Uspešno dodato novo osiguranje', 'data' => $this->return_vehicles_order_by()], 200);

    }


         /**
     * Helper function to return vehicles ordered by
     *
     * @return void
     */
    private function return_vehicles_order_by()
    {

        $vehicles = Cache::remember('vehicles', 3600, function() {

            return Vehicle::with('insurance','kasko', 'files', 'damage', 'register_changes', 'archive')->orderBy('id', 'desc')->get();

        });

        return $vehicles;

    }


}
