<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsideComplainantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outside_complainants', function (Blueprint $table) {
            $table->unsignedInteger('compId');
            $table->string('complainant');
            $table->string('address');
            $table->integer('contact');
            $table->timestamps();
            $table->foreign('compId')
            ->references('id') 
            ->on('complaints_transactions') 
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
        Schema::dropIfExists('outside_complainants');
    }
}
