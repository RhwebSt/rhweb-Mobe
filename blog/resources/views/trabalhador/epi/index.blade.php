@extends('layouts.index')
@section('titulo','Ficha de Epi - Rhweb')
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
                html: '<p class="modal__aviso">Não foi possível gerar a ficha de EPI</p>',
                background: '#45484A',
                showConfirmButton: true,
                timer: 5000,
    
            });
        </script>
        @enderror


        <form class="row g-3" action="{{route('epi.store')}}" method="POST">
        @csrf
        
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                        <a class="botao__voltar" href="{{route('trabalhador.novo')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a  class="btn botao" href="{{route('ficha.epi.trabalhador',$id)}}" id="campo1">Gerar ficha <i class="fad fa-user-hard-hat"></i></a> 
                </div>
                
            </section>
        
            <h1 class="title__pagina--padrao">Item da Ficha de EPI <i class="fad fa-user-hard-hat"></i></h1>
            
            <input type="hidden" name="trabalhador" value="{{$id}}">
            
            <div class="mt-5" id="conteiner" >
                @if(count($listaepi) > 0)
                    @foreach($listaepi as $key=>$valor)
                    @if($key < 1)
                        <div class="row mb-3">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-1 col-xxl-1 mt-2">
                                <label for="quantidade{{$key}}" class="form-label">Qtd <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade"></i></label>
                                <input type="text" class="form-control numero @error('quantidade{{$key}}') is-invalid @enderror numero" name="quantidade{{$key}}" value="{{$valor->eiquantidade}}" maxlength="100" id="quantidade{{$key}}">
                                @error('quantidade{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 mt-2">
                                <label for="descricao{{$key}}" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao{{$key}}') is-invalid @enderror"  name="descricao{{$key}}" value="{{$valor->esdescricao}}" maxlength="100" id="descricao{{$key}}">
                                @error('descricao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-1 col-xxl-1 mt-2">
                                <label for="tamanho{{$key}}" class="form-label">Tam <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Tamanho"></i></label>
                                <input type="text" class="form-control @error('tamanho{{$key}}') is-invalid @enderror"  name="tamanho{{$key}}" value="{{$valor->estm}}" maxlength="100" id="tamanho{{$key}}">
                                @error('tamanho{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-1 col-xxl-1 mt-2">
                                <label for="ca{{$key}}" class="form-label">CA  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Numero do Certificado de Aprovação"></i></label>
                                <input type="text" class="form-control numero @error('ca{{$key}}') is-invalid @enderror"  name="ca{{$key}}" value="{{$valor->eica}}" maxlength="100" id="ca{{$key}}">
                                @error('ca{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2 mt-2">
                                <label for="data__recolhimento{{$key}}" class="form-label">Recolhimento  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de recolhimento"></i></label>
                                <input type="date" class="form-control  @error('data__recolhimento{{$key}}') is-invalid @enderror"  name="data__recolhimento{{$key}}" value="{{$valor->esdatares}}" maxlength="100" id="data__recolhimento{{$key}}">
                                @error('data__recolhimento{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-2 col-xxl-2 mt-2">
                                <label for="data__devolucao{{$key}}" class="form-label">Devolução  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de devolução"></i></label>
                                <input type="date" class="form-control @error('data__devolucao{{$key}}') is-invalid @enderror"  name="data__devolucao{{$key}}" value="{{$valor->esdatadev}}" maxlength="100" id="data__devolucao{{$key}}">
                                @error('data__devolucao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                    @else
                        <div class="row mb-3 campo{{$key}}">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="quantidade{{$key}}" class="form-label">Qtd <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade"></i></label>
                                <input type="text" class="form-control numero @error('quantidade{{$key}}') is-invalid @enderror numero" name="quantidade{{$key}}" value="{{$valor->eiquantidade}}" maxlength="100" id="quantidade{{$key}}">
                                @error('quantidade{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-4 col-xxl-4 mt-2">
                                <label for="descricao{{$key}}" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao{{$key}}') is-invalid @enderror"  name="descricao{{$key}}" value="{{$valor->esdescricao}}" maxlength="100" id="descricao{{$key}}">
                                @error('descricao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="tamanho{{$key}}" class="form-label">Tam <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Tamanho"></i></label>
                                <input type="text" class="form-control @error('tamanho{{$key}}') is-invalid @enderror"  name="tamanho{{$key}}" value="{{$valor->estm}}" maxlength="100" id="tamanho{{$key}}">
                                @error('tamanho{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="ca{{$key}}" class="form-label">CA  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Numero do Certificado de Aprovação"></i></label>
                                <input type="text" class="form-control numero @error('ca{{$key}}') is-invalid @enderror"  name="ca{{$key}}" value="{{$valor->eica}}" maxlength="100" id="ca{{$key}}">
                                @error('ca{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__recolhimento{{$key}}" class="form-label">Recolhimento <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de recolhimento"></i></label>
                                <input type="date" class="form-control @error('data__recolhimento{{$key}}') is-invalid @enderror"  name="data__recolhimento{{$key}}" value="{{$valor->esdatares}}" maxlength="100" id="data__recolhimento{{$key}}">
                                @error('data__recolhimento{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__devolucao{{$key}}" class="form-label">Devolução <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de devolução"></i></label>
                                <input type="date" class="form-control @error('data__devolucao{{$key}}') is-invalid @enderror"  name="data__devolucao{{$key}}" value="{{$valor->esdatadev}}" maxlength="100" id="data__devolucao{{$key}}">
                                @error('data__devolucao{{$key}}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="d-flex div__botao--delete--epi align-items-center col-md-1" id="botaoDelete">    
                                <a onclick="remove('{{$key}}')">
                                    <i class="fas fa-2x fa-times btn icon__exit--epi"></i>
                                </a>
                            </div>
                            
                        </div>
                    @endif
                    @endforeach
                    <input type="hidden" name="quantidade" value="{{count($listaepi)}}" id="quantidade">
                    @else
                        <div class="row mb-3">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="quantidade" class="form-label">Qtd <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade"></i></label>
                                <input type="text" class="form-control numero @error('quantidade0') is-invalid @enderror" name="quantidade0"  maxlength="100" id="quantidade0">
                                @error('quantidade0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-4 col-xxl-4 mt-2">
                                <label for="descricao0" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao0') is-invalid @enderror"  name="descricao0"  maxlength="100" id="descricao0">
                                @error('descricao')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="tamanho0" class="form-label">Tam <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Tamanho"></i></label>
                                <input type="text" class="form-control @error('tamanho0') is-invalid @enderror"  name="tamanho0"  maxlength="100" id="tamanho0">
                                @error('tamanho0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-1 col-xxl-1 mt-2">
                                <label for="ca0" class="form-label">CA  <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Numero do Certificado de Aprovação"></i></label>
                                <input type="text" class="form-control numero @error('ca0') is-invalid @enderror"  name="ca0"  maxlength="100" id="ca0">
                                @error('ca0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__recolhimento0" class="form-label">Recolhimento <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de recolhimento"></i></label>
                                <input type="date" class="form-control @error('data__recolhimento0') is-invalid @enderror"  name="data__recolhimento0"  maxlength="100" id="data__recolhimento0">
                                @error('data__recolhimento0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-6  col-xl-2 col-xxl-2 mt-2">
                                <label for="data__devolucao0" class="form-label">Devolucão <i class="fad fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Data de devolução"></i></label>
                                <input type="date" class="form-control @error('data__devolucao0') is-invalid @enderror"  name="data__devolucao0"  maxlength="100" id="data__devolucao0">
                                @error('data__devolucao0')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                        </div>
                        
                        <input type="hidden" name="quantidade" value="1" id="quantidade">
                    @endif
               
            </div>

            <div class="d-grid d-md-flex justify-content-md-end mb-5">
                <div class="mt-4 mb-5">
                    <a type="text" class="btn botao" id="adicinar"><i class="fad fa-plus"></i> Adicionar</a>
                    <button type="submit" class="btn botao" id="salvar1"><i class="fad fa-save"></i> Salvar</button>
                </div>
            </div>

        </form>

    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/trabalhador/epi/epi.js')}}"></script>

@stop