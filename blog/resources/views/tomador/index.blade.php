@extends('layouts.index')
@section('conteine')
    <div class="container ">    
        @error('true')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>{{$message}}<i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
        @enderror
        @error('false')
            <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>{{$message}}<i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
        @enderror
            <form class="row g-3 mt-1 mb-3  g-3 needs-validation" novalidate id="form" action="{{ route('tomador.store') }}"  method="Post" >
                        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                            <button type="submit" id="incluir" class="btn botao" value="Validar!">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn botao">Atualizar</button>
                           
                            <!-- <a class="btn btn btn-outline-dark" href="{{ route('tomador.index') }}" role="button">Consultar</a> -->
                            <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Excluir
                            </button>
                            <a class="btn botao disabled" href="" id="tabelapreco" role="button"><i class="fas fa-dollar-sign"></i> Tabela de Preço</a>
                            
                            <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fad fa-file-invoice"></i> Boletins
                            </button>
                            
                            <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
                        </div> 
                        

                        <div>
                            <div class="col-md-5 mt-5 mb-5 p-1 pesquisar">
                                <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                <datalist id="datalistOptions">
                                    <!-- <option value="San Francisco">
                                    <option value="New York">
                                    <option value="Seattle">
                                    <option value="Los Angeles">
                                    <option value="Chicago"> -->
                                </datalist>
                                <i class="fas fa-search fa-md iconsear"></i>
                                </div>
                            </div>
                        </div>
                        
                        
                        <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa"" required>
                        <div id="mensagem-pesquisa" class="invalid-feedback"></div>
                            
                            
                        <div class="container text-center mb-3  fs-4 fw-bold">Dados da Empresa <i class="fad fa-building"></i></div>
                        @csrf
                        <input type="hidden" id="method" name="_method" value="">
                        <input type="hidden" name="empresa" value="{{$user->empresa}}">
                        <input type="hidden" name="trabalhador">
                       
                        <div class="col-md-6">
                            <label for="nome__completo" class="form-label ">Nome Completo</label>
                            <input type="text" class="form-control input @error('nome__completo') is-invalid @enderror  fw-bold text-dark" value="{{old('nome__completo')}}" name="nome__completo"  id="nome__completo">
                            @error('nome__completo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nome__fantasia" class="form-label">Nome Fantasia</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('nome__fantasia') is-invalid @enderror" name="nome__fantasia" value="{{old('nome__fantasia')}}" id="nome__fantasia">
                            @error('nome__fantasia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('cnpj') is-invalid @enderror" name="cnpj" value="{{old('cnpj')}}" id="cnpj">
                            @error('cnpj')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select id="tipo" name="tipo" class="form-select fw-bold text-dark">
                            <option selected >1</option>
                            <option >2</option>
                            <option >3</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="matricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" id="matricula">
                            @error('matricula')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="simples" class="form-label">Simples</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('simples') is-invalid @enderror" name="simples" value="{{old('simples')}}" id="simples">
                            @error('simples')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('telefone') is-invalid @enderror" name="telefone" value="{{old('telefone')}}" id="telefone">
                            @error('telefone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        
                       
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Endereço <i class="fad fa-map-marked-alt"></i></h1>

                        <div class="col-md-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('cep') is-invalid @enderror" name="cep" value="{{old('cep')}}"   id="cep">
                            @error('cep')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-md-7">
                            <label for="logradouro" class="form-label">Rua</label>
                            <input type="text" class="form-control input fw-bold text-dark  @error('logradouro') is-invalid @enderror" name="logradouro" value="{{old('logradouro')}}" id="logradouro">
                            @error('logradouro')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('numero') is-invalid @enderror" name="numero" value="{{old('numero')}}" id="numero">
                            @error('numero')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4"> 
                                <label for="complemento__endereco" class="form-label">Tipo da construção</label>
                                <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold text-dark">
                                <option selected >Casa</option>
                                <option >Apartamento</option>
                                <option >Empresa</option>
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('bairro') is-invalid @enderror" name="bairro" value="{{old('bairro')}}" id="bairro">
                            @error('bairro')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="localidade" class="form-label">Municipio</label>
                            <input type="text" class="form-control input fw-bold text-dark  @error('localidade') is-invalid @enderror" name="localidade" value="{{old('localidade')}}" id="localidade">
                            @error('localidade')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('uf') is-invalid @enderror" name="uf" value="{{old('uf')}}" id="uf">
                            @error('uf')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-md-5 d-none">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="complemento__endereco" value="" id="complemento">
                        </div> -->

                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Tomador Taxas <i class="fad fa-badge-percent"></i></h1>


                        <div class="col-md-3">
                            <label for="taxa_adm" class="form-label">Taxa Adm %</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('taxa_adm') is-invalid @enderror" name="taxa_adm" value="{{old('taxa_adm')}}" id="taxa_adm">
                            @error('taxa_adm')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-md-3 d-none">
                            <label for="caixa_benef" class="form-label">Caixa benef. %</label>
                            <input type="text" class="form-control  input fw-bold text-dark " name="caixa_benef" value="" id="caixa_benef">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="ferias" class="form-label">Férias 1,00 %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="ferias" value="" id="ferias">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="13_salario" class="form-label">13º Salário 0,66 %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="13_salario" value="" id="13_salario">
                        </div> -->

                        <div class="col-md-3">
                            <label for="taxa__fed" class="form-label">Taxa Fed. %</label>
                            <input type="text" class="form-control input fw-bold text-dark  @error('taxa__fed') is-invalid @enderror" name="taxa__fed" value="{{old('taxa__fed')}}" id="taxa__fed">
                            @error('taxa__fed')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="deflator" class="form-label">% DEFLATOR</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('deflator') is-invalid @enderror" name="deflator" value="{{old('deflator')}}" id="deflator">
                            @error('deflator')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="das" class="form-label">DAS %</label>
                            <input type="text" class="form-control @error('das') is-invalid @enderror input fw-bold text-dark" name="das" value="{{old('das')}}" id="das">
                            @error('das')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <h1 class="container text-center  fs-4 fw-bold">Trabalhador</h1> -->


                        <!-- <div class="col-md-3 d-none">
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
                        </div> -->

                        <!-- <div class="col-md-3">
                            <label for="das" class="form-label">DAS %</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="das" value="" id="das">
                        </div> -->


                        <h1 class="container text-center mt-4 mb-3   fs-4 fw-bold">Parametros SEFIP <i class="fad fa-chart-bar"></i></h1>


                        <div class="col-md-3">
                            <label for="cod__fpas" class="form-label">Cod FPAS</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('cod__fpas') is-invalid @enderror " name="cod__fpas" value="{{old('cod__fpas')}}" id="cod__fpas">
                            @error('cod__fpas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-md-3">
                            <label for="cod__fap" class="form-label">Cod FAP</label>
                            <input type="text" class="form-control input fw-bold text-dark @error('') is-invalid @enderror " name="cod__fap" value="" id="cod__fap">
                            @error('cod__fap')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="cod__grps" class="form-label">Cod GRPS</label>
                            <input type="text" class="form-control @error('cod__grps') is-invalid @enderror input fw-bold text-dark" name="cod__grps" value="{{old('cod__grps')}}" id="cod__grps">
                            @error('cod__grps')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="cod__recol" class="form-label">Cod Recol</label>
                            <input type="text" class="form-control @error('cod__recol') is-invalid @enderror input fw-bold text-dark" name="cod__recol" value="{{old('cod__recol')}}" id="cod__recol">
                            @error('cod__recol')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="cnae" class="form-label">CNAE</label>
                            <input type="text" class="form-control @error('cnae') is-invalid @enderror input fw-bold text-dark" name="cnae" value="{{old('cnae')}}" id="cnae">
                            @error('cnae')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="fap__aliquota" class="form-label">FAP Aliquota %</label>
                            <input type="text" class="form-control @error('fap__aliquota') is-invalid @enderror input fw-bold text-dark" name="fap__aliquota" value="{{old('fap__aliquota')}}" id="fap__aliquota">
                            @error('fap__aliquota')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="rat__ajustado" class="form-label">RAT Ajustado %</label>
                            <input type="text" class="form-control @error('rat__ajustado') is-invalid @enderror input fw-bold text-dark" name="rat__ajustado" value="{{old('rat__ajustado')}}" id="rat__ajustado">
                            @error('rat__ajustado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="fpas__terceiros" class="form-label">FPAS Terceiros</label>
                            <input type="text" class="form-control @error('fpas__terceiros') is-invalid @enderror input fw-bold text-dark" name="fpas__terceiros" value="{{old('fpas__terceiros')}}" id="fpas__terceiros">
                            @error('fpas__terceiros')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="aliq__terceiros" class="form-label">Aliq. Terceiros</label>
                            <input type="text" class="form-control @error('aliq__terceiros') is-invalid @enderror input fw-bold text-dark" name="aliq__terceiros" value="{{old('aliq__terceiros')}}" id="aliq__terceiros">
                            @error('aliq__terceiros')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-md-3 d-none">
                            <label for="esocial" class="form-label">E-SOCIAL Nº</label>
                            <input type="text" class="form-control  input fw-bold text-dark" name="esocial" id="esocial">
                        </div> -->

                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Incide Sobre Fatura <i class="fad fa-chart-line"></i></h1>


                        <div class="col-md-2">
                            <label for="alimentacao" class="form-label"> Alimentação</label>
                            <input type="text" class="form-control @error('alimentacao') is-invalid @enderror input fw-bold text-dark" name="alimentacao" value="{{old('alimentacao')}}" id="alimentacao">
                            @error('alimentacao')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="transporte" class="form-label">Transporte</label>
                            <input type="text" class="form-control @error('transporte') is-invalid @enderror input fw-bold text-dark" name="transporte" value="{{old('transporte')}}" id="transporte">
                            @error('transporte')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="epi" class="form-label">EPI % (Sobre(PROD+RSR)Folha)</label>
                            <input type="text" class="form-control @error('epi') is-invalid @enderror input fw-bold text-dark" name="epi" value="{{old('epi')}}" id="epi">
                            @error('epi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="seguro__trabalhador" class="form-label">Seguro (Val.Trab)</label>
                            <input type="text" class="form-control @error('seguro__trabalhador') is-invalid @enderror input fw-bold text-dark" name="seguro__trabalhador" value="{{old('seguro__trabalhador')}}" id="seguro__trabalhador">
                            @error('seguro__trabalhador')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- <div class="col-md-4 d-none">
                            <label for="indice__folha" class="form-label">Indíce sobre Folha ( 1 Paga - 2 Desconta )</label>
                            <input type="text" class="form-control  input fw-bold text-dark" name="indice__folha"  id="indice__folha">
                        </div> -->

                        <!-- <div class="col-md-2 d-none">
                            <label for="valor__transporte" class="form-label">Valor Vale Transporte</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="valor__transporte"  id="valor__transporte">
                        </div>

                        <div class="col-md-3 d-none">
                            <label for="valor__alimentacao" class="form-label">Valor Vale Alimentação</label>
                            <input type="text" class="form-control input fw-bold text-dark" name="valor__alimentacao"  id="valor__alimentacao">
                        </div> -->
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Incide sobre a folha <i class="fad fa-chart-line"></i></h1>


                        <div class="col-md-3">
                            <label for="folhartransporte" class="form-label">VT Transporte</label>
                            <input type="text" class="form-control @error('folhartransporte') is-invalid @enderror input fw-bold text-dark" name="folhartransporte" value="{{old('folhartransporte')}}" id="folhartransporte">
                            @error('folhartransporte')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                            <input type="text" class="form-control @error('folharalim') is-invalid @enderror input fw-bold text-dark" name="folharalim" value="{{old('folharalim')}}" id="folharalim">
                            @error('folharalim')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                        <label for="folhartipoalim" class="form-label">Tipo</label>
                        <select class="form-select fw-bold text-dark" id="folhartipoalim" name="folhartipoalim" aria-label="Default select example">
                            <option  selected>1</option>
                            <option>2</option>
                        </select>
                        </div>
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Informação para o Cartão Ponto <i class="fad fa-clock"></i></h1>

                        <div class="col-md-4">
                            <label for="dias_uteis" class="form-label">Dias Úteis</label>
                            <input type="time" class="form-control @error('dias_uteis') is-invalid @enderror input fw-bold text-dark" name="dias_uteis" value="{{old('dias_uteis')}}" id="dias_uteis">
                            @error('dias_uteis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="sabados" class="form-label">Sábados</label>
                            <input type="time" class="form-control @error('sabados') is-invalid @enderror input fw-bold text-dark" name="sabados" value="{{old('sabados')}}" id="sabados">
                            @error('sabados')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="domingos" class="form-label">Domingos</label>
                            <input type="time" class="form-control @error('domingos') is-invalid @enderror input fw-bold text-dark" name="domingos" value="{{old('domingos')}}" id="domingos">
                            @error('domingos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Retenções na Fatura <i class="fad fa-calculator"></i></h1>


                        <div class="col-md-3">
                            <label for="inss__empresa" class="form-label">INSS Empresa %</label>
                            <input type="text" class="form-control @error('inss__empresa') is-invalid @enderror input fw-bold text-dark" name="inss__empresa" value="{{old('inss__empresa')}}" id="inss__empresa">
                            @error('inss__empresa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                        <label for="retencaoinss" class="form-label">Retenção INSS</label>
                        <select class="form-select fw-bold text-dark" id="retencaoinss" name="retencaoinss" aria-label="Default select example">
                            <option  selected>SIM</option>
                            <option>NÃO</option>
                        </select>
                        </div>
                        <div class="col-md-3">
                            <label for="fgts__empresa" class="form-label">FGTS Empresa %</label>
                            <input type="text" class="form-control @error('fgts__empresa') is-invalid @enderror input fw-bold text-dark" name="fgts__empresa" value="{{old('fgts__empresa')}}" id="fgts__empresa">
                            @error('fgts__empresa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
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
                        <h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Dados Bancários <i class="fad fa-university"></i></h1>
                        <!-- <div class="col-md-6 d-none">
                            <label for="nome__conta" class="form-label">Nome do Titular</label>
                            <input type="text" class="form-control  input fw-bold text-dark" name="nome__conta"  id="nome__conta">
                        </div> -->

                        <div class="col-md-3">
                            <label for="banco" class="form-label">Banco</label>
                            <input type="text" class="form-control @error('banco') is-invalid @enderror input fw-bold text-dark "  aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="{{old('banco')}}" id="banco">
                            <div id="menssagem-banco" class="valid-feedback">
                               
                            </div>
                            @error('banco')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="agencia" class="form-label">Agência</label>
                            <input type="text" class="form-control @error('agencia') is-invalid @enderror input fw-bold text-dark" name="agencia" value="{{old('agencia')}}" id="agencia">
                            @error('agencia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="operacao" class="form-label">Operação</label>
                            <input type="text" class="form-control @error('operacao') is-invalid @enderror input fw-bold text-dark" name="operacao" value="{{old('operacao')}}" id="operacao">
                            @error('aperacao')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="conta" class="form-label">Conta</label>
                            <input type="text" class="form-control @error('conta') is-invalid @enderror input fw-bold text-dark" name="conta" value="{{old('conta')}}" id="conta">
                            @error('conta')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="pix" class="form-label">PIX</label>
                            <input type="text" class="form-control @error('pix') is-invalid @enderror input fw-bold text-dark" name="pix" value="{{old('pix')}}" id="pix">
                            @error('pix')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                                    <div class="modal-header modal__delete">
                                        <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body modal-delbody">
                                            <p class="mb-1">Deseja realmente excluir?</p>
                                    </div>
                                    <div class="modal-footer modal-delfooter">
                                        <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn__deletar">Deletar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                 </div>
                 
                 
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header modal__delete">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Competência</h5>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="{{route('trabalhador.comprovante.dia')}}" method="post">
                          @csrf
                          <input type="hidden" name="trabalhador" id="trabalhador">
                         
                          <div class="modal-body modal-delbody">
                            <div class="mb-3 bg-dark p-2 rounded">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                  <label class="form-check-label mt-1" for="inlineCheckbox1">Boletins</label>
                                </div>
                                <div class="form-check form-check-inline d-none">
                                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                  <label class="form-check-label mt-1" for="inlineCheckbox2"></label>
                                </div>
                                <div class="form-check d-none form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                  <label class="form-check-label mt-1" for="inlineCheckbox3">3 (disabled)</label>
                                </div>
                            </div>
                              
                             <div class="d-flex">
                                <div class="col-md-5 input">
                                  <label for="ano" class="form-label">Data Inicial</label>
                                  <input type="date" class="form-control " name="ano_inicial" value="" id="tano">
                                </div>
                                
                                <div class="col-md-5 input ms-3">
                                  <label for="ano" class="form-label">Data Final</label>
                                  <input type="date" class="form-control " name="ano_final" value="" id="tano">
                                </div>
                            </div>

                          </div>
                          <div class="modal-footer modal-delfooter">
                            <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn__deletar"><i class="fas fa-print"></i> Imprimir</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
<script>
        $(document).ready(function(){
           
            $('#pesquisa').on('keyup focus',function(){
                var dados = '0';
                if ($(this).val()) {
                    dados = $(this).val();
                    if (dados.indexOf('  ') !== -1) {
                        dados = monta_dados(dados);
                    }
                }
                $.ajax({
                    url: "{{url('tomador')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json', 
                    success: function(data) {
                        let nome = ''
                        if (data.length >= 1) {
                            data.forEach(element => {
                            nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            nome += `<option value="${element.tscnpj}">`
                            });
                            $('#datalistOptions').html(nome)
                        } 
                        if(data.length === 1 && dados.length >= 2){
                            tomador(dados)
                        }else if (dados.length === 14) {
                            pesquisa(dados)
                        }else{
                            campo()
                        }         
                     }
                });
            })
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function tomador(dados) {
                $('#carregamento').removeClass('d-none')
                $.ajax({
                    url: "{{url('tomador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json', 
                    success: function(data) {
                        carregado(data)
                        $('#carregamento').addClass('d-none')
                    }
                })
            }
            function campo() {
                $('#carregamento').addClass('d-none')
                $('#form').attr('action', "{{ route('tomador.store') }}");
                $('#incluir').removeAttr( "disabled" )
                $('#atualizar').attr('disabled','disabled')
                $('#deletar').attr('disabled','disabled')
                $('#method').val(' ')
                $('#excluir').attr( "disabled",'disabled' )
                $('#tabelapreco').addClass('disabled').removeAttr('href')
                for (let index = 0; index < $('.input').length; index++) {
                   $('.input').eq(index).val(' ')
                }
            }
            function carregado(data) {
                if (data.id) {
                    $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
                    $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador)
                    $('#incluir').attr('disabled','disabled')
                    $('#atualizar').removeAttr( "disabled" )
                    $('#deletar').removeAttr( "disabled" )
                    $('#excluir').removeAttr( "disabled" )
                    $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/ /"+data.tomador)
                    $('#method').val('PUT')
                
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
                $('#deflator').val(data.tfdefaltor)
                $('#endereco').val(data.eiid)
                $('#bancario').val(data.biid)
                for (let index = 0; index <  $('#tipo option').length; index++) {  
                    if (data.tstipo == $('#tipo option').eq(index).text()) {
                        
                        $('#tipo option').eq(index).attr('selected','selected')
                    }else  {
                        $('#tipo option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#complemento__endereco option').length; index++) {  
                    if (data.estipo == $('#complemento__endereco option').eq(index).text()) {
                        
                        $('#complemento__endereco option').eq(index).attr('selected','selected')
                    }else  {
                        $('#complemento__endereco option').eq(index).removeAttr('selected')
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