<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqEquipamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_equipamento', function (Blueprint $table) {
            $table->id('idReqEquipamento');
            $table->string('idEquipamento',20);
            $table->string('req',20);
            $table->text('obs')-nullable();
            $table->date('data_req');
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
        Schema::dropIfExists('req_equipamento');
    }
}
