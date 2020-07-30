<body class="page-header-fixed compact-menu">
    <input type="hidden" id="classe_menu" name="classe_menu" />
    <div class="overlay"></div>
    @component('components/main')
    @endcomponent
    @stack('scripts')
</body>

<!-- @Osorio 2020-07 -->
<!-- MODAL PARA INFORMAÇÃO DOS CODIGOS DO SETOR -->

<div class = 'modal fade' id="infos" tabindex = '-1' role="dialog">

  <div class="modal-dialog" role="document">
    
     <div class ="modal-content">
          <div class = 'modal-header'>
            <label class="label">Informações gerais.</label>
            <button type="button" class="close" data-dismiss="modal" arial-label="Fechar">&times;</button>
          </div>
          <div class ="modal-body">
            <table class ="table" id="setoresDescricao" name="setoresDescricao">
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Descrição</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
          <div class = "modal-footer">
            <button class='btn btn-secondary' data-dismiss="modal">Fechar</button>
          </div>
      </div>
     </div> 
</div>

<script>
$(document).ready(function(){
    //Procura informação e monta tabela dentro da tabela 
    //alert('Carrega div setores');
    var table='';
    $.ajax({
        url:'//192.168.1.15:86/inv/descricao_setor',
        typr:'GET',
        cache: false,
        success: function(data){
          $.each(data, function(key, item ) {
            //alert(item.idSetorReg);
            table += '<tr>'; 
              table += '<td>'+item.cod_ini+'</td>';
              table += '<td>'+item.descricao+'</td>';
            table += '</tr>';
              
          });
          
          $('#setoresDescricao tbody').append(table);
        },
        error: function(){

        }
    });
});
</script>