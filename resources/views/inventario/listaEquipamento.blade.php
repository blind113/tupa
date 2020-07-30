@section('listaEquipamentos')
<div class= 'table100'>
<table  id='listaEquip' name = 'listaEquip'>
    <thead>
        <tr class= 'table100-head'>
            <th class='column1'>GPS</th>
            <th class='column2'>ET</th>
            <th class='column3'>Serial</th>
            <th class='column4'>Ramal</th>
            <th class='column5'>Monitor</th>
            <th class='column6'>Mouse</th>
            <th class='column7'>Teclado</th>
            <th class='column8'>CaboQD</th>
            <th class='column9'>REQ</th>
            <th class='column10'>Data REQ</th>
            <th class='column11'>Ativo</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($lista as $l)
            {

                $dt_req = ($l['data_req']) ?: '';
                $req = ($l['req']) ?: '';
                //echo '<pre>'.print_r($l, true).'</pre>';
                echo '<tr>';
                    echo '<td class ="column1">'.$l['gps'].'</td>';
                    echo '<td class ="column2"><a href="#" onclick = "javascript:mostraModal(\''.$l['idEquipamento'].'\', \''.$l['gps'].'\', \''.$l['idTipoEquipamento'].'\' );">'.$l['et'].'</td>';
                    echo '<td class ="column3">'.$l['serial'].'</td>';
                    echo '<td class ="column4">'.$l['ramal'].'</td>';
                    echo '<td class ="column5"><a href="#" onclick = "javascript:mostraModal(\''.$l['idMt'].'\', \''.$l['gps'].'\', 2  );">'.$l['mt'].'</a></td>';
                    echo '<td class ="column6"><a href="#" onclick = "javascript:mostraModal(\''.$l['idMd'].'\', \''.$l['gps'].'\', 3 );">'.$l['md'].'</a></td>';
                    echo '<td class ="column7"><a href="#" onclick = "javascript:mostraModal(\''.$l['idTc'].'\', \''.$l['gps'].'\', 4 );">'.$l['tc'].'</a></td>';
                    echo '<td class ="column8"><a href="#" onclick = "javascript:mostraModal(\''.$l['idCb'].'\', \''.$l['gps'].'\', 5  );">'.$l['cb'].'</a></td>';
                    echo '<td class ="column9">'.$req.'</td>';
                    echo '<td class ="column10">'.$dt_req.'</td>';
                    echo '<td class ="column11"><a href = "#" onclick = "javascript:atualizaGps(\''.$l['idGps'].'\', \''.$l['ativo'].'\');">'.$l['ativo'].'</a></td>';
                echo '</tr>';
            }
        
        ?>
    </tbody>
</table>
</div>

<style>
/*[ Table ]*/

.limiter {
  width: 100%;
  margin: 0 auto;
}

.container-table100 {
  width: 100%;
  min-height: 100vh;
  background: #c850c0;
  background: -webkit-linear-gradient(45deg, #4158d0, #c850c0);
  background: -o-linear-gradient(45deg, #4158d0, #c850c0);
  background: -moz-linear-gradient(45deg, #4158d0, #c850c0);
  background: linear-gradient(45deg, #4158d0, #c850c0);

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  padding: 33px 30px;
}

.wrap-table100 {
  width: 1170px;
}

table {
  border-spacing: 1;
  border-collapse: collapse;
  background: white;
  border-radius: 10px;
  overflow: hidden;
  width: 100%;
  margin: 0 auto;
  position: relative;
}
table * {
  position: relative;
}
table td, table th {
  padding-left: 8px;
}
table thead tr {
  height: 60px;
  background: #36304a;
}
table tbody tr {
  height: 50px;
}
table tbody tr:last-child {
  border: 0;
}
table td, table th {
  text-align: left;
}
table td.l, table th.l {
  text-align: right;
}
table td.c, table th.c {
  text-align: center;
}
table td.r, table th.r {
  text-align: center;
}


.table100-head th{
  font-family: OpenSans-Regular;
  font-size: 18px;
  color: #fff;
  line-height: 1.2;
  font-weight: unset;
}

tbody tr:nth-child(even) {
  background-color: #f5f5f5;
}

tbody tr {
  font-family: OpenSans-Regular;
  font-size: 15px;
  color: #808080;
  line-height: 1.2;
  font-weight: unset;
}

tbody tr:hover {
  color: #555555;
  background-color: #f5f5f5;
  cursor: pointer;
}

.column1 {
  width: 260px;
  padding-left: 40px;
}

.column2 {
  width: 160px;
}

.column3 {
  width: 245px;
}

.column4 {
  width: 110px;
  text-align: right;
}

.column5 {
  width: 170px;
  text-align: right;
}

.column6 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}
.column7 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}
.column8 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}
.column9 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}
.column10 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}
.column11 {
  width: 222px;
  text-align: right;
  padding-right: 62px;
}


@media screen and (max-width: 992px) {
  table {
    display: block;
  }
  
  tr:nth-child(even){
    background: #CCC !important;
  }
  table > *, table tr, table td, table th {
    display: block;
  }
  table thead {
    display: none;
   
  }
  table tbody tr {
    height: auto;
    padding: 37px 0;
  }
  table tbody tr td {
    padding-left: 40% !important;
    margin-bottom: 24px;
    
  }
  table tbody tr td:last-child {
    margin-bottom: 0;
  }
  table tbody tr td:before {
    font-family: OpenSans-Regular;
    font-size: 14px;
    color: #999999;
    line-height: 1.2;
    font-weight: unset;
    position: absolute;
    width: 40%;
    left: 30px;
    top: 0;
  }
  table tbody tr td:nth-child(1):before {
    content: "GPS";
    
    
  }
  table tbody tr td:nth-child(2):before {
    content: "ET";
  }
  table tbody tr td:nth-child(3):before {
    content: "SERIAL";
  }
  table tbody tr td:nth-child(4):before {
    content: "RAMAL";
  }
  table tbody tr td:nth-child(5):before {
    content: "MONITOR";
  }
  table tbody tr td:nth-child(6):before {
    content: "MOUSE";
  }
  table tbody tr td:nth-child(7):before {
    content: "TECLADO";
  }
  table tbody tr td:nth-child(8):before {
    content: "QD";
  }
  table tbody tr td:nth-child(9):before {
    content: "REQ";
  }
  table tbody tr td:nth-child(10):before {
    content: "DT_REQ";
  } table tbody tr td:nth-child(11):before {
    content: "ATIVO";
  }

  

  .column4,
  .column5,
  .column6,
  .column7,
  .column8,
  .column10,
  .column11,
  .column9 {
    text-align: left;
  }

  .column4,
  .column5,
  .column6,
  .column1,
  .column2,
  .column7,
  .column8,
  .column9,
  .column10,
  .column11,
  .column3 {
    width: 100%;
  }

  tbody tr {
    font-size: 14px;
  }
}

@media (max-width: 576px) {
  .container-table100 {
    padding-left: 15px;
    padding-right: 15px;
  }
}
</style>
@stop