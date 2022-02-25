@extends('layouts.index')
@section('titulo','Rhweb - Recibo Avulso')
@section('conteine')

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
                  title: 'Não foi possível gerar o recibo'
                })
            </script>
        @enderror  


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
            <li class="nav-item ms-2 mt-1" role="presentation">
            <button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" style="color: white;"><i class="fad fa-file-invoice-dollar"></i> Gerar Recibo Avulso</button>
            </li>
            <li class="nav-item ms-2 pillstop mt-1" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" style="color: white;"><i class="fad fa-list"></i> Lista de Recibos Avulsos</button>
            </li>
            <li class="nav-item ms-2 pillstop1 mt-1" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" style="color: white;"><i class="fad fa-th-list"></i> Rol dos Boletins</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
                <div>
                    <a href="backToTop"></a>
                </div>
        
                <div class="tab-pane fade show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form class="row g-3" action="{{route('avuso.store')}}" method="POST">
                        <div class="" id="quadro1">
                        @csrf
                        <input type="hidden" name="empresa" value="{{$user->empresa}}">

                                <div class="col-md-6">
                                  <label for="nome__completo" class="form-label">Nome Completo</label>
                                  <input type="text" class="form-control input fw-bold text-dark @error('nome') is-invalid @enderror" value="{{old('nome')}}" name="nome" maxlength="100" id="nome">
                                        @error('nome')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                
                                <div class="col-md-6 mt-3">
                                  <label for="cpf" class="form-label">CPF/CNPJ</label>
                                  <input type="text" class="form-control input fw-bold text-dark @error('cpf') is-invalid @enderror" value="{{old('cpf')}}" name="cpf" maxlength="100" id="cpf">
                                        @error('cpf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                    
                                    
                                    
                                    <?php
                                        if ($valorrublica_avuso->vsreciboavulso) {
                                            $avuso = $valorrublica_avuso->vsreciboavulso + 1;
                                        }else{
                                            $avuso = 1;
                                        }
                                    ?>
                                    <input type="hidden" name="codigo" value="{{$avuso}}">
                            <div class="data mt-4 mb-5">
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                                <label for="ano" class="form-label">Data Inicial</label>
                                <input type="date" class="form-control @error('ano_inicial') is-invalid @enderror" name="ano_inicial" value="{{old('ano_inicial')}}" id="tano">
                                    <div class="mt-1">
                                        @error('ano_inicial')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control @error('ano_final') is-invalid @enderror" name="ano_final" value="{{old('ano_final')}}" id="tano">
                                    <div class="mt-1">
                                        @error('ano_final')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="" id="conteiner" >
                                <div class="row mb-3" style="background-color: #141414; padding-bottom: 20px; padding-top:5px; border-radius: 10px; margin:1px;">
                                    <div class="col-md-5 mt-2">
                                        <label for="descricao" class="form-label text-white">Descrição</label>
                                        <input type="text" class="form-control input fw-bold text-dark @error('descricao0') is-invalid @enderror" name="descricao0" maxlength="100" id="descricao">
                                        <div class="mt-1">
                                            @error('descricao0')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-2">
                                        <label for="valor" class="form-label text-white">Valor</label>
                                        <input type="text" class="form-control input fw-bold text-dark @error('valor0') is-invalid @enderror"  name="valor0" maxlength="100" id="valor">
                                        <div class="mt-1">
                                            @error('valor0')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="col-md-3 mt-2">
                                            <label for="cd" class="form-label text-white">Crédito/Desconto</label>
                                            <select id="cd" name="cd0" class="form-select fw-bold text-dark" >
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

                            <input type="hidden" name="quantidade" value="1" id="quantidade">

                                <div class="d-grid d-md-flex justify-content-md-end">
                                    <div class="mt-2">
                                        
                                        <button type="submit" class="btn botao" id="campo1">Gerar recibo <i class="fad fa-save"></i></button>
                                    </div>
                                </div>
                            </div>
                    </form>
                    
                    <div id="acaoTopo" class="d-none">
                        <div class="d-flex justify-content-center mt-5">
                            <i class="fad fa-lg fa-chevron-up btn" id="backTop" style="padding-top: 15px; padding-bottom:15px; padding-left:8px; padding-right:8px; background-color:black; color: white; border-radius:50%"></i>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <a id="backTopTitle" class="fw-bold text-decoration-none text-black btn">Voltar para o topo!!</a>
                        </div>
                    </div>
                </div>
                
                
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                <form class="row g-3" action="{{route('filtra.pesquisa.avuso')}}" method="POST">
                @csrf
                    <div class="container text-start fs-5 fw-bold mt-4">Pesquisar <i class="fas fa-search"></i></div>
                        
                            <div class="d-flex justify-content-between mb-3 mt-0">
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
                                    <button class="btn botao filtrar" id="">Filtrar <i class="fad fa-filter"></i></button>
                                </div>
    

                    </form>
                    
                    

                        <div class="d-flex justify-content-end">
                            <div class="dropdown  mt-2 p-1">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">
                                    <i class="fad fa-sort"></i> Filtro 
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <!-- <li><a class="dropdown-item text-white" href="#"><i class="fad fa-history"></i> Mais Recente</a></li>
                                <li><a class="dropdown-item text-white" href="#"><i class="fad fa-sort-numeric-down-alt"></i> Mais Antigo</a></li> -->
                                <li><a class="dropdown-item text-white" href="{{route('filtra.ordem.avuso','asc')}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                <li><a class="dropdown-item text-white" href="{{route('filtra.ordem.avuso','desc')}}"><i class="fad fa-sort-amount-up"></i> Ordem Decrescente</a></li>
                                </ul>
                            </div>
                        </div>
                

                        <div class="table-responsive-xxl">
                            <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    
                                    <th class="col text-center border-start border-top text-nowrap" style="width:60px;">Matrícula</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 350px;">Trabalhador</th>
                                    <th class="col text-center border-top text-nowrap" style="width:150px;">CPF/CNPJ </th>
                                    <th class="col text-center border-top text-nowrap">Data inicial</th>
                                    <th class="col text-center border-top text-nowrap" style="width:200px">Data Final</th>
                                    <th class="col text-center border-top text-nowrap" style="width:110px;">Nº Recibo Avulso</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">Imprimir</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">
                                @if(count($lista)>0)
                                @foreach($lista as $listas)
                                    <tr class="bodyTabela ">  
                                        <td class="col text-center border-bottom border-start text-nowrap mt-3" style="width:60px;"></td>             
                                        <td class="col text-center border-bottom text-capitalize text-nowrap mt-3" style="width: 350px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$listas->asnome}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding:0px; margin:0px;">
                                                <a>{{$listas->asnome}} </a>
                                            </button>
                                        
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 150px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$listas->ascpf}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding:0px; margin:0px;">
                                                <a>{{$listas->ascpf}} </a>
                                            </button>
                                        
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap">
                                            <?php
                                                $inicio = explode('-',$listas->asinicial);
                                            ?>
                                            {{$inicio[2]}}/{{$inicio[1]}}/{{$inicio[0]}}
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:200px">
                                            <?php
                                                $final = explode('-',$listas->asfinal);
                                            ?>
                                            {{$final[2]}}/{{$final[1]}}/{{$final[0]}}
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:110px;">{{$listas->aicodigo}}</td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                        <a href="{{route('recibo.avulso',[base64_encode($listas->id),base64_encode($listas->asinicial),base64_encode($listas->asfinal)])}}" class=" btn__padrao--imprimir"><i style="color:#FFFFFF;" class="fad fa-lg fa-print"></i></a>
                                            
                                        </td>                               
                                        <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                            
                                            
                                            <button class="btn btn__padrao--excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$listas->id}}">
                                                <i style="color:#FFFFFF;" class="fad fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="staticBackdrop{{$listas->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('avuso.destroy',$listas->id)}}"  method="post">
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



            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <form class="row g-3" action="{{route('recibo.avulso.trabalhador')}}" method="POST">
                    <div class="container text-start fs-5 fw-bold mt-4">Pesquisar Nome <i class="fas fa-search"></i></div>
                    @csrf
                    <div class="d-flex justify-content-between mb-3 mt-0">
                        <div class="col-md-6 col-12 mt-2 p-1 pesquisar ">
                            <div class="d-flex">
                            <label for="exampleDataList" class="form-label"></label>
                            <input class="form-control fw-bold text-dark " list="listatrabalhador01" id="pesquisatrabalhador01">
                            
                            <datalist id="listatrabalhador01">
                            </datalist>
                            <input type="hidden" name="trabalhador01" class="@error('trabalhador01') is-invalid @enderror" id="idlistatrabalhador01">
                            <i class="fas fa-search fa-md iconsear" id="icon"></i>
                            <div class="text-center d-none" id="refres">
                                <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                    <span class="visually-hidden">Carregando...</span>
                                </div>
                            </div>
                            </div>
                            
                            
                                @error('trabalhador01')
                                    <div class="mt-1 col-md-12">
                                        <span class="text-danger ">{{ $message }}</span>
                                    </div>
                                @enderror
                            
                            
                        </div>
                        
    
                    </div>
    
                    <div class="data mt-4">
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 input">
                                <label for="ano" class="form-label">Data Inicial</label>
                                <input type="date" class="form-control @error('ano_inicial1') is-invalid @enderror" name="ano_inicial1" value="" id="tano1">
                                <div class="mt-1">
                                    @error('ano_inicial1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3  dataFinal input">
                                <label for="ano" class="form-label">Data Final</label>
                                <input type="date" class="form-control @error('ano_final1') is-invalid @enderror" name="ano_final1" value="" id="tano1">
                                <div class="mt-1">
                                    @error('ano_final1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
    
                        <div class="mt-5">
                            <button type="submit" class="btn botao filtrar" id="">Imprimir <i class="fad fa-print"></i></button>
                        </div>
                        
                </form>
            </div>

        </div>
        
        
        
        </main>
        
        


        <script>
        let index = 0;
        console.log(index);
        function conteiner(index) {
                let conteiner = '';
                conteiner += `<div class="row d-flex mt-3" style="background-color: #141414; padding-bottom: 20px; padding-top:10px; border-radius: 10px; margin:1px;">
                    <div class="col-md-5 mt-2">
                        <label for="descricao" class="form-label text-white">Descrição</label>
                        <input type="text" class="form-control input fw-bold text-dark" value="" name="descricao${index}" maxlength="100" id="descricao${index}">
                    </div>

                    <div class="col-md-3 mt-2">
                        <label for="valor" class="form-label text-white">Valor</label>
                        <input type="text" class="form-control input fw-bold text-dark" value="" name="valor${index}" maxlength="100" id="valor${index}">
                    </div>

                    <div class="col-md-3 mt-2">
                        <label for="cd${index}" class="form-label text-white">Crédito/Desconto</label>
                        <select id="cd${index}" name="cd${index}" class="form-select fw-bold text-dark" >
                        <option selected>Crédito</option>
                        <option>Desconto</option>
                        </select>
                    </div>
                    
                    <div class="d-flex align-items-center col-md-1" id="botaoDelete" style="padding-top: 32px;">    
                            <i class="fas fa-times btn" style="color:white; background-color:Darkred; padding-top: 8px; padding-bottom: 8px; padding-left:10px; padding-right:10px; border-radius: 30%; border: 1px solid red;"></i>
                    </div>
                    
                    </div>`
            return conteiner;
  
        }
        
            
        
        
        $('#adicinar').click(function () {
            if ($('#quantidade').val() <= 20) {
                index += 1;
                let quantidade =  parseInt($('#quantidade').val());
                quantidade += 1;
                $('#quantidade').val(quantidade)
                $('#conteiner').append(conteiner(index));
            }else{
                alerta()
                $(this).addClass('disabled')
            }
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
                        if(data.length === 1 && dados.length >= 2){
                            $('#tomador').val(data[0].tomador)
                        }         
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
                      if(data.length === 1 && dados.length >= 4){
                        $('#trabalhador').val(data[0].id)
                      }              
                    }
                  });
            });
            $( "#pesquisatrabalhador01" ).on('keyup focus',function() {
                let dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) { 
                    dados = monta_dados(dados);
                  }
                }
                $('#icon').addClass('d-none').next().removeClass('d-none')
                $.ajax({
                    url: "{{url('avuso')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#trabfoto').removeAttr('src')
                      $('#refres').addClass('d-none').prev().removeClass('d-none')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.ascpf}  ${element.asnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          //   nome += `<option value="${element.tscpf}">`
                        });
                        $('#listatrabalhador01').html(nome)
                      } 
                      if(data.length === 1 && dados.length >= 4){
                        $('#idlistatrabalhador01').val(data[0].id)
                      }              
                    }
                  });
            });
            function alerta() {
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
                  title: 'Não pode ser cadastrado mais de 20!'
                })
            }
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


            var botao = document.getElementById("backTop");
            var botaoAdicionar = document.getElementById("adicinar");
            var quantidade = document.getElementById("quantidade");
            var acaoTopo = document.getElementById("acaoTopo");
            var backTopTitle = document.getElementById("backTopTitle");

            botaoAdicionar.addEventListener('click', function(){
                var contador = quantidade.value + 1;
                if(contador >= 71){
                    acaoTopo.classList.remove("d-none");
                }

            })

            botao.addEventListener('click', function(){
                var contador = quantidade.value + 1;
                if(contador >= 71){
                    window.scrollTo(0, 1);
                    
                }
            })
            
            backTopTitle.addEventListener('click', function(){
                var contador = quantidade.value + 1;
                if(contador >= 71){
                    window.scrollTo(0, 1);
                    
                }
            })
            
            

        </script>
@stop