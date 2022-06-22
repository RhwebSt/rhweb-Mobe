@extends('layouts.index')
@section('titulo','Editar Comissionado - Rhweb')
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

        <form class="row g-3" id="form" method="POST" action="{{route('comisionado.update',$dados->id)}}">
            @csrf
            @method('PATCH')
            <input type="hidden" value="{{$dados->idtomador}}" name="tomador" id="idtomador" class="@error('tomador') is-invalid @enderror">
            <input type="hidden" value="{{$dados->idtrabalhador}}" name="trabalhador" id="idtrabalhador" class="@error('trabalhador') is-invalid @enderror">
            
            <section class="section__botao--padrao">
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('comisionado.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit"   class="btn botao" ><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                        <i class="fad fa-list-ul"></i> Lista
                    </a>
                </div>
            </section>

                
            <h5 class="title__pagina--padrao">Editar Comissionado <i class="fad fa-percentage"></i></h5>


            <div class="col-md-8">
                <label for="exampleDataList" class="form-label">Trabalhador</label>
                <input class="pesquisa form-control @error('nome__trabalhador') is-invalid @enderror" list="listatrabalhador" name="nome__trabalhador" value="{{$dados->trabalhador}}" id="nome__trabalhador">
                <datalist id="listatrabalhador"></datalist>
                @error('nome__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="matricula__trab" class="form-label">Matricula Trabalhador <i class="fas fa-lock"></i></label>
                <input type="text" class="form-control  @error('matricula__trab') is-invalid @enderror" name="matricula__trab"  value="{{$dados->tsmatricula}}" id="matricula__trab" Readonly>
                @error('matricula__trab')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <input type="hidden" id="comissionado">
            
            <div class="col-md-4">
                <label for="indice" class="form-label">Indíce %</label>
                <input type="text" class="form-control @error('indice') is-invalid @enderror" name="indice" value="{{$dados->csindece}}" id="indice">
                @error('indice')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-8">
                <label for="exampleDataList" class="form-label">Tomador</label>
                <input class=" form-control @error('nome_tomador') is-invalid @enderror" list="listatomador" name="nome_tomador"  value="{{$dados->tomador}}" id="nome_tomador">
                <datalist id="listatomador"></datalist>
                @error('nome_tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
        </form>
    </div>
    @include('comisionado.lista')
</main>

<script type="text/javascript" src="{{url('/js/user/comissionado/edit.js')}}"></script>
    
@stop