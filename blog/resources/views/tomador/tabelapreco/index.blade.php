@extends('layouts.index')
@section('titulo','Rhweb - Tabela de preço')
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
                  title: '{{session("success")}}',
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
        @error('tabelavazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Relatório vazio',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{ route('tabelapreco.store') }}">
                  
                  <h5 class="card-title text-center fs-3 ">Tabela de Preços <i class="fad fa-usd-square fa-lg"></i></h5>
                  
                  
                    <input type="hidden" value="{{$tomador}}" name="tomador" id="tomador">
                    @if($user->empresa)
                        <input type="hidden" name="empresa" value="{{$user->empresa}}">
                    @else
                        <input type="hidden" name="empresa" value="">
                    @endif
                    @csrf
                    <input type="hidden" id="method" name="_method" value="">
                    <div class="row">
                        
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" class="btn botao " id="incluir"><i class="fad fa-save"></i> Incluir </button>
                        <button type="submit" disabled class="btn botao  d-none" id="atualizar"><i class="fad fa-sync-alt"></i> Atualizar</button>
                         <button class="btn botao dropdown-toggle" type="button" id="relatoriotrabalhador"  data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-file-alt"></i> Relatórios
                        </button>
                          <ul class="dropdown-menu" aria-labelledby="relatoriotrabalhador">
                            <li class=""><a href="{{route('tabela.preco.relatorio',$tomador)}}" class="dropdown-item text-decoration-none ps-2"  id="imprimir" role="button">Rol Tabela de Preços</a></li>
                          </ul>
                        <button type="button" disabled id="excluir" class="btn botao d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Excluir</button>
                            
                          
                          <a class="btn botao" href="{{ route('tomador.index') }}" role="button"><i class="fad fa-sign-out-alt"></i> Sair </a>
                      </div>
                  </div>

                        <div>
                            <div class="col-md-5 mt-5 mb-5 p-1 pesquisar">
                                <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                <datalist id="datalistOptions">
                                    
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
                        
                    <div class="col-md-7">
                      <label for="descricao" class="form-label">Descrição <span id="refre" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span></label>
                      <input type="text"   class="form-control fw-bold  @error('descricao') is-invalid @enderror" list="descricoes"  value="{{old('descricao')}}"  id="descricao">
                      <input type="hidden" name="descricao" value="{{old('descricao')}}">
                      <datalist id="descricoes">
                       
                       </datalist>
                       @error('descricao')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                       <span class="text-danger" id="descricoesmensagem"></span>
                    </div>
                    <input type="hidden" name="status" value="produção">
                    <div class="col-md-3">
                        <label for="rubricas" class="form-label">Código</label>
                        <input type="text"  class="form-control  pesquisa @error('rubricas') is-invalid @enderror fw-bold"  value="{{old('rubricas')}}" id="rubricas">
                        <input type="hidden" name="rubricas" value="{{old('descricao')}}">
                        @error('rubricas')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <datalist id="rubricas">
                       
                       </datalist>
                       <span class="text-danger" id="rubricamensagem"></span>
                    </div>
                  
                    <div class="col-md-2">
                      <label for="ano" class="form-label">Ano</label>
                      <input type="text" class="form-control fw-bold @error('ano') is-invalid @enderror" name="ano" value="{{old('ano')}}" id="ano">
                      @error('ano')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
    
                    
    
                    
                  
                    <div class="col-md-6">
                      <label for="valor" class="form-label">Valor Trabalhador</label>
                      <input type="text" class="form-control fw-bold @error('valor') is-invalid @enderror" name="valor" value="{{old('valor')}}" id="valor">
                      @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="col-md-6">
                      <label for="valor__tomador" class="form-label">Valor Tomador</label>
                      <input type="text" class="form-control fw-bold @error('valor__tomador') is-invalid @enderror" name="valor__tomador" value="{{old('valor__tomador')}}" id="valor__tomador">
                      @error('valor__tomador')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    
                 
              </form> 
              <div class="table-responsive-xxl">
              <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                        <thead>
                            <th class="col text-center border-start border-top  text-nowrap" style="width:60px;">Ano</th>
                            <th class="col text-center border-top  text-nowrap" style="width:80px">Código</th>
                            <th class="col text-center border-top  text-nowrap capitalize" style="width:900px">Descrição</th>
                            <th class="col text-center border-top  text-nowrap" style="width:110px;">Valor Trabalhador</th>
                            <th class="col text-center border-top  text-nowrap" style="width:110px;">Valor Tomador</th>
                            <th class="col text-center border-top  text-nowrap" style="width:60px;">Editar</th>
                            <th colspan="2" class="col text-center border-end border-top  text-nowrap" style="width:60px;">Excluir</th>
                        </thead>
                        
                        <tbody style="background-color: #081049; color: white;">
                        @if(count($tabelaprecos) > 0)
                          @foreach($tabelaprecos as $tabelapreco)
                            <tr class="bodyTabela">
                            <td class="col text-center border-start  border-bottom text-nowrap text-uppercase" style="width:60px;">{{$tabelapreco->tsano}}</td>
                            <td class="col text-center  border-bottom text-nowrap text-uppercase" style="width:80px">
                                <button type="button" class="btn text-white text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$tabelapreco->tsrubrica}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                    <a class="text-uppercase text-decoration-none text-white">{{$tabelapreco->tsrubrica}}</a>
                                </button>
                            </td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:900px">
                                <button type="button" class="btn text-white text-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$tabelapreco->tsdescricao}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                    <a class="text-uppercase text-decoration-none text-white">{{$tabelapreco->tsdescricao}}</a>
                                </button>
                            </td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:110px;">R$ {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}</td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:110px;">R$ {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}</td>
                            <td class="col text-center  border-bottom  text-nowrap text-uppercase" style="width:60px;">
                                <button class="btn">
                                <a href="{{route('tabela.preco.editar',[base64_encode($tabelapreco->id),base64_encode($tomador)])}}" class="btn__padrao--editar" ><i style="color:#FFFFFF; padding-left: 3px;" class="fal fa-edit"></i></a>
                                </button>
                            </td>
                            <td colspan="2" class="col text-center border-end border-bottom text-nowrap" style="width:60px;">
                                <form action="{{route('tabelapreco.destroy',$tabelapreco->id)}}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button type="submit" class="btn btn__padrao--excluir"><i style="color:#FFFFFF; padding-right: 1px;" class="fal fa-trash"></i></button>
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
          $('#refre').click(function () {
            $('#rubricas').val(' ').removeAttr('disabled')
            $('#descricao').val(' ').removeAttr('disabled');
          })
          $('#rubricas').on('keyup',function () {
            $('input[name="rubricas"]').val($(this).val());
          })
          $('#descricao').on('focus keyup',function() {
            let dados = '0'
            if ($(this).val()) {
              dados = $(this).val()
              if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
              }
            }
            $('input[name="descricao"]').val(dados)
            $.ajax({
                url: "{{url('rublica/pesquisa')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    let rublica = ['1000','1002','1003','1004','1005','1006','1007']
                    if (data.length >= 1) {
                        data.forEach(element => {
                          if (rublica.indexOf(element.rsrublica) !== -1) {
                            nome += `<option value="${element.rsrublica}  ${element.rsdescricao}">`
                          }
                        });
                      $('#descricoes').html(nome)
                    }
                    if(data.length === 1 && dados.length >= 4){
                      buscaItemRublica(dados)
                    }
                }
            })
        })
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
          function buscaItemRublica(dados) {
            $.ajax({
                url: "{{url('rublica')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    $('#rubricas').val(data.rsrublica).attr('disabled','disabled')
                    $('#descricao').val(data.rsdescricao).attr('disabled','disabled');
                    $('input[name="rubricas"]').val(data.rsrublica)
                    $('input[name="descricao"]').val(data.rsdescricao)
                }
            })
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
  
  
    
