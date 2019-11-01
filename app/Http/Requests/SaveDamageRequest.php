<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveDamageRequest extends FormRequest
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
            'mesto_udesa'   => 'required',
            'ime_vozaca'    => 'required',
            'kriv'          => 'required',
            'datum_udesa'   => 'required|date',
            'opis'          => 'required',
            'value'         => 'required'
        ];
    }


    public function messages()
    {
        return [
            'mesto_udesa.required'  => 'Obavezno polje',
            'ime_vozaca.required'   => 'Obavezno polje',
            'kriv.required'         => 'Obavezno polje',
            'datum_udesa.required'  => 'Obavezno polje',
            'datum_udesa.date'      => 'Mora biti datum',
            'opis.required'         => 'Obavezno polje',
            'value.required'        => 'Obavezno polje',
        ];
    }
}
