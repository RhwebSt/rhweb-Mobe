@extends('layouts.index')
@section('titulo','Editar tabela de preço - Rhweb')
@section('conteine')

<main role="main">
    <div class="container">
        @if(session('success'))
            <script>
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  html: '<p class="modal__aviso">Cadastro realizado com Sucesso</p>',
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
                    html: '<p class="modal__aviso">Não foi possível realizar o cadastro!</p>',
                    background: '#45484A',
                    showConfirmButton: true,
                    timer: 5000,
        
                });
            </script>
        @enderror

    
        <form class="row g-3" id="form" method="POST" action="{{ route('tabelapreco.update',$id) }}">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{ route('tabelapreco.index',[' ',base64_encode($tomador)]) }}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
               <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                <button type="submit" class="btn botao " id="atualizar"><i class="fad fa-sync-alt"></i> Atualizar </button>
                
                <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#modalTabPreco">
                    <i class="fad fa-list-ul"></i> Lista
                </a>

              </div> 
                
            </section>
    
            <h1 class="title__pagina--padrao">Tabela de Preços <i class="fad fa-sack-dollar"></i></h1>
    
    
            <input type="hidden" value="{{$tomador}}" name="tomador" id="tomador">
            @if($user->empresa)
            <input type="hidden" name="empresa" value="{{$user->empresa}}">
            @else
            <input type="hidden" name="empresa" value="">
            @endif
            @csrf
            <input type="hidden" id="method" name="_method" value="PUT">

    
    
            <div class="col-md-2">
                <label for="ano" class="form-label">Ano</label>
                <input type="text" class=" form-control @error('ano') is-invalid @enderror" name="ano" value="{{$tabelaprecos_editar->tsano}}" id="ano">
                @error('ano')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-3">
                <label for="rubricas" class="form-label">Código <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" class="form-control pesquisa @error('rubricas') is-invalid @enderror" name="rubricas" value="{{$tabelaprecos_editar->tsrubrica}}" id="rubricas" readonly>
                @error('rubricas')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="rubricas"></datalist>
                <span class="text-danger" id="rubricamensagem"></span>
            </div>
    
            <div class="col-md-7">
                <label for="descricao" class="form-label">Descrição <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" class="form-control  @error('descricao') is-invalid @enderror" list="descricoes" name="descricao" value="{{$tabelaprecos_editar->tsdescricao}}" id="descricao" readonly>
                <datalist id="descricoes"></datalist>
                @error('descricao')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="descricoesmensagem"></span>
            </div>
    
            <div class="col-md-6">
                <label for="valor" class="form-label">Valor Trabalhador</label>
                <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{number_format((float)$tabelaprecos_editar->tsvalor, 2, ',', '')}}" id="valor">
                @error('valor')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6">
                <label for="valor__tomador" class="form-label">Valor Tomador</label>
                <input type="text" class="form-control @error('valor__tomador') is-invalid @enderror" name="valor__tomador" value="{{number_format((float)$tabelaprecos_editar->tstomvalor, 2, ',', '')}}" id="valor__tomador">
                @error('valor__tomador')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </form>
      @include('tomador.tabelapreco.lista')
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/tomador/tabelaPreco/edit.js')}}"></script>
@stop