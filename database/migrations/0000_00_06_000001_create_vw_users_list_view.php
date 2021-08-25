<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVwUsersListView extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("
      CREATE OR REPLACE VIEW app.vw_users_list
      AS
      SELECT usr.id,
         usr.id AS userid,
         red.usuario_invitado AS username,
         usr.first_name,
         usr.last_name,
         usr.middle_name,
         usr.email AS public_email,
         usr.phone AS phone_base,
         usr.user_language,
             CASE
                 WHEN usr.phone IS NULL THEN NULL::text
                 ELSE concat('+', cou.code_phone, usr.phone)
             END AS public_phone,
             CASE
                 WHEN usr.phone IS NULL THEN NULL::text
                 ELSE concat('+', cou.code_phone)
             END AS phone_country,
             CASE
                 WHEN usr.phone IS NULL THEN NULL::text
                 ELSE concat('+', cou.code_phone, usr.phone)
             END AS phone_number,
         type_doc.description AS document_type,
         usr.n_document AS document_number,
         usr.birth,
         usr.id_status_users_app,
         status.status_users_app,
         usr.id_country,
         usr.id_departament,
         usr.id_city,
         usr.id_distrito,
         usr.address AS address_1,
         cou.country,
         dep.departament AS state_or_province,
         cit.city,
         dis.distrito,
         red.id_users_sponsor AS sponsor_id,
         red.id_status_red,
         st_red.descripcion AS status_red,
         usr.created_at,
         usr.updated_at,
         red.id_users_invitado
        FROM app.users usr
          LEFT JOIN app.users_red red ON red.id_users_invitado = usr.id
          LEFT JOIN app.status_reds st_red ON red.id_status_red = st_red.id
          LEFT JOIN app.status_users_apps status ON status.id = usr.id_status_users_app
          LEFT JOIN app.countries cou ON cou.id = usr.id_country
          LEFT JOIN app.departaments dep ON dep.id = usr.id_departament
          LEFT JOIN app.cities cit ON cit.id = usr.id_city
          LEFT JOIN app.distritos dis ON dis.id = usr.id_distrito
          LEFT JOIN app.tp_document_identies type_doc ON type_doc.id = usr.id_tp_document_identies");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("DROP VIEW vw_users_list");
    }
}
