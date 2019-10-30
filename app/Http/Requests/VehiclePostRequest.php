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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [

            'vozilo'             => 'required',
            'reg_broj'           => 'required',
            'inv_broj'           => 'required',
            'godina_proizvodnje' => 'required'

        ];

    }


    public function messages()
    {

        return [

            'vozilo.required'             => 'Vozilo je obavezno polje',
            'reg_broj.required'           => 'Registarski broj je obavezno polje',
            'inv_broj.required'           => 'Inventarni broj je obavezno polje',
            'godina_proizvodnje.required' => 'Godina je obavezno polje'

        ];
    }
}
