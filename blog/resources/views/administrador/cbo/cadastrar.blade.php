@extends('administrador.layouts.index')
@section('titulo','Rhweb - CBO')
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
    
    


    <section class="conteudo__cbo">

        <form class=" row g-3" action="{{route('administrador.cbo.store')}}" method="Post">

            <input type="hidden" name="user" value="{{$user->empresa}}">
            @csrf
            
            <section class="section__botao--voltar--cbo">
            
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="btn botao__voltar" href="{{route('administrador.cbo.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <button type="submit" class="button__incluir--cbo btn"><i class="fad fa-save"></i> Incluir</button>
                </div>
            </section>
            
            <h1 class="title__cbo">Cadastrar CBO <i class="fad fa-comment-alt-plus"></i></h1>
            
            <div class="d-flex justify-content-center flex-column align-items-center div__form--cbo">

                <div class="mb-3 col-12 col-md-6">
                    <label for="codigo__cbo" class="form-label">Código Cbo</label>
                    <input type="text" class="form-control @error('codigo__cbo') is-invalid @enderror" id="codigo__cbo" value="{{ old('codigo__cbo')}}" name="codigo__cbo" placeholder="código" maxlength="5">
                    @error('codigo__cbo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 col-12 col-md-6">
                    <label for="descricao__cbo" class="form-label">Descrição</label>
                    <input type="text" class="form-control @error('descricao__cbo') is-invalid @enderror" id="descricao__cbo" name="descricao__cbo" value="{{ old('descricao__cbo')}}" placeholder="descrição" maxlength="60">
                    @error('descricao__cbo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </form>

    </section>


</div>
@stop