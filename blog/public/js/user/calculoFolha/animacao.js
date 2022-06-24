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