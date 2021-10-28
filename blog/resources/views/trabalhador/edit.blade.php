@extends('layouts.index')
@section('conteine')
    <main class="container ">
        <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Identificação do Trabalhador</div>
          @if(isset($msg))
            @if($msg['status'])
            <div class="alert alert-success d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
              <div>
              {{$msg['mendagem']}}
              </div>
            </div>
            @else
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
              {{$msg['mendagem']}}
              </div>
            </div>
            @endif
          @endif
        <form class="row g-3" action="{{ route('trabalhador.update') }}"  method="POST" >
        <div class="container mt-5 ">
            <div class="btn  " role="group" aria-label="Basic example">
            <button type="submit" class="btn btn-primary">Incluir</button>
                <a class="btn btn btn-outline-dark" href="{{ route('trabalhador.index') }}" role="button">Consultar</a>
                <a class="btn btn btn-outline-dark" href="#" role="button">Dependentes</a>
                <a class="btn btn btn-outline-dark" href="#" role="button">Sair</a>
            </div>
        </div>
        @csrf
        @method('put')
        <input type="hidden"  name="deflator" >
        <input type="hidden"  name="tomador" >
            <div class="col-md-6">
              <label for="nome__completo" class="form-label">Nome Completo</label>
              <input type="text" class="form-control" name="nome__completo" id="nome__completo" value="">
            </div>

            <div class="col-md-2">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" class="form-control cpf-mask" name="cpf" id="cpf" maxlength="15"  value="">
            </div>

            <div class="col-md-2">
              <label for="matricula" class="form-label">Matrícula</label>
              <input type="text" class="form-control" name="matricula" id="matricula" value="">
            </div>

            <div class="col-md-2">
              <label for="pis" class="form-label">PIS</label>
              <input type="text" class="form-control" name="pis" id="pis" value="">
            </div>


            <div class="col-md-2">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" name="sexo" class="form-select" value="">
                  <option selected>Masculino</option>
                  <option>Feminino</option>
                  <option>Outro</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label for="estado__civil" class="form-label">Estado Civil</label>
                <select id="estado__civil" name="estado__civil" class="form-select" value="">
                  <option selected>Solteiro</option>
                  <option>Casado</option>
                  <option>Separados</option>
                  <option>Divorciados</option>
                  <option>viúvo</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="raca" class="form-label">Raça</label>
                <select id="raca" name="raca" class="form-select" value="">
                  <option selected>Preto</option>
                  <option>Pardo</option>
                  <option>Branco</option>
                  <option>Indígena</option>
                  <option>Amarela</option>
                  <option>Não informado</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="grau__instrucao" class="form-label">Grau de Instrução</label>
                <select id="grau__instrucao" name="grau__instrucao" class="form-select" value="">
                  <option selected>Superior Completo</option>
                  <option>Superior incompleto</option>
                  <option>Ensino Médio Completo</option>
                  <option>Ensino Médio Incompleto</option>
                  <option>Ensino Fundamental Completo</option>
                  <option>Ensino Fundamental Incompleto</option>
                  <option>Lê e Escreve</option>
                  <option>Analfabetos</option>
                </select>
            </div>


            <div class="col-md-3">
              <label for="data_nascimento" class="form-label">Data de Nascimento</label>
              <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="">
            </div>


            <div class="col-md-3">
              <label for="pais__nascimento" class="form-label">País de Nascimento</label>
              <input type="text" class="form-control" name="pais__nascimento" id="pais__nascimento" value="">
            </div>

            <div class="col-md-3">
                <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
                <input type="text" class="form-control" name="pais__nacionalidade" id="pais__nacionalidade" value="">
            </div>

            <div class="col-md-6">
              <label for="nome__mae" class="form-label">Nome da Mãe</label>
              <input type="text" class="form-control" name="nome__mae" id="nome__mae" value="">
            </div>

            <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Local de Residência</div>

            <div class="col-md-2">
              <label for="cep" class="form-label">Cep</label>
              <input type="text" class="form-control" name="cep" id="cep" value="">
            </div>

            

            <div class="col-md-6">
                <label for="logradouro" class="form-label">Rua</label>
                <input type="text" class="form-control" name="logradouro" id="logradouro" value="">
            </div>

            <div class="col-md-1">
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control" name="numero" id="numero" value="">
                
            </div>

            <div class="col-md-2">
              <label for="tipo" class="form-label">Tipo</label>
              <input type="text" class="form-control" name="tipo__endereco" id="tipo" value="">
          </div>


            <div class="col-md-5">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" id="bairro" value="">
            </div>

            
            <div class="col-md-5">
                <label for="localidade" class="form-label">Municipio</label>
                <input type="text" class="form-control" name="localidade" id="localidade" value="">
            </div>

            <div class="col-md-1">
              <label for="uf" class="form-label">UF</label>
              <input type="text" class="form-control" name="uf" id="uf" value="">
            </div>

            <div class="col-md-4">
              <label for="complemento" class="form-label">Complemento</label>
              <input type="text" class="form-control" name="complemento__endereco" id="complemento" value="">
            </div>

            <div class="col-md-2">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="text" class="form-control" name="telefone" id="telefone" value="">
            </div>

            <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Contrato de Trabalho</div>

            <div class="col-md-3">
              <label for="data__admissao" class="form-label">Data de Admissão</label>
              <input type="date" class="form-control" name="data__admissao" id="data__admissao" value="">
            </div>

            <div class="col-md-1">
              <label for="categoria" class="form-label">Categoria</label>
              <input type="text" class="form-control" name="categoria__contrato" id="categoria" value="">
            </div>

            <div class="col-md-1">
              <label for="cbo" class="form-label">CBO</label>
              <input type="text" class="form-control" name="cbo" id="cbo" value="">
            </div>

            <div class="col-md-1">
              <label for="irrf" class="form-label">IRRF</label>
              <input type="text" class="form-control" name="irrf" id="irrf" value="">
            </div>

            <div class="col-md-1">
              <label for="sf" class="form-label">SF</label>
              <input type="text" class="form-control" name="sf" id="sf" value="">
            </div>

            <div class="col-md-2">
              <label for="ctps" class="form-label">CTPS</label>
              <input type="text" class="form-control" name="ctps" id="ctps" value="">
            </div>

            <div class="col-md-1">
              <label for="serie__ctps" class="form-label">Série</label>
              <input type="text" class="form-control" name="serie__ctps" id="serie__ctps" value="">
            </div>

            <div class="col-md-1">
              <label for="uf__ctps" class="form-label">UF</label>
              <input type="text" class="form-control" name="uf__ctps" id="uf__ctps" value="">
            </div>

            <div class="col-md-4">
              <label for="situacao__contrato" class="form-label">Situação</label>
              <input type="text" class="form-control" name="situacao__contrato" id="situacao__contrato" value="">
            </div>

            <div class="col-md-4">
              <label for="data__afastamento" class="form-label">Data de Afastamento</label>
              <input type="date" class="form-control" name="data__afastamento" id="data__afastamento" value="">
            </div>
            
            
            <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Dados Bancários do Trabalhador</div>
            
            <div class="col-md-6">
              <label for="nome__conta" class="form-label">Nome do Titular</label>
              <input type="text" class="form-control" name="nome__conta" id="nome__conta" value="">
            </div>

            <div class="col-md-2">
              <label for="banco" class="form-label">Banco</label>
              <input type="text" class="form-control" name="banco" id="banco" value="">
            </div>

            <div class="col-md-2">
              <label for="agencia" class="form-label">Agência</label>
              <input type="text" class="form-control" name="agencia" id="agencia" value="">
            </div>

            <div class="col-md-2">
              <label for="operacao" class="form-label">Operação</label>
              <input type="text" class="form-control" name="operacao" id="operacao" value="">
            </div>

            <div class="col-md-2">
              <label for="conta" class="form-label">Conta</label>
              <input type="text" class="form-control" name="conta" id="conta" value="">
            </div>

            <div class="col-md-2">
              <label for="pix" class="form-label">PIX</label>
              <input type="text" class="form-control" name="pix" id="pix" value="">
            </div>
 
        </main>
@stop