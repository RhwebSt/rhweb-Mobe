@extends('layouts.index')
@section('titulo','Rhweb - Página Principal')
@section('conteine')

    <div class="svg-home-letter">
        <!--<object id="rhwebLetter" type="image/svg+xml" data="imagem/homeLetter.svg"></object>-->
        <svg id="rhwebLetter" xmlns="http://www.w3.org/2000/svg" viewBox="-300 0 800 100">
              <title>rhwebLetter</title>
              <g id="letra_R" data-name="letra R">
                <path class="cls-1 letterRhweb" d="M110.16,215.64v41h11.67v-14.5l2-.17L130,256.67h12.33L135.83,240a13.28,13.28,0,0,0,6.5-13.67c-1.33-9.66-12.5-10.69-12.5-10.69Z" transform="translate(-109.66 -214.67)"/>
                <path class="cls-1 letterRhwebNone" d="M121.67,227.17v3h7.66s2.84-.67,0-3C129,226.87,121.67,227.17,121.67,227.17Z" transform="translate(-109.66 -214.67)"/>
              </g>
              <g id="letra_h" data-name="letra h">
                <polygon class="cls-1 letterRhweb" points="35.51 0.97 35.51 42 47.17 42 47.17 27.5 56.17 27.5 56.17 42 67.51 42 67.51 0.97 55.84 0.97 56.17 15.5 47.01 15.5 47.17 0.97 35.51 0.97"/>
              </g>
              <g id="letra_w" data-name="letra w">
                <path class="cls-1 letterRhweb" d="M179.33,215.17" transform="translate(-109.66 -214.67)"/>
                <polygon class="cls-1 letterRhweb" points="80.84 42 69.67 0.5 81.51 0.97 88.67 26 95.01 0.97 107.67 0.97 114.67 25.5 121.84 0.97 133.17 0.97 122.51 42 107.51 42 101.42 21.48 96.17 42 80.84 42"/>
              </g>
              <g id="letra_e" data-name="letra e">
                <polygon class="cls-1 letterRhweb" points="155.67 0.97 135.34 0.97 135.34 42 155.67 42 155.67 30.17 147.01 30 147.01 27 155.67 27.17 155.67 15.5 147.01 15.5 146.67 12.37 155.67 12.37 155.67 0.97"/>
              </g>
              <g id="letra_b" data-name="letra b">
                <path class="cls-1 letterRhweb" d="M268.33,215.64v41h21a13.69,13.69,0,0,0,10.5-8.17c3.34-7.5-1.33-12.35-1.33-12.35s8.17-13.71-7.83-20.51Z" transform="translate(-109.66 -214.67)"/>
                <path class="cls-1 letterRhwebNone" d="M279.83,227.17v3h7.67s2.83-.67,0-3C287.13,226.87,279.83,227.17,279.83,227.17Z" transform="translate(-109.66 -214.67)"/>
                <path class="cls-1 letterRhwebNone" d="M279.85,242.12v3h7.67s2.83-.66,0-3C287.15,241.82,279.85,242.12,279.85,242.12Z" transform="translate(-109.66 -214.67)"/>
              </g>
            </svg>
    </div>




<div class="float-end ms-auto p-2 bd-highlight feedback">
    <div class="d-flex collumn">
        <a class="text-white" style="cursor: pointer"><i class="fad fa-lg fa-comment-alt-smile"></i></a>
        <a class="text-white fw-bold ms-1 text-decoration-none" id="feedback" style="font-size: 14px; cursor: pointer;">FeedBack</a>
    </div>
</div>

<input type="hidden" name="icon" id="icon">
<!--<div class="d-flex collumn align-items-center">-->
<!--    <div class="fixed-bottom mb-5 ms-5 align-items-end ms-auto">-->
<!--      <button type="submit" class="btn btn-success"><i class="fas fa-comment-dots"></i></button>-->
<!--    </div>-->
<!--</div>-->

<script>

   
        new Vivus('rhwebLetter', {duration: 140,
        type: 'delayed',
        animTimingFunction: Vivus.EASE_IN_OUT
      });

     
    var feedbackBotao = document.querySelector("#feedback");


    feedbackBotao.addEventListener('click', function() {
        Swal.fire({
            title: '<h1 style="font-size: 19px; color: black;">O que você está achando do sistema?<h1>',
            html: '<h2 class="mt-3" style="font-size: 16px;">Escolha uma das opções abaixo.</h2>' + '<div><i id="gostou" class="far fa-2x fa-grin-hearts gostouMuitoHover" style="width: 20px; margin-right: 20px; margin-top: 10px;"></i>' +
                '<i id="feliz" class="far fa-2x fa-grin-alt felizHover" style="width: 20px; margin-right: 20px; margin-top: 10px;"></i>' +
                '<i id="mediano" class="far fa-2x fa-meh medianoHover" style="width: 20px; margin-right: 20px; margin-top: 10px;"></i>' +
                '<i id="naoGostou" class="far fa-2x fa-frown naoGostouHover"></i></div>' +
                
                '<textarea class="mt-4" id="feedbackText" name="recado" rows="6" style="font-size: 14px;" cols="40" placeholder="Deixe aqui seu recado ou sugestão.">',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Enviar <i class="fad fa-paper-plane"></i>',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            confirmButtonColor: '#418D3F',
            cancelButtonText: 'Sair <i class="fad fa-times-circle"></i>',
            cancelButtonColor: '#DB2B39',
            cancelButtonAriaLabel: 'Thumbs down'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('comentario')}}",
                    type: 'post',
                    // contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        feedbackText:$('#feedbackText').val(),
                        icon:$('#icon').val(),
                        empresa:'{{$user->empresa}}'
                    },
                    success: function(data) {
                        if (data.status) {
                            Swal.fire(data.msg, '', 'success')
                        } else{
                            Swal.fire(data.msg, '', 'info')
                        }
                    }
                })
            }
        })
        var feliz = document.getElementById('feliz');
        var gostouMuito = document.getElementById('gostou');
        var mediano = document.getElementById('mediano');
        var naoGostou = document.getElementById('naoGostou');


        feliz.addEventListener('click', function() {
            $('#icon').val("feliz")
            feliz.classList.add("feliz");
            gostouMuito.classList.remove("gostouMuito");
            mediano.classList.remove("mediano");
            gostouMuito.classList.remove("gostouMuito");
            mediano.classList.remove("mediano");
        });

        gostouMuito.addEventListener('click', function() {
            $('#icon').val("gostouMuito")
            gostouMuito.classList.add("gostouMuito");
            mediano.classList.remove("mediano");
            naoGostou.classList.remove("naoGostou");
            feliz.classList.remove("feliz");
        });

        mediano.addEventListener('click', function() {
            $('#icon').val("mediano")
            mediano.classList.add("mediano");
            feliz.classList.remove("feliz");
            gostouMuito.classList.remove("gostouMuito");
            naoGostou.classList.remove("naoGostou");
        });

        naoGostou.addEventListener('click', function() {
            $('#icon').val("naoGostou")
            naoGostou.classList.add("naoGostou");
            gostouMuito.classList.remove("gostouMuito");
            mediano.classList.remove("mediano");
            feliz.classList.remove("feliz");
        })


    })
</script>






@stop