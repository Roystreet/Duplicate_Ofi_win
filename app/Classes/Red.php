<?php

namespace App\Classes;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Auth;
use View;

class Red{

    public function getRedBase($usuario,$where=""){

      return DB::select(
          "
          WITH RECURSIVE ctered AS
          (

            SELECT  0 as level, ua.*
            FROM app.users_red ur
            INNER JOIN app.vw_users_list as ua on ua.id = ur.id_users_invitado
            WHERE username = '".$usuario."'

              UNION ALL
            SELECT ctered.level + 1 as level, ua2.*
            FROM app.users_red  as r
            INNER JOIN app.vw_users_list as ua2 on ua2.id = r.id_users_invitado
            JOIN ctered ON r.id_users_sponsor = ctered.userid
          )
          SELECT * FROM ctered where level < 3
          ");
    }

    public function getMaxLevel($usuario){
       return  DB::select("WITH RECURSIVE ctered AS ( ".
        "    select id_users_sponsor,id_users_invitado ,usuario_invitado, 1 as level ".
        "  from app.users_red  where usuario_invitado = '".$usuario."' ".
        " UNION ALL ".
        "    select r.id_users_sponsor,r.id_users_invitado,r.usuario_invitado,ctered.level + 1 as level  ".
        "  from app.users_red  as r ".
       "        JOIN ctered ON r.id_users_sponsor = ctered.id_users_invitado ".
      ") ".
      "SELECT max(level) FROM ctered ; ");
    }

}
