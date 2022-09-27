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
        Schema::create('healthyhistories', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('animal_id');
            $table->integer('vetdoctor_id');
            $table->string('Daignosis');
            $table->string('Treatment');
            $table->longText('Recommendation');
            $table->date('DoR')->nullable();
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
        Schema::dropIfExists('healthyhistories');
    }
};
