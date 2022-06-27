$(document).ready(function(){
    $('#table-lista-diurno').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.boletimcartaoponto.lancamento.diurno}`,
            type: "get",
        },
        'columns':[
            {'data':'tsmatricula'},
            {'data':'tsnome'},
            {'data':'bsentradamanhao'},
            {'data':'bssaidamanhao'},
            {'data':'bsentradatarde'},
            {'data':'bssaidatarde'},
            {'data':'bshoraex'},
            {'data':'bshoraexcem'},
            {'data':'horas_normais'},
            {'data':'bstotal'},
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
    $('#table-lista-noturno').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.boletimcartaoponto.lancamento.noturno}`,
            type: "get",
        },
        'columns':[
            {'data':'tsmatricula'},
            {'data':'tsnome'},
            {'data':'bsentradanoite'},
            {'data':'bssaidanoite'},
            {'data':'bsentradamadrugada'},
            {'data':'bssaidamadrugada'},
            {'data':'bshoraex'},
            {'data':'bshoraexcem'},
            {'data':'horas_normais'},
            {'data':'bstotal'},
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