@extends('layouts.index')
@section('conteine')

    <div class="container " >
    
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
        
        <form class="row g-3" id="form" action="{{ route('trabalhador.store') }}" enctype="multipart/form-data"  method="POST">
        
        <div class="btn mt-5 " role="group" aria-label="Basic example">
            <button type="submit" id="incluir" class="btn botao text-white">Incluir</button>
            <button type="submit" id="atualizar" disabled class="btn botao">Atualizar</button>
            <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Excluir
                      </button>
                      
                <!-- <a class="btn btn btn-primary" href="{{ route('trabalhador.index') }}" role="button">Consultar</a> -->
                <a class="btn botao disabled"  id="depedente" role="button">Dependentes</a>
                <a class="btn botao disabled"  id="fichaepi" role="button">Epi</a>
                <a class="btn botao disabled"  id="imprimir" role="button">Imprimir</a>
                <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
        </div>
        
        
        <div class="col-md-6 mt-5 mb-4">
                            <label for="exampleDataList" class="form-label">Buscar</label>
                            <input class="pesquisa form-control" list="datalistOptions" name="pesquisa" id="pesquisa">
                            <datalist id="datalistOptions">
                                <!-- <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago"> -->
                            </datalist>
                        </div>
        <div class="container text-center mt-4 mb-3   fs-4 fw-bold">Identificação do Trabalhador</div>
        @csrf
        <input type="hidden" id="method" name="_method" value="">
        <input type="hidden"  name="deflator" >
        <input type="hidden"  name="tomador" >
        <!-- <input type="hidden" name="empresa">  -->
        <input type="hidden" name="empresa" value="{{$user->empresa}}">
        
        <div>
            <div class="col-md-5">
                <img class="trabfoto" id="trabfoto" src="" alt="foto do trabalhador">
            </div>
        </div>
        
        <div>
            <div class="mb-3 col-md-5">
              <label for="formFileSm " class="form-label">Foto do Trabalhador</label>
              <input class="form-control form-control-sm"   onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
            </div>
        </div>

        <input type="hidden" name="foto" id="foto">
            <div class="col-md-6">
              <label for="nome__completo" class="form-label">Nome Completo</label>
              <input type="text" class="form-control" name="nome__completo" id="nome__completo" >
            </div>
            
            <div class="col-md-6">
              <label for="nome__social" class="form-label">Nome Social</label>
              <input type="text" class="form-control" name="nome__social" id="nome__social" >
            </div>

            <div class="col-md-2">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" class="form-control cpf-mask" name="cpf" id="cpf" maxlength="15"  >
            </div>

            <div class="col-md-2">
              <label for="matricula" class="form-label">Matrícula</label>
              <input type="text" class="form-control" name="matricula" id="matricula" >
            </div>

            <div class="col-md-2">
              <label for="pis" class="form-label">PIS</label>
              <input type="text" class="form-control" name="pis" id="pis" >
            </div>


            <div class="col-md-2">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" name="sexo" class="form-select" >
                  <option selected>Masculino</option>
                  <option>Feminino</option>
                  <option >Outro</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label for="estado__civil" class="form-label">Estado Civil</label>
                <select id="estado__civil" name="estado__civil" class="form-select" >
                  <option selected>Solteiro</option>
                  <option>Casado</option>
                  <option>Separados</option>
                  <option>Divorciados</option>
                  <option>viúvo</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="raca" class="form-label">Raça</label>
                <select id="raca" name="raca" class="form-select">
                  <option selected>Negro</option>
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
              <input type="date" class="form-control" name="data_nascimento"  id="data_nascimento" >
            </div>


            <div class="col-md-3">
              <label for="pais__nascimento" class="form-label">País de Nascimento</label>
              <input type="text" class="form-control" name="pais__nascimento" id="pais__nascimento" >
            </div>

            <div class="col-md-3">
                <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
                <input type="text" class="form-control" name="pais__nacionalidade" id="pais__nacionalidade" >
            </div>

            <div class="col-md-6">
              <label for="nome__mae" class="form-label">Nome da Mãe</label>
              <input type="text" class="form-control" name="nome__mae" id="nome__mae" >
            </div>

            <div class="container text-center  fs-4 fw-bold mt-4 mb-3">Local de Residência</div>

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

            <div class="col-md-2 d-none">
              <label for="tipo" class="form-label">Tipo</label>
              <input type="text" class="form-control" name="tipo__endereco" id="tipo" value="">
          </div>
          <div class="col-md-3"> 
                  <label for="tipoconstrucao" class="form-label">Tipo da construção</label>
                  <select name="complemento__endereco" id="complemento__endereco" class="form-select">
                  <option selected >Casa</option>
                  <option >Apartamento</option>
              </select>
          </div>


            <div class="col-md-6">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" id="bairro" value="">
            </div>

            
            <div class="col-md-6">
                <label for="localidade" class="form-label">Municipio</label>
                <input type="text" class="form-control" name="localidade" id="localidade" value="">
            </div>

            <div class="col-md-1">
              <label for="uf" class="form-label">UF</label>
              <input type="text" class="form-control" name="uf" id="uf" value="">
            </div>
            <div class="col-md-2">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="text" class="form-control" name="telefone" id="telefone" value="">
            </div>

            <div class="container text-center mt-4 mb-3 fs-4 fw-bold">Contrato de Trabalho</div>

            <div class="col-md-3">
              <label for="data__admissao" class="form-label">Data de Admissão</label>
              <input type="date" class="form-control" name="data__admissao" id="data__admissao" value="">
            </div>

            <div class="col-md-1">
              <label for="categoria" class="form-label">Categoria</label>
              <input type="text" class="form-control" name="categoria__contrato" id="categoria" value="">
            </div>

            <div class="col-md-2">
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
            
            
            <div class="container text-center mt-4 mb-3 fs-4 fw-bold">Dados Bancários do Trabalhador</div>


            <div class="col-md-3 mb-5">
              <label for="banco" class="form-label">Banco</label>
              <input type="text" class="form-control" name="banco" id="banco" value="">
            </div>

            <div class="col-md-2 mb-5">
              <label for="agencia" class="form-label">Agência</label>
              <input type="text" class="form-control" name="agencia" id="agencia" value="">
            </div>

            <div class="col-md-2 mb-5">
              <label for="operacao" class="form-label">Operação</label>
              <input type="text" class="form-control" name="operacao" id="operacao" value="">
            </div>

            <div class="col-md-2 mb-5">
              <label for="conta" class="form-label">Conta</label>
              <input type="text" class="form-control" name="conta" id="conta" value="">
            </div>

            <div class="col-md-3 mb-5">
              <label for="pix" class="form-label">PIX</label>
              <input type="text" class="form-control" name="pix" id="pix" value="">
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
                                        
                                        <p class="text-black">Obs: Caso exclua os dados do trabalhador seus depedentes seram excluidor?</p>
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
         function encodeImageFileAsURL(element) {
            var file = element.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
              $('#foto').val(reader.result)
              $('#trabfoto').attr('src',reader.result)
            }
            reader.readAsDataURL(file);
          }
        $(document).ready(function(){
          
            $( ".pesquisa" ).keyup(function() {
                var dados = $(this).val();
                $.ajax({
                    url: "{{url('trabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#datalistOptions').prepend(`<option value="${data.tsnome}">`)
                        if (data.trabalhador) {
                            $('#form').attr('action', "{{ url('trabalhador')}}/"+data.trabalhador);
                            $('#formdelete').attr('action',"{{ url('trabalhador')}}/"+data.trabalhador)
                            $('#depedente').removeClass('disabled')
                            $('#depedente').attr('href',"{{ url('depedente')}}/"+data.trabalhador+'/mostrar')
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            $('#deletar').removeAttr( "disabled" )
                            $('#excluir').removeAttr( "disabled" )
                            $('#method').val('PUT')
                            $('#imprimir').removeClass('disabled').attr('href',"{{url('ficharegitrotrab')}}/"+data.trabalhador)
                            $('#fichaepi').removeClass('disabled').attr('href',"{{url('fichaepitrab')}}/"+data.trabalhador)
                        }else{
                          $('#imprimir').addClass('disabled')
                          $('#fichaepi').addClass('disabled')
                          $('#depedente').addClass('disabled')
                            $('#form').attr('action', "{{ route('trabalhador.store') }}");
                            $('#incluir').removeAttr( "disabled" )
                            $('#depedente').removeAttr( "disabled" )
                            $('#atualizar').attr('disabled','disabled')
                            $('#deletar').attr('disabled','disabled')
                            $('#method').val(' ')
                            $('#excluir').attr('disabled','disabled')
                        }
                        $('#nome__completo').val(data.tsnome)
                        $('#foto').val(data.tsfoto)
                        $('#trabfoto').attr('src',data.tsfoto)
                        $('#cpf').val(data.tscpf)
                        $('#matricula').val(data.tsmatricula)
                        $('#pis').val(data.dspis)
                        $('#data_nascimento').val(data.nsnascimento)
                        $('#telefone').val(data.tstelefone)
                        $('#pais__nascimento').val(data.nsnaturalidade)
                        $('#pais__nacionalidade').val(data.nsnacionalidade)
                        $('#nome__mae').val(data.tsmae)
                        $('#cep').val(data.escep)
                        $('#logradouro').val(data.eslogradouro)
                        $('#uf').val(data.esuf)
                        $('#numero').val(data.esnum)
                        $('#complemento').val(data.escomplemento)
                        $('#bairro').val(data.esbairro)
                        $('#localidade').val(data.esmunicipio)
                        $('#uf').val(data.esuf)
                        $('#data__admissao').val(data.csadmissao)
                        $('#categoria').val(data.cscategoria)
                        $('#cbo').val(data.cbo)
                        $('#irrf').val(data.csirrf)
                        $('#sf').val(data.cssf)
                        $('#ctps').val(data.dsctps)
                        $('#serie__ctps').val(data.dsserie)
                        $('#uf__ctps').val(data.dsuf)
                        $('#situacao__contrato').val(data.cssituacao)
                        $('#data__afastamento').val(data.csafastamento)
                        $('#nome__conta').val(data.bstitular)
                        $('#banco').val(data.bsbanco)
                        $('#agencia').val(data.bsagencia)
                        $('#operacao').val(data.bsoperacao)
                        $('#conta').val(data.bsconta)
                        $('#pix').val(data.bspix)
                        $('#bsdefaltor').val(data.deflator)
                        $('#endereco').val(data.eiid)
                        $('#bancario').val(data.biid)
                        for (let index = 0; index <  $('#sexo option').length; index++) {  
                          if (data.tssexo == $('#sexo option').eq(index).text()) {
                            $('#sexo option').eq(index).attr('selected','selected')
                          }else  {
                            $('#sexo option').eq(index).removeAttr('selected')
                          }
                        }
                        for (let index = 0; index <  $('#complemento__endereco option').length; index++) {  
                          if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {
                            $('#complemento__endereco option').eq(index).attr('selected','selected')
                          }else  {
                            $('#complemento__endereco option').eq(index).removeAttr('selected')
                          }
                        }
                        for (let index = 0; index <  $('#estado__civil option').length; index++) {  
                          if (data.nscivil === $('#estado__civil option').eq(index).text()) {
                            $('#estado__civil option').eq(index).attr('selected','selected')
                          }else{
                            $('#estado__civil option').eq(index).removeAttr('selected')
                          }
                        }
                        for (let index = 0; index <  $('#raca option').length; index++) {  
                          if (data.nsraca === $('#raca option').eq(index).text()) {
                            $('#raca option').eq(index).attr('selected','selected')
                          }else{
                            $('#raca option').eq(index).removeAttr('selected')
                          }
                        }
                        for (let index = 0; index <  $('#grau__instrucao option').length; index++) {  
                          if (data.tsescolaridade === $('#grau__instrucao option').eq(index).text()) {
                            $('#grau__instrucao option').eq(index).attr('selected','selected')
                          }else{
                            $('#grau__instrucao option').eq(index).removeAttr('selected')
                          }
                        }
                    }
                });
            });
        });
    </script>
@stop