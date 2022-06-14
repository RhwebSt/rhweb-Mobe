@extends('administrador.layouts.index')
@section('titulo','Rhweb - Administrador')
@section('conteine')
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
                title: '{{ $message }}'
            })
        </script>
        @enderror
        
        


        <section class="conteudo__msg-email">

            <form class=" row g-3" action="{{route('email.enviar')}}" method="Post">

                @csrf
                
                <section class="section__botao--voltar--msg-email">
                
                    <div class="d-flex justify-content-start align-items-start div__voltar">
                        <a class="btn botao__voltar" href="" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                    </div>
                    
                </section>
                
                <h1 class="title__msg-email">Enviar email para os usuários <i class="fad fa-envelope"></i></h1>
                
                <div class="d-flex justify-content-center flex-column align-items-center div__form--msg-email">

                    <div class="mb-3 col-12 col-md-6">
                        <label for="titulo__msg-email" class="form-label">Titulo</label>
                        <input type="text" class="form-control @error('titulo__msg-email') is-invalid @enderror" id="titulo__msg-email" value="{{ old('titulo__msg-email')}}" name="titulo__msg-email" placeholder="Titulo do Email" maxlength="20">
                        @error('titulo__msg-email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="mb-3 col-12 col-md-6">
                        <label for="descricao__msg-email" class="form-label">Descrição</label>
                        <textarea class="form-control @error('descricao__msg-email') is-invalid @enderror" id="descricao__msg-email" name="descricao__msg-email" rows="3" value="{{ old('descricao__msg-email')}}" maxlength="255"></textarea>
                        @error('descricao__msg-email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="" role="group" aria-label="Basic example">
                        <button type="submit" class="button__incluir--msg-email btn"><i class="fad fa-paper-plane"></i> Enviar</button>
                    </div>

                </div>

            </form>

        </section>


    </div>
    @stop