$(document).ready(function(){
    $('#tabelapreco-lista').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.tabelapreco.lista}`,
            type: "get",
        },
        'columns':[
            {'data':'tsano'},
            {'data':'tsrubrica'},
            {'data':'tsdescricao'},
            {'data':'tsvalor'},
            {'data':'tstomvalor'},
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.editar;
                }
            },
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.excluir;
                }
            },
        ],
        "language": {
            "infoEmpty": "mostrando",
            "search":         "Pesquisar",
            "info":           "Mostrando _START_ de _END_ registros",
            "infoFiltered":   "",
            "zeroRecords":    "Não há nenhum registro cadastrado <i class='fad fa-exclamation-triangle fa-lg' style='color: red !important;'>",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "emptyTable":     "Não há dados disponíveis na tabela",
            "loadingRecords": "Carregando...",
            "paginate": {
                "first":      "Primeira",
                "last":       "Última",
                "next":       "Próxima",
                "previous":   "Anterior"
            },
        }
    })
})