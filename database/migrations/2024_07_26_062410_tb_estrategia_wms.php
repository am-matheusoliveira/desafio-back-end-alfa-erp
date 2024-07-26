<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_estrategia_wms', function (Blueprint $table) {
            $table->bigIncrements('cd_estrategia_wms'); // Cria uma coluna auto-incremental `id` como chave primária
            $table->string('ds_estrategia_wms', 100); // 
            $table->integer('nr_prioridade'); // 
            
            // Coluna para data e hora que será preenchida automaticamente
            $table->timestamp('dt_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->timestamp('dt_modificado'); //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('tb_estrategia_wms');
    }
};
