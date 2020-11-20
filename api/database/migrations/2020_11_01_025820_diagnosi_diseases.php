<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DiagnosiDiseases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosi_disease', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('diagnosi_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('disease_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosi_diseases');
    }
}
