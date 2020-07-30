<form class= 'form' id ='frmNovoReq' name ='frmNovoReq'>
    <input type='hidden' name ='_token' value='{{ csrf_token() }}' /> 
    
    <div class = 'modal-dialog modal-sm'>
        <div class='modal-content'>
            <div class = 'modal-header'>
                Cadastro de REQ
            </div>
            
            <div class='modal-body'>
                <label for ='input_req'> REQ </label>
                
                <input class = 'form-control' type ='text' id = 'input_req' name= 'input_req' required/>
                <input type='hidden' name='idEquipamento' id = 'idEquipamento' value="<?php echo $idEquipamento; ?>" />

            </div>

            <div class= 'modal-footer'>
                <button type='submit' class ='btn btn-default' >Salvar</button>
                <button type = 'button' class = 'btn btn-default' data-dismiss ='modal'>Fechar</button>
            </div>
        </div>
    </div>
</form>


<script>
$(document).on("submit", "#frmNovoReq", function(event){
    event.preventDefault();
    $.ajax({
        data:$(this).serialize(),
        url: "{{ route('req.novo') }}",
        method: 'post',
        cache:false,
        success:function(result){
            alert('Salvo');
            location.reload();
        },
        error: function(){
            alert('Contate o TI');
        }
    });
});

</script>