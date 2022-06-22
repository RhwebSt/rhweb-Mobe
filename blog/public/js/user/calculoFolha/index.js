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

// está função e para gravar o ultimo botao pill que o usuario clicou
// para que quando renderizar ele volte no mesmo lugar
function activePill(){
    var Back = document.getElementById('calcula-folha-tab');
        Back.addEventListener("click", function(){
        localStorage.setItem('Back', 'backpill1');
       
   })
   
     var Back1 = document.getElementById('lista-geral-tab');
        Back1.addEventListener("click", function(){
        localStorage.setItem('Back', 'backpill3');
       
   })
   
    var Back2 = document.getElementById('lista-tomador-tab');
        Back2.addEventListener("click", function(){
        localStorage.setItem('Back', 'backpill2');
       
   })
   
   backActive =  document.getElementById("lista-tomador");
   backActive1 =  document.getElementById("calculaFolha");
   backActive2 =  document.getElementById("lista-geral");

    voltar = localStorage.getItem("Back");

    
    if(voltar === null){
        localStorage.setItem('Back', 'backpill1');
        Back.classList.add("active");
        backActive1.classList.add("show", "active");
        backActive.classList.remove("show", "active");
        backActive2.classList.remove("show", "active");
        document.getElementById("calcula-folha-tab").click();
    }

    if(voltar === "backpill1"){
        Back.classList.add("active");
        backActive1.classList.add("show", "active");
        backActive.classList.remove("show", "active");
        backActive2.classList.remove("show", "active");
        document.getElementById("calcula-folha-tab").click();
        

    }else if (voltar === "backpill2"){
        Back2.classList.add("active");
        backActive.classList.add("show", "active");
        backActive1.classList.remove("show", "active");
        backActive2.classList.remove("show", "active");
        document.getElementById("lista-tomador-tab").click();

        
    }else if (voltar === "backpill3"){
        Back1.classList.add("active");
        backActive2.classList.add("show", "active");
        backActive.classList.remove("show", "active");
        backActive1.classList.remove("show", "active");
        document.getElementById("lista-geral-tab").click();

    }
}

activePill();


$('#calcula-folha-tab').click(function(){
    $('#calculaFolha').addClass('animation-slide-in-pill');
        setTimeout(function(){
       $('#calculaFolha').removeClass('animation-slide-in-pill'); 
    },1500);
    
    $('#lista-tomador').addClass('animation-slide-out');
        setTimeout(function(){
       $('#lista-tomador').removeClass('animation-slide-out'); 
    },1500);
    
    $('#lista-geral').addClass('animation-slide-out');
        setTimeout(function(){
       $('#lista-geral').removeClass('animation-slide-out'); 
    },1500)
});


$('#lista-tomador-tab').click(function(){
    $('#lista-tomador').addClass('animation-slide-in-pill');
        setTimeout(function(){
       $('#lista-tomador').removeClass('animation-slide-in-pill'); 
    },1500);
    
    $('#calculaFolha').addClass('animation-slide-out');
        setTimeout(function(){
       $('#calculaFolha').removeClass('animation-slide-out'); 
    },1500);
    
    $('#lista-geral').addClass('animation-slide-out');
        setTimeout(function(){
       $('#lista-geral').removeClass('animation-slide-out'); 
    },1500)
});


$('#lista-geral-tab').click(function(){
    $('#lista-geral').addClass('animation-slide-in-pill');
        setTimeout(function(){
       $('#lista-geral').removeClass('animation-slide-in-pill'); 
    },1500);
    
    $('#calculaFolha').addClass('animation-slide-out');
        setTimeout(function(){
       $('#calculaFolha').removeClass('animation-slide-out'); 
    },1500);
    
    $('#lista-tomador').addClass('animation-slide-out');
        setTimeout(function(){
       $('#lista-tomador').removeClass('animation-slide-out'); 
    },1500)
});
