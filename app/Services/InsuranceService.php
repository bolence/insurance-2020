<?php

namespace App\Service;

use Cache;
use Exception;
use App\Vehicle;
use App\Insurance;
use App\Service\LoggerService;


class InsuranceService {

    /**
     * Undocumented function
     *
     * @param [type] $limit
     * @return void
     */
    public function get_insurances( $limit = null )
    {

        $columns = ['Vozilo', 'Reg.broj','Os.društvo', 'Broj polise', 'Premija', 'Datum polise'];

        return response()->json([
            'title' => 'Osiguranje - 10 poslednjih unetih osiguranja',
            'data' => $this->cacheable($limit),
            'columns' => $columns
             ]);

    }


    public function save_insurance( $request )
    {

        try
        {
            $new_insurance = Insurance::create( $request->all() );
        }
        catch( Exception $e )
        {
            LoggerService::log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            return response()->json(['success' => false, 'message' => $e->getMessage() ], 400 );
        }

        LoggerService::log( 'Novo osiguranje u bazi ' . $new_insurance );

        $vehicles = $this->delete_and_return_cache();

        return response()->json(['success' => true, 'message' => 'Uspešno dodato novo osiguranje', 'data' => $vehicles], 200);

    }



    private function cacheable( $limit )
    {
        return Cache::remember('vehicles', 1800, function() use( $limit ) {
            return Vehicle::with('insurance', 'damages', 'register_changes', 'archive', 'files')->orderBy('id', 'desc')->limit($limit)->get();
        });

    }

    /**
     * Delete and return cache
     *
     * @return Cache
     */
    private function delete_and_return_cache($cache_time = 1800)
    {
        Cache::forget('vehicles');

        $vehicles = Vehicle::with('insurance', 'damages', 'register_changes', 'archive', 'files')
        ->orderBy('id', 'desc')
        ->get();

        Cache::put('vehicles', $vehicles, $cache_time);

        return Cache::get('vehicles');
    }


}
