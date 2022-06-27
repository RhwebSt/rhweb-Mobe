$(document).ready(function(){
    $('#boletim-cartao-ponto').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.boletimcartaoponto.lista}`,
            type: "get",
        },
        'columns':[
            {'data':'liboletim'},
            {'data':'tsnome'},
            {'data':'lsdata',
                render:function (data, type, row) {
                    data = data.split('T')
                    return data[0].split('-').reverse().join('/');
                }
            },
            {'data':'lsnumero'},
            {'data':'lsferiado'},
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.relatorio;
                }
            },
            {
            'data':'id',
                render:function (data, type, row) {
                    return row.id.visualizar;
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