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
                          title: "{{session('success')}}"
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

              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('user.update',$editar->id)}}">
              @csrf
              @method('PATCH')
              <h5 class="card-title text-center mt-5 fs-3 ">Cadastro de Usuários</h5>
                
                <input type="hidden" name="empresa" id="idempresa" value="{{$user->empresa}}">
                <div class="row">
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                          <button type="submit" id="atualizar"  class="btn btn botao ">Atualizar</button>
                          <a class="btn btn botao " href="{{route('user.create')}}" role="button" >Sair</a>
                      </div>
                </div>

              
              <div class="col-md-4">
                  <label for="nome__completo" class="form-label">Nome do tomador</label>
                  <input class="form-control fw-bold @error('nome__completo') is-invalid @enderror  @error('empresa') is-invalid @enderror" list="datalistOptions" value="{{$editar->esnome}}" name="nome__completo" id="nome__completo" >
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
                  <input type="text" list="listusuario" class="form-control @error('name') is-invalid @enderror" value="{{$editar->name}}"   name="name"  id="usuario">
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
                  <input type="text" class="form-control " name="cargo" value="{{$editar->cargo}}" id="cargo">
                </div>

                <div class="col-md-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control @error('senha') is-invalid @enderror"  name="senha" value="" id="senha">
                  @error('senha')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="table-responsive-xxl">
                    <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                        <thead>
                            <th class="col text-center border-start border-top text-nowrap" style="width:500px;" maxlength="10ch">Empresa</th>
                            <th class="col text-center border-top text-nowrap" style="width:120px;">Usuário</th>
                            <th class="col text-center border-top text-nowrap" style="width:100px;">Permissão</th>
                        </thead>
                        <tbody style="background-color: #081049; color: white;">
                        @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr>   
                                
                            <td class="col text-center border-bottom border-start text-capitalize text-nowrap" style="width: 500px;" >
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$user->esnome}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis;">
                                      <a>{{$user->esnome}} </a>
                                    </button>
                                </td>
   
                                <td class="col text-center border-bottom text-nowrap" style="width:120px;">{{$user->name}}</td>
                                
                                <td class="col text-center border-bottom text-capitalize text-nowrap" style="width:100px;">
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #7EB356;" Readonly>
                                        <i class="fas fa-user-lock"></i>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Usuário</a></li>
                                        <li><a class="dropdown-item" href="#">Administrador</a></li>
                                        <li><a class="dropdown-item" href="#">Bloquear</a></li>
                                        <li><a class="dropdown-item" href="#">Suporte</a></li>
                                      </ul>
                                    </div>
                                </td>
                            </tr>
    
                            @endforeach
                        @else
                        <tr>
                            <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
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
                                    {{ $users->links() }}
                                    </td>
                                </tr>
                            </tfoot>


            
                </div>
              
              </form> 

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