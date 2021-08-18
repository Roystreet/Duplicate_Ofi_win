<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Views\vw_user_app_data;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        set_time_limit(999999);
        return vw_user_app_data::whereNotNull('email')->
        select('username','email','first_name','last_name','public_phone','status_users_app','country','departament','city','distrito')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Usuario',
            'Correo',
            'Nombres',
            'Apellidos',
            'Celular',
            'Estado APP',
            'Pais',
            'departamento',
            'Ciudad',
            'distrito',
        ];
    }

}
