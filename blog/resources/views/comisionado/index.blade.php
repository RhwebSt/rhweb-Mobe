@extends('layouts.index')
@section('titulo','Comissionado -Rhweb')
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

        
        <form class="row g-3" id="formComissionado" method="POST" action="{{route('comisionado.store')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="tomador" id="idtomador" class="@error('tomador') is-invalid @enderror">
            <input type="hidden" name="trabalhador" id="idtrabalhador" class="@error('trabalhador') is-invalid @enderror">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao" ><i class="fad fa-save"></i> Incluir</button>
                    
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalComissionado">
                        <i class="fad fa-list-ul"></i> Lista
                    </a>
                </div>
                
            </section>

            <h5 class="title__pagina--padrao">Comissionado <i class="fad fa-percentage"></i></h5>


            <div class="col-md-8">
                <label for="exampleDataList" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigat??rio"></i> Trabalhador</label>
                
                <input class="pesquisa form-control @error('nome__trabalhador') is-invalid @enderror" list="listatrabalhador" name="nome__trabalhador" value="{{old('nome__trabalhador')}}" id="nome__trabalhador" placeholder="d?? um duplo click para escolher ou digite">
                
                <datalist id="listatrabalhador"></datalist>
                @error('nome__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="matricula__trab" class="form-label">Matricula Trabalhador <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo autom??tico"></i></label>
                <input type="text" class="form-control  @error('matricula__trab') is-invalid @enderror" name="matricula__trab"  value="{{old('matricula__trab')}}" id="matricula__trab" Readonly>
                @error('matricula__trab')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <input type="hidden" id="comissionado">
            
            <div class="col-md-4">
                <label for="indice" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigat??rio"></i> Ind??ce %</label>
                <input type="text" class="form-control @error('indice') is-invalid @enderror" name="indice" value="{{old('indice')}}" id="indice" placeholder="digite a porcentagem para o comissionado">
                @error('indice')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-8">
                <label for="exampleDataList" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigat??rio"></i> Tomador</label>
                <input class="form-control @error('nome_tomador') is-invalid @enderror" list="listatomador" name="nome_tomador"  value="{{old('nome_tomador')}}" id="nome_tomador" placeholder="d?? um duplo click para escolher ou digite">
                <datalist id="listatomador">
                  
                </datalist>
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

<section class="delete__tabela--tomador">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="formdelete" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-header modal__delete">
                        <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal-delbody">
                        <p class="mb-1 text-start">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer modal-delfooter">
                        <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn__deletar">Deletar</button>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="{{url('/js/user/comissionado/index.js')}}"></script>
  
@stop