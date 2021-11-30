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
                    <strong>Não foi porssivél atualizar os dados!</strong>
                </div>
            @elseif($error === 'deletatrue')
                <div class="alert alert-success mt-2 alert-block">
                    <strong>Registro deletador com sucesso!</strong>
                </div>
             @elseif($error === 'cadastratrue')
                <div class="alert alert-success mt-2 alert-block">
                    <strong>Cadastrador realizada com sucesso!</strong>
                </div>
             @elseif($error === 'cadastrafalse')
                <div class="alert alert-danger mt-2 alert-block">
                    <strong>Não foi porssivél realizar o cadastro !</strong>
                </div>
            @endif
            @endforeach
        @endif     
        
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{ route('tabelapreco.store') }}">
                <input type="hidden" value="{{$id}}" name="tomador">
                @if($user->empresa)
                    <input type="hidden" name="empresa" value="{{$user->empresa}}">
                @else
                    <input type="hidden" name="empresa" value="">
                @endif
                @csrf
                <input type="hidden" id="method" name="_method" value="">
                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                      
                      <button type="submit" class="btn btn-primary " id="incluir">
                      Incluir
                        </button>
                        <button type="submit" disabled class="btn btn-primary " id="atualizar">
                      Atualizar
                        </button>
                      <button type="button" disabled id="excluir" class="btn btn-primary ms-2  col-md-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                        </button>
                        
                      
                      <a class="btn btn-primary ms-2 col-md-1" href="{{ route('tomador.index') }}" role="button">Sair</a>
                  </div>
              </div>
              <h5 class="card-title text-center fs-3 ">Tabela de Preços</h5>
                <div class="col-md-2">
                  <label for="ano" class="form-label">Ano</label>
                  <input type="text" class="form-control fw-bold @error('ano') is-invalid @enderror" name="ano" value="" id="ano">
                  @error('ano')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-2">
                    <label for="rubricas" class="form-label">Rúbricas</label>
                    <input type="text" class="form-control pesquisa @error('rubricas') is-invalid @enderror fw-bold" name="rubricas" value="" id="rubricas">
                    @error('rubricas')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-7">
                  <label for="descricao" class="form-label">Descrição</label>
                  <input type="text" class="form-control fw-bold @error('descricao') is-invalid @enderror" list="descricoes" name="descricao"  id="descricao">
                  <datalist id="descricoes">
                   
                   </datalist>
                   @error('rubricas')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                   <span class="text-danger" id="rublicamensagem"></span>
                </div>
              
                <div class="col-md-1">
                  <label for="valor" class="form-label">Valor</label>
                  <input type="text" class="form-control fw-bold @error('valor') is-invalid @enderror" name="valor" value="" id="valor">
                  @error('valor')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </form> 
              
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
        //$(document).ready(function(){
        //   $( "#descricao" ).keyup(function() {
        //         var dados = $(this).val();
        //         $.ajax({
        //             url: "{{url('rublica')}}/"+dados,
        //             type: 'get',
        //             contentType: 'application/json',
        //             success: function(data) {
        //                 $('#descricao').removeClass('is-invalid')
        //                 $('#rublicamensagem').text(' ')
        //                 let nome = ''
        //                 if (data.length > 1) {
        //                     data.forEach(element => {
        //                       nome += `<option value="${element.rsdescricao}">`
        //                     });
        //                     $('#descricoes').html(nome)
        //                 }else if (data.length === 1) {
        //                   $('#rubricas').val(data[0].rsrublica)
        //                 }else{
        //                     $('#rubricas').val(' ')
        //                     $('#descricao').addClass('is-invalid')
        //                     $('#rublicamensagem').text('Esta rublica não esta cadastra.')
        //                 }
        //             }
        //         });
        //     });
           
        //     // $( ".pesquisa" ).keyup(function() {
        //     //     var dados = $(this).val();
        //     //     $.ajax({
        //     //         url: "{{url('tabelapreco')}}/"+dados,
        //     //         type: 'get',
        //     //         contentType: 'application/json',
        //     //         success: function(data) {
        //     //             if (data.id) {
        //     //                 $('#form').attr('action', "{{ url('tabelapreco')}}/"+data.id);
        //     //                 $('#formdelete').attr('action',"{{ url('tabelapreco')}}/"+data.id)
        //     //                 $('#incluir').attr('disabled','disabled')
        //     //                 $('#atualizar').removeAttr( "disabled" )
        //     //                 $('#deletar').removeAttr( "disabled" )
        //     //                 $('#excluir').removeAttr( "disabled" )
        //     //                 $('#method').val('PUT')
        //     //             }else{
        //     //                 $('#form').attr('action', "{{ route('tabelapreco.store') }}");
        //     //                 $('#incluir').removeAttr( "disabled" )
        //     //                 $('#atualizar').attr('disabled','disabled')
        //     //                 $('#deletar').attr('disabled','disabled')
        //     //                 $('#method').val(' ')
        //     //                 $('#excluir').attr( "disabled","disabled" )
        //     //             }
        //     //           $('#ano').val(data.tsano)
        //     //           $('#valor').val(data.tsvalor.toFixed(2).toString().replace(".", ","))
        //     //           $('#descricao').val(data.tsdescricao)
        //     //         }
        //     //     });
        //     // });
        // });
    </script>   
  @stop    
           