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
        Schema::create('genre_music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('music_id');

            // $table->foreign('artist_id')->references('id')->on('artists')->onUpdate('cascade')->onDelete('restrict');

            // $table->foreign('genre_id')->references('id')->on('genres')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('music_id')->references('id')->on('musics')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('genre_id')->references('id')->on('genres')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('music_id')->references('id')->on('musics')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */


    // public function down()
    // {
    //     Schema::dropIfExists('genre_music');
    // }

    public function down()
    {
        Schema::table('genre_music', function (Blueprint $table) {
            // Schema::dropForeign('genre_id');
            // $table->dropForeign('music_id');
            Schema::dropIfExists('genre_music');
        });
    }
};
