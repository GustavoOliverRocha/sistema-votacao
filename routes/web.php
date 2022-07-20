<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('enquete.show');
});

//Opcao Routes

Route::post('/opcao/votar','App\Http\Controllers\OpcaoController@votar')
->name('opcao.votar');

Route::get('/opcao/renderiza/{enq_id}','App\Http\Controllers\EnqueteController@renderizarRespostas')
->name('opcao.renderiza');

Route::delete('/opcao/delete/{op_id}','App\Http\Controllers\OpcaoController@delete')
->name('opcao.destroy');

//Enquete Routes

Route::get('/enquete/answers/{enq_id}','App\Http\Controllers\EnqueteController@showAnswers')
->name('enquete.answers');

Route::delete('/enquete/delete/{enq_id}','App\Http\Controllers\EnqueteController@delete')
->name('enquete.destroy');

Route::put('/enquete/update/{enq_id}','App\Http\Controllers\EnqueteController@update')
->name('enquete.update');

Route::get('/enquete/edit/{enq_id}','App\Http\Controllers\EnqueteController@editForm')
->name('enquete.editForm');

Route::get('/enquete/list','App\Http\Controllers\EnqueteController@show')
->name('enquete.show');

Route::post('/enquete/save','App\Http\Controllers\EnqueteController@save')
->name('enquete.save');

Route::get('/enquete/insert','App\Http\Controllers\EnqueteController@create')
->name('enquete.form');


