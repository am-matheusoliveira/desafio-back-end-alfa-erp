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
        Schema::create('tb_estrategia_wms_horario_prioridade', function (Blueprint $table) {
            $table->bigIncrements('cd_estrategia_wms_horario_prioridade'); // Cria uma coluna auto-incremental `id` como chave primária
            $table->integer('cd_estrategia_wms'); // 
            $table->string('ds_horario_inicio', 10); //
            $table->string('ds_horario_final', 10); //
            $table->integer('nr_prioridade'); // 
            
            // Coluna para data e hora que será preenchida automaticamente
            $table->timestamp('dt_registro')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->timestamp('dt_modificado'); //

            // Definindo a chave estrangeira
            $table->foreign('cd_estrategia_wms')
                  ->references('cd_estrategia_wms')
                  ->on('tb_estrategia_wms')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('tb_estrategia_wms_horario_prioridade');
    }
};
