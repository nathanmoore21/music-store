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
    //includes what attributes I want included in my table for the music table
    {

        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('album');
            $table->string('genre');
            $table->integer('rating');
            $table->timestamps();
            // $table->unsignedBigInteger('artist_id');
            // $table->foreign('artist_id')->references('id')->on('artists')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music');
    }
};
