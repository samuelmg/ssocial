<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadorProgramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestador_programa', function (Blueprint $table) {
            $table->foreignId('programa_id')->constrained();
            $table->unsignedBigInteger('prestador_id');

            $table->foreign('prestador_id')->references('id')->on('prestadores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestador_programa');
    }
}
