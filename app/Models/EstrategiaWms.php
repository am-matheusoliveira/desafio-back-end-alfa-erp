<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;
use PDOException;
use Symfony\Component\Console\Input\Input;

use function Psy\debug;

class EstrategiaWms extends Model
{
    use HasFactory;

    # BUSCA DOS REGISTROS
    public function select_register($cdEstrategia, $dsHora, $dsMinuto)
    {

        // Verifica se a hora ou minutos tem exatamente 2 caracteres
        $nv_hora    = (strlen($dsHora)   === 2) ? $dsHora   : str_pad($dsHora, 2,   '0', STR_PAD_LEFT);
        $nv_minutos = (strlen($dsMinuto) === 2) ? $dsMinuto : str_pad($dsMinuto, 2, '0', STR_PAD_LEFT);
        
        // Concatenando a Hora e Minutos
        $data_hora = $nv_hora.':'.$nv_minutos;

        // Buscando registro
        $result_estrategia_wms = DB::table('tb_estrategia_wms_horario_prioridade')
                                    ->where([
                                        ['cd_estrategia_wms', '=', $cdEstrategia],
                                        [DB::raw("TO_TIMESTAMP(ds_horario_inicio, 'HH24:MI')::TIME"), '<=', DB::raw("'".$data_hora."'"."::TIME")],
                                        [DB::raw("TO_TIMESTAMP(ds_horario_final, 'HH24:MI')::TIME"), '>=',  DB::raw("'".$data_hora."'"."::TIME")]
                                    
                                    ])
                                    ->select('nr_prioridade')->get();

        // Se a busca acima vir vazia, retornar o padrão
        if($result_estrategia_wms->count() === 0){
            $result_estrategia_wms = DB::table('tb_estrategia_wms')
                                        ->where('cd_estrategia_wms', '=', $cdEstrategia)
                                        ->select('nr_prioridade')->get();
        }

        // Novamente se a busca acima vir vazia, retornar 0 senão retornar o registro
        if($result_estrategia_wms->count() === 0){
            $response = response()->json( array('nr_prioridade' => 0), 200);
        }else{
            $response = response()->json( array('nr_prioridade' => $result_estrategia_wms[0]->nr_prioridade), 200);
        }

        // Retornando resposta
        return $response;
    }   

    # INSERÇÃO DO REGISTRO
    public function insert_register(Request $request)
    {
        // Inserindo na Tabela Pai
        DB::table('tb_estrategia_wms')->insert([
            'ds_estrategia_wms' => $request->input('dsEstrategia'),
            'nr_prioridade'     => $request->input('nrPrioridade'),
            'dt_modificado'     => date("Y-m-d H:i:s")
        ]);
        
        // Ultimo ID Inserido
        $ultimo_id = DB::getPdo()->lastInsertId();

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
        
        // Se correu tudo certo retorna True
        if($ultimo_id){
            $response = response()->json( array('exec_sucesso' => true), 200);
        }else{
            $response = response()->json( array('exec_sucesso' => false), 200);
        }

        // Retornando resposta
        return $response;        
    }
}
