<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangayIdAppointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangay_id_appointment', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('transId');
            $table->date('date');
            $table->string('timeOfDay');
            $table->timestamps();
            $table->foreign('transId')
            ->references('id') 
            ->on('transactions') 
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
        Schema::dropIfExists('barangay_id_appointment');
    }
}
