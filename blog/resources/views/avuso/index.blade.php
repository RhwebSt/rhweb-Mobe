@extends('layouts.index')
@section('titulo','Recibo Avulso - Rhweb')
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

        <section class="section__botao--padrao">
            
            <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
            </div>
            
            <div class="d-flex justify-content-center align-items-center mx-auto mt-4" role="button" aria-label="Basic example">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item pill__item ms-1 mt-1" role="presentation">
                        <button class="nav-link botao__pill" id="info-avulso-tab" data-bs-toggle="pill" data-bs-target="#info-avulso" type="button" role="tab" aria-controls="info-avulso" aria-selected="true"><i class="fad fa-file-invoice-dollar"></i> Recibo Avulso</button>
                    </li>
                    <li class="nav-item pill__item ms-1 mt-1" role="presentation">
                        <button class="nav-link botao__pill" id="lista-avulso-tab" data-bs-toggle="pill" data-bs-target="#lista-avulso" type="button" role="tab" aria-controls="lista-avulso" aria-selected="false"><i class="fad fa-th-list"></i> Lista Recibos Avulsos</button>
                    </li>
                    <li class="nav-item pill__item ms-1 mt-1" role="presentation">
                        <button class="nav-link botao__pill" id="rol-avulso-tab" data-bs-toggle="pill" data-bs-target="#rol-avulso" type="button" role="tab" aria-controls="rol-avulso" aria-selected="false"><i class="fad fa-th-list"></i> Rol dos Recibos Avulsos</button>
                    </li>
                </ul>
            </div>
        
        </section>

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show" id="info-avulso" role="tabpanel" aria-labelledby="info-avulso-tab">
                
                <h1 class="title__pagina--padrao">Gerar Recibo Avulso <i class="fad fa-calculator"></i></h1>
                
                <section class="section__recibo--avulso--pill">
                    <form class="row g-3" action="{{route('avuso.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="empresa" value="{{$user->empresa_id}}">
        
                        <div class="col-12 col-md-6">
                            <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nome Completo</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" value="{{old('nome')}}" name="nome" maxlength="40" id="nome">
                            @error('nome')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="col-12 col-md-6">
                            <label for="cpf" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CPF/CNPJ</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" value="{{old('cpf')}}" name="cpf" maxlength="15" id="cpf">
                            @error('cpf')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <?php
                        if (isset($valorrublica_avuso->vsreciboavulso)) {
                            $avuso = $valorrublica_avuso->vsreciboavulso + 1;
                        } else {
                            $avuso = 1;
                        }
                        ?>
                        
                        <input type="hidden" name="codigo" value="{{$avuso}}">
                        
                        <div class="col-12 col-sm-6">
                            <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Inicial</label>
                            <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="ano_inicial">
                            <div class="mt-1">
                                @error('ano_inicial')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col-12 col-sm-6">
                            <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Final</label>
                            <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="anoFinal">
                            <div class="mt-1">
                                @error('ano_final')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <section class="section__items-avulso">
                                <div class="row mb-3" id="conteiner">
                                    
                                    <div class="col-12 col-md-5 mt-2">
                                        <label for="descricao" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                                        <input type="text" class="form-control @error('descricao0') is-invalid @enderror" name="descricao0" maxlength="100" id="descricao">
                                        <div class="mt-1">
                                            @error('descricao0')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-12 col-md-3 mt-2">
                                        <label for="valor" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i>Valor</label>
                                        <input type="text" class="form-control @error('valor0') is-invalid @enderror" name="valor0" maxlength="100" id="valor">
                                        <div class="mt-1">
                                            @error('valor0')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-12 col-md-3 mt-2">
                                        <label for="cd" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Crédito/Desconto</label>
                                        <select id="cd" name="cd0" class="form-select">
                                            <option selected>Crédito</option>
                                            <option>Desconto</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-1 align-self-center mt-4">
                                        <i class="fad fa-lg fa-lock-alt"></i>
                                    </div>
        
                                </div>
                        </section>
                        
                        <div class="d-grid d-md-flex justify-content-md-end mb-5">
                            <div class="mt-4 mb-5">
                                <a type="text" class="btn botao" id="adicinar">Adicionar <i class="fas fa-plus"></i></a>
                                <button type="submit" class="btn botao" id="campo1">Gerar recibo <i class="fad fa-save"></i></button>
                            </div>
                        </div>

                        <input type="hidden" name="quantidade" value="1" id="quantidade">

                    </form>
                
                </section>

            </div>
    
    
            <div class="tab-pane fade" id="lista-avulso" role="tabpanel" aria-labelledby="lista-avulso-tab">
                
                <h1 class="title__pagina--padrao">Lista Recibos Avulsos <i class="fad fa-industry"></i></h1>
                
                <section class="section__lista--avulso ">
    
                    <form class="row g-3 d-none" action="{{route('filtra.pesquisa.avuso')}}" method="POST">
                        @csrf
                        <section class="section__search">
                            <div class="col-md-5">
                                
                                    
                                    <div class="d-flex">
                                        
                                        <input placeholder="clique ou digite para pesquisar" class="form-control" list="listatrabalhador" name="pesquisa" id="pesquisatrabalhador">
                                        <datalist id="listatrabalhador"></datalist>
        
                                        <input type="hidden" name="codicao" value="{{isset($trabalhador->id)?$trabalhador->id:''}}">
                                        
                                        <button class="btn botao__search">
                                            <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                        </button>
        
                                    </div>
                                    
                                
                            </div>
                        </section>
        
                        <section class="row section__filtro-avulso">
                            <div class="col-12 col-md-3">
                                <label for="ano" class="form-label">Competência</label>
                                <input type="month" class="form-control " name="competencia" value="" id="tano1Final">
                            </div>

                            <div class="col-md-2 align-self-center pt-4">
                                <button type="submit" class="btn botao">Filtrar <i class="fad fa-filter"></i></button>
                            </div>
                        </section>
        
        
                    </form>
                    <section class="d-none">
                        <div class="d-flex justify-content-end">
                            <div>
                                <div class="dropdown">
                                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-sort"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.ordem.avuso','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.ordem.avuso','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                  </div>
                            </div>
        
                        </div>
                    </section>
        
        
                    <section class="table">
                        <div class="table-responsive-xxl">
                           
                            <table class="table" id="table-avuso-lista">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap">Nome</th>
                                    <th class="th__header text-nowrap" style="width:150px;">CPF/CNPJ </th>
                                    <th class="th__header text-nowrap">Data inicial</th>
                                    <th class="th__header text-nowrap">Data Final</th>
                                    <th class="th__header text-nowrap" style="width:110px;">Nº Avulso</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Imprimir</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                            </table>
                        </div>
        
                    </section>
                </section>
    
            </div>
    
    
    
            <div class="tab-pane fade" id="rol-avulso" role="tabpanel" aria-labelledby="rol-avulso-tab">
                
                <h1 class="title__pagina--padrao">Rol dos Recibos Avulsos <i class="fad fa-industry"></i></h1>
                
                <section class="section__rol--avulso">
    
                    <form class="row g-3" action="{{route('recibo.avulso.trabalhador')}}" method="POST">
                        @csrf
                        
                        <section class="section__search">
                            <div class="col-md-5">
                               
                                    
                                    <div class="d-flex">
                                        
                                        <input placeholder="clique ou digite para pesquisar" class="form-control @error('search') is-invalid @enderror" list="listatrabalhador01" name="search" id="pesquisatrabalhador01">
                                        <datalist id="listatrabalhador01"></datalist>
        
                                        <input type="hidden" name="trabalhador01" class="@error('trabalhador01') is-invalid @enderror" id="trabalhador01">
                                      
                                        <button  class="btn botao__search">
                                            <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                        </button>
        
                                    </div>
                                    @error('search')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    
                                
                            </div>
                        </section>
                        
                        
        

                            <div class="col-12 col-sm-6">
                                <label for="ano" class="form-label">Data Inicial</label>
                                <input type="date" class="form-control @error('ano_inicial1') is-invalid @enderror" name="ano_inicial1" value="" id="tano1">
                                <div class="mt-1">
                                    @error('ano_inicial1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="col-12 col-sm-6">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control @error('ano_final1') is-invalid @enderror" name="ano_final1" value="" id="tano1">
                                <div class="mt-1">
                                    @error('ano_final1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        <div class="d-flex justify-content-end align-items-end mt-3">
                            <button type="submit" class="btn botao__enviar" id="">Imprimir <i class="fad fa-print"></i></button>
                        </div>
        
                    </form>
                </section>
            </div>

    </div>

</main>



@stop