<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 23);
            $table->smallInteger('category');
            $table->string('resource_name', 100);
            $table->integer('quantity');
            $table->string('content');
            $table->tinyInteger('unit')->default(0);
            $table->integer('price');
            $table->smallInteger('place');
            $table->tinyInteger('status')->default(0);
            $table->text('demand_msg');
            $table->string('demand_voice', 200);
            $table->tinyInteger('valid')->default(0);
            $table->dateTime('expire');
            $table->softDeletes();
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
        Schema::drop('demands');
    }
}
