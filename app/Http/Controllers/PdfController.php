<?php

namespace App\Http\Controllers;

use App\Damage;
use App\Vehicle;
use App\Insurance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pdf.reports')->with([
        'mainPageName' => 'Izveštaji - ' . __('titles.main_page_name'),
        'pageName'  => 'Izveštaji',
        'pageName2' => 'Izveštaji'
        ]);
    }


    public function report( Request $request )
    {

        $month = $request->month;
        $year  = $request->year;

        setlocale(LC_TIME, 'sr_CS');
        $month_name = strftime('%B', mktime(0, 0, 0, $month));

        $previous_year = $year - 1;

        $insurance = DB::select("SELECT
        vehicles.id as vehicle_id,
        vozilo,
        reg_broj as registracija,
        datum_udesa as steta,
        insurances.visina_premije,
        datum_udesa,
        datum_isticanja_osiguranja
        FROM
        vehicles
        JOIN (
        SELECT datum_isticanja_osiguranja, vehicle_id, visina_premije FROM insurances
        ) insurances ON vehicles.id = insurances.vehicle_id
        LEFT JOIN
        (
            SELECT datum_udesa, vehicle_id FROM damages where year(datum_udesa) = '.$previous_year . '
        ) damages ON damages.vehicle_id = vehicles.id
        WHERE MONTH(datum_isticanja_osiguranja) = '.$month.'
        AND year(datum_isticanja_osiguranja) = '.$year.'
        ORDER BY DATE(datum_isticanja_osiguranja) ASC
        ");

        $count_damages = 0;
        foreach( $insurance as $ins)
        {
            $count_damages += Damage::where('vehicle_id', '=', $ins->vehicle_id)->whereYear('datum_udesa', $previous_year)->count();
        }


        $insurance_sum = Insurance::whereMonth('datum_isticanja_osiguranja', '=', $month)
                                    ->whereYear('datum_isticanja_osiguranja', '=', $year)
                                    ->sum('visina_premije');

        $data = ['data' => $insurance, 'month' => ucfirst($month_name), 'year' => $year, 'sum' => $insurance_sum, 'count_damages' => $count_damages ];

        $pdf = PDF::loadView('pdf.report', $data)->setPaper('a4', 'landscape');

        $filename = 'isticanje_registracija_' . $month . '_mesec_' . $year . '_godina';

        return $pdf->download($filename . '.pdf');

    }


    public function report_damages(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        $damages = DB::select("SELECT
        * FROM damages d
        JOIN vehicles v
        ON v.id = d.vehicle_id
        WHERE YEAR(datum_udesa) = '.$year.'
        ORDER BY DATE(datum_udesa) ASC
        ");

        $data = ['data' => $damages, 'month' => $month, 'year' => $year ];

        $pdf = PDF::loadView('pdf.report_damages', $data)->setPaper('a4', 'landscape');

        $filename = 'stete_' . $year . '_godina';

        return $pdf->download($filename . '.pdf');

    }






}
