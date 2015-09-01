<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id', 23)->unique();
            $table->tinyInteger('user_type');
            $table->string('real_name', 50);
            $table->string('contact_phone', 20);
            $table->string('email', 50);
            $table->smallInteger('place');
            $table->string('address', 150);
            $table->string('qq', 15);
            $table->string('fax', 20);
            $table->string('website', 200);
            $table->string('company', 100);
            $table->string('main_product', 500);
            $table->smallInteger('business_mode');
            $table->smallInteger('business_type');
            $table->string('avatar_url', 200);
            $table->tinyInteger('certified')->default(0);
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
        Schema::drop('user_details');
    }
}
