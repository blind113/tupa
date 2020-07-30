<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CheckList extends Model
{
    protected $table = 'check_list'; 

    public function novoCheckList($paGps, $sLacre, $sPc, $sMonitor, $sMouse, $sTeclado, $sCabo, $sCertificado, $obs)
    {
        $dt = date('Y-m-d ');
        $hr = intval(date('H'));
        if($hr >= 8 && $hr <= 18)
        {
            $turno = 'D';
        }else if($hr>18 && $hr<=23)
        {
            $turno = 'N';
        }else{
            $turno = 'M';
        }
        return CheckList::insert([
            'gps'=> $paGps,
            'lacre'=> $sLacre,
            'pc'=> $sPc,
            'monitor'=> $sMonitor,
            'mouse'=> $sMouse,
            'teclado'=>$sTeclado,
            'cabo'=>$sCabo,
            'certificado'=> $sCertificado,
            'obs'=>$obs,
            'turno'=>$turno,
            'created_at' => $dt

        ]);

    }
    public function listaDia()
    {
        return CheckList::where('created_at','=',date('Y-m-d') )->get()->toArray();
    }
    public function prcListaDt($dt){
        return CheckList::where('created_at','=',$dt)->get()->toArray();
    }
    //Procura lista 
    public function prcListaDiaCompleta($dt)
    {
       
        return CheckList::select('ch.gps'
                ,'chM.lacre as lacreMadruga','chD.lacre as lacreDia','chN.lacre as lacreNoite'
                ,'chM.pc as pcMadruga','chD.pc as pcDia','chN.pc as pcNoite'
                ,'chM.monitor as monitorMadruga','chD.monitor as monitorDia','chN.monitor as monitorNoite'
                ,'chM.mouse as mouseMadruga','chD.mouse as mouseDia','chN.mouse as mouseNoite'
                ,'chM.teclado as tecladoMadruga','chD.teclado as tecladoDia','chN.teclado as tecladoNoite'
                ,'chM.cabo as caboMadruga','chD.cabo as caboDia','chN.cabo as caboNoite'
                ,'chM.certificado as cerMadruga','chD.certificado as cerDia','chN.certificado as cerNoite'
                ,'chM.obs as obsMadruga', 'chD.obs as obsDia', 'chN.obs as obsNoite')
                ->from(DB::raw('(select distinct gps,created_at from tupa.check_list where turno is not null and created_at = "'.$dt.'" ) ch'))
                ->leftJoin('check_list as chM', function($join){
                    $join->on('ch.gps', '=', 'chM.gps');
                    $join->on('ch.created_at', '=', 'chM.created_at');
                    $join->where('chM.turno','=','M');
                })
                ->leftJoin('check_list as chD', function($join){
                    $join->on('ch.gps', '=', 'chD.gps');
                    $join->on('ch.created_at', '=', 'chD.created_at');
                    $join->where('chD.turno','=','D');
                })
                ->leftJoin('check_list as chN', function($join){
                    $join->on('ch.gps', '=', 'chN.gps');
                    $join->on('ch.created_at', '=', 'chN.created_at');
                    $join->where('chN.turno','=','N');
                })->get()->toArray();

            
      
    }

    public function gpsDia($gps, $dt){
        $hr = intval(date('H'));
        if($hr >= 8 && $hr <= 18)
        {
            $turno = 'D';
        }else if($hr>18 && $hr<=23)
        {
            $turno = 'N';
        }else{
            $turno = 'M';
        }
        return CheckList::where('gps','=',$gps)
                        ->where('created_at', '=',$dt)
                        ->where('turno','=',$turno)
                        ->get()->toArray();
    }

}
