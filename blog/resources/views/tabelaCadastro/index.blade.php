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
                <div class="alert mt-2 alert-block" style="background-color: #CC2836;">
                    <strong>Não foi possível realizar o cadastro !</strong>
                </div>
            @endif
            @endforeach
        @endif     
        @if(count($lista) >= $quantidade)
            <div class="alert alert-danger mt-2 alert-block">
                        <strong>Você ja tem {{$quantidade}} cadastrador!</strong>
            </div>
        @endif
        <h1 class="container text-center mt-5 fs-4 mb-2">Lançamento com Tabela de Preço</h1>
        <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="{{route('tabcadastro.store')}}">
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <div class="row">
              <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                    <button type="submit" id="incluir" @if(count($lista) >= $quantidade) disabled @endif class="btn botao">Incluir</button>
                    <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                    <a class="btn botao" href="{{url('relatorioboletimtabela')}}/{{$boletim}}" id="relatorio" role="button">Relatório</a>
                    <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Excluir
                  </button>
                <a class="btn botao" href="{{route('tabcartaoponto.index')}}" role="button">Sair</a>
              </div>
          </div>
              
            <input type="hidden" name="lancamento" value="{{$id}}">
            <input type="hidden" name="numtrabalhador" value="{{$quantidade}}">
            <input type="hidden" name="valor" id="valor">
            <input type="hidden" name="lftomador" id="lftomador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
            <input type="hidden" name="tomador" id="tomador" value="{{$tomador}}">
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
                <input type="text" class="form-control rubrica fw-bold @error('codigo') is-invalid @enderror" name="codigo" list="codigos" value="" id="codigo">
                @error('codigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="codigos">   
                </datalist>
            </div>

            <div class="col-md-8 input">
                <label for="rubrica" class="form-label">Descrição</label>
                <input type="text" class="form-control fw-bold @error('rubrica') is-invalid @enderror rubrica" list="rublicas" name="rubrica" value="" id="rubrica">
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
        <div class="table-responsive-lg">
            <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                <thead>
                    <th class="col text-center border-start border-top text-nowrap" style="width:400px">Nome do Trabalhador</th>
                    <th class="col text-center border-top text-nowrap" style="width:70px">Cod</th>
                    <th class="col text-center border-top text-nowrap" style="width:400px">Descrição</th>
                    <th class="col text-center border-top text-nowrap" style="width:100px">Quantidade/Tonelada</th>
                    <th class="col text-center border-top text-nowrap" style="width:170px">Valor Unitário</th>
                    <th class="col text-center border-top text-nowrap" style="width:170px">Total R$</th>
                    <th class="col text-center border-end border-top text-nowrap" style="width:70px">Ação</th>
                </thead>
                <tbody style="background-color: #081049; color: white;">
                    @if(count($lista) > 0)
                    @foreach($lista as $listas)
                        <tr>
                            <td class="col text-center border-bottom border-start text-capitalize text-nowrap">{{$listas->tsnome}}</td>
                            <td class="col text-center border-bottom text-nowrap">{{$listas->licodigo}}</td>
                            <td class="col text-center border-bottom text-nowrap capitalize">{{$listas->lshistorico}}</td>
                            <td class="col text-center border-bottom text-nowrap">{{$listas->lsquantidade}}</td>
                            <td class="col text-center border-bottom text-nowrap">R$ {{number_format((float)$listas->lfvalor, 2, ',', '')}}</td>
                            <td class="col text-center border-bottom text-nowrap">R$ {{number_format((float)$listas->lsquantidade*$listas->lfvalor, 2, ',', '')}}</td>
                            <td class="col text-center border-bottom border-end text-nowrap">
                            <form action="{{route('tabcadastro.destroy',$listas->id)}}"  method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn "><i style="color:#FF331F;" class="fal fa-trash"></i></button>
                            </form> 
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td class="text-center border-bottom border-end border-start text-nowrap" colspan="8" style="background-color: #081049; color: white;">
                                <div class="alert" role="alert" style="background-color: #CC2836;">
                                    Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

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
            
            
            $( ".rubrica" ).keyup(function() {
                var dados = $(this).val();
                
                var tagname = $(this).attr('name')
                if (dados) {
                    $.ajax({
                        url: "{{url('tabelapreco')}}/pesquisa/"+dados+"/"+$('#tomador').val(),
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            // $('#rubrica').removeClass('is-invalid')
                            // $('#rublicamensagem').text(' ')
                            let nome = ''
                            // let codigo = ''
                            if (data.length >= 1) {
                                // data.forEach(element => {
                                // nome += `<option value="${element.tsdescricao}">`
                                // });
                                data.forEach(element => {
                                    codigo += `<option value="${element.tsrubrica}">`
                                });
                                if( tagname == 'codigo'){
                                    $('#rubrica').val(' ')
                                }else if(tagname == 'rubrica'){
                                    $('#codigo').val(' ')
                                }
                                // $('#rublicas').html(nome)
                                $('#codigos').html(codigo)
                            }
                            if(data.length === 1 && dados.length > 3){
                                if( tagname == 'codigo'){
                                    $('#rubrica').val(data[0].tsdescricao)
                                }
                                // if( tagname == 'rubrica'){
                                //     $('#codigo').val(data[0].tsrubrica)
                                // }
                                $('#valor').val(data[0].tsvalor)
                                $('#lftomador').val(data[0].tstomvalor)
                            }else{
                                // $('#rubrica').addClass('is-invalid')
                                // $('#rublicamensagem').text('Esta rublica não esta cadastra.')
                            }
                        }
                    });
                }
               
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
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#nomecompleto').html(nome)
                        
                      }
                      if(data.length === 1 && dados.length > 4){
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
            // $( "#codigo" ).keyup(function() {
            //     var dados = $(this).val();
            //     $.ajax({
            //         url: "{{url('tabcadastro')}}/"+dados,
            //         type: 'get',
            //         contentType: 'application/json',
            //         success: function(data) {
            //             if (data.id) {
            //                 $('#form').attr('action', "{{ url('tabcadastro')}}/"+data.id);
            //                 $('#formdelete').attr('action',"{{ url('tabcadastro')}}/"+data.id)
            //                 $('#incluir').attr('disabled','disabled')
            //                 $('#atualizar').removeAttr( "disabled" )
            //                 $('#deletar').removeAttr( "disabled" )
            //                 $('#excluir').removeAttr( "disabled" )
            //                 $('#method').val('PUT')
            //                 $('#trabalhador').val(data.trabalhador)
            //                 $('#matricula').val(data.tsmatricula)
            //                 $('#rubrica').val(data.lshistorico)
            //                 $('#quantidade').val(data.lsquantidade)
            //                 $('#nome__completo').val(data.tsnome)
            //             }else{
            //                 $('#form').attr('action', "{{ route('tabcadastro.store') }}");
            //                 $('#incluir').removeAttr( "disabled" )
            //                 $('#atualizar').attr('disabled','disabled')
            //                 $('#deletar').attr('disabled','disabled')
            //                 $('#method').val(' ')
            //                 $('#excluir').attr( "disabled",'disabled' )
            //             }
                       
            //         }
            //     })
            // })
          
          </script>
@stop