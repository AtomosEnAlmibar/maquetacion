<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDirections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_directions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('t_clients');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->integer('postal code');
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
        Schema::dropIfExists('t_directions');
    }
}
