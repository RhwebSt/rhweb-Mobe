$(document).ready(function(){
    $('#boletim-tabela').DataTable({
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.boletimtabela.lista}`,
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
// function filtro(){
//     var campoFiltro = document.querySelector("#campoFiltro");
    
//     campoFiltro.addEventListener('input', function(){
//       var descricoes = document.querySelectorAll(".filtro");
        
//         if (this.value.length > 0) {
//             for(i = 0; i < descricoes.length; i++){
//                 var descricao = descricoes[i];
//                 var tdnome = descricao.querySelector(".texto");
//                 var nome = tdnome.textContent
//                 var expressao = new RegExp(this.value, "i");
//                 if (!expressao.test(nome)) {
//                     descricao.classList.add("invisivel");
//                 } else {
//                     descricao.classList.remove("invisivel");
//                 }
//                 console.log(nome);
//             }
//         }else{
//             for(i = 0; i < descricoes.length; i++){
//                 var descricao = descricoes[i];
//                 descricao.classList.remove("invisivel");
//             }
//         }
        
//     });
//     }
    
//     filtro();
    