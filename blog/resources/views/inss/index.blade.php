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
    <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('inss.store')}}" >
        <input type="hidden" name="user" value="{{$user->id}}">
                <h1 class="container text-center mt-4 mb-2 fs-4 fw-bold">Faixa de Cálculos</h1>
                    @csrf
                    <input type="hidden" id="method" name="_method" value="">
                <div class="row">
                    <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" style="background-color: #194bf0;" class="btn ms-2 btn-primary col-md-1 text-white" >
                            Incluir
                        </button>
                        <button type="button" id="deletar" disabled class="btn ms-2  col-md-1 d-none text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #194bf0;">
                            Excluir
                        </button>
                        <button type="submit" id="atualizar" disabled style="background-color: #194bf0;" class="btn ms-2  btn-primary col-md-1 text-white" >
                        Editar
                        </button>
                       
                        <a class="btn ms-2 col-md-1 text-white" href="{{route('home.index')}}" style="background-color: #194bf0;" role="button">Sair</a>
                    </div>
                </div>

                <div class="container block">
                    <div class="col-md-1">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="text" class="form-control" name="ano" id="ano">
                    </div>
                </div>
                
                
                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial01" id="valor__inicial01">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final01" id="valor__final01">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice01" id="indice01">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator01" id="fator01">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial02" id="valor__inicial02">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final02" id="valor__final02">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice02" id="indice02">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator02" id="fator02">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial03" id="valor__inicial03">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final03" id="valor__final03">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice03" id="indice03">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator03" id="fator03">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial04" id="valor__inicial04">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final04" id="valor__final04">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice04" id="indice04">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator04" id="fator04">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial05" id="valor__inicial05">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final05" id="valor__final05">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice05" id="indice05">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator05" id="fator05">
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
                    url: "{{url('inss')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                       
                        if (data[0].user) {
                            $('#form').attr('action', "{{ url('inss')}}/"+data[0].user);
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
                            $('#valor__inicial0'+(index+1)).val(element.isvalorinicial)
                            $('#valor__final0'+(index+1)).val(element.isvalorfinal)
                            $('#indice0'+(index+1)).val(element.isindece)
                            $('#fator0'+(index+1)).val(element.isreducao)
                            $('#id0'+(index+1)).val(element.id)
                        });
                    }
                });
            });
        });
    </script>
@stop