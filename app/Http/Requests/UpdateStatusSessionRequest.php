<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\StatusSession;

class UpdateStatusSessionRequest extends FormRequest
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
        $rules = StatusSession::$rules;

        return $rules;
    }

    public function attributes()
    {
      return [
        'status_session' => 'Estatus Sesión',

        ];
    }
}
