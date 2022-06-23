$(document).ready(function(){
    $('#table-calculo-folhar').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.folhar.geral}`,
            type: "get",
            
        },
        'columns':[
            {'data':'fscodigo'},
            {'data':'fsinicio',
                render:function (data, type, row) {
                    data = data.split('T')
                    return data[0].split('-').reverse().join('/');
                }
            },
            {'data':'fsfinal',
                render:function (data, type, row) {
                    data = data.split('T')
                    return data[0].split('-').reverse().join('/');
                }
            },
            {
                'data':'id',
                render:function (data, type, row) {
                    return row.id.imprimim;
                }
            },
            {
                'data':'id',
                render:function (data, type, row) {
                    return row.id.evento;
                }
            },
            {
                'data':'id',
                render:function (data, type, row) {
                    return row.id.recibo;
                }
            },
            {
                'data':'id',
                render:function (data, type, row) {
                    return row.id.rublicas;
                }
            },
            {
                'data':'id',
                render:function (data, type, row) {
                    return row.id.banco;
                }
            },
            {
                'data':'id',
                render:function (data, type, row) {
                    return row.id.analitica;
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
    $('#table-calculo-folhar-tomador').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.folhar.tomador}`,
            type: "get",
            
        },
        'columns':[
            {'data':'fscodigo'},
            {'data':'tsnome'},
            {'data':'fsinicio',
                render:function (data, type, row) {
                    data = data.split('T')
                    return data[0].split('-').reverse().join('/');
                }
            },
            {'data':'fsfinal',
                render:function (data, type, row) {
                    data = data.split('T')
                    return data[0].split('-').reverse().join('/');
                }
            },
            {
                'data':'tomador_id',
                render:function (data, type, row) {
                    return row.tomador_id.relatorio;
                }
            },
            {
                'data':'tomador_id',
                render:function (data, type, row) {
                    return row.tomador_id.imprimim;
                }
            },
           
            {
                'data':'tomador_id',
                render:function (data, type, row) {
                    return row.tomador_id.recibo;
                }
            },
           
            {
                'data':'tomador_id',
                render:function (data, type, row) {
                    return row.tomador_id.analitica;
                }
            },
            {
                'data':'tomador_id',
                render:function (data, type, row) {
                    return row.tomador_id.sefip;
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