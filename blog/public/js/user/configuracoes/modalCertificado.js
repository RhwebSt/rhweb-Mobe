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
        // if (!verificar()) {
        //     Swal.fire({
        //         position: 'center',
        //         icon: 'error',
        //         html:`<p class="modal__aviso">Seu certificado esta expirado</p>`,
        //         background: '#45484A',
        //         showConfirmButton: true,
    
        //     });
        // }else{
    
        // }
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    html: `<p class="modal__aviso">${retorno.message}</p>`,
                    background: '#45484A',
                    showConfirmButton: true,
                });
                // cadastra(retorno.data.data)
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
   
    function cadastra(dados) {
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
})