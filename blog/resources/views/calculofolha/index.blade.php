@extends('layouts.index')
@section('titulo','Cálculo da folha - Rhweb')
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

        <section class="section__botao--padrao">
            
            <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
            </div>
            
            <div class="d-flex justify-content-center align-items-center mx-auto mt-4" role="button" aria-label="Basic example">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    
                    <li class="nav-item pill__item ms-1 mt-1 " role="presentation">
                        <button class="nav-link botao__pill" id="calcula-folha-tab" data-bs-toggle="pill" data-bs-target="#calculaFolha" type="button" role="tab" aria-controls="calculaFolha" aria-selected="true"><i class="icon__color fad fa-calculator-alt"></i> Calcular Folha</button>
                    </li>
                    
                    <li class="nav-item pill__item ms-1 mt-1 pillstop" role="presentation">
                        <button class="nav-link botao__pill" id="lista-tomador-tab" data-bs-toggle="pill" data-bs-target="#lista-tomador" type="button" role="tab" aria-controls="lista-tomador" aria-selected="false"><i class="fad icon__color fa-industry"></i> Lista Tomador</button>
                    </li>
                    
                    <li class="nav-item pill__item ms-1 mt-1 pillstop1" role="presentation">
                        <button class="nav-link botao__pill" id="lista-geral-tab" data-bs-toggle="pill" data-bs-target="#lista-geral" type="button" role="tab" aria-controls="lista-geral" aria-selected="false"><i class="icon__color fad fa-globe"></i> Lista Geral</button>
                    </li>
                    
                </ul>
            </div>
        </section>
        
        

       
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show" id="calculaFolha" role="tabpanel" aria-labelledby="calcula-folha-tab">
                
                <h1 class="title__pagina--padrao">Calcula a Folha <i class="fad fa-calculator"></i></h1>
                
                <section class="section__calcula--folha--pill">
                
                    <form class="row g-3" action="{{route('calculo.folha.store')}}" method="POST">
                        @csrf


                        <div class="col-12 col-md-4">
                              <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Inicial</label>
                              <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="tano">
                              @error('ano_inicial')
                                    <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                                
                        <div class="col-12 col-md-4">
                              <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data Final</label>
                              <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="tanoFinal">
                              @error('ano_final')
                                    <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                            
                        <div class="col-12 col-md-4">
                              <label for="competencia" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Competência</label>
                              <input type="month" class="form-control @error('competencia') is-invalid @enderror" name="competencia" value="" id="competencia">
                              @error('competencia')
                                    <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                            
                        <div class="div__botao-calcular d-flex justify-content-end align-items-end">
                            <button type="submit" class="btn botao__calcular" id="campo1">Calcular <i class="fad fa-calculator-alt"></i></button>
                        </div>
    
                    </form>
                    
                </section>
                
                
            </div>
            
            
                
            <div class="tab-pane fade" id="lista-tomador" role="tabpanel" aria-labelledby="lista-tomador-tab">
                
                <h1 class="title__pagina--padrao">Lista por Tomador <i class="fad fa-industry"></i></h1>
                <form class="row g-3" action="{{route('calculo.folha.tomador.filtro')}}" method="POST">
                <section class="section__lista--tomador--pill">
                    
                    <section class="section__search d-none">
                        <div class="col-md-5">
                            
                                
                                <div class="d-flex">
                                    
                                    <input placeholder="clique ou digite para pesquisar" class="form-control" list="listatomador" name="pesquisa" id="pesquisatomador">
                                    <datalist id="listatomador"></datalist>
    
                                    <input type="hidden" name="codicao" value="">
                                    
                                    <button  class="btn botao__search">
                                        <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                    </button>
    
                                </div>
                                
                            
                        </div>
                    </section>
                    
                    <section class="section__filtro--pill row d-none">
                       
                            @csrf
                                <div class="col-12 col-md-3">
                                    <label for="ano" class="form-label">Competência</label>
                                    <input type="month" class="form-control " name="competencia" id="tano1Final">
                                </div>
    
                                <div class="col-md-2 align-self-center pt-4">
                                    <button type="submit" class="btn botao">Filtrar <i class="fad fa-filter"></i></button>
                                </div>

                        
                    </section>
                    
                    <section class="d-none">
                        <div class="d-flex justify-content-end">
                            <div>
                                <div class="dropdown">
                                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-sort"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.folha.calculo','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.folha.calculo','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                  </div>
                            </div>
    
                        </div>
                    </section>                
    
                    
                    <section class="table">           
                        <div class="table-responsive-xxl">
                            <table class="table" id="table-calculo-folhar-tomador">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:115px;">Código</th>
                                    <th class="th__header text-nowrap">Nome</th>
                                    <th class="th__header text-nowrap" style="width:200px">Data Inicial</th>
                                    <th class="th__header text-nowrap" style="width:200px">Data Final</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Relatórios</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Recibo Geral</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Recibo Trab</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Analítico</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Sefip</th>
                                </thead>
                            </table>
                        </div>
                    </section>
                
                </section>
            </div>

                
            <div class="tab-pane fade" id="lista-geral" role="tabpanel" aria-labelledby="lista-geral-tab">
                
                <h1 class="title__pagina--padrao">Lista Geral <i class="fad fa-globe"></i></h1>
                <form class="row g-3" action="{{route('calculo.folha.geral.filtro')}}" method="POST">
                <section class="section__lista--geral--pill">
                    
                    <section class="section__search d-none">
                        <div class="col-md-5">
                            
                                
                                <div class="d-flex">
                                    
                                    <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="pesquisa" id="search">
                                    <datalist id="listapesquisa"></datalist>
    
                                    <input type="hidden" name="codicao" value="">
                                    
                                    <button  class="btn botao__search">
                                        <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                    </button>
    
                                </div>
                                
                            
                        </div>
                    </section>
                
                    <section class="section__filtro--pill row d-none">
                        
                            @csrf
    
                            <div class="col-12 col-md-3">
                                <label for="ano" class="form-label">Competência</label>
                                <input type="month" class="form-control " name="competencia" id="tano1Final">
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
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.folha.calculo','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtra.folha.calculo','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                  </div>
                            </div>
    
                        </div>
                    </section>
    
                    <section class="table">
                        <div class="table-responsive-xxl">
                           
                            <table class="table" id="table-calculo-folhar">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:120px;">Código da Folha</th>
                                    <th class="th__header text-nowrap" style="width:160px">Data Inicial</th>
                                    <th class="th__header text-nowrap" style="width:160px">Data Final</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Recibo Geral</th>
                                    <th class="th__header text-nowrap" style="width:50px;">s-1200</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Recibo Trab</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Rúbricas</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Depósito</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Analítico</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                            </table>
                        </div>
                    </section>   
                    
                </section>    
            </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/calculoFolha/backPill.js')}}"></script>
<script type="text/javascript" src="{{url('/js/user/calculoFolha/animacao.js')}}"></script>

        @stop