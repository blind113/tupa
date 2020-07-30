let site_domain = 'www.ceaterj2.rj.caixa'
let project_path = 'ceateplansul/distribuicao/public'

$(document).ready(function () {
    if (typeof pesquisaId !== 'undefined') {
        if (typeof pesquisaIdCliente !== 'undefined') {
            ajax_pesquisaClienteJson(pesquisaId, pesquisaIdCliente)
        } else {
            ajax_pesquisaJson(pesquisaId)
        }
    }
})

let ajax_pesquisaClienteJson = function (pesquisaId, pesquisaIdCliente) {
    $.ajax({
        data: {
            IDPESQUISA: pesquisaId,
            IDCLIENTE: pesquisaIdCliente,
            "_token": token
        },
        method: "post",
        url: '//'+site_domain+'/'+project_path+'/pesquisaClienteJson',
        success: function (result) {
            let perguntas = JSON.parse(result)
            if (perguntas.status === 'end') {
                $('#cliente').append('Essa pesquisa foi terminada.');
            } else {
                gera_perguntas(perguntas)
                condicional()
                let rendered_cliente = '';
                rendered_cliente = render_cliente(perguntas.cliente)
                render_nomeCliente(perguntas.cliente)
                //$('#cliente').append(rendered_cliente);
                $('.func-name').text(perguntas.funcName);
                survey_submit()
                setStatusChamada(pesquisaId, perguntas.cliente.id)
                getResposta() //@TODO para limpar o spaghetti code  que está dentro survey_submit
            }
        }
    })
}

let ajax_pesquisaJson = function (pesquisaId) {
    $.ajax({
        data: { IDPESQUISA: pesquisaId, "_token": token },
        method: "post",
        url: '//'+site_domain+'/'+project_path+'/pesquisaJson',
        success: function (result) {
            let perguntas = JSON.parse(result)
            if (perguntas.status === 'end') {
                $('#cliente').append('Essa pesquisa foi terminada.');
            } else {
                gera_perguntas(perguntas)
                condicional()
                let rendered_cliente = '';
                rendered_cliente = render_cliente(perguntas.cliente)
                render_nomeCliente(perguntas.cliente)
                $('#cliente').append(rendered_cliente);
                $('.func-name').text(perguntas.funcName);
                survey_submit()
                setStatusChamada(pesquisaId, perguntas.cliente.id)
                getResposta() //@TODO para limpar o spaghetti code  que está dentro survey_submit
            }
        }
    })
}

let setStatusChamada = function (idPesquisa, idCliente) {
    let btnGetStatusChamada = document.getElementById('btn-get-status-chamada');
    btnGetStatusChamada.onclick = function () {
        let selectStatusChamada = document.getElementById('select-status-chamada');
        saidaStatusChamda = {
            idPesquisa: idPesquisa,
            idCliente: idCliente,
            matricula: matricula,
            status: selectStatusChamada.value
        }
        if (selectStatusChamada.value != 'not_selected') {
            ajax_setStatusChamada(saidaStatusChamda)
        } else {
            alert('Por favor, selecione um status da chamda')
        }
    }
}

let ajax_setStatusChamada = function (saidaStatusChamda) {
    $.ajax({
        data: {
            STATUSCHAMADA: saidaStatusChamda,
            "_token": token
        },
        method: 'post',
        url: '//'+site_domain+'/'+project_path+'/setStatusChamada',
        success: function (result) {
            if (result !== 'success') {
                window.location.href = '/'+project_path+'/pesquisa/1'
            }
        }
    });
}

let ajax_getStatusChamda = function () {
    $.ajax({
        data: { "_token": token },
        method: 'post',
        url: '//'+site_domain+'/'+project_path+'/getStatusChamada',
        success: function (result) {
            let options_json = JSON.parse(result)
            let options = options_json.map(function (option) {
                return '<option value=' + option.sigla + '>' + option.nome + '</option>'
            }).join(' ')
            $('#select-status-chamada').append(options);
        }
    });
}

let render_nomeCliente = function (cliente) {
    $('.nome-cliente').text(cliente.nome);
}
let render_cliente = function (cliente) {
    ajax_getStatusChamda()
    let data_nasc = '';
    data_nasc = formatDateBR(cliente.data_de_nascimento);
    return _e(
        'h2',
        _a({}),
        cliente.nome
    )
        +
        _e(
            'div',
            _a({ class: ['row'] }),
            _e(
                'div',
                _a({ class: ['col-sm-6'] }),
                _e(
                    'ul',
                    _a({}),
                    _e(
                        'li',
                        _a({}),
                        '<strong>Data de nascimento: </strong>'+data_nasc
                    )
                    +
                    _e(
                        'li',
                        _a({}),
                        '<strong>Telefone 1: </strong>'+cliente.telefone_1
                    )
                    +
                    _e(
                        'li',
                        _a({}),
                        '<strong>Telefone 2: </strong>'+cliente.telefone_2
                    )
                )
            )
            +
            _e(
                'div',
                _a({ class: ['col-sm-6'] }),
                /*
                _e(
                    'button',
                    _a({
                        class: ['btn btn-danger btn-lg'],
                        'data-toggle': "modal",
                        'data-target': "#modalStatusCliente"
                    }),
                    'PROBLEMAS COM O CLIENTE'
                )
                */
                ''
            )
        )
}

let formatDateBR = function (date) {
    let data = new Date(date),
        dia = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0' + dia : dia,
        mes = (data.getMonth() + 1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0' + mes : mes,
        anoF = data.getFullYear();
    return diaF + "/" + mesF + "/" + anoF;
}

let gera_perguntas = function (perguntas_obj) {
    let perguntas = perguntas_obj.perguntas; //perguntas vindas do banco
    let pergunta_html = '';
    pergunta_html = perguntas.map(function (pergunta, index) {
        ++index
        let pergunta_inputs = '';
        let opcoes = pergunta.opcoes[0];
        let opcoes_item = opcoes.valor.split(';');
        switch (opcoes.tipo) {
            case 'S':
                pergunta_inputs = render_select(opcoes_item, index, perguntas_obj.cliente);
                break;
            case 'C':
            case 'R':
                pergunta_inputs = pre_render_checkradio(opcoes, opcoes_item, pergunta_inputs, index);
                break;
            case 'A':
                pergunta_inputs = render_textarea()
                break;
            default:
                pergunta_inputs = render_input_text()
                break;
        }
        return render_pergunta(index, pergunta, pergunta_inputs)
    }).join(' ');

    $('#perguntas').append(pergunta_html);
}

let _e = function (element, attr, content) {
    let e = '';
    if (content === 'self_closing') {
        e = '<' + element+' '+attr+'/>';
    } else {
        e = '<'+element+' '+attr+'>'+content+'</'+element+'>';
    }
    return e;
}

let _a = function (attr_obj) {
    let attr = '';
    for (let attr_item in attr_obj) {
        if (typeof attr_obj[attr_item] === 'string') {
            attr += attr_item+'= "'+attr_obj[attr_item]+'" ';
        } else if (typeof attr_obj[attr_item] === 'object') {
            attr += ' class="'+attr_obj[attr_item].join(' ')+'" ';
        } else {
            attr += attr_item+'= "'+attr_obj[attr_item]+'" ';
        }
    }
    return attr;
}

let condicional = function () {
    $('#panel-pergunta-4').addClass('hide');
    
    $('input[name="pergunta-3"]').each(function() {
        $(this).click(function () {
            if ($(this).val() == '2') {
				$('#panel-pergunta-4').removeClass('hide');
            } else {
				$('#panel-pergunta-4').addClass('hide');
            }
		})
	})
}

let respostas = {};
let getResposta = function () {
    $('.pergunta').each(function(e){
		
		let essa_resposta = setResposta($(this))
			
        essa_resposta_id = essa_resposta.id - 1
        
		if (essa_resposta.id !== undefined) {
            respostas[essa_resposta_id] = essa_resposta
        }
		
        $(this).change(function() {

            //@TODO: criar attr de pergunta condicional para busca comportamento no banco de dados
            if ($(this).attr('name') == 'pergunta-3') {
				
                if ($(this).val() == '1' || $(this).val() == '3') {
                    respostas[3] = {}
                }
            }
            essa_resposta = setResposta($(this))
            essa_resposta_id = essa_resposta.id - 1
            if (essa_resposta.id != undefined) {
                respostas[essa_resposta_id] = essa_resposta
            }
        });
	});
	
    return respostas
}

let setResposta = function (pergunta) {
	
    let perguntaId = pergunta.attr('name').replace('pergunta-', '')
    let perguntaVal = pergunta.val()

	let resposta = {}
    resposta.id = perguntaId
    resposta.val = perguntaVal
    resposta.value = pergunta.attr('data-value')	    
	if(pergunta.is('select')){
		let selected = pergunta.find('option:selected')	
		resposta.value = selected.attr('data-value')
	} else if(pergunta.attr('type') == 'radio'){
		if (!pergunta[0].checked) {
			resposta = {}
		}
	} else {
		resposta = {}
	}
	return resposta
}


let survey_submit = function () {
    let btnSurveySubmit = document.getElementById('btn-survey-submit');
    btnSurveySubmit.onclick = function () {
        let select_pergunta1 = document.getElementsByName('pergunta-1');
        let radios_pergunta2 = document.getElementsByName('pergunta-2');
        let radios_pergunta3 = document.getElementsByName('pergunta-3');
        let radios_pergunta4 = document.getElementsByName('pergunta-4');
        let radios_pergunta5 = document.getElementsByName('pergunta-5');
        let resposta = {};
        resposta.respostas = {};
        resposta.id_pesquisa = pesquisaId;
        for (let i = 0; i < select_pergunta1.length; i++) {
            resposta.respostas.p1 = {}
            resposta.respostas.p1.id = 1
            resposta.respostas.p1.val = select_pergunta1[i].value
            let selected = select_pergunta1[i].options[select_pergunta1[i].selectedIndex];
            resposta.respostas.p1.value = selected.getAttribute('data-value')
        }
        for (let i = 0; i < radios_pergunta2.length; i++) {
            if (radios_pergunta2[i].checked === true) {
                resposta.respostas.p2 = {}
                resposta.respostas.p2.id = 2
                resposta.respostas.p2.val = radios_pergunta2[i].value
                resposta.respostas.p2.value = radios_pergunta2[i].getAttribute('data-value')
            }
        }
        for (let i = 0; i < radios_pergunta3.length; i++) {
            if (radios_pergunta3[i].checked === true) {
                resposta.respostas.p3 = {}
                resposta.respostas.p3.id = 3
                resposta.respostas.p3.val = radios_pergunta3[i].value
                resposta.respostas.p3.value = radios_pergunta3[i].getAttribute('data-value')
                
                if (radios_pergunta3[i].value  != '2') {
                    for (let i = 0; i < radios_pergunta4.length; i++) {
                        if (radios_pergunta5[i].checked === true) {
                            resposta.respostas.p5 = {}
                            resposta.respostas.p5.id = 5
                            resposta.respostas.p5.val = radios_pergunta5[i].value
                            resposta.respostas.p5.value = radios_pergunta5[i].getAttribute('data-value')
                        }
                    }
                } else {
                    for (let i = 0; i < radios_pergunta4.length; i++) {
                        if (radios_pergunta4[i].checked === true) {
                            resposta.respostas.p4 = {}
                            resposta.respostas.p4.id = 4
                            resposta.respostas.p4.val = radios_pergunta4[i].value
                            resposta.respostas.p4.value = radios_pergunta4[i].getAttribute('data-value')
                        }
                    }
                    for (let i = 0; i < radios_pergunta5.length; i++) {
                        if (radios_pergunta5[i].checked === true) {
                            resposta.respostas.p5 = {}
                            resposta.respostas.p5.id = 5
                            resposta.respostas.p5.val = radios_pergunta5[i].value
                            resposta.respostas.p5.value = radios_pergunta5[i].getAttribute('data-value')
                        }
                    }
                }
            }
        }
        ajax_respostaPesquisaJson(resposta, btnSurveySubmit)
    }
}
let ajax_respostaPesquisaJson = function (resposta, btnSurveySubmit) {
    console.log(pesquisaIdCliente)
    $.ajax({
        data: {
            RESPOSTAS: resposta,
            saidaStatusChamda: {
                idPesquisa: pesquisaId,
                idCliente: pesquisaIdCliente,
                matricula: matricula,
                status: 'F'
            },
            "_token": token
        },
        method: "post",
        url: '//'+site_domain+'/'+project_path+'/respostaPesquisaJson',
        success: function(result) {
            /*
			console.log(result)
            btnSurveySubmit.classList.add('hide')
            */
            window.location.href = '/'+project_path+'/pesquisa-sucesso'
        }
    })
}
let render_input_text = function () {
    return _e(
        'input',
        _a({
            type: "text",
            class: "form-control",
            placeholder: ""
        }),
        'self_closing'
    );
}

let render_textarea = function () {
    return_e(
        'textarea',
        _a({
            class: ['form-control'],
            row: '3'
        }),
		''
		);
}

let render_select = function (opcoes_item, pergunta_id, cliente) {
    let pergunta_option = opcoes_item.map(function(option, index) {
        ++index
        let attr = {
            value: index,
            'data-value': option
        }
        if (cliente.grupo == index) attr.selected = true
        return _e('option', _a(attr), option);
    }).join('');
    return _e(
        'select',
        _a({
            class: [
                'pergunta',
                'pergunta-'+pergunta_id,
                'form-control'
            ],
            name: 'pergunta-'+pergunta_id,
            disabled: true
        }),
        pergunta_option
    );
}

let pre_render_checkradio = function (opcoes, opcoes_item, pergunta_inputs, pergunta_id) {
    let field_type = 'radio';
    if (opcoes.tipo === 'C') field_type = 'checkbox';
    return opcoes_item.map(
        function (option, index) {
            return render_checkradio(field_type, pergunta_inputs, pergunta_id, ++index, option)
        }
    ).join(' ');
}

let render_checkradio = function (field_type, pergunta_inputs, pergunta_id, pergunta_option_id, option) {
    pergunta_inputs += _e(
        'div',
        'class="'+field_type+'"',
        _e(
            'label',
            '',
            _e(
                'input',
                _a({
                    type: field_type,
                    name: 'pergunta-'+pergunta_id,
                    id: 'pergunta-'+pergunta_id+'-'+pergunta_option_id,
                    class: [
                        'pergunta',
                        'pergunta-option-'+pergunta_id
                    ],
                    value: pergunta_option_id,
                    'data-value': option,
                }),
                'self_closing'
            )
            +
            option
        )
    );
    return pergunta_inputs
}

let render_panel_heading = function (pergunta) {
    return _e(
        'div',
        'class="panel-heading"',
        _e(
            'h3',
            'class="panel-title"',
            _e(
                'span',
                _a({ class: ['num-pergunta'] }),
                ' '
            )
            +
            pergunta.descricao
        )
    )
}

let render_panel_body = function (pergunta_inputs) {
    return _e(
        'div',
        'class="panel-body"',
        _e(
            'div',
            _a({ class: ['form-group'] }),
            pergunta_inputs
        )
    )
}
let render_pergunta = function (pergunta_id, pergunta, pergunta_inputs) {
    return _e(
        'div',
        _a({
            id: 'panel-pergunta-'+pergunta_id,
            class: [
                'panel',
                'panel-default',
                'panel-pergunta-'+pergunta_id
            ]
        }),
        render_panel_heading(pergunta)
        +
        render_panel_body(pergunta_inputs)
    )
}