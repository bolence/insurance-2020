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

    /**
     * Undocumented function
     *
     * @param [type] $limit
     * @return void
     */
    public function get()
    {

        $insurance = Cache::remember('insurance', 3600, function () {
            return Insurance::with('vehicle.kasko')->orderBy('id', 'desc')->get();
        });

        return response()->json(['insurance' => $insurance], 200);

    }


    public function save( $request )
    {

        try
        {
            $new_insurance = Insurance::create( $request->all() );
        }
        catch( Exception $e )
        {
            $this->logger->log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            return response()->json(['success' => false, 'message' => $e->getMessage() ], 400 );
        }

        $this->logger->log( 'Novo osiguranje u bazi ' . $new_insurance );

        return response()->json(['success' => true, 'message' => 'Uspešno dodato novo osiguranje', 'data' => $vehicles], 200);

    }



    private function cacheable( $limit )
    {
        return Cache::remember('vehicles', 1800, function() use( $limit ) {
            return Vehicle::with('insurance', 'damages', 'register_changes', 'archive', 'files')->orderBy('id', 'desc')->limit($limit)->get();
        });

    }

}
