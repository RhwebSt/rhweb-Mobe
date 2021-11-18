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

        <h1 class="container text-center mt-3 fs-4 mb-5">Lançamento com Tabela de Preço</h1>

       

        <form class="row g-3 mt-1 mb-5" method="POST" action="{{route('tabcadastro.store')}}">
        @csrf
        <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn btn-primary">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-primary  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                    <a class="btn btn btn-primary" href="{{route('tabcartaoponto.index')}}" role="button">Sair</a>
                  </div>
              </div>
            <input type="hidden" name="lancamento" value="{{$id}}">
            <div class="col-md-10 input">
                <label for="nome__completo" class="form-label">Nome do Trabalhador</label>
                <input type="text" class="form-control " value="" id="nome__completo">
            </div>
            <input type="hidden" name="trabalhador" id="trabalhador">
            <div class="col-md-2 input">
                <label for="matricula" class="form-label">Matrícula</label>
                <input type="text" class="form-control " name="matricula" value="" id="matricula">
            </div>

            <div class="col-md-2 input">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control " name="codigo" value="" id="codigo">
            </div>

            <div class="col-md-8 input">
                <label for="rubrica" class="form-label">Rúbrica</label>
                <input type="text" class="form-control " list="datalistOptions" name="rubrica" value="" id="rubrica">
                <datalist id="datalistOptions">
                    <option value="San Francisco">
                    <option value="New York">
                    <option value="Seattle">
                    <option value="Los Angeles">
                    <option value="Chicago">
                  </datalist>
            </div>

            <div class="col-md-2 input">
                <label for="quantidade" class="form-label">Quantidade/Tonelada</label>
                <input type="text" class="form-control " name="quantidade" value="" id="quantidade">
            </div>
            

        </form>

        <table class="table table-sm border-bottom  text-white table-responsive mt-5" style="background-color: #353535;">
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
                            Não a registro cadastrador!
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
                  <form action="">
                  <a class="btn ms-2 text-white" href="#" role="button" style="background-color:#bb0202;">Deletar</a> 
                </form> 
                </div>
              </div>
            </div>
          </div>
          <script>
            $( "#rubrica" ).keyup(function() {
            var dados = $(this).val();
            $.ajax({
                url: "{{url('rublica')}}/"+dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    data.forEach(element => {
                        $('#datalistOptions').html(`<option value="${element.rsrublica}">`)
                    });
                }
            });
        });
                $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                if (dados) {
                    $.ajax({
                        url: "{{url('trabalhador')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                            console.log(data)
                          if (data.id) {
                            $('#trabalhador').val(data.trabalhador)
                            $('#matricula').val(data.tsmatricula)
                          }
                            // if (data.id) {
                            //     $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
                            //     $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador)
                            //     $('#incluir').attr('disabled','disabled')
                            //     $('#atualizar').removeAttr( "disabled" )
                            //     $('#deletar').removeAttr( "disabled" )
                            //     $('#excluir').removeAttr( "disabled" )
                            //     $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/"+data.tomador+"/mostrar")
                            //     $('#method').val('PUT')
                            
                            // }else{
                            //     $('#form').attr('action', "{{ route('tomador.store') }}");
                            //     $('#incluir').removeAttr( "disabled" )
                            //     $('#atualizar').attr('disabled','disabled')
                            //     $('#deletar').attr('disabled','disabled')
                            //     $('#method').val(' ')
                            //     $('#excluir').attr( "disabled",'disabled' )
                            //     $('#tabelapreco').addClass('disabled').removeAttr('href')
                            // }
                            // $('#cnpj').val(data.tscnpj)
                            // $('#matricula').val(data.tsmatricula)
                            // $('#nome__fantasia').val(data.tsfantasia)
                            // $('#simples').val(data.tssimples)
                            // $('#telefone').val(data.tstelefone)
                            // $('#cep').val(data.escep)
                            // $('#logradouro').val(data.eslogradouro)
                            // $('#numero').val(data.esnum)
                            // $('#tipo').val(data.estipo)
                            // $('#bairro').val(data.esbairro)
                            // $('#localidade').val(data.esmunicipio)
                            // $('#uf').val(data.esuf)
                            // $('#complemento').val(data.escomplemento)
                            // $('#taxa_adm').val(data.tftaxaadm.toFixed(2).toString().replace(".", ","))
                            // // $('#caixa_benef').val(data.tfbenef.toFixed(2).toString().replace(".", ","))
                            // // $('#ferias').val(data.tfferias.toFixed(2).toString().replace(".", ","))
                            // // $('#13_salario').val(data.tf13.toFixed(2).toString().replace(".", ","))
                            // $('#taxa__fed').val(data.tftaxafed.toFixed(2).toString().replace(".", ","))
                            // // $('#ferias_trab').val(data.tsferias.toFixed(2).toString().replace(".", ","))
                            // // $('#13__saltrab').val(data.tsdecimo13.toFixed(2).toString().replace(".", ","))
                            // // $('#rsr').val(data.tsrsr.toFixed(2).toString().replace(".", ","))
                            // $('#das').val(data.tfdas.toFixed(2).toString().replace(".", ","))
                            // $('#cod__fpas').val(data.psfpas)
                            // $('#cod__grps').val(data.psgrps)
                            // $('#cod__recol').val(data.psresol)
                            // $('#cnae').val(data.pscnae)
                            // $('#fap__aliquota').val(data.psfapaliquota.toFixed(2).toString().replace(".", ","))
                            // $('#rat__ajustado').val(data.psratajustados.toFixed(2).toString().replace(".", ","))
                            // $('#fpas__terceiros').val(data.psfpasterceiros)
                            // $('#aliq__terceiros').val(data.psaliquotaterceiros.toString().replace(".", ","))
                            // $('#esocial').val(data.pssocial)
                            // $('#alimentacao').val(data.isalimentacao.toFixed(2).toString().replace(".", ","))
                            // $('#transporte').val(data.istransporte.toFixed(2).toString().replace(".", ","))
                            // $('#epi').val(data.isepi.toFixed(2).toString().replace(".", ","))
                            // $('#seguro__trabalhador').val(data.isseguroportrabalhador.toString().replace(".", ","))
                            // // $('#indice__folha').val(data.isindecesobrefolha)
                            // // $('#valor__transporte').val(data.isvaletransporte.toFixed(2).toString().replace(".", ","))
                            // // $('#valor__alimentacao').val(data.isvalealimentacao.toFixed(2).toString().replace(".", ","))
                            // $('#dias_uteis').val(data.csdiasuteis)
                            // $('#sabados').val(data.cssabados)
                            // $('#domingos').val(data.csdomingos)
                            // $('#inss__empresa').val(data.rsinssempresa.toFixed(2).toString().replace(".", ","))
                            // $('#fgts__empresa').val(data.rsfgts.toFixed(2).toString().replace(".", ","))
                            // // $('#valor_fatura').val(data.rsvalorfatura.toFixed(2).toString().replace(".", ","))
                            // $('#nome__conta').val(data.bstitular)
                            // $('#banco').val(data.bsbanco)
                            // $('#agencia').val(data.bsagencia)
                            // $('#operacao').val(data.bsoperacao)
                            // $('#conta').val(data.bsconta)
                            // $('#pix').val(data.bspix)
                            // $('#folhartransporte').val(data.instransporte.toFixed(2).toString().replace(".", ","))
                            // $('#folharalim').val(data.insalimentacao.toFixed(2).toString().replace(".", ","))
                            // $('#deflator').val(data.tfdefaltor.toFixed(2).toString().replace(".", ","))
                            // $('#endereco').val(data.eiid)
                            // $('#bancario').val(data.biid)
                            // for (let index = 0; index <  $('#tipo option').length; index++) {  
                            //     if (data.tstipo == $('#tipo option').eq(index).text()) {
                                    
                            //         $('#tipo option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#tipo option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            
                            // for (let index = 0; index <  $('#folhartipotrans option').length; index++) {  
                            //     if (data.instipotrans == $('#folhartipotrans option').eq(index).text()) {
                                    
                            //         $('#folhartipotrans option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#folhartipotrans option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#folhartipoalim option').length; index++) {  
                            //     if (data.instipoali == $('#folhartipoalim option').eq(index).text()) {
                                    
                            //         $('#folhartipoalim option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#folhartipoalim option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#retencaofgts option').length; index++) {  
                            //     if (data.rstipofgts == $('#retencaofgts option').eq(index).text()) {
                                    
                            //         $('#retencaofgts option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#retencaofgts option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#retencaoinss option').length; index++) {  
                            //     if (data.rstipoinssempresa == $('#retencaoinss option').eq(index).text()) {
                                    
                            //         $('#retencaoinss option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#retencaoinss option').eq(index).removeAttr('selected')
                            //     }
                            // }
                            // for (let index = 0; index <  $('#valorfatura option').length; index++) {  
                            //     if (data.rsvalorfatura == $('#valorfatura option').eq(index).text()) {
                                    
                            //         $('#valorfatura option').eq(index).attr('selected','selected')
                            //     }else  {
                            //         $('#valorfatura option').eq(index).removeAttr('selected')
                            //     }
                            // }
                        }
                    });
                }
            });
          </script>
@stop