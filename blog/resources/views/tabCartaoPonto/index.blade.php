@extends('layouts.index')
@section('conteine')
<div class="card-body">
              <h5 class="card-title text-center fs-3 ">Lançamento com Tabela</h5>

                <p class="text-success">Boletim criado com sucesso.</p>


              <form class="row g-3 mt-1 mb-3" method="POST" action="{{route('tabcartaoponto.store')}}">
              @csrf
                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
       
                        <button type="submit" id="incluir" class="btn btn-primary">Incluir</button>
                        <button type="submit" id="atualizar" disabled class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-primary  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                      </button>
                      <a class="btn btn btn-primary" href="{{route('tabcadastro.index')}}" role="button" >Lançar</a>
               
                    <a class="btn btn btn-primary" href="{{route('home.index')}}" role="button">Sair</a>
                  </div>
              </div>

                <div class="col-md-6 input">
                  <label for="tomador" class="form-label">Tomador</label>
                  <input type="text" class="form-control " name="nome__completo" value="" id="nome__completo">
                </div>
                  <input type="hidden" name="tomador" id="tomador">
                <div class="col-md-1">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" class="form-control " name="matricula" value="" id="matricula">
                  </div>

                <div class="col-md-2">
                    <label for="num__boletim" class="form-label">Nº do Boletim</label>
                    <input type="text" class="form-control" name="num__boletim" id="num__boletim">
                </div>

                <div class="col-md-2">
                  <label for="data" class="form-label">Data</label>
                  <input type="date" class="form-control" name="data" value="" id="data">
                </div>

                <div class="col-md-2">
                  <label for="num__trabalhador" class="form-label">Nº de Trabalhador</label>
                  <input type="text" class="form-control" name="num__trabalhador" value="" id="num__trabalhador">
                </div>
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
               $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                if (dados) {
                    $.ajax({
                        url: "{{url('tomador')}}/"+dados,
                        type: 'get',
                        contentType: 'application/json',
                        success: function(data) {
                          if (data.id) {
                            $('#tomador').val(data.tomador)
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