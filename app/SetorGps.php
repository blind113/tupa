<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SetorGps extends Model
{
    protected $table = 'setor_gps';
    public function getSetores(){
        return SetorGps::get()->toArray();
    }

}