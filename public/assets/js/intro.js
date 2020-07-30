var cpf, valor, cpfMascarado, currentTab, data;

(function () {
    data = {}
    getCurrentTab();
    $(".tab-1").addClass('ativo');
    currentTab = $(".tab.ativo").attr('data-tab-id');
    showTab(currentTab);
    ajaxListarFuncao();
    ajaxListarBeneficio();
    ajaxListarBanco();
})();

function getCurrentTab() {
    currentTab = $(".tab.ativo").attr('data-tab-id');
}

setInterval(function () {
    $(".tab.ativo").show();
    togglePrev()
    cpf = $('#cpf').val()
    if (cpf != '') {
        cpfMascarado = mascaraCpf(cpf)
    } else {
        cpfMascarado = ''
    }
    $('#cpf').val(cpfMascarado)
    $('.add-cpf').text(cpfMascarado)
    imprimeCPF()
}, 100);

setInterval(function () {
    digitaInput()
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
});

var select_val = [];
var beneficio = $("#beneficios").select2()
.on("select2:select", function (e) {
    var selected_element = $(e.currentTarget);
    select_val = selected_element.val();
    console.log(select_val);
});
$("#beneficios").select2({
    placeholder: "--SELECIONE--",
});

function ocultar(){  
        if(document.getElementById('vt').checked == true){ 	 
           document.getElementById('sic').disabled = ""  }  
        if(document.getElementById('vt').checked == false){ 	
           document.getElementById('sic').disabled = "disabled"  }	
        if(document.getElementById('vt').checked == true){ 	 
           document.getElementById('ct').disabled = ""  }  
        if(document.getElementById('vt').checked == false){ 	
           document.getElementById('ct').disabled = "disabled"  }	
        if(document.getElementById('vt').checked == true){ 	 
           document.getElementById('empresa').disabled = ""  }  
        if(document.getElementById('vt').checked == false){ 	
           document.getElementById('empresa').disabled = "disabled"  }	
}

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


/*$( document ).ready(function() {
    $.ajax({
        data: {
            data: data,
            "_token": token
        },
        method: "post",
        url: '//' + site_domain + '/' + 'api/colaborador'+ '/criarVT',
        //url: 'api/colaborador/criar',
        success: function (result) {
            //var resposta = JSON.parse(result)
            //$('#frmRegistro').text(resposta.nome + ' foi criado com sucesso!')
            //window.location.href = "listar";
        }
    });
});*/




/*$('#datetimeDataAdm').datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true
});*/

$(document).on("submit", "#frmRegistro", function (event) {
    event.preventDefault();

    var dados = $("#frmRegistro").serializeArray();

    $(dados).each(function (index, obj) {
        data[obj.name] = obj.value
    });
    data.beneficio = select_val;
    console.log(data);

    $.ajax({
        data: {
            data: data,
            "_token": token
        },
        method: "post",
        url: '//' + site_domain + '/' + 'api/colaborador',
        //url: 'api/colaborador/criar',
        success: function (result) {
            //var resposta = JSON.parse(result)
            //$('#frmRegistro').text(resposta.nome + ' foi criado com sucesso!')
            window.location.href = "listar";
        },
        error: function (result) {
            alert("CPF já cadastrado!");
        }
    });
});

function mascaraCpf(valor) {
    return valor.replace(
        /(\d{3})(\d{3})(\d{3})(\d{2})/g,
        "\$1.\$2.\$3\-\$4"
    );
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
        $(this).addClass("invalid");
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
    if (!validateForm()) return false;
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