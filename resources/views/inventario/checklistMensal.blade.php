@extends('html')
@section('title', 'Inventarios')
@section('content')
    <h1> Dias do mês </h1> 
    <div class = 'row'>  
    @for($i=1;$i<=date('d');$i++)
        
    <span class="badge badge-warning"><a onclick ="divTabela({{$i}})" class= 'stretched'>{{$i}}/{{date('m')}}</a></span>
        
    @endfor
    </div>
    <div class = 'row' id='div_tabela_rslt'>
    </div>
    
<script>
    function divTabela(_id){
       // $("#div_tabela_rslt").html('OI'+_id);
       var _img = '<img src="/assets/images/load.gif" alt="Minha Figura">';
        $('#div_tabela_rslt').html(_img);
        $.ajax({
            data: {dia:_id},
            type: "GET",
            url: "{{ route('listaCheckList') }}",
            success: function(resultado){
                //alert(resultado);
                $('#div_tabela_rslt').html(resultado);
            },
            error: function (){

            }
        });
    }
</script>

@stop