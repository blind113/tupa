@extends('html')
@section('title', 'Inventarios')
@section('content')

    <div class = "row">
    <h2>Inventário de Periféricos ( Plansul ) </h2>
    <br/>
        <div class = "col-sm-10">
            <button class = 'button btn-primary' onclick = "mostraNovo();" >Novo kit (Completo)</button>
            <button class = 'button btn-primary' onclick = "mostraNovoPC();">Novo computador</button>
            <button class = 'button btn-primary' onclick = "mostraPerifericos();" >Novos Perifericos</button>
            <button class = 'button btn-primary' onclick=  "window.location='{{ route('dashboard') }}' "> Dashboard </button>
           <!-- <button class = 'button btn-primary'> Cadastrar Planilha </button> 
            <button class = 'button btn-primary'> CEF - Completo</button>-->
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-8" name = 'divNovoCadastroPc' id = 'divNovoCadastroPc' style = 'display: none;' >
            <form class ='form' id='frmNovoPc' name ='frmNovoPc'> 
                <input type='hidden'  name = '_token' value = '{{ csrf_token() }}'/>	
                    <div class="row">		
                        <div class="col-sm-4" >
                            <label for ='etmaquina'>ET da Maquinha: </label>
                            <input class = 'form-control' type = 'text' name="etmaquina"/> 
                        </div> 
                        <div class="col-sm-4" >
                            <label for ='etmaquina'>Serial: </label>
                            <input class = 'form-control' type = 'text' name="serial"/> 
                        </div> 
                    </div>
                    <div class="row">
		        		<div class="col-sm-4" > 
                            <label > Ramal:</label>
                            <input class ="form-control"   type="text" name="ramal" />
                        </div>
                        <div class="col-sm-4" > 
                            <label > GPS:</label>
                            <input class ="form-control"  type="text" name="gps" value='9000' readonly />
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class="col-sm-4" >
                            <label class="form-check-label">Dono</label>
                            <label class="form-check-label">CX</label>
                            <input class="noUniform"  type="radio"  name="donoPc" id = "dcx" value = 'CX' />
                            <label class="form-check-label">PL</label>
                            <input  class="noUniform" type="radio" name="donoPc" id = "dpl" value = 'PL'  checked/>
                        </div>
                    </div>
                <button  clas= "btn btn-default" type="submit" value="Gravar">Gravar</button>
            </form>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-4" name = 'divNovoPeriferico' id = 'divNovoPeriferico' style = 'display: none;' >
            <h2>Cadastro de perifericos.</h2>
			
            <form class ='form' id='frmNovoPeriferico' name ='frmNovoPeriferico'> 
                <input type='hidden'  name = '_token' value = '{{ csrf_token() }}'/>
                <Label for = 'perifericos'> Tipo de Perifericos</label>
                <select class = 'form-control' id='perifericos' name='perifericos'>
                    <option value = '0' name = 'perifericos'>Escolha</option>
                    <?php
                        foreach($listaPer as $lp)
                        {
                            echo "<option value = ".$lp['idTipoEquipamento']." name = 'perifericos'>".$lp['desc']."</option>";
                        }
                    ?>
                </select>
                
                <label for="quantidade">Quantidade:</label>
                <input class = 'form-control'  type="number" id="qtdPerifericos" name="qtdPerifericos" min="0" max="100">
                
                <label class="form-check-label">Dono</label>
                <label class="form-check-label">CX</label>
                <input class="noUniform"  type="radio"  name="donoPerifericos" id = "dcx" value = 'CX' />
                <label class="form-check-label">PL</label>
                <input  class="noUniform" type="radio" name="donoPerifericos" id = "dpl" value = 'PL'  checked/>
                <br/>   
                <button  clas= "btn btn-default" type="submit" value="Gravar">Gravar</button>
            </form>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-12" name = 'divNovoCadastro' id = 'divNovoCadastro' style = 'display: none;' >
            
		<h2>Cadastro de KIT completo.</h2>
			<br> 

		<div class="row">
	        <div class="col-sm-4">
			    <img src="../public/assets/images/maquinas.jpg" width="330" height="280" /> 
		    </div>
        
            <div class="col-sm-8" >
                <form class ='form' id='frmNovoEquip' name ='frmNovoEquip'> 
                   <input type='hidden'  name = '_token' value = '{{ csrf_token() }}'/>	
                    <div class="row">		
                        <div class="col-sm-4" >
                            <label for ='etmaquina'>ET da Maquinha: </label>
                            <input class = 'form-control' type = 'text' name="etmaquina"/> 
                        </div> 
                        <div class="col-sm-4" >
                            <label for ='etmaquina'>Serial: </label>
                            <input class = 'form-control' type = 'text' name="serial"/> 
                        </div> 
                    </div>
		        <br/>
		        	<div class="row">
		        		<div class="col-sm-4" > 
                            <label > Ramal:</label>
                            <input class ="form-control"   type="text" name="ramal" />
                        </div>
                        <div class="col-sm-4" > 
                            <label > GPS:</label>
                            <input class ="form-control"  type="text" name="gps" />
                        </div>
                    </div>
                <br/>
            	   	<div class="row">
		            	<div class="col-sm-2" >  
                            <label class="form-check-label">Mouse</label>  
                            <br/> 
                            <label class="form-check-label" for = 'mcx'>CX</label>
                            <input  class="noUniform" type="radio" name="mouse" id = "mcx" value = 'CX'  checked />
                            <label class="form-check-label" for= "mpl">PL</label>
                            <input  class="noUniform" type="radio" name="mouse" id = "mpl" value = 'PL' /> 
                        </div> 
		     			
                        <div class="col-sm-2" >       
                            <label class="form-check-label">Teclado</label>
                            <br/>
                            <label class="form-check-label">CX</label>
                            <input class="noUniform"  type="radio"  name="teclado" id = "tcx" value = 'CX'  checked/>
                            <label class="form-check-label">PL</label>
                            <input  class="noUniform" type="radio" name="teclado" id = "tpl" value = 'PL'/> 
                        </div>
                    
		     			<div class="col-sm-2" > 
		        	    	<label class="form-check-label">Cabo QD</label>
                            <br/>
                            <label class="form-check-label">CX</label>
		            	   	<input class="noUniform"  type="radio" name="cabo" id = "ccx" value = 'CX'/>
                            <label class="form-check-label">PL</label>
                            <input class="noUniform"  type="radio" name="cabo" id = "cpl" value = 'PL'  checked/>
	            		</div>
	            		<div class="col-sm-2" > 
		        			<label class="form-check-label">Monitor</label>
                            <br/>
                            <label class="form-check-label">CX</label>
		            	   	<input class="noUniform"  type="radio" name="monitor" id = "mocx" value = 'CX'  checked/>
                            <label class="form-check-label">PL</label>
                            <input class="noUniform"  type="radio"   name="monitor" id = "mopl" value = 'PL'/>
		       		    </div>  
		       		</div>
                <br/>
		       		<div class = "row">
						<div class = 'col-sm-4' >
			     			<label class="form-check-label">Último Histórico:</label>
		            		<input class="form-control"  type="date" name="dtReq"  id="dtReq" />
		           		</div> 
		       		</div>
                    <div class = "row">
                        <div class = 'col-sm-6'>
                        </div>
                        <div class = 'col-sm-2'>
                            
                            <button  clas= "btn btn-default"type="submit" value="Gravar">Gravar</button>
                        </div>
                    </div>
                </div>     	
                </form>
            </div> 
        </div>
    </div>
                        <br/>
    <div class = "row">
        <div class = "col-sm-10">
            <table class = "table" id='listaEquip' name = 'listaEquip'>
                <thead>
                    <tr>
                        <th>GPS</th>
                        <th>ET</th>
                        <th>Serial</th>
                        <th>Ramal</th>
                        <th>Monitor</th>
                        <th>Mouse</th>
                        <th>Teclado</th>
                        <th>CaboQD</th>
                        <th>REQ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        foreach($lista as $l)
                        {

                            echo '<tr>';
                                echo '<td>'.$l['gps'].'</td>';
                                echo '<td><a href="#" onclick = "javascript:mostraModal(\''.$l['idEquipamento'].'\', \''.$l['gps'].'\', \''.$l['idTipoEquipamento'].'\' );">'.$l['et'].'</td>';
                                echo '<td>'.$l['serial'].'</td>';
                                echo '<td>'.$l['ramal'].'</td>';
                                echo '<td><a href="#" onclick = "javascript:mostraModal(\''.$l['idMt'].'\', \''.$l['gps'].'\', 2  );">'.$l['mt'].'</a></td>';
                                echo '<td><a href="#" onclick = "javascript:mostraModal(\''.$l['idMd'].'\', \''.$l['gps'].'\', 3 );">'.$l['md'].'</a></td>';
                                echo '<td><a href="#" onclick = "javascript:mostraModal(\''.$l['idTc'].'\', \''.$l['gps'].'\', 4 );">'.$l['tc'].'</a></td>';
                                echo '<td><a href="#" onclick = "javascript:mostraModal(\''.$l['idCb'].'\', \''.$l['gps'].'\', 5  );">'.$l['cb'].'</a></td>';
                                echo '<td>ultma REQ</td>';
                                echo '<td></td>';
                            echo '</tr>';
                        }
                    
                    ?>
                </tbody>
            </table>
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
            url:"{{ route('perifericos.novos') }}",
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
