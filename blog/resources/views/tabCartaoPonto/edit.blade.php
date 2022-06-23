@extends('layouts.index')
@section('titulo','Editar Boletim com Tabela - Rhweb')
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
        
        <!--Modal de Acesso não permitido-->
        @error('permissaonegada')
         <script>
            Swal.fire({
              icon: 'error',
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: true,
              html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+
              '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+
              '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',
              showConfirmButton: false,
            });
        </script> 
        @enderror

        <form class="row g-3 mt-1 mb-3" method="POST" id="form" action="{{route('tabela.cartao.ponto.atualizar',base64_encode($dados->id))}}">
            <input type="hidden" name="lancamento" value="{{$dados->id}}">
            @csrf
            @method('PATCH')
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('tabela.cartao.ponto.novo')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalLancamentoPreco">
                        <i class="fad fa-list"></i> Lista
                    </button>
                </div>
                
            </section>
            
            <h5 class="title__pagina--padrao">Editar Boletim com Tabela <i class="fad fa-pencil-alt"></i></h5>

            <?php
              if (isset($numboletimtabela->vsnroboletins)) {
                $boletim = $numboletimtabela->vsnroboletins + 1;
              }else{
                $boletim = 1;
              }
            ?>
            
            
            <div class="col-md-4">
                <label for="num__boletim" class="form-label">Nº do Boletim <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$dados->liboletim}}" list="listaboletim" class="form-control @error('liboletim') is-invalid @enderror" name="liboletim" id="num__boletim" Readonly>
                @error('liboletim')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim"></datalist>
            </div>

            <div class="col-md-8 input">
                <label for="tomador" class="form-label">Tomador <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" list="datalistOptions" class=" form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="{{$dados->tomador->tsnome}}" id="nome__completo" Readonly>
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <input type="hidden" name="tomador"  class="@error('tomador') is-invalid @enderror" id="tomador" value="{{$dados->tomador->id}}">
            <input type="hidden" name="status" value="M" id="status">
            <input type="hidden" name="empresa" value="{{$user->empresa}}">


            <div class="col-md-6">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{$dados->lsdata}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="num__trabalhador" class="form-label">Quantidade de cadastros</label>
                <input type="number" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{$dados->lsnumero}}" id="num__trabalhador">
                 @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-3 d-none">
                <label for="feriado" class="form-label">Feriado</label>
                <select id="feriado" name="feriado" class="form-select text-dark" >
                    <option>Sim</option>
                    <option selected>Não</option>
                </select>
            </div>
                    
                    
        </form>
    </div>
    @include('tabCartaoPonto.lista')
</main>

<script type="text/javascript" src="{{url('/js/user/boletimTabela/edit.js')}}"></script> 
    
@stop