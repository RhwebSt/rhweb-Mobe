@extends('layouts.index')
@section('conteine')
<div class="container">
              <h5 class="card-title text-center fs-3 ">Cadastro de Usuários</h5>

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


              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('usuario.store')}}">
              @csrf
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="empresa" id="idempresa">
                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                  <button type="submit" id="incluir" class="btn  text-white btn-primary "  >
                        Incluir
                      </button>
                      <button type="submit" id="atualizar" disabled class="btn  text-white btn-primary "  >
                        Editar
                      </button>
                    <button type="button" id="excluir" disabled class="btn  text-white btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                        Excluir
                      </button>
                   
                    

                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Permissões
                      </button>
  
                      <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#080808;">
                              <h5 class="modal-title text-black text-white" id="exampleModalLabel">Permissões</h5>
                              <button type="button" class="btn-close bg-white " data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-black ">
                                <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                      Administrador
                                    </label>
                                  </div>
                                  <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label text-black text-start" for="defaultCheck1">
                                      Usuário
                                    </label>
                                  </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                              <a class="btn btn-success" href="#" role="button">Salvar</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <a class="btn   text-white btn-primary " href="#" role="button" >Sair</a>
                  </div>
              </div>

                <div class="col-md-4">
                  <label for="nome__completo" class="form-label">Nome do tomador</label>
                  <input type="text" class="form-control pesquisa" name="nome__completo" value="" id="nome__completo">
                </div>

                <div class="col-md-3">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" class="form-control" name="usuario" value="" id="usuario">
                </div>
                <input type="hidden" name="email">
                <div class="col-md-2">
                  <label for="cargo" class="form-label">Cargo</label>
                  <input type="text" class="form-control" name="cargo" value="" id="cargo">
                </div>

                <div class="col-md-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control" name="senha" value="" id="senha">
                </div>
              </form>  
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header " style="background-image: linear-gradient(50deg, rgb(69, 71, 243),rgb(91, 9, 199))">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-image: linear-gradient(170deg, rgb(2, 19, 97),rgb(19, 1, 70));">
                    <p class="text-white text-start fs-5">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer" style="background-image: linear-gradient(50deg, rgb(69, 71, 243),rgb(91, 9, 199))">
                    <button type="button" class="btn btn-success btn-outline-light" data-bs-dismiss="modal">Fechar</button>
                    <form action="" method="post" id="formdelete">
                    @csrf
                        @method('delete')
                        
                        
                        <button type="submit" class="btn btn-danger" >Deletar</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div> 
            <script>
        $(document).ready(function(){
          $( "#usuario" ).keyup(function() {
                var dados = $(this).val();
                $.ajax({
                    url: "{{url('usuario')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data.id) {
                            $('#form').attr('action', "{{ url('usuario')}}/"+data.id);
                            $('#formdelete').attr('action',"{{ url('usuario')}}/"+data.id)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            $('#deletar').removeAttr( "disabled" )
                            $('#excluir').removeAttr( "disabled" )
                            $('#method').val('PUT')
                            $('#nome__completo').val(data.esnome)
                            $('#cargo').val(data.cargo)
                        }else{
                        
                            $('#form').attr('action', "{{ route('usuario.store') }}");
                            $('#incluir').removeAttr( "disabled" )
                            $('#depedente').removeAttr( "disabled" )
                            $('#atualizar').attr('disabled','disabled')
                            $('#deletar').attr('disabled','disabled')
                            $('#method').val(' ')
                            $('#excluir').attr( "disabled" )
                        }
                       
                    }
                });
            });
            $( ".pesquisa" ).keyup(function() {
                var dados = $(this).val();
                $.ajax({
                    url: "{{url('usuariotrabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#idempresa').val(data.empresa)
                    }
                });
            });
        });
    </script>  
@stop