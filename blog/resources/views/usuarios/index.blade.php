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
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="empresa" id="idempresa">
                <div class="row">
                  <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                  <button type="submit" id="incluir" class="btn botao "  >
                        <i class="fad fa-save"></i> Incluir
                      </button>
                      <a class="btn btn botao " href="{{route('home.index')}}" role="button" ><i class="fad fa-sign-out-alt"></i> Sair</a>
                  </div>
              </div>

              
              <div class="col-md-4">
                  <label for="nome__completo" class="form-label">Nome do tomador
                    <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                  </label>
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
                  <input type="text" class="form-control  fw-bold" name="cargo" value="{{old('cargo')}}" id="cargo">
                </div>

                <div class="col-md-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control @error('senha') is-invalid @enderror fw-bold" value="{{old('senha')}}" name="senha" value="" id="senha">
                  @error('senha')
                      <span class="">{{ $message }}</span>
                  @enderror
                </div>
                </form>
                
                <div class="d-flex justify-content-end">
        
        
                    <div class="dropdown  mt-2 p-1">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">
                            <i class="fad fa-sort"></i> Filtro 
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <!-- <li><a class="dropdown-item text-white" href="#"><i class="fad fa-history"></i> Mais Recente</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="fad fa-sort-numeric-down-alt"></i> Mais Antigo</a></li> -->
                        <li><a class="dropdown-item text-white" href="{{route('ordem.pesquisa.user','asc')}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                        <li><a class="dropdown-item text-white" href="{{route('ordem.pesquisa.user','desc')}}"><i class="fad fa-sort-amount-up"></i> Ordem Decrescente</a></li>
                        </ul>
                    </div>
                </div>
                
                
                <div class="table-responsive-xxl">
                    <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                        <thead>
                            <th class="col text-center border-start border-top text-nowrap" style="width:500px;" maxlength="10ch">Empresa</th>
                            <th class="col text-center border-top text-nowrap" style="width:120px;">Usuário</th>
                            <th class="col text-center border-top text-nowrap" style="width:100px;">Permissão</th>
                            <th class="col text-center border-top text-nowrap" style="width:60px;">Editar</th>
                            <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                        </thead>
                        <tbody style="background-color: #081049; color: white;">
                        @if(count($users) > 0)
                        @foreach($users as $key=>$valoruser)
                            <tr class="bodyTabela">   
                                
                                <td class="col text-center border-bottom border-start text-capitalize text-nowrap" style="width: 500px;" >
                                    <button type="button" class="btn text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$valoruser->esnome}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis;">
                                      <a>{{$valoruser->esnome}} </a>
                                    </button>
                                </td>
   
                                <td class="col text-center border-bottom text-nowrap" style="width:120px;">{{$valoruser->name}}</td>
                                
                                <td class="col text-center border-bottom text-capitalize text-nowrap" style="width:100px;">
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #51039E;">
                                        <i class="fad fa-user-lock"></i>
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Usuário <i class="fad fa-user"></i></a></li>
                                        <li><a class="dropdown-item" href="#">Administrador <i class="fad fa-user-lock"></i></a></li>
                                        <li><a class="dropdown-item" href="#">Bloquear <i class="fas fa-ban" style="color:#A30E00;"></i></a></li>
                                        <li><a class="dropdown-item" href="#">Suporte <i class="fad fa-headset"></i></a></li>
                                      </ul>
                                    </div>
                                </td>

                                
                                <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                    <button class="btn">
                                    <a href="{{route('user.edit', base64_encode($valoruser->id))}}" class="btn__padrao--editar" ><i style="color:#FFFFFF; padding-left: 3px;" class="fad fa-edit"></i></a>
                                    </button>
                                </td>
                                <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                    <button class="btn btn__padrao--excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$key}}">
                                        <i style="color:#FFFFFF; padding-right: 3px;" class="fad fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="staticBackdrop{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                      <div class="modal-content">
                                          <form action="{{route('user.destroy',$valoruser->id)}}"  method="post">
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
                        
                    </table>
            
                </div>
              
               
              
              
              
            </div> 
            <script>
            
            var botaolimpaCampos = document.querySelector("#refre");

        botaolimpaCampos.addEventListener('click', function(){
            var senh = document.querySelector("#senha").value='';
            var cargo = document.querySelector("#cargo").value='';
            var usuario = document.querySelector("#usuario").value='';
            var nomeCompleto = document.querySelector("#nome__completo").value='';
        });
            
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
                  // $('#incluir').attr('disabled','disabled')
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
                        // $('#mensagemtomador').text('Não foi porssível encontra o tomador!')
                        // $( "#nome__completo" ).addClass('is-invalid')
                      }
                    }
                });
            });
        });
    </script>  
@stop