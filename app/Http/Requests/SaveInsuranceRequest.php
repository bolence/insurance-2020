<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveInsuranceRequest extends FormRequest
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
            'os_drustvo' => 'required',
            'broj_polise' => 'required',
            'datum_isticanja_osiguranja' => 'required',
            'visina_premije'   => 'required'
        ];
    }


    public function messages()
    {
        return [

            'os_drustvo.required' => 'Obavezno polje',
            'broj_polise.required' => 'Obavezno polje',
            'datum_isticanja_osiguranja.required' => 'Obavezno polje',
            'visina_premije.required' => 'Obavezno polje'

        ];
    }


}
