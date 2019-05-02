<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 15);
            $table->date('dob');
            $table->longText('description',256)->nullable();
            $table->string('title', 60);
            $table->enum('status', ['available', 'adopted'])->default('available');
            $table->enum('type', ['birds','cats','dogs','fish','horses','invertebrates','poultry','rabbits','reptiles','rodents','others']);
            $table->string('image',256)->nullable();
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
        Schema::dropIfExists('animals');
    }
}
