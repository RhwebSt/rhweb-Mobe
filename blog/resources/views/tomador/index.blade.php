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
                <div class="alert alert-danger mt-2 alert-block">
                    <strong>Não foi possível realizar o cadastro !</strong>
                </div>
            @endif
            @endforeach
        @endif     
        
            <form class="row g-3 mt-1 mb-3  g-3 needs-validation" novalidate id="form" action="{{ route('tomador.store') }}"  method="Post" >
                        <div class="btn " role="button" aria-label="Basic example">
                            <button type="submit" id="incluir" class="btn botao" value="Validar!">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn botao">Atualizar</button>
                           
                            <!-- <a class="btn btn btn-outline-dark" href="{{ route('tomador.index') }}" role="button">Consultar</a> -->
                            <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Excluir
                            </button>
                            <a class="btn botao disabled" href="" id="tabelapreco" role="button">Tabela de Preço</a>
                            <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
                        </div> 
                        
                        <div class="col-md-6 mt-5 mb-4">
                            <label for="exampleDataList" class="form-label">Buscar</label>
                            <input class="pesquisa form-control fw-bold text-dark" list="datalistOptions" name="pesquisa" id="pesquisa">
                            <datalist id="datalistOptions">
                            </datalist>
                        </div>
                        
                        <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa"" required>
                        <div id="mensagem-pesquisa" class="invalid-feedback"></div>
                            
                            
                        <div class="container text-center mb-3  fs-4 fw-bold">Dados da Empresa</div>
                        @csrf
                        <input type="hidden" id="method" name="_method" value="">
                        <input type="hidden" name="empresa" value="{{$user->empresa}}">
                        <input type="hidden" name="trabalhador">
                       
                        <div class="col-md-6">
                            <label for="nome__completo" class="form-label ">Nome Completo</label>
                            <input type="text" class="form-control input @error('nome__completo') is-invalid @enderror  fw-bold text-dark" name="nome__completo"  id="nome__completo">
                            @error('nome__completo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nome__fantasia" class="form-label">Nome Fantasia</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="nome__fantasia" value="" id="nome__fantasia">
                        </div>

                        <div class="col-md-2">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="cnpj" value="" id="cnpj">
                        </div>
                        
                        <div class="col-md-2">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select id="tipo" name="tipo" class="form-select fw-bold text-dark">
                            <option selected >1</option>
                            <option >2</option>
                            <option >3</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="matricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="matricula" value="" id="matricula">
                        </div>

                        <div class="col-md-3">
                            <label for="simples" class="form-label">Simples</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="simples" value="" id="simples">
                        </div>

                        <div class="col-md-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="telefone" value="" id="telefone">
                        </div>

                        
                       
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Endereço</h1>

                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="cep"   id="cep">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="logradouro" class="form-label">Rua</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="logradouro" value="" id="logradouro">
                        </div>

                        <div class="col-md-1">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="numero" value="" id="numero">
                        </div>

                        <div class="col-md-3"> 
                                <label for="tipoconstrucao" class="form-label">Tipo da construção</label>
                                <select name="tipoconstrucao" id="tipoconstrucao" class="form-select fw-bold text-dark">
                                <option selected >Casa</option>
                                <option >Apartamento</option>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="bairro" value="" id="bairro">
                        </div>

                        <div class="col-md-5">
                            <label for="localidade" class="form-label">Municipio</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="localidade" value="" id="localidade">
                        </div>


                        <div class="col-md-2">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="uf" value="" id="uf">
                        </div>

                        <div class="col-md-5 d-none">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="complemento__endereco" value="" id="complemento">
                        </div>

                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Tomador Taxas</h1>


                        <div class="col-md-3">
                            <label for="taxa_adm" class="form-label">Taxa Adm %</label>
                            <input type="text" class="form-control input fw-bold text-dark " name="taxa_adm" value="" id="taxa_adm">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="caixa_benef" class="form-label">Caixa benef. %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="caixa_benef" value="" id="caixa_benef">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="ferias" class="form-label">Férias 1,00 %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="ferias" value="" id="ferias">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="13_salario" class="form-label">13º Salário 0,66 %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="13_salario" value="" id="13_salario">
                        </div>

                        <div class="col-md-3">
                            <label for="taxa__fed" class="form-label">Taxa Fed. %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="taxa__fed" value="" id="taxa__fed">
                        </div>
                        <div class="col-md-3">
                            <label for="deflator" class="form-label">% DEFLATOR</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="deflator" value="" id="deflator">
                        </div>
                        <div class="col-md-3">
                            <label for="das" class="form-label">DAS %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="das" value="" id="das">
                        </div>
                        <!-- <h1 class="container text-center  fs-4 fw-bold">Trabalhador</h1> -->


                        <div class="col-md-3 d-none">
                            <label for="ferias_trab" class="form-label">Férias %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="ferias_trab" value="" id="ferias_trab">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="13__saltrab" class="form-label">13º Sálario %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="13__saltrab" value="" id="13__saltrab">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="rsr" class="form-label">RSR %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="rsr" value="" id="rsr">
                        </div>

                        <!-- <div class="col-md-3">
                            <label for="das" class="form-label">DAS %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="das" value="" id="das">
                        </div> -->


                        <h1 class="container text-center mt-4 mb-3   fs-4 fw-bold">Parametros SEFIP</h1>


                        <div class="col-md-3">
                            <label for="cod__fpas" class="form-label">Cod FPAS</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="cod__fpas" value="" id="cod__fpas">
                        </div>

                        <div class="col-md-3">
                            <label for="cod__grps" class="form-label">Cod GRPS</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="cod__grps" value="" id="cod__grps">
                        </div>

                        <div class="col-md-3">
                            <label for="cod__recol" class="form-label">Cod Recol</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="cod__recol" value="" id="cod__recol">
                        </div>

                        <div class="col-md-3">
                            <label for="cnae" class="form-label">CNAE</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="cnae" value="" id="cnae">
                        </div>

                        <div class="col-md-3">
                            <label for="fap__aliquota" class="form-label">FAP Aliquota %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="fap__aliquota" value="" id="fap__aliquota">
                        </div>

                        <div class="col-md-3">
                            <label for="rat__ajustado" class="form-label">RAT Ajustado %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="rat__ajustado" value="" id="rat__ajustado">
                        </div>

                        <div class="col-md-3">
                            <label for="fpas__terceiros" class="form-label">FPAS Terceiros</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="fpas__terceiros" value="" id="fpas__terceiros">
                        </div>

                        <div class="col-md-3">
                            <label for="aliq__terceiros" class="form-label">Aliq. Terceiros</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="aliq__terceiros" value="" id="aliq__terceiros">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="esocial" class="form-label">E-SOCIAL Nº</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="esocial" value="" id="esocial">
                        </div>

                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Incide Sobre Fatura</h1>


                        <div class="col-md-2">
                            <label for="alimentacao" class="form-label"> Alimentação</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="alimentacao" value="" id="alimentacao">
                        </div>

                        <div class="col-md-2">
                            <label for="transporte" class="form-label">Transporte</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="transporte" value="" id="transporte">
                        </div>

                        <div class="col-md-5">
                            <label for="epi" class="form-label">EPI % (Sobre(PROD+RSR)Folha)</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="epi" value="" id="epi">
                        </div>

                        <div class="col-md-3">
                            <label for="seguro__trabalhador" class="form-label">Seguro (Val.Trab)</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="seguro__trabalhador" value="" id="seguro__trabalhador">
                        </div>


                        <div class="col-md-4 d-none">
                            <label for="indice__folha" class="form-label">Indíce sobre Folha ( 1 Paga - 2 Desconta )</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="indice__folha" value="" id="indice__folha">
                        </div>

                        <div class="col-md-2 d-none">
                            <label for="valor__transporte" class="form-label">Valor Vale Transporte</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="valor__transporte" value="" id="valor__transporte">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="valor__alimentacao" class="form-label">Valor Vale Alimentação</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="valor__alimentacao" value="" id="valor__alimentacao">
                        </div>
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Incide sobre a folha</h1>


                        <div class="col-md-3">
                            <label for="folhartransporte" class="form-label">VT Transporte</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="folhartransporte" value="" id="folhartransporte">
                        </div>
                        <div class="col-md-3">
                        <label for="folhartipotrans" class="form-label">Tipo</label>
                        <select class="form-select fw-bold text-dark" id="folhartipotrans" name="folhartipotrans" aria-label="Default select example">
                            <option selected>1</option>
                            <option >2</option>
                        </select>
                        </div>
                        <div class="col-md-3">
                            <label for="folharalim" class="form-label">VA Alimentação</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="folharalim" value="" id="folharalim">
                        </div>
                        <div class="col-md-3">
                        <label for="folhartipoalim" class="form-label">Tipo</label>
                        <select class="form-select fw-bold text-dark" id="folhartipoalim" name="folhartipoalim" aria-label="Default select example">
                            <option  selected>1</option>
                            <option>2</option>
                        </select>
                        </div>
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Informação para o Cartão Ponto</h1>

                        <div class="col-md-4">
                            <label for="dias_uteis" class="form-label">Dias Úteis</label>
                            <input type="time" class="form-control input fw-bold text-dark" name="dias_uteis" value="" id="dias_uteis">
                        </div>

                        <div class="col-md-4">
                            <label for="sabados" class="form-label">Sábados</label>
                            <input type="time" class="form-control input fw-bold text-dark" name="sabados" value="" id="sabados">
                        </div>

                        <div class="col-md-4">
                            <label for="domingos" class="form-label">Domingos</label>
                            <input type="time" class="form-control input fw-bold text-dark" name="domingos" value="" id="domingos">
                        </div>


                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Retenções na Fatura</h1>


                        <div class="col-md-3">
                            <label for="inss__empresa" class="form-label">INSS Empresa %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="inss__empresa" value="" id="inss__empresa">
                        </div>
                        <div class="col-md-2">
                        <label for="retencaoinss" class="form-label">Retenção INSS</label>
                        <select class="form-select fw-bold text-dark" id="retencaoinss" name="retencaoinss" aria-label="Default select example">
                            <option  selected>SIM</option>
                            <option>NÃO</option>
                        </select>
                        </div>
                        <div class="col-md-2">
                            <label for="fgts__empresa" class="form-label">FGTS Empresa %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="fgts__empresa" value="" id="fgts__empresa">
                        </div>
                        <div class="col-md-2">
                        <label for="retencaofgts" class="form-label">Retenção FGTS</label>
                        <select class="form-select fw-bold text-dark" id="retencaofgts" name="retencaofgts" aria-label="Default select example">
                            <option selected>SIM</option>
                            <option >NÃO</option>
                        </select>
                        </div>
                        <div class="col-md-3">
                        <label for="valorfatura" class="form-label">Base da Fatura</label>
                        <select class="form-select fw-bold text-dark" id="valorfatura" name="valor_fatura" aria-label="Default select example">
                            <option selected>Produção</option>
                            <option>Fatura</option>
                        </select>
                        </div>
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Dados Bancários</h1>
                        <div class="col-md-6 d-none">
                            <label for="nome__conta" class="form-label">Nome do Titular</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="nome__conta" value="" id="nome__conta">
                        </div>

                        <div class="col-md-3 mb-5">
                            <label for="banco" class="form-label">Banco</label>
                            <input type="text" class="form-control input fw-bold text-dark "  aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="" id="banco">
                            <div id="menssagem-banco" class="valid-feedback">
                               
                            </div>
                        </div>

                        <div class="col-md-2 mb-5">
                            <label for="agencia" class="form-label">Agência</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="agencia" value="" id="agencia">
                        </div>

                        <div class="col-md-2 mb-5">
                            <label for="operacao" class="form-label">Operação</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="operacao" value="" id="operacao">
                        </div>

                        <div class="col-md-2 mb-5">
                            <label for="conta" class="form-label">Conta</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="conta" value="" id="conta">
                        </div>

                        <div class="col-md-3 mb-5">
                            <label for="pix" class="form-label">PIX</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="pix" value="" id="pix">
                        </div>

                       
                    <input type="hidden" name="endereco" id="endereco">

                    <input type="hidden" name="bancario" id="bancario">
                </div>
            </form>
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
<script>
        $(document).ready(function(){
           
            $('#pesquisa').keyup(function(){
                let dados = $(this).val();
                dados =  dados.replace(/\D/g, '');
                if (!dados) {
                    dados = $(this).val();
                }
                if (dados) {
                    $.ajax({
                    url: "{{url('tomador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        let nome = ''
                        if (data.length >= 1) {
                            data.forEach(element => {
                            nome += `<option value="${element.tsnome}">`
                            nome += `<option value="${element.tsmatricula}">`
                            nome += `<option value="${element.tscnpj}">`
                            });
                            $('#datalistOptions').html(nome)
                            
                        } 
                        if(data.length === 1 && dados.length > 4){
                            // data.forEach(element => {
                            //   nome += `<option value="${element.tsnome}">`
                            //   nome += `<option value="${element.tsmatricula}">`
                            //   nome += `<option value="${element.tscpf}">`
                            // });
                            // $('#datalistOptions').html(nome)
                            tomador(data)
                        }else{
                            if (dados.length === 14) {
                                pesquisa(dados)
                            }
                        }         
                     }
                    });
                }else{
                    tomador(' ')
                }
               
            })
            function tomador(data) {
                if (data.id) {
                    $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
                    $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador)
                    $('#incluir').attr('disabled','disabled')
                    $('#atualizar').removeAttr( "disabled" )
                    $('#deletar').removeAttr( "disabled" )
                    $('#excluir').removeAttr( "disabled" )
                    $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/ /"+data.tomador)
                    $('#method').val('PUT')
                
                }else{
                    $('#form').attr('action', "{{ route('tomador.store') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#excluir').attr( "disabled",'disabled' )
                    $('#tabelapreco').addClass('disabled').removeAttr('href')
                }
                $('#nome__completo').val(data.tsnome)
                $('#cnpj').val(data.tscnpj)
                $('#matricula').val(data.tsmatricula)
                $('#nome__fantasia').val(data.tsfantasia)
                $('#simples').val(data.tssimples)
                $('#telefone').val(data.tstelefone)
                $('#cep').val(data.escep)
                $('#logradouro').val(data.eslogradouro)
                $('#numero').val(data.esnum)
                // $('#tipo').val(data.estipo)
                $('#bairro').val(data.esbairro)
                $('#localidade').val(data.esmunicipio)
                $('#uf').val(data.esuf)
                $('#complemento').val(data.escomplemento)
                $('#taxa_adm').val(data.tftaxaadm.toFixed(2).toString().replace(".", ","))
                // $('#caixa_benef').val(data.tfbenef.toFixed(2).toString().replace(".", ","))
                // $('#ferias').val(data.tfferias.toFixed(2).toString().replace(".", ","))
                // $('#13_salario').val(data.tf13.toFixed(2).toString().replace(".", ","))
                $('#taxa__fed').val(data.tftaxafed.toFixed(2).toString().replace(".", ","))
                // $('#ferias_trab').val(data.tsferias.toFixed(2).toString().replace(".", ","))
                // $('#13__saltrab').val(data.tsdecimo13.toFixed(2).toString().replace(".", ","))
                // $('#rsr').val(data.tsrsr.toFixed(2).toString().replace(".", ","))
                $('#das').val(data.tfdas.toFixed(2).toString().replace(".", ","))
                $('#cod__fpas').val(data.psfpas)
                $('#cod__grps').val(data.psgrps)
                $('#cod__recol').val(data.psresol)
                $('#cnae').val(data.pscnae)
                $('#fap__aliquota').val(data.psfapaliquota.toFixed(2).toString().replace(".", ","))
                $('#rat__ajustado').val(data.psratajustados.toFixed(2).toString().replace(".", ","))
                $('#fpas__terceiros').val(data.psfpasterceiros)
                $('#aliq__terceiros').val(data.psaliquotaterceiros.toString().replace(".", ","))
                $('#esocial').val(data.pssocial)
                $('#alimentacao').val(data.isalimentacao.toFixed(2).toString().replace(".", ","))
                $('#transporte').val(data.istransporte.toFixed(2).toString().replace(".", ","))
                $('#epi').val(data.isepi.toFixed(2).toString().replace(".", ","))
                $('#seguro__trabalhador').val(data.isseguroportrabalhador.toString().replace(".", ","))
                // $('#indice__folha').val(data.isindecesobrefolha)
                // $('#valor__transporte').val(data.isvaletransporte.toFixed(2).toString().replace(".", ","))
                // $('#valor__alimentacao').val(data.isvalealimentacao.toFixed(2).toString().replace(".", ","))
                $('#dias_uteis').val(data.csdiasuteis)
                $('#sabados').val(data.cssabados)
                $('#domingos').val(data.csdomingos)
                $('#inss__empresa').val(data.rsinssempresa.toFixed(2).toString().replace(".", ","))
                $('#fgts__empresa').val(data.rsfgts.toFixed(2).toString().replace(".", ","))
                // $('#valor_fatura').val(data.rsvalorfatura.toFixed(2).toString().replace(".", ","))
                $('#nome__conta').val(data.bstitular)
                $('#banco').val(data.bsbanco)
                $('#agencia').val(data.bsagencia)
                $('#operacao').val(data.bsoperacao)
                $('#conta').val(data.bsconta)
                $('#pix').val(data.bspix)
                $('#folhartransporte').val(data.instransporte.toFixed(2).toString().replace(".", ","))
                $('#folharalim').val(data.insalimentacao.toFixed(2).toString().replace(".", ","))
                $('#deflator').val(data.tfdefaltor.toFixed(2).toString().replace(".", ","))
                $('#endereco').val(data.eiid)
                $('#bancario').val(data.biid)
                for (let index = 0; index <  $('#tipo option').length; index++) {  
                    if (data.tstipo == $('#tipo option').eq(index).text()) {
                        
                        $('#tipo option').eq(index).attr('selected','selected')
                    }else  {
                        $('#tipo option').eq(index).removeAttr('selected')
                    }
                }
                
                for (let index = 0; index <  $('#folhartipotrans option').length; index++) {  
                    if (data.instipotrans == $('#folhartipotrans option').eq(index).text()) {
                        
                        $('#folhartipotrans option').eq(index).attr('selected','selected')
                    }else  {
                        $('#folhartipotrans option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#folhartipoalim option').length; index++) {  
                    if (data.instipoali == $('#folhartipoalim option').eq(index).text()) {
                        
                        $('#folhartipoalim option').eq(index).attr('selected','selected')
                    }else  {
                        $('#folhartipoalim option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#retencaofgts option').length; index++) {  
                    if (data.rstipofgts == $('#retencaofgts option').eq(index).text()) {
                        
                        $('#retencaofgts option').eq(index).attr('selected','selected')
                    }else  {
                        $('#retencaofgts option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#retencaoinss option').length; index++) {  
                    if (data.rstipoinssempresa == $('#retencaoinss option').eq(index).text()) {
                        
                        $('#retencaoinss option').eq(index).attr('selected','selected')
                    }else  {
                        $('#retencaoinss option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#valorfatura option').length; index++) {  
                    if (data.rsvalorfatura == $('#valorfatura option').eq(index).text()) {
                        
                        $('#valorfatura option').eq(index).attr('selected','selected')
                    }else  {
                        $('#valorfatura option').eq(index).removeAttr('selected')
                    }
                }
            }
            function pesquisa(dados) {
                $.ajax({
                    url: "https://brasilapi.com.br/api/cnpj/v1/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        for (let index = 0; index < $('.input').length; index++) {
                            $('.input').eq(index).val(' ')
                        }
                        $("#pesquisa").removeClass('is-invalid')
                        $('#nome__completo').val(data.razao_social)
                        $('#nome__fantasia').val(data.nome_fantasia)
                        $('#cnpj').val(data.cnpj)
                        $('#telefone').val(data.ddd_telefone_1)
                        $('#cnae').val(data.cnae_fiscal)
                        $('#mensagem-pesquisa').text(' ').addClass('valid-feedback').removeClass('invalid-feedback')
                    },
                    error: function(data){
                        // $("#pesquisa").addClass('is-invalid')
                        // $('#nome__completo').val(' ')
                        // $('#nome__fantasia').val('')
                        // $('#cnpj').val('')
                        // $('#telefone').val(' ')
                        // $('#cnae').val(' ')
                        // $('#mensagem-pesquisa').text( data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
                    }
                })
            }
        });
    </script>
    
@stop