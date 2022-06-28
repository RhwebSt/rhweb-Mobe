@extends('layouts.index')
@section('titulo','Boletim com Tabela Preço - Rhweb')
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

        <form class="row g-3" id="form" method="POST" action="{{route('boletim.tabela.store')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('tabela.cartao.ponto.novo')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-4 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                    <button type="submit" id="incluir" @if($lista->count() >= $quantidade) disabled @endif class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                    
                    <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalBoletimTabela">
                          <i class="fad fa-list-ul"></i> Lista
                    </button>
                    
              </div>
                
            </section>

            <h1 class="title__pagina--padrao">Lançamento com Tabela de Preço <i class="fad fa-sack-dollar"></i></h1>
              
            <input type="hidden" name="lancamento" value="{{$id}}">
            <input type="hidden" name="numtrabalhador" value="{{$quantidade}}">
            <input type="hidden" name="valor" id="valor">
            <input type="hidden" name="lftomador" id="lftomador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
            <input type="hidden" name="tomador" id="tomador" value="{{$tomador}}">
            <input type="hidden" name="data" value="{{base64_decode($data)}}">
            <input type="hidden" name="descricao" id="descricao">
            
            
            <div class="col-md-10">
                <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Trabalhador</label>
                <input class="pesquisa form-control @error('nome__completo') is-invalid @enderror" list="nomecompleto" name="nome__completo" id="nome__completo_boletim_tabela_trabalhador" value="{{old('nome__completo')}}" placeholder="dê um duplo clique para pesquisar">
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="nomemensagem"></span>
                <datalist id="nomecompleto"></datalist>
            </div>
            
            <input type="hidden" name="trabalhador" id="trabalhador">
            
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" id="matricula" Readonly>
                @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            

            <div class="col-md-7">
                <label for="rubrica" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                <input type="text" class="form-control @error('rubrica') is-invalid @enderror" list="rublicas" name="rubrica" value="{{old('rubrica')}}" id="rubrica" placeholder="dê um duplo clique para escolher um item da tabela de preço">
                <datalist id="rublicas">   
                </datalist>
                @error('rubrica')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
               
            </div>
            
            <div class="col-md-2">
                <label for="codigo" class="form-label">Código <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control rubrica @error('codigo') is-invalid @enderror" name="codigo" list="codigos" value="{{old('codigos')}}" id="codigo" readonly>
                @error('codigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="codigos">   
                </datalist>
                <span class="text-danger" id="codigomensagem"></span>
            </div>

            <div class="col-md-3">
                <label for="quantidade" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quantidade</label>
                <span id="conteinarquant">
                <input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="quantidade">
                </span>
                
                @error('quantidade')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
        </form>
    </div>
    @include('tabelaCadastro.lista')
</main>
<script type="text/javascript" src="{{url('/js/user/boletimTabela/lancamentoTabelaPreco/index.js')}}"></script> 
@stop