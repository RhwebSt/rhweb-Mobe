@extends('administrador.layouts.index')
@section('titulo','Rhweb - Gerador de Acesso')
@section('conteine')
<main role="main">
    <div class="container">
        @if(session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                width: 500,
                color: '#ffffff',
                background: '#5AA300',
                position: 'top-end',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        
            Toast.fire({
                icon: 'success',
                title: '{{session("success")}}'
            })
        </script>
        @endif
        @error('false')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                width: 500,
                color: '#ffffff',
                background: '#C53230',
                position: 'top-end',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        
            Toast.fire({
                icon: 'error',
                title: '{{$message}}'
            })
        </script>
        @enderror
    
        <section class="">
        
                <form class="row g-3 form__bg" id="form" action="{{route('user.store')}}" enctype="multipart/form-data" method="Post">
                    @csrf
                    
                    <section class="section__botao--voltar--acesso">
            
                        <div class="d-flex justify-content-start align-items-start div__voltar">
                            <a class="btn botao__voltar" href="{{route('administrador')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                        </div>
                        
                        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                            <a href="{{route('administrador')}}" class="btn botao"><i class="fad fa-list"></i> Lista</a>
                        </div>
                    </section>
                
                    <h5 class="text__title">Gerador de Acesso <i class="fad fa-door-open"></i></h5>
                    
                    <div class="d-flex justify-content-center align-items-center flex-column div__form--gerador">

                        <div class="col-12 col-md-8">
                            <label for="usuario" class="form-label text-white">Usuário <i class="fas fa-lock"></i></label>
                            <input type="text" class="form-control input fw-bold text-dark @error('name') is-invalid @enderror" name="name" value="{{ Session::get('usuario')  ?? old('name') }}" id="usuario" readonly>
                            @error('name')
                            <span class="">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="col-12 col-md-8 mt-2">
                            <label for="codigo" class="form-label text-white">Código <i class="fas fa-lock"></i></label>
                            <input type="text" class="form-control input fw-bold text-dark @error('senha') is-invalid @enderror" name="senha" value="{{ Session::get('senha')  ?? old('senha') }}" id="codigo" readonly>
                            @error('senha')
                            <span class="">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <input type="hidden" name="condicao" value="precadastro">
                        <div class="col-12 col-md-8 mt-2">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" class="form-control input fw-bold @error('email') is-invalid @enderror text-dark" name="email" value="{{ Session::get('email')  ?? old('email') }}" id="email">
                            @error('email')
                            <span class="">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-12 col-md-8 mt-3">
                            <div class="d-flex justify-content-between">
                                <label for="link" class="form-label text-white">Link</label>
                                <a class="copy" id="copy"></a>
                                <i id="iconCopy" class="icon__copy fa-lg ms-2 fad fa-copy"></i>
                            </div>
                            <input type="link" class="form-control input fw-bold text-dark" name="link" value="{{ Session::get('url')  ?? old('link') }}" id="link">
                            <span class=""></span>
                        </div>
        
                        <div class="col-md-8 mt-3 d-flex justify-content-end mb-3">
                            <button type="submit" id="vincular" name="vincular" class="btn botao__vincular--gerador">Vincular <i class="fas fa-link"></i></button>
                        </div>
                    </div>
                    
                </form>
        
        </section>
    </div>
</main>

<script>

    const iconCopy = document.querySelector("#iconCopy");
    
    iconCopy.addEventListener('click', function(){
        const textCopy = document.querySelector("#copy");
        textCopy.textContent = "Copiado";
        iconCopy.classList.add('d-none');

        var content = document.getElementById('link');
        content.select();
        document.execCommand('copy');

        setTimeout(() => {
            textCopy.textContent = "";
            iconCopy.classList.remove('d-none');
            console.log(iconCopy.classList);
        }, 3600);
    })







    var campoCodigo = document.querySelector("#codigo");
    var campoUsuario = document.querySelector("#usuario");
    var msgErroEmail = document.querySelector("#emailFeedback");

    function geraStringAleatoria(tamanho) {
        var stringAleatoria = '';
        var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        for (var i = 0; i < tamanho; i++) {
            stringAleatoria += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }
        return stringAleatoria;
    }

    function geraUsuario(tamanho) {
        var stringAleatoria = '';
        var caracteres = '0123456789';
        for (var i = 0; i < tamanho; i++) {
            stringAleatoria += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        }
        return stringAleatoria;
    }

    var codigoGerado = campoCodigo.value = geraStringAleatoria(6);
    var codigoUsuarioGerado = campoUsuario.value = geraUsuario(5);

    var campoEmail = document.querySelector("#email");


    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    campoEmail.addEventListener('input', function() {
        var teste = validateEmail(campoEmail.value);

        if (teste == true) {
            campoEmail.classList.add('is-valid');
        } else {
            campoEmail.classList.remove('is-valid');
        }

        if (campoEmail.value.length > 0) {
            msgErroEmail.textContent = "";
            campoEmail.classList.remove('is-invalid');
        }


    });

    var botaoVincular = document.querySelector("#vincular");

    botaoVincular.addEventListener('click', function(e) {

        if (campoEmail.value <= 0) {
            campoEmail.classList.add('is-invalid');
            e.preventDefault();
            msgErroEmail.textContent = "Preencha o campo de Email!";
        } else {
            msgErroEmail.textContent = "";
            campoEmail.classList.remove('is-invalid');
        }
    })
</script>
@stop