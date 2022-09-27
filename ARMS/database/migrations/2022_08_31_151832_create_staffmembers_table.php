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
        Schema::create('staffmembers', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('animalclass_id');
            $table->string('Names');
            $table->date('DoB');
            $table->string('NoK');
            $table->string('Address');
            $table->string('PoB');
            $table->string('title');
            $table->string('Qualification');
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
        Schema::dropIfExists('staffmembers');
    }
};
