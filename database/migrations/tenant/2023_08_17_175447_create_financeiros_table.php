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
        Schema::create('financeiros', function (Blueprint $table) {
            $table->id();
            $table->date('data_registro');
            $table->unsignedBigInteger('tratamento_id')->nullable();
            $table->unsignedBigInteger('pagamento_id')->nullable();
            $table->unsignedBigInteger('consulta_id')->nullable();
            $table->string('pagamento', 255)->default('N/A');
            $table->decimal('valor_tratamento', $precision = 10, $scale = 2)->default(0.0);
            $table->unsignedBigInteger('gasto_id')->nullable();
            $table->integer('quantidade')->nullable();
            $table->decimal('valor_unidade', $precision = 10, $scale = 2)->nullable();
            $table->timestamps();
            $table->foreign('tratamento_id')->references('id')->on('tratamentos');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos');
            $table->foreign('gasto_id')->references('id')->on('gastos');
            $table->foreign('consulta_id')->references('id')->on('consultas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financeiros');
    }
};
