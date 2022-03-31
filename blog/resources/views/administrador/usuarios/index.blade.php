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

<section class="mt-5">
    <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2">
        <form class="row g-3 needs-validation form-control bg__form" id="form" action="{{route('user.store')}}" enctype="multipart/form-data" method="Post">
            @csrf
            <div class="d-flex justify-content-center align-items-center flex-column">
                <h1 class="text-center fs-4 text-white mt-5 mb-5">Gerar Código de Acesso <i class="fas fa-door-open"></i></h1>

                <div class="col-md-4">
                    <label for="usuario" class="form-label text-white">Usuário <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control input input fw-bold text-dark @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" id="usuario" readonly>
                    @error('name')
                    <span class="">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-2">
                    <label for="codigo" class="form-label text-white">Código <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control input input fw-bold text-dark @error('senha') is-invalid @enderror" name="senha" value="{{old('senha')}}" id="codigo" readonly>
                    @error('senha')
                    <span class="">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" name="condicao" value="precadastro">
                <div class="col-md-4 mt-2">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="email" class="form-control input input fw-bold @error('email') is-invalid @enderror text-dark" name="email" value="{{old('email')}}" id="email">
                    @error('email')
                    <span class="">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <button type="submit" id="vincular" name="vincular" class="btn botao__alteracao">Vincular <i class="fas fa-link"></i></button>
                </div>
            </div>
        </form>
    </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
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