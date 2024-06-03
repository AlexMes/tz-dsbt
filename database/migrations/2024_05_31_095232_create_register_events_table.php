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
        Schema::create('register_events', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('from')->nullable();
            $table->foreign('from')->references('id')->on('employee')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('accepted')->nullable();
            $table->foreign('accepted')->references('id')->on('employee')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('equipment_id')->nullable();
            $table->foreign('equipment_id')->references('id')->on('equipment_list')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('register_events');
    }
};
