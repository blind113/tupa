<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Req;


class Equipamento extends Model
{
    protected $table = 'equipamento';
    protected $primaryKey = 'idEquipamento';
    public function getListaEquipamentos()
    {
        return Equipamento::select('equipamento.*','mouse.dono as md','mouse.idEquipamento as idMd'
        , 'teclado.dono as tc','teclado.idEquipamento as idTc'
        , 'monitor.dono as mt', 'monitor.idEquipamento as idMt'
        , 'cabo.dono as cb', 'cabo.idEquipamento as idCb'
        , DB::raw( '(select data_req from req_equipamento where equipamento.idEquipamento = req_equipamento.idEquipamento order by created_at  DESC limit 1 ) as data_req' ) 
        , DB::raw( '(select req from req_equipamento where equipamento.idEquipamento = req_equipamento.idEquipamento order by created_at  DESC limit 1 ) as req' )  
        , 'gps.ativo'
        , 'gps.idGps' )
        ->join('gps', 'gps.gps','=','equipamento.gps')
        ->join('equipamento as mouse', 'equipamento.gps', '=','mouse.gps')
        ->join('equipamento as teclado', 'equipamento.gps', '=','teclado.gps')
        ->join('equipamento as monitor', 'equipamento.gps', '=','monitor.gps')
        ->join('equipamento as cabo', 'equipamento.gps', '=','cabo.gps')
        
        ->where('equipamento.idTipoEquipamento','=','1')
        ->where('mouse.idTipoEquipamento','=','2')
        ->where('teclado.idTipoEquipamento','=','3')
        ->where('monitor.idTipoEquipamento','=','4')
        ->where('cabo.idTipoEquipamento','=','5')
        
        ->get()->toArray();
    }
    public function novoPc($et_maquina, $serial, $ramal,$dono)
    {
        $dt_cdt = date('Y-m-d');
        return Equipamento::insert([
            'et' => $et_maquina,
            'serial' => $serial,
            'ramal' =>$ramal ,
            'gps' => '9000' ,
            'dono' => $dono,
            'idTipoEquipamento' => '1',
            'created_at' => $dt_cdt
        ]);  
        
        
    }
    public function novoPcKit($et_maquina, $serial, $ramal, $gps, $mouse, $teclado, $cabo, $monitor, $ultimoReq)
    {
        $dt_cdt = date('Y-m-d');
        $computador = Equipamento::insert([
            'et' => $et_maquina,
            'serial' => $serial,
            'ramal' =>$ramal ,
            'gps' => $gps ,
            'dono' => 'CX',
            'idTipoEquipamento' => '1',
            'created_at' => $dt_cdt
        ]);
        $id = DB::getPdo()->lastInsertId();
        $moouse = Equipamento::insert([
            'gps' => $gps , 
            'dono' =>  $mouse,
            'idTipoEquipamento' => '2',
            'created_at' => $dt_cdt
        ]);
        $teclado = Equipamento::insert([
            'gps' => $gps ,
            'dono' => $teclado,
            'idTipoEquipamento' => '3',
            'created_at' => $dt_cdt
        ]);
        $cabo = Equipamento::insert([
            'gps' => $gps,
            'dono' => $cabo,
            'idTipoEquipamento' => '5',
            'created_at' => $dt_cdt
        ]);
        $monitor = Equipamento::insert([
            'gps' => $gps ,
            'dono' => $monitor,
            'idTipoEquipamento' => '4',
            'created_at' => $dt_cdt
        ]);
        if(!empty($ultimoReq))
        {
            
            $cdReq = new Req();
            $cdReq->novoPcKitReq($ultimoReq, $id);
            
        }
        return $computador;
            
    }

    public function getPcManutencao() 
    {
            //req.idReqEquipamento, req.req, req.data_req
        return Equipamento::select('equipamento.*'
                        , DB::raw( '(select idReqEquipamento from req_equipamento where equipamento.idEquipamento = req_equipamento.idEquipamento order by created_at  DESC limit 1 ) as idReqEquipamento' ) 
                        , DB::raw( '(select req  from req_equipamento where equipamento.idEquipamento = req_equipamento.idEquipamento order by created_at  DESC limit 1 ) as req' ) 
                        , DB::raw( '(select data_req from req_equipamento where equipamento.idEquipamento = req_equipamento.idEquipamento order by created_at  DESC limit 1 ) as data_req' ) 
                        )
                          ->where('gps','=','9700')
                          ->where('idTipoEquipamento', '=','1')
                            ->get()->toArray();
    }
   
   
    public function getEquipamentoById($id)
    {
        return Equipamento::where('idEquipamento','=',$id )->get()->toArray();
    }
    public function getPcReservas()
    {
        return Equipamento::where('idTipoEquipamento','=','1' )
                            ->where('gps','=','9000')
                            ->get()->toArray();
    }
    public function getPerifericos(){
        return Equipamento::select('*')->from('tipo_equipamento')->where('idTipoEquipamento','<>','1')->get()->toArray();
    }
    public function getTipoEquipReserva($tipo)
    {
        return Equipamento::select('equipamento.*', 'tipo_equipamento.desc as descricao')
        ->join('tipo_equipamento','equipamento.idTipoEquipamento','=','tipo_equipamento.idTipoEquipamento')
        ->where('equipamento.idTipoEquipamento','=',$tipo )
        ->whereBetween('equipamento.gps', array('9000', '9100'))->limit(1)->get()->toArray();
    }
    public function salvarPerifericos($qtd, $tipo, $dono)
    {
        $dt_cdt = date('Y-m-d');
        $salvo =1;
        for($i=1;$i<=$qtd;$i++)
        {
            Equipamento::insert([
            'gps' => '9000' ,
            'dono' => $dono,
            'idTipoEquipamento' => $tipo,
            'created_at' => $dt_cdt
            ]);

           $salvo ++;
        }
        return $salvo;
    }
    public function retornoPc($id)
    {
        Equipamento::where('idEquipamento','=',$id)->update(['gps'=>'9000']);
    }
    public function trocaPeriferico($idEquipAtual,$idEquiReserva,$gpsAtualDestino,$gpsReservaDestino)
    {
        $dt_update = date('Y-m-d');

        //Update no periferico que esta saindo.
        Equipamento::where('idEquipamento','=',$idEquipAtual)->update(['gps'=>$gpsAtualDestino ]);

        Equipamento::where('idEquipamento','=', $idEquiReserva)->update(['gps'=>$gpsReservaDestino]);
        return 'Atualizado';
    }

    public function getEquipReservas($tipo)
    {
       return Equipamento::select(DB::raw('count(equipamento.idEquipamento ) as qtd'),'equipamento.gps','equipamento.dono', 'setor_gps.descricao' )
                                //->join('tipo_equipamento', 'tipo_equipamento.idTipoEquipamento', '=', 'equipamento.idTipoEquipamento')
                                ->join('setor_gps', 'setor_gps.cod_ini', '=', 'equipamento.gps')
                                ->whereIn('equipamento.gps',array ('9000','9500','9600'))
                                ->where('equipamento.idTipoEquipamento','=',$tipo)
                                ->groupBy('equipamento.gps', 'equipamento.dono','setor_gps.descricao')
                                ->get()->toArray();
    }
    public function voltaPosAntigaPC($id)
    {
        //Procura o idequipamento que esta na mesma posição do ramal do $id procurado
        $pcReserva = Equipamento::select('equipamento.idEquipamento', 'equipamento.gps')
                    ->join('equipamento as evolta', 'equipamento.gps','=', 'evolta.ramal')
                    ->where('equipamento.idTipoEquipamento', '=','1')
                    ->where('evolta.idEquipamento', '=',$id)
                    ->where('evolta.gps','=','9700')
                    ->get()->toArray();
        if(!empty($pcReserva)){
            //Equipamento da manutenção volta para a PA da onde foi retirado 
            Equipamento::where('idEquipamento','=',$id)->where('gps','=','9700')->update([ 'gps'=>$pcReserva[0]['gps'] ]);
            //Equipamento procurado volta para a reserva
            Equipamento::where('idEquipamento','=',$pcReserva[0]['idEquipamento'])->update(['gps'=>'9000']);
            $resultado = 'Salvo';
        }else{
            $resultado = 'Sem registro, contate a TI';
        }
        return $resultado;
    }
}
