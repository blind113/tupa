@extends('html')
@include('inventario.frmNovoPeriferico')
@include('inventario.frmNovoPc')
@include('inventario.frmNovoKit')
@include('inventario.listaEquipamento')
@section('title', 'Inventarios')
@section('content')

    <div class = "row">
    <h2>Inventário de Periféricos (CX) </h2>
    <br/>
        <div class = "col-sm-12">
            <button class = 'button btn-primary' onclick = "mostraNovo();" >Novo kit (Completo)</button>
            <button class = 'button btn-primary' onclick = "mostraNovoPC();">Novo computador</button>
            <button class = 'button btn-primary' onclick = "mostraPerifericos();" >Novos Perifericos</button>
            <button class = 'button btn-primary' onclick=  "window.location='{{ route('dashboard') }}' "> Dashboard </button>
            <button class = 'button btn-primary' onclick = "window.location='{{ route('lista.manutencao') }}' "> Manutenção </button> 
            <button class = 'button btn-primary' onclick = "window.location='{{ route('checkList')}}'"> CheckList</button>
        </div>
    </div>
     <!-- Cadastro de kit completo -->
     <div class = "row">
        <div class = "col-sm-12" name = 'divNovoCadastro' id = 'divNovoCadastro' style = 'display: none;' >
            @yield('frmNovoKit')
        </div>
    </div>
    <!-- Cadastro de computador reserva -->
    <div class = "row">
        <div class = "col-sm-8" name = 'divNovoCadastroPc' id = 'divNovoCadastroPc' style = 'display: none;' >
            @yield('frmNovoPc')
        </div>
    </div>
    <!-- Cadastro de Perifericos -->
    <div class = "row">
        <div class = "col-sm-4" name = 'divNovoPeriferico' id = 'divNovoPeriferico' style = 'display: none;' >
            @yield('frmNovosPerifericos')
        </div>
    </div> 
    <br/>
    <!-- -->
    <div class = "row">
        <div class = "col-sm-12">
          @yield('listaEquipamentos')
        </div>
    </div>

<div class="modal fade" tabindex="-1" role="dialog" id = 'modal_frm_equip'>
    <div class="modal-dialog" role="document">
                        
    </div>
</div>

<script>

$(window).load(function() {
  $.uniform.restore(".noUniform");
 
});
    $(document).ready(function(){
        $('#listaEquip').DataTable({
            dom: 'BPlfrtip',
            buttons: ['copy','csv'],
        });
            
    });
    

    //Cadastrar novo computador para reserva.
    $(document).on("submit","#frmNovoPc", function(event){
        event.preventDefault();
        
        $.ajax({
            data:$(this).serialize(),
            url:"{{ route('pc.novos') }}",
            method:'post',
            cache:false,
            success:function(result){
                alert('Salvo');
                location.reload();
            },
            error: function (){
                alert('Contate o TI');
            }
        });
    });


    //cadastrar perifericos novos para reserva 
    $(document).on("submit","#frmNovoPeriferico", function(event){
        event.preventDefault();
        
        $.ajax({
            data:$(this).serialize(),
            url: "{{ route('perifericos.novos') }}",
            method:'post',
            cache:false,
            success:function(result){
                alert('Perifericos '+result);
                location.reload();
            },
            error: function (){
                alert('Contate o TI');
            }
        });
    });

    //Cadastrar novo kit (PC-MOUSE-TECLADO-MONITOR-CABO)
    $(document).on("submit","#frmNovoEquip", function(event){
        event.preventDefault();
        alert('Gravando Kit Novo');
        $.ajax({
            data:$(this).serialize(),
            url:"{{ route('equipamento.novo') }}",
            method:'post',
            cache:false,
            success:function(result){
                alert('Salvo'+result);
                location.reload();
            },
            error: function (){
                alert('Contate o TI');
            }
        });
    });
    function mostraModal(id,gps,tipo){
       
        $.ajax({
            
            url:"{{ route('equipamento.frm') }}",
            type:'GET',
            cache:false,
            data:{
                id:id,
                gps:gps,
                tipo:tipo
            },
            success:function(data){
                $("#modal_frm_equip").html(data);
                $("#modal_frm_equip").modal();
                
            },
            error: function (){
                alert('Sem reserva para troca');
            }
        });
    }
    function atualizaGps(_id, _status)
    {
        $.ajax({
            url: "{{ route('atualiza.gps') }}",
            type: 'GET',
            cache: false,
            data:{ id:_id, status:_status},
            success: function(data){
                alert('Alterado');
                location.reload();
            },
            error: function (){
                alert('Não deu');
            }
        });

    }
    function mostraNovoPC(){
        
        if( $("#divNovoCadastroPc").attr('style')=='display: none;')
        {
            $("#divNovoCadastroPc").show();
            $("#divNovoCadastro").hide();
            $("#divNovoPeriferico").hide();
        }else{
            $("#divNovoCadastroPc").hide();
            
        }
    }
    function mostraNovo(){
        if( $("#divNovoCadastro").attr('style')=='display: none;')
        {
            $("#divNovoCadastro").show();
            $("#divNovoPeriferico").hide();
            $("#divNovoCadastroPc").hide();
        }else{
            $("#divNovoCadastro").hide();
            
        }
 
    }
    function mostraPerifericos(){
        if( $("#divNovoPeriferico").attr('style')=='display: none;')
        {
            $("#divNovoPeriferico").show();
            $("#divNovoCadastro").hide();
            $("#divNovoCadastroPc").hide();
        }else{
            $("#divNovoPeriferico").hide();
            
        }
 
    }
     
  
</script>

@stop
