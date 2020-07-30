<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=>'inv'], function(){
    /**
     * views e telas 
     */
    Route::get('/','Inv\EquipamentosControl@index')->name('inventario.index');
    Route::any('dashboard','Inv\EquipamentosControl@dashboard')->name('dashboard');
    Route::any('lista_manuntecao','Inv\EquipamentosControl@listaManutencao')->name('lista.manutencao');
    Route::any('checklist','Inv\EquipamentosControl@checklist')->name('checkList');
    Route::any('listaCheckListDia', 'Inv\EquipamentosControl@listaChecklist')->name('listaCheckList');
    Route::any('checklistmensal', 'Inv\EquipamentosControl@checklistMensal')->name('checkListMensal');
    
    /**
     * modais(CRUD) e auxiliares
     */
    

    Route::any('salvar_novo','Inv\EquipamentosControl@salvar')->name('equipamento.novo');
    Route::any('salvar_perifericos','Inv\EquipamentosControl@salvarPerifericos')->name('perifericos.novos');
    Route::any('salvar_novo_pc','Inv\EquipamentosControl@salvarPc')->name('pc.novos');
    Route::any('editar_periferico','Inv\EquipamentosControl@editarPerifericos')->name('perifericos.alterar');
    Route::any('salvar_req','Inv\EquipamentosControl@salvarReq')->name('req.novo');
    Route::any('retorno_manutencao','Inv\EquipamentosControl@retornoManutencao')->name('retorno.pc');
    Route::any('retorno_posicao', 'Inv\EquipamentosControl@retornoPosAnterior')->name('retorno.pos.pc'); 
    Route::any('atualiza_status_gps','Inv\EquipamentosControl@atualizaGps')->name('atualiza.gps');
    Route::any('frm_modal','Inv\EquipamentosControl@fmrModal')->name('equipamento.frm');
    Route::any('salva_req_novo', 'Inv\EquipamentosControl@frmModalReq')->name('req.frm'); 
    Route::any('descricao_setor', 'Inv\EquipamentosControl@descricaoSetores')->name('descricao.setor'); 

    Route::any('frm_checklist/{pa}', 'Inv\EquipamentosControl@frmCheckList')->name('frmPaGps');
    Route::any('salvar_checklist','Inv\EquipamentosControl@salvarCheckList')->name('salva.checklist');


});




