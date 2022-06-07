
// $(document).ready(function(){
//     $('main').addClass('animation-slide-in');
//     var AnimationMain = setTimeout(transicaoEntrar, 2000);
//     function transicaoEntrar(){
//       $('main').removeClass('animation-slide-in');
//     }
// });


$('.botao__voltar').click(function(e){

    $('main').addClass('animation-slide-out');
    var transicaoVoltarTeste = setTimeout(transicaoVoltar, 2000);
    function transicaoVoltar(){
       $('main').removeClass('animation-slide-out');
    }

});
