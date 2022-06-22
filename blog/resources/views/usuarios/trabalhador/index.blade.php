@extends('layouts.index')
@section('titulo','Cadastro de Acesso - Rhweb')
@section('conteine')

<main role="main">
    <div class="container">
              
        @if(session('success'))
            <script>
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  html: '<p class="modal__aviso">{{session("success")}}</p>',
                  background: '#45484A',
                  showConfirmButton: true,
                  timer: 2500,
        
                });
            </script>
        @endif
        @error('false')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<p class="modal__aviso">{{ $message }}</p>',
                    background: '#45484A',
                    showConfirmButton: true,
                    timer: 5000,
        
                });
            </script>
        @enderror

        <form class="row g-3" id="form" method="POST" action="{{route('usuario.store')}}">
            @csrf
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao">
                        <i id="inclurIcone" class="fad fa-save"></i> Incluir
                    </button>
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalCadAcesso">
                        <i class="fad fa-list"></i> Lista
                    </a>
                        
                </div>
                
            </section>

            <input type="hidden" name="empresa" id="idempresa" value="{{$user->empresa->id}}">

            <h1 class="title__pagina--padrao">Cadastro de Acesso <i class="fad fa-user-plus"></i></h1>
            
            
            <div class="col-md-3">
                <label for="usuario" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Usuario</label>
                <input type="text" list="listusuario" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"   name="name" value="" id="usuario" placeholder="digite o nome do usuário">
                @error('name')
                    <span class="">{{ $message }}</span>
                @enderror
                <span class="invalid-feedback" id="mensagemuser"></span>
                <datalist id="listusuario"></datalist>
            </div>
            
            <input type="hidden" name="email">
            
            <div class="col-md-2">
                <label for="cargo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Cargo</label>
                <input type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{old('cargo')}}" id="cargo">
                @error('cargo')
                    <span class="">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-3">
                <label for="email" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="email" placeholder="digite um email válido">
                @error('email')
                    <span class="">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="senha" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Senha</label>
                <input type="password" class="form-control @error('senha') is-invalid @enderror" value="{{old('senha')}}" name="senha" value="" id="senha" placeholder="mínimo 6 carácteres e uma letra maiúscula">
                @error('senha')
                    <span class="">{{ $message }}</span>
                @enderror
            </div>
            
        </form>
    </div>
    @include('usuarios.trabalhador.lista');
</main>

<script type="text/javascript" src="{{url('/js/user/cadastroAcesso/index.js')}}"></script>
 
@stop