<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTpDocumentIdentiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_document_identies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_country')->default(null);
            $table->text('description');
            $table->text('abbreviation');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_country')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tp_document_identies');
    }
}
