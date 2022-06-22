@extends('layouts.index')
@section('titulo','Editar Cadastro de Acesso - Rhweb')
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
              title: "{{session('success')}}"
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
        
        
        <form class="row g-3" id="form" method="POST" action="{{route('usuario.update',$editar->id)}}">
            @csrf
            @method('PATCH')
            
            <section class="section__botoes--cadAcesso">
                <input type="hidden" name="empresa" id="idempresa" value="{{$user->empresa->id}}">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('usuario.create')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="atualizar"  class="btn btn botao "><i class="fad fa-sync-alt"></i> Atualizar</button>
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalCadAcesso">
                        <i class="fad fa-list"></i> Lista
                    </a>
                </div>
            </section>
            
            <h1 class="title__cadAcesso">Editar Cadastro de Acesso <i class="fad fa-user-plus"></i></h1>

            <div class="col-md-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" list="listusuario" class="form-control @error('name') is-invalid @enderror" value="{{$editar->name}}"   name="name"  id="usuario">
                @error('name')
                    <span class="">{{ $message }}</span>
                @enderror
                <span class="invalid-feedback" id="mensagemuser"></span>
                <datalist id="listusuario"></datalist>
            </div>
                
            <input type="hidden" name="email">
            
            <div class="col-md-2">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control " name="cargo" value="{{$editar->cargo}}" id="cargo">
            </div>
                
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control " name="email" value="{{$editar->email}}" id="email">
            </div>

            <div class="col-md-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control @error('senha') is-invalid @enderror"  name="senha" value="" id="senha">
                @error('senha')
                    <span class="">{{ $message }}</span>
                @enderror
            </div>
                
              
              
        </form>
    </div>
    @include('usuarios.trabalhador.lista');
</main>

<script type="text/javascript" src="{{url('/js/user/cadastroAcesso/edit.js')}}"></script>

@stop