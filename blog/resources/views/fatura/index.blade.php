@extends('layouts.index')
@section('titulo','Rhweb - Fatura')
@section('conteine')

    <!--Erro para quando não tiver nenhum calculo da folha cadastrado nesse periodo para o tomador-->

    <!--<script>-->
    <!--    Swal.fire({-->
    <!--      icon: 'error',-->
    <!--      title: 'Algo deu errado!!',-->
    <!--      text: 'Não possui nenhum valor nesse período.',-->
    <!--    })-->
    <!--</script>-->
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
                
    <div class="container">
        <ul class="nav nav-pills mb-5 mt-5" id="pills-tab" role="tablist">
            <li class="nav-item ms-2 mt-2" role="presentation">
                <button class="nav-link botao" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fad fa-file-invoice-dollar"></i> Gerar Fatura</button>
            </li>
            <li class="nav-item ms-1 pillstop mt-2" role="presentation">
                <button class="nav-link botao" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fad fa-list"></i> Lista de Faturas</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
        
                <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form class="row g-3" action="{{route('fatura.gera')}}" method="POST">
                        <input type="hidden" name="tomador" value="{{old('tomador')}}" class="@error('tomador') is-invalid @enderror" id="tomador">
                        <div class="" id="quadro1">
                        @csrf
                            <div class="container text-start fs-5 fw-bold mt-4">Pesquisar Tomador <i class="fas fa-search"></i></div>
                                
                                    <div class="d-flex justify-content-between mb-3 mt-0">
                                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                                            <div class="d-flex">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input class="form-control fw-bold text-dark pesquisa" list="listapesquisa" value="{{old('pesquisa')}}" name="pesquisa" id="pesquisa">
                                            
                                            <datalist id="listapesquisa">
                                            </datalist>
                                            <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                            <div class="text-center d-none" id="refres">
                                                <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                                    <span class="visually-hidden">Carregando...</span>
                                                </div>
                                            </div>
                                            </div>
                                            @error('tomador')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                    
                                    </div>

                            <div class="data mt-4">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                                <label for="ano" class="form-label">Data Inicial</label>
                                <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="ano_inicial">
                                    @error('ano_inicial')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="ano_final">
                                    @error('ano_final')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <?php
                                if ($valorrublica_fatura->vsnrofatura) {
                                    $fatura = $valorrublica_fatura->vsnrofatura + 1;
                                }else{
                                    $fatura = 1;
                                }
                            ?>
                            <input type="hidden" name="numero" value="{{$fatura}}">
                            <div class="data mt-4">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mt-3 input">
                                    <label for="text__adiantamento" class="form-label">Texto Adiantamento</label>
                                    <input type="text" class="form-control @error('text__adiantamento') is-invalid @enderror" name="text__adiantamento" value="{{old('text__adiantamento')}}" id="text__adiantamento"> 
                                    @error('text__adiantamento')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                 <!--limitar a 35 caracteres-->
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mt-3 ms-1 input">
                                    <label for="valor__adiantamento" class="form-label">Valor Adiantamento</label>
                                    <input type="text" class="form-control @error('valor__adiantamento') is-invalid @enderror" name="valor__adiantamento" value="{{old('valor__adiantamento','0,00')}}" id="valor__adiantamento">
                                    @error('valor__adiantamento')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                            </div>
                            
                            <div class="data mt-4">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mt-3 input">
                                    <label for="texto__credito" class="form-label">Texto Crédito</label>
                                    <input type="text" class="form-control @error('texto__credito') is-invalid @enderror" name="texto__credito" value="{{old('texto__credito')}}" id="texto__credito"> 
                                          @error('texto__credito')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!--limitar a 35 caracteres-->
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mt-3 ms-1 input">
                                    <label for="valor__creditos" class="form-label">Valor Créditos</label>
                                    <input type="text" class="form-control @error('valor__creditos') is-invalid @enderror" name="valor__creditos" value="{{old('valor__creditos','0,00')}}" id="valor__creditos">
                                          @error('valor__creditos')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                            </div>
                            
                            <div class="data mt-4">
                            
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mt-3 ms-1 input">
                                    <label for="vencimento" class="form-label">Data Vencimento</label>
                                    <input type="date" class="form-control @error('vencimento') is-invalid @enderror" name="vencimento" value="{{old('vencimento')}}" id="vencimento">
                                    @error('vencimento')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 mt-3 ms-1 input">
                                    <label for="competencia" class="form-label">Competência</label>
                                    <input type="month" value="{{old('competencia')}}" class="form-control @error('competencia') is-invalid @enderror" name="competencia"  id="competencia">
                                    @error('competencia')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                            
                            
                            
                            <div class="mt-5">
                                <button type="submit" class="btn botao" id="campo1">Gerar <i class="fad fa-calculator-alt"></i></button>
                            </div>
                        </div>
                    </form>
            </div>
                
                
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <form class="row g-3" action="{{route('filtro.pesquisa.fatura')}}" method="POST">
                    @csrf
                    <div class="container text-start fs-5 fw-bold mt-4">Pesquisar <i class="fas fa-search"></i></div>
                        
                            <div class="d-flex justify-content-between mb-3 mt-0">
                                <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                                    <div class="d-flex">
                                    <label for="exampleDataList" class="form-label"></label>
                                    <input class="form-control fw-bold text-dark pesquisa @error('pesquisa') is-invalid @enderror" list="datalistOptions" name="pesquisa" id="pesquisa">
                                    <datalist id="datalistOptions">
                                    </datalist>
                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                    <div class="text-center d-none" id="refres">
                                        <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                            <span class="visually-hidden">Carregando...</span>
                                        </div>
                                    </div>
                                    </div>
                                    @error('pesquisa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                   
                            </div>
            
                            <div class="data mt-4">
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                                    <label for="ano" class="form-label">Data Inicial</label>
                                    <input type="date" class="form-control @error('ano_inicial1') is-invalid @enderror" name="ano_inicial1" value="" id="tano1">
                                    @error('ano_inicial1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    
                                    <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                    <label for="ano" class="form-label">Data Final</label>
                                    <input type="date" class="form-control @error('ano_final1') is-invalid @enderror" name="ano_final1" value="" id="tano1">
                                    @error('ano_inicial1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                          <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtro.ordem.fatura','asc')}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                          <li><a class="dropdown-item dropdown__links--filter" href="{{route('filtro.ordem.fatura','desc')}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                        </ul>
                                      </div>
                                </div>
        
                            </div>
                        </section>


                        <section class="table">
                            <div class="table-responsive-xxl">
                                <table class="table">
                                    <thead class="tr__header">
                                        <th class="th__header text-nowrap" style="width:60px;">Matrícula</th>
                                        <th class="th__header text-nowrap">Tomador</th>
                                        <th class="th__header text-nowrap">Data inicial</th>
                                        <th class="th__header text-nowrap">Data Final</th>
                                        <th class="th__header text-nowrap" style="width:110px;">Nº Fatura</th>
                                        <th class="th__header text-nowrap" style="width:60px;">Imprimir</th>
                                        <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                    </thead>
                                    
                                    <tbody class="table__body">
                                    @if(count($faturas) > 0)
                                        @foreach($faturas as $fatura)
                                        <tr class="tr__body">  
                                            <td class="td__body text-nowrap col" style="width:60px;">{{$fatura->tsmatricula}}</td>  
                                            
                                            <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$fatura->tsnome}}">
                                                {{$fatura->tsnome}}
                                            </td>
                                            
                                            <td class="td__body text-nowrap col">
                                                <?php
                                                    $data = explode('-',$fatura->fsinicio);
                                                ?>
                                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                            </td>
                                            <td class="td__body text-nowrap col">
                                                <?php
                                                    $data = explode('-',$fatura->fsfinal);
                                                ?>
                                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                            </td>
                                            <td class="td__body text-nowrap col" style="width:110px;">
                                                {{$fatura->fsnumero}}
                                            </td>
                                            
                                            <td class="td__body text-nowrap col" style="width:60px;">
                                                    <a href="{{route('fatura.relatorio',[$fatura->tomador,$fatura->fsinicio,$fatura->fsfinal])}}" class="btn btn__imprimir" ><i class="icon__color fad fa-print"></i></a>
                                            </td> 
                                            
                                            <td class="td__body text-nowrap col" style="width:60px;">
                                                
                                                <button type="submit" class="btn button__excluir modal-botao" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$fatura->id}}">
                                                    <i class="icon__color fad fa-trash"></i>
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
                        $('#tomador').val(data[0].id)
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