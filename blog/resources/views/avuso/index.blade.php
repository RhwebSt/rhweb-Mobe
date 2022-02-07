@extends('layouts.index')
@section('titulo','Rhweb - Recibo Avuso')
@section('conteine')

    {{-- @if(session('success'))
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
                  title: 'Recibo gerado com sucesso!'
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
                  title: 'Não foi possível gerar o recibo'
                })
            </script>
        @enderror   --}}


    {{-- Erro de nao possuir nenhuma recibo em determinado período --}}

    {{-- <script>
        Swal.fire({
            icon: 'error',
            title: 'Algo deu errado!',
            text: 'Não possui nenhum recibo nesse período!',
            })
    </script> --}}



    <main class="container">

        <ul class="nav nav-pills mb-5 mt-5" id="pills-tab" role="tablist">
            <li class="nav-item ms-2 " role="presentation">
            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white;"><i class="fad fa-calculator-alt"></i>Gerar Recibo Avulso <i class="fas fa-file-invoice-dollar"></i></button>
            </li>
            <li class="nav-item ms-1 pillstop" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white;"><i class="fas fa-list"></i> Lista de recibos avulsos</button>
            </li>
            <li class="nav-item ms-1 pillstop1" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" style="color: white;">Rol dos boletins <i class="fad fa-th-list"></i></button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
        
                <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form class="row g-3" action="{{route('avuso.store')}}" method="POST">
                        <div class="" id="quadro1">
                        @csrf
                            <div class="container text-start fs-5 fw-bold mt-4 mb-3">Pesquisar Tomador <i class="fas fa-search"></i></div>
                                
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                                            <div class="d-flex">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input class="form-control fw-bold text-dark pesquisa" list="listatomador" name="pesquisatomador" id="pesquisatomador">
                                            <datalist id="listatomador">
                                            </datalist>
                                            {{-- <i class="fas fa-search fa-md iconsear" id="icon"></i> --}}
                                            <div class="text-center d-none" id="refres">
                                                <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                    <span class="visually-hidden">Carregando...</span>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                    
                                    </div>

                                    <div class="container text-start fs-5 fw-bold mt-4 mb-3">Pesquisar Trabalhador <i class="fas fa-search"></i></div>
                                
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                                            <div class="d-flex">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input class="form-control fw-bold text-dark pesquisa" list="listatrabalhador" name="pesquisatrabalhador" id="pesquisatrabalhador">
                                            <datalist id="listatrabalhador">
                                            </datalist>
                                            {{-- <i class="fas fa-search fa-md iconsear" id="icon"></i> --}}
                                            <div class="text-center d-none" id="refres">
                                                <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                    <span class="visually-hidden">Carregando...</span>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                    
                                    </div>

                            <div class="data mt-4 mb-5">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                                <label for="ano" class="form-label">Data Inicial</label>
                                <input type="date" class="form-control" name="ano_inicial" value="" id="tano">
                                    <span class="text-danger"></span>
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control" name="ano_final" value="" id="tano">
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="" id="conteiner">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <input type="text" class="form-control input fw-bold text-dark" value="" name="descricao" maxlength="100" id="descricao">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input type="text" class="form-control input fw-bold text-dark" value="" name="valor" maxlength="100" id="valor">
                                    </div>

                                        <div class="col-md-4">
                                            <label for="cd" class="form-label">Crédito/Desconto</label>
                                            <select id="cd" name="cd" class="form-select fw-bold text-dark" >
                                            <option selected>Crédito</option>
                                            <option>Desconto</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        
                            <div class="d-grid d-md-flex justify-content-md-end">
                                <div class="mt-4 mb-5">
                                    <a type="text" class="btn botao" id="adicinar">Adicionar <i class="fas fa-plus"></i></a>
                                </div>
                            </div>

                            <div class="table-responsive-lg">
                                <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                    <thead>
                                        <th class="col text-center border-top text-nowrap" style="width: 450px;">Descrição</th>
                                        <th class="col text-center border-top text-nowrap">Valor</th>
                                        <th class="col text-center border-top text-nowrap" style="width:200px">Crédito/Desconto</th>
                                    </thead>
                                    <tbody style="background-color: #081049; color: white;">
    
                                        <tr class="bodyTabela">  
                                            <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 450px;">
                                                <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mobe mao de obra" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding:0px; margin:0px;">
                                                    <a>Mobe mao de obra </a>
                                                </button>
                                            
                                            </td>
                                            <td class="col text-center border-bottom text-capitalize text-nowrap">R$ 999.999.999,99</td>
                                            <td class="col text-center border-bottom text-nowrap" style="width:200px">Crédito</td>
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

                        

                            <input type="hidden" name="quantidade" id="quantidade">

                                <div class="d-grid d-md-flex justify-content-md-end">
                                    <div class="mt-2">
                                        
                                        <button type="submit" class="btn botao" id="campo1">Gerar recibo <i class="fas fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                
                
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <form class="row g-3" action="" method="POST">

                    <div class="container text-start fs-5 fw-bold mt-4 mb-3">Pesquisar <i class="fas fa-search"></i></div>
                        
                            <div class="d-flex justify-content-between mb-3">
                                <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                                    <div class="d-flex">
                                    <label for="exampleDataList" class="form-label"></label>
                                    <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                    <datalist id="datalistOptions">
                                    </datalist>
                                    {{-- <i class="fas fa-search fa-md iconsear" id="icon"></i> --}}
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
    

                    </form>
                    
                    <form class="row g-3" action="" method="POST">

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
                            <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    
                                    <th class="col text-center border-start border-top text-nowrap" style="width:60px;">Matrícula</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 350px;">Trabalhador</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 350px;">Tomador</th>
                                    <th class="col text-center border-top text-nowrap">Data inicial</th>
                                    <th class="col text-center border-top text-nowrap" style="width:200px">Data Final</th>
                                    <th class="col text-center border-top text-nowrap" style="width:110px;">Nº Recibo Avulso</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">Imprimir</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">

                                    <tr class="bodyTabela">  
                                        <td class="col text-center border-bottom border-start text-nowrap" style="width:60px;">521623</td>             
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 350px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliel Felipe dos Santos Rocha" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding:0px; margin:0px;">
                                                <a>Eliel Felipe dos Santos Rocha </a>
                                            </button>
                                        
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 350px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mobe mao de obra" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding:0px; margin:0px;">
                                                <a>Mobe mao de obra </a>
                                            </button>
                                        
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap">00/00/0000</td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:200px">00/00/0000</td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:110px;">521</td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                        
                                            <button class="btn" style="background-color:#53A548;">
                                                <a href="" class="" ><i style="color:#FFFFFF; padding-left: 3px;" class="fas fa-lg fa-print"></i></a>
                                            </button>
                                        </td>                               
                                        <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                            
                                            
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color:#FF331F">
                                                <i style="color:#FFFFFF; padding-right: 3px;" class="fal fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" id="formdelete" method="post">
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
                    <div class="container text-start fs-5 fw-bold mt-4 mb-3">Pesquisar trabalhador <i class="fas fa-search"></i></div>
                        
                    <div class="d-flex justify-content-between mb-3">
                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                            <div class="d-flex">
                            <label for="exampleDataList" class="form-label"></label>
                            <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                            <datalist id="datalistOptions">
                            </datalist>
                            {{-- <i class="fas fa-search fa-md iconsear" id="icon"></i> --}}
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
    
                        <div class="mt-5">
                            <a class="btn botao filtrar" id="">Imprimir <i class="fas fa-print"></i></a>
                        </div>
                        
                </form>
            </div>

        </div>
        
        </main>


        <script>
        let index = 0;
        function conteiner(index) {
                let conteiner = '';
                conteiner += `<div class="row">
                    <div class="col-md-5">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control input fw-bold text-dark" value="" name="descricao${index}" maxlength="100" id="descricao${index}">
                    </div>

                    <div class="col-md-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" class="form-control input fw-bold text-dark" value="" name="valor${index}" maxlength="100" id="valor${index}">
                    </div>

                        <div class="col-md-4">
                            <label for="cd${index}" class="form-label">Crédito/Desconto</label>
                            <select id="cd${index}" name="cd${index}" class="form-select fw-bold text-dark" >
                            <option selected>Crédito</option>
                            <option>Desconto</option>
                            </select>
                        </div>
                    </div>`
            return conteiner;
        }
        $('#adicinar').click(function () {
            index += 1;
            $('#conteiner').append(conteiner(index));
        })
        $('#pesquisatomador').on('keyup focus',function(){
                var dados = '0';
                if ($(this).val()) {
                    dados = $(this).val();
                    if (dados.indexOf('  ') !== -1) {
                        dados = monta_dados(dados);
                    }
                }
                $('#icon').addClass('d-none').next().removeClass('d-none')
                $.ajax({
                    url: "{{url('tomador')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json', 
                    success: function(data) {
                        let nome = ''
                        $('#refres').addClass('d-none').prev().removeClass('d-none')
                        if (data.length >= 1) {
                            data.forEach(element => {
                            nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            // nome += `<option value="${element.tscnpj}">`
                            });
                            $('#listatomador').html(nome)
                        } 
                        // if(data.length === 1 && dados.length >= 2){
                        //     tomador(dados)
                        // }else if (dados.length === 14) {
                        //     pesquisa(dados)
                        // }else{
                        //     campo()
                        // }         
                     }
                });
            })
            $( "#pesquisatrabalhador" ).on('keyup focus',function() {
                let dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                  }
                }
                $('#icon').addClass('d-none').next().removeClass('d-none')
                $.ajax({
                    url: "{{url('trabalhador')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#trabfoto').removeAttr('src')
                      $('#refres').addClass('d-none').prev().removeClass('d-none')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#listatrabalhador').html(nome)
                      } 
                    //   if(data.length === 1 && dados.length >= 4){
                    //     buscaItem(dados)
                    //   }else{
                    //     campo()
                    //   }              
                    }
                  });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            var Back = document.getElementById('pills-home-tab');
            Back.addEventListener("click", function(){
               localStorage.setItem('Backrb', 'backpill1');
               
           })
           
           var Back1 = document.getElementById('pills-contact-tab');
            Back1.addEventListener("click", function(){
               localStorage.setItem('Backrb', 'backpill3');
               
           })
           
           var Back2 = document.getElementById('pills-profile-tab');
            Back2.addEventListener("click", function(){
               localStorage.setItem('Backrb', 'backpill2');
               
           })
           
           backActive =  document.getElementById("pills-profile");
           backActive1 =  document.getElementById("pills-home");
           backActive2 =  document.getElementById("pills-contact");

            voltar = localStorage.getItem("Backrb");

            
            if(voltar === null){
                localStorage.setItem('Backrb', 'backpill1');
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

            }   
            else if (voltar === "backpill3"){
                Back1.classList.add("active");
                backActive2.classList.add("show", "active");
                backActive.classList.remove("show", "active");
                backActive1.classList.remove("show", "active");
                document.getElementById("pills-contact-tab").click();

            }    

        </script>
@stop