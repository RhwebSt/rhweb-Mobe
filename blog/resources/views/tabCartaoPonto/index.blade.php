@extends('layouts.index')
@section('titulo','Boletim com tabela - Rhweb')
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
        

        <form class="row g-3" method="POST" id="form" action="{{route('tabela.cartao.ponto.cadastro')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="feriado">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
       
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalLancamentoPreco"><i class="fad fa-list"></i> Lista</a>
                    
                </div>
                
            </section>
              
            <h5 class="title__pagina--padrao">Boletim com Tabela <i class="fad fa-pencil-alt"></i></h5>

              
            <?php
              if (isset($numboletimtabela->vsnroboletins)) {
                $boletim = $numboletimtabela->vsnroboletins + 1;
              }else{
                $boletim = 1;
              }
            ?>
            
            <div class="col-md-4">
                <label for="num__boletim" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nº do Boletim <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Número do boletim gerado automáticamente"></i></label>
                <input type="text" value="{{$boletim}}" list="listaboletim" class="form-control @error('liboletim') is-invalid @enderror" name="liboletim" id="num__boletim" >
                @error('liboletim')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim"></datalist>
            </div>

            <div class="col-md-8 input">
                <label for="tomador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tomador</label>
                <input type="text" list="datalistOptions" class=" form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="{{old('nome__completo')}}" id="nome__completo" placeholder="dê um duplo clique para pesquisar">
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <input type="hidden" name="tomador" value="{{old('tomador')}}" class="@error('tomador') is-invalid @enderror" id="tomador">
            <input type="hidden" name="status" value="M" id="status">
            <input type="hidden" name="empresa" value="{{$user->empresa_id}}">

            <div class="col-md-6">
                <label for="data" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{old('data')}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="num__trabalhador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quantidade de cadastros</label>
                <input type="text" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{old('num__trabalhador')}}" id="num__trabalhador" placeholder="quantidade de trabalhadores">
                @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </form>
    </div>
    @include('tabCartaoPonto.lista')
</main>

<script type="text/javascript" src="{{url('/js/user/boletimTabela/index.js')}}"></script>      
    
@stop