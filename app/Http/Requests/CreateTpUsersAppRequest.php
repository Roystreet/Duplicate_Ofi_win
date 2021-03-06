<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\TpUsersApp;

class CreateTpUsersAppRequest extends FormRequest
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
        return TpUsersApp::$rules;
    }
    public function attributes()
    {
      return [
          'status_users_app' => 'Estatus Usuarios APP'

        ];
    }
}
