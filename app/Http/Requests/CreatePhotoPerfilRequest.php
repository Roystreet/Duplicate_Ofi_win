<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PhotoPerfil;

class CreatePhotoPerfilRequest extends FormRequest
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
        return PhotoPerfil::$rules;
    }

    public function attributes()
    {
      return [
        'id_users' => 'Uusarios',
        'url_photo'    => 'Foto'

        ];
    }

}
