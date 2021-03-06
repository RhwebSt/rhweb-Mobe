@extends('layouts.index')
@section('titulo','Boletim Cartão Ponto -Rhweb')
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
       
        <!--Fim do modal de Acesso não permitido-->

        <form class="row g-3" id="form" method="POST" action="{{route('cartao.ponto.cadastro')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="status" value="D" id="status">
            <input type="hidden" name="empresa" value="{{$user->empresa->id}}">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">

                  <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                  
                  <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalCartaoPonto">
                    <i class="fad fa-list-ul"></i> lista
                  </a>

                </div>
                
            </section>

            <h1 class="title__pagina--padrao">Boletim Cartão Ponto <i class="fad fa-alarm-clock"></i></h1>
        
            <?php
                if (isset($numboletimtabela->vsnrocartaoponto)) {
                    $boletim = $numboletimtabela->vsnrocartaoponto + 1;
                } else {
                    $boletim = 1;
                }
            ?>
            
            
            <div class="col-md-4">
                <label for="num__boletim" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nº do Boletim <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Numero do boletim gerado automáticamente"></i></label>
                <input type="text" value="{{$boletim}}" class="form-control @error('liboletim') is-invalid @enderror" list="listaboletim" name="liboletim" id="num__boletim" value="{{old('liboletim')}}">
                @error('liboletim')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim"></datalist>
            </div>

            <div class="col-md-8 input">
                <label for="tomador" class="form-label "><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tomador</label>
                <input type="text" class="form-control @error('nome__completo') is-invalid @enderror" list="lista_cartao_ponto_tomador" name="nome__completo" value="{{old('nome__completo')}}" id="nome__completo_cartao_ponto_tomador" placeholder="dê um duplo clique para escolher o tomador">
                <datalist id="lista_cartao_ponto_tomador"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <input type="hidden" name="tomador" class="@error('tomador') is-invalid @enderror" value="{{old('tomador')}}" id="tomador">
            <input type="hidden" id="domingo" name="domingo">
            <input type="hidden" name="sabado" id="sabado">
            <input type="hidden" name="diasuteis" id="diasuteis">


            <div class="col-md-4">
                <label for="data" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{old('data')}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="num__trabalhador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quantidade de Cadastros</label>
                <input type="text" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{old('num__trabalhador')}}" id="num__trabalhador" maxlength="15"  placeholder="quantidade de trabalhadores">
                @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="feriado" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Feriado</label>
                <select id="feriado" name="feriado" class="form-select @error('feriado') is-invalid @enderror">
                    <option>Sim</option>
                    <option selected>Não</option>
                </select>
                @error('feriado')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="hidden" name="feriadostatus" id="feriadostatus">
            </div>
            
        </form>
    </div>
    @include('cadastroCartaoPonto.lista')
</main>


<script type="text/javascript" src="{{url('/js/user/boletimCartaoPonto/index.js')}}"></script>
  @stop