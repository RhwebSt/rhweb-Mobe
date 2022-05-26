@extends('layouts.index')
@section('titulo','Rhweb - Cálculo da folha')
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
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--      icon: 'error',-->
        <!--      allowOutsideClick: false,-->
        <!--      allowEscapeKey: false,-->
        <!--      allowEnterKey: true,-->
        <!--      html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+-->
        <!--      '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+-->
        <!--      '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',-->
        <!--      showConfirmButton: false,-->
        <!--    });-->
        <!--</script>-->
        <!--Fim do modal de Acesso não permitido-->

        <!--Modal de não permitido para o Editar, relatorio, excluir e outros botoes-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--        icon: 'error',-->
        <!--        title: 'Você não tem Permissão',-->
        <!--        text: 'Contate seu Administrador para receber acesso.',-->
        <!--        allowOutsideClick: false,-->
        <!--        allowEscapeKey: false,-->
        <!--        allowEnterKey: true,-->
        <!--    });-->
        <!--</script>-->
        <!--fim do modal-->
        
        <section class="section__botoes--calculo-folha">
            
            <div class="d-flex justify-content-start align-items-start div__voltar">
                <a class="botao__voltar" href="{{route('home.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
            </div>
            
            <div class="d-flex justify-content-center align-items-center mx-auto mt-4" role="button" aria-label="Basic example">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    
                    <li class="nav-item pill__item ms-1 mt-1 " role="presentation">
                        <button class="nav-link botao__pill" id="calcula-folha-tab" data-bs-toggle="pill" data-bs-target="#calculaFolha" type="button" role="tab" aria-controls="calculaFolha" aria-selected="true"><i class="icon__color fad fa-calculator-alt"></i> Cálculo da Folha</button>
                    </li>
                    
                    <li class="nav-item pill__item ms-1 mt-1 pillstop" role="presentation">
                        <button class="nav-link botao__pill" id="lista-tomador-tab" data-bs-toggle="pill" data-bs-target="#lista-tomador" type="button" role="tab" aria-controls="lista-tomador" aria-selected="false"><i class="icon__color fad fa-th-list"></i> Lista Tomador</button>
                    </li>
                    
                    <li class="nav-item pill__item ms-1 mt-1 pillstop1" role="presentation">
                        <button class="nav-link botao__pill" id="lista-geral-tab" data-bs-toggle="pill" data-bs-target="#lista-geral" type="button" role="tab" aria-controls="lista-geral" aria-selected="false"><i class="icon__color fad fa-th-list"></i> Lista Geral</button>
                    </li>
                    
                </ul>
            </div>
        </section>
        
        

       
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show" id="calculaFolha" role="tabpanel" aria-labelledby="calcula-folha-tab">
                
                <h1 class="title__calculo-folha">Calcula a Folha <i class="fad fa-calculator"></i></h1>
                
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
                
                <h1 class="title__calculo-folha">Lista por Tomador <i class="fad fa-industry"></i></h1>
                <form class="row g-3" action="{{route('calculo.folha.tomador.filtro')}}" method="POST">
                <section class="section__lista--tomador--pill">
                    
                    <section class="section__search">
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
                    
                    <section class="section__filtro--pill row">
                       
                            @csrf
                                <div class="col-12 col-md-3">
                                    <label for="ano" class="form-label">Competência</label>
                                    <input type="month" class="form-control " name="competencia" id="tano1Final">
                                </div>
    
                                <div class="col-md-2 align-self-center pt-4">
                                    <button type="submit" class="btn botao">Filtrar <i class="fad fa-filter"></i></button>
                                </div>

                        
                    </section>
                    
                    <section>
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
                            <table class="table">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:115px;">Código</th>
                                    <th class="th__header text-nowrap">Nome</th>
                                    <th class="th__header text-nowrap" style="width:200px">Data Inicial</th>
                                    <th class="th__header text-nowrap" style="width:200px">Data Final</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Relatórios</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Imprimir</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Recibo</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Analítico</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Sefip</th>
                                </thead>
                                
                                <tbody class="table__body">
                                    @if(count($tomadores) > 0)
                                    @foreach($tomadores as $t => $tomador)
                                    <tr class="tr__body">               
                                        <td class="td__body text-nowrap col" style="width:115px;">
                                            @foreach($folhas as $folhar)
                                                @if($folhar->id === $tomador->folhar_id)
                                                    {{$folhar->fscodigo}}
                                                @endif
                                            @endforeach
                                        </td>
                                        
                                        <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$tomador->tsnome}}">
                                            {{$tomador->tsnome}}
                                        </td>
                                        
                                        <td class="td__body text-nowrap col"style="width:200px">
                                            @foreach($folhas as $folhar)
                                                @if($folhar->id === $tomador->folhar_id)
                                                <?php
                                                    $data = explode('-',$folhar->fsinicio)
                                                ?>
                                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                                @endif
                                            @endforeach
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:200px">
                                            @foreach($folhas as $folhar)
                                                @if($folhar->id === $tomador->folhar_id)
                                                <?php
                                                    $data = explode('-',$folhar->fsfinal)
                                                ?>
                                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                                @endif
                                            @endforeach
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            <div class="dropdown">
                                                <button class="btn btn__relatorio modal-botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icon__color fas fa-file-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item modal-botao" href="{{route('folhar.tomador.resumo.pagamento',[base64_encode($tomador->id),base64_encode($folhar->id)])}}"><i class="fas fa-file"></i> Resumo Folha de Pagamento</a></li>
                                                    <li><a class="dropdown-item modal-botao" href="{{route('folhar.tomador.evento.1270',[base64_encode($tomador->id),base64_encode($folhar->id)])}}"><i class="fad fa-file-invoice"></i> Resumo Evento s-1270</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            
                                            @foreach($folhas as $folhar)
                                                @if($folhar->id === $tomador->folhar_id)
                                                    <a class="btn btn__imprimir" href="{{route('calculo.folha.tomador.imprimir',[base64_encode($folhar->id),base64_encode($tomador->id)])}}"><i class="icon__color fad fa-print"></i></a>
                                                @endif
                                            @endforeach
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                        
                                            <a class="btn btn__recibo" data-bs-toggle="offcanvas" href="#tomador_trabalhador{{$t}}" role="button" aria-controls="offcanvasExample">
                                              <i class="icon__color fad fa-user"></i>
                                            </a>
                                            
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="tomador_trabalhador{{$t}}" aria-labelledby="offcanvasExampleLabel">
                                            
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel{{$tomador->folhar_id}}"><i class="fad fa-file-alt"></i> Recibo por Trabalhador</h5>
                                                    <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                                                </div>
                                                
                                                <form action="{{route('calculo.folha.tomador.trabalhador.imprimir')}}" method="post">
                                                    @csrf
                                                        
                                                    <div class="offcanvas-body off__canvas--body">
                                                        
                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                @foreach($folhas as $folhar)
                                                                    @if($folhar->id === $tomador->folhar_id)
                                                                    <input type="hidden" name="folhar" value="{{$folhar->id}}">
                                                                    
                                                                    @endif
                                                                @endforeach
                                                                <input type="hidden" name="tomador" value="{{$tomador->id}}">
                                                                
                                                                <input type="hidden" name="empresa" value="{{$user->empresa_id}}">
                                                                <input class="form-control pesquisa" list="listatomador{{$folhar->id}}" name="trabalhador" id="trabalhador1" placeholder="duplo clique para pesquisar">
                                                                <datalist id="listatomador{{$folhar->id}}"> 
                                                                @foreach($trabalhadores as $trabalhador)
                                                                    @if($trabalhador->folhar_id === $folhar->id && $folhar->id === $tomador->folhar_id)
                                                                        <option value="{{$trabalhador->tsnome}}">
                                                                            
                                                                    @endif
                                                                @endforeach
                                                                </datalist>
                                                                
                                                                <button type="submit" class="btn botao__search" id="butao_trabalhador">
                                                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                                                </button>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
    
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:50px;">
                                               
                                                @foreach($folhas as $folhar)
                                                    @if($folhar->id === $tomador->folhar_id)
                                                    <a class="btn btn__analitico" href="{{route('tomador.calculo.folha.analitica',[$folhar->id,$tomador->id])}}">
                                                        <i class="icon__color fad fa-analytics"></i>
                                                    </a>
                                                    @endif
                                                @endforeach
                                            </td>
                                           
                                        <td class="td__body text-nowrap col" style="width:50px;">
                                            <?php
                                                $diferenca = strtotime($folhar->fsinicio) - strtotime($folhar->fsfinal);
                                                $dias = floor($diferenca / (60 * 60 * 24)); 
                                                if ($dias <= 15) {
                                                    $dias = 'disabled';
                                                }else{
                                                    $dias = '';
                                                }
                                            ?>
                                            @foreach($folhas as $folhar)
                                                @if($folhar->id === $tomador->folhar_id)
                                                    <a href="{{route('gera.txt.sefip',[base64_encode($tomador->id),base64_encode($folhar->id),base64_encode($user->empresa_id)])}}" class="btn btn__sefip $dias">
                                                        <i class="icon__color fad fa-file-alt"></i>
                                                    </a>
                                                @endif
                                            @endforeach
                                                
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="tr__body">
                                        <td colspan="11" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="">
                                        <td colspan="11">
                                            
                                        </td>
                                    </tr>
                                </tfoot>
                    
                            </table>
                        </div>
                    </section>
                
                </section>
            </div>

                
            <div class="tab-pane fade" id="lista-geral" role="tabpanel" aria-labelledby="lista-geral-tab">
                
                <h1 class="title__calculo-folha">Lista Geral <i class="fad fa-globe"></i></h1>
                <form class="row g-3" action="{{route('calculo.folha.geral.filtro')}}" method="POST">
                <section class="section__lista--geral--pill">
                    
                    <section class="section__search">
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
                
                    <section class="section__filtro--pill row">
                        
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
                    
                    <section>
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
                            <table class="table">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:120px;">Código da Folha</th>
                                    <th class="th__header text-nowrap" style="width:160px">Data Inicial</th>
                                    <th class="th__header text-nowrap" style="width:160px">Data Final</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Imprimir</th>
                                    <th class="th__header text-nowrap" style="width:50px;">s-1270</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Recibo</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Rúbricas</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Depósito</th>
                                    <th class="th__header text-nowrap" style="width:50px;">Analítico</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                
                                <tbody class="table__body">
                                @if(count($folhas) > 0)
                                    @foreach($folhas as $folhar)
                                    <tr class="tr__body">               
                                        <td class="td__body text-nowrap col" style="width:120px;">{{$folhar->fscodigo}}</td>
                                        
                                        <td class="td__body text-nowrap col"style="width:160px">
                                            <?php
                                                $data = explode('-',$folhar->fsinicio)
                                            ?>
                                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
        
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:160px">
                                            <?php
                                                $data = explode('-',$folhar->fsfinal)
                                            ?>
                                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:50px;">
                                            <a class="btn btn__imprimir" href="{{route('calculo.folha.imprimir',$folhar->id)}}"><i class="icon__color fad fa-print"></i></a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:50px;">
                                            <a class="btn btn__evento" href=""><i class="icon__color fas fa-file-invoice"></i></a>
                                        </td>
                                                
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            
                                            <a class="btn btn__recibo" data-bs-toggle="offcanvas" href="#offcanvasExample1{{$folhar->id}}" role="button" aria-controls="offcanvasExample1">
                                                <i  class="icon__color fad fa-user"></i>
                                            </a>
    
                                            
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample1{{$folhar->id}}" aria-labelledby="offcanvasExampleLabel1">
                                                
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel1"><i class="fad fa-file-alt"></i> Recibo por Trabalhador</h5>
                                                    <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                                                </div>
                                                
                                                <form action="{{route('calculo.folha.trabalhador.imprimir')}}" method="post">
                                                    @csrf
                                                    <div class="offcanvas-body off__canvas--body">
                                                        
                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                <input type="hidden" name="folhar" value="{{$folhar->id}}">
                                                                <input type="hidden" name="empresa" value="{{$user->empresa_id}}">
                                                                <input type="text" class="form-control trabalhador" name="trabalhador"   list="lista{{$folhar->id}}" placeholder="duplo clique para pesquisar">
                                                                
                                                                <datalist id="lista{{$folhar->id}}">
                                                                    @foreach($trabalhadores as $trabalhador)
                                                                        @if($trabalhador->folhar_id === $folhar->id)
                                                                            <option value="{{$trabalhador->tsnome}}">
                                                                        @endif
                                                                    @endforeach
                                                                </datalist>
                                                                
                                                                <button type="submit" class="btn botao__search" id="butao_trabalhador">
                                                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                                                </button>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </td>
                                                
                                                
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            
                                            <a class="btn btn__rubricas" data-bs-toggle="offcanvas" href="#rublica{{$folhar->id}}" role="button" aria-controls="rublica">
                                                <i class="icon__color fad fa-file-invoice"></i>
                                            </a>
                                            
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="rublica{{$folhar->id}}" aria-labelledby="offcanvasExampleLabel2">
                                                
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel1"><i class="fad fa-file-edit"></i> Rúbricas</h5>
                                                    <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                                                </div>
                                                
                                                <form action="{{route('calculo.folha.rublica.imprimir')}}" method="post">
                                                    @csrf
                                                    <div class="offcanvas-body off__canvas--body">

                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <input type="hidden" name="folharublica" value="{{$folhar->id}}">
                                                                <input type="hidden" name="empresarublica" value="{{$user->empresa_id}}">
                                                                <input type="hidden" name="inicio" value="{{$folhar->fsinicio}}">
                                                                <input type="hidden" name="final" value="{{$folhar->fsfinal}}">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                <input class="form-control pesquisarublica" list="listarublica{{$folhar->fscodigo}}" data-id="{{$folhar->fscodigo}}" name="rublica" id="" placeholder="duplo clique para pesquisar">
                                                                <datalist id="listarublica{{$folhar->fscodigo}}"></datalist>
                                                                
                                                                <button type="submit" class="btn botao__search">
                                                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                                                </button>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </td>
                                                
            
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            
                                            <a class="btn btn__deposito" data-bs-toggle="offcanvas" href="#banco{{$folhar->id}}" role="button" aria-controls="banco">
                                                <i class="icon__color fad fa-envelope-open-dollar"></i>
                                            </a>
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="banco{{$folhar->id}}" aria-labelledby="offcanvasExampleLabel2">
                                                
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel1"><i class="fad fa-file-invoice-dollar"></i> Depósito por Banco</h5>
                                                    <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                                                </div>
                                                
                                                <form action="{{route('calculo.folha.banco.imprimir')}}" method="post">
                                                    @csrf
                                                    <div class="offcanvas-body off__canvas--body">

                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <input type="hidden" name="folharbanco" value="{{$folhar->id}}">
                                                                <input type="hidden" name="empresabanco" value="{{$user->empresa_id}}">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                <input class="form-control banco" list="listabanco{{$folhar->id}}" name="banco" id="pesquisa" placeholder="duplo clique para pesquisar">
                                                                <datalist id="listabanco{{$folhar->id}}"></datalist>
                                                                
                                                                <button type="submit" class="btn botao__search">
                                                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                                                </button>

                                                            </div>
                                                        </div>
                     
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </td>
                                                
                                        <td class="td__body text-nowrap col" style="width:50px;">
                                            <a href="{{route('calculo.folha.analitica',$folhar->id)}}" class="btn btn__analitico">
                                                <i class="icon__color fad fa-analytics"></i>
                                            </a>
                                        </td>
                                                
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            <!--{{route('calculo.folha.deletar',$folhar->id)}}-->
                                            
                                            <a href="" class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteCalculoFolha{{$folhar->id}}"><i class="icon__color fad fa-trash"></i></a>
                                            <section class="delete__tabela--calculoFolha">
                                                <div class="modal fade" id="deleteCalculoFolha{{$folhar->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered col-8">
                                                        <div class="modal-content">
                                                            <form action="{{route('calculo.folha.deletar',$folhar->id)}}" id="formdelete" method="get">
                                                                
                                                                <div class="modal-header header__modal">
                                                                    <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                                                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                </div>
                                                                
                                                                <div class="modal-body body__modal ">
                                                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                                                            <img class="gif__warning--delete" src="{{url('imagem/warning.gif')}}">
                                                                        
                                                                            <p class="content--deletar">Deseja realmente excluir?</p>
                                                                            
                                                                            <p class="content--deletar2">Obs: A exclusão pode afetar em outros cálculos.</p>
                                                                            
                                                                        </div>
                                                                </div>
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                                                                    <button type="submit" class="btn botao__deletar--modal"><i class="fad fa-trash"></i> Deletar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                     
                                        </td>
                                            
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="tr__body">
                                        <td colspan="11" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                    </tr>
                                    @endif
                                </tbody>
                                
                                <tfoot>
                                    <tr class="">
                                        <td colspan="11">
                                            
                                        </td>
                                    </tr>
                                </tfoot>
                    
                            </table>
                                
                        </div>
                    </section>   
                    
                </section>    
            </div>
        </div>
    </div>
</main>

        

        
<script>
            $(document).ready(function(){
                // $('#campo1').click(function() {
                //     $('#quadro1').addClass('d-none')
                //     $('#quadro2').removeClass('d-none')
                // })
                // $('#campo_nao_2').click(function() {
                //     $('#quadro2').addClass('d-none')
                //     $('#quadro1').removeClass('d-none')
                // })
               
                $('.banco').on('focus keyup',function () {
                    let datalist = $(this).next().attr('id')
                    $.ajax({
                        url: "https://brasilapi.com.br/api/banks/v1",
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            let nome = ''
                            data.forEach(element => {
                                nome += `<option value="${element.code} - ${element.fullName}">`
                            });
                            $(`#${datalist}`).html(nome)
                        },
                        error: function(data){
                            // $("#banco").addClass('is-invalid')
                            // $('#menssagem-banco').text(data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
                        }
                    })
                   
                })
                $('.pesquisarublica').on('focus keyup',function() {
                    let dados = 0;
                    if ($(this).val()) {
                        dados = $(this).val()
                    }
                    // console.log($(this).attr('data-id'));
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: "{{url('rublica/pesquisa')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        async:false,
                        success: function(data) {
                           
                            let nome = ''
                            if (data.length >= 1) {
                                data.forEach(element => {
                                nome += `<option value="${element.rsdescricao}">`
                                // nome += `<option value="${element.rsrublica}">`
                                });
                            $(`#listarublica${id}`).html(nome)
                            // $(this).next().html(nome)
                            }
                            // if(data.length === 1 && dados.length >= 4){
                            //     buscaItem(dados)
                            // }
                        }
                    })
                })
                $('#pesquisatrabalhador').on('keyup focus',function () {
                    let dados = 0;
                    if ($(this).val()) {
                        dados = $(this).val()
                    }
                    $.ajax({
                        url: "{{url('trabalhador')}}/pesquisa/"+dados, 
                        type: 'get',
                        contentType: 'application/json', 
                        success: function(data) {
                            let nome = ''
                            if (data.length >= 1) {
                                data.forEach(element => {
                                nome += `<option value="${element.tsnome}">`
                                        // nome += `<option value="${element.tsmatricula}">`
                                        // nome += `<option value="${element.tscnpj}">`
                                });
                                $('#listatrabalhador').html(nome)
                            } 
                            if(data.length === 1 && dados.length >= 2){
                                $('#trabalhador').val(data[0].id)
                            }
                        }
                    })
                })
                $('#pesquisatomador').on('keyup focus',function () {
                    let dados = 0;
                    if ($(this).val()) {
                        dados = $(this).val()
                    }
                    $.ajax({
                        url: "{{url('tomador')}}/pesquisa/"+dados, 
                        type: 'get',
                        contentType: 'application/json', 
                        success: function(data) {
                            let nome = ''
                            if (data.length >= 1) {
                                data.forEach(element => {
                                nome += `<option value="${element.tsnome}">`
                                        // nome += `<option value="${element.tsmatricula}">`
                                        // nome += `<option value="${element.tscnpj}">`
                                });
                                $('#listatomador').html(nome)
                            } 
                            if(data.length === 1){
                                $('#tomador').val(data[0].tomador)
                            }
                        }
                    })
                })
            })
        </script>
        
<script>

    // está função e para gravar o ultimo botao pill que o usuario clicou
    // para que quando renderizar ele volte no mesmo lugar
    function activePill(){
        var Back = document.getElementById('calcula-folha-tab');
            Back.addEventListener("click", function(){
            localStorage.setItem('Back', 'backpill1');
           
       })
       
         var Back1 = document.getElementById('lista-geral-tab');
            Back1.addEventListener("click", function(){
            localStorage.setItem('Back', 'backpill3');
           
       })
       
        var Back2 = document.getElementById('lista-tomador-tab');
            Back2.addEventListener("click", function(){
            localStorage.setItem('Back', 'backpill2');
           
       })
       
       backActive =  document.getElementById("lista-tomador");
       backActive1 =  document.getElementById("calculaFolha");
       backActive2 =  document.getElementById("lista-geral");
    
        voltar = localStorage.getItem("Back");
    
        
        if(voltar === null){
            localStorage.setItem('Back', 'backpill1');
            Back.classList.add("active");
            backActive1.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("calcula-folha-tab").click();
        }
    
        if(voltar === "backpill1"){
            Back.classList.add("active");
            backActive1.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("calcula-folha-tab").click();
            
    
        }else if (voltar === "backpill2"){
            Back2.classList.add("active");
            backActive.classList.add("show", "active");
            backActive1.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("lista-tomador-tab").click();
    
            
        }else if (voltar === "backpill3"){
            Back1.classList.add("active");
            backActive2.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive1.classList.remove("show", "active");
            document.getElementById("lista-geral-tab").click();
    
        }
    }
    
    activePill();

</script>

         
         
       
        @stop