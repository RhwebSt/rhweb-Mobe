@extends('layouts.index')
@section('titulo','Rhweb - Cálculo da folha')
@section('conteine')

<div class="container responsive">
        
        <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
          <li class="nav-item ms-1 mt-1 " role="presentation">
            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="icon__color fad fa-calculator-alt"></i> Cálculo da Folha</button>
          </li>
          <li class="nav-item ms-1 mt-1 pillstop" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="icon__color fad fa-th-list"></i> Lista Tomador</button>
          </li>
          <li class="nav-item ms-1 mt-1 pillstop1" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="icon__color fad fa-th-list"></i> Lista Geral</button>
          </li>
        </ul>
        
        

       
        <div class="tab-content" id="pills-tabContent">
            @if(session('success'))
                <script>
                     
                const Toast = Swal.mixin({
                  toast: true,
                  width: 500,
                  color: '#ffffff',
                  background: '#5AA300',
                  position: 'top-end',
                  showCloseButton: true,
                  showConfirmButton: false,
                  timer: 4000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                
                Toast.fire({
                  icon: 'success',
                  title: '{{session("success")}}'
                })
            </script>
            @endif
            @error('false')
                <script>
                     
                const Toast = Swal.mixin({
                  toast: true,
                  width: 500,
                  color: '#ffffff',
                  background: '#C53230',
                  position: 'top-end',
                  showCloseButton: true,
                  showConfirmButton: false,
                  timer: 4000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                
                Toast.fire({
                  icon: 'error',
                  title: '{{ $message }}'
                })
            </script>
            @enderror
            
            <!--fazer erro para quando não existir nenhum dado para calcular a folha-->
            
            <!--<script>-->
            <!--    Swal.fire({-->
            <!--      icon: 'error',-->
            <!--      title: 'Algo deu errado!',-->
            <!--      text: 'Não possui nenhum dado para fazer o cálculo',-->
            <!--    })-->
            <!--</script>-->
            
            
            
            <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                
                <form class="row g-3" action="{{route('calculo.folha.store')}}" method="POST">
                    @csrf
                
                    <div class="" id="quadro1">
    
                        <div class="data mt-4">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                              <label for="ano" class="form-label">Data Inicial</label>
                              <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="tano">
                              @error('ano_inicial')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                              <label for="ano" class="form-label">Data Final</label>
                              <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="tanoFinal">
                              @error('ano_final')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 mt-3 col-sm-6 col-md-3 col-lg-3">
                              <label for="competencia" class="form-label">Competência</label>
                              <input type="month" class="form-control @error('competencia') is-invalid @enderror" name="competencia" value="" id="competencia">
                              @error('competencia')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                        
                        <div class="mt-5">
                            <button type="submit" class="btn botao" id="campo1">Calcular <i class="fad fa-calculator-alt"></i></button>
                        </div>
                        
                    </div>
                    
                    
                  </form>  
            </div>
                
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form class="row g-3" action="{{route('calculo.folha.tomador.filtro')}}" method="POST">
                    @csrf
                    <div class="container text-start fs-5 fw-bold mt-4">Pesquisar <i class="fas fa-search"></i></div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        
                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                <datalist id="datalistOptions">
                                </datalist>
                                <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                <div class="text-center d-none" id="refres">
                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                        <span class="visually-hidden">Carregando...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                
                    <div class="data mt-4">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                            <label for="ano" class="form-label">Data Inicial</label>
                            <input type="date" class="form-control " name="inicio" value="" id="tano1">
                        </div>
                            
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                            <label for="ano" class="form-label">Data Final</label>
                            <input type="date" class="form-control " name="final" value="" id="tano1Final">
                        </div>
                    </div>
                
                    <div class="mt-3">
                        <button type="submit" class="btn botao filtrar" id="">Filtrar <i class="fad fa-filter"></i></button>
                    </div>
                                    
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
                                            @if($folhar->id === $tomador->folhar)
                                                {{$folhar->fscodigo}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$tomador->tsnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                        {{$tomador->tsnome}}
                                    </td>
                                    <td class="td__body text-nowrap col"style="width:200px">
                                        @foreach($folhas as $folhar)
                                            @if($folhar->id === $tomador->folhar)
                                            <?php
                                                $data = explode('-',$folhar->fsinicio)
                                            ?>
                                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:200px">
                                        @foreach($folhas as $folhar)
                                            @if($folhar->id === $tomador->folhar)
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
                                                <li><a class="dropdown-item modal-botao" href="#"><i class="fas fa-file"></i> Resumo Folha de Pagamento</a></li>
                                                <li><a class="dropdown-item modal-botao" href="#"><i class="fad fa-file-invoice"></i> Resumo Evento s-1270</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        
                                        @foreach($folhas as $folhar)
                                            @if($folhar->id === $tomador->folhar)
                                                <a class="btn btn__imprimir" href="{{route('calculo.folha.tomador.imprimir',[base64_encode($folhar->id),base64_encode($tomador->id)])}}"><i class="icon__color fad fa-print"></i></a>
                                            @endif
                                        @endforeach
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                    
                                        <a class="btn btn__recibo" data-bs-toggle="offcanvas" href="#tomador_trabalhador{{$t}}" role="button" aria-controls="offcanvasExample">
                                          <i class="icon__color fad fa-user"></i>
                                        </a>
                                        
                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="tomador_trabalhador{{$t}}" aria-labelledby="offcanvasExampleLabel">
                                        
                                            <div class="offcanvas-header border border-primary" style="background-image:linear-gradient(220deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel{{$tomador->folhar}}">Imprimir <i class="fal fa-print-search"></i></h5>
                                                <button type="button" class="btn-close bg-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('calculo.folha.tomador.trabalhador.imprimir')}}" method="post">
                                                    @csrf
                                                    
                                            <div class="offcanvas-body" style="background-image:linear-gradient(200deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h1 class="text-white mt-2 mb-4 fs-5">Pesquisar <i class="fas fa-search"></i></h1>
                                                
                                                <div class="d-flex justify-content-between mb-3">
                                                    
                                                    <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                        <div class="d-flex">
                                                        <label for="exampleDataList" class="form-label"></label>
                                                        @foreach($folhas as $folhar)
                                                            @if($folhar->id === $tomador->folhar)
                                                            <input type="hidden" name="folhar" value="{{$folhar->id}}">
                                                            
                                                            @endif
                                                        @endforeach
                                                        <input type="hidden" name="tomador" value="{{$tomador->id}}">
                                                        
                                                        <input type="hidden" name="empresa" value="{{$user->empresa}}">
                                                        <input class="form-control fw-bold text-dark pesquisa" list="listatomador{{$folhar->id}}" name="trabalhador1" id="trabalhador1">
                                                        <datalist id="listatomador{{$folhar->id}}"> 
                                                        @foreach($trabalhadores as $trabalhador)
                                                            @if($trabalhador->folhar === $folhar->id && $folhar->id === $tomador->folhar)
                                                                <option value="{{$trabalhador->tsnome}}">
                                                            @endif
                                                        @endforeach
                                                        </datalist>
                                                        <button type="submit" class="btn botaoPesquisa" id="butao_trabalhador">
                                                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                                                </button>
                                                        <div class="text-center d-none" id="refres" >
                                                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                                <span class="visually-hidden">Carregando...</span>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                
                                                </div>
                                                
                                            </div>
                                            </form>
                                            </div>

                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:50px;">
                                           
                                            @foreach($folhas as $folhar)
                                                @if($folhar->id === $tomador->folhar)
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
                                            @if($folhar->id === $tomador->folhar)
                                                <a href="{{route('gera.txt.sefip',[base64_encode($tomador->id),base64_encode($folhar->id)])}}" class="btn btn__sefip $dias">
                                                    <i class="icon__color fad fa-file-alt"></i>
                                                </a>
                                            @endif
                                        @endforeach
                                            
                                    </td>
                                    
                                </tr>
                                @endforeach
                                @else
                                <tr class="tr__body">
                                    <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
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
            </div>

                
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <form class="row g-3" action="{{route('calculo.folha.geral.filtro')}}" method="POST">
                @csrf
                
                    <div class="container text-start fs-5 fw-bold mt-4">Pesquisar <i class="fas fa-search"></i></div>
                
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                <datalist id="datalistOptions">
                                </datalist>
                                <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                <div class="text-center d-none" id="refres">
                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                        <span class="visually-hidden">Carregando...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    </div>
        
                    <div class="data mt-4">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                          <label for="ano" class="form-label">Data Inicial</label>
                          <input type="date" class="form-control " name="inicio" value="" id="tano2">
                        </div>
                            
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                          <label for="ano" class="form-label">Data Final</label>
                          <input type="date" class="form-control " name="final" value="" id="tano2Final">
                        </div>
                    </div>
        
                    <div class="mt-3">
                        <button type="submit" class="btn botao filtrar" id="">Filtrar <i class="fas fa-filter"></i></button>
                    </div>
                            
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
                                            
                                            <div class="offcanvas-header border border-primary" style="background-image:linear-gradient(220deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel1">Imprimir <i class="fal fa-print-search"></i></h5>
                                                <button type="button" class="btn-close bg-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            
                                            <form action="{{route('calculo.folha.trabalhador.imprimir')}}" method="post">
                                                @csrf
                                                <div class="offcanvas-body">
                                                    <h1 class="text-white mt-2 mb-4 fs-5">Pesquisar <i class="fas fa-search"></i></h1>
                                                    
                                                    <div class="d-flex justify-content-between mb-3">
                                                        
                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                <input type="hidden" name="folhar" value="{{$folhar->id}}">
                                                                <input type="hidden" name="empresa" value="{{$user->empresa}}">
                                                                <input type="text" class="form-control fw-bold text-dark trabalhador" name="trabalhador"  list="lista{{$folhar->id}}">
                                                            
                                                                <datalist id="lista{{$folhar->id}}">
                                                                    @foreach($trabalhadores as $trabalhador)
                                                                        @if($trabalhador->folhar === $folhar->id)
                                                                            <option value="{{$trabalhador->tsnome}}">
                                                                        @endif
                                                                    @endforeach
                                                                </datalist>
                                                                <button type="submit" class="btn botaoPesquisa" id="butao_trabalhador">
                                                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                                                </button>
                                                                
                                                                <div class="text-center d-none" id="refres" >
                                                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                                        <span class="visually-hidden">Carregando...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                            
                                            <div class="offcanvas-header border border-primary" style="background-image:linear-gradient(220deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel1">Rùbrica <i class="fas fa-file-signature"></i></h5>
                                                <button type="button" class="btn-close bg-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            
                                            <form action="{{route('calculo.folha.rublica.imprimir')}}" method="post">
                                                @csrf
                                                <div class="offcanvas-body">
                                                    <h1 class="text-white mt-2 mb-4 fs-5">Pesquisar Rúbrica <i class="fas fa-search"></i></h1>
                                                    
                                                    <div class="d-flex justify-content-between mb-3">
                                                        
                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <input type="hidden" name="folharublica" value="{{$folhar->id}}">
                                                                <input type="hidden" name="empresarublica" value="{{$user->empresa}}">
                                                                <input type="hidden" name="inicio" value="{{$folhar->fsinicio}}">
                                                                <input type="hidden" name="final" value="{{$folhar->fsfinal}}">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                <input class="form-control fw-bold text-dark pesquisarublica" list="listarublica{{$folhar->fscodigo}}" data-id="{{$folhar->fscodigo}}" name="rublica" id="">
                                                                <datalist id="listarublica{{$folhar->fscodigo}}">
                                                                   
                                                                </datalist>
                                                                <button type="submit" id="butao_trabalhador" class="btn botaoPesquisa">
                                                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                                                </button>
                                                                <div class="text-center d-none" id="refres" >
                                                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                                        <span class="visually-hidden">Carregando...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                            
                                            <div class="offcanvas-header border border-primary" style="background-image:linear-gradient(220deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel1">Imprimir <i class="fal fa-file-invoice-dollar"></i></h5>
                                                <button type="button" class="btn-close bg-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            
                                            <form action="{{route('calculo.folha.banco.imprimir')}}" method="post">
                                                @csrf
                                                <div class="offcanvas-body">
                                                    <h1 class="text-white mt-2 mb-4 fs-5">Pesquisar Banco <i class="fas fa-search"></i></h1>
                                                    
                                                    <div class="d-flex justify-content-between mb-3">
                                                        
                                                        <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                            <div class="d-flex">
                                                                <input type="hidden" name="folharbanco" value="{{$folhar->id}}">
                                                                <input type="hidden" name="empresabanco" value="{{$user->empresa}}">
                                                                <label for="exampleDataList" class="form-label"></label>
                                                                <input class="form-control fw-bold text-dark banco" list="listabanco{{$folhar->id}}" name="banco" id="pesquisa">
                                                                <datalist id="listabanco{{$folhar->id}}">
                                                                   
                                                                </datalist>
                                                                <button type="submit" id="butao_trabalhador" class="btn botaoPesquisa">
                                                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                                                </button>
                                                                <div class="text-center d-none" id="refres" >
                                                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                                        <span class="visually-hidden">Carregando...</span>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                    
                                        <a href="{{route('calculo.folha.deletar',$folhar->id)}}" class="btn button__excluir"><i class="icon__color fad fa-trash"></i></a>
                                 
                                    </td>
                                        
                                </tr>
                                @endforeach
                                @else
                                <tr class="tr__body">
                                    <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
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
                    
                    
            </div>
        </div>
</div>
        
        
        
<script>
        
    function validaInputQuantidade(idCampo,QuantidadeCarcteres){
        var telefone = document.querySelector(idCampo);

        telefone.addEventListener('input', function(){
            var telefone = document.querySelector(idCampo);
            var result = telefone.value;
            if(result > " " && result.length >= QuantidadeCarcteres){
              telefone.classList.add('is-valid');  
            }else{
                telefone.classList.remove('is-valid');
            }
             
        });
    }
    
    var tano = validaInputQuantidade("#tano",8);
    var tanoFinal = validaInputQuantidade("#tanoFinal",8);
    var competencia = validaInputQuantidade("#competencia",1);
    var tano1 = validaInputQuantidade("#tano1",8);
    var tano1Final = validaInputQuantidade("#tano1Final",8);
    var tano2 = validaInputQuantidade("#tano2",8);
    var tano2Final = validaInputQuantidade("#tano2Final",8);
    var tano = validaInputQuantidade("#tano",8);
    var tano = validaInputQuantidade("#tano",8);
    var tano = validaInputQuantidade("#tano",8);
    var tano = validaInputQuantidade("#tano",8);

    


    var Back = document.getElementById('pills-home-tab');
    Back.addEventListener("click", function(){
       localStorage.setItem('Back', 'backpill1');
       
   })
   
   var Back1 = document.getElementById('pills-contact-tab');
    Back1.addEventListener("click", function(){
       localStorage.setItem('Back', 'backpill3');
       
   })
   
   var Back2 = document.getElementById('pills-profile-tab');
    Back2.addEventListener("click", function(){
       localStorage.setItem('Back', 'backpill2');
       
   })
   
   backActive =  document.getElementById("pills-profile");
   backActive1 =  document.getElementById("pills-home");
   backActive2 =  document.getElementById("pills-contact");

    voltar = localStorage.getItem("Back");

    
    if(voltar === null){
        localStorage.setItem('Back', 'backpill1');
        Back.classList.add("active");
        backActive1.classList.add("show", "active");
        backActive.classList.remove("show", "active");
        backActive2.classList.remove("show", "active");
        document.getElementById("pills-home-tab").click();
    }

    if(voltar === "backpill1"){
        Back.classList.add("active");
        backActive1.classList.add("show", "active");
        backActive.classList.remove("show", "active");
        backActive2.classList.remove("show", "active");
        document.getElementById("pills-home-tab").click();
        

    }else if (voltar === "backpill2"){
        Back2.classList.add("active");
        backActive.classList.add("show", "active");
        backActive1.classList.remove("show", "active");
        backActive2.classList.remove("show", "active");
        document.getElementById("pills-profile-tab").click();

        
    }else if (voltar === "backpill3"){
        Back1.classList.add("active");
        backActive2.classList.add("show", "active");
        backActive.classList.remove("show", "active");
        backActive1.classList.remove("show", "active");
        document.getElementById("pills-contact-tab").click();

    }    

</script>
        
        
        
        
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="formdelete" method="post">
                            <div class="modal-header modal__delete">
                                <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body modal-delbody">
                                <p class="mb-1">Deseja realmente excluir?</p>
                            </div>
                            <div class="modal-footer modal-delfooter">
                                <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn__deletar">Deletar</button>
                            </div>
                    </form>
                </div>
            </div>
         </div>
         
         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" id="formdelete" method="post">
                            <div class="modal-header modal__delete">
                                <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body modal-delbody">
                                <p class="mb-1">Deseja realmente excluir?</p>
                            </div>
                            <div class="modal-footer modal-delfooter">
                                <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn__deletar">Deletar</button>
                            </div>
                    </form>
                </div>
            </div>
         </div>
         
         
        <script>
            $(document).ready(function(){
                $('#campo1').click(function() {
                    $('#quadro1').addClass('d-none')
                    $('#quadro2').removeClass('d-none')
                })
                $('#campo_nao_2').click(function() {
                    $('#quadro2').addClass('d-none')
                    $('#quadro1').removeClass('d-none')
                })
                $('.banco').on('keyup',function () {
                    let dados = $(this).val()
                    let datalist = $(this).next().attr('id')
                    $.ajax({
                        url: "https://brasilapi.com.br/api/banks/v1/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            $(`#${datalist}`).html(`<option value="${data.code} - ${data.name}">`)
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
                            if(data.length === 1 && dados.length >= 2){
                                $('#tomador').val(data[0].tomador)
                            }
                        }
                    })
                })
            })
        </script>
        @stop