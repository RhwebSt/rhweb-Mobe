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

              <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('comisionado.store')}}">
                @csrf
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="tomador" id="idtomador">
                <input type="hidden" name="trabalhador" id="idtrabalhador">
                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                     
                      <button type="submit" id="incluir" disabled class="btn btn-primary" >
                      Incluir
                        </button>
                        <button type="submit" id="atualizar" disabled class="btn btn-primary" >
                        Editar
                        </button>
                      <!-- <button type="button" id="excluir" disabled class="btn ms-2  col-md-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #2A90CB; color: #f0f0f0">
                          Excluir
                        </button> -->
                        
                     
                      <a class="btn btn-primary" href="{{route('home.index')}}"  role="button">Sair</a>
                  </div>
              </div>
              <h5 class="card-title text-center fs-3 ">Comissionado</h5>
                

                <div class="col-md-6">
                    <label for="nome__trabalhador" class="form-label">Nome do Trabalhador</label>
                    <input type="text" class="form-control" name="nome__trabalhador" id="nome__trabalhador">
                </div>

                <div class="col-md-3">
                  <label for="matricula__trab" class="form-label">Matricula Trabalhador</label>
                  <input type="text" class="form-control" name="matricula__trab" value="" id="matricula__trab">
                </div>
                <input type="hidden" id="comissionado">
                <div class="col-md-3">
                  <label for="indice" class="form-label">Indíce %</label>
                  <input type="text" class="form-control" name="indice" value="" id="indice">
                </div>
                <div class="col-md-6">
                  <label for="nome_tomador" class="form-label">Tomador</label>
                  <input type="text" class="form-control"  name="nome_tomador" value="" id="nome_tomador">
                </div>
              </form> 
              
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header " style="background-color:#000000;">
                      <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                      <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-black text-start">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                      <form action="">
                      <a class="btn btn-danger ms-2" href="#" role="button">Deletar</a> 
                    </form> 
                    </div>
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