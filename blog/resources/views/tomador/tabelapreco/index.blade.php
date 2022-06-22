@extends('layouts.index')
@section('titulo','Tabela de preço - Rhweb')
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
        @error('tabelavazia')
            <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        html: '<p class="modal__aviso--title">Relatório vazio</p>'+ '<p class="modal__aviso">{{ $message }}</p>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true,
                        background: '#45484A',
                        showConfirmButton: true,
                        timer: 5000,
                        customClass: {
                          title: 'modal__aviso',
                        }
                    })
            </script>
        @enderror

        <form class="row g-3" id="form" method="POST" action="{{ route('tabelapreco.store') }}">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{ route('tomador.novo') }}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" class="btn botao " id="incluir"><i class="fad fa-save"></i> Incluir </button>

                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalTabPreco">
                      <i class="fad fa-list-ul"></i> Lista
                    </a>
              </div>
                
            </section>
    
    
            <h1 class="title__pagina--padrao">Tabela de Preços <i class="fad fa-sack-dollar"></i></h1>
    
    
            <input type="hidden" value="{{$tomador}}" name="tomador" id="tomador">
           
            <input type="hidden" name="empresa" value="{{$user->empresa->id}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            

            <div class="col-md-7">
                <label for="descricao" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                <input type="text" class="form-control  @error('descricao') is-invalid @enderror" list="descricoes" name="descricao" value="{{old('descricao')}}" id="descricao">
                <input type="hidden"  value="{{old('descricao')}}">
                <datalist id="descricoes"></datalist>
                @error('descricao')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="descricoesmensagem"></span>
            </div>
            
            <input type="hidden" name="status" value="produção">
            
            <div class="col-md-3">
                <label for="rubricas" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Código</label>
                <input type="text" name="rubricas" class="form-control  pesquisa @error('rubricas') is-invalid @enderror" value="{{old('rubricas')}}" id="rubricas">
                <input type="hidden"  value="{{old('descricao')}}">
                @error('rubricas')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="rubricas">datalist>
                <span class="text-danger" id="rubricamensagem"></span>
            </div>
    
            <div class="col-md-2">
                <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Ano</label>
                <input type="text" class="form-control @error('ano') is-invalid @enderror" name="ano" value="{{old('ano')}}" id="ano">
                @error('ano')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="valor" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Valor Trabalhador</label>
                <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{old('valor')}}" id="valor">
                @error('valor')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6">
                <label for="valor__tomador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Valor Tomador</label>
                <input type="text" class="form-control @error('valor__tomador') is-invalid @enderror" name="valor__tomador" value="{{old('valor__tomador')}}" id="valor__tomador">
                @error('valor__tomador')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
        </form>
      @include('tomador.tabelapreco.lista')
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/tomador/tabelaPreco/index.js')}}"></script>
@stop