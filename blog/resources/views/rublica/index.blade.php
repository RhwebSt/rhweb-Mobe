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
    <form class="row g-3 mt-1 mb-3 mt-5" id="form" method="POST" action="{{route('rublica.store')}}" >
        <input type="hidden" name="empresa" value="{{$user->empresa}}">
        <input type="hidden" id="method" name="_method" value="">
        @csrf
                <div class="row">
                    <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn btn-primary" value="Validar!">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn btn-primary">Atualizar</button>
                        <a class="btn col-md-1 text-white botao table-hover" href="#" role="button">Sair</a>
                    </div>
                </div>
                
                <div class="col-md-6 table-bordered border-white d-flex mt-5 mb-4">
                    <label for="pesquisa" class="form-label"></label>
                    <input class="pesquisar form-control  me-1" list="datalistOptions" name="pesquisa" id="pesquisa" >
                        <datalist id="datalistOptions">
                            <option value="San Francisco">
                            <option value="New York">
                            <option value="Seattle">
                            <option value="Los Angeles">
                            <option value="Chicago">
                        </datalist>
                    <button class="btn" type="submit" style="background-color:#2541B2; Color: #fefeff;">Pesquisar</button>
                </div>

                <h1 class="container text-center mt-4 mb-2 fs-3 fw-bold">Rúbricas</h1>

                <div class="col-md-2">
                    <label for="rubricas" class="form-label">Rúbricas</label>
                    <input type="text" class="form-control"  name="rubricas" id="rubricas" value="">
                    
                </div>

                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="">
                </div>

                <div class="col-md-2">
                    <label for="incidencia" class="form-label">Incidência</label>
                    <input type="text" class="form-control" name="incidencia" id="incidencia" value="">
                </div>

                <div class="col-md-2">
                    <label for="dc" class="form-label">D/C</label>
                    <select id="dc" name="dc" class="form-select" value="">
                      <option selected>Créditos</option>
                      <option>Descontos</option>
                    </select>
                </div>


            </form>
    </div>
    <script>
        $( "#rubricas" ).keyup(function() {
            var dados = $(this).val();
            $.ajax({
                url: "{{url('rublica')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    if (data.id) {
                        $('#form').attr('action', "{{ url('rublica')}}/"+data.id);
                        $('#formdelete').attr('action',"{{ url('rublica')}}/"+data.id)
                        $('#incluir').attr('disabled','disabled')
                        $('#atualizar').removeAttr( "disabled" )
                        $('#deletar').removeAttr( "disabled" )
                        $('#excluir').removeAttr( "disabled" )
                        $('#method').val('PUT')
                    }else{
                      
                        $('#form').attr('action', "{{ route('rublica.store') }}");
                        $('#incluir').removeAttr( "disabled" )
                        $('#atualizar').attr('disabled','disabled')
                        $('#deletar').attr('disabled','disabled')
                        $('#method').val(' ')
                        $('#excluir').attr( "disabled" )
                    }
                    $('#descricao').val(data.rsdescricao)
                    $('#incidencia').val(data.rsincidencia)
                    $('#pis').val(data.dspis)
                    $('#data_nascimento').val(data.nsnascimento)
                 
                    for (let index = 0; index <  $('#dc option').length; index++) {  
                      if (data.rsdc == $('#dc option').eq(index).text()) {
                        $('#dc option').eq(index).attr('selected','selected')
                      }else  {
                        $('#dc option').eq(index).removeAttr('selected')
                      }
                    }
                   
                }
            });
        });
    </script>
@stop