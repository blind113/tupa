var nomeFuncao = {};
var nomeBeneficio = {};
var ajaxListarEntidade = function (entidade) {
    $.ajax({
        data: {
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + 'api/' + entidade,
        success: function (result) {
            var lista = JSON.parse(result);
            if (entidade == 'obrigacao') {
                lista.data.map(function (item) {
                    var itemCheckItem = itemCheck(item.descricao, item.idobrigacao, entidade);
                    //console.log(item.idobrigacao);
                    $('#obrigacoes').prepend(itemCheckItem);
                })
            }
            if (entidade == 'requisito') {
                lista.data.map(function (item) {
                    var itemCheckItem = itemCheck(item.descricao, item.codigo, entidade);
                    $('#requisitos').prepend(itemCheckItem);
                })
            }
        }
    });
}


var ajaxListarFuncao = function () {
    $.ajax({
        data: {
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + '/api/funcao',
        success: function (result) {
            var lista = JSON.parse(result);
            lista.data.map(function (item) {
                var opt = '<option value=' + item.codigo + '>' + item.descricao + '</option>';
                $('#funcao').prepend(opt);
            })
        }
    });
}

var ajaxListarBeneficio = function () {
    $.ajax({
        data: {
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + 'api/beneficio',
        success: function (result) {
            var lista = JSON.parse(result);
            lista.data.map(function (item) {
                var opt = '<option value=' + item.idbeneficio + '>' + item.descricao + '</option>';
                $('#beneficios').prepend(opt);
            })
        }
    });
}

var ajaxListarBanco = function () {
    $.ajax({
        data: {
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + 'api/banco',
        success: function (result) {
            var lista = JSON.parse(result);
            lista.data.map(function (item) {
                var opt = '<option value=' + item.idbanco + '>' + item.descricao + '</option>';
                $('#banco').prepend(opt);
            })
        }
    });
}

var ajaxLerFuncao = function (codigo) {
    console.log(codigo);
    return $.ajax({
        data: {
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + 'api/funcao/' + codigo,
        success: function (result) {
            var entidade = JSON.parse(result);
            nomeFuncao[codigo] = entidade.descricao;
            return nomeFuncao;
        }
    });
}


var ajaxLerEntidade = function (codigo) {
    $.ajax({
        data: {
            "_token": token
        },
        method: "get",
        url: '//' + site_domain + '/' + entidade + '/' + codigo,
        success: function (result) {
            var entidade = JSON.parse(result)
            $('#codigo').val(entidade.codigo)
            $('#descricao').val(entidade.descricao)
            $('#observacoes').val(entidade.observacoes)
        }
    });
}

var ajaxLerColaboradorOld = function () {
    $.ajax({
        data: {
            "_token": token,
            cpf: cpf
        },
        method: "get",
        url: '//' + site_domain + '/' + 'api/colaborador',
        success: function (result) {
            colaborador = JSON.parse(result);
            if (!colaborador.meta) {
                colaborador.meta = {
                    okPlansul: false,
                    bloqueado: {
                        por: matricula,
                        em: new Date()
                    },
                    entidades: {}
                }
            } else {
                if (colaborador.meta.bloqueado == undefined) {
                    colaborador.meta.bloqueado = {
                        por: matricula,
                        em: new Date()
                    };
                    ajaxAtualizarColaborador(colaborador);
                } else {
                    if (colaborador.meta.bloqueado.por != matricula) {
                        alert("No momento usuário: " + matricula + " está atualizando essa página.");
                        var url = '//' + site_domain + '/' + '/precp/listar';
                        window.location.href = url;
                    }
                }
            }
        }
    });
}

var ajaxLerColaborador = function (cpf) {
    $.ajax({
        data: {
            "_token": token,
        },
        method: "get",
        url: '//' + site_domain + '/' + 'api/colaborador/' + cpf,
        success: function (result) {
            colaborador = JSON.parse(result);           
            Object.keys(colaborador).forEach(function (key) {
                switch (key) {
                    case 'nome':
                        var label = 'Nome';
                        $('.nome').each(function(){
                            $(this).text(colaborador[key]);
                        });
                        break;
                    //case 'nome_social':
                        //var label = 'Nome Social';
                        //break;
                    /*case 'data_adm':
                        var label = 'Data';
                        break;*/
                    case 'funcao':
                        var label = 'Função';
                        ajaxLerFuncao(colaborador[key]);
                        break;
                    case 'sexo':
                        var label = 'Sexo';
                        colaborador[key] = (colaborador[key] == 'M') ? 'Masculino':'Feminino';
                        break;
                    case 'data_nasc':
                        var label = 'Data de Nascimento';
                        break;
                    case 'obrigacoes':
                        var label = "";
                        Object.keys(colaborador.obrigacoes).forEach(function(nkey){
                            console.log(colaborador.obrigacoes);
                            //alert(colaborador.obrigacoes[nkey].idobrigacao);
                            $("#"+colaborador.obrigacoes[nkey].idobrigacao).attr("checked","checked");
                            $("#textareaobservacoes").val(colaborador.obrigacoes[nkey].observacoes);
                        });
                        break;
                    default:
                        var label = key.toUpperCase();
                }
                if(key != 'meta'){
                    var line = '<strong class="'+key+'">' + label + '</strong>: <span class="'+key+'-val">' + colaborador[key] + '</span></br>';
                    if(key!='obrigacoes')
                        $('#colaborador-dados').append(line);
                }
            });
            if (!colaborador.meta) {
                colaborador.meta = {
                    okPlansul: false,
                    bloqueado: {
                        por: matricula,
                        em: new Date()
                    },
                    entidades: {}
                }
            } else {
                if (colaborador.meta.bloqueado == undefined) {
                    colaborador.meta.bloqueado = {
                        por: matricula,
                        em: new Date()
                    };
                    //ajaxAtualizarColaborador(colaborador);
                } else {
                    if (colaborador.meta.bloqueado.por != matricula) {
                        alert("No momento usuário: " + matricula + " está atualizando essa página.");
                        var url = '//' + site_domain + '/' + '/precp/listar';
                        window.location.href = url;
                    }
                }
            }
        }
    });
}

setTimeout(function() {
    $('#funcao-val').text(nomeFuncao)
}, 1500);

var ajaxLerColaboradorEdit = function (cpf) {
    $.ajax({
        data: {
            "_token": token,
        },
        method: "get",
        url: '//' + site_domain + '/' + '/api/colaborador/' + cpf,
        success: function (result) {
            //console.log(result);
            colaborador = JSON.parse(result);

            Object.keys(colaborador).forEach(function (key) {

                $('[name=' + key + ']').val(colaborador[key]);

            });
        }
    });
}

var ajaxAtualizarColaborador = function (upcolaborador) {
    var dataAjax = {
        "_token": token,
        colaborador: upcolaborador.idcolaborador,
        observacoes: upcolaborador.meta.observacoes,
        obrigacoes: []
    };

    $("input[name='chk_obrigacao[]']").each(function(){
        if($(this).prop("checked")){
            dataAjax.obrigacoes.push($(this).prop("id") );
        }
    });

    $.ajax({
        data: dataAjax,observacoes,
        method: "post",
        url: '//' + site_domain + '/' + 'api/colaborador/setdados',
        success: function (result) {
            var url = '//' + site_domain + '/' + 'colaborador/' + 'listar';
            window.location.href = url;
        }   
    });
}

var ajaxCriarEntidade = function (setData) {
    $.ajax({
        data: {
            codigo: setData.codigo,
            descricao: setData.descricao,
            observacoes: setData.observacoes,
            "_token": token
        },
        method: "post",
        url: '//' + site_domain + '/' + 'api/' + entidade,
        success: function (result) {
           var url = '//' + site_domain + '/' + entidade + '/listar';
           window.location.href = url;
        }
    });
}

var ajaxAtualizarEntidade = function (setData) {
    $.ajax({
        data: {
            codigo: setData.codigo,
            descricao: setData.descricao,
            observacoes: setData.observacoes,
            "_token": token
        },
        method: "put",
        url: '//' + site_domain + '/' + 'api/' + entidade,
        success: function (result) {
            var url = '//' + site_domain + '/' + entidade + '/listar';
            window.location.href = url;
        }
    });
}


var ajaxCarregaEdit = function (cpf) {
    $.ajax({
        data: {
            "_token": token,
        },
        method: "get",
        url: '//' + site_domain + '/' + '/api/colaborador/set/' + cpf,
        success: function (result) {
            colaborador = JSON.parse(result);

            Object.keys(colaborador).forEach(function (key) {

                $('[name=' + key + ']').val(colaborador[key]);

            });
        }
    });
}

var ajaxCarregaSelect = function (cpf) {
    $.ajax({
        data: {
            "_token": token,
        },
        method: "get",
        url: '//' + site_domain + '/' + '/api/colaborador/select/' + cpf,
        success: function (result) {
            //alert(result);
            colaborador = JSON.parse(result);

            Object.keys(colaborador).forEach(function (key) {

                $('[idbeneficio=' + key + ']').val(colaborador[key]);

            });
        }
    });
}

var ajaxApagarEntidade = function (codigo) {
    $.ajax({
        data: {
            codigo: codigo,
            "_token": token
        },
        method: "delete",
        url: '//' + site_domain + '/' + 'api/' + entidade + '/' + codigo,
        success: function (result) {
            //confirm('Tem certeza que deseja excluir?');
            dataTable.ajax.reload();
        }
    });
}

var ajaxApagarColaborador = function (codigo) {
    $.ajax({
        data: {
            codigo: codigo,
            "_token": token
        },
        method: "delete",
        url: '//' + site_domain + '/' + 'api/colaborador/' + codigo,
        success: function (result) {
            //confirm('Tem certeza que deseja excluir?');
            dataTable.ajax.reload();
        }
    });
}
