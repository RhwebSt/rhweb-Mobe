@extends('layouts.index')
@section('conteine')


<div class="container">
                @if($errors->all())
            @foreach($errors->all() as  $error)
              @if($error === 'edittrue')
                <div class="alert alert-success mt-2 alert-block">
                    <strong>Atualização realizada com sucesso!</strong>
                </div>
             @elseif($error === 'editfalse')
                <div class="alert alert-danger mt-2 alert-block">
                    <strong>Não foi possível atualizar os dados!</strong>
                </div>
            @elseif($error === 'deletatrue')
                <div class="alert alert-success mt-2 alert-block">
                    <strong>Registro deletado com sucesso!</strong>
                </div>
             @elseif($error === 'cadastratrue')
                <div class="alert alert-success mt-2 alert-block">
                    <strong>Cadastrado realizada com sucesso!</strong>
                </div>
             @elseif($error === 'cadastrafalse')
                <div class="alert alert-danger mt-2 alert-block">
                    <strong>Não foi possível realizar o cadastro !</strong>
                </div>
            @endif
            @endforeach
        @endif     
        
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{ route('tabelapreco.store') }}">
                  
                  <h5 class="card-title text-center fs-3 ">Tabela de Preços</h5>
                  
                  
                    <input type="hidden" value="{{$tomador}}" name="tomador">
                    @if($user->empresa)
                        <input type="hidden" name="empresa" value="{{$user->empresa}}">
                    @else
                        <input type="hidden" name="empresa" value="">
                    @endif
                    @csrf
                    <input type="hidden" id="method" name="_method" value="">
                    <div class="row">
                        
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                          
                          <button type="submit" class="btn botao " id="incluir">
                          Incluir
                            </button>
                            <button type="submit" disabled class="btn botao " id="atualizar">
                          Atualizar
                            </button>
                          <button type="button" disabled id="excluir" class="btn botao" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Excluir
                            </button>
                            
                          
                          <a class="btn botao" href="{{ route('tomador.index') }}" role="button">Sair</a>
                      </div>
                  </div>
                  
                  <div>
                      <div class="col-md-4 mt-2 mb-3">
                        <label for="exampleDataList" class="form-label">Buscar</label>
                        <input class="pesquisa form-control fw-bold text-dark" list="datalistOptions" name="pesquisa" id="pesquisa">
                        <datalist id="datalistOptions">
                            <!-- <option value="San Francisco">
                            <option value="New York">
                            <option value="Seattle">
                            <option value="Los Angeles">
                            <option value="Chicago"> -->
                        </datalist>
                    </div>
                </div>
                  
                    <div class="col-md-2">
                      <label for="ano" class="form-label">Ano</label>
                      <input type="text" class="form-control fw-bold @error('ano') is-invalid @enderror" name="ano" value="" id="ano">
                      @error('ano')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
    
                    <div class="col-md-3">
                        <label for="rubricas" class="form-label">Código</label>
                        <input type="text" class="form-control pesquisa @error('rubricas') is-invalid @enderror fw-bold" name="rubricas" value="" id="rubricas">
                        @error('rubricas')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <datalist id="rubricas">
                       
                       </datalist>
                       <span class="text-danger" id="rubricamensagem"></span>
                    </div>
    
                    <div class="col-md-7">
                      <label for="descricao" class="form-label">Descrição</label>
                      <input type="text" class="form-control fw-bold  @error('descricao') is-invalid @enderror" list="descricoes" name="descricao"  id="descricao">
                      <datalist id="descricoes">
                       
                       </datalist>
                       @error('rubricas')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                       <span class="text-danger" id="descricoesmensagem"></span>
                    </div>
                  
                    <div class="col-md-3">
                      <label for="valor" class="form-label">Valor Trabalhador</label>
                      <input type="text" class="form-control fw-bold @error('valor') is-invalid @enderror" name="valor" value="" id="valor">
                      @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    <div class="col-md-3">
                      <label for="valor__tomador" class="form-label">Valor Tomador</label>
                      <input type="text" class="form-control fw-bold @error('valor') is-invalid @enderror" name="valor__tomador" value="" id="valor__tomador">
                      @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    
                    
                 
              </form> 
              <div class="table-responsive-lg">
              <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                        <thead>
                            <th class="col text-center border-start border-top  text-nowrap" style="width:60px;">Ano</th>
                            <th class="col text-center border-top  text-nowrap" style="width:80px">Código</th>
                            <th class="col text-center border-top  text-nowrap capitalize" style="width:890px">Descrição</th>
                            <th class="col text-center border-top  text-nowrap" style="width:180px;">Valor Trabalhador</th>
                            <th class="col text-center border-top  text-nowrap" style="width:180px;">Valor Tomador</th>
                            <th colspan="2" class="col text-center border-end border-top  text-nowrap" style="width:190px;">Excluir</th>
                        </thead>
                        
                        <tbody style="background-color: #081049; color: white;">
                        @if(count($tabelaprecos) > 0)
                          @foreach($tabelaprecos as $tabelapreco)
                            <tr>
                            <td class="col text-center border-start  border-bottom text-nowrap" style="width:60px;">{{$tabelapreco->tsano}}</td>
                            <td class="col text-center   border-bottom text-nowrap" style="width:80px">{{$tabelapreco->tsrubrica}}</td>
                            <td class="col text-center  border-bottom  text-nowrap capitalize" style="width:900px">{{$tabelapreco->tsdescricao}}</td>
                            <td class="col text-center  border-bottom  text-nowrap" style="width:110px;">R$ {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}</td>
                            <td class="col text-center  border-bottom  text-nowrap" style="width:110px;">R$ {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}</td>

                            <td colspan="2" class="col text-center border-end border-bottom text-nowrap" style="width:190px;">
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
                              <td colspan="8" class="bg-light text-black">
                                <div class="alert alert-danger" role="alert">
                                    Não á registro cadastrado!
                                </div>
                              </td>
                            </tr>
                            @endif
                        </tbody>

                        </table>
                    </div>
              
              
              
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header " style="background-color:#000000;">
                      <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                      <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-black text-start">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                      <form action="" id="formdelete" method="post">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Deletar</button>
                    </form> 
                    </div>
                  </div>
                </div>
              </div>
</div>
            
            
            
      <script>
        $(document).ready(function(){
          $( ".pesquisa" ).keyup(function() {
                var dados = $(this).val();
                var tagname = $(this).attr('name');
                if (dados) {
                  $.ajax({
                    url: "{{url('tabelapreco')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        $('#rubrica').removeClass('is-invalid')
                        $('#rubricamensagem').text(' ')
                        $('#descricao').removeClass('is-invalid')
                        $('#descricoesmensagem').text(' ')
                        let nome = ''
                        if (data.length > 1) {
                            data.forEach(element => {
                              nome += `<option value="${element.rsdescricao}">`
                            });
                            if (tagname === 'rubricas') {
                              $('#rubricas').html(nome);
                            }else{
                              $('#descricoes').html(nome)
                            }
                        }else if (data.length === 1) {
                          if (tagname === 'rubrica') {
                            $('#rubricas').val(data[0].rsrublica)
                          }else{
                            $('#descricao').val(data[0].tsdescricao)
                          }
                          tabelapreco(data[0])
                        }else{
                          if (tagname === 'rubricas') {
                            $('#rubrica').addClass('is-invalid')
                            $('#rubricamensagem').text('Esta codigo não esta cadastra.')
                          }else if (tagname === 'descricao'){
                            $('#descricao').addClass('is-invalid')
                            $('#descricoesmensagem').text('Esta rublica não esta cadastra.')
                          }
                        }
                    }
                  });
                }else{
                  if (tagname === 'rubricas') {
                    $('#rubricas').val(' ');
                    $('#ano').val(' ')
                    $('#valor').val(' ')
                    $('#descricao').val(' ')
                    $('#valor__tomador').val(' ')
                  }else{
                    $('#rubricas').val(' ');
                    $('#ano').val(' ')
                    $('#valor').val(' ')
                    $('#descricao').val(' ')
                    $('#valor__tomador').val(' ')
                  }
                }
            });
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
              $('#ano').val(data.tsano)
              $('#valor').val(data.tsvalor.toFixed(2).toString().replace(".", ","))
              $('#valor__tomador').val( parseFloat(data.tstomvalor).toFixed(2).toString().replace(".", ","))
              $('#descricao').val(data.tsdescricao)
           }
        });
    </script>   
  @stop    
