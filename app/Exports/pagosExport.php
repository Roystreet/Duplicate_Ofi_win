<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Classes\Red;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use App\Classes\PagosRed;

class pagosExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $usuario)
    {
        set_time_limit(999999);
        $this->usuario = $usuario;
    }

    public function array(): array
    {
        $p = new PagosRed();
        return $p->getPagos($this->usuario)['red'];
    }

    public function headings(): array
    {
        return [
            'F. Creacion',
            'nombres',
            'apellidos',
            'email',
            'telefono',
            'id sponsor',
            'id_users_invitado',
            'usuario_invitado',
            'nivel',
            'puntos_ganados',
        ];
    }

    function asignarMonto(array $red_group,array $config, $puntos){
        $porcentajeAcumulado = 0;
        $puntosAcumulado = 0;
        $niveles = count($red_group)-1;
        if($niveles==0){
            return false;
        }
        foreach ($red_group as $key => $value) {
            foreach ($value as $key_1 => $value_1){
                if($value_1->level == 1){
                    continue;
                }
                $porcentaje = $config[$value_1->level];
                $value_1->puntos = (($porcentaje/100)*$puntos)/count($value);
                $puntosAcumulado = $puntosAcumulado+$value_1->puntos;
            }
        }
        $new_excel = [];
        foreach ($red_group as $key => $value) {
            foreach ($value as $key_1 => $value_1){
                array_push($new_excel,$value_1);
            }
        }


        return ["red"=>$new_excel,"puntos_sin_repartir"=>$puntos-$puntosAcumulado,"puntos_repartidos"=>$puntosAcumulado
        ,"puntos_sin_repartir_%"=>(($puntos-$puntosAcumulado)/$puntos)*100,"puntos_repartidos_%"=>100-((($puntos-$puntosAcumulado)/$puntos)*100)
        ];
    }

    function agrupar(array $red){
        $restante = 0;
        $niveles = [];
        foreach ($red as $key => $value){
            if(array_search($value->level, $niveles)){
                continue;
            }else{
            array_push($niveles,$value->level);
            }
        }
        $total= [];
        foreach ($niveles as $key_1 => $value_1) {
            $a_nivel = [];
            $o = new \stdClass();
            $o->nivel = $value_1;
            foreach ($red as $key_2 => $value_2) {
                if($value_2->level == $value_1){
                    $o->data = $value_2;
                    array_push($a_nivel,$value_2);
                    unset($red[$key_2]);
                }
            }
            array_push($total,$a_nivel);
        }

        return $total;
    }
}
