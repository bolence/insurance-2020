<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class VehiclePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [

            'vozilo'                     => 'required',
            'reg_broj'                   => 'required',
            'inv_broj'                   => 'required',
            'godina_proizvodnje'         => 'required',
            'os_drustvo'                 => 'required',
            'visina_premije'             => 'required',
            'datum_isticanja_osiguranja' => 'required',
            'broj_polise'                => 'required',

        ];

    }


    public function messages()
    {

        return [

            'vozilo.required'                       => 'Vozilo je obavezno polje',
            'reg_broj.required'                     => 'Reg. broj je obavezno polje',
            'inv_broj.required'                     => 'Inventarni broj je obavezno polje',
            'godina_proizvodnje.required'           => 'Godina je obavezno polje',
            'os_drustvo.required'                   => 'Os.društvo je obavezno polje',
            'visina_premije.required'               => 'Visina premije je obavezno polje',
            'datum_isticanja_osiguranja.required'   => 'Datum je obavezno polje',
            'broj_polise.required'                  => 'Broj polise je obavezno polje',

        ];
    }
}
