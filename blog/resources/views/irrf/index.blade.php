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
        <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('irrf.store')}}">
            
                <h1 class="container text-center mt-4 mb-2 fs-4 fw-bold">Faixa de Cálculos - IRRF</h1>

                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao" >
                        Incluir
                    </button>
                    <button type="button" id="deletar" disabled class="btn botao d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                        Excluir
                    </button>
                    <button type="submit" id="atualizar" disabled class="btn botao" >
                    Editar
                    </button>
                    
                    <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
                    </div>
                </div>
                
                <input type="hidden" name="user" value="{{$user->id}}">
                @csrf
                <input type="hidden" id="method" name="_method" value="">
                <div class="container block">
                    <div class="col-md-3">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="text" class="form-control" name="ano" id="ano">
                    </div>
                </div>
                
                <div class="container block">
                    <div class="col-md-3">
                        <label for="ded__dependente" class="form-label">Dedução por Dependente</label>
                        <input type="text" class="form-control" name="ded__dependente" id="ded__dependente">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial01" id="valor__inicial01">
                </div>

                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final01" id="valor__final01">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice01" id="indice01">
                </div>

               

                <div class="col-md-4">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial02" id="valor__inicial02">
                </div>

                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final02" id="valor__final02">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice02" id="indice02">
                </div>

               

                <div class="col-md-4">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial03" id="valor__inicial03">
                </div>

                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final03" id="valor__final03">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice03" id="indice03">
                </div>

               

                <div class="col-md-4">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial04" id="valor__inicial04">
                </div>

                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final04" id="valor__final04">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice04" id="indice04">
                </div>

               
                <div class="col-md-4">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial05" id="valor__inicial05">
                </div>

                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final05" id="valor__final05">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice05" id="indice05">
                </div>

               
                <input type="hidden" name="id01" id="id01">
                <input type="hidden" name="id02" id="id02">
                <input type="hidden" name="id03" id="id03">
                <input type="hidden" name="id04" id="id04">
                <input type="hidden" name="id05" id="id05">

        </form>
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
                      <form action="">
                      <a class="btn ms-2 text-white" href="#" role="button" style="background-color:#bb0202;">Deletar</a> 
                    </form> 
                    </div>
                  </div>
                </div>
                </div>
                    </div>
    <script>
        $(document).ready(function(){
           
            $( "#ano" ).keyup(function() {
                var dados = $( this ).val();
                $.ajax({
                    url: "{{url('irrf')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                       
                        if (data[0].user) {
                            $('#form').attr('action', "{{ url('irrf')}}/"+data[0].user);
                            // $('#formdelete').attr('action',"{{ url('inss')}}/"+data.user)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            $('#deletar').removeAttr( "disabled" )
                            // $('#excluir').removeAttr( "disabled" )
                            $('#method').val('PUT')
                            
                        }
                        else{
                            $('#form').attr('action', "{{ route('inss.store') }}");
                            $('#incluir').removeAttr( "disabled" )
                            $('#depedente').removeAttr( "disabled" )
                            $('#atualizar').attr('disabled','disabled')
                            $('#deletar').attr('disabled','disabled')
                            $('#method').val(' ')
                            // $('#excluir').attr( "disabled" )
                        }
                        data.forEach((element,index) => {
                            $('#valor__inicial0'+(index+1)).val(element.irsvalorinicial)
                            $('#valor__final0'+(index+1)).val(element.irsvalorfinal)
                            $('#indice0'+(index+1)).val(element.irsindece)
                            $('#id0'+(index+1)).val(element.id)
                        });
                    }
                });
            });
        });
    </script>
@stop