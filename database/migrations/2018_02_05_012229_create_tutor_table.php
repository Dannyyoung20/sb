<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tutor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullabe();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integar('phone')->unsigned();
            $table->integar('location_id')->unsigned();
            $table->rememberToken();
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
        Schema::table('Tutor', function (Blueprint $table) {
            //
        });
    }
}
