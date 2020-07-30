
$(document).ready(() => {
    if (pesquisaId) {
        $.ajax({
            data: { IDPESQUISA: pesquisaId, "_token": token },
            method: "post",
            url: "//www.ceaterj2.rj.caixa/ceateplansul/distribuicao/public/pesquisaJson",
            success: (result) => {
                let perguntas = JSON.parse(result)
                gera_perguntas(perguntas)
                condicional()
                survey_submit()
            }
        })
    }
})

let gera_perguntas = (perguntas_obj) => {
    let perguntas = perguntas_obj.perguntas; //perguntas vindas do banco
    let pergunta_id = 1; // inicializador de ID
    perguntas.forEach((pergunta) => {
        let pergunta_html = '';
        let pergunta_inputs = '';
        let opcoes = pergunta.opcoes[0];
        let opcoes_item = opcoes.valor.split(';');
        switch (opcoes.tipo) {
            case 'S':
                pergunta_inputs = render_select(opcoes_item, pergunta_inputs, pergunta_id);
                break;
            case 'C':
            case 'R':
                pergunta_inputs = pre_render_checkradio(opcoes, opcoes_item, pergunta_inputs, pergunta_id);
                break;
            case 'A':
                pergunta_inputs = render_textarea()
                break;
            default:
                pergunta_inputs = render_input_text()
                break;
        }
        pergunta_html += render_pergunta(pergunta_id, pergunta, pergunta_inputs)
        $('#perguntas').append(pergunta_html);
        pergunta_id++;
    });
}

let _e = (element, attr, content = '') => {
    let e = '';
    if (content === 'self_closing') {
        e = `<${element} ${attr}/>`;
    } else {
        e = `<${element} ${attr}>
            ${content}
        </${element}>`;
    }
    return e;
}

let _a = attr_obj => {
    let attr = '';
    for (var attr_item in attr_obj) {
        if (typeof attr_obj[attr_item] === 'string') {
            attr += `${attr_item}='${attr_obj[attr_item]}' `;
        } else if (typeof attr_obj[attr_item] === 'object') {
            attr += `class='${attr_obj[attr_item].join(' ')}' `;
        } else {
            attr += `${attr_item}='${attr_obj[attr_item]}' `;
        }
    }
    return attr;
}

let condicional = () => {
    let panelPergunta4 = document.getElementById('panel-pergunta-4');
    let panelPergunta5 = document.getElementById('panel-pergunta-5');
    panelPergunta4.classList.add('hide');
    panelPergunta5.classList.add('hide');
    var radios = document.getElementsByName('pergunta-3');
    for (var i = 0; i < radios.length; i++) {
        radios[i].onclick = function () {
            if (this.value === '1' || this.value === '3') {
                panelPergunta4.classList.add('hide');
                panelPergunta5.classList.remove('hide');
            } else {
                panelPergunta4.classList.remove('hide');
                panelPergunta5.classList.add('hide');
            }
        }
    }
}

let survey_submit = () => {
    let btnSurveySubmit = document.getElementById('btn-survey-submit');
    btnSurveySubmit.onclick = function () {
        var select_pergunta1 = document.getElementsByName('pergunta-1');
        var radios_pergunta2 = document.getElementsByName('pergunta-2');
        var radios_pergunta3 = document.getElementsByName('pergunta-3');
        var radios_pergunta4 = document.getElementsByName('pergunta-4');
        var radios_pergunta5 = document.getElementsByName('pergunta-5');
        let resposta = {};
        resposta.respostas = {};
        resposta.id_pesquisa = pesquisaId;
        for (var i = 0; i < select_pergunta1.length; i++) {
            resposta.respostas.p1 = {}
            resposta.respostas.p1.id = 1
            resposta.respostas.p1.val = select_pergunta1[i].value
            var selected = select_pergunta1[i].options[select_pergunta1[i].selectedIndex];
            resposta.respostas.p1.value = selected.getAttribute('data-value')
        }
        for (var i = 0; i < radios_pergunta2.length; i++) {
            if (radios_pergunta2[i].checked === true) {
                resposta.respostas.p2 = {}
                resposta.respostas.p2.id = 2
                resposta.respostas.p2.val = radios_pergunta2[i].value
                resposta.respostas.p2.value = radios_pergunta2[i].getAttribute('data-value')
            }
        }
        for (var i = 0; i < radios_pergunta3.length; i++) {
            if (radios_pergunta3[i].checked === true) {
                resposta.respostas.p3 = {}
                resposta.respostas.p3.id = 3
                resposta.respostas.p3.val = radios_pergunta3[i].value
                resposta.respostas.p3.value = radios_pergunta3[i].getAttribute('data-value')
                if (radios_pergunta3[i].value === 'option1' || radios_pergunta3[i].value === 'option3') {
                    for (var i = 0; i < radios_pergunta5.length; i++) {
                        if (radios_pergunta5[i].checked === true) {
                            resposta.respostas.p5 = {}
                            resposta.respostas.p5.id = 5
                            resposta.respostas.p5.val = radios_pergunta5[i].value
                            resposta.respostas.p5.value = radios_pergunta5[i].getAttribute('data-value')
                        }
                    }
                } else {
                    for (var i = 0; i < radios_pergunta4.length; i++) {
                        if (radios_pergunta4[i].checked === true) {
                            resposta.respostas.p4 = {}
                            resposta.respostas.p4.id = 4
                            resposta.respostas.p4.val = radios_pergunta4[i].value
                            resposta.respostas.p4.value = radios_pergunta4[i].getAttribute('data-value')
                        }
                    }
                }
            }
        }
        $.ajax({
            data: { RESPOSTAS: resposta, "_token": token },
            method: "post",
            url: "//www.ceaterj2.rj.caixa/ceateplansul/distribuicao/public/respostaPesquisaJson",
            success: (result) => {
                btnSurveySubmit.classList.add('hide')
                window.location.href = "/ceateplansul/distribuicao/public/pesquisa-sucesso"
            }
        })
    }
}

let render_input_text = () => {
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

let render_textarea = () => {
    return_e(
        'textarea',
        _a({
            class: ['form-control'],
            row: '3'
        }),
    );
}

let render_select = (opcoes_item, pergunta_inputs, pergunta_id) => {
    let pergunta_option_id = 1;
    let pergunta_option = '';
    opcoes_item.forEach((option) => {
        pergunta_option += _e(
            'option',
            _a({
                value: pergunta_option_id,
                'data-value': option
            }),
            option
        );
        pergunta_option_id++;
    });
    pergunta_inputs += _e(
        'select',
        _a({
            class: ['form-control'],
            name: `pergunta-${pergunta_id}`
        }),
        pergunta_option
    );
    return pergunta_inputs
}

let pre_render_checkradio = (opcoes, opcoes_item, pergunta_inputs, pergunta_id) => {
    let field_type = 'radio';
    if (opcoes.tipo === 'C') field_type = 'checkbox';
    let pergunta_option_id = 1;
    opcoes_item.forEach(
        (option) => {
            pergunta_inputs = render_checkradio(field_type, pergunta_inputs, pergunta_id, pergunta_option_id, option)
            pergunta_option_id++;
        }
    );
    return pergunta_inputs
}

let render_checkradio = (field_type, pergunta_inputs, pergunta_id, pergunta_option_id, option) => {
    pergunta_inputs += _e(
        'div',
        `class="${field_type}"`,
        _e(
            'label',
            '',
            _e(
                'input',
                _a({
                    type: field_type,
                    name: `pergunta-${pergunta_id}`,
                    id: `pergunta-${pergunta_id}-${pergunta_option_id}`,
                    class: [
                        `pergunta-option-${pergunta_id}`
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

let render_panel_heading = (pergunta) => {
    return _e(
        'div',
        'class="panel-heading"',
        _e(
            'h3',
            'class="panel-title"',
            _e(
                'span',
                _a({ class: ['num-pergunta'] }),
                //`${pergunta_id}.`
            )
            +
            pergunta.descricao
        )
    )
}

let render_panel_body = (pergunta_inputs) => {
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
let render_pergunta = (pergunta_id, pergunta, pergunta_inputs) => {
    return _e(
        'div',
        _a({
            id: `panel-pergunta-${pergunta_id}`,
            class: [
                'panel',
                'panel-default',
                `panel-pergunta-${pergunta_id}`
            ]
        }),
        render_panel_heading(pergunta)
        +
        render_panel_body(pergunta_inputs)
    )
}