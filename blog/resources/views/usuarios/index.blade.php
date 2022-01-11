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
                          title: '{{$message}}'
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

              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('user.store')}}">
              @csrf
              
              <h5 class="card-title text-center mt-5 fs-3 ">Cadastro de Usuários</h5>
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="empresa" id="idempresa">
                <div class="row">
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                  <button type="submit" id="incluir" class="btn botao "  >
                        Incluir
                      </button>
                      <button type="submit" id="atualizar" disabled class="btn btn botao "  >
                        Editar
                      </button>
                    <button type="button" id="excluir" disabled class="btn  btn botao " data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                        Excluir
                      </button>
                   
                    

                      <button type="button" disabled class="btn btn botao" id="permicao" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

                      <a class="btn btn botao " href="{{route('home.index')}}" role="button" >Sair</a>
                  </div>
              </div>

              
              <div class="col-md-4">
                  <label for="nome__completo" class="form-label">Nome do tomador</label>
                  <input class="form-control fw-bold @error('nome__completo') is-invalid @enderror  @error('empresa') is-invalid @enderror" list="datalistOptions" value="{{old('nome__completo')}}" name="nome__completo" id="nome__completo" >
                  @error('nome__completo')
                      <span class="">{{ $message }}</span>
                  @enderror
                  @error('empresa')
                      <span class="">{{ $message }}</span>
                  @enderror
                  <span class="invalid-feedback" id="mensagemtomador"></span>
                  <datalist id="datalistOptions">    
                  </datalist>
                </div>
                <div class="col-md-3">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" list="listusuario" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"   name="name" value="" id="usuario">
                  @error('name')
                      <span class="">{{ $message }}</span>
                  @enderror
                  <span class="invalid-feedback" id="mensagemuser"></span>
                  <datalist id="listusuario">    
                  </datalist>
                </div>
                <input type="hidden" name="email">
                <div class="col-md-2">
                  <label for="cargo" class="form-label">Cargo</label>
                  <input type="text" class="form-control " name="cargo" value="{{old('cargo')}}" id="cargo">
                </div>

                <div class="col-md-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control @error('senha') is-invalid @enderror" value="{{old('senha')}}" name="senha" value="" id="senha">
                  @error('senha')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>
              
              </form>  
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
          $( "#usuario" ).on('keyup focus',function() {
                var dados = 0;
                if ($(this).val()) {
                  dados = $(this).val();
                }
                $.ajax({
                      url: "{{url('user/pesquisa')}}/"+dados, 
                      type: 'get',
                      success: function(data) {
                      // $('#mensagemtomador').text(' ')
                      // $( "#usuario" ).removeClass('is-invalid')
                        let nome = '';
                        if (data.length >= 1) {
                            data.forEach(element => {
                              nome += `<option value="${element.name}">`
                            });
                            $('#listusuario').html(nome)    
                        }
                        if(data.length === 1 && dados.length >= 2){
                          usuario(dados)
                        }
                      }
                });
            });
            function usuario(dados) {
              $.ajax({
                url: "{{url('user')}}/"+dados, 
                type: 'get',
                success: function(data) {
                  campos(data)
                }
              })
            }
            function campos(data) {
              if (data.id) {
                  $('#form').attr('action', "{{ url('user')}}/"+data.id);
                  $('#formdelete').attr('action',"{{ url('user')}}/"+data.id)
                  $('#incluir').attr('disabled','disabled')
                  $('#atualizar').removeAttr( "disabled" )
                  $('#deletar').removeAttr( "disabled" )
                  $('#excluir').removeAttr( "disabled" )
                  $('#permicao').removeAttr( "disabled" )
                  $('#method').val('PUT')
                  $('#nome__completo').val(data.esnome)
                  $('#cargo').val(data.cargo)
                  $('#senha').val('')
                  $('#idempresa').val(data.empresa)
              }else{
                  $('#form').attr('action', "{{ route('user.store') }}");
                  $('#incluir').removeAttr( "disabled" )
                  $('#depedente').removeAttr( "disabled" )
                  $('#atualizar').attr('disabled','disabled')
                  $('#deletar').attr('disabled','disabled')
                  $('#permicao').attr('disabled','disabled')
                  $('#method').val(' ')
                  $('#excluir').attr( 'disabled','disabled' )
                  // $('#nome__completo').val('')
                  $('#cargo').val('')
                  $('#senha').val('')
              }
            }
            $( "#nome__completo" ).on('keyup focus',function() {
                var dados = 0;
                if ( $(this).val()) {
                  dados = $(this).val();
                }
                $.ajax({
                    url: "{{url('empresa')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      let nome = '';
                      // $('#mensagemtomador').text(' ')
                      // $( "#nome__completo" ).removeClass('is-invalid')
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.esnome}">`
                          // nome += `<option value="${element.escnpj}">`
                        });
                        $('#datalistOptions').html(nome)    
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#idempresa').val(data[0].id)
                      }else{
                        // $('#mensagemtomador').text('Não foi porssível encontra o tomador!')
                        // $( "#nome__completo" ).addClass('is-invalid')
                      }
                    }
                });
            });
        });
    </script>  
@stop