var date, meta = {}, cpfNumbers;
var codigoObj = {};


///console.log(colab);

$(window).load(function() {
    cpfNumbers = cpf.replace('.','.');
    cpfNumbers = cpfNumbers.replace('.','.');
    cpfNumbers = cpfNumbers.replace('-','-');
    ajaxListarEntidade('obrigacao');
    ajaxListarEntidade('requisito');
    ajaxLerColaborador(cpfNumbers);
    
    $('body').on('click', '.checkbox input', function(e) {
        entidade = $(this).attr('name');
        $(".checkbox input[name='" + entidade + "']:checked").each(function() {
            idobrigacao = $(this).attr('id');
            codigoObj[idobrigacao] = {  
                dates: {
                    create: new Date(),
                    update: new Date()
                },
                operador: {
                    creator: matricula,
                    updator: matricula
                }
            };
        });
        //colab[entidade] = codigoObj
        progressChecker();
    });
    
    $('body').on('keyup change', '#observacoes', function(e) {
        var observacoes = $('#textareaobservacoes').val();
        colaborador.meta.observacoes = observacoes;
    });

    $("#gravar").click(function() {
        if (colaborador.meta) {
            colaborador.meta.bloqueado = {};
        }
       ajaxAtualizarColaborador(colaborador);
    });
    
    $("#ok-plansul").click(function() {
        if (colaborador.meta.okPlansul == true) {
            colaborador.meta.okPlansul = false;
            $("#ok-caixa").addClass('disabled');
        } else {
            colaborador.meta.okPlansul = true;
            $("#ok-caixa").removeClass('disabled');
        }
    });
    
    $("#ok-caixa").click(function() {
        colaborador.meta.okPlansul = true;
    });
});

/*$(window).on('beforeunload', function() {
    //console.log(colab);
    alert("Fechando a Janela");
    if (colaborador.meta) {
        colaborador.meta.bloqueado = {};
    }
    return "Handler for .unload() called.";
});*/

/*setTimeout(function() {
    for (var ntdds in colaborador.meta.entidades) {
        var ntddsArr = colaborador.meta.entidades[ntdds]
        for (var ntddsItem in ntddsArr) {
            $(".checkbox #" + ntddsItem + "[name=" + ntdds + "]").attr('checked', 'checked')
        }
    }
}, 2000)*/

setTimeout(function() {
    progressChecker();
}, 3000)

var itemCheck = function(descricao, idobrigacao, entidade) {
    console.log(entidade);
    //let check;
    check = '<div class="checkbox">';
    check += '<label>';
    check += '<input type="checkbox" name="chk_'+entidade+'[]" id="' + idobrigacao + '"/> ' + descricao;
    check += '</label>';
    check += '</div>';
    return check;
}

var progressChecker = function() {
    var statusClass, bar, total = $(".checkbox input").length,
    feito = $(".checkbox input:checked").length,
    progresso = Math.round((feito / total) * 100);
    progresso = isNaN(progresso)?0:progresso;
    if (progresso == 100) {
        statusClass = "progress-bar-success";
        $("#ok-plansul").removeClass('disabled');
    } else {
        $("#ok-plansul").addClass('disabled')
    }
    if (progresso < 100) statusClass = "progress-bar-info";
    if (progresso < 66) statusClass = "progress-bar-warning";
    if (progresso < 33) statusClass = "progress-bar-danger";
    
    bar = progressBar(statusClass, progresso);
    $('.progress').html(bar);
}

var progressBar = function(statusClass, progresso) {
    var bar = '';
    bar += '<div class="active progress-bar ' + statusClass + '" role="progressbar" aria-valuenow="' + progresso + '" aria-valuemin="0" aria-valuemax="100" style="width: ' + progresso + '%; color: #000">';
    bar += progresso + '% completo';
    bar += '</div>';
    return bar;
}