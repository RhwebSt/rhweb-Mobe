@extends('layouts.index')
@section('conteine')
<div class="container responsive">
    <form class="row g-3" action="{{route('calculo.folha.store')}}" method="POST">
        
        <ul class="nav nav-pills d-flex flex-wrap mb-5" id="pills-tab" role="tablist">
          <li class="nav-item ms-2" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white;"><i class="fad fa-calculator-alt"></i> Cálculo da Folha</button>
          </li>
          <li class="nav-item ms-1" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white;"><i class="fas fa-list"></i> Lista Tomador</button>
          </li>
          <li class="nav-item ms-1" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" style="color: white;">Lista Geral <i class="fad fa-th-list"></i></button>
          </li>
        </ul>
        
        <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                
                <div class="" id="quadro1">
    
                        <div class="data mt-4">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                              <label for="ano" class="form-label">Data Inicial</label>
                              <input type="date" class="form-control " name="ano_inicial" value="" id="tano">
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                              <label for="ano" class="form-label">Data Final</label>
                              <input type="date" class="form-control " name="ano_final" value="" id="tano">
                            </div>
                        </div>
                        <div class="mt-5">
                            <a class="btn botao" id="campo1">Calcular <i class="fad fa-calculator-alt"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    
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
                                        <button class="btn" style="background-color:#204E83;">
                                        <a href="" class="" ><i class="fal fa-print" style="color: white;"></i></a>
                                        </button>
                                    </td>
                                    
                                    <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                        
                                        <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
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
                                                    <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                                    <datalist id="datalistOptions">
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
                                            <button type="submit" class="btn" style="background-color:#FF331F;"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
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

               
                </div> 
                
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    
                    
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
                                <th class="col text-center border-top text-nowrap" style="width:50px;">Depósito</th>
                                <th class="col text-center border-top text-nowrap" style="width:50px;">Analítica</th>
                                <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                            <tbody style="background-color: #081049; color: white;">
                                <tr>               
                                    <td class="col text-center border-bottom border-start text-nowrap" style="width:150px;">3031</td>
                                    <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:250px">01/01/2022</td>
                                    <td class="col text-center border-bottom text-nowrap" style="width:250px">31/01/2022</td>                           
                                    <td class="col text-center border-bottom text-nowrap" style="width:50px;">
                                        <button class="btn" style="background-color:#204E83;">
                                            <a href="" class="" ><i class="fal fa-print" style="color: white;"></i></a>
                                        </button>
                                    </td>
                                    
                                    <td class="col text-center border-bottom text-nowrap" style="width:50px;">
                                        <button class="btn" style="background-color:#204E83;">
                                            <i class="fal fa-file-invoice-dollar" style="color: white;"></i>
                                        </button>
                                    </td>
                                    
                                    <td class="col text-center border-bottom text-nowrap" style="width:50px;">
                                        <button class="btn" style="background-color:#204E83;">
                                            <i class="fal fa-analytics" style="color: white;"></i>
                                        </button>
                                    </td>
                                    
                                    <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                       <form action=""  method="post">
                                            <button type="submit" class="btn" style="background-color:#FF331F;"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
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
                    
                    
                    
                </div>

                <div class="d-flex flex-column justify-content-center align-items-center d-none" id="quadro2" style="position: relative; height:100%; width:100%;">
                    <div class="card text-center quadro" style="background-color: rgb(61, 73, 245);">
                        <div class="card-header quadro__header"></div>
                        <div class="card-body quadro__body">
                            <h5 class="card-title title__quadro mb-2">Você deseja cadastrar?</h5>
                            <button type="submit" class="btn btn__success" id="campo_sim_1">Sim <i class="far fa-check-circle"></i></button>
                            <button type="submit" class="btn btn__deletar" id="campo_nao_2">Não <i class="far fa-times-circle"></i></button>
                        </div>
                        <div class="card-footer quadro__header text-muted"></div>
                    </div>
                </div>
                
                <div class="d-flex flex-column justify-content-center align-items-center d-none"  style="position: relative; height:100%; width:100%;">
                    <div class="card text-center quadro" style="background-color: rgb(61, 73, 245);">
                        <div class="card-header quadro__header">Numero da Folha 99999</div>
                        <div class="card-body quadro__body">
                            <h5 class="card-title title__quadro mb-5">Deseja Imprimir ?</h5>
                            <button type="submit" class="btn btn__success">Sim <i class="fas fa-print"></i></button>
                            <button type="submit" class="btn btn__deletar">Não <i class="far fa-times-circle"></i></button>
                        </div>
                        <div class="card-footer quadro__header text-muted"></div>
                    </div>
                </div> 
            </form>
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