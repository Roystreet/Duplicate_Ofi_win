<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Session;

class CreateSessionRequest extends FormRequest
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
        return Session::$rules;
    }

    public function attributes()
    {
      return [
        'token'             => 'Token',
        'd_inicio'          => 'Día\Inicio',
        'h_inicio'          => 'Hora\Inicio',
        'd_fin'             => 'Día\Fin',
        'h_fin'             => 'Hora\Fin',
        'ip'                => 'IP',
        'navegador'         => 'Navegador',
        'id_status_session' => 'Estatus Sesión'

        ];
    }

}
