@section('frmNovosPerifericos')
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
@stop