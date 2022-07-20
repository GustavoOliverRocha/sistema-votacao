<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquete;
use App\Models\Opcao;

class EnqueteController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enquete.enqueteForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        //dd($request->opcoes);
        $errors = [];
        $obj_enquete = new Enquete();

        if(strlen($request->titulo) < 6)
            array_push($errors, '*Titulo tem que ter mais de 6 caracteres');

        if(strlen($request->dt_inicio) < 10 || strlen($request->dt_fim) < 10)
            array_push($errors, '*Nenhuma data pode ser Vazia');

        foreach($request->opcoes as $opt)
        {
            if(strlen($opt) === 0)
            {
                array_push($errors, '*Nenhuma resposta pode ficar vazia');
                break;
            }
        }

        if(sizeof($errors) > 0)
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($errors);

        $obj_enquete->titulo = $request->titulo;
        $obj_enquete->start_date = $request->dt_inicio;
        $obj_enquete->end_date = $request->dt_fim;

        $obj_enquete->save();

        $lastInsertId = $obj_enquete->id;

        $ops = []; 

        foreach($request->opcoes as $op)
        {
            $obj_enquete->opcoes()->create([
                'resposta' => $op,
                'votacoes' => 0
            ]);
        }

        return redirect()->route('enquete.show');
    }

    /**
     * Display all resources.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $obj_enquete = (new Enquete())::all();
        return view('enquete.enqueteList',[
            'enquete' => $obj_enquete
        ]);
    }

    public function showAnswers(Enquete $enq_id)
    {
        //dd('2022-07-03' > date('Y-m-d')); 

        $answers = $enq_id->opcoes()
        ->select('opcao.id','resposta','votacoes')
        ->get();

        return view('enquete.enqueteAnswers',[
            'enquete' => $enq_id,
            'respostas' => $answers
        ]);
    }

    public function renderizarRespostas(Enquete $enq_id)
    {
        $answers = $enq_id->opcoes()
        ->select('opcao.id','resposta','votacoes')
        ->get();

         return view('enquete.components.enqueteAnswer',[
            'respostas' => $answers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editForm(Enquete $enq_id)
    {
        $enq_respostas = $enq_id->opcoes()
            ->select('opcao.id','resposta')
            ->where('enquete_id',$enq_id->id)
            ->get();

        //dd($enq_respostas);

        return view('enquete.enqueteEditForm',[
            'enquete' => $enq_id,
            'respostas' => $enq_respostas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Enquete $enq_id)
    {
        $errors = [];

        if(strlen($request->titulo) < 6)
            array_push($errors, '*Titulo tem que ter mais de 6 caracteres');

        if(strlen($request->dt_inicio) < 10 || strlen($request->dt_fim) < 10)
            array_push($errors, '*Nenhuma data pode ser Vazia');

        foreach($request->opcoes as $opt)
        {
            if(strlen($opt) === 0)
            {
                array_push($errors, '*Nenhuma resposta pode ficar vazia');
                break;
            }
        }
        if(sizeof($errors) > 0)
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($errors);
                    
        $enq_id->titulo = $request->titulo;
        $enq_id->start_date = $request->dt_inicio;
        $enq_id->end_date = $request->dt_fim;

        $i = 0;
        $optSize = sizeof($request->opcoes);

        for($i = 0; $i < $optSize; $i++)
        {
            $opcao = (new Opcao)::find($request->op_id[$i]);
            $opcao->resposta = $request->opcoes[$i];
            $opcao->save();
        }

        $enq_id->save();

        return redirect()->route('enquete.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Enquete $enq_id)
    {
        if(isset($enq_id) && $enq_id->id >= 0)
            $enq_id->delete();
        return redirect()->route('enquete.show');

    }
}
