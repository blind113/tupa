@section('frmNovoPc')
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
@stop