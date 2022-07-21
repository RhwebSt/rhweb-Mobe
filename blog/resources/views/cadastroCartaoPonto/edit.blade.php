@extends('layouts.index')
@section('titulo','Editar Boletim Cartão Ponto -Rhweb')
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
      

        <form class="row g-3" id="form" method="POST" action="{{route('cartao.ponto.atualizar',base64_encode($dados->id))}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="PUT">
            <input type="hidden" name="status" value="D" id="status">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('cartao.ponto.novo')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
           
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalCartaoPonto">
                      <i class="fad fa-list-ul"></i> Lista
                    </a>
                    
                </div>
                
            </section>
            
            <h1 class="title__pagina--padrao">Editar Boletim Cartão Ponto <i class="fad fa-alarm-clock"></i></h1>

            <div class="col-md-4">
                <label for="num__boletim" class="form-label">Nº do Boletim <i class="fas fa-lock"></i></label>
                <input type="text"  class="form-control @error('liboletim') is-invalid @enderror" list="listaboletim" name="liboletim" value="{{$dados->liboletim}}" id="num__boletim" Readonly>
                @error('liboletim')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim">
                </datalist>
            </div>
    
            <div class="col-md-8 input">
                <label for="tomador" class="form-label ">Tomador</label>
                <input type="text" class="form-control @error('nome__completo') is-invalid @enderror" list="datalistOptions" name="nome__completo" value="{{$dados->tomador->tsnome}}" id="nome__completo">
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <input type="hidden" name="tomador" class="@error('tomador') is-invalid @enderror" id="tomador" value="{{$dados->tomador->id}}">
            <input type="hidden" id="domingo" name="domingo">
            <input type="hidden" name="sabado" id="sabado">
            <input type="hidden" name="diasuteis" id="diasuteis">


            <div class="col-md-4">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{$dados->lsdata}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-4">
                <label for="num__trabalhador" class="form-label">Quantidade de Cadastros</label>
                <input type="text" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{$dados->lsnumero}}" id="num__trabalhador">
                @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                    
            <div class="col-md-4">
                <label for="feriado" class="form-label">Feriado</label>
                <select id="feriado" name="feriado" class="form-select" >
                    @if($dados->lsferiado === 'Sim')
                    <option selected>Sim</option>
                    <option >Não</option>
                    @else
                    <option >Sim</option>
                    <option selected>Não</option>
                    @endif
                </select>
                @error('feriado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" name="feriadostatus" id="feriadostatus">
        </form>
    </div>
    @include('cadastroCartaoPonto.lista')
</main>

<script type="text/javascript" src="{{url('/js/user/boletimCartaoPonto/edit.js')}}"></script>
@stop