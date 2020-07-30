var dataTable;

$(window).load(function() {
    dataTable = $('#tablePreCP').DataTable({
        'paging': true,
        'ordering': false,
        'info': false,
        "serverSide": true,
        'ajax': {
            data: { "_token": token },
            method: "get",
            url: '//' + site_domain + '/' + 'api/' +entidade,
            dataType: "json"
        },
        columns: [
            { data: 'codigo' },
            { data: 'descricao' },
            {
                mRender: function(data, type, row) {
                    return '<a class="table-edit" data-id="' + row.codigo + '"> <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="EDITAR"></span></a>'
                }
            },
            {
                mRender: function(data, type, row) {
                    return '<a class="table-delete" data-id="' + row.codigo + '"> <span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="DELETAR"></span></a>'
                }
            }
        ]
    });

    $('#tablePreCP').on('click', '.table-edit', function() {
        var dataId = $(this).attr('data-id');
        var url = '//' + site_domain + '/' + entidade + '/editar/' + dataId;
        window.location.href = url;

        //ajax_getEntidade(dataId);
    });

    $('#tablePreCP').on('click', '.table-delete', function() {
        //var dataId = $(this).attr('data-id');
        var result = confirm("Tem certeza que deseja excluir?");
        if (result){
        var dataId = $(this).attr('data-id');
        }
        
        ajaxApagarEntidade(dataId);
    });

    setInterval(function() {
        dataTable.ajax.reload();
    }, 30000);

    var setData = {};
    var form = '#frm-' + entidade;
    var form1 = '#frmEdit';

    $(document).on("submit", form, function(event) {
        event.preventDefault();
        var dados = $(form).serializeArray();
        $(dados).each(function(index, obj) {
            setData[obj.name] = obj.value;
        })
        setData.codigo = $('#codigo').val();
        ajaxCriarEntidade(setData);
    });

    $(document).on("submit", form1, function(event) {
        event.preventDefault();
        var dados = $(form1).serializeArray();
        $(dados).each(function(index, obj) {
            setData[obj.name] = obj.value;
        })
        setData.codigo = $('#codigo').val();
        ajaxAtualizarEntidade(setData);
    });

});