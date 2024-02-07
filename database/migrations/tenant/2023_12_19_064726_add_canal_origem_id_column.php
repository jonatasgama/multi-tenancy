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
        Schema::table('pacientes', function (Blueprint $table) {
            $table->unsignedBigInteger('canal_origem_id')->nullable();
            $table->foreign('canal_origem_id')->references('id')->on('canais_de_origem');
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropForeign('pacientes_canal_origem_id_foreign');
            $table->dropColumn('canal_origem_id');
        });
    }
};
