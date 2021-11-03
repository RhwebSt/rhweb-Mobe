@extends('layouts.index')
@section('conteine')
<div class="container">
              <h5 class="card-title text-center fs-3 ">Comissionado</h5>

                <!-- <p class="text-success">Comissionado cadastrado com sucesso.</p>

                <p class="text-danger">Não foi possivel cadastrar o Comissionado.</p>

                <p class="text-danger">Comissionado não cadastrado.</p> -->


              <form class="row g-3 mt-1 mb-3" method="POST" action="">

                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                      <a class="btn ms-2" href="#" role="button" style="background-color: #2A90CB; color: #f0f0f0">Incluir</a>
                      <button type="button" class="btn ms-2  col-md-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #2A90CB; color: #f0f0f0">
                          Excluir
                        </button>
                        
                      <a class="btn btn-primary btn-md btn-radius ms-2 col-md-1" href="#" role="button">Editar</a>
                      <a class="btn btn-outline-light ms-2 col-md-1" href="#" style="background-color: #2A90CB; color: #f0f0f0" role="button">Sair</a>
                  </div>
              </div>

                <div class="col-md-6">
                  <label for="tomador" class="form-label">Tomador</label>
                  <input type="text" class="form-control" name="tomador" value="" id="tomador">
                </div>

                <div class="col-md-6">
                    <label for="nome__trabalhador" class="form-label">Nome do Trabalhador</label>
                    <input type="text" class="form-control" name="nome__trabalhador" id="nome__trabalhador">
                </div>

                <div class="col-md-3">
                  <label for="matricula__trab" class="form-label">Matricula Trabalhador</label>
                  <input type="text" class="form-control" name="matricula__trab" value="" id="matricula__trab">
                </div>

                <div class="col-md-3">
                  <label for="indice" class="form-label">Indíce %</label>
                  <input type="password" class="form-control" name="indice" value="" id="indice">
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
           
            $( "#nome__trabalhador" ).keyup(function() {
                var dados = $( "#nome__trabalhador" ).val();
                $.ajax({
                    url: "{{url('trabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log(data)
                        // if (data.trabalhador) {
                        //     $('#form').attr('action', "{{ url('trabalhador')}}/"+data.trabalhador);
                        //     $('#formdelete').attr('action',"{{ url('trabalhador')}}/"+data.trabalhador)
                        //     $('#depedente').removeClass('disabled')
                        //     $('#depedente').attr('href',"{{ url('depedente')}}/"+data.trabalhador+'/mostrar')
                        //     $('#incluir').attr('disabled','disabled')
                        //     $('#atualizar').removeAttr( "disabled" )
                        //     $('#deletar').removeAttr( "disabled" )
                        //     $('#excluir').removeAttr( "disabled" )
                        //     $('#method').val('PUT')
                        // }else{
                        //   $('#depedente').addClass('disabled')
                        //     $('#form').attr('action', "{{ route('trabalhador.store') }}");
                        //     $('#incluir').removeAttr( "disabled" )
                        //     $('#depedente').removeAttr( "disabled" )
                        //     $('#atualizar').attr('disabled','disabled')
                        //     $('#deletar').attr('disabled','disabled')
                        //     $('#method').val(' ')
                        //     $('#excluir').attr( "disabled" )
                        // }
                        // $('#cpf').val(data.tscpf)
                        // $('#matricula').val(data.tsmatricula)
                        // $('#pis').val(data.dspis)
                        // $('#data_nascimento').val(data.nsnascimento)
                        // $('#telefone').val(data.tstelefone)
                        // $('#pais__nascimento').val(data.nsnaturalidade)
                        // $('#pais__nacionalidade').val(data.nsnacionalidade)
                        // $('#nome__mae').val(data.tsmae)
                        // $('#cep').val(data.escep)
                        // $('#logradouro').val(data.esmunicipio)
                        // $('#uf').val(data.esuf)
                        // $('#numero').val(data.esnum)
                        // $('#complemento').val(data.escomplemento)
                        // $('#bairro').val(data.esbairro)
                        // $('#localidade').val(data.eslogradouro)
                        // $('#uf').val(data.esuf)
                        // $('#data__admissao').val(data.csadmissao)
                        // $('#categoria').val(data.cscategoria)
                        // $('#cbo').val(data.cbo)
                        // $('#irrf').val(data.csirrf)
                        // $('#sf').val(data.psfpas)
                        // $('#ctps').val(data.dsctps)
                        // $('#serie__ctps').val(data.dsserie)
                        // $('#uf__ctps').val(data.dsuf)
                        // $('#situacao__contrato').val(data.cssituacao)
                        // $('#data__afastamento').val(data.csafastamento)
                        // $('#nome__conta').val(data.bstitular)
                        // $('#banco').val(data.bsbanco)
                        // $('#agencia').val(data.bsagencia)
                        // $('#operacao').val(data.bsoperacao)
                        // $('#conta').val(data.bsconta)
                        // $('#pix').val(data.bspix)
                        // $('#bsdefaltor').val(data.deflator)
                        // $('#endereco').val(data.eiid)
                        // $('#bancario').val(data.biid)
                    }
                });
            });
            $( "#tomador" ).keyup(function() {
                var dados = $( "#tomador" ).val();
                $.ajax({
                    url: "{{url('tomador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log(data)
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
                        //     $('#excluir').attr( "disabled" )
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
                        // $('#taxa_adm').val(data.tftaxaadm)
                        // $('#caixa_benef').val(data.tfbenef)
                        // $('#ferias').val(data.tfferias)
                        // $('#13_salario').val(data.tf13)
                        // $('#taxa__fed').val(data.tftaxafed)
                        // $('#ferias_trab').val(data.tsferias)
                        // $('#13__saltrab').val(data.tsdecimo13)
                        // $('#rsr').val(data.tsrsr)
                        // $('#das').val(data.das)
                        // $('#cod__fpas').val(data.psfpas)
                        // $('#cod__grps').val(data.psgrps)
                        // $('#cod__recol').val(data.psrecol)
                        // $('#cnae').val(data.pscnae)
                        // $('#fap__aliquota').val(data.psfapaliquota)
                        // $('#rat__ajustado').val(data.psratajustados)
                        // $('#fpas__terceiros').val(data.psfpasterceiros)
                        // $('#aliq__terceiros').val(data.psaliquotateceiros)
                        // $('#esocial').val(data.pssocial)
                        // $('#alimentacao').val(data.isalimentacao)
                        // $('#transporte').val(data.istransporte)
                        // $('#epi').val(data.isepi)
                        // $('#seguro__trabalhador').val(data.isseguroportrabalhador)
                        // $('#indice__folha').val(data.isindecesobrefolha)
                        // $('#valor__transporte').val(data.isvaletransporte)
                        // $('#valor__alimentacao').val(data.isvalealimentacao)
                        // $('#dias_uteis').val(data.csdiasuteis)
                        // $('#sabados').val(data.cssabados)
                        // $('#domingos').val(data.csdomingos)
                        // $('#inss__empresa').val(data.rsinssempresa)
                        // $('#fgts__empresa').val(data.rsfgts)
                        // $('#valor_fatura').val(data.rsvalorfatura)
                        // $('#nome__conta').val(data.bstitular)
                        // $('#banco').val(data.bsbanco)
                        // $('#agencia').val(data.bsagencia)
                        // $('#operacao').val(data.bsoperacao)
                        // $('#conta').val(data.bsconta)
                        // $('#pix').val(data.bspix)
                        // $('#deflator').val(data.bsdefaltor)
                        // $('#endereco').val(data.eiid)
                        // $('#bancario').val(data.biid)
                    }
                });
            });
        });
    </script>     
@stop