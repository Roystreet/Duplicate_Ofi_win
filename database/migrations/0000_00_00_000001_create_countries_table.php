<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('country')->unique()->nullable();
            $table->text('code_country')->unique()->nullable();
            $table->text('code_phone')->unique()->nullable();
            $table->text('moneda_local')->nullable();
            $table->text('moneda_admitida')->nullable();
            $table->text('simbolo_local')->nullable();
            $table->text('simbolo_admitida')->nullable();
            $table->double('conversion_monto', 10, 2)->nullable();
            $table->text('url_image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
