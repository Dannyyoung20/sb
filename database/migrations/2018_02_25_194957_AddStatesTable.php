<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    /**
     *  Configured the package for the states.
     *
     *  https://github.com/bodunadebiyi/Laravel-Nig-States-LocalGovt
     * 
     *  Seed database with:  php artisan db:seed --class=SlgTableSeeder
     */
    
    public function up()
    {
      Schema::create("states", function (Blueprint $table)
      {
        $table->increments('id');
        $table->string('name');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('states');
    }
}
