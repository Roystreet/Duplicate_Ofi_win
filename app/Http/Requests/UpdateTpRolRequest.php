<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TpRol;

class UpdateTpRolRequest extends FormRequest
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
        $rules = TpRol::$rules;

        return $rules;
    }
    public function attributes()
    {
      return [
        'descripcion' => 'Descripción',

        ];
    }
}
