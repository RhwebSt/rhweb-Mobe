@extends('layouts.index')
@section('titulo','Rhweb - Página Principal')
@section('conteine')
    <style>
        #particles-js{
            display: float;
            min-width: 100vh;
            min-height: 100%;
            z-index: -1 !important;
        }
    </style>


    <div class="svg-home-letter">

        <svg  id="rhwebLetter" class="d-none" xmlns="http://www.w3.org/2000/svg" viewBox="-200 0 850 100">
          <defs>
            <style>
               #rhwebLetter{
                   display: flex;
                   position: absolute;
                        position: absolute;
                        left: 50%;
                        transform: translate(-50%);
                        width: 50%;
                        top: 45%;
               }
               
                @media only screen and (max-width: 600px) {
                  #rhwebLetter {
                    width: 100%;
                  }
                }


              
            </style>
          </defs>
          <title>rhwebLetterNew</title>
          <g id="R">
            <path class="cls-1 letterRhweb" d="M89.67,157.33l18,33H80.33L64.67,162.67l-8.34.33v27.33h-26V99.67H81a31,31,0,0,1,23.33,33,28.55,28.55,0,0,1-5,16A28.17,28.17,0,0,1,89.67,157.33Z" transform="translate(-29.83 -94.5)"/>
            <path class="cls-1 letterRhwebNone" d="M55.67,121v20.33H70.33a9.87,9.87,0,0,0,5.75-3,10.06,10.06,0,0,0,2.59-7.16A12.12,12.12,0,0,0,70.33,121Z" transform="translate(-29.83 -94.5)"/>
          </g>
          <g id="H">
            <path class="cls-1 letterRhweb" d="M118.25,95v95.33h24V150a12.23,12.23,0,0,1,2.92-7.33,12.49,12.49,0,0,1,8.33-4.17,10,10,0,0,1,7.08,3.33,10.07,10.07,0,0,1,2.17,8.17v40.33H187.5l-.75-47.66a26.81,26.81,0,0,0-8.58-18.17A26.26,26.26,0,0,0,163,118a33.88,33.88,0,0,0-11.17,1.75A33.51,33.51,0,0,0,142,125q-.12-15-.25-30Z" transform="translate(-29.83 -94.5)"/>
          </g>
          <g id="W">
            <polygon class="cls-1 letterRhweb" points="164.17 26.5 186.17 95.83 205.83 95.83 220.17 64.5 232.83 95.83 252.5 95.83 274.5 26.5 250.17 26.5 239.83 63.5 222.5 26.5 216.17 26.5 199.17 63.17 188.17 26.5 164.17 26.5"/>
          </g>
          <g id="E">
            <path class="cls-1 letterRhweb" d="M382.67,160.67c.53-3.38,1.87-14.67-4.93-25.65-10.6-17.09-31.21-17.67-32.74-17.69-1.82,0-20.24.34-31.12,15.8-8.38,11.89-6.66,24.72-6.21,27.54A37.52,37.52,0,0,0,319,183a37.91,37.91,0,0,0,26.17,10,39.15,39.15,0,0,0,37.5-25.67l-25-.66a13.11,13.11,0,0,1-14,6.33,13.65,13.65,0,0,1-7.79-2.75,14,14,0,0,1-5.21-9.25Z" transform="translate(-29.83 -94.5)"/>
            <path class="cls-1 letterRhwebNone" d="M331.33,147.33h28.34a14.17,14.17,0,0,0-14.5-10.66,13.61,13.61,0,0,0-13.84,10.66Z" transform="translate(-29.83 -94.5)"/>
          </g>
          <g id="B">
            <path class="cls-1 letterRhweb" d="M465,179c-2.26,2.95-9.81,11.86-23,13.75-14.88,2.13-25.52-6.33-27.25-7.75-.83,1.78-1.67,3.56-2.5,5.33h-18V95h23.5l.5,28.5c1.89-1.11,16.8-9.57,32.6-3s21.8,23.89,21.65,36.24A37.31,37.31,0,0,1,465,179Z" transform="translate(-29.83 -94.5)"/>
            <path class="cls-1 letterRhwebNone" d="M440.75,141.75" transform="translate(-29.83 -94.5)"/>
            <path class="cls-1 letterRhwebNone" d="M424.75,141.75" transform="translate(-29.83 -94.5)"/>
            <path class="cls-1 letterRhwebNone" d="M433.38,139.63h0c.08-.26,3.1,0,5.62,1.21a18,18,0,0,1,5,3.92,16.42,16.42,0,0,1,4.25,10.42,16,16,0,0,1-4.37,11.46,15.76,15.76,0,0,1-10.5,4.62,16.31,16.31,0,0,1-12.5-5,16,16,0,0,1,.62-22.12A16.25,16.25,0,0,1,433.38,139.63Z" transform="translate(-29.83 -94.5)"/>
          </g>

        </svg>
    </div>
    
    <div id="particles-js"></div>
    
    <script src="{{url('js/particlesjs.js')}}"></script>
    <script src="{{url('js/appParticles.js')}}"></script>

    <div class="float-end ms-auto p-2 feedback">
        <div class="d-flex collumn">
            <a class="ms-1" id="feedback"><i class="fad fa-comment-alt-lines"></i> FeedBack</a>
        </div>
    </div>

<input type="hidden" name="icon" id="icon">
<!--<div class="d-flex collumn align-items-center">-->
<!--    <div class="fixed-bottom mb-5 ms-5 align-items-end ms-auto">-->
<!--      <button type="submit" class="btn btn-success"><i class="fas fa-comment-dots"></i></button>-->
<!--    </div>-->
<!--</div>-->

<script>

   
   
    $(document).ready(function(){
        setTimeout(function(){
           $('#rhwebLetter').removeClass('d-none');
           new Vivus('rhwebLetter', {duration: 300,
            type: 'sync',
            pathTimingFunction: Vivus.EASE_OUT_BOUNCE,
            animTimingFunction: Vivus.LINEAR
            }); 
        }, 500);
    })
   
   
        

     
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
                        empresa:'{{$user->empresa_id}}'
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