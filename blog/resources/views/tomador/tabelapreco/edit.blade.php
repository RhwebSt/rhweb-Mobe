@extends('layouts.index')
@section('conteine')


<div class="container">
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
                  title: 'Cadastro realizado com Sucesso'
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
                  title: 'Não foi possível realizar o cadastro!'
                })
            </script>
        @enderror
        
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{ route('tabelapreco.update',$id) }}">
                  
                  <h5 class="card-title text-center fs-3 ">Tabela de Preços <i class="fad fa-usd-square fa-lg"></i></h5>
                  
                  
                    <input type="hidden" value="{{$tomador}}" name="tomador" id="tomador">
                    @if($user->empresa)
                        <input type="hidden" name="empresa" value="{{$user->empresa}}">
                    @else
                        <input type="hidden" name="empresa" value="">
                    @endif
                    @csrf
            
                    <input type="hidden" id="method" name="_method" value="PUT">
                    <div class="row">
                        
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        
                        <button type="submit" class="btn botao " id="atualizar">Atualizar</button>
                         <button class="btn botao dropdown-toggle d-none" type="button" id="relatoriotrabalhador"  data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-file-invoice"></i> Relatórios
                        </button>
                          <ul class="dropdown-menu" aria-labelledby="relatoriotrabalhador">
                            <li class=""><a href="{{route('tabela.preco.relatorio',$tomador)}}" class="dropdown-item text-decoration-none ps-2"  id="imprimir" role="button">Rol Tabela de Preços</a></li>
                          </ul>
                        <button type="button" disabled id="excluir" class="btn botao d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Excluir</button>
                            
                          
                          <a class="btn botao" href="{{ route('tabelapreco.index',[' ',base64_encode($tomador)]) }}" role="button">Sair</a>
                      </div>
                  </div>


                    <div class="col-md-2">
                      <label for="ano" class="form-label">Ano</label>
                      <input type="text" class=" form-control fw-bold @error('ano') is-invalid @enderror" name="ano" value="{{$tabelaprecos_editar->tsano}}" id="ano">
                      @error('ano')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
    
                    <div class="col-md-3">
                        <label for="rubricas" class="form-label">Código <i class="fas fa-lock"></i></label>
                        <input type="text" class="form-control pesquisa @error('rubricas') is-invalid @enderror fw-bold" name="rubricas" value="{{$tabelaprecos_editar->tsrubrica}}" id="rubricas" readonly>
                        @error('rubricas')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <datalist id="rubricas">
                       
                       </datalist>
                       <span class="text-danger" id="rubricamensagem"></span>
                    </div>
    
                    <div class="col-md-7">
                      <label for="descricao" class="form-label">Descrição <i class="fas fa-lock"></i></label>
                      <input type="text" class="form-control fw-bold  @error('descricao') is-invalid @enderror" list="descricoes" name="descricao" value="{{$tabelaprecos_editar->tsdescricao}}"  id="descricao" readonly>
                      <datalist id="descricoes">
                       
                       </datalist>
                       @error('descricao')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                       <span class="text-danger" id="descricoesmensagem"></span>
                    </div>
                  
                    <div class="col-md-6">
                      <label for="valor" class="form-label">Valor Trabalhador</label>
                      <input type="text" class="form-control fw-bold @error('valor') is-invalid @enderror" name="valor" value="{{number_format((float)$tabelaprecos_editar->tsvalor, 2, ',', '')}}" id="valor">
                      @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="col-md-6">
                      <label for="valor__tomador" class="form-label">Valor Tomador</label>
                      <input type="text" class="form-control fw-bold @error('valor__tomador') is-invalid @enderror" name="valor__tomador" value="{{number_format((float)$tabelaprecos_editar->tstomvalor, 2, ',', '')}}" id="valor__tomador">
                      @error('valor__tomador')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    
                 
              </form> 
              <div class="table-responsive-lg">
              <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                        <thead>
                            <th class="col text-center border-start border-top  text-nowrap" style="width:60px;">Ano</th>
                            <th class="col text-center border-top  text-nowrap" style="width:80px">Código</th>
                            <th class="col text-center border-top  text-nowrap capitalize" style="width:900px">Descrição</th>
                            <th class="col text-center border-top  text-nowrap" style="width:110px;">Valor Trabalhador</th>
                            <th class="col text-center border-top  text-nowrap" style="width:110px;">Valor Tomador</th>
                            <th class="col text-center border-top  text-nowrap d-none" style="width:60px;">Editar</th>
                            <th colspan="2" class="col text-center border-end border-top d-none  text-nowrap" style="width:60px;">Excluir</th>
                        </thead>
                        
                        <tbody style="background-color: #081049; color: white;">
                        @if(count($tabelaprecos) > 0)
                          @foreach($tabelaprecos as $tabelapreco)
                            <tr>
                            <td class="col text-center border-start  border-bottom text-nowrap text-uppercase" style="width:60px;">{{$tabelapreco->tsano}}</td>
                            <td class="col text-center  border-bottom text-nowrap text-uppercase"style="width:80px;" >{{$tabelapreco->tsrubrica}}</td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase " style="width:900px;">{{$tabelapreco->tsdescricao}}</td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:110px;">R$ {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}</td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:110px;">R$ {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}</td>
                            <td class="col text-center d-none  border-bottom  text-nowrap text-uppercase" style="width:60px;">
                                <button class="btn " style="background-color:#204E83;">
                                <a href="{{route('tabela.preco.editar',[$tabelapreco->id,$tomador])}}" class="" ><i style="color:#FFFFFF; padding-left: 3px;" class="fal fa-edit"></i></a>
                                </button>
                            </td>
                            <td colspan="2" class="col text-center d-none border-end border-bottom text-nowrap" style="width:60px;">
                                <form action="{{route('tabelapreco.destroy',$tabelapreco->id)}}" method="post">
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
                                    Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </td>
                            </tr>
                            @endif
                        </tbody>
                          <tfoot>
                                <tr class=" border-end border-start border-bottom">
                                    <td colspan="11">
                                    {{ $tabelaprecos->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
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
        $(document).ready(function(){
          $( "#pesquisa" ).on('keyup focus',function() { 
                let dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                  }
                }
              var tomador = $('#tomador').val();
              $('#icon').addClass('d-none').next().removeClass('d-none')
              $.ajax({
                  url: "{{url('tabelapreco')}}/pesquisa/"+dados+'/'+tomador,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    $('#refres').addClass('d-none').prev().removeClass('d-none')
                    let nome = ''
                    if (data.length >= 1) {
                      data.forEach(element => {
                        nome += `<option value="${element.tsrubrica}  ${element.tsdescricao}">`
                        // nome += `<option value="${element.tsdescricao}">`
                      });
                      $('#datalistOptions').html(nome);
                    } 
                    if (data.length === 1 && dados.length > 3) {
                      buscaIntem(dados,tomador)
                    }else{
                      campos()
                    }
                  }
                })
          });
          function monta_dados(dados) {
            let novodados = dados.split('  ')
            return novodados[0];
          }
            function buscaIntem(dados,tomador) {
              $('#carregamento').removeClass('d-none')
              $.ajax({
                url: "{{url('tabelapreco')}}/perfil/"+dados+'/'+tomador,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                  tabelapreco(data)
                  $('#carregamento').addClass('d-none')
                }
              })
            }
            function campos() {
              $('#form').attr('action', "{{ route('tabelapreco.store') }}");
              $('#incluir').removeAttr( "disabled" )
              $('#atualizar').attr('disabled','disabled')
              $('#deletar').attr('disabled','disabled')
              $('#method').val(' ')
              $('#excluir').attr( "disabled","disabled" )
              $('#rubricas').val(' ');
              $('#ano').val(' ')
              $('#valor').val(' ')
              $('#descricao').val(' ')
              $('#valor__tomador').val(' ')
            }
           function tabelapreco(data) {
              if (data.id) {
                    $('#form').attr('action', "{{ url('tabelapreco')}}/"+data.id);
                    $('#formdelete').attr('action',"{{ url('tabelapreco')}}/"+data.id)
                    $('#incluir').attr('disabled','disabled')
                    $('#atualizar').removeAttr( "disabled" )
                    $('#deletar').removeAttr( "disabled" )
                    $('#excluir').removeAttr( "disabled" )
                    $('#method').val('PUT')
                }else{
                    $('#form').attr('action', "{{ route('tabelapreco.store') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#excluir').attr( "disabled","disabled" )
                }
              $('#rubricas').val(data.tsrubrica);
              $('#ano').val(data.tsano)
              $('#valor').val(data.tsvalor.toFixed(2).toString().replace(".", ","))
              $('#valor__tomador').val( parseFloat(data.tstomvalor).toFixed(2).toString().replace(".", ","))
              $('#descricao').val(data.tsdescricao)
           }
        });
    </script>   
  @stop    
  
  
    
