@extends('layouts.index')
@section('conteine')
<div class="card-body">
      
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
                  title: '{{ session("success") }}'
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
            
            <!--<script>-->
            <!--    Swal.fire({-->
            <!--          title: '<strong>Boletim Cartão Ponto</strong>',-->
            <!--          html:-->
            <!--            'Você deseja entrar no boletim? ',-->
            <!--          showCloseButton: true,-->
            <!--          showCancelButton: true,-->
            <!--          focusConfirm: false,-->
            <!--          confirmButtonText:-->
            <!--            'Sim <i class="far fa-check-circle"></i>',-->
            <!--            confirmButtonColor: "#1A7552",-->
            <!--          cancelButtonText:-->
            <!--            'Não <i class="far fa-times-circle"></i>',-->
            <!--            cancelButtonColor: "#CA2B3B",-->
            <!--        })-->
            <!--</script>-->
             

              <h5 class="card-title text-center fs-3 ">Cartão Ponto <i class="far fa-clock"></i></h5>
              <div class="container">
                  <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('cadastrocartaoponto.store')}}">
                  @csrf
                  <input type="hidden" id="method" name="_method" value="">
                  <input type="hidden" name="status" value="D" id="status">
                  <input type="hidden" name="empresa" value="{{$user->empresa}}">
                    <div class="row">
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
           
                            <button type="submit" id="incluir" class="btn botao">Incluir <i class="fas fa-save"></i></button>
                            <a  id="boletim"  class="btn botao disabled">Boletim <i class="fas fa-door-open"></i></a>
                            <button type="submit" id="atualizar" disabled class="btn botao">Editar <i class="fas fa-edit"></i></button>
                            <button type="button" class="btn botao  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Excluir <i class="fas fa-trash"></i>
                          </button>
                          
                   
                        <a class="btn botao" href="{{route('home.index')}}" role="button">Sair <i class="fas fa-sign-out-alt"></i></a>
                      </div>
                  </div>
                    
                    <div>
                        <div class="col-md-5 mt-5 mb-5 p-1 pesquisar">
                            <div class="d-flex">
                            <label for="exampleDataList" class="form-label"></label>
                            <input class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="pesquisa" id="pesquisa">
                            <datalist id="listapesquisa" class="text-uppercase">
                            </datalist>
                            <i class="fas fa-search fa-md iconsear" id="icon"></i>
                            <div class="text-center d-none p-1" id="refres" >
                                <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <?php
                      if ($numboletimtabela->vsnrocartaoponto) {
                        $boletim = $numboletimtabela->vsnrocartaoponto + 1;
                      }else{
                        $boletim = 1;
                      }
                    ?>
                    <div class="col-md-3">
                        <label for="num__boletim" class="form-label">Nº do Boletim <i class="fas fa-lock"></i></label>
                        <input type="text" value="{{$boletim}}" class="form-control fw-bold @error('liboletim') is-invalid @enderror" list="listaboletim" name="liboletim" id="num__boletim" Readonly>
                        @error('liboletim')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <datalist id="listaboletim">
                        </datalist>
                    </div>
    
                    <div class="col-md-6 input">
                      <label for="tomador" class="form-label ">Tomador</label>
                      <input type="text" class="form-control fw-bold @error('nome__completo') is-invalid @enderror" list="datalistOptions" name="nome__completo" value="" id="nome__completo">
                      <datalist id="datalistOptions">
                      </datalist>
                      @error('nome__completo')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      @error('tomador')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                      <input type="hidden" name="tomador" class="@error('tomador') is-invalid @enderror" id="tomador">
                      <input type="hidden" id="domingo" name="domingo">
                      <input type="hidden" name="sabado" id="sabado">
                      <input type="hidden" name="diasuteis" id="diasuteis">
                    <div class="col-md-2 d-none">
                        <label for="matricula" class="form-label ">Matrícula <i class="fas fa-lock"></i></label>
                        <input type="text" class="form-control fw-bold @error('matricula') is-invalid @enderror " name="matricula" value="" id="matricula" Readonly>
                        @error('matricula')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    <div class="col-md-3">
                      <label for="data" class="form-label">Data</label>
                      <input type="date" class="form-control fw-bold @error('data') is-invalid @enderror" name="data" value="" id="data">
                        @error('data')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-3">
                      <label for="num__trabalhador" class="form-label">Quantidade de Cadastros</label>
                      <input type="text" class="form-control fw-bold @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="" id="num__trabalhador">
                      @error('num__trabalhador')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label for="feriado" class="form-label">Feriado</label>
                        <select id="feriado" name="feriado" class="form-select fw-bold text-dark" >
                          <option >Sim</option>
                          <option selected>Não</option>
                        </select>
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
                        <li><a class="dropdown-item text-white" href="#"><i class="fas fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                        </ul>
                    </div>
                </div>
                
                
                
                <div class="table-responsive-lg">
                            <table class="table border-bottom text-white mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                                <thead>
                                    <th class="col text-center border-top border-start text-nowrap" style="width:115px;">Nº do Boletim</th>
                                    <th class="col text-center border-top text-nowrap" style="width: 400px;">Nome Tomador</th>
                                    <th class="col text-center border-top text-nowrap " style="width:200px">Data</th>
                                    <th class="col text-center border-top text-nowrap" style="width:200px">Quantidade de Cadastro</th>
                                    <th class="col text-center border-top text-nowrap" style="width:120px">Feriado</th>
                                    <th class="col text-center border-top text-nowrap" style="width:60px;">Editar</th>
                                    <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody style="background-color: #081049; color: white;">
                                   @if(count($lancamentotabelas) > 0)
                                   @foreach($lancamentotabelas as $lancamentotabela)
                                    <tr>               
                                       <td class="col text-center border-bottom border-start text-nowrap" style="width:115px;">{{$lancamentotabela->liboletim}}</td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap" style="width: 300px;">
                                            <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$lancamentotabela->tsnome}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis;">
                                                <a>{{$lancamentotabela->tsnome}}</a>
                                            </button>
                                        </td>
                                        <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:200px">
                                          <?php
                                            $data = explode('-',$lancamentotabela->lsdata)
                                          ?>
                                          {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                        </td>
                                        
                                        <td class="col text-center border-bottom text-capitalize text-nowrap "style="width:200px">
                                        {{$lancamentotabela->lsnumero}}
                                        </td>

                                        <td class="col text-center border-bottom text-nowrap" style="width:120px">
                                          {{$lancamentotabela->lsferiado}}
                                        </td>
                                        <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                            <button class="btn" style="background-color:#204E83;">
                                                <a href="{{route('cadastrocartaoponto.edit',$lancamentotabela->id)}}" class="" ><i style="color:#FFFFFF; padding-left: 3px;" class="fal fa-edit"></i></a>
                                            </button>
                                        </td>
                                        <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                           <form action=""  method="post">
                                                <button type="submit" class="btn" style="background-color:#FF331F; border: 1px solid #E5767D;"><i style="color:#FFFFFF;" class="fal fa-trash"></i></button>
                                            </form> 
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
                                <tfoot>
                                <tr class=" border-end border-start border-bottom">
                                    <td colspan="11">
                                    {{ $lancamentotabelas->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    
                    
                   
              </div>
              
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" id="formdelete" method="post">
                            @csrf
                            @method('delete')
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
            </div>
            <script>
              localStorage.setItem('cartao','{{$boletim}}')
            $( "#pesquisa" ).on('keyup focus',function() {
                var dados = '0';
                if ($(this).val()) {
                  dados = $(this).val();
                }
                var status = $('#status').val();
                $.ajax({
                  url: "{{url('tabela/cartao/ponto/pesquisa')}}/"+dados+'/'+status,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    console.log(data)
                    let nome = ''
                    if (data.length >= 1) {
                      data.forEach(element => {
                        nome += `<option value="${element.liboletim}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        // nome += `<option value="${element.tscpf}">`
                      });
                      $('#listapesquisa').html(nome)
                    }
                    if(data.length === 1 && dados.length > 0){
                      lancamentoTab(dados,status,data[0].lsdata)
                    }else{
                      limpaCamposTab()
                    }
                  }
                });
            });
            function lancamentoTab(dados,status,data) {
              $('#carregamento').removeClass('d-none')
              $.ajax({
                url: "{{url('tabela/cartao/ponto/unidade')}}/"+dados+'/'+status,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                  camposLacamentoTab(data)
                  $('#carregamento').addClass('d-none')
                }
              })
            }
            function limpaCamposTab() {
              $('#form').attr('action', "{{ route('cadastrocartaoponto.store') }}");
              $('#incluir').removeAttr( "disabled" )
              $('#atualizar').attr('disabled','disabled')
              $('#deletar').attr('disabled','disabled')
              $('#method').val(' ')
              $('#excluir').attr( "disabled",'disabled' )
              $('#matricula').val(' ')
              $('#nome__completo').val(' ')
              $('#data').val(' ')
              $('#num__trabalhador').val(' ')
              $('#num__boletim').val(localStorage.getItem('cartao'))
            }
            function camposLacamentoTab(data) {
                  if (data.id) {
                      buscatomador(data)
                      $('#form').attr('action', "{{ url('cadastrocartaoponto')}}/"+data.id);
                      $('#formdelete').attr('action',"{{ url('cadastrocartaoponto')}}/"+data.id)
                      $('#incluir').attr('disabled','disabled')
                      // $('#atualizar').removeAttr( "disabled" )
                      $('#deletar').removeAttr( "disabled" )
                      $('#excluir').removeAttr( "disabled" )
                      $('#method').val('PUT')
                      
                      
                  }else{
                    $('#form').attr('action', "{{ route('cadastrocartaoponto.store') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#excluir').attr( "disabled",'disabled' ) 
                  }
                  $('#num__boletim').val(data.liboletim).removeClass('is-invalid').next().text(' ')
                  $('#matricula').removeClass('is-invalid').next().text(' ')
                  $('#nome__completo').removeClass('is-invalid').next().text(' ')
                  $('#data').val(data.lsdata).removeClass('is-invalid').next().text(' ')
                  $('#num__trabalhador').val(data.lsnumero).removeClass('is-invalid').next().text(' ')
                  for (let index = 0; index <  $('#feriado option').length; index++) {  
                    if (data.lsferiado == $('#feriado option').eq(index).text()) {
                      $('#feriado option').eq(index).attr('selected','selected')
                    }else  {
                      $('#feriado option').eq(index).removeAttr('selected')
                    }
                  }
            }
            $( "#nome__completo" ).on('keyup focus',function() {
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
                    tomador(' ')
                    let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscnpj}">`
                        });
                        $('#datalistOptions').html(nome)
                      }
                      if(data.length === 1 && dados.length >= 4){
                        let tabela = tabelaPreco(data[0].tomador);
                        if (tabela) {
                          tomador(data[0])
                        }else{
                          Alerta(data[0].tomador)
                        }
                      }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function Alerta(tomador) {
                Swal.fire({
                title: '<strong>Algo deu Errado!</strong>',
                icon: 'error',
                html:
                  '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
                  `<a href="{{url('tabelapreco')}}/ /${tomador}">Cadastrar</a> `,
                showCloseButton: true,
                allowOutsideClick: false,
                allowEnterKey: true,
              })
            }
            function tabelaPreco(tomador) {
              var resul = false;
              $.ajax({
                  url: "{{url('verifica/tabela/preco')}}/"+tomador,
                  type: 'get',
                  contentType: 'application/json',
                  async: false,
                  success: function(data) {
                    resul = data
                  }
              })
              return resul;
            }
            function buscatomador(dados) {
              $.ajax({
                  url: "{{url('tomador')}}/"+dados.tomador,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    if (data) {
                      tomador(data)
                      $('#nome__completo').val(data.tsnome)
                      $('#boletim').removeClass('disabled').attr('href',`{{url('boletimcartaoponto')}}/${btoa(dados.id)}/${btoa(data.csdomingos)}/${btoa(data.cssabados)}/${btoa(data.csdiasuteis)}/${btoa(dados.lsdata)}/${btoa(dados.liboletim)}/${btoa(dados.tomador)}/${btoa(dados.lsferiado)}`);
                    }
                  }
              })
            }
            function tomador(data) {
              $('#tomador').val(data.tomador)
              $('#matricula').val(data.tsmatricula)
              $('#domingo').val(data.csdomingos?data.csdomingos: 0.00)
              $('#sabado').val(data.cssabados?data.cssabados:0.00)
              $('#diasuteis').val(data.csdiasuteis)
            }
      </script>
@stop