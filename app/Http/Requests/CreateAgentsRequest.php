<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateAgentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return User::$rules;
    }

    public function attributes()
    {
      return [
        'nombres'             => 'Nombres',
        'apellidos'           => 'Apellidos',
        'email'               => 'E-mail',
        'f_nacimiento'        => 'Fecha de Nacimiento',
        'id_tp_sexo'          => 'Sexo',
        'telefono'            => 'Teléfono',
        'id_country'          => 'Pais',
        'id_departament'      => 'Departamento',
        'id_city'             => 'Cíudad',
        'id_distrito'         => 'Distrito',
        'usuario'             => 'Usuarios APP'
        ];
    }
}
