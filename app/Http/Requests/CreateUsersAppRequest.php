<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class CreateUsersAppRequest extends FormRequest
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
        return User::$rules;
    }
    public function attributes()
    {
      return [
        'first_name'          => 'Nombres',
        'last_name'           => 'Apellidos',
        'email'               => 'E-mail',
        'birth'               => 'Fecha de Nacimiento',
        'id_tp_sexo'          => 'Sexo',
        'phone'               => 'Teléfono',
        'id_country'          => 'Pais',
        'id_departament'      => 'Departamento',
        'id_city'             => 'Cíudad',
        'id_distrito'         => 'Distrito',
        'id_status_users_app' => 'Estatus Usuarios APP'
        ];
    }
}
