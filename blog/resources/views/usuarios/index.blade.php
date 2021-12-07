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


              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('user.store')}}">
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
                   
                    

                      <button type="button" disabled class="btn btn-primary" id="permicao" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

                      <a class="btn   text-white btn-primary " href="{{route('home.index')}}" role="button" >Sair</a>
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
                  <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}"   name="name" value="" id="usuario">
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
                if (dados) {
                  $.ajax({
                      url: "{{url('user')}}/"+dados,
                      type: 'get',
                      success: function(data) {
                      $('#mensagemtomador').text(' ')
                      $( "#usuario" ).removeClass('is-invalid')
                        if (data.id && dados.length >=3) {
                          campos(data)
                        }else{
                          if (dados) {
                            $('#mensagemuser').text('Não foi porssível encontra o usuario!')
                            $( "#usuario" ).addClass('is-invalid')
                          }
                          campos('')
                        }
                        // let nome = '';
                        // if (data.length >= 1) {
                        //     data.forEach(element => {
                        //       nome += `<option value="${element.name}">`
                        //     });
                        //     $('#listusuario').html(nome)    
                        // }
                        // if(data.length === 1 && dados.length > 4){
                        //   usuario(dados)
                        // }
                      }
                  });
                }else{
                  campos('')
                }
            });
            function usuario(dados) {
              console.log(dados)
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
            $( "#nome__completo" ).keyup(function() {
                var dados = $(this).val();
                dados =  dados.replace(/\D/g, '');
                if (!dados) {
                  dados = $(this).val();
                }
                $.ajax({
                    url: "{{url('empresa')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      let nome = '';
                      $('#mensagemtomador').text(' ')
                      $( "#nome__completo" ).removeClass('is-invalid')
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.esnome}">`
                          nome += `<option value="${element.escnpj}">`
                        });
                        $('#datalistOptions').html(nome)    
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#idempresa').val(data[0].id)
                      }else{
                        $('#mensagemtomador').text('Não foi porssível encontra o tomador!')
                        $( "#nome__completo" ).addClass('is-invalid')
                      }
                      // if (data.empresa) {
                      //   $('#idempresa').val(data.empresa)
                      //   $('#datalistOptions').prepend(`<option value="${data.esnome}/>`)
                      //   // $('#mensagemtomador').text(' ')
                      //   // $( "#nome__completo" ).addClass('is-valid')
                      // }else{
                      //   // $('#mensagemtomador').text('Não foi porssível encontra o tomador!')
                      //   // $( "#nome__completo" ).addClass('is-invalid')
                      // }
                    }
                });
            });
        });
    </script>  
@stop