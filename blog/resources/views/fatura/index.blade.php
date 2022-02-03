
@extends('layouts.index')
@section('conteine')

    <div class="container">
        <ul class="nav nav-pills mb-5 mt-5" id="pills-tab" role="tablist">
            <li class="nav-item ms-2 " role="presentation">
            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white;">Gerar Fatura <i class="fas fa-file-invoice-dollar"></i></button>
            </li>
            <li class="nav-item ms-1 pillstop" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white;"><i class="fas fa-list"></i> Lista de Faturas</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
        
                <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form class="row g-3" action="{{route('fatura.gera')}}" method="POST">
                        <input type="hidden" name="tomador" id="tomador">
                        <div class="" id="quadro1">
                        @csrf
                            <div class="container text-start fs-4 fw-bold mt-4 mb-3">Pesquisar Tomador <i class="fas fa-search"></i></div>
                                
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                                            <div class="d-flex">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input class="form-control fw-bold text-dark pesquisa" list="listapesquisa" name="pesquisa" id="pesquisa">
                                            <datalist id="listapesquisa">
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
                                <input type="date" class="form-control" name="ano_inicial" value="" id="tano">
                                    <span class="text-danger"></span>
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control" name="ano_final" value="" id="tano">
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn botao" id="campo1">Gerar <i class="fad fa-calculator-alt"></i></button>
                            </div>
                        </div>
                    </form>
            </div>
                
                
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <form class="row g-3" action="" method="POST">

                    <div class="container text-start fs-4 fw-bold mt-4 mb-3">Pesquisar <i class="fas fa-search"></i></div>
                        
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
                        </form>

                        <div class="table-responsive-lg">
                            <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    
                                    <th class="col text-center border-start border-top text-nowrap" style="width:60px;">Matrícula</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 450px;">Tomador</th>
                                    <th class="col text-center border-top text-nowrap">Data inicial</th>
                                    <th class="col text-center border-top text-nowrap" style="width:200px">Data Final</th>
                                    <th class="col text-center border-top text-nowrap" style="width:110px;">Nº Fatura</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">2º Via</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">
                                @if(count($faturas) > 0)
                                    @foreach($faturas as $fatura)
                                    <tr class="bodyTabela">  
                                        <td class="col text-center border-bottom border-start text-nowrap" style="width:60px;">{{$fatura->tsmatricula}}</td>             
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 450px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$fatura->tsnome}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding:0px; margin:0px;">
                                                <a>{{$fatura->tsnome}}</a>
                                            </button>
                                        
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap">
                                            <?php
                                                $data = explode('-',$fatura->fsinicio);
                                            ?>
                                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:200px">
                                            <?php
                                                $data = explode('-',$fatura->fsfinal);
                                            ?>
                                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:110px;">
                                            {{$fatura->fsnumero}}
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                        
                                            <button class="btn" style="background-color:#53A548;">
                                                <a href="{{route('fatura.relatorio',[$fatura->tomador,$fatura->fsinicio,$fatura->fsfinal])}}" class="" ><i style="color:#FFFFFF; padding-left: 3px;" class="fas fa-lg fa-print"></i></a>
                                            </button>
                                        </td>                               
                                        <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                            
                                            
                                            <button class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$fatura->id}}" style="background-color:#FF331F">
                                                <i style="color:#FFFFFF; padding-right: 3px;" class="fal fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop{{$fatura->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('fatura.deleta',$fatura->id)}}" id="formdelete" method="post">
                                                        <div class="modal-header modal__delete">
                                                        @csrf
                                                        @method('delete')
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
        
        </main>


        <script>
        
            
        $( "#pesquisa" ).on('keyup focus',function() {
              var dados = '0';
              if ($(this).val()) {
                dados = $(this).val();
                if (dados.indexOf('  ') !== -1) {
                  dados = monta_dados(dados);
                }
              }
              $.ajax({
                  url: "{{url('tomador')}}/pesquisa/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                        data.forEach(element => {
                            nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            nome += `<option value="${element.tscnpj}">`
                        });
                        $('#listapesquisa').html(nome)
                    }
                    if(data.length === 1 && dados.length >= 4){
                        $('#tomador').val(data[0].tomador)
                    }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            
        
            var Back = document.getElementById('pills-home-tab');
            Back.addEventListener("click", function(){
               localStorage.setItem('Backft', 'backpill1');
               
           })
           
        //    var Back1 = document.getElementById('pills-contact-tab');
        //     Back1.addEventListener("click", function(){
        //        localStorage.setItem('Backft', 'backpill3');
               
        //    })
           
           var Back2 = document.getElementById('pills-profile-tab');
            Back2.addEventListener("click", function(){
               localStorage.setItem('Backft', 'backpill2');
               
           })
           
           backActive =  document.getElementById("pills-profile");
           backActive1 =  document.getElementById("pills-home");
        //    backActive2 =  document.getElementById("pills-contact");

            voltar = localStorage.getItem("Backft");

            
            if(voltar === null){
                localStorage.setItem('Backft', 'backpill1');
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
            // else if (voltar === "backpill3"){
            //     Back1.classList.add("active");
            //     backActive2.classList.add("show", "active");
            //     backActive.classList.remove("show", "active");
            //     backActive1.classList.remove("show", "active");
            //     document.getElementById("pills-contact-tab").click();

            // }    


            
        </script>
@stop