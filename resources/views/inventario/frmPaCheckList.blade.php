
    <div class = 'col-sm-auto'>
        <input class= 'form-control' id = "pa_gps"  placeholder="NUMERO DA PA" value='<?php echo ($pa =='0'?'':$pa); ?>'> </input>
    </div>
    
    <div class = 'col-sm-auto'>
        <a onclick = "troca('lacre')"><div class= "alert alert-success text-center" id = 'div_lacre'>
            <h2>  <span class = 'fa fa-lock' id = 'sp_lacre' ativo='1' ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
        <a onclick = "troca('pc')"><div class= "alert alert-success text-center" id = 'div_pc'>
            <h2>  <span class = 'fa fa-windows' id = 'sp_pc' ativo='1' ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
        <a onclick = "troca('monitor')"><div class= "alert alert-success text-center" id = 'div_monitor'>
            <h2>  <span class = 'fa fa-desktop' id = 'sp_monitor' ativo='1' ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
        <a onclick="troca('mouse')" ><div class= "alert alert-success text-center" id = "div_mouse">
            <h2>  <span class = 'fa fa-gamepad' id = 'sp_mouse'  ativo='1'  ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
        <a onclick="troca('teclado')"><div class= "alert alert-success text-center" id = "div_teclado">
            <h2>  <span class = 'fa fa-keyboard-o' id='sp_teclado'  ativo='1'  ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
        <a onclick="troca('cabo')"><div class= "alert alert-success text-center" id = "div_cabo">
            <h2>  <span class = 'fa fa-headphones' id = 'sp_cabo' ativo='1'  ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
        <a onclick="troca('certificado')"><div class= "alert alert-success text-center" id = "div_certificado">
            <h2>  <span class = 'fa fa-certificate' id = 'sp_certificado' ativo='1'  ></span></h2>
        </div></a> 
    </div>
    <div class = 'col-sm-auto'>
       <input type='text' class='form-control' id='obs' placeholder="Observação"></input>
    </div>
    
    <div class = 'col-sm-auto'>
        <a onclick="proximaPa()"> <div class= 'btn-primary text-center'>Proxima PA <span class ='fa fa-forward'></span></div> </a>
    </div>
  

<script>
    function troca(_equipamento){
        
        var clase = $("#sp_"+_equipamento).attr('ativo');
        //alert(clase);
        if(clase == '1')
        {
            $("#div_"+_equipamento).removeClass('alert-success').addClass('alert-danger');
            $("#sp_"+_equipamento).attr('ativo', '0');
        }else if(clase == '0'){
            $("#div_"+_equipamento).removeClass('alert-danger').addClass('alert-success');
            $("#sp_"+_equipamento).attr('ativo', '1');
        }
        
    }
    function proximaPa(){
        var pa = $("#pa_gps").val();
        if(pa){
           //Carrega os stauts dos equipamentos para envio via ajax
           var sLacre = $("#sp_lacre").attr('ativo');
           var sPc = $("#sp_pc").attr('ativo');
           var sMonitor = $("#sp_monitor").attr('ativo');
           var sMouse = $("#sp_mouse").attr('ativo');
           var sTeclado = $("#sp_teclado").attr('ativo');
           var sCabo = $("#sp_cabo").attr('ativo');
           var sCertificado = $("#sp_certificado").attr('ativo');
           var obs = $("#obs").val();
           
           $.ajax({
                data:{
                    statusL : sLacre,
                    statusP : sPc,
                    statusM : sMonitor,
                    statusmO :sMouse,
                    statusT : sTeclado,
                    statusC : sCabo,
                    statusCe : sCertificado,
                    txtObs : obs,
                    paGps : pa
                },
                method: 'GET',
                cache: false,
                url: "{{ route('salva.checklist') }}",
                success: function(resultado){
                    $("#div_rslt").html(resultado);
                },
                error: function(){
                    alert('Contate a TI');
                }

           });

        }else{
            alert('Informe o numero da PA!');
            $("#pa_gps").focus();
        }
    }

</script>