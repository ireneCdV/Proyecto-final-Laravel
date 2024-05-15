<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrudCitaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
        [
			'fecha' => 'required',
			'hora' => 'required',
			'servicio_id' => 'required',
			'user_id' => 'required',
        ];
    }
}
