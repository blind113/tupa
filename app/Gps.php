<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gps extends Model
{
    protected $table = 'gps';
    public function atualizarGps($id,$status)
    {
        if($status == 'A')
        {
            Gps::where('idGps','=',$id)->update(['ativo'=>'D']);
        }else if($status == 'D')
        {
            Gps::where('idGps','=',$id)->update(['ativo'=>'A']);
        }
        
    }

}
