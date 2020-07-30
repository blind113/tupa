<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_list', function (Blueprint $table) {
            $table->id();
            $table->string('gps', 10);
            $table->boolean('lacre')->nullable();
            $table->boolean('pc')->nullable();
            $table->boolean('monitor')->nullable();
            $table->boolean('mouse')->nullable();
            $table->boolean('teclado')->nullable();
            $table->boolean('cabo')->nullable();
            $table->boolean('certificado')->nullable();
            $table->text('obs')->nullable();
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
        Schema::dropIfExists('check_list');
    }
}
