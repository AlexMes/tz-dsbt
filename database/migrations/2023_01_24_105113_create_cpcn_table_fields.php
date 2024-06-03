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
        Schema::create('cpcn_table_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->string('name');
            $table->json('localization')->comment('json. Lang localization. (name, description...)');
            $table->json('type')->comment('XML. Type field. (str, int, another table...)');
            $table->timestamps();

            //id_table - внешний ключ.
            $table->foreign('table_id')
                ->references('id')
                ->on('cpcn_tables')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('cpcn_table_fields');
    }
};
