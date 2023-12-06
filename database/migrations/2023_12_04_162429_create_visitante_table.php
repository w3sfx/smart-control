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
        Schema::create('visitante', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo');
            $table->string('nome');
            $table->text('descricao');
            $table->integer('status');
            $table->dateTime('data_entrada');
            $table->dateTime('data_saida')->nullable();
            $table->string('morador');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};
