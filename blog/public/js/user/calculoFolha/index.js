$(document).ready(function(){
    // $('#campo1').click(function() {
    //     $('#quadro1').addClass('d-none')
    //     $('#quadro2').removeClass('d-none')
    // })
    // $('#campo_nao_2').click(function() {
    //     $('#quadro2').addClass('d-none')
    //     $('#quadro1').removeClass('d-none')
    // })
   
    $('.banco').on('focus keyup',function () {
        let datalist = $(this).next().attr('id')
        $.ajax({
            url: "https://brasilapi.com.br/api/banks/v1",
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                data.forEach(element => {
                    nome += `<option value="${element.code} - ${element.fullName}">`
                });
                $(`#${datalist}`).html(nome)
            },
            error: function(data){
                // $("#banco").addClass('is-invalid')
                // $('#menssagem-banco').text(data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
            }
        })
       
    })
    $('.pesquisarublica').on('focus keyup',function() {
        let dados = 0;
        if ($(this).val()) {
            dados = $(this).val()
        }
        // console.log($(this).attr('data-id'));
        let id = $(this).attr('data-id');
        $.ajax({
            url: "{{url('rublica/pesquisa')}}/"+dados,
            type: 'get',
            contentType: 'application/json',
            async:false,
            success: function(data) {
               
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                    nome += `<option value="${element.rsdescricao}">`
                    // nome += `<option value="${element.rsrublica}">`
                    });
                $(`#listarublica${id}`).html(nome)
                // $(this).next().html(nome)
                }
                // if(data.length === 1 && dados.length >= 4){
                //     buscaItem(dados)
                // }
            }
        })
    })
    $('#pesquisatrabalhador').on('keyup focus',function () {
        let dados = 0;
        if ($(this).val()) {
            dados = $(this).val()
        }
        $.ajax({
            url: "{{url('trabalhador')}}/pesquisa/"+dados, 
            type: 'get',
            contentType: 'application/json', 
            success: function(data) {
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                    nome += `<option value="${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            // nome += `<option value="${element.tscnpj}">`
                    });
                    $('#listatrabalhador').html(nome)
                } 
                if(data.length === 1 && dados.length >= 2){
                    $('#trabalhador').val(data[0].id)
                }
            }
        })
    })
    $('#pesquisatomador').on('keyup focus',function () {
        let dados = 0;
        if ($(this).val()) {
            dados = $(this).val()
        }
        $.ajax({
            url: "{{url('tomador')}}/pesquisa/"+dados, 
            type: 'get',
            contentType: 'application/json', 
            success: function(data) {
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                    nome += `<option value="${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            // nome += `<option value="${element.tscnpj}">`
                    });
                    $('#listatomador').html(nome)
                } 
                if(data.length === 1){
                    $('#tomador').val(data[0].tomador)
                }
            }
        })
    })
})
