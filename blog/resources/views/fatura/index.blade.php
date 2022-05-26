@extends('layouts.index')
@section('titulo','Rhweb - Fatura')
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
        
        
         <section class="section__botoes--fatura">
            
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
                <h1 class="title__fatura">Gerar Fatura <i class="fad fa-calculator"></i></h1>
                
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
                
                <h1 class="title__fatura">Lista de Faturas <i class="fad fa-calculator"></i></h1>
                
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
                
                <section class="section__filtro--fatura row">
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
                                                    <a href="{{route('fatura.relatorio',[$fatura->id,$fatura->fsinicio,$fatura->fsfinal])}}" class="btn btn__imprimir" ><i class="icon__color fad fa-print"></i></a>
                                            </td> 
                                            
                                            <td class="td__body text-nowrap col" style="width:60px;">
                                                
                                                <button class="btn button__excluir modal-botao" data-bs-toggle="modal" data-bs-target="#deleteFatura{{$fatura->id}}">
                                                    <i class="icon__color fad fa-trash"></i>
                                                </button>
                                                <section class="delete__tabela--fatura">
                                                    <div class="modal fade" id="deleteFatura{{$fatura->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered col-8">
                                                            <div class="modal-content">
                                                                <form action="{{route('fatura.deleta',$fatura->id)}}" id="formdelete" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div class="modal-header header__modal">
                                                                        <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                                                        <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                                    </div>
                                                                    
                                                                    <div class="modal-body body__modal ">
                                                                            <div class="d-flex align-items-center justify-content-center flex-column">
                                                                                <img class="gif__warning--delete" src="{{url('imagem/warning.gif')}}">
                                                                            
                                                                                <p class="content--deletar">Deseja realmente excluir?</p>

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
                            // nome += `<option value="${element.tscnpj}">`
                        });
                        $('#listapesquisa').html(nome)
                    }
                    if(data.length === 1){
                        $('#tomador').val(data[0].id)
                    }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[0];
            }
            
        
            var Back = document.getElementById('gerar-fatura-tab');
            Back.addEventListener("click", function(){
               localStorage.setItem('Backft', 'backpill1');
               
           })
           
        //    var Back1 = document.getElementById('pills-contact-tab');
        //     Back1.addEventListener("click", function(){
        //        localStorage.setItem('Backft', 'backpill3');
               
        //    })
           
           var Back2 = document.getElementById('lista-fatura-tab');
            Back2.addEventListener("click", function(){
               localStorage.setItem('Backft', 'backpill2');
               
           })
           
           backActive =  document.getElementById("lista-fatura");
           backActive1 =  document.getElementById("gerar-fatura");
        //    backActive2 =  document.getElementById("pills-contact");

            voltar = localStorage.getItem("Backft");

            
            if(voltar === null){
                localStorage.setItem('Backft', 'backpill1');
                Back.classList.add("active");
                backActive1.classList.add("show", "active");
                backActive.classList.remove("show", "active");
                // backActive2.classList.remove("show", "active");
                document.getElementById("gerar-fatura-tab").click();
            }

            if(voltar === "backpill1"){
                Back.classList.add("active");
                backActive1.classList.add("show", "active");
                backActive.classList.remove("show", "active");
                // backActive2.classList.remove("show", "active");
                document.getElementById("gerar-fatura-tab").click();
                

            }else if (voltar === "backpill2"){
                Back2.classList.add("active");
                backActive.classList.add("show", "active");
                backActive1.classList.remove("show", "active");
                // backActive2.classList.remove("show", "active");
                document.getElementById("lista-fatura-tab").click();

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