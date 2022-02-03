@extends('layouts.index')
@section('conteine')

<div class="container responsive">
        
        <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
          <li class="nav-item ms-2 " role="presentation">
            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white;"><i class="fad fa-calculator-alt"></i> Cálculo da Folha</button>
          </li>
          <li class="nav-item ms-1 pillstop" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white;"><i class="fas fa-list"></i> Lista Tomador</button>
          </li>
          <li class="nav-item ms-1 pillstop1" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" style="color: white;">Lista Geral <i class="fad fa-th-list"></i></button>
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
                              <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="tano">
                              @error('ano_final')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn botao" id="campo1">Calcular <i class="fad fa-calculator-alt"></i></button>
                        </div>
                    </div>
                    
                    
                  </form>  
                </div>
                
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form class="row g-3" action="" method="POST">
                        @csrf
                        <div class="container text-start fs-4 fw-bold mt-4 mb-3">Pesquisar <i class="fas fa-search"></i></div>
                    
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
                                  <input type="date" class="form-control " name="ano_inicial1" value="" id="tano1">
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                  <label for="ano" class="form-label">Data Final</label>
                                  <input type="date" class="form-control " name="ano_final1" value="" id="tano1">
                                </div>
                            </div>
        
                            <div class="mt-3">
                                <a class="btn botao filtrar" id="">Filtrar <i class="fas fa-filter"></i></a>
                            </div>
                            
                            
        
                        <div class="d-flex justify-content-end">
        
        
                            <div class="dropdown  mt-2 p-1">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">
                                    <i class="fas fa-sort"></i> Filtro 
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-history"></i> Mais Recente</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-numeric-down-alt"></i> Mais Antigo</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-up"></i> Ordem Decrescente</a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="table-responsive-lg">
                            <table class="table border-bottom text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    <th class="col text-center border-top border-start text-nowrap" style="width:115px;">Código da Folha</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 450px;">Nome</th>
                                    <th class="col text-center border-top text-nowrap " style="width:200px">Data Inicial</th>
                                    <th class="col text-center border-top text-nowrap" style="width:200px">Data Final</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">Imprimir</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">Trabalhador</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">
                                   
                                    <tr>               
                                        <td class="col text-center border-bottom border-start text-nowrap" style="width:115px;"></td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 450px;"></td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:200px"></td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:200px"></td>                           
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                            <button class="btn" style="background-color:#28117A; border: 1px solid #8268DE;">
                                            <a href="" class="" ><i class="fal fa-print" style="color: white;"></i></a>
                                            </button>
                                        </td>
                                        
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                            
                                            <a class="btn botao" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" style="background-color: #2866EB; border: 1px solid #A1BCF7;">
                                              <i class="fal fa-print-search"></i>
                                            </a>
                                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                              <div class="offcanvas-header border border-primary" style="background-image:linear-gradient(220deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Imprimir <i class="fal fa-print-search"></i></h5>
                                                <button type="button" class="btn-close bg-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                              </div>
                                              <div class="offcanvas-body" style="background-image:linear-gradient(200deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                                <h1 class="text-white mt-2 mb-4 fs-5">Pesquisar <i class="fas fa-search"></i></h1>
                                                
                                                <div class="d-flex justify-content-between mb-3">
                                                    
                                                    <div class="col-md-12 col-12 mt-2 p-1 pesquisar">
                                                        <div class="d-flex">
                                                        <label for="exampleDataList" class="form-label"></label>
                                                        <input class="form-control fw-bold text-dark pesquisa" list="lista" name="pesquisa" id="pesquisa">
                                                        <datalist id="datalistOptions"> 
                                                            <option value="logo">
                                                        </datalist>
                                                        <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                                        <div class="text-center d-none" id="refres" >
                                                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                                <span class="visually-hidden">Carregando...</span>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                
                                                </div>
                                                
                                              </div>
                                            </div>
                                            
                                        </td>
                                        <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                           <form action=""  method="post">
                                                <button type="submit" class="btn" style="background-color:#FF331F; border: 1px solid #E5767D;"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
                                            </form> 
                                            </td>
                                        </td>
                                    </tr>
                                    
                                <tr>
                                    <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                        <div class="alert" role="alert" style="background-color: #CC2836;">
                                            Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                
                            </table>
                        </div>

                    </form>
                </div> 
                
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <form class="row g-3" action="" method="POST">
                        @csrf
                    </form>
                    <div class="container text-start fs-4 fw-bold mt-4 mb-3">Pesquisar <i class="fas fa-search"></i></div>
                
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
                                  <input type="date" class="form-control " name="ano_inicial2" value="" id="tano2">
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                  <label for="ano" class="form-label">Data Final</label>
                                  <input type="date" class="form-control " name="ano_final2" value="" id="tano2">
                                </div>
                            </div>
        
                            <div class="mt-3">
                                <a class="btn botao filtrar" id="">Filtrar <i class="fas fa-filter"></i></a>
                            </div>
                            
                            
        
                        <div class="d-flex justify-content-end">
        
        
                            <div class="dropdown  mt-2 p-1">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">
                                    <i class="fas fa-sort"></i> Filtro 
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-history"></i> Mais Recente</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-numeric-down-alt"></i> Mais Antigo</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-up"></i> Ordem Decrescente</a></li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="table-responsive-lg">
                            <table class="table border-bottom text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    <th class="col text-center border-top border-start text-nowrap" style="width:150px;">Código da Folha</th>
                                    <th class="col text-center border-top text-nowrap " style="width:250px">Data Inicial</th>
                                    <th class="col text-center border-top text-nowrap" style="width:250px">Data Final</th>
                                    <th class="col text-center border-top text-nowrap" style="width:50px;">Imprimir</th>
                                    <th class="col text-center border-top text-nowrap" style="width:50px;">Trabalhador</th>
                                    <th class="col text-center border-top text-nowrap" style="width:50px;">Rúbricas</th>
                                    <th class="col text-center border-top text-nowrap" style="width:50px;">Depósito</th>
                                    <th class="col text-center border-top text-nowrap" style="width:50px;">Analítica</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody >
                                    @if(count($folhas) > 0)
                                        @foreach($folhas as $folhar)
                                        <tr class="bodyTabela">               
                                            <td class="col text-center border-bottom border-start text-nowrap" style="width:150px;">{{$folhar->fscodigo}}</td>
                                            <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:250px">
                                                <?php
                                                    $data = explode('-',$folhar->fsinicio)
                                                ?>
                                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
    
                                            </td>
                                            <td class="col text-center border-bottom text-nowrap" style="width:250px">
                                                <?php
                                                    $data = explode('-',$folhar->fsfinal)
                                                ?>
                                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                            </td>                           
                                            <td class="col text-center border-bottom text-nowrap" style="width:50px;">
                                                <a class="btn" style="background-color:#28117A; border: 1px solid #8268DE;" href="{{route('calculo.folha.imprimir',$folhar->id)}}" class="" ><i class="fal fa-print" style="color: white;"></i></a>
                                            </td>
                                            
                                            <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                                
                                                <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample1{{$folhar->id}}" role="button" aria-controls="offcanvasExample1" style="background-color: #2866EB; border: 1px solid #A1BCF7;">
                                                    <i class="fal fa-print-search" style="color: white;"></i>
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
                                            
                                            
                                            <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                                
                                                <a class="btn" data-bs-toggle="offcanvas" href="#rublica{{$folhar->id}}" role="button" aria-controls="rublica" style="background-color:#0D6E64; border: 1px solid #A4F4EC;">
                                                <i class="fas fa-file-signature" style="color: white;"></i>
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
                                            
                                            
                                            
                                            

                                            
                                            <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                                
                                                <a class="btn" data-bs-toggle="offcanvas" href="#banco{{$folhar->id}}" role="button" aria-controls="banco" style="background-color:#0D6E64; border: 1px solid #A4F4EC;">
                                                <i class="fal fa-file-invoice-dollar" style="color: white;"></i>
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
                                            
                                            <td class="col text-center border-bottom text-nowrap" style="width:50px;">
                                                <a href="{{route('calculo.folha.analitica',$folhar->id)}}" class="btn" style="background-color:#BF8915; border: 1px solid #F5DBA3;">
                                                    <i class="fal fa-analytics" style="color: white;"></i>
                                                </a>
                                            </td>
                                            
                                            <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                                <a href="{{route('calculo.folha.deletar',$folhar->fsfinal)}}" class="btn" style="background-color:#FF331F; border: 1px solid #E5767D;"><i style="color:#FFFFFF;" class="fal fa-trash"></i></a>
                                         
                                            </td>
                                        
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                                                <div class="alert" role="alert" style="background-color: #CC2836;">
                                                    Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                
                            </table>
                        </div>
                        
                    
                    
                </div>
            </div>
        </div>
        
        
        
        <script>
        
            
        
        
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