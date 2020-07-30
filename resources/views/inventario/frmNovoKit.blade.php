@section('frmNovoKit')
<h2>Cadastro de KIT completo.</h2>
			<br> 

		<div class="row">
	        <div class="col-sm-4">
			    <img src="../assets/images/maquinas.jpg" width="330" height="280" /> 
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
@stop