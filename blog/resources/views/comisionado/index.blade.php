@extends('layouts.index')
@section('conteine')
<div class="container">
              

              @if($errors->all())
            @foreach($errors->all() as  $error)
              @if($error === 'edittrue')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>Atualização realizada com sucesso! <i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
             @elseif($error === 'editfalse')
                <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>Não foi possível atualizar os dados! <i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
            @elseif($error === 'deletatrue')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>Registro deletado com sucesso! <i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
             @elseif($error === 'cadastratrue')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>Cadastro realizada com sucesso! <i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
             @elseif($error === 'cadastrafalse')
                <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>Não foi possível realizar o cadastro! <i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
            @endif
            @endforeach
        @endif     

              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('comisionado.store')}}">
                  
                  <h5 class="card-title text-center mt-5 fs-3 ">Comissionado</h5>
                @csrf
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="tomador" id="idtomador">
                <input type="hidden" name="trabalhador" id="idtrabalhador">
                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
        
                    <button type="submit" id="incluir" disabled class="btn botao" >Incluir</button>
                    <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                      <!-- <button type="button" id="excluir" disabled class="btn ms-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #2A90CB; color: #f0f0f0">
                          Excluir
                        </button> -->
                      <a class="btn botao" href="{{route('home.index')}}"  role="button">Sair</a>
                    </div>
                </div>
                
                


                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Nome Do Trabalhador</label>
                    <input class="pesquisa form-control" list="datalistOptions" name="pesquisa" id="pesquisa">
                    <datalist id="datalistOptions">
                        <!-- <option value="San Francisco">
                        <option value="New York">
                        <option value="Seattle">
                        <option value="Los Angeles">
                        <option value="Chicago"> -->
                    </datalist>
                </div>

                <div class="col-md-4">
                  <label for="matricula__trab" class="form-label">Matricula Trabalhador</label>
                  <input type="text" class="form-control" name="matricula__trab" value="" id="matricula__trab">
                </div>
                <input type="hidden" id="comissionado">
                <div class="col-md-4">
                  <label for="indice" class="form-label">Indíce %</label>
                  <input type="text" class="form-control" name="indice" value="" id="indice">
                </div>
                
                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Tomador</label>
                    <input class="pesquisa form-control" list="datalistOptions" name="pesquisa" id="pesquisa">
                    <datalist id="datalistOptions">
                        <!-- <option value="San Francisco">
                        <option value="New York">
                        <option value="Seattle">
                        <option value="Los Angeles">
                        <option value="Chicago"> -->
                    </datalist>
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
                                            <p class="mb-2">Obs:( Caso exclua os dados do trabalhador seus depedentes serão excluidos.)</p>
                                            <p class="mb-1">Deseja realmente excluir?</p>
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
           
           
            $( "#nome_tomador" ).keyup(function() {
                var dados = $( "#nome_tomador" ).val();
                $.ajax({
                    url: "{{url('tomador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      if (data.tomador && $('#idtrabalhador').val() && $('#comissionado').val() || !data.tomador) {
                        $('#incluir').attr('disabled','disabled')
                      }else{
                        $('#incluir').removeAttr( "disabled" )
                      }
                      $('#idtomador').val(data.tomador)
                    }
                });
            });
            $( "#nome__trabalhador" ).keyup(function() {
                var dados = $( "#nome__trabalhador" ).val();
                $.ajax({
                    url: "{{url('trabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data.trabalhador && $('#idtomador').val() && $('#comissionado').val() || !data.trabalhador) {
                          $('#incluir').attr('disabled','disabled')
                        }else{
                          $('#incluir').removeAttr( "disabled" )
                        }
                        $('#matricula__trab').val(data.tsmatricula)
                        $('#idtrabalhador').val(data.trabalhador)
                        comissionador(data.trabalhador)
                       
                    }
                });
            });
            function comissionador(id) {
                $.ajax({
                    url: "{{url('comisionado')}}/"+id,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      if (data.id) {
                       
                        $('#comissionado').val(data.id);
                        $('#atualizar').removeAttr( "disabled" )
                        $('#excluir').removeAttr( "disabled" )
                        $('#incluir').attr('disabled','disabled')
                        $('#method').val('PUT')
                        $('#matricula__trab').val(data.csmatricula)
                        $('#indice').val(data.csindece);
                        $('#nome_tomador').val(data.tsnome)
                        $('#form').attr('action', "{{ url('comisionado')}}/"+data.id);
                      }else{
                          // $('#incluir').attr('disabled','disabled')
                          $('#atualizar').attr('disabled','disabled')
                          $('#excluir').attr( "disabled" )
                      }
                    }
                })
            }
        });
    </script>     
@stop