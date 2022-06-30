$(document).ready(function(){
    $( "#form-certificado" ).submit(function( event ) {
        event.preventDefault();
        var form = new FormData();
        form.append("certificado", $('#certificado').prop('files')[0], "/path/to/file");
        form.append( 'cpfCnpjEmpregador',$('#cnpjEmpregador').val());
        form.append( 'razaoSocial',$('#razaoSocial').val());
        form.append("senha", $('#senhaCertificado').val());
        form.append("email", $('#emailResponsavel').val());
        form.append("apelido",  $('#apelidoCertificado').val());
            $.ajax({
            url: "https://api.tecnospeed.com.br/esocial/v1/certificados",
            method: "POST",
            mimeType: "multipart/form-data",
            "contentType": false,
            dataType: "json",
            "data": form,
            processData: false,  
            headers: {
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':'34350915000149'
            },
            success: function(retorno){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: `<p class="modal__aviso">${retorno.message}</p>`,
                    background: '#45484A',
                    showConfirmButton: true,
                });
                console.log(retorno.data.data);
                cadastra(retorno.data.data)
            },
            error: function (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html:`<p class="modal__aviso">${response.responseJSON.error.message}</p>`,
                    background: '#45484A',
                    showConfirmButton: true,
        
                });
               
            },
            });
    });
    function cadastra(dados) {
        $.ajax({
            url: `${window.Laravel.certificado.cadastro}`,
            method: "POST",
            data:dados,
            // data:{
            //     apelido:dados.apelido,
            //     diasVencimento:dados.diasVencimento,
            //     dtVencimento:dados.dtVencimento,
            //     email:dados.email,
            //     handle:dados.handle,
            //     nome:dados.nome,
            //     senha:dados.senha,
            // },
            // dataType: 'json',
            // processData: false,  
            // async:false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrf
                // 'content-type':'text/tx2',
                // 'cnpj_sh':'34350915000149',
                // 'token_sh':'3048136792bc6c57aecab949f3f79b74',
                // 'empregador':'26844068000140'
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
})