<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class EstrategiaWms extends Model
{
    use HasFactory;

    # BUSCA DOS REGISTROS
    public function select_register($cdEstrategia, $dsHora, $dsMinuto)
    {
        // TRATAMENTO DE EXCEÇÃO PARA O PROCEDIMENTO
        try{

            // Verifica se a hora ou minutos tem exatamente 2 caracteres
            $nv_hora    = str_pad($dsHora, 2,   '0', STR_PAD_LEFT);
            $nv_minutos = str_pad($dsMinuto, 2, '0', STR_PAD_LEFT);
            
            // Concatenando a Hora e Minutos
            $data_hora = $nv_hora.':'.$nv_minutos;

            // Buscando registro
            $result_estrategia_wms = DB::table('tb_estrategia_wms_horario_prioridade')
                                        ->where([
                                            ['cd_estrategia_wms', '=', $cdEstrategia],
                                            [DB::raw("TO_TIMESTAMP(ds_horario_inicio, 'HH24:MI')::TIME"), '<=', DB::raw("'".$data_hora."'"."::TIME")],
                                            [DB::raw("TO_TIMESTAMP(ds_horario_final, 'HH24:MI')::TIME"), '>=',  DB::raw("'".$data_hora."'"."::TIME")]
                                        
                                        ])
                                        ->select('nr_prioridade')
                                        ->first();

            // Se a busca acima vir vazia, retornar o padrão
            if(!$result_estrategia_wms){
                $result_estrategia_wms = DB::table('tb_estrategia_wms')
                                            ->where('cd_estrategia_wms', '=', $cdEstrategia)
                                            ->select('nr_prioridade')
                                            ->first();
            }

            // Novamente se a busca acima vir vazia, retornar uma mensagem, senão retornar o registro
            if(!$result_estrategia_wms){

                $response = response()->json(['nr_prioridade' => 'Nenhuma prioridade foi encontrada!'], 200);

            }else{
                
                $response = response()->json(['nr_prioridade' => $result_estrategia_wms->nr_prioridade], 200);
                
            }

        // Erros da aplicação
        }catch(Exception $erro){        
            
            $response = response()->json(['exec_erro' => 'Erro, não foi possível realizar a busca do(s) registro(s), por favor tente novamente!'], 400);

        }finally{

            // Retornando resposta
            return $response;
        }
    }   

    # INSERÇÃO DO REGISTRO
    public function insert_register(Request $request)
    {

        // TRATAMENTO DE EXCEÇÃO PARA O PROCEDIMENTO
        try{

            DB::transaction(function () use ($request) {

                // Inserindo na Tabela Pai
                $ultimo_id = DB::table('tb_estrategia_wms')->insertGetId([
                    'ds_estrategia_wms' => $request->input('dsEstrategia'),
                    'nr_prioridade'     => $request->input('nrPrioridade'),
                    'dt_modificado'     => date("Y-m-d H:i:s")
                ], 'cd_estrategia_wms');                           

                // Inserindo na Tabela Filha
                foreach($request->input('horarios') as $registro){
                    DB::table('tb_estrategia_wms_horario_prioridade')->insert([
                        'cd_estrategia_wms' => $ultimo_id,
                        'ds_horario_inicio' => $registro['dsHorarioInicio'],
                        'ds_horario_final'  => $registro['dsHorarioFinal'],
                        'nr_prioridade'     => $registro['nrPrioridade'],
                        'dt_modificado'     => date("Y-m-d H:i:s")                       
                    ]);
                }
            });

            $response = response()->json( array('exec_sucesso' => 'Registro(s) salvo(s) com sucesso!'), 200);

        // Erros da aplicação
        }catch(Exception $erro){
            
            $response = response()->json( array('exec_erro' => 'Erro, não foi possível salvar o(s) registro(s)!'), 400);

        }finally{

            // Retornando resposta
            return $response;
        }
    }
}
