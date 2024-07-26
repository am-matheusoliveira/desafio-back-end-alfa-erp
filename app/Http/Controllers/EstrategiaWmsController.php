<?php

namespace App\Http\Controllers;

use App\Models\EstrategiaWms;
use Illuminate\Http\Request;

class EstrategiaWmsController extends Controller
{

    # BUSCA DOS REGISTROS
    public function index($cdEstrategia, $dsHora, $dsMinuto, EstrategiaWms $estrategia_wms)
    {

        $result_estrategia_wms = $estrategia_wms->select_register($cdEstrategia, $dsHora, $dsMinuto);

        return $result_estrategia_wms;
    }

    # INSERÇÃO DO REGISTRO
    public function estrategia_wms_insert(Request $request, EstrategiaWms $estrategia_wms)
    {   

        $result_estrategia_wms = $estrategia_wms->insert_register($request);

        return $result_estrategia_wms;       
    }  
}
