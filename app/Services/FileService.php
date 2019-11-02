<?php namespace App\Services;

use File;
use App\Vehicle;
use App\File as VehicleFile;
use App\Service\LoggerService;


class FileService {


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

    /**
     * Save vehicle files related to vehicle
     *
     * @param Array $request
     * @return Response json
     */
    public function save($request)
    {

        $file = $request->file('file');
        $vehicle_id = $request->get('vehicle_id');

        if( $file )
        {

            try {
                VehicleFile::create([
                    'filename' => $file->getClientOriginalName(),
                    'vehicle_id' => $vehicle_id
                ]);

                File::makeDirectory('uploads/' . $vehicle_id, 0777, true, true);

                $destinationPath = 'uploads/' . $vehicle_id;
                $file->move($destinationPath,$file->getClientOriginalName());

            } catch (Exception $e) {
                $this->logger->log( $e->getMessage() );
                return response()->json(['success' => false, 'message' => $e->getMessage() ], 400);
            }

        }

        $vehicle = Vehicle::with('files')->findOrFail($vehicle_id);

        return response()->json(['success' => true, 'message' => 'Uspešno uplodovani fajlovi', 'data' => $vehicle], 200);
    }


    /**
     * Undocumented function
     *
     * @param [type] $file_id
     * @return void
     */
    public function delete( $file_id )
    {

        $file = VehicleFile::findOrFail($file_id);

        try
        {
            $file->delete();
            File::delete('uploads/' . $file->vehicle_id . '/' . $file->filename);
        }
        catch ( Exception $e )
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()],400);
        }

        $vehicle = Vehicle::with('files')->find($file->vehicle_id);

        return response()->json(['success' => false, 'message' => 'Uspešno izbrisan fajl', 'data' => $vehicle ],200);

    }


}
