<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamento', function (Blueprint $table) {
            $table->id('idEquipamento');
            $table->string('et', 15)->nullable();
            $table->string('serial', 15)->nullable();
            $table->string('ramal', 20)->nullable();
            $table->string('gps', 50);
            $table->string('dono', 10);
            $table->string('idTipoEquipamento', 10);
            $table->string('ativo', 1)->nullable()  ;
            $table->timestamps();
        });
        /*
        Schema::create('setor_gps', function (Blueprint $table) {
            $table->id('idRegSetor');
            $table->string('cod_ini', 10);
            $table->string('cod_fim', 10);
            $table->string('desc', 20);
            $table->text('obs');
            $table->timestamps();
        });*/


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipamento');
    }
}
