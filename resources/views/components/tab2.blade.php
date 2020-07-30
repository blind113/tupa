<div class="tab tab-2" data-tab-id='2'>
  <div id="divborder">
    <div class="row">
      <div class="col-md-10">
        @component('elements/input/text',['name'=>'nome','label'=>'Nome'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/select',['id'=>'sexo', 'name'=>'sexo','label'=>'Sexo','opcoes'=>['M'=>'Masculino','F'=>'Feminino']])
        @endcomponent
      </div>
    </div> 
    <div class="row">
      <div class="col-md-2">
        @component('elements/input/date',['dateId'=>'datetimeDataNasc','name'=>'data_nasc','label'=>'Data Nascimento'])
        @endcomponent
      </div>
      <div class="col-md-4">
        @component('elements/input/text',['name'=>'rg','label'=>'RG'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/date',['dateId'=>'dateDataexp','name'=>'data_expedicao','label'=>'Data Expedição'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/text',['id'=>'orgao','name'=>'orgao','label'=>'Orgão'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/text',['name'=>'telefone','label'=>'Telefone'])
        @endcomponent
      </div>
    </div>
    <div class="row">
       <div class="col-md-6">
        @component('elements/input/text',['name'=>'nome_pai','label'=>'Nome do Pai'])
        @endcomponent
      </div>
       <div class="col-md-6">
        @component('elements/input/text',['name'=>'nome_mae','label'=>'Nome da Mãe'])
        @endcomponent
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        @component('elements/input/textcep',['name'=>'cep','label'=>'CEP'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/text',['name'=>'uf','label'=>'UF'])
        @endcomponent
      </div>
      <div class="col-md-4">
        @component('elements/input/text',['name'=>'cidade','label'=>'Cidade'])
        @endcomponent
      </div>
      <div class="col-md-4">
        @component('elements/input/text',['name'=>'bairro','label'=>'Bairro'])
        @endcomponent
      </div>
      <div class="col-md-10">
        @component('elements/input/text',['name'=>'endereco','label'=>'Endereço'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/text',['name'=>'numero','label'=>'Número'])
        @endcomponent
      </div>
    </div> 
    <div class="row">
      <div class="col-md-6">
        @component('elements/input/textemail',['id'=>'email','name'=>'email','label'=>'E-MAIL'])
        @endcomponent
      </div>
      <div class="col-md-3">
        @component('elements/input/text',['name'=>'pis','label'=>'PIS'])
        @endcomponent
      </div>
      <div class="col-md-3">
        @component('elements/input/text',['id'=>'serie','name'=>'serie','label'=>'Série'])
        @endcomponent
      </div>
    </div>
  </div>
  <div id="divborder1">
    <div class="row">
      <div class="panel-heading">
        <h2 class="panel-title">
          Informações Bancárias
        </h2>
      </div>
    </div> 
    <div class="row">
      <div class="col-md-4">
        @component('elements/input/select',['id'=>'banco','name'=>'banco','label'=>'Banco','opcoes'=>[]])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/text',['id'=>'agencia','name'=>'agencia','label'=>'Agência'])
        @endcomponent
      </div>
      <div class="col-md-2">
        @component('elements/input/text',['id'=>'op','name'=>'op','label'=>'OP'])
        @endcomponent
      </div>
      <div class="col-md-4">
        @component('elements/input/text',['id'=>'conta','name'=>'conta','label'=>'Conta'])
        @endcomponent
      </div>
    </div>
  </div>    
    <div class="row">
      <div class="panel-heading">
        <h2 class="panel-title">
          Informações Profissionais
        </h2>
      </div>
    </div> 
    <div class="row">
        <div class="col-md-2">
        <input type='hidden' value='0' name='vt'>
        <input onclick="ocultar()" name="vt" id="vt" value="1" type = "checkbox">  
        <label for="vt">VALE TRANSPORTE</label>
        </div>
        <div class="col-md-4">
        @component('elements/input/textvt',['id'=>'empresa','name'=>'empresa','label'=>'Empresa'])
        @endcomponent
        </div>
        <div class="col-md-3">
        @component('elements/input/textvt',['id'=>'sic','name'=>'sic','label'=>'SIC'])
        @endcomponent
        </div>
        <div class="col-md-3">
        @component('elements/input/textvt',['id'=>'ct','name'=>'ct','label'=>'CT'])
        @endcomponent
        </div>
    </div>  
    <div class="row">
      <div class="col-md-4">
        @component('elements/input/select',['id'=>'funcao','name'=>'funcao','label'=>'Cargo','opcoes'=>[]])
        @endcomponent
      </div>
      <div class="col-md-4">
        @component('elements/input/text',['id'=>'horario','name'=>'horario','label'=>'Horário'])
        @endcomponent
      </div>
      <div class="col-md-4">
        @component('elements/input/selectmultiple',['id'=>'beneficios','name'=>'beneficios','label'=>'Beneficios','opcoes'=>[]])
        @endcomponent
      </div>
    </div>
</div>