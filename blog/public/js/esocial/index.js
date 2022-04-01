$(document).ready(function(){
    $('#formulario').submit(function() {
        var formData = new FormData(this);
        gerarxml(formData)
        return false;
    });
    function gerarxml(dados){
        $.ajax({
            url: "https://api.tecnospeed.com.br/esocial/v1/evento/gerar/xml",
            type: "POST",
            data: dados,
            // dataType: 'json',
            processData: false,  
            headers: {
                'content-type':'text/tx2',
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':'26844068000140'
            },
            success: function(retorno){
                consultaevento(retorno.data.id)
            }
         });
    }
    function consultaevento(id) {
        $.ajax({
            url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultaridsevento/${id}?ambiente=2&versaomanual=2.5.00`,
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
                buscaxml(retorno.data.eventos[0])
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
        var formData = new FormData();
        formData.append('versaomanual','2.5.00')
        formData.append('empregador',dados.cnpj_sh)
        formData.append('ambiente','2')
        formData.append('inscricao',dados.cnpj_sh)
        formData.append('idgrupoeventos',dados.id)
        formData.append('xml',dados.xml)
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
                // 'empregador':'26844068000140'
            },
            success: function(retorno){
                console.log(retorno);
            }
        });
    }
})