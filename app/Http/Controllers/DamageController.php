<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DamageController extends Controller
{
    public function index()
    {
        return view('damages.index')->with(
            [
                'mainPageName' => 'Štete - ' . __('titles.main_page_name'),
                'pageName'  => 'Štete',
                'pageName2' => 'Vozila'
            ]
        );

}

}

