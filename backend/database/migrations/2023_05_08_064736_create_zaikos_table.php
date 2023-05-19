<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZaikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('zaikos')){
                Schema::create('zaikos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name',100);
                $table->text('kazu');
                $table->text('kakaku');
                $table->text('zyoutai');
                $table->text('shosai');
                $table->timestamps();
            });
        }
    }
        

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zaikos');
    }
}
