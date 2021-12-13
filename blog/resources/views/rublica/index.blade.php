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

    <form class="row g-3 mt-1 mb-3 mt-5" id="form" method="POST" action="{{route('rublica.store')}}" >
        <input type="hidden" name="empresa" value="{{$user->empresa}}">
        <input type="hidden" id="method" name="_method" value="">
        @csrf
                <div class="row">
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao" value="Validar!">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn botao">Atualizar</button>
                        <a class="btn botao" href="#" role="button">Sair</a>
                    </div>
                </div>

                <div class="col-md-5 mt-5 mb-5 p-1 pesquisar">
                    <div class="d-flex">
                        <label for="exampleDataList" class="form-label"></label>
                        <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                        <datalist id="datalistOptions">
                          
                        </datalist>
                        <i class="fas fa-search fa-md iconsear"></i>
                    </div>
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
                    <select id="dc" name="dc" class="form-select fw-bold text-dark" value="">
                      <option selected>Créditos</option>
                      <option>Descontos</option>
                    </select>
                </div>


            </form>
    </div>
    <script>
        $('#pesquisa').on('focus keyup',function() {
            let dados = 0;
            if ($(this).val()) {
                dados = $(this).val()
            }
            $.ajax({
                url: "{{url('rublica/pesquisa')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.rsdescricao}">`
                          nome += `<option value="${element.rsrublica}">`
                        });
                      $('#datalistOptions').html(nome)
                    }
                    if(data.length === 1 && dados.length >= 4){
                        buscaItem(dados)
                    }
                }
            })
        })
        function buscaItem(dados) {
            $.ajax({
                url: "{{url('rublica')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    campos(data);
                }
            })
        }
        function campos(data) {
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
            $('#rubricas').val(data.rsrublica)
            for (let index = 0; index <  $('#dc option').length; index++) {  
                if (data.rsdc == $('#dc option').eq(index).text()) {
                $('#dc option').eq(index).attr('selected','selected')
                }else  {
                $('#dc option').eq(index).removeAttr('selected')
                }
            }
        }
        // $( "#rubricas" ).keyup(function() {
        //     var dados = $(this).val();
        //     $.ajax({
        //         url: "{{url('rublica')}}/"+dados,
        //         type: 'get',
        //         contentType: 'application/json',
        //         success: function(data) {
        //             if (data.id) {
        //                 $('#form').attr('action', "{{ url('rublica')}}/"+data.id);
        //                 $('#formdelete').attr('action',"{{ url('rublica')}}/"+data.id)
        //                 $('#incluir').attr('disabled','disabled')
        //                 $('#atualizar').removeAttr( "disabled" )
        //                 $('#deletar').removeAttr( "disabled" )
        //                 $('#excluir').removeAttr( "disabled" )
        //                 $('#method').val('PUT')
        //             }else{
                      
        //                 $('#form').attr('action', "{{ route('rublica.store') }}");
        //                 $('#incluir').removeAttr( "disabled" )
        //                 $('#atualizar').attr('disabled','disabled')
        //                 $('#deletar').attr('disabled','disabled')
        //                 $('#method').val(' ')
        //                 $('#excluir').attr( "disabled" )
        //             }
        //             $('#descricao').val(data[0].rsdescricao)
        //             $('#incidencia').val(data[0].rsincidencia)
                 
        //             for (let index = 0; index <  $('#dc option').length; index++) {  
        //               if (data[0].rsdc == $('#dc option').eq(index).text()) {
        //                 $('#dc option').eq(index).attr('selected','selected')
        //               }else  {
        //                 $('#dc option').eq(index).removeAttr('selected')
        //               }
        //             }
                   
        //         }
        //     });
        // });
    </script>
@stop