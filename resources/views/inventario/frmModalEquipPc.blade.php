<form id = 'frmEquipamento' class = 'form'>
<div class = 'modal-dialog modal-sm'>
    <div class = 'modal-content'>
        <div class = 'modal-header'>
            Alteração Computador
        </div>

        <div class = 'modal-body'>
            
             <input type='hidden'  name = '_token' value = '{{ csrf_token() }}'/>
              <label for = 'idEquip'> Id Equipamento  </label>
              <input class = 'form-control' type = 'text' id='idEquipAtual' name = 'idEquipAtual' value = '<?php echo $idEAtual; ?>' readonly  />
              <label for = 'idEquip'> Destino (GPS) </label>
              <input class = 'form-control' type = 'text' id='gpsAtual' name = 'gpsAtual' required  />

              <label for = 'idEquip'> Computador Reserva </label>
              <select class = 'form-control' class = 'select' id='idEquipReserva' name = 'idEquipReserva'>
                <option value = 0>Escolha</option>
                <?php 
                    foreach($listaPc as $lp)
                    {
                        echo '<option value = '.$lp['idEquipamento'].'>'.$lp['et'].'</option>';
                    }
                ?>
              </select>

         
              <label for = 'idEquip'> GPS </label>
              <input class = 'form-control' type = 'text' id='gpsReserva' name = 'gpsReserva'  value = "<?php echo $gpsAtual; ?>" readonly /> 
  
        </div>

        <div class = 'modal-footer'>
            <button type="submit" class= 'btn btn-default'  >Salvar</button>
            <button type='button' class= 'btn btn-default' onclick="javascript:reload();" >Fechar</button>
        </div>
        </form>
    </div>
</div>

<script>
function reload(){
    $('#modal_frm_equip').hide();
    location.reload();
    return false;
}


$(document).on("submit","#frmEquipamento", function(event){
        event.preventDefault();
        
        $.ajax({
            data:$(this).serialize(),
            url:"{{ route('perifericos.alterar') }}",
            method:'post',
            cache:false,
            success:function(result){
                alert(result);
                location.reload();
            },
            error: function (){
                alert('Contate o TI');
            }
        });
    });
</script>