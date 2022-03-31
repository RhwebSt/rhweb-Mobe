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
                if (retorno.status == '1'){
                  $('.mensagem').html(retorno.mensagem);
                }else{
                  $('.mensagem').html(retorno.mensagem)
                }
                $('.card-panel').removeClass('hide');
               }
         });
    }
})