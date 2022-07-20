<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opcao;

class OpcaoController extends Controller
{
    public function delete(Opcao $op_id, Request $r)
    {
        if($r->sizeofOpt > 3)
        {
            if(isset($op_id) && $op_id->id >= 0)
                $op_id->delete();    
        }
        return redirect()->back()->withInput();

    }

    public function votar(Request $r)
    {
        $obj_opcao = (new Opcao)::find($r->enq_resposta);
        $obj_opcao->votacoes += 1;
        $obj_opcao->save();
        return redirect()->back();
    }
}
