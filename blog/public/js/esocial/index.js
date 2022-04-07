$(document).ready(function(){
    $('.btn__padrao--evento').click(function () {
        let trabalhador = $(this).attr('data-id')
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
                if (ext.indexOf(type[0]) !== -1) {
                    $('#msg').text('Evento sendo enviado para SEFAZ.')
                    $('#progress').text('25%').css({"width": "25%"});
                    var myFormData = new FormData();
                    myFormData.append('file', event);
                    gerarxml(myFormData,trabalhador)
                }  
            }
            return false;
            }
        })
    })
        
    function gerarxml(dados,trabalhador){

        $.ajax({
            url: "https://api.tecnospeed.com.br/esocial/v1/evento/enviar/tx2",
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
                setTimeout(consultaevento(retorno.data.id,trabalhador), 100000);
            }
         });
    }
    function consultaevento(id,trabalhador) {
        $.ajax({
            url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/${id}?ambiente=2&versaomanual=2.5.00`,
            type: "GET",
            // data: dados,
            // dataType: 'json',
            processData: false,  
            // async:false,
            headers: {
                // 'content-type':'text/tx2',
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':'34350915000149'
            },
            success: function(retorno){
                console.log(retorno);
                $('#progress').text('75%').css({"width": "75%"});
                $('#msg').text('Cadastrando no banco.')
                cadastra(retorno.data,trabalhador)
                // buscaxml(retorno.data.eventos[0])
            }
         });
    }
    function cadastra(dados,id) {
        $.ajax({
            url: `${window.location.href}/esocial/${id}`,
            type: "PUT",
            data: {
                id:dados.id,
                codigo:dados.status_envio.codigo,
                status:dados.status_envio.mensagem
            },
            // dataType: 'json',
            // processData: false,  
            // async:false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // 'content-type':'text/tx2',
                // 'cnpj_sh':'34350915000149',
                // 'token_sh':'3048136792bc6c57aecab949f3f79b74',
                // 'empregador':'34350915000149'
            },
            success: function(retorno){
                console.log(retorno);
                $('#progress').text('100%').css({"width": "100%"});
                $('#msg').text(retorno)
                // console.log(trabalhador);
                // buscaxml(retorno.data.eventos[0])
            }
         });
    }
    function buscaxml(id) {
        $.ajax({
            url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/idevento/${id}?ambiente=2&empregador=34350915000149`,
            type: "GET",
            // data: dados,
            // dataType: 'json',
            processData: false,  
            headers: {
                // 'content-type':'text/tx2',
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':'26844068000140'
            },
           
            success: function(retorno){
                console.log(retorno);
                enviaxml(retorno.data);
            }
        });
    }
    function enviaxml(dados) {
        console.log($.parseXML(dados.xml));
        var formData = new FormData();
        formData.append('versaomanual','2.5.00')
        formData.append('empregador',dados.cnpj_sh)
        formData.append('ambiente','2')
        formData.append('inscricao',dados.cnpj_sh)
        formData.append('idgrupoeventos',dados.id)
        formData.append('xml',$.parseXML(dados.xml))
        $.ajax({
            url: "https://api.tecnospeed.com.br/esocial/v1/evento/enviar",
            type: "POST",
            data: formData,
            // dataType: 'json',
            processData: false,  
            headers: {
                'content-type':'text/xml',
                'cnpj_sh':dados.cnpj_sh,
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':dados.cnpj_sh,
            },
            success: function(retorno){
                console.log(retorno);
            }
        });
    }
})