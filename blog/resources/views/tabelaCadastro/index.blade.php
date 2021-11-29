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

        <h1 class="container text-center mt-5 fs-4 mb-2">Lançamento com Tabela de Preço</h1>

       
        <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="{{route('tabcadastro.store')}}">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <div class="row">
              <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
    
                    <button type="submit" id="incluir" class="btn botao">Incluir</button>
                    <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                    <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Excluir
                  </button>
                <a class="btn botao" href="{{route('tabcartaoponto.index')}}" role="button">Sair</a>
              </div>
          </div>
              
            <input type="hidden" name="lancamento" value="{{$id}}">

            <div class="col-md-10 input">
                <label for="nome__completo" class="form-label">Nome do Trabalhador</label>
                <input class="pesquisa form-control fw-bold fw-bold  @error('nome__completo') is-invalid @enderror" list="nomecompleto" name="nome__completo" id="nome__completo">
                @error('nome__completo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="nomemensagem"></span>
                <datalist id="nomecompleto">
                   
                </datalist>
            </div>
            
            <input type="hidden" name="trabalhador" id="trabalhador">
            
            <div class="col-md-2 input">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control fw-bold @error('matricula') is-invalid @enderror" name="matricula" value="" id="matricula">
                @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2 input">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control fw-bold @error('licodigo') is-invalid @enderror" name="licodigo" value="" id="codigo">
                @error('licodigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-8 input">
                <label for="rubrica" class="form-label">Rúbrica</label>
                <input type="text" class="form-control fw-bold @error('rubrica') is-invalid @enderror" list="rublicas" name="rubrica" value="" id="rubrica">
                <datalist id="rublicas">   
                </datalist>
                @error('rubrica')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="rublicamensagem"></span>
            </div>

            <div class="col-md-2 input">
                <label for="quantidade" class="form-label">Quantidade/Tonelada</label>
                <input type="text" class="form-control fw-bold @error('quantidade') is-invalid @enderror" name="quantidade" value="" id="quantidade">
                @error('quantidade')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
            </form>

        <table class="table table-sm border-bottom  text-white table-responsive mt-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
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
                            Não á registro cadastrado!
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
                    <form action="" id="formdelete" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                    </form> 
                </div>
              </div>
            </div>
         </div>

          <script>
            // if ( window.history.replaceState ) {
            //     window.history.replaceState( null, null, window.location.href );
            // }
            
            $( "#rubrica" ).keyup(function() {
                var dados = $(this).val();
                $.ajax({
                    url: "{{url('rublica')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        $('#rubrica').removeClass('is-invalid')
                        $('#rublicamensagem').text(' ')
                        let nome = ''
                        if (data.length >= 1) {
                            data.forEach(element => {
                            nome += `<option value="${element.rsdescricao}">`
                            });
                            $('#rublicas').html(nome)
                        }else{
                            $('#rubrica').addClass('is-invalid')
                            $('#rublicamensagem').text('Esta rublica não esta cadastra.')
                        }
                    }
                });
            });
            $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                $.ajax({
                    url: "{{url('trabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        $('#nomemensagem').text(' ')
                        $( "#nome__completo" ).removeClass('is-invalid')
                      let nome = ''
                      if (data.length > 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#nomecompleto').html(nome)
                        
                      }else if(data.length === 1){
                        // data.forEach(element => {
                        //   nome += `<option value="${element.tsnome}">`
                        //   nome += `<option value="${element.tsmatricula}">`
                        //   nome += `<option value="${element.tscpf}">`
                        // });
                        $('#nomecompleto').html(nome)
                        $('#trabalhador').val(data[0].trabalhador)
                        $('#matricula').val(data[0].tsmatricula)
                      }else{
                          $('#nomemensagem').text('Este trabalhador não ta cadastrador!')
                          $( "#nome__completo" ).addClass('is-invalid')
                      }              
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
                        if (data.id) {
                            $('#form').attr('action', "{{ url('tabcadastro')}}/"+data.id);
                            $('#formdelete').attr('action',"{{ url('tabcadastro')}}/"+data.id)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            $('#deletar').removeAttr( "disabled" )
                            $('#excluir').removeAttr( "disabled" )
                            $('#method').val('PUT')
                            $('#trabalhador').val(data.trabalhador)
                            $('#matricula').val(data.tsmatricula)
                            $('#rubrica').val(data.lshistorico)
                            $('#quantidade').val(data.lsquantidade)
                            $('#nome__completo').val(data.tsnome)
                        }else{
                            $('#form').attr('action', "{{ route('tabcadastro.store') }}");
                            $('#incluir').removeAttr( "disabled" )
                            $('#atualizar').attr('disabled','disabled')
                            $('#deletar').attr('disabled','disabled')
                            $('#method').val(' ')
                            $('#excluir').attr( "disabled",'disabled' )
                        }
                       
                    }
                })
            })
          
          </script>
@stop