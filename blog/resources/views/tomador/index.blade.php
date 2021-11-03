@extends('layouts.index')
@section('conteine')
    <div class="container ">
            
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
        
            <form class="row g-3 mt-1 mb-3" id="form" action="{{ route('tomador.store') }}"  method="Post" >
                        <div class="btn " role="button" aria-label="Basic example">
                            <button type="submit" id="incluir" class="btn btn-primary">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn btn-primary">Atualizar</button>
                           
                            <!-- <a class="btn btn btn-outline-dark" href="{{ route('tomador.index') }}" role="button">Consultar</a> -->
                            <button type="button" class="btn btn-primary  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Excluir
                      </button>
                      <a class="btn btn-primary disabled" href="" id="tabelapreco" role="button">Tabela de Preço</a>
                            <a class="btn btn btn-primary" href="#" role="button">Sair</a>
                            
                        </div>
                        <div class="container text-center  fs-4 fw-bold">Dados da Empresa</div>
                        @csrf
                        <input type="hidden" id="method" name="_method" value="">
                        <input type="hidden" name="trabalhador">
                        <input type="hidden" name="empresa">
                        <div class="col-md-6">
                            <label for="nome__completo" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" name="nome__completo"  id="nome__completo">
                        </div>

                        <div class="col-md-6">
                            <label for="nome__fantasia" class="form-label">Nome Fantasia</label>
                            <input type="text" class="form-control" name="nome__fantasia" value="" id="nome__fantasia">
                        </div>

                        <div class="col-md-2">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" name="cnpj" value="" id="cnpj">
                        </div>

                        <div class="col-md-2">
                            <label for="matricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control" name="matricula" value="" id="matricula">
                        </div>

                        <div class="col-md-2">
                            <label for="simples" class="form-label">Simples</label>
                            <input type="text" class="form-control" name="simples" value="" id="simples">
                        </div>

                        <div class="col-md-2">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone" value="" id="telefone">
                        </div>


                        <h1 class="container text-center  fs-4 fw-bold">Endereço</h1>

                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" name="cep" value="" id="cep">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="logradouro" class="form-label">Rua</label>
                            <input type="text" class="form-control" name="logradouro" value="" id="logradouro">
                        </div>

                        <div class="col-md-1">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" name="numero" value="" id="numero">
                        </div>

                        <div class="col-md-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" name="tipo" value="" id="tipo">
                        </div>

                        <div class="col-md-5">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro" value="" id="bairro">
                        </div>

                        <div class="col-md-5">
                            <label for="localidade" class="form-label">Municipio</label>
                            <input type="text" class="form-control" name="localidade" value="" id="localidade">
                        </div>


                        <div class="col-md-2">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control" name="uf" value="" id="uf">
                        </div>

                        <div class="col-md-5">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" name="complemento__endereco" value="" id="complemento">
                        </div>

                        <h1 class="container text-center  fs-4 fw-bold">Tomador</h1>


                        <div class="col-md-2">
                            <label for="taxa_adm" class="form-label">Taxa Adm %</label>
                            <input type="text" class="form-control" name="taxa_adm" value="" id="taxa_adm">
                        </div>

                        <div class="col-md-2">
                            <label for="caixa_benef" class="form-label">Caixa benef. %</label>
                            <input type="text" class="form-control" name="caixa_benef" value="" id="caixa_benef">
                        </div>

                        <div class="col-md-2">
                            <label for="ferias" class="form-label">Férias 1,00 %</label>
                            <input type="text" class="form-control" name="ferias" value="" id="ferias">
                        </div>

                        <div class="col-md-3">
                            <label for="13_salario" class="form-label">13º Salário 0,66 %</label>
                            <input type="text" class="form-control" name="13_salario" value="" id="13_salario">
                        </div>

                        <div class="col-md-3">
                            <label for="taxa__fed" class="form-label">Taxa Fed. %</label>
                            <input type="text" class="form-control" name="taxa__fed" value="" id="taxa__fed">
                        </div>


                        <h1 class="container text-center  fs-4 fw-bold">Trabalhador</h1>


                        <div class="col-md-3">
                            <label for="ferias_trab" class="form-label">Férias %</label>
                            <input type="text" class="form-control" name="ferias_trab" value="" id="ferias_trab">
                        </div>

                        <div class="col-md-3">
                            <label for="13__saltrab" class="form-label">13º Sálario %</label>
                            <input type="text" class="form-control" name="13__saltrab" value="" id="13__saltrab">
                        </div>

                        <div class="col-md-3">
                            <label for="rsr" class="form-label">RSR %</label>
                            <input type="text" class="form-control" name="rsr" value="" id="rsr">
                        </div>

                        <div class="col-md-3">
                            <label for="das" class="form-label">DAS %</label>
                            <input type="text" class="form-control" name="das" value="" id="das">
                        </div>


                        <h1 class="container text-center  fs-4 fw-bold">Parametros SEFIP</h1>


                        <div class="col-md-3">
                            <label for="cod__fpas" class="form-label">Cod FPAS</label>
                            <input type="text" class="form-control" name="cod__fpas" value="" id="cod__fpas">
                        </div>

                        <div class="col-md-3">
                            <label for="cod__grps" class="form-label">Cod GRPS</label>
                            <input type="text" class="form-control" name="cod__grps" value="" id="cod__grps">
                        </div>

                        <div class="col-md-3">
                            <label for="cod__recol" class="form-label">Cod Recol</label>
                            <input type="text" class="form-control" name="cod__recol" value="" id="cod__recol">
                        </div>

                        <div class="col-md-3">
                            <label for="cnae" class="form-label">CNAE</label>
                            <input type="text" class="form-control" name="cnae" value="" id="cnae">
                        </div>

                        <div class="col-md-3">
                            <label for="fap__aliquota" class="form-label">FAP Aliquota %</label>
                            <input type="text" class="form-control" name="fap__aliquota" value="" id="fap__aliquota">
                        </div>

                        <div class="col-md-2">
                            <label for="rat__ajustado" class="form-label">RAT Ajustado %</label>
                            <input type="text" class="form-control" name="rat__ajustado" value="" id="rat__ajustado">
                        </div>

                        <div class="col-md-2">
                            <label for="fpas__terceiros" class="form-label">FPAS Terceiros</label>
                            <input type="text" class="form-control" name="fpas__terceiros" value="" id="fpas__terceiros">
                        </div>

                        <div class="col-md-2">
                            <label for="aliq__terceiros" class="form-label">Aliq. Terceiros</label>
                            <input type="text" class="form-control" name="aliq__terceiros" value="" id="aliq__terceiros">
                        </div>

                        <div class="col-md-3">
                            <label for="esocial" class="form-label">E-SOCIAL Nº</label>
                            <input type="text" class="form-control" name="esocial" value="" id="esocial">
                        </div>

                        <h1 class="container text-center  fs-4 fw-bold">Indice Sobre Fatura</h1>


                        <div class="col-md-3">
                            <label for="alimentacao" class="form-label">Alimentação</label>
                            <input type="text" class="form-control" name="alimentacao" value="" id="alimentacao">
                        </div>

                        <div class="col-md-3">
                            <label for="transporte" class="form-label">Transporte</label>
                            <input type="text" class="form-control" name="transporte" value="" id="transporte">
                        </div>

                        <div class="col-md-3">
                            <label for="epi" class="form-label">EPI % (Sobre(PROD+RSR)Folha)</label>
                            <input type="text" class="form-control" name="epi" value="" id="epi">
                        </div>

                        <div class="col-md-3">
                            <label for="seguro__trabalhador" class="form-label">Seguro (Valor por Trabalhador)</label>
                            <input type="text" class="form-control" name="seguro__trabalhador" value="" id="seguro__trabalhador">
                        </div>


                        <div class="col-md-4">
                            <label for="indice__folha" class="form-label">Indíce sobre Folha ( 1 Paga - 2 Desconta )</label>
                            <input type="text" class="form-control" name="indice__folha" value="" id="indice__folha">
                        </div>

                        <div class="col-md-2">
                            <label for="valor__transporte" class="form-label">Valor Vale Transporte</label>
                            <input type="text" class="form-control" name="valor__transporte" value="" id="valor__transporte">
                        </div>

                        <div class="col-md-3">
                            <label for="valor__alimentacao" class="form-label">Valor Vale Alimentação</label>
                            <input type="text" class="form-control" name="valor__alimentacao" value="" id="valor__alimentacao">
                        </div>

                        <h1 class="container text-center  fs-4 fw-bold">Informação para o Cartão Ponto</h1>

                        <div class="col-md-4">
                            <label for="dias_uteis" class="form-label">Dias Úteis</label>
                            <input type="text" class="form-control" name="dias_uteis" value="" id="dias_uteis">
                        </div>

                        <div class="col-md-4">
                            <label for="sabados" class="form-label">Sábados</label>
                            <input type="text" class="form-control" name="sabados" value="" id="sabados">
                        </div>

                        <div class="col-md-4">
                            <label for="domingos" class="form-label">Domingos</label>
                            <input type="text" class="form-control" name="domingos" value="" id="domingos">
                        </div>


                        <h1 class="container text-center  fs-4 fw-bold">Retenções na Fatura</h1>


                        <div class="col-md-4">
                            <label for="inss__empresa" class="form-label">INSS Empresa %</label>
                            <input type="text" class="form-control" name="inss__empresa" value="" id="inss__empresa">
                        </div>

                        <div class="col-md-4">
                            <label for="fgts__empresa" class="form-label">FGTS Empresa %</label>
                            <input type="text" class="form-control" name="fgts__empresa" value="" id="fgts__empresa">
                        </div>


                        <h1 class="container text-center  fs-4 fw-bold">Base da Fatura</h1>

                        <div class="col-md-4">
                            <label for="valor_fatura" class="form-label">(P) Valor da Produção - (F) Valor da Folha</label>
                            <input type="text" class="form-control" name="valor_fatura" value="" id="valor_fatura">
                        </div>


                        <h1 class="container text-center  fs-4 fw-bold">Dados Bancários</h1>


                        <div class="col-md-6">
                            <label for="nome__conta" class="form-label">Nome do Titular</label>
                            <input type="text" class="form-control" name="nome__conta" value="" id="nome__conta">
                        </div>

                        <div class="col-md-2">
                            <label for="banco" class="form-label">Banco</label>
                            <input type="text" class="form-control" name="banco" value="" id="banco">
                        </div>

                        <div class="col-md-2">
                            <label for="agencia" class="form-label">Agência</label>
                            <input type="text" class="form-control" name="agencia" value="" id="agencia">
                        </div>

                        <div class="col-md-2">
                            <label for="operacao" class="form-label">Operação</label>
                            <input type="text" class="form-control" name="operacao" value="" id="operacao">
                        </div>

                        <div class="col-md-2">
                            <label for="conta" class="form-label">Conta</label>
                            <input type="text" class="form-control" name="conta" value="" id="conta">
                        </div>

                        <div class="col-md-2">
                            <label for="pix" class="form-label">PIX</label>
                            <input type="text" class="form-control" name="pix" value="" id="pix">
                        </div>

                        <div class="col-md-2">
                            <label for="deflator" class="form-label">% DEFLATOR</label>
                            <input type="text" class="form-control" name="deflator" value="" id="deflator">
                        </div>
                    <input type="hidden" name="endereco" id="endereco">

                    <input type="hidden" name="bancario" id="bancario">
                </form>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                          <form action="" id="formdelete" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header " style="background-color:#000000;">
                                        <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        
                                        
                                        <p class="text-black">Deseja realmente excluir?</p>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-danger">Deletar</button>

                                        </div>
                                    </form>
                          </div>
                        </div>
                      </div>
    </div>
    <script>
        $(document).ready(function(){
           
            $( "#nome__completo" ).keyup(function() {
                var dados = $( "#nome__completo" ).val();
                $.ajax({
                    url: "{{url('tomador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data.id) {
                            $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
                            $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            $('#deletar').removeAttr( "disabled" )
                            $('#excluir').removeAttr( "disabled" )
                            $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/"+data.tomador+"/mostrar")
                            $('#method').val('PUT')
                           
                        }else{
                            $('#form').attr('action', "{{ route('tomador.store') }}");
                            $('#incluir').removeAttr( "disabled" )
                            $('#atualizar').attr('disabled','disabled')
                            $('#deletar').attr('disabled','disabled')
                            $('#method').val(' ')
                            $('#excluir').attr( "disabled" )
                            $('#tabelapreco').addClass('disabled').removeAttr('href')
                        }
                        $('#cnpj').val(data.tscnpj)
                        $('#matricula').val(data.tsmatricula)
                        $('#nome__fantasia').val(data.tsfantasia)
                        $('#simples').val(data.tssimples)
                        $('#telefone').val(data.tstelefone)
                        $('#cep').val(data.escep)
                        $('#logradouro').val(data.eslogradouro)
                        $('#numero').val(data.esnum)
                        $('#tipo').val(data.estipo)
                        $('#bairro').val(data.esbairro)
                        $('#localidade').val(data.esmunicipio)
                        $('#uf').val(data.esuf)
                        $('#complemento').val(data.escomplemento)
                        $('#taxa_adm').val(data.tftaxaadm)
                        $('#caixa_benef').val(data.tfbenef)
                        $('#ferias').val(data.tfferias)
                        $('#13_salario').val(data.tf13)
                        $('#taxa__fed').val(data.tftaxafed)
                        $('#ferias_trab').val(data.tsferias)
                        $('#13__saltrab').val(data.tsdecimo13)
                        $('#rsr').val(data.tsrsr)
                        $('#das').val(data.das)
                        $('#cod__fpas').val(data.psfpas)
                        $('#cod__grps').val(data.psgrps)
                        $('#cod__recol').val(data.psrecol)
                        $('#cnae').val(data.pscnae)
                        $('#fap__aliquota').val(data.psfapaliquota)
                        $('#rat__ajustado').val(data.psratajustados)
                        $('#fpas__terceiros').val(data.psfpasterceiros)
                        $('#aliq__terceiros').val(data.psaliquotateceiros)
                        $('#esocial').val(data.pssocial)
                        $('#alimentacao').val(data.isalimentacao)
                        $('#transporte').val(data.istransporte)
                        $('#epi').val(data.isepi)
                        $('#seguro__trabalhador').val(data.isseguroportrabalhador)
                        $('#indice__folha').val(data.isindecesobrefolha)
                        $('#valor__transporte').val(data.isvaletransporte)
                        $('#valor__alimentacao').val(data.isvalealimentacao)
                        $('#dias_uteis').val(data.csdiasuteis)
                        $('#sabados').val(data.cssabados)
                        $('#domingos').val(data.csdomingos)
                        $('#inss__empresa').val(data.rsinssempresa)
                        $('#fgts__empresa').val(data.rsfgts)
                        $('#valor_fatura').val(data.rsvalorfatura)
                        $('#nome__conta').val(data.bstitular)
                        $('#banco').val(data.bsbanco)
                        $('#agencia').val(data.bsagencia)
                        $('#operacao').val(data.bsoperacao)
                        $('#conta').val(data.bsconta)
                        $('#pix').val(data.bspix)
                        $('#deflator').val(data.bsdefaltor)
                        $('#endereco').val(data.eiid)
                        $('#bancario').val(data.biid)
                    }
                });
            });
        });
    </script>
    
@stop