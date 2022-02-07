@extends('layouts.index')
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
                  title: '{{$message}}'
                })
            </script>
        @enderror
        @error('tabelavazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Tabela de preço vazia',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
        @error('dadosvazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Algo deu errado!',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
       

        <section class="container">
            <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('descontos.store')}}">
                <div class="container text-center mt-4 mb-3   fs-4 fw-bold">Descontos <i class="fas fa-percent"></i></div>
                @csrf
                <input type="hidden" name="empresa" value="{{$user->empresa}}">
                <input type="hidden" name="trabalhador" id="trabalhador">
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao"><i class="fas fa-save"></i> Incluir</button>
                    <button class="btn botao dropdown-toggle" type="button" id="rolDescontos"  data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-file-invoice"></i> Relatórios
                     </button>
                      <ul class="dropdown-menu" aria-labelledby="rolDescontos">
                        <li class=""><a class="dropdown-item text-decoration-none ps-2" onclick ="botaoModal ()"  id="imprimir" role="button">Rol dos Descontos</a></li>
                        <li class="">
                            <button type="button" class="btn dropdown-item text-decoration-none ps-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Rol dos Descontos - Por trabalhador
                              </button>
                        </li>
                      </ul>
                    <a class="btn botao" href="" role="button"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>

                <script>
                    function botaoModal (){
                         
                    Swal.fire({
                        title: 'Periodo <i class="far fa-clock"></i>',
                        html:
                        '<div>'+
                        '<label class="fw-bold">Data Inicial</label>' +
                        '</div>'+
                        '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
                        '<div class="mt-3">'+
                        '<label class="fw-bold">Data Final</label>' +
                        '</div>'+
                        '<input type="date" name="final" id="swal-input2" class="swal2-input">',
                        confirmButtonText: 'Buscar',
                        showDenyButton: true,
                        denyButtonText: 'Sair',
                        showConfirmButton: true,
                        focusConfirm: false,
                        preConfirm: () => {
                            if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                                Swal.showValidationMessage('Preencha todos os campos')   
                            }else{
                                let inicio =  document.getElementById('swal-input1').value
                                let final = document.getElementById('swal-input2').value
                                // let tomador = document.getElementById('tomador').value
                                location.href=`{{url('relatorio/descontos')}}/${ btoa(inicio)}/${btoa(final)}`;
                            } 
                            
                        }
                    });
                    }
                </script>

                <div>
                    <div class="col-md-3">
                        <label for="competencia" class="form-label">Competência</label>
                        <input type="month" class="form-control @error('competencia') is-invalid @enderror" name="competencia" value="{{old('competencia')}}" id="competencia">
                            @error('competencia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" id="matricula" Readonly>
                    @error('matricula')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label for="nome__trab" class="form-label">Nome do Trabalhador</label>
                    <input type="text" class="form-control @error('nome__trab') is-invalid @enderror" list="listatrabalhador" name="nome__trab" value="{{old('nome__trab')}}" id="nome__trab">
                    <datalist id="listatrabalhador">
                   
                   </datalist>
                   @error('nome__trab')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{old('descricao')}}" id="descricao">
                    @error('descricao')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="quinzena" class="form-label">Quinzena</label>
                    <select id="quinzena" name="quinzena" class="form-select fw-bold text-dark" >
                      <option selected>1 - Primeira</option>
                      <option>2 - Segunda</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{old('valor')}}" id="valor">
                    @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </form>
                
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
                
                <div class="table-responsive-xxl">
                    <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                              <thead>
                                  <th class="col text-center border-start border-top  text-nowrap" style="width:80px;">Matrícula</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:400px">Nome</th>
                                  <th class="col text-center border-top  text-nowrap capitalize" style="300px;">Descrição</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:130px;">Quinzena</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:80px;">Competência</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:110px;">Valor</th>
                                  <th class="col text-center border-top  text-nowrap" style="width:60px;">Editar</th>
                                  <th colspan="2" class="col text-center border-end border-top  text-nowrap" style="width:60px;">Excluir</th>
                              </thead>
                              
                              <tbody style="background-color: #081049; color: white;">
                              @if(count($descontos) > 0)
                                @foreach($descontos as $desconto)
                                  <tr class="bodyTabela">
                                  <td class="col text-center border-start  border-bottom text-nowrap text-uppercase" style="width:80px;">{{$desconto->tsmatricula}}</td>
                                  <td class="col text-center  border-bottom text-nowrap text-uppercase" style="width:400px">
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->tsnome}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                        <a>{{$desconto->tsnome}}</a>
                                    </button>    
                                </td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="300px;">
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->dsdescricao}}" style="max-width: 40ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                        <a>{{$desconto->dsdescricao}}</a>
                                    </button>
                                </td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:130px;">{{$desconto->dsquinzena}}</td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:80px;">
                                    <?php
                                        $data = explode('-',$desconto->dscompetencia);
                                    ?>
                                    {{$data[1]}}/{{$data[0]}}
                                  </td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:110px;">{{number_format((float)$desconto->dfvalor, 2, ',', '')}}</td>
                                  <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:60px;">
                                      <button class="btn" style="background-color:#204E83;">
                                        <a href="{{route('descontos.edit',base64_encode($desconto->id))}}" class=""><i style="color:#FFFFFF; padding-left: 3px;" class="fal fa-edit"></i></a>
                                      </button>
                                  </td>
                                  <td colspan="2" class="col text-center border-end border-bottom text-nowrap" style="width:60px;">
                                      <form action="{{route('descontos.destroy',$desconto->id)}}" method="post">
                                      @csrf
                                      @method('delete')
                                        <button type="submit" class="btn" style="background-color:#FF331F"><i style="color:#FFFFFF; padding-right: 1px;" class="fal fa-trash"></i></button>
                                      </form>
                                    </td>
                                  </tr>
                                  @endforeach
                                  @else
                                  <tr>
                                    <td class="text-center border-bottom border-end border-start text-nowrap" colspan="8" style="background-color: #081049; color: white;">
                                      <div class="alert" role="alert" style="background-color: #CC2836;">
                                          Não á registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                      </div>
                                  </td>
                                  </tr>
                                  @endif
                              </tbody>
                                  <tfoot>
                                      <tr class=" border-end border-start border-bottom">
                                          <td colspan="11">
                                            {{$descontos->links()}}
                                          </td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
            
        </section>

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
        
        
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="{{route('descontos.relatorio.trabalhador')}}" method="POST">
      @csrf
      <input type="hidden" name="idtrabalhador" id="idtrabalhador">
      <div class="modal-content">
        <div class="modal-header modal__delete">
          <h5 class="modal-title text-white fs-6" id="exampleModalLabel">Rol dos Descontos - Por trabalhador</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-delbody">

            <small class="fs-6">Pesquisar</small>
            <div>
                <div class="col-md-12 mt-2 mb-2 p-1 pesquisar"> 
                    <div class="d-flex">
                    <label for="exampleDataList" class="form-label"></label>
                    <input class="form-control fw-bold text-dark pesquisa" list="listapesquisa" name="pesquisa" id="pesquisa">
                    <datalist id="listapesquisa">
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

            <div class="row">
                <div class="col-12  col-md-12  input">
                  <label for="ano" class="form-label">Data Inicial</label>
                  <input type="date" class="form-control " name="ano_inicial" value="" id="tano">
                </div>
                
                <div class="col-12  mt-2 col-md-12 ms-1 input">
                  <label for="ano" class="form-label">Data Final</label>
                  <input type="date" class="form-control " name="ano_final" value="" id="tano">
                </div>
            </div>

        </div>
        <div class="modal-footer modal-delfooter">
            <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn__deletar"><i class="fas fa-print"></i> Imprimir</button>
          </div>
      </div>
      </form>
    </div>
  </div>
        
        
        <script>
             $( "#nome__trab,#pesquisa" ).on('keyup focus',function() { 
                let  dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                  }
                }
                $.ajax({
                    url: "{{url('trabalhador/pesquisa')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#nomemensagem').text(' ')
                      $('#matricula').val(' ')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#listatrabalhador').html(nome);
                        $('#listapesquisa').html(nome);
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#nome__trab').html(nome)
                        $('#trabalhador').val(data[0].id)
                        $('#idtrabalhador').val(data[0].id)
                        $('#matricula').val(data[0].tsmatricula)
                      }else if(!data.length && dados.length > 4){
                        $('#nomemensagem').text('Este trabalhador não ta cadastrador!')
                      }              
                    }
                });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
        </script>
        @stop