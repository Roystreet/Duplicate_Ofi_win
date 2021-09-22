<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Classes\Red;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

class RedUserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $usuario)
    {
        set_time_limit(999999);
        $this->usuario = $usuario;
    }
    public function collection()
    {
        $u = new Red();
        return collect($u->getRedBase($this->usuario));
    }

    public function headings(): array
    {
        return [
            'F. Creacion',
            'nombres',
            'apellidos',
            'email',
            'phone',
            'id sponsor',
            'id_users',
            'username',
            'nivel',
        ];
    }


}
