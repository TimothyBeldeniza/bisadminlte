<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
       
            $table->increments('id');
            $table->string('typeOfNews');
            $table->string('newsTitle');
            $table->string('newsDescriptions');
            $table->unsignedInteger('userId');
            $table->foreign('userId')
            ->references('id') 
            ->on('users') 
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
