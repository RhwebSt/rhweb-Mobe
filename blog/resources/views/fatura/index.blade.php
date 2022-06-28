@extends('layouts.index')
@section('titulo','Fatura - Rhweb')
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
                    <li class="nav-item pill__item ms-1 mt-1 " role="presentation">
                        <button class="nav-link botao__pill" id="gerar-fatura-tab" data-bs-toggle="pill" data-bs-target="#gerar-fatura" type="button" role="tab" aria-controls="gerar-fatura" aria-selected="true"><i class="fad fa-file-invoice-dollar"></i> Gerar Fatura</button>
                    </li>
                    <li class="nav-item pill__item ms-1 mt-1 " role="presentation">
                        <button class="nav-link botao__pill" id="lista-fatura-tab" data-bs-toggle="pill" data-bs-target="#lista-fatura" type="button" role="tab" aria-controls="lista-fatura" aria-selected="false"><i class="fad fa-list"></i> Lista de Faturas</button>
                    </li>
                </ul>
                
            </div>
        </section>


        <div class="tab-content" id="pills-tabContent">
        
            <div class="tab-pane fade show" id="gerar-fatura" role="tabpanel" aria-labelledby="gerar-fatura-tab">
                <h1 class="title__pagina--padrao">Gerar Fatura <i class="fad fa-calculator"></i></h1>
                
                <section class="section__search">
                    <div class="col-md-5">
                        <form action="" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" value="{{old('pesquisa')}}" list="listapesquisa" name="pesquisa" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="">
                                
                                <button type="submit" class="btn botao__search">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                </button>

                            </div>
                            
                        </form>
                    </div>
                </section>
                
                <form class="row g-3 " action="{{route('fatura.gera')}}" method="POST">
                    <input type="hidden" name="tomador" value="{{old('tomador')}}" class="@error('tomador') is-invalid @enderror" id="tomador">
                    @csrf

                    <section class="section__content--fatura row">
                        
                        <div class="col-12 col-md-6 mt-2">
                            <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Inicial</label>
                            <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="ano_inicial">
                            @error('ano_inicial')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                
                        <div class="col-12 col-md-6 mt-2">
                            <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Final</label>
                            <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="ano_final">
                            @error('ano_final')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <?php
                            if ($valorrublica_fatura->vsnrofatura) {
                                $fatura = $valorrublica_fatura->vsnrofatura + 1;
                            }else{
                                $fatura = 1;
                            }
                        ?>
                        <input type="hidden" name="numero" value="{{$fatura}}">
                        
                        <div class="col-12 col-md-6 mt-2">
                            <label for="text__adiantamento" class="form-label">Texto Adiantamento</label>
                            <input type="text" class="form-control @error('text__adiantamento') is-invalid @enderror" name="text__adiantamento" value="{{old('text__adiantamento')}}" id="text__adiantamento" placeholder="Ex: Adiatamento de pagamento" maxlength="30"> 
                            @error('text__adiantamento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mt-2">
                            <label for="valor__adiantamento" class="form-label">Valor Adiantamento</label>
                            <input type="text" class="form-control @error('valor__adiantamento') is-invalid @enderror" name="valor__adiantamento" value="{{old('valor__adiantamento','0,00')}}" id="valor__adiantamento">
                            @error('valor__adiantamento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            
                        <div class="col-12 col-md-6 mt-2">
                            <label for="texto__credito" class="form-label">Texto Crédito</label>
                            <input type="text" class="form-control @error('texto__credito') is-invalid @enderror" name="texto__credito" value="{{old('texto__credito')}}" id="texto__credito" placeholder="Ex: Crédito de compra" maxlength="30"> 
                                  @error('texto__credito')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mt-2">
                            <label for="valor__creditos" class="form-label">Valor Créditos</label>
                            <input type="text" class="form-control @error('valor__creditos') is-invalid @enderror" name="valor__creditos" value="{{old('valor__creditos','0,00')}}" id="valor__creditos">
                                  @error('valor__creditos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="col-12 col-md-6 mt-2">
                            <label for="vencimento" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i>Vencimento</label>
                            <input type="date" class="form-control @error('vencimento') is-invalid @enderror" name="vencimento" value="{{old('vencimento')}}" id="vencimento">
                            @error('vencimento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                                
                        <div class="col-12 col-md-6 mt-2">
                            <label for="competencia" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Competência</label>
                            <input type="month" value="{{old('competencia')}}" class="form-control @error('competencia') is-invalid @enderror" name="competencia"  id="competencia">
                            @error('competencia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
   
                        <div class="div__botao--gerar--fatura d-flex justify-content-end align-items-end">
                            <button type="submit" class="btn botao__calcular" id="campo1">Gerar <i class="fad fa-calculator-alt"></i></button>
                        </div>
                        
                    </section>
                </form>
            </div>
                
                
            <div class="tab-pane fade" id="lista-fatura" role="tabpanel" aria-labelledby="lista-fatura-tab">
                
                <h1 class="title__pagina--padrao">Lista de Faturas <i class="fad fa-calculator"></i></h1>
                
                <section class="section__search d-none">
                    <div class="col-md-5">
                        <form action="" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" value="{{old('pesquisa')}}" list="listapesquisa" name="pesquisa" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="">
                                
                                <button type="submit" class="btn botao__search">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                </button>

                            </div>
                            
                        </form>
                    </div>
                </section>
                
                <section class="section__filtro--fatura row d-none">
                    <form class="row g-3" action="{{route('filtro.pesquisa.fatura')}}" method="POST">
                        @csrf

                        <div class="col-12 col-md-3">
                            <label for="ano" class="form-label">Competência</label>
                            <input type="month" class="form-control @error('ano_inicial1') is-invalid @enderror" name="ano_inicial1" value="" id="tano1">
                        </div>

                        <div class="col-md-2 align-self-center pt-4">
                            <button type="submit" class="btn botao">Filtrar <i class="fad fa-filter"></i></button>
                        </div>
    
                        
                    </form>
                </section>
                    
                        <section class="d-none">
                            <div class="d-flex justify-content-end">
                                <div>
                                    <div class="dropdown">
                                        <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fad fa-sort"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                          <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtro.ordem.fatura','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                          <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtro.ordem.fatura','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                        </ul>
                                      </div>
                                </div>
        
                            </div>
                        </section>


                        <section class="table">
                            <div class="table-responsive-xxl">
                                
                                <table class="table" id="tabela-fatura-lista">
                                    <thead class="tr__header">
                                        <th class="th__header text-nowrap" style="width:60px;">Matrícula</th>
                                        <th class="th__header text-nowrap">Tomador</th>
                                        <th class="th__header text-nowrap">Data inicial</th>
                                        <th class="th__header text-nowrap">Data Final</th>
                                        <th class="th__header text-nowrap" style="width:110px;">Nº Fatura</th>
                                        <th class="th__header text-nowrap" style="width:60px;">Imprimir</th>
                                        <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                    </thead>
                                </table>
                            </div>
                        </section>
                     


            </div>

        </div>
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/fatura/index.js')}}"></script> 

@stop