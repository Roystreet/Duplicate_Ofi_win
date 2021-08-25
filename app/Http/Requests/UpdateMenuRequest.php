<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Menu;

class UpdateMenuRequest extends FormRequest
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
        $rules = Menu::$rules;

        return $rules;
    }
    public function attributes()
    {
      return [
        'menu'        => 'Menú',
        'section'     => 'Sección',
        'path'        => 'Trayecto',
        'icon'        => 'Icono',
        'note'        => 'Nota',
        'modified_by' => 'Modificado por'

        ];
    }
    
}
