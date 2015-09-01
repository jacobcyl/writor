<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 23);
            $table->integer('category');
            $table->string('resource_name', 100);
            $table->integer('quantity');
            $table->integer('unit')->nullable()->default(0);
            $table->integer('price');
            $table->string('content')->nullable()->default("");
            $table->integer('place');
            $table->string('img');
            $table->integer('video')->nullable()->default(0);
            $table->tinyInteger('status')->default(1); //COMMENT '上架/下架',
            $table->tinyInteger('valid')->default(1);
            $table->integer('view_count')->nullable()->default(0);//浏览总数
            $table->string('expire');
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
        Schema::drop('resources');
    }
}
