@extends('layouts.index')
@section('titulo','Rhweb - Cadastro de Acesso')
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
                          title: '{{session("success")}}'
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
              
              <h5 class="card-title text-center mt-5 fs-3 mb-5">Cadastro de Usuários <i class="fas fa-user"></i></h5>
                <!-- <input type="hidden" id="method" name="_method" value=""> -->
                <input type="hidden" name="empresa" id="idempresa" value="{{$user->empresa}}">
                <div class="row">
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" class="btn botao "  >
                            <i class="fad fa-save"></i> Incluir
                        </button>
                        <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#teste">
                            <i class="fad fa-list"></i> Lista
                        </a>
                        <a class="btn btn botao " href="{{route('home.index')}}" role="button" ><i class="fad fa-sign-out-alt"></i> Sair</a>
                  </div>
              </div>
                <div class="col-md-3">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" list="listusuario" class="form-control @error('name') is-invalid @enderror fw-bold" value="{{old('name')}}"   name="name" value="" id="usuario">
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
                  <input type="text" class="form-control @error('cargo') is-invalid @enderror fw-bold" name="cargo" value="{{old('cargo')}}" id="cargo">
                  @error('cargo')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="col-md-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror fw-bold" name="email" value="{{old('email')}}" id="email">
                  @error('email')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-4">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control @error('senha') is-invalid @enderror fw-bold" value="{{old('senha')}}" name="senha" value="" id="senha">
                  @error('senha')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>
                </form>
            </div> 
            @include('usuarios.lista');
            <script>
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
            function validaInputQuantidade(idCampo,QuantidadeCarcteres){
                var telefone = document.querySelector(idCampo);
    
                telefone.addEventListener('input', function(){
                    var telefone = document.querySelector(idCampo);
                    var result = telefone.value;
                    if(result > " " && result.length >= QuantidadeCarcteres){
                      telefone.classList.add('is-valid');  
                    }else{
                        telefone.classList.remove('is-valid');
                    }
                     
                });
            }
             var cargo = validaInputQuantidade("#cargo",1);
             var cargo = validaInputQuantidade("#usuario",2);
            
            function validaInputEmail(idCampo,QuantidadeCarcteres){
                var telefone = document.querySelector(idCampo);
    
                telefone.addEventListener('input', function(){
                    var telefone = document.querySelector(idCampo);
                    var result = telefone.value;
                    if(result > " " && result.length >= QuantidadeCarcteres && result.search("@") != -1 && result.indexOf(".") != -1){
                      telefone.classList.add('is-valid');  
                    }else{
                        telefone.classList.remove('is-valid');
                    }
                });
            }

            var email = validaInputEmail("#email", 1);
            
            
            var botaolimpaCampos = document.querySelector("#refre");

        botaolimpaCampos.addEventListener('click', function(){
            var senh = document.querySelector("#senha").value='';
            var cargo = document.querySelector("#cargo").value='';
            var usuario = document.querySelector("#usuario").value='';
            var nomeCompleto = document.querySelector("#nome__completo").value='';
            var email = document.querySelector("#email").value= '';
        });
        

        $(document).ready(function(){
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
                  // $('#incluir').attr('disabled','disabled')
                  $('#atualizar').removeAttr( "disabled" )
                  $('#deletar').removeAttr( "disabled" )
                  $('#excluir').removeAttr( "disabled" )
                  $('#permicao').removeAttr( "disabled" )
                  // $('#method').val('PUT')
                  $('#nome__completo').val(data.esnome)
                  $('#cargo').val(data.cargo)
                  $('#senha').val('')
                  $('#idempresa').val(data.empresa)
              }else{
                  $('#form').attr('action', "{{ route('user.store') }}");
                  // $('#incluir').removeAttr( "disabled" )
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