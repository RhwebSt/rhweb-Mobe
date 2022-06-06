
$(document).ready(function () {
    if (window.Laravel.tabelapreco.condicao) {
            Swal.fire({
                title: 'Ano (colocar ano aqui - do proximo ano) está chegando <i class="fas fa-glass-cheers"></i>',
                html: '<p>Para melhor funcionamento do sistema, já estamos atualizando a tabela de preço dos tomadores para o próximo ano. Escolha apenas uma das opções abaixo</p>' + 
                '<div class="form-check">'+
                    '<input class="form-check-input text-black" name="valor" type="checkbox" id="valor1" value="option1">'+
                    '<label class="form-check-label text-black text-start" for="valor1">Manter todos os preços e rúbricas atuais.</label>'+
                '</div>'+

                '<div class="form-check mb-3">'+
                    '<input class="form-check-input" type="checkbox" name="valor" id="valor2" value="option2">'+
                    '<label class="form-check-label text-black text-start" for="valor2">Apenas Rubricas padrão e sem valor.</label>'+
                '</div>'+'<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>'+'<p id="msg"></p>',
                confirmButtonText:
                    'Confirmar <i class="fas fa-check"></i>',
                confirmButtonColor: '#017329',
                preConfirm: (event) => {
                    atualizar()
                    return false;
                }
            })
    }
    function atualizar() {
        $('#msg').text('Em processamento...');
        $('#progress').text('50%').css({"width": "50%"});
        $.ajax({
            url: `${window.Laravel.tabelapreco.url}`,
            dataType: 'json',
            type: "post",
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrf
            }, 
            data:{
                'condicao':$('input[name="valor"]:checked').val(),
                'empresa':window.Laravel.empresa
            },
            async: false,
            error: function () {
                $('#msg').text('Não foi porssivél realizar o processo');
                $('#progress').text('0%').css({"width": "0%"});
            },
            success: function (data) {
                $('#msg').text('Processo realizado com sucesso');
                $('#progress').text('100%').css({"width": "100%"});
            }
        });
    }
    
});