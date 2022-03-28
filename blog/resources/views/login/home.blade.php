@extends('layouts.index')
@section('titulo','Rhweb - Página Principal')
@section('conteine')



<div class="box__principal">
    <!--<img class="img-fluid logo__principal" src="{{url('/imagem/arrowMobe.png')}}">-->
    <h1 class="titleHome">RHWEB</h1>
    <h1 class="titleHomeLittle">Sistemas Inteligentes</h1>
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