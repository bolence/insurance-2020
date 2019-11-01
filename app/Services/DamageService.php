<?php namespace App\Services;

use Exception;
use App\Damage;
use App\Service\LoggerService;
use Illuminate\Support\Facades\Request;

class DamageService
{

    /**
     * Get all damages
     *
     * @return void
     */
    public function get_damages( $limit = null )
    {
        $columns = ['Vozilo', 'Vozač', 'Datum', 'Mesto', 'Kriv', 'Iznos štete'];
        $data = Damage::with('vehicle')->orderBy('id', 'desc')->limit($limit)->get();
        return response()->json([
            // 'data' => $this->cacheable('vehicles', $data), // return in production
            'data' => $data,
            'totalRecords' => Damage::count(),
            'columns' => $columns,
            // 'title' => 'Poslednjih 10 unetih vozila'
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function save_damage( $request )
    {

        $request['vehicle_id'] = $request['value']['id'];

        try
        {
            $damage = Damage::create( $request->except('value') );
        }
        catch( Exception $e )
        {
            LoggerService::log( $e->getMessage(), 'error' );
            return response()->json(['message' => $e->getMessage(), 'success' => false], 400);
        }

        LoggerService::log('Successfully saved damage: ' . $damage); // log saving

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
    public function update_damage( $request, $damage_id )
    {

        $damage = Damage::findOrfail( $damage_id );

        try
        {
            $damage->update( $request->except('value') );
        }
        catch ( Exception $e )
        {
            LoggerService::log( $e->getMessage(), 'error' );
            return response()->json(['message' => 'Šteta nije promenjena. Došlo je do greške ' . $damage_id, 'success' => false], 400);
        }

        LoggerService::log('Successfully updated damage: ' . $damage ); // log update

        $damages = Damage::with('vehicle')->orderBy('id', 'desc')->get(); // return data

        return response()->json(['message' => 'Uspešno promenjena šteta', 'success' => true, 'data' => $damages ], 200 );

    }


    public function show_damage( $damage_id )
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
    public function delete_damage( $damage_id )
    {

        $damage = Damage::find( $damage_id );

        try
        {
            $damage->delete();
        }
        catch( Exception $e )
        {
            LoggerService::log( $e->getMessage(), 'error');
            return response()->json(['message' => 'Šteta nije izbrisana šteta ' . $damage_id , 'success' => false], 400);
        }

        LoggerService::log('Successfully deleted damage: ' . $damage); // log delete

        $damages = Damage::with('vehicle')->orderBy('id', 'desc')->get(); // return data

        return response()->json(['message' => 'Uspešno izbrisana šteta', 'success' => true, 'data' => $damages ], 200);

    }

}
