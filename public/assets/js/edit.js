var cpfMascarado, currentTab, data;

$(document).ready(function(){
    $("#beneficios").select2({
        placeholder: "--SELECIONE--",
    });
    data = {}
    cpfNumbers = cpf.replace('.','');
    cpfNumbers = cpfNumbers.replace('.','');
    cpfNumbers = cpfNumbers.replace('-','');
    ajaxLerColaboradorEdit(cpfNumbers);
    getCurrentTab();
    $(".tab-1").addClass('ativo');
    currentTab = $(".tab.ativo").attr('data-tab-id');
    showTab(currentTab);
    ajaxListarFuncao();
    ajaxListarBanco();
    ajaxListarBeneficio();
    carregaSelect(cpf);
    ajaxCarregaEdit(cpf);
   // ajaxCarregaSelect(cpf);    
})

function getCurrentTab() {
    currentTab = $(".tab.ativo").attr('data-tab-id');
}

setInterval(function () {
    $(".tab.ativo").show();
    togglePrev();
    cpf = $('#cpf').val();
    if (cpf != '') {
        cpfMascarado = mascaraCpf(cpf);
    } else {
        cpfMascarado = '';
    }
    $('#cpf').val(cpfMascarado);
    $('.add-cpf').text(cpfMascarado);
    imprimeCPF();
}, 100);

setInterval(function () {
    digitaInput();
}, 1000);


function togglePrev() {
    if ($('.tab-1').attr('data-tab-id') == currentTab) {
        $('#prevBtn').hide()
    } else {
        $('#prevBtn').show()
    }
}

function digitaInput() {
    $('.tab.ativo').find("input").each(function () {
        $(this).keyup(function () {
            $(this).removeClass("invalid")
        })
        $(this).change(function () {
            $(this).removeClass("invalid")
        })
    })
}

function imprimeCPF() {
    if (cpf !== '') {
        $(".cpf-label").text('CPF:')
    } else {
        $(".cpf-label").empty()
    }
}

$('#prevBtn').click(function () {
    getCurrentTab();
    retornaTela();
});

$('#nextBtn').click(function () {
    getCurrentTab();
    proximaTela();
});

$(document).ready(function(){
	//$("#cep").mask("99.999-999");
	//$("#rg").mask("99.999.999-9");
	$("#horario").mask("00:00 - 00:00");
	$("#telefone").mask("(99)99999-9999");
	$("#data_nasc").mask("99/99/9999");
	$("#data_expedicao").mask("99/99/9999");
	$("#data_adm").mask("99/99/9999");
});

/*$('#datetimeDataAdm').datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,

});*/


    var vt = document.getElementById('vt').onchange = function() {
    document.getElementById('sic').disabled = !this.checked;
    document.getElementById('empresa').disabled = !this.checked;
    document.getElementById('ct').disabled = !this.checked;
};

function carregaSelect(cpf){
    
      $.ajax({
        url: '//' + site_domain + '/' + '/api/colaborador/select/' + cpf,
        dataType: 'json',
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        success: function (data) {
            $('#beneficios').val(data);
            $('#beneficios').trigger('change');
          }
        });
};

$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});


$(document).on("submit", "#frmRegistroEdit", function (event) {
    event.preventDefault();

    var dados = $("#frmRegistroEdit").serializeArray();

    $(dados).each(function (index, obj) {
        if(obj.name!="beneficios[]"){
            data[obj.name] = obj.value
        }
    });

    //iniciando os beneficios
    data['beneficios'] = [];
    var benef = $('#beneficios').select2('data');
    for(var i=0;i<benef.length;i++){
        //adiciona apenas a propriedade id do campo
        data.beneficios.push(benef[i].id);
    }    

    $.ajax({
        data: {
            data: data,
            "_token": token
        },
        method: "put",
        url: '//' + site_domain + '/' + 'api/colaborador/'+colab,
        success: function (result) {
            console.log(result);
            var url = '//' + site_domain + '/' + 'colaborador/' + 'listar';
            window.location.href = url;
            
            //var url = '//' + site_domain + '/' + project_path + 'colaborador/' + 'listar';
            //window.location.href = url;
            //var resposta = JSON.parse(result);
            //$('#frmRegistroEdit').text(cpf + ' foi editado com sucesso!');
            //window.location.href = 'listar';
        }
    });
});

function mascaraCpf(valor) {
    if(valor){
        return valor.replace(
            /(\d{3})(\d{3})(\d{3})(\d{2})/g,
            "\$1.\$2.\$3\-\$4"
        );
    }
}

function validateForm() {
    var valid = true;
    $('.tab.ativo').find("input").each(function () {
        if ($(this).val() == "") {
            $(this).addClass("invalid");
            valid = false;
        } else {
            $(this).removeClass("invalid");
        }
    });
    $('.tab.ativo').find("select").each(function () {
        if ($(this).val() == "") {
            $(this).addClass("invalid");
            valid = false;
        } else {
            $(this).removeClass("invalid");
        }
    });
    if (!validateCPF($('input#cpf').val())) {
        $(this).val("invalid");
        alert('CPF não é válido');
        valid = false;
    }
    return valid;
}

function showTab() {
    $(".tab").removeClass('ativo');
    $(".tab.tab-" + currentTab).addClass('ativo');
    if (currentTab == $('.tab').length) {
        $('#nextBtn').text('Gravar');
    }
}

function proximaTela() {
    if (!validateForm()) {
        return false;
    }; 
    if (currentTab < $('.tab').length)++currentTab;
    showTab(currentTab);
}

function retornaTela() {
    if (currentTab > 1)--currentTab
    showTab(currentTab)
}

function validateCPF(value) {
    value = jQuery.trim(value);
    value = value.replace('.', '');
    value = value.replace('.', '');
    cpf = value.replace('-', '');
    while (cpf.length < 11) cpf = "0" + cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;

    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }

    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }
    b = 0;
    c = 11;
    for (y = 0; y < 10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }

    var retorno = true;
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

    return retorno;
}