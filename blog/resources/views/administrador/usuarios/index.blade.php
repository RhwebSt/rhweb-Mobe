@extends('administrador.layouts.index')
@section('titulo','Rhweb - Novo Usuario')
@section('conteine')

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

        <section class="section__gerador">
        
                <form class="row g-3 form__bg" id="form" action="{{route('user.store')}}" enctype="multipart/form-data" method="Post">
                    @csrf
                    <div class="d-flex justify-content-center align-items-center flex-column div__form--gerador">
                        
                        <div class="col-md-8 mt-3 d-flex justify-content-start mb-3">
                            <a href="{{route('administrador')}}" class="btn btn__voltar-gerador align-self-start mt-2 mb-2"><i class="fad fa-arrow-left"></i> Voltar</a>
                            <a href="{{route('administrador')}}" class="btn btn__voltar-gerador align-self-start mt-2 mb-2"><i class="fad fa-arrow-left"></i> Lista</a>
                        </div>
                        
                        <h1 class="text-center fs-5 text-white mt-2 mb-2" style="font-size:14px">Gerador de Acesso <i class="fad fa-door-open"></i></h1>
        
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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