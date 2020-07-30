var cpfMascarado, currentTab, data;

(function () {
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
})();

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

/*setInterval(function () {
    digitaInput();
}, 1000);*/


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

/*$('#prevBtn').click(function () {
    getCurrentTab();
    retornaTela();
});*/

/*$('#nextBtn').click(function () {
    getCurrentTab();
    proximaTela();
});*/

$('#datetimeDataAdm, #datetimeDataNasc').datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,

});

var select_val = [];
var beneficio = $("#beneficios").select2()
.on("select2:select", function (e) {
    var selected_element = $(e.currentTarget);
    select_val = selected_element.val();
    console.log(select_val);
   
});

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

function ocultar() {
    // Get the checkbox
    var checkBox = document.getElementById("vt");
    // Get the output text
    if (text = document.getElementById("col_empresa")) {
        if (checkBox.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
    }
    if (text = document.getElementById("col_sic")) {
        if (checkBox.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
    }
    if (text = document.getElementById("col_ct")) {
        if (checkBox.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
    }
    if (text = document.getElementById("vtlabel")) {
        if (checkBox.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
    }

  }

/*$(document).on("submit", "#frmRegistroPrint", function (event) {
    event.preventDefault();

    var dados = $("#frmRegistroPrint").serializeArray();

    $(dados).each(function (index, obj) {
        data[obj.name] = obj.value
    });

    
    if(proximaTela() === false){
        return false;
    }

    $.ajax({
        data: {
            data: data,
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + project_path + 'api/colaborador/'+colab,
        success: function (result) {
            //console.log(result);
            //var url = '//' + site_domain + '/' + project_path + 'colaborador/' + 'listar';
            //window.location.href = url;
            
            //var url = '//' + site_domain + '/' + project_path + 'colaborador/' + 'listar';
            //window.location.href = url;
            //var resposta = JSON.parse(result);
            //$('#frmRegistroEdit').text(cpf + ' foi editado com sucesso!');
            //window.location.href = 'listar';
        }
    });
});*/

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