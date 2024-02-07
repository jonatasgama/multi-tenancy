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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('sobrenome', 100);
            $table->date('dt_nascimento');
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->string('cep', 10);
            $table->string('cidade', 50);
            $table->string('endereco', 100);            
            $table->string('bairro', 50);
            $table->string('complemento', 250)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
