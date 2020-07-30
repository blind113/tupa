<!-- tabela completa -->
<div class='col'>
  <div class = 'table100'>            
    <table id ='table-checkList'>
      <thead >
        <tr class= 'table100-head'>
          <th class = 'column1'>PA</th>
          <th class = 'column2'>Lacre</th>
          <th class = 'column3'>CPU</th>
          <th class = 'column4'>Monitor</th>
          <th class = 'column5'>Mouse</th>
          <th class = 'column6'>Teclado</th>
          <th class = 'column7'>QD</th>
          <th class = 'column8'>ATIVO</th>
          <th class = 'column8'>OBS</th>
        </tr>
      </thead>
      <tbody>
    <?php 
        $ok ='<i class="fa fa-check" style="color:green"></i>'; 
        $no = '<i class="fa fa-remove" style="color:red"></i>';
      
      function verificador($cLTurno){

        $ok ='<i class="fa fa-check" style="color:green"></i>'; 
        $no = '<i class="fa fa-remove" style="color:red"></i>';
        if($cLTurno === null)
        { 
            $res = 'N';
        }else{
          if($cLTurno == 1)
          {
            $res = $ok;
          }else{
            $res = $no;
          }
        }
        return $res;
      }
      
    ?>
      @foreach($lstCompleta as $pa)
         
          <tr>
            <td class = 'column1'>{{ $pa['gps'] }}</td>
            <td class = 'column2'>{!! verificador($pa['lacreMadruga']) !!} {!! verificador($pa['lacreDia']) !!} {!! verificador($pa['lacreNoite']) !!}</td>
            <td class = 'column3'>{!! verificador($pa['pcMadruga']) !!}{!! verificador($pa['pcDia']) !!}{!! verificador($pa['pcNoite']) !!} </td>
            <td class = 'column3'>{!! verificador($pa['monitorMadruga']) !!}{!! verificador($pa['monitorDia']) !!}{!! verificador($pa['monitorNoite']) !!} </td>
            <td class = 'column3'>{!! verificador($pa['mouseMadruga']) !!}{!! verificador($pa['mouseDia']) !!}{!! verificador($pa['mouseNoite']) !!} </td>
            <td class = 'column3'>{!! verificador($pa['tecladoMadruga']) !!}{!! verificador($pa['tecladoDia']) !!}{!! verificador($pa['tecladoNoite']) !!} </td>
            <td class = 'column3'>{!! verificador($pa['caboMadruga']) !!}{!! verificador($pa['caboDia']) !!}{!! verificador($pa['caboNoite']) !!} </td>        
            <td class = 'column3'>{!! verificador($pa['cerMadruga']) !!}{!! verificador($pa['cerDia']) !!}{!! verificador($pa['cerNoite']) !!} </td>        
            <td class = 'column3'>{!! $pa['obsMadruga'] !!} | {!! $pa['obsDia'] !!} | {!! $pa['obsNoite'] !!} </td>        
            
          </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#table-checkList').DataTable({
      dom: 'BPlfrtip',
      buttons: ['copy','csv'],
    });
            
  });
</script>

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
  text-align: center;

}
table thead tr {
  height: 60px;
  background: #36304a;
  text-align: center;
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
  text-align: center;
}

.column2 {
  width: 100px;
  text-align: center;
}

.column3 {
  width: 100px;
  text-align: center;
}

.column4 {
  width: 110px;
  text-align: center;
}

.column5 {
  width: 170px;
  text-align: center;
}

.column6 {
  width: 222px;
  text-align: center;
 
}
.column7 {
  width: 222px;
  text-align: center;
}
.column8 {
  width: 222px;
  text-align: center;
}
.column9 {
  width: 222px;
  text-align: center;
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
    content: "LACRE";
  }
  table tbody tr td:nth-child(3):before {
    content: "CPU";
  }
  table tbody tr td:nth-child(4):before {
    content: "MONITOR";
  }
  table tbody tr td:nth-child(5):before {
    content: "MOUSE";
  }
  table tbody tr td:nth-child(6):before {
    content: "TECLADO";
  }
  table tbody tr td:nth-child(7):before {
    content: "QD";
  }
  table tbody tr td:nth-child(8):before {
    content: "CERTIFICADO";
  }
  table tbody tr td:nth-child(9):before {
    content: "OBS";
  }



  

  .column4,
  .column5,
  .column6,
  .column1,
  .column2,
  .column7,
  .column8,
  .column9,
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