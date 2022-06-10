@extends('layouts.index')
@section('titulo','Rhweb - Página Principal')
@section('conteine')

    <div class="svg-home-letter">
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
    <!--<div class="svg-home-letter">-->
    <!--    <svg  id="rhwebLetter" xmlns="http://www.w3.org/2000/svg" viewBox="-200 0 850 100">-->
    <!--      <defs>-->
    <!--        <style>-->
    <!--           #rhwebLetter{-->
    <!--               position: absolute;-->
    <!--               left:0;-->
    <!--               top:0;-->
    <!--           } -->
            
    <!--          .cls-1 {-->
    <!--            fill: none;-->
    <!--            stroke: #211915;-->
    <!--          }-->
    <!--        </style>-->
    <!--      </defs>-->
    <!--      <title>rhwebLetterNew</title>-->
    <!--      <g id="R">-->
    <!--        <path class="cls-1 letterRhweb" d="M89.67,157.33l18,33H80.33L64.67,162.67l-8.34.33v27.33h-26V99.67H81a31,31,0,0,1,23.33,33,28.55,28.55,0,0,1-5,16A28.17,28.17,0,0,1,89.67,157.33Z" transform="translate(-29.83 -94.5)"/>-->
    <!--        <path class="cls-1 letterRhwebNone" d="M55.67,121v20.33H70.33a9.87,9.87,0,0,0,5.75-3,10.06,10.06,0,0,0,2.59-7.16A12.12,12.12,0,0,0,70.33,121Z" transform="translate(-29.83 -94.5)"/>-->
    <!--      </g>-->
    <!--      <g id="H">-->
    <!--        <path class="cls-1 letterRhweb" d="M118.25,95v95.33h24V150a12.23,12.23,0,0,1,2.92-7.33,12.49,12.49,0,0,1,8.33-4.17,10,10,0,0,1,7.08,3.33,10.07,10.07,0,0,1,2.17,8.17v40.33H187.5l-.75-47.66a26.81,26.81,0,0,0-8.58-18.17A26.26,26.26,0,0,0,163,118a33.88,33.88,0,0,0-11.17,1.75A33.51,33.51,0,0,0,142,125q-.12-15-.25-30Z" transform="translate(-29.83 -94.5)"/>-->
    <!--      </g>-->
    <!--      <g id="W">-->
    <!--        <polygon class="cls-1 letterRhweb" points="164.17 26.5 186.17 95.83 205.83 95.83 220.17 64.5 232.83 95.83 252.5 95.83 274.5 26.5 250.17 26.5 239.83 63.5 222.5 26.5 216.17 26.5 199.17 63.17 188.17 26.5 164.17 26.5"/>-->
    <!--      </g>-->
    <!--      <g id="E">-->
    <!--        <path class="cls-1 letterRhweb" d="M382.67,160.67c.53-3.38,1.87-14.67-4.93-25.65-10.6-17.09-31.21-17.67-32.74-17.69-1.82,0-20.24.34-31.12,15.8-8.38,11.89-6.66,24.72-6.21,27.54A37.52,37.52,0,0,0,319,183a37.91,37.91,0,0,0,26.17,10,39.15,39.15,0,0,0,37.5-25.67l-25-.66a13.11,13.11,0,0,1-14,6.33,13.65,13.65,0,0,1-7.79-2.75,14,14,0,0,1-5.21-9.25Z" transform="translate(-29.83 -94.5)"/>-->
    <!--        <path class="cls-1 letterRhwebNone" d="M331.33,147.33h28.34a14.17,14.17,0,0,0-14.5-10.66,13.61,13.61,0,0,0-13.84,10.66Z" transform="translate(-29.83 -94.5)"/>-->
    <!--      </g>-->
    <!--      <g id="B">-->
    <!--        <path class="cls-1 letterRhweb" d="M465,179c-2.26,2.95-9.81,11.86-23,13.75-14.88,2.13-25.52-6.33-27.25-7.75-.83,1.78-1.67,3.56-2.5,5.33h-18V95h23.5l.5,28.5c1.89-1.11,16.8-9.57,32.6-3s21.8,23.89,21.65,36.24A37.31,37.31,0,0,1,465,179Z" transform="translate(-29.83 -94.5)"/>-->
    <!--        <path class="cls-1 letterRhwebNone" d="M440.75,141.75" transform="translate(-29.83 -94.5)"/>-->
    <!--        <path class="cls-1 letterRhwebNone" d="M424.75,141.75" transform="translate(-29.83 -94.5)"/>-->
    <!--        <path class="cls-1 letterRhwebNone" d="M433.38,139.63h0c.08-.26,3.1,0,5.62,1.21a18,18,0,0,1,5,3.92,16.42,16.42,0,0,1,4.25,10.42,16,16,0,0,1-4.37,11.46,15.76,15.76,0,0,1-10.5,4.62,16.31,16.31,0,0,1-12.5-5,16,16,0,0,1,.62-22.12A16.25,16.25,0,0,1,433.38,139.63Z" transform="translate(-29.83 -94.5)"/>-->
    <!--      </g>-->
    <!--    </svg>-->
    <!--</div>-->





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