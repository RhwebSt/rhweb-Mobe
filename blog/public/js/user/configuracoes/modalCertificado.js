$('#proximoCertificado').click((e)=> {
    e.preventDefault();
    $('#form-certificado').removeClass('d-none');
    $('#form-CadEmpresaCertificado').addClass('d-none');
});

$('#botaoVoltarCertificado').click((e)=>{
    e.preventDefault();
    $('#form-certificado').addClass('d-none');
    $('#form-CadEmpresaCertificado').removeClass('d-none');
})


$(document).ready(function(){
    $( "#form-certificado" ).submit(function( event ) {
        event.preventDefault();
        var empresa = new FormData();
        empresa.append('empregador',$('#cadCnpjEmpregador').val());
        empresa.append('razaosocial',$('#cadRazaoSocial').val());
        empresa.append('email',$('#cadEmailResponsavel').val());
        empresa.append('telefone',$('#telefoneResponsavel').val());
        empresa.append('logradouro',$('#Logradouro').val());
        empresa.append('numero',$('#numero').val());
        empresa.append('complemento',$('#complemento').val());
        empresa.append('bairro',$('#bairro').val());
        empresa.append('cep',$('#cep').val());
        empresa.append('codigoibge',$('#codIbge').val());
        empresa.append('uf',$('#uf').val());
        Swal.fire({
            // title: '<strong>Evento baixado com sucesso</strong>',
            // icon: 'success',
            html: '<div class="progress mb-3" style="height: 12px;">' +
            '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
            '</div>' +
            '<p id="msg">Cadastrando empregado na Tecnospeed?</p>',

        })
             $.ajax({
            url: "https://api.tecnospeed.com.br/esocial/v1/empregadores",
            method: "POST",
            mimeType: "multipart/form-data",
            contentType: false,
            dataType: "json",
            data: empresa,
            processData: false,  
            headers: {
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                // 'empregador':`${window.Laravel.empresa.cnpj}`
            },
            success: function(retorno){
                $('#progress').text('25%').css({"width": "25%"});
                $('#msg').text(retorno.data.message)
                certificador()
            },
            error: function (response) {
                $('#progress').text('25%').css({"width": "25%"});
                $('#msg').text(response.responseJSON.error.message)
                certificador()
            },
            });
       
      
    });
   
    $( "#deleta-certificado" ).submit(function( event ) {
        event.preventDefault();
        let id = $('#cnpj').val();
        $.ajax({
            url: `${window.Laravel.empresa.lista}/${id}`,
            method: "get",
            dataType: 'json',
            async:false,
            success: function(retorno){
                deleta(retorno,id)
            },
            error: function () {
                
            },
        });
       
    })
    $('#cadCnpjEmpregador').on('change',function () {
        let dados = $(this).val();
        dados = dados.replace(/\D/g, '');
        $.ajax({
            url: "https://brasilapi.com.br/api/cnpj/v1/"+dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
               
                if (data) {
                    $('#cadRazaoSocial').val(data.razao_social)
                    $('#cadEmailResponsavel').val(data.email)
                    $('#telefoneResponsavel').val(data.ddd_telefone_1)
                    $('#codIbge').val(data.codigo_municipio_ibge)
                    $('#cep').val(data.cep)
                    $('#cadCnpjEmpregador').val(data.cnpj.replace(/\D/g, ''));
                    $('#Logradouro').val(data.logradouro)
                    $('#numero').val(data.numero)
                    $('#bairro').val(data.bairro)
                    $('#localidade').val(data.municipio)
                    $('#uf').val(data.uf)
                    $('#complemento').val(data.complemento)
                }else{
                    $('#cadRazaoSocial').val('')
                    $('#cadEmailResponsavel').val('')
                    $('#telefoneResponsavel').val('')
                    $('#codIbge').val('')
                    $('#cep').val('')
                    $('#cadCnpjEmpregador').val('');
                    $('#Logradouro').val('')
                    $('#numero').val('')
                    $('#bairro').val('')
                    $('#localidade').val('')
                    $('#uf').val('')
                    $('#complemento').val('')
                }
                // $("#pesquisa").removeClass('is-invalid')
                
                // $('#mensagem-pesquisa').text(' ').addClass('valid-feedback',).removeClass('invalid-feedback')
            },
            error: function(data){
                // $("#pesquisa").addClass('is-invalid')
                // $('#nome__completo').val(' ')
                // $('#nome__fantasia').val('')
                // $('#cnpj').val('')
                // $('#telefone').val(' ')
                // $('#cnae').val(' ')
                // $('#mensagem-pesquisa').text( data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
                    // $('#nome__completo').val(' ')
                    // $('#nome__fantasia').val(' ')
                    // $('#telefone').val(' ')
                    // $('#cnae').val(' ')
                    // $('#cep').val(' ')
                    // // $('#cnpj').val(' ')
                    // $('#logradouro').val(' ')
                    // $('#numero').val(' ')
                    // $('#bairro').val(' ')
                    // $('#localidade').val(' ')
                    // $('#uf').val(' ')
                    // $('#telefone').val(' ')
                    // $('#complemento').val(' ')
            }
        })
    })
    function certificadorvinculo() {
        $('#progress').text('25%').css({"width": "25%"});
        $('#msg').text('')
        var form = new FormData();
        form.append("certificado", $('#certificado').prop('files')[0], "/path/to/file");
        form.append( 'cpfCnpjEmpregador',$('#cnpjEmpregador').val());
        form.append( 'razaoSocial',$('#razaoSocial').val());
        form.append("senha", $('#senhaCertificado').val());
        form.append("email", $('#emailResponsavel').val());
        form.append("apelido",  $('#apelidoCertificado').val());
            $.ajax({
            url: `https://api.tecnospeed.com.br/esocial/v1/empregadores/${$('#cadCnpjEmpregador').val()}/certificado`,
            method: "POST",
            mimeType: "multipart/form-data",
            contentType: false,
            dataType: "json",
            data: form,
            processData: false,  
            headers: {
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':`${window.Laravel.empresa.cnpj}`
            },
            success: function(retorno){
                // Swal.fire({
                //     position: 'center',
                //     icon: 'success',
                //     html: `<p class="modal__aviso">${retorno.message}</p>`,
                //     background: '#45484A',
                //     showConfirmButton: true,
                // });
                // cadastra(retorno.data.data)
            },
            error: function (response) {
                certificador()
                // Swal.fire({
                //     position: 'center',
                //     icon: 'error',
                //     html:`<p class="modal__aviso">${response.responseJSON.error.message}</p>`,
                //     background: '#45484A',
                //     showConfirmButton: true,
        
                // });
               
            },
        });
    }
    function certificador() {
         if (!verificar()) {
            $('#progress').text('50%').css({"width": "50%"});
            $('#msg').text('Seu certificado esta expirado')
        }else{
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
                contentType: false,
                dataType: "json",
                data: form,
                processData: false,  
                headers: {
                    'cnpj_sh':'34350915000149',
                    'token_sh':'3048136792bc6c57aecab949f3f79b74',
                    'empregador':`${window.Laravel.empresa.cnpj}`
                },
                success: function(retorno){
                
                    $('#progress').text('50%').css({"width": "50%"});
                    $('#msg').text(retorno.message)
                    cadastra(retorno.data)
                },
                error: function (response) {
                    
                    $('#progress').text('75%').css({"width": "75%"});
                    $('#msg').text(response.responseJSON.error.message)
                },
            });
        }
    }
    function cadastra(dados) {
        $('#progress').text('75%').css({"width": "75%"});
        $('#msg').text('Cadastra o certificador no banco de dados')
        $.ajax({
            url: `${window.Laravel.certificado.cadastro}`,
            method: "POST",
            data:dados,
            
            dataType: 'json',
            // processData: false,  
            // async:false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrf
              
            },
            success: function(retorno){
                situacao()
                vincular (dados)
                $('#progress').text('75%').css({"width": "75%"});
                $('#msg').text(retorno.message)
            },
            error: function () {
              
            },
        });
    }
    function situacao() {
        let id = $('#cnpj').val();
        $.ajax({
            url: `${window.Laravel.certificado.situacao}/${id}`,
            method: "get",
            dataType: 'json',
            // async:false,
            success: function(retorno){
                if (retorno.status) {
                    $('#situacao-certificado span').remove();
                    $('#situacao-certificado').append(`<span class="badge bg-warning text-dark">${retorno.mensagem}</span>`)
                }else{
                    $('#situacao-certificado span').remove();
                    $('#situacao-certificado').append(`<span class="badge bg-danger">${retorno.mensagem}</span>`)
                }
            },
            error: function () {
                
            },
        });
    }
    situacao()
    function vincular (dados) {
        $('#progress').text('75%').css({"width": "75%"});
        $('#msg').text('Viculando o empregador ao certificado')
        var form = new FormData();
        form.append( 'cpfCnpjEmpregador',$('#cnpjEmpregador').val());
        $.ajax({
            url: `https://api.tecnospeed.com.br/esocial/v1/certificados/${dados.handle}`,
            method: "POST",
            mimeType: "multipart/form-data",
            contentType: false,
            dataType: "json",
            data: form,
            processData: false,  
            headers: {
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':`${window.Laravel.empresa.cnpj}`
            },
            success: function(retorno){
                $('#progress').text('100%').css({"width": "100%"});
                $('#msg').text(retorno.message)
            },
            error: function (response) {
                $('#progress').text('100%').css({"width": "100%"});
                $('#msg').text('Certificado digital não vinculado.') 
            },
        });
    }
    function deleta(dados,id) {
        let cnpj = dados.escnpj.replace(/[^\w\s]/gi, '')
        $.ajax({
            url: `https://api.tecnospeed.com.br/esocial/v1/empregadores/${cnpj}/certificado/`,
            method: "DELETE",
            headers: {
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':`${window.Laravel.empresa.cnpj}`
            },
            success: function(retorno){
                deleter(id)
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: `<p class="modal__aviso">${retorno.mensagem}</p>`,
                    background: '#45484A',
                    showConfirmButton: true,
                });
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
    }
    function deleter(id) {
        $.ajax({
            url: `${window.Laravel.certificado.deletar}/${id}`,
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrf
            },
            success: function(retorno){
                situacao()
            },
            error: function () {
               
            },
        });
    }

    function verificar() {
        let resultado = '';
        $.ajax({
            url: `${window.Laravel.certificado.verifica}`,
            method: "get",
            dataType: 'json',
            async:false,
            success: function(retorno){
                resultado = retorno;
            },
            error: function () {
                
            },
        });
        return resultado;
    }
})