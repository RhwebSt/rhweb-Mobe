@extends('layouts.index')
@section('conteine')
<div class="card-body">
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
              <h5 class="card-title text-center fs-3 ">Lançamento com Tabela</h5>

               

                <div class="container">
              <form class="row g-3 mt-1 mb-3" method="POST" id="form" action="{{route('tabcartaoponto.store')}}">
              @csrf
              <input type="hidden" id="method" name="_method" value="">
              
                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn botao">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                        <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                    <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
                  </div>
              </div>

              
                <div class="col-md-6 input">
                  <label for="tomador" class="form-label">Tomador</label>
                  <input type="text" list="datalistOptions" class=" fw-bold form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="" id="nome__completo">
                  <datalist id="datalistOptions">
                  </datalist>
                  @error('nome__completo')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                  @error('tomador')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                
                  <input type="hidden" name="tomador"  class="@error('tomador') is-invalid @enderror" id="tomador">
                  
                <div class="col-md-1">
                    <label for="matricula" class="form-label ">Matrícula</label>
                    <input type="text" class="form-control fw-bold @error('matricula') is-invalid @enderror " name="matricula" value="" id="matricula">
                    @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                <div class="col-md-2">
                    <label for="num__boletim" class="form-label">Nº do Boletim</label>
                    <input type="text" class="form-control fw-bold @error('liboletim') is-invalid @enderror" name="liboletim" id="num__boletim">
                    @error('liboletim')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-2">
                  <label for="data" class="form-label">Data</label>
                  <input type="date" class="form-control fw-bold @error('data') is-invalid @enderror" name="data" value="" id="data">
                    @error('data')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-2">
                  <label for="num__trabalhador" class="form-label">Nº de Trabalhador</label>
                  <input type="text" class="form-control fw-bold @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="" id="num__trabalhador">
                  @error('num__trabalhador')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                </form> 
              </div>
              
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header " style="background-image: linear-gradient(-120deg, rgb(32, 36, 236),rgb(16, 78, 248));">
                      <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color: #fffdfd;">
                      <p class="text-black text-start fs-5">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer" style="background-color: #fffdfd;">
                      <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#1e53ff;">Fechar</button>
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
               $( "#num__boletim" ).keyup(function() {
                var dados = $(this).val();
                if (dados) {
                    $.ajax({
                        url: "{{url('tabcartaoponto')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                          if (data.id) {
                                $('#form').attr('action', "{{ url('tabcartaoponto')}}/"+data.id);
                                $('#formdelete').attr('action',"{{ url('tabcartaoponto')}}/"+data.id)
                                $('#incluir').attr('disabled','disabled')
                                $('#atualizar').removeAttr( "disabled" )
                                $('#deletar').removeAttr( "disabled" )
                                $('#excluir').removeAttr( "disabled" )
                                $('#method').val('PUT')
                                buscatomador(data.tomador)
                            }else{
                                $('#form').attr('action', "{{ route('tabcartaoponto.store') }}");
                                $('#incluir').removeAttr( "disabled" )
                                $('#atualizar').attr('disabled','disabled')
                                $('#deletar').attr('disabled','disabled')
                                $('#method').val(' ')
                                $('#excluir').attr( "disabled",'disabled' )
                            }
                            $('#num__boletim').removeClass('is-invalid').next().text(' ')
                            $('#matricula').removeClass('is-invalid').next().text(' ')
                            $('#nome__completo').removeClass('is-invalid').next().text(' ')
                            $('#data').val(data.lsdata).removeClass('is-invalid').next().text(' ')
                            $('#num__trabalhador').val(data.lsnumero).removeClass('is-invalid').next().text(' ')
                        }
                    });
                }
            });
               $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                $.ajax({
                  url: "{{url('tomador')}}/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    tomador(' ')
                    let nome = ''
                      if (data.length > 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#datalistOptions').html(nome)
                        
                      }else if(data.length === 1){
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#datalistOptions').html(nome)
                        tomador(data[0])
                      }           
                  }
              });
            });
            function buscatomador(dados) {
              $.ajax({
                  url: "{{url('tomador')}}/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    if (data.length === 1) {
                      tomador(data[0])
                      $('#nome__completo').val(data[0].tsnome)
                    }
                  }
              })
            }
            function tomador(data) {
              $('#tomador').val(data.tomador)
              // $('#nome__completo').val(data.tsnome)
              $('#matricula').val(data.tsmatricula)
              $('#domingo').val(data.csdomingos)
              $('#sabado').val(data.cssabados)
              $('#diasuteis').val(data.csdiasuteis)
            }
            </script>        
@stop