@extends('layouts.index')
@section('titulo','Rhweb - Editar Cadastro de Acesso')
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
              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('usuario.update',$editar->id)}}">
              @csrf
              @method('PATCH')
              <h5 class="card-title text-center mt-5 fs-3 ">Cadastro de Usuários</h5>
                
                <input type="hidden" name="empresa" id="idempresa" value="{{$user->empresa}}">
                <div class="row">
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                          <button type="submit" id="atualizar"  class="btn btn botao "><i class="fad fa-sync-alt"></i> Atualizar</button>
                          <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#teste">
                            <i class="fad fa-list"></i> Lista
                        </a>
                          <a class="btn btn botao " href="{{route('user.create')}}" role="button" ><i class="fad fa-edit"></i> Sair </a>
                      </div>
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
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control  fw-bold" name="email" value="{{$editar->email}}" id="email">
                </div>

                <div class="col-md-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control @error('senha') is-invalid @enderror"  name="senha" value="" id="senha">
                  @error('senha')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>
                
              
              
              </form> 
              @include('usuarios.lista');
            </div> 
            <script>
        $(document).ready(function(){
          $('.modal-botao').click(function() {
              localStorage.setItem("modal", "enabled");
          })

          function verficarModal() {
              var valueModal = localStorage.getItem('modal');
              if (valueModal === "enabled") {
                  $(document).ready(function() {
                      $("#teste").modal("show");
                  });
                  localStorage.setItem("modal", "disabled");
              }
          }
          verficarModal()
          $( "#pesquisa" ).on('keyup focus',function() {
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
                            $('#listapesquisa').html(nome)    
                        }
                        // if(data.length === 1 && dados.length >= 2){
                        //   usuario(dados)
                        // }
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
                        // $('#mensagemtomador').text('Não foi possível encontra o tomador!')
                        // $( "#nome__completo" ).addClass('is-invalid')
                      }
                    }
                });
            });
        });
    </script>  
@stop