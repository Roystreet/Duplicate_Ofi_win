<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_tp_sexo')->nullable();
          $table->integer('id_country')->nullable();
          $table->integer('id_departament')->nullable();
          $table->integer('id_city')->nullable();
          $table->integer('id_distrito')->nullable();
          $table->integer('id_tp_document_identies')->nullable();
          $table->text('n_document')->nullable();
          $table->text('first_name')->nullable();
          $table->text('middle_name')->nullable();
          $table->text('last_name')->nullable();
          $table->date('birth')->nullable();
          $table->text('phone')->unique()->nullable();
          $table->text('url_photo')->nullable();
          $table->text('email')->unique()->nullable();
          $table->text('address')->nullable();
          $table->timestamp('email_verified_at')->nullable();
          $table->text('user_language')->default('int_spa')->nullable();
          $table->string('password')->nullable();
          $table->boolean('isexterno')->default(true)->nullable();
          $table->integer('id_status_users_app')->nullable();
          $table->rememberToken();
          $table->timestamps();
          $table->softDeletes();
          $table->foreign('id_tp_sexo')->references('id')->on('tp_sexos');
          $table->foreign('id_country')->references('id')->on('countries');
          $table->foreign('id_departament')->references('id')->on('departaments');
          $table->foreign('id_city')->references('id')->on('cities');
          $table->foreign('id_distrito')->references('id')->on('distritos');
          $table->foreign('id_status_users_app')->references('id')->on('status_users_apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
