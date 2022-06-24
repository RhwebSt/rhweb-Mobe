$(document).ready(function(){
    $('#boletim-tabela-lancamento').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.boletimtabela.lancamento.lista}`,
            type: "get",
        },
        'columns':[
            {'data':'tsnome'},
            {'data':'licodigo'},
            {'data':'lsdescricao'},
            {'data':'lsquantidade'},
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.unitario;
                }
            },
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.total;
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