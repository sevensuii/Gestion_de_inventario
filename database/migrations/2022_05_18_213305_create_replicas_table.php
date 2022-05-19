<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replicas', function (Blueprint $table) {
            $table->id('id_replica');
            $table->string('codigo_qr')->unique();
            $table->string('incidencias')->nullable();

            $table->integer('objeto');
            $table->foreign('objeto')->references('id')->on('objetos');

            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replicas');
    }
}
