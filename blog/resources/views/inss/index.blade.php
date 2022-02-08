@extends('layouts.index')
@section('titulo','Rhweb - INSS')
@section('conteine')
    <div class="container">
        @if(session('success'))
              
              <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>{{session('success')}}<i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
        @endif
        @error('false')
            <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>{{$message}}<i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
        @enderror  
    <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('inss.store')}}" >
        
                <h1 class="container text-center mt-4 mb-2 fs-4 fw-bold">INSS</h1>
                
                <input type="hidden" name="user" value="{{$user->id}}">
                    @csrf
                    <input type="hidden" id="method" name="_method" value="">
                    
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" class="btn botao" >
                            <i class="fad fa-save"></i> Incluir
                        </button>
                        <button type="button" id="deletar" disabled class="btn botao" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fad fa-trash"></i> Excluir
                        </button>
                        <button type="submit" id="atualizar" disabled class="btn botao" >
                            <i class="fad fa-edit"></i> Editar
                        </button>
                       
                        <a class="btn botao" href="{{route('home.index')}}"  role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                    </div>

                <div class="container block">
                    <div class="col-md-1">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="text" class="form-control @error('isano') is-invalid @enderror" name="isano" value="  {{ old('ano')}}" id="ano">
                        @error('isano')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                

                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final01" id="valor__final01">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice01" id="indice01">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator01" id="fator01">
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final02" id="valor__final02">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice02" id="indice02">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator02" id="fator02">
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final03" id="valor__final03">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice03" id="indice03">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control" name="fator03" id="fator03">
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control resultado" name="valor__final04" id="valor__final04">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice04" id="indice04">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Fator de Redução</label>
                    <input type="text" class="form-control " name="fator04" id="fator04">
                </div>


                <div class="col-md-4">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final05" id="valor__final05">
                </div>

                <div class="col-md-4 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control resultado" name="indice05" id="indice05">
                </div>

                <div class="col-md-4 ">
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
                      <form action=""  id="formdelete" method="post">
                        @csrf
                        @method('delete')
                      <button class="btn ms-2 text-white" type="submit" role="button" style="background-color:#bb0202;">Deletar</button> 
                    </form> 
                    </div>
                  </div>
                </div>
              </div>
    </div>
    <script>
        $(document).ready(function(){
           
            $( "#ano" ).change(function() {
                var dados = $( this ).val();
                $.ajax({
                    url: "{{url('inss')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                       
                        if (data[0].user) {
                            $('#form').attr('action', "{{ url('inss')}}/"+data[0].user);
                            $('#formdelete').attr('action',"{{ url('inss')}}/"+data[0].isano)
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
            $('.resultado').keyup(function () {
                let indice = $(this).attr('name')
                indice = indice.split('')
                let valor = $(`#valor__final${indice[6]}${indice[7]}`).val().replace(/\./g,"").replace(/,/g,".")
                let resultado = (parseFloat($(this).val().toString().replace(",", ".")) / 100) *  parseFloat(valor);
                if (resultado > 0) { 
                    $(`#fator${indice[6]}${indice[7]}`).val(resultado.toFixed(2).replace(".", ","))
                }
            })
        });
    </script>
@stop