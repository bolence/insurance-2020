<?php namespace App\Services;

use Exception;
use App\Damage;
use App\Vehicle;
use App\Service\LoggerService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class DamageService
{

    protected $logger;

    public function __construct(LoggerService $logger)
    {
        $this->logger = $logger;
    }
    /**
     * Get all damages
     *
     * @return void
     */
    public function get()
    {
        $type = request()->input('type');

        $cache_name = isset($type) ? 'damages_' . $type : 'damages';

        $damages = Cache::remember($cache_name, 3600, function() use($type) {

            return !isset($type)
            ? Damage::with('vehicle')->orderBy('id', 'desc')->get()
            : Damage::with('vehicle')->where('kriv', '=', $type)->orderBy('id', 'desc')->get();

        });

        return response()->json([
            'damages' => $damages,
            'count' => $damages->count(),
            'count_vehicle' => Vehicle::count(),
        ], 200);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function save( $request )
    {

        $request['vehicle_id'] = $request['value']['id'];

        try
        {
            $damage = Damage::create( $request->except('value') );
        }
        catch( Exception $e )
        {
            $this->logger->log( $e->getMessage(), 'error' );
            return response()->json(['message' => $e->getMessage(), 'success' => false], 400);
        }

        $this->logger->log('Successfully saved damage: ' . $damage); // log saving

        $damages = Damage::with('vehicle')->orderBy('id', 'desc')->get(); // return data

        return response()->json(['message' => 'Uspešno snimljena nova šteta za ' . $request['value']['reg_broj'], 'data' => $damages, 'success' => true], 200);

    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $damage_id
     * @return void
     */
    public function update( $request, $damage_id )
    {

        $damage = Damage::findOrfail( $damage_id );

        try
        {
            $damage->update( $request->except('value') );
        }
        catch ( Exception $e )
        {
            $this->logger->log( $e->getMessage(), 'error' );
            return response()->json(['message' => 'Šteta nije promenjena. Došlo je do greške ' . $damage_id, 'success' => false], 400);
        }

        $this->logger->log('Successfully updated damage: ' . $damage ); // log update

        $damages = Damage::with('vehicle')->orderBy('id', 'desc')->get(); // return data

        return response()->json(['message' => 'Uspešno promenjena šteta', 'success' => true, 'data' => $damages ], 200 );

    }


    public function show( $damage_id )
    {
        $damage = Damage::with('vehicle')->findOrFail($damage_id);

        return response()->json($damage);
    }

    /**
     * Undocumented function
     *
     * @param [type] $damage
     * @return void
     */
    public function delete( $id )
    {

        $damage = Damage::findOrFail( $id );

        try
        {
            $damage->delete();
        }
        catch( Exception $e )
        {
            $this->logger->log( $e->getMessage(), 'error');
            return response()->json(['message' => 'Šteta nije izbrisana šteta ' . $id , 'success' => false], 400);
        }

        $this->logger->log('Successfully deleted damage: ' . $damage); // log delete

        $damages = Damage::with('vehicle')->orderBy('id', 'desc')->get(); // return data

        return response()->json([
            'message' => 'Uspešno izbrisana šteta',
            'count' => $damages->count(),
            'count_vehicle' => Vehicle::count(),
            'damages' => $damages
            ], 200);

    }

}
