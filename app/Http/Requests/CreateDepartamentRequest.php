<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Departament;

class CreateDepartamentRequest extends FormRequest
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
        return Departament::$rules;
    }
    public function attributes()
    {
      return [
        'id_country'  => 'País',
        'departament' => 'Departamento',

        ];
    }

}
