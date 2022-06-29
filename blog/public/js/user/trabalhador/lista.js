$('#trabalhador-lista').DataTable({
    processing:true,
    serverSide:true,
    searchable: false,
    orderable: false,
    'ajax':{
        url:`${window.Laravel.trabalhador.lista}`,
        type: "get",
        
    },
    'columns':[
        {'data':'tsmatricula'},
        {'data':'tsnome'},
        {'data':'tscpf'},
        {
        'data':'id',
            render:function (data, type, row) {
                return row.id.depedente;
            }
        },
        {
        'data':'id',
            render:function (data, type, row) {
                return row.id.relatorio;
            }
        },
        {
        'data':'id',
            render:function (data, type, row) {
                evento_trabalhador()
                return row.id.evento;
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
        },
    ],
    
    'columnDefs': [
                {className: "limitaCarcteres", targets: [0,1,2]},
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
function evento_trabalhador() {
    let nome = 'S2300';
    $(".btn__padrao--evento").click(function() {
        let id = $(this).attr('data-id')
        Swal.fire({
            title: '<strong>Evento baixado com sucesso</strong>',
            icon: 'success',
            html: '<div class="progress mb-3" style="height: 12px;">' +
            '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
            '</div>' +
            '<p id="msg">Deseja Integrar esse arquivo com o E-SOCIAL?</p>',
            input: 'file',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            showConfirmButton: true,
            confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
            confirmButtonColor: '#04888B',
            allowOutsideClick: false,
            allowEscapeKey: false,
            preConfirm: (event) => {
            if (event) {
                var ext = ['text']
                var type = event.type.split('/')
                if (event.name.includes(nome) === false) {
                    $('#msg').text(`O txt passado não tem o evento correto. ${nome}`).addClass('text-danger')
                    $('#progress').text('0%').css({"width": "0%"}).removeClass('bg-success').addClass('bg-dange');
                    return false;
                }else if(ext.indexOf(type[0]) === -1){
                    $('#msg').text('Não em um arquivo txt.').addClass('text-danger')
                    $('#progress').text('0%').css({"width": "0%"}).removeClass('bg-success').addClass('bg-dange');
                    return false;
                }else{
                    $('#msg').text('Evento sendo enviado para SEFAZ.').removeClass('text-danger').addClass('text-black');
                    $('#progress').text('25%').css({"width": "25%"}).removeClass('bg-dange').addClass('bg-success');
                    var myFormData = new FormData();
                    myFormData.append('file', event);
                    gerarxml(myFormData,id,nome)
                }  
            }
            return false;
            }
        })
    })
}
setInterval(() => {
    evento_trabalhador()
}, 1000);
function gerarxml_trabalhador(dados,trabalhador,nome){

    $.ajax({
        url: "https://api.tecnospeed.com.br/esocial/v1/evento/gerar/xml",
        type: "POST",
        data: dados,
        // dataType: 'json',
        processData: false,  
        // async:false,
        headers: {
            'content-type':'text/tx2',
            'cnpj_sh':'34350915000149',
            'token_sh':'3048136792bc6c57aecab949f3f79b74',
            'empregador':'26844068000140'
        },
        success: function(retorno){
            $('#msg').text('Lote Recebido com Sucesso.')
            $('#progress').text('50%').css({"width": "50%"});
            cadastra_tomador(retorno.data,trabalhador,nome)
            // setTimeout(consultaevento(retorno.data.id,trabalhador), 100000);
        },
        error: function () {
            $('#msg').text('Não foi porssivél realizar o processo');
            $('#progress').text('0%').css({"width": "0%"});
        },
     });
}
function cadastra_trabalhador(dados,id,nome) {
    $.ajax({
        url: `${window.Laravel.esocial.update}/${id}`,
        type: "PUT",
        data: {
            evento:nome,
            id:dados.id,
            codigo:dados.status_envio.codigo,
            status:dados.status_envio.mensagem
        },
        // dataType: 'json',
        // processData: false,  
        // async:false,
        headers: {
            'X-CSRF-TOKEN': window.Laravel.csrf
            // 'content-type':'text/tx2',
            // 'cnpj_sh':'34350915000149',
            // 'token_sh':'3048136792bc6c57aecab949f3f79b74',
            // 'empregador':'34350915000149'
        },
        success: function(retorno){
            // console.log(retorno);
            $('#progress').text('100%').css({"width": "100%"});
            $('#msg').text(retorno)
            // console.log(trabalhador);
            // buscaxml(retorno.data.eventos[0])
        }
     });
}