$(document).ready(function(){
    $('#table-desconto').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.desconto.lista}`,
            type: "get",
        },
        'columns':[
            {'data':'tsmatricula'},
            {'data':'tsnome'},
            {'data':'dsdescricao'},
            {'data':'dsquinzena'},
            {'data':'dscompetencia',
                render:function (data, type, row) {
                    return data.split('-').reverse().join('/');
                }
            },
            {'data':'dfvalor'},
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.relatorio;
                }
            },
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
            }
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