<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComposerMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composer_movie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('composer_id');
            $table->unsignedBigInteger('movie_id');
            $table->timestamps();
            $table->foreign('composer_id')
                ->references('id')
                ->on('composers')
                ->onDelete('cascade');
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composer_movie');
    }
}
