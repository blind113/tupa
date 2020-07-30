@extends('html')
@section('title', 'Inventario - Manutenção')
@section('content')

<!-- Lista de Computadores na manutenção  -->
<div class = 'row' >
    <div class = 'col col-sm-12' >
        <h2> Lista Computadores em manutenção</h2>
        <table class = 'table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ET</th>
                    <th>Serial</th>
                    <th>Dono</th>
                    <th>REQ</th>
                    <th>Data REQ</th>
                    <th><span class = 'fa fa-edit' ></span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($lstManutencao as $lm)
                    {
                        $req = ($lm['req']) ?: '';
                        $dt_req = ($lm['data_req']) ?: '';
                        //echo '<pre>'.print_r($lm,true).'</pre>';
                        echo '<tr>';
                            echo '<td>'.$lm['idEquipamento'].'</td>';
                            echo '<td>'.$lm['et'].'</td>';
                            echo '<td>'.$lm['serial'].'</td>';
                            echo '<td>'.$lm['dono'].'</td>';
                            echo '<td>'.$req.'</td>';
                            echo '<td>'.$dt_req.'</td>';
                            echo '<td><a class ="fa fa-plus" onclick = "mostraFrmReq(\''.$lm['idEquipamento'].'\');"></a> &nbsp;&nbsp;<a onclick = "reparoPc(\''.$lm['idEquipamento'].'\')" class = "fa fa-stethoscope" ></a>&nbsp;&nbsp;<a onclick = "voltaPosAntigaPC(\''.$lm['idEquipamento'].'\')" class="fa fa-history"></a></td>';
                       
                            echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>



<!-- Computadores BACKUP -->
<div class = 'row'>
    <div class= 'col col-sm-12'>
       <h2>Lista de Computadores Backup </h2>
       <table class= 'table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ET</th>
                    <th>Serial</th>
                    <th>Dono</th>
                </tr>
            </thead>
            <tbody>
       <?php
            foreach($lstBackup as $lb)
            {
                echo '<tr>';
                    echo '<td>'.$lb['idEquipamento'].'</td>';
                    echo '<td>'.$lb['et'].'</td>';
                    echo '<td>'.$lb['serial'].'</td>';
                    echo '<td>'.$lb['dono'].'</td>';

                echo '</tr>';
            }

       ?>
            </tbody>
        </table>
    </div>
</div>

<div class = 'modal fade' role='dialog' id='modal_req'>
    <div class = 'modal-dialog' role= 'document'>
    </div>
</div>
@stop

<script>
function reparoPc(_id)
{   
    var c = confirm('Computador voltou da manutenção?');
    if(c == true)
    {
        $.ajax({
            url: "{{ route('retorno.pc') }}",
            type:'GET',
            cache:false,
            data:{ id:_id},
            succeess: function(data){
                alert('Alterado');
                location.reload();
            },
            error: function(){
                alert('Contate a TI');
            }
        });
    }
}

function mostraFrmReq(_id)
{   
    $.ajax({
        url:"{{ route('req.frm') }}",
        type: 'GET',
        cache: false,
        data : {
            id:_id
        },
        success:function(data){
            $("#modal_req").html(data);
            $("#modal_req").modal();
        },
        error: function(){
            alert('Contate a TI');
        }
    });
    
}

function voltaPosAntigaPC(_id)
{

    $.ajax({
        url: "{{ route('retorno.pos.pc')}}",
        type:'GET',
        cache: false,
        data:{ id : _id },
        success:function(data){
            alert(data);
            location.reload();
        },
        error: function(){
            alert('Contate o TI');
        }
    });
}
</script>

