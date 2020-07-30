<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Req extends Model
{
    protected $table = 'req_equipamento';
    public function novoReq($id, $req,$obs)
    {
        $dt_cdt = date('Y-m-d H:i:s');
        $novo = Req::insert([
            'idEquipamento' =>$id,
            'req' => $req,
            'obs' => $obs,
            'data_req' => $dt_cdt,
            'created_at' => $dt_cdt
        ]);
    }
    public function novoPcKitReq($ultimoReq, $id)
    {
        $dt_cdt = date('Y-m-d');
       
        if(!empty($ultimoReq))
        {
            $req = Req::insert([
                'idEquipamento' => $id ,
                'req' => 'alterar' ,
                'obs' => 'Cadastradorjunto',
                'data_req' => $ultimoReq,
                'created_at' => $dt_cdt
            ]);
        }
        return '1';
            
    }

}
