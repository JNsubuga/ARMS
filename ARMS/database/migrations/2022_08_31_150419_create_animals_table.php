<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('animalclass_id');
            $table->foreignId('staffmember_id');
            $table->string('maleParent')->nullable();
            $table->string('femaleParent')->nullable();
            $table->foreignId('gender_id');
            $table->string('breed');
            $table->date('DoJ');
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
};
