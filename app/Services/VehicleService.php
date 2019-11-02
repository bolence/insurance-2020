<?php namespace App\Service;

use Exception;
use App\Vehicle;
use App\Insurance;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class VehicleService {


    protected $logger;

    /**
     * Class constructor
     *
     * @param LoggerService $logger
     */
    public function __construct(LoggerService $logger)
    {
        $this->logger = $logger;
    }


    public function get()
    {

        $vehicles = Cache::remember('vehicles', 3600, function () {
            return Vehicle::with('insurance', 'kasko', 'files')->orderBy('id', 'desc')->get();
        });

        return response()->json(['vehicles' => $vehicles, 'count' => Vehicle::count()], 200);
    }

    /**
     * Save vehicle with all his relationships
     *
     * @param  array    $request
     * @param  Vehicle  $vehicle
     * @return Response json
     */
    public function save($request)
    {

        DB::beginTransaction();

        try
        {
            // save new vehicle
            $vehicle = $this->vehicle_data($request);
            //save insurance for vehicle
            $vehicle->insurance()->save( $this->insurance_data($request) );

            DB::commit();

        }
        catch(Exception $e)
        {
            $this->logger->log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            DB::rollback();
            return response()->json(['message' => 'Snimanje vozila nije uspešno'], 400);
        }

        $this->logger->log('Novo vozilo u bazi ' . $vehicle);
        // $this->logger->log_to_db('insert', $vehicle);

        return response()->json([
            'message' => 'Novo vozilo uspešno snimljeno',
            'vehicles' => $this->return_vehicles_order_by(),
            'count' => Vehicle::count()
            ], 200);

    }


    /**
     * Show one vehicle by id
     *
     * @param integer $vehicle_id
     * @return void
     */
    public function show($id)
    {

        $vehicle = Cache::remember('vehicle_' . $id, 3600, function() use ($id) {

            return Vehicle::with('insurance', 'kasko', 'damages', 'files', 'register_changes', 'archive', 'napomene')
                            ->orderBy('id', 'desc')
                            ->findOrFail($id);

        });

        return $vehicle;
    }


    public function update( $request, $id)
    {

        $vehicle_request = $request->only('vozilo','reg_broj','ks','inv_broj','broj_sasije','broj_motora','godina_proizvodnje','ks','broj_sedista','radna_zapremina','dozvoljena_nosivost');

        $insurance_request = $request->only('os_drustvo','datum_isticanja_osiguranja','visina_premije','registracija','broj_polise');

        $kasko_request = $request->only('os_drustvo_kasko','datum_isticanja_kasko','visina_premije_kasko','broj_polise_kasko');

        $vehicle = Vehicle::findOrFail($id);

        DB::beginTransaction();

        try
        {
            $vehicle->fill( $vehicle_request );
            $vehicle->insurance->fill( $insurance_request );
            if ( $vehicle->kasko !== null && $request->os_drustvo_kasko !== null )
            {
                $vehicle->kasko->fill( $kasko_request );
            }elseif ( $request->os_drustvo_kasko !== null ) {
                $kasko_request['vehicle_id'] = $id;
                Kasko::create($kasko_request);
            }
            $vehicle->push();

            DB::commit();

        }
        catch(Exception $e)
        {
            $this->logger->log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Neuspešna izmena detalja vozila ' . $vehicle->reg_broj ], 400);
        }

        $this->logger->log('Izmenjeno vozilo ' . $vehicle);

        return response()->json([
            'success' => true,
            'message' => 'Uspešno izmenjeno vozilo ' . $vehicle->reg_broj,
            'vehicles' => $this->return_vehicles_order_by(),
            'count'    => Vehicle::count()
            ],200);
    }



    /**
     * Delete vehicle - soft delete (don't delete from db for now)
     *
     * @param integer $vehicle_id
     * @return void
     */
    public function delete($id)
    {

        $vehicle = Vehicle::findOrFail( $id );

        try
        {
            $vehicle->delete();

            if( $vehicle->insurance !== null  )
            {
                $vehicle->insurance->delete();
            }

            if($vehicle->kasko !== null )
            {
                $vehicle->kasko->delete();
            }

        }
        catch( Exception $e )
        {
            $this->logger->log( $e->getMessage() . ' on line ' . $e->getLine() . ' in file ' . $e->getFile() );
            return response()->json(['success' => false, 'message' => 'Greška prilikom brisanja vozila'], 400 );
        }

        $this->logger->log('Uspešno obrisano vozilo ' . $vehicle );

        return response()->json([
            'vehicles' => $this->return_vehicles_order_by(),
            'count' => Vehicle::count()
        ], 200);

    }


    /**
     * Vehicle data
     *
     * @param array $request
     * @return Object
     */
    private function vehicle_data($request)
    {

        $vehicle = new Vehicle;

        $vehicle->vozilo = $request->name;
        $vehicle->reg_broj = $request->reg_broj;
        $vehicle->broj_motora = $request->broj_motora;
        $vehicle->broj_sasije = $request->broj_sasije;
        $vehicle->ks = $request->ks;
        $vehicle->dozvoljena_nosivost = $request->dozvoljena_nosivost;
        $vehicle->godina_proizvodnje = $request->godina_proizvodnje;
        $vehicle->radna_zapremina = $request->radna_zapremina;
        $vehicle->broj_sedista = $request->broj_sedista;
        $vehicle->inv_broj = $request->inv_broj;
        $vehicle->save();

        return $vehicle;

    }


    /**
     * Insurance data
     *
     * @param  Array $request
     * @return Object
     */
    private function insurance_data( $request )
    {

        $insurance = new Insurance;

        $insurance->os_drustvo = $request->os_drustvo;
        $insurance->visina_premije = $request->visina_premije;
        $insurance->datum_isticanja_osiguranja = $request->datum_isticanja_osiguranja;
        $insurance->registracija = $request->registracija;
        $insurance->broj_polise = $request->broj_polise;

        return $insurance;

    }


     /**
     * Helper function to return vehicles ordered by
     *
     * @return void
     */
    private function return_vehicles_order_by()
    {

        $vehicles = Cache::remember('vehicles', 3600, function() {

            return Vehicle::with('insurance','kasko', 'files')->orderBy('id', 'desc')->get();

        });

        return $vehicles;

    }


}
