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


<div class="container">
    
    

    <section class="">
        <form class="row g-3" id="form" method="POST" action="{{route('administrador.usuarios.store')}}">
            @csrf
            
            <section class="section__botao--voltar--acesso">
            
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="btn botao__voltar" href="{{route('administrador.usuarios.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao">
                        <i class="fad fa-save"></i> Incluir
                    </button>
                </div>
            </section>
        
            <h5 class="text__title">Cadastro de Login <i class="fad fa-users"></i></h5>

            <div class="col-md-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" list="listempresa" class="form-control @error('empresa') is-invalid @enderror" value="{{old('empresa')}}" id="empresa" placeholder="duplo clique para pesquisar">
                @error('empresa')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="hidden" name="empresa" id="empresa_id">
                <datalist id="listempresa">
                </datalist>
            </div>

            <div class="col-md-2">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" list="listusuario" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" id="usuario">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listusuario">
                </datalist>
            </div>
            <div class="col-md-2">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{old('cargo')}}" id="cargo">
                @error('cargo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control @error('senha') is-invalid @enderror" value="{{old('senha')}}" name="senha" value="" id="senha">
                @error('senha')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </form>
    </section>

    
</div>
<script>
    $(document).ready(function() {
        $("#empresa").on('keyup focus', function() {
            var dados = '0';
            if ($(this).val()) {
                dados = $(this).val();
                // if (dados.indexOf('  ') !== -1) {
                //     dados = monta_dados(dados);
                // }
            }
            $.ajax({
                url: "{{url('empresa')}}/pesquisa/" + dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                        data.forEach(element => {
                            nome += `<option value="${element.esnome}">`
                            // nome += `<option value="${element.escnae}">`
                            // nome += `<option value="${element.escnpj}">`
                        });
                        $('#listempresa').html(nome)
                    }
                    $('#empresa_id').val(data[0].id)
                }
            });
        });
    });
</script>
@stop