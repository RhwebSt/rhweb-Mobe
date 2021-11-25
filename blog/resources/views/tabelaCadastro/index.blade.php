@extends('layouts.index')
@section('conteine')

<div class="container">
       

        <h1 class="container text-center mt-3 fs-4 mb-5">Lançamento com Tabela de Preço</h1>

        @error('true')
            <div class="alert alert-success"  role="alert">
                {{$message}}
            </div>
        @enderror
        @error('false')
            <div class="alert alert-danger"  role="alert">
                {{$message}}
            </div>
        @enderror

        <form class="row g-3 mt-1 mb-5" method="POST" action="{{route('tabcadastro.store')}}">
        @csrf
        <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn btn-primary">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-primary  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                    <a class="btn btn btn-primary" href="{{route('tabcartaoponto.index')}}" role="button">Sair</a>
                  </div>
              </div>
            <input type="hidden" name="lancamento" value="{{$id}}">
            <div class="col-md-10 input">
                <label for="nome__completo" class="form-label ">Nome do Trabalhador</label>
                <input type="text" class="form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="" id="nome__completo">
                @error('nome__completo')
                      <span class="">{{ $message }}</span>
                  @enderror
            </div>
            <input type="hidden" name="trabalhador" id="trabalhador">
            <div class="col-md-2 input">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control  @error('matricula') is-invalid @enderror" name="matricula" value="" id="matricula">
                @error('matricula')
                      <span class="">{{ $message }}</span>
                  @enderror
            </div>

            <div class="col-md-2 input">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control @error('licodigo') is-invalid @enderror" name="licodigo" value="" id="codigo">
                @error('licodigo')
                      <span class="">{{ $message }}</span>
                  @enderror
            </div>

            <div class="col-md-8 input">
                <label for="rubrica" class="form-label">Rúbrica</label>
                <input type="text" class="form-control @error('rubrica') is-invalid @enderror" list="datalistOptions" name="rubrica" value="" id="rubrica">
                @error('rubrica')
                      <span class="">{{ $message }}</span>
                  @enderror
                <datalist id="datalistOptions">
                    <option value="San Francisco">
                    <option value="New York">
                    <option value="Seattle">
                    <option value="Los Angeles">
                    <option value="Chicago">
                  </datalist>
            </div>

            <div class="col-md-2 input">
                <label for="quantidade" class="form-label">Quantidade/Tonelada</label>
                <input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="" id="quantidade">
                @error('quantidade')
                      <span class="">{{ $message }}</span>
                  @enderror
            </div>
            

        </form>

        <table class="table table-sm border-bottom  text-white table-responsive mt-5" style="background-color: #353535;">
            <thead>
                <th class="col text-white">Cod</th>
                <th colspan="2" class="col text-white">Rúbrica</th>
                <th class="col text-white">Quantidade/Tonelada</th>
            </thead>
            <tbody>
                @if(count($lista) > 0)
                @foreach($lista as $listas)
                    <tr>
                        <td class="bg-light text-black">{{$listas->licodigo}}</td>
                        <td class="bg-light text-black">{{$listas->lshistorico}}</td>
                        <td class="bg-light text-black"></td>
                        <td class="bg-light text-black">{{$listas->lsquantidade}}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="4" class="bg-light text-black">
                        <div class="alert alert-danger" role="alert">
                            Não a registro cadastrador!
                        </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

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
                  <form action="">
                  <a class="btn ms-2 text-white" href="#" role="button" style="background-color:#bb0202;">Deletar</a> 
                </form> 
                </div>
              </div>
            </div>
          </div>
          <script>
                $( "#rubrica" ).keyup(function() {
                    var dados = $(this).val();
                    $.ajax({
                        url: "{{url('rublica')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            data.forEach(element => {
                                $('#datalistOptions').html(`<option value="${element.rsrublica}">`)
                            });
                        }
                    });
                });
                $( "#codigo" ).keyup(function() {
                    var dados = $(this).val();
                    $.ajax({
                        url: "{{url('tabcadastro')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                           console.log(data)
                            if (data.id) {
                                $('#form').attr('action', "{{ url('tabcadastro')}}/"+data.tomador);
                                // $('#formdelete').attr('action',"{{ url('tabcadastro')}}/"+data.tomador)
                                $('#incluir').attr('disabled','disabled')
                                $('#atualizar').removeAttr( "disabled" )
                                $('#deletar').removeAttr( "disabled" )
                                $('#excluir').removeAttr( "disabled" )
                                $('#method').val('PUT')
                            
                            }else{
                                $('#form').attr('action', "{{ route('tabcadastro.store') }}");
                                $('#incluir').removeAttr( "disabled" )
                                $('#atualizar').attr('disabled','disabled')
                                $('#deletar').attr('disabled','disabled')
                                $('#method').val(' ')
                                $('#excluir').attr( "disabled",'disabled')
                            }
                            $('#nome__completo').val(data.tsnome)
                            $('#matricula').val(data.tsmatricula)
                            $('#codigo').val(data.licodigo)
                            $('#quantidade').val(data.lsquantidade)
                            $('#rubrica').val(data.lshistorico)
                        }
                    });
                });
                $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                if (dados) {
                  trabalhador(dados)
                }
            });
            function trabalhador(dados) {
                $.ajax({
                        url: "{{url('trabalhador')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            console.log(data)
                          if (data.id) {
                            $('#trabalhador').val(data.trabalhador)
                            $('#matricula').val(data.tsmatricula)
                          }
                        }
                    });
            }
          </script>
@stop