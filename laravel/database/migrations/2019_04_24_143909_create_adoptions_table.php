<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid')->unsigned();
            $table->bigInteger('animalid')->unsigned();
            $table->enum('status',['pending','accepted','rejected'])->default('pending','withdrawn');
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('animalid')->references('id')->on('animals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
}
