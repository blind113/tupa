<?php

namespace App\Http\Controllers\Inv;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Equipamento;
use App\Req;
use App\Gps;
use App\SetorGps;
use App\CheckList;

class EquipamentosControl extends BaseController
{
    public function printArray($array){
        echo '<pre>'.print_r($array, true).'</pre>';
    }
    public function index()
    {
        /*
        $fp = fopen('../public/assets/arquivos/lista_parque2.csv','r') or die("can't open file");
        while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
            //echo '<pre>'.print_r($data,true).'</pre>';
            $query = "INSERT INTO equipamento(et, serial, ramal, gps, dono, idTipoEquipamento,ativo, created_at, updated_at) 
            VALUES ('$data[3]','$data[1]','$data[2]','$data[0]','CX','1','S','2020-06-24','2020-06-24');
            INSERT INTO equipamento( gps, dono, idTipoEquipamento, created_at, updated_at) 
            VALUES ('$data[0]','CX','2','2020-06-24','2020-06-24');
            INSERT INTO equipamento( gps, dono, idTipoEquipamento, created_at, updated_at) 
            VALUES ('$data[0]','CX','3','2020-06-24','2020-06-24');
            INSERT INTO equipamento( gps, dono, idTipoEquipamento, created_at, updated_at) 
            VALUES ('$data[0]','CX','4','2020-06-24','2020-06-24');
            INSERT INTO equipamento( gps, dono, idTipoEquipamento, created_at, updated_at) 
            VALUES ('$data[0]','PL','5','2020-06-24','2020-06-24');    
            ";
            echo print_r($query,true);         
        }
        fclose($fp);*/
        
        $equi = new Equipamento();
        $lista = $equi->getListaEquipamentos();

        $listaPer = $equi->getPerifericos();
        
        return view('inventario/index',compact('lista','listaPer'));
    }

    public function dashboard()
    {
        $equi = new Equipamento();
        
        //////////////////////////////////////////
        //Lista perifericos Mouse
        $mouse = $equi->getEquipReservas(2);
        //////////////////////////////////////////
        //Lista perifericos Teclado
        $teclado = $equi->getEquipReservas(3);
        //////////////////////////////////////////
        //Lista perifericos Monitor
        $monitor = $equi->getEquipReservas(4);
        //////////////////////////////////////////
        //Lista perifericos CaboQD
        $cabo = $equi->getEquipReservas(5);
        //echo '<pre>'.print_r($listaReservas, true).'</pre>';
        return view('inventario/dashboard', compact('mouse','teclado','monitor','cabo'));
    }
    
    public function salvarPerifericos(Request $request)
    {
        $qtd = $request->input('qtdPerifericos');
        $tEquipamento = $request->input('perifericos');
        $donoEquipamento  = $request->input('donoPerifericos');
        $equi = new Equipamento();
        $resultado = $equi->salvarPerifericos($qtd, $tEquipamento, $donoEquipamento);
        return $resultado;
    }
    public function editarPerifericos(Request $request)
    {
        $gpsADestino = $request->input('gpsAtual');
        $idEAtual = $request->input('idEquipAtual');
        
        $gpsRDestino = $request->input('gpsReserva');
        $idEReserva = $request->input('idEquipReserva');
        $equi = new Equipamento();
        $resultado = $equi->trocaPeriferico($idEAtual, $idEReserva , $gpsADestino, $gpsRDestino );
        return $gpsRDestino ;
    }
    public function listaManutencao(){
        $modEquip = new Equipamento();
        $lstManutencao  = $modEquip->getPcManutencao();

        $lstBackup = $modEquip->getPcReservas();
       return view('inventario/listaManutencao', compact('lstBackup', 'lstManutencao'));
    } 
    public function atualizaGps()
    {
        $mdlGps = new Gps();
        
        $id = $_GET['id'];
        $status = $_GET['status'];
       $mdlGps->atualizarGps($id,$status);
    }
    public function salvar(Request $request)
    {
        //echo '<pre>'.print_r($request, true).'</pre>';
        $equi = new Equipamento();
        $et_maquina = $request->input('etmaquina');
        $serial = $request->input('serial');
        $gps = $request->input('gps');
        $ramal = $request->input('ramal');
        $mouse = $request->input('mouse');
        $teclado = $request->input('teclado');
        $cabo = $request->input('cabo');
        $monitor = $request->input('monitor');
        $ultimoReq = $request->input('dtReq');

        $equi->novoPcKit($et_maquina, $serial, $ramal, $gps, $mouse, $teclado, $cabo, $monitor,$ultimoReq);
        
        return $equi;
    }
    public function salvarPc(Request $request)
    {
        //echo '<pre>'.print_r($request, true).'</pre>';
        $equi = new Equipamento();
        $et_maquina = $request->input('etmaquina');
        $serial = $request->input('serial');
        $ramal = $request->input('ramal');
        $dono = $request->input('donoPc');
        $equi->novoPc($et_maquina, $serial, $ramal, $dono);
        return $equi;
    }
    public function retornoManutencao()
    {
        $idEquipamento = $_GET['id'];
        $equi = new Equipamento();
        $equi->retornoPc($idEquipamento);
        return 'Salvo';
    }
    public function frmModalReq()
    {
        $idEquipamento = $_GET['id'];
     
        return view('inventario/frmReq', compact('idEquipamento'));
    }
    public function salvarReq(Request $request){
        
        $req = $request->input('input_req');
        $id = $request->input('idEquipamento');
        
        $mdlReq = new Req();
        $mdlReq->novoReq($id, $req, 'NOVO');
        return 'salvo';
    }
    public function fmrModal(){
        $moEquip = new Equipamento();
        $idEAtual = $_GET['id'];
        $gpsAtual = $_GET['gps'];
        $tipoEquip = $_GET['tipo'];    
        //Carrega os computadores backup
        if($tipoEquip == '1')
        {
            $listaPc = $moEquip->getPcReservas();
            if(!empty($listaPc))
            {
                return view('inventario/frmModalEquipPc', compact('idEAtual','gpsAtual', 'listaPc'));
            }else{
                $resposta['status'] = 'error';    
                echo json_encode($resposta);
                return $resposta;
            }

        }else{
            $eAtual = $moEquip->getEquipamentoById($idEAtual);
            $eReserva = $moEquip->getTipoEquipReserva($eAtual[0]['idTipoEquipamento']);
            if(!empty($eReserva))
            {
                //busca equipamentos reserva para o mesmo tipo de equipamento
                return view('inventario/frmModalEquip', compact('idEAtual','gpsAtual', 'eReserva'));
            }else{
                $resposta['status'] = 'error';    
                echo json_encode($resposta);
                return $resposta;
            }
            
            

        }
       
    }

    /***
     * Retorna tabela/dados para tabela com os setores
     * 
     */
    public function descricaoSetores(){
        $mdlSetorGps = new SetorGps();
        $lista = $mdlSetorGps->getSetores();
        return $lista;
    }

    /**
     * Procura o computador na posição = ao ramal do pc que esta voltando da manutenção.
     * retorna o mesmo para reserva (9000) e atuliza o gps do pc que esta voltando da manutenção para a mesma posição;
     */

     public function retornoPosAnterior(){
        
        $mdlEquipamento = new Equipamento(); 
        $id = $_GET['id'];
        $resultado = $mdlEquipamento->voltaPosAntigaPC($id);
        
        return $resultado;
     }
    
    /**
     * CHECKLIST VIEWS E CRUD
     */
    public function checklist(){
        $mdlCheckList = new CheckList();
        $lstDiaria = $mdlCheckList->listaDia();
        //$lstCompleta = $mdlCheckList->prcListaDiaCompleta('2020-07-20');
        //echo '<pre>'.print_r($lstCompleta, true).'</pre>';
        return view('inventario/checklist',compact('lstDiaria'));
    }
    public function checklistMensal(){
        return view('inventario/checklistMensal');
    }
    public function listaCheckList(){
        $dia = $_GET['dia'];
        $dt = date('Y-m').'-'.$dia;
        $mdlCheckList = new CheckList();
        $lstDiaria = $mdlCheckList->prcListaDt($dt);
        $lstCompleta = $mdlCheckList->prcListaDiaCompleta($dt);
        //$lstDiaria = 'testes';
        //echo date('H');
        return view('inventario/listaCheckListDt', compact('lstDiaria','lstCompleta'));
    }



    public function frmCheckList($pa){
     
        return view('inventario/frmPaCheckList', compact('pa'));
    }


    public function  salvarCheckList(){
        $mdlCheckList = new CheckList();

        //Verifica si exite o valor do PA, caso exita aumenta 1 para a proxima pa
        $paGps = $_GET['paGps'];
        //Verifica se ja existe um registro para esta pa e data.
        $reg = $mdlCheckList->gpsDia($paGps, date('Y-m-d'));

        if(empty($reg))
        {
            $sLacre = $_GET['statusL'];
            $sPc = $_GET['statusP'];
            $sMonitor = $_GET['statusM'];
            $sMouse = $_GET['statusmO'];
            $sTeclado = $_GET['statusT'];
            $sCabo = $_GET['statusC'];
            $sCertificado = $_GET['statusCe'];
            $obs = $_GET['txtObs'];
    
            $salvo = $mdlCheckList->novoCheckList($paGps, $sLacre, $sPc, $sMonitor, $sMouse, $sTeclado, $sCabo, $sCertificado, $obs);
            ($paGps? $paGps++ :'0');
        }else{
            ($paGps? $paGps++ :'0');
        }
            
        return EquipamentosControl::frmCheckList($paGps);
    }

   
}