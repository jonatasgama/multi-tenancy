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
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gasto_id');
            $table->integer('quantidade');
            $table->decimal('valor_unidade', $precision = 10, $scale = 2);
            $table->date('data_saida');
            $table->timestamps();
            $table->foreign('gasto_id')->references('id')->on('gastos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saidas');
    }
};
