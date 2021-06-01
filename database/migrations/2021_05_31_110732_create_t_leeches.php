<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTLeeches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_leeches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leech_data_id')->constrained('t_leeches_data');
            $table->integer("age");
            $table->boolean("visible");
            $table->boolean("active");
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
        Schema::dropIfExists('t_leeches');
    }
}
