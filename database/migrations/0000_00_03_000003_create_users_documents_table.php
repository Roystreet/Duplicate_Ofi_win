<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_documents', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_users')->default(null);
          $table->text('url_photo_front')->nullable();
          $table->text('url_photo_post')->nullable();
          $table->boolean('status')->default(true);
          $table->timestamps();
          $table->softDeletes();
          $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_documents');
    }
}
