var dataTable, nomeFuncao = {};
//var token = "{{ csrf_token() }}";

$(window).load(function () {
          dataTable = $('#tablePreCP').DataTable({
             "ajax": {
                data: { "_token": token },
                method: "get",
                url: '//' + site_domain + '/' + 'api/colaborador/teste',
                dataType: "json"
            },  
                order: [[1,'asc']], 
             "columnDefs":[
                { "orderable": false, "targets": 3},
                { "orderable": false, "targets": 4},
                { "orderable": false, "targets": 5}
             ],   

            "columns": [
            {
                mRender: function (data, type, row) {
                    return '<a class="row-link" data-id="' + row.cpf + '">' + row.cpf + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a class="row-link" data-id="' + row.cpf + '">' + row.nome + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    //ajaxLerFuncao(row.funcao);
                    return '<a style ="pointer-events:none" class="row-funcao-" data-id="' + row.cpf + '">' + row.descricao + '</a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a class="table-edit" data-id="' + row.cpf + '"> <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="EDITAR"></span></a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a class="table-print" data-id="' + row.cpf + '"> <span class="glyphicon glyphicon glyphicon-print" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="IMPRIMIR"></span></a>';
                }
            },
            {
                mRender: function (data, type, row) {
                    return '<a class="table-delete" data-id="' + row.cpf + '"> <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="DELETAR"></span></a>';
                }
            }
            ]
        });

    $('#tablePreCP').on('click', '.table-edit', function () {
        var dataId = $(this).attr('data-id');
        var url = '//' + site_domain + '/' + 'colaborador/editar/' + dataId;
        window.location.href = url;
    });

    $('#tablePreCP').on('click', '.row-link', function () {
        var dataId = $(this).attr('data-id');
        var url = '//' + site_domain + '/' + 'colaborador/ver/' + dataId;
        window.location.href = url;
    });

    $('#tablePreCP').on('click', '.table-print', function () {
        var dataId = $(this).attr('data-id');
        var url = '//' + site_domain + '/' + 'colaborador/imprimir/' + dataId;
        window.location.href = url;
    });

    $('#tablePreCP').on('click', '.table-delete', function () {
        var result = confirm("Tem certeza que deseja excluir?");
        if (result){
        var dataId = $(this).attr('data-id');
        }
        ajaxApagarColaborador(dataId);
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