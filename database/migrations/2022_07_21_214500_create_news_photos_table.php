<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photoName');
            $table->string('path');
            $table->unsignedInteger('newsId');
            $table->foreign('newsId')
            ->references('id') 
            ->on('news') 
            ->onDelete('cascade');
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
        Schema::dropIfExists('news_photos');
    }
}
