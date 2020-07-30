@extends('html')
@section('title', 'Inventarios')
@section('content')

    <!-- divis para botoes que chaamas as funcoes necessarias -->
    <div  class = 'row' id ='div_btn_fnc'>
        <div class = 'col col-sm-12 text-center'>
            <a class='btn btn-primary' href="{{ route('checkList') }}" style= 'font-size:18px; backgroud-color:blue' >{{date('d/m/Y')}} </a>
            <button class='btn btn-primary' onclick="frmCheckList('0')" > Diario </button>
            <a class='btn btn-primary'  href="{{ route('checkListMensal') }}" > Mensal </a>
        </div>
    </div>
   <hr/>
    <div class = 'row' id ='div_rslt'>
       
    </div>
    

<!-- script para tratar os botoes e o tratamento -->
<script>
    function verificacao(_valor){
      if(_valor == 1)
      {
        icone = 'check-square';
      }else{
        icone = 'remove';
      }
      return icone;
    }
    //carrega frm para checklist de PA 
    function frmCheckList(_paGps){
        var pa = _paGps;
        var _url = "{{ route('frmPaGps', '_pa_') }}".replace('_pa_', pa);
        $.ajax({
            url: _url,
            method:"GET",
            cache:false,
            success: function (resultado){
                $("#div_rslt").html(resultado);
            },
            error: function(){

            }

        });
        
    }
    $(document).ready(function(){
        $('#table-checkList').DataTable({
            dom: 'BPlfrtip',
            buttons: ['copy','csv'],

        });
        var _img = '<img src="/assets/images/load.gif" alt="Minha Figura">';
        $('#div_rslt').html(_img);
        var _id = <?php echo date('d'); ?>;
        $.ajax({
            data: {dia:_id},
            type: "GET",
            url: "{{ route('listaCheckList') }}",
            success: function(resultado){
                //alert(resultado);
                $('#div_rslt').html(resultado);
            },
            error: function (){

            }
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
@stop