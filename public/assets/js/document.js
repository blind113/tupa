var dataTable, nomeFuncao = {};
var token = "{{ csrf_token() }}";

$(window).load(function () {
          dataTable = $('#tableDocument').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ],
             "ajax": {
                data: { "_token": token },
                method: "get",
                url: '//' + site_domain + '/' + '/api/colaborador/load',
                dataType: "json"
            },  
                scrollX:    true,
                scrollY:    270,
                //paging:     false,
                ordering:   false,
                //responsive: true,
                //autoWidth: true,
            "columns": [
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.cpf + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.nome + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.sexo + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.data_nasc + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.rg + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.data_expedicao + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.orgao + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.telefone + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.cep + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.uf + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.cidade + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.bairro + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.numero + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.endereco + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.pis + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.serie + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.email + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.empresa + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.sic + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.ct + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.banco + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.agencia + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.op + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.conta + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.funcao + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.beneficios + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.horario + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a style ="pointer-events:none" class="row-link" data-id="' + row.cpf + '">' + row.data_adm + '</a>';
                }
            },
            ]
        });

    /*setInterval(function () {
        dataTable.ajax.reload();
    }, 10000);*/
    /*setInterval(function () {
        Object.keys(nomeFuncao).forEach(function (codigo) {
            $('.row-funcao-' + codigo).text(nomeFuncao[codigo]);
        });
    }, 1000);*/
});