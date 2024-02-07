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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('tratamento_id');
            $table->unsignedBigInteger('pagamento_id');
            $table->dateTime('inicio_consulta', $precision = 0);
            $table->dateTime('fim_consulta', $precision = 0);
            $table->enum('pagamento', ['realizado','pendente']);
            $table->timestamps();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('tratamento_id')->references('id')->on('tratamentos');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropForeign('consultas_paciente_id_foreign');
            $table->dropForeign('consultas_tratamento_id_foreign');
            $table->dropForeign('consultas_pagamento_id_foreign');
        });
        Schema::dropIfExists('consultas');
    }
};
