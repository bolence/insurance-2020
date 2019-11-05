<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\KaskoService;
use App\Http\Controllers\Controller;

class KaskoApiController extends Controller
{

    protected $kasko;

    public function __construct(KaskoService $kasko)
    {
        $this->kasko = $kasko;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->kasko->save($request->all());
    }


}
