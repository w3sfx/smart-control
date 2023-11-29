<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('morador', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedInteger('apartamento_id');
            $table->timestamps();

            $table->foreign('apartamento_id')->references('id')->on('apartamento'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('morador');
    }
};
