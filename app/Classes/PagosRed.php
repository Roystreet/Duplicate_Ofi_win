<?php
namespace App\Classes;
use App\Classes\Red;
class PagosRed{

    function getPagos($usuario){
        $config_red = ['2'=>15,'3'=>2.5,'4'=>2.5
        ,'5'=>2.5,'6'=>2.5,'7'=>2.5,'8'=>2.5,'9'=>2.5,'10'=>2.5,'11'=>2.5
        ,'12'=>2.5,'13'=>2.5,'14'=>2.5,'15'=>2.5,'16'=>2.5,'17'=>2.5
        ,'18'=>2.5,'19'=>2.5,'21'=>2.5,'22'=>2.5,'23'=>2.5,'24'=>2.5
        ,'25'=>2.5,'26'=>2.5,'27'=>2.5,'28'=>2.5,'29'=>2.5,'30'=>2.5
        ,'31'=>2.5,'32'=>2.5,'32'=>2.5,'33'=>2.5,'34'=>2.5,'35'=>2.5
        ,'36'=>2.5,'37'=>2.5];
        $sum = 0;
        foreach ($config_red as $key => $value) {
            $sum = $sum +$value;
        }
        $red = new Red();
        $data = $red->getRedBase($usuario);//('wilder015');
        $agrupado = $this->agrupar($data);
        return $this->asignarMonto($agrupado,$config_red,20);
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
