<?php namespace App\Services;

use App\Kasko;
use Throwable;
use App\Vehicle;
use App\Service\LoggerService;
use Illuminate\Support\Facades\Cache;


class KaskoService {


    protected $logger;

    public function __construct(LoggerService $logger)
    {
        $this->logger = $logger;
    }


    public function save($request)
    {

        try {
            $kasko = Kasko::create($request);
        } catch (Throwable $e) {
            $this->logger->log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            return response()->json(['message' => 'Došlo je do greške prilikom snimanja kaska'], 400);
        }

        $this->logger->log( 'Novo kasko osiguranje u bazi ' . $kasko );

        return response()->json([
            'message'  => 'Uspešno dodato novo osiguranje',
            'vehicles' => $this->return_vehicles_order_by(),
            'count'    => Vehicle::count()]
            , 200);
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
