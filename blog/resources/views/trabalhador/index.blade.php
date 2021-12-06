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
        
        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
            <button type="submit" id="incluir" class="btn botao">Incluir</button>
            <button type="submit" id="atualizar" disabled class="btn botao">Atualizar</button>
            <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Excluir
                      </button>
                      
                <!-- <a class="btn btn btn-primary" href="{{ route('trabalhador.index') }}" role="button">Consultar</a> -->
                
                <button class="btn botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Relatórios
                 </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="imprimir" role="button">Ficha de Registro</a></li>
                    <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="fichaepi" role="button">Ficha de EPI</a></li>
                    <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="empresas__trab" role="button">Empresas Trabalhadas</a></li>
                  </ul>
                <a class="btn botao disabled"  id="depedente" role="button">Dependentes</a>
                <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
        </div>
        
        <div class="text-center d-none">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Carregando...</span>
          </div>
        </div>
        
        
        <div class="col-md-6 mt-5 mb-4">
            <label for="exampleDataList" class="form-label">Buscar</label>
            <input class="pesquisa form-control fw-bold text-dark" list="datalistOptions" name="pesquisa" id="pesquisa">
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
            <div class="col-md-6">
                <img class="logfoto" id="trabfoto" src="" alt="foto do trabalhador">
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
              <input type="text" class="form-control fw-bold text-dark" name="nome__completo" id="nome__completo" >
            </div>
            
            <div class="col-md-6">
              <label for="nome__social" class="form-label">Nome Social (OPICIONAL)</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="30" name="nome__social" id="nome__social" >
            </div>

            <div class="col-md-2">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" class="form-control fw-bold text-dark cpf-mask" name="cpf" id="cpf" maxlength="15"  >
            </div>

            <div class="col-md-2">
              <label for="matricula" class="form-label">Matrícula</label>
              <input type="text" class="form-control fw-bold text-dark" name="matricula" id="matricula" >
            </div>

            <div class="col-md-2">
              <label for="pis" class="form-label">PIS</label>
              <input type="text" class="form-control fw-bold text-dark" name="pis" id="pis" >
            </div>


            <div class="col-md-2">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" name="sexo" class="form-select fw-bold text-dark" >
                  <option selected>Masculino</option>
                  <option>Feminino</option>
                  <option >Outro</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label for="estado__civil" class="form-label">Estado Civil</label>
                <select id="estado__civil" name="estado__civil" class="form-select fw-bold text-dark" >
                  <option selected>Solteiro</option>
                  <option>Casado</option>
                  <option>Separados</option>
                  <option>Divorciados</option>
                  <option>viúvo</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="raca" class="form-label">Raça</label>
                <select id="raca" name="raca" class="form-select fw-bold text-dark">
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
                <select id="grau__instrucao" name="grau__instrucao" class="form-select fw-bold text-dark" value="">
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
              <input type="date" class="form-control fw-bold text-dark" maxlength="2" name="data_nascimento"  id="data_nascimento" >
            </div>


            <div class="col-md-3">
              <label for="pais__nascimento" class="form-label">País de Nascimento</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="10" name="pais__nascimento" id="pais__nascimento" >
            </div>

            <div class="col-md-3">
                <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
                <input type="text" class="form-control fw-bold text-dark" maxlength="20" name="pais__nacionalidade" id="pais__nacionalidade" >
            </div>

            <div class="col-md-6">
              <label for="nome__mae" class="form-label">Nome da Mãe</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="50" name="nome__mae" id="nome__mae" >
            </div>

            <div class="container text-center  fs-4 fw-bold mt-4 mb-3">Local de Residência</div>

            <div class="col-md-2">
              <label for="cep" class="form-label">Cep</label>
              <input type="text" class="form-control fw-bold text-dark" name="cep" id="cep" value="">
            </div>

            

            <div class="col-md-6">
                <label for="logradouro" class="form-label">Rua</label>
                <input type="text" class="form-control fw-bold text-dark" name="logradouro" id="logradouro" value="">
            </div>

            <div class="col-md-1">
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control fw-bold text-dark" name="numero" id="numero" value="">
                
            </div>

            <div class="col-md-2 d-none">
              <label for="tipo" class="form-label">Tipo</label>
              <input type="text" class="form-control fw-bold text-dark" name="tipo__endereco" id="tipo" value="">
          </div>
          <div class="col-md-3"> 
                  <label for="tipoconstrucao" class="form-label">Tipo da construção</label>
                  <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold text-dark">
                  <option selected >Casa</option>
                  <option >Apartamento</option>
              </select>
          </div>


            <div class="col-md-6">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control fw-bold text-dark" name="bairro" id="bairro" value="">
            </div>

            
            <div class="col-md-6">
                <label for="localidade" class="form-label">Municipio</label>
                <input type="text" class="form-control fw-bold text-dark" name="localidade" id="localidade" value="">
            </div>

            <div class="col-md-1">
              <label for="uf" class="form-label">UF</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="2" name="uf" id="uf" value="">
            </div>
            <div class="col-md-2">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="text" class="form-control fw-bold text-dark" name="telefone" id="telefone" value="">
            </div>

            <div class="container text-center mt-4 mb-3 fs-4 fw-bold">Contrato de Trabalho</div>

            <div class="col-md-3">
              <label for="data__admissao" class="form-label">Data de Admissão</label>
              <input type="date" class="form-control fw-bold text-dark" name="data__admissao" id="data__admissao" value="">
            </div>

            <div class="col-md-1">
              <label for="categoria" class="form-label">Categoria</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="20" name="categoria__contrato" id="categoria" value="">
            </div>

            <div class="col-md-2">
              <label for="cbo" class="form-label">CBO</label>
              <input type="text" class="form-control fw-bold text-dark" name="cbo" id="cbo" value="">
            </div>

            <div class="col-md-1">
              <label for="irrf" class="form-label">IRRF</label>
              <input type="text" class="form-control fw-bold text-dark" name="irrf" id="irrf" value="">
            </div>

            <div class="col-md-1">
              <label for="sf" class="form-label">SF</label>
              <input type="text" class="form-control fw-bold text-dark" name="sf" id="sf" value="">
            </div>

            <div class="col-md-2">
              <label for="ctps" class="form-label">CTPS</label>
              <input type="text" class="form-control fw-bold text-dark" name="ctps" id="ctps" value="">
            </div>

            <div class="col-md-1">
              <label for="serie__ctps" class="form-label">Série</label>
              <input type="text" class="form-control fw-bold text-dark" name="serie__ctps" id="serie__ctps" value="">
            </div>

            <div class="col-md-1">
              <label for="uf__ctps" class="form-label">UF</label>
              <input type="text" class="form-control fw-bold text-dark" name="uf__ctps" maxlength="2" id="uf__ctps" value="">
            </div>

            <div class="col-md-4">
              <label for="situacao__contrato" class="form-label">Situação</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="10" name="situacao__contrato" id="situacao__contrato" value="">
            </div>

            <div class="col-md-4">
              <label for="data__afastamento" class="form-label">Data de Afastamento</label>
              <input type="date" class="form-control fw-bold text-dark" name="data__afastamento" id="data__afastamento" value="">
            </div>
            
            
            <div class="container text-center mt-4 mb-3 fs-4 fw-bold">Dados Bancários do Trabalhador</div>


            <div class="col-md-3 mb-5">
              <label for="banco" class="form-label">Banco</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="100" name="banco" id="banco" value="">
            </div>

            <div class="col-md-2 mb-5">
              <label for="agencia" class="form-label">Agência</label>
              <input type="text" class="form-control fw-bold text-dark" name="agencia" id="agencia" value="">
            </div>

            <div class="col-md-2 mb-5">
              <label for="operacao" class="form-label">Operação</label>
              <input type="text" class="form-control fw-bold text-dark" name="operacao" id="operacao" value="">
            </div>

            <div class="col-md-2 mb-5">
              <label for="conta" class="form-label">Conta</label>
              <input type="text" class="form-control fw-bold text-dark" name="conta" id="conta" value="">
            </div>

            <div class="col-md-3 mb-5">
              <label for="pix" class="form-label">PIX</label>
              <input type="text" class="form-control fw-bold text-dark" maxlength="50" name="pix" id="pix" value="">
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
        <script type="text/javascript" src="{{url('/js/cbo.js')}}"></script>
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
          $('#cbo').keyup(function() {
            cbo.forEach(element => {
              if (element.code === $(this).val()) {
                $(this).val(`${element.code} - ${element.name}`)
              }
            });
          })
            $( ".pesquisa" ).on('keyup',function() {
                var dados = $(this).val();
                if (dados) {
                  $.ajax({
                    url: "{{url('trabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      campos(' ')
                      $('#trabfoto').removeAttr('src')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#datalistOptions').html(nome)
                        
                      } 
                      if(data.length === 1 && dados.length > 4){
                        // data.forEach(element => {
                        //   nome += `<option value="${element.tsnome}">`
                        //   nome += `<option value="${element.tsmatricula}">`
                        //   nome += `<option value="${element.tscpf}">`
                        // });
                        $('#datalistOptions').html(nome)
                        campos(data[0])
                      }              
                    }
                  });
                }else{
                  campos(' ')
                  $('#trabfoto').removeAttr('src')
                }
            });
            function campos(data) {
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
            $('#nome__completo').val(data.tsnome).next().text(' ')
           
            $('#nome__social').val(data.tsnomesocial).next().text(' ')
            $('#foto').val(data.tsfoto)
            $('#trabfoto').attr('src',data.tsfoto)
            $('#cpf').val(data.tscpf).next().text(' ')
            $('#matricula').val(data.tsmatricula).next().text(' ')
            $('#pis').val(data.dspis).next().text(' ')
            $('#data_nascimento').val(data.nsnascimento).next().text(' ')
            $('#telefone').val(data.tstelefone).next().text(' ')
            $('#pais__nascimento').val(data.nsnaturalidade).next().text(' ')
            $('#pais__nacionalidade').val(data.nsnacionalidade).next().text(' ')
            $('#nome__mae').val(data.tsmae).next().text(' ')
            $('#cep').val(data.escep).next().text(' ')
            $('#logradouro').val(data.eslogradouro).next().text(' ')
            $('#uf').val(data.esuf).next().text(' ')
            $('#numero').val(data.esnum).next().text(' ')
            $('#complemento').val(data.escomplemento).next().text(' ')
            $('#bairro').val(data.esbairro).next().text(' ')
            $('#localidade').val(data.esmunicipio).next().text(' ')
            $('#uf').val(data.esuf).next().text(' ')
            $('#data__admissao').val(data.csadmissao).next().text(' ')
            $('#categoria').val(data.cscategoria).next().text(' ')
            $('#cbo').val(data.cbo).next().text(' ')
            $('#irrf').val(data.csirrf).next().text(' ')
            $('#sf').val(data.cssf).next().text(' ')
            $('#ctps').val(data.dsctps).next().text(' ')
            $('#serie__ctps').val(data.dsserie).next().text(' ')
            $('#uf__ctps').val(data.dsuf).next().text(' ')
            $('#situacao__contrato').val(data.cssituacao).next().text(' ')
            $('#data__afastamento').val(data.csafastamento).next().text(' ')
            $('#nome__conta').val(data.bstitular).next().text(' ')
            $('#banco').val(data.bsbanco).next().text(' ')
            $('#agencia').val(data.bsagencia).next().text(' ')
            $('#operacao').val(data.bsoperacao).next().text(' ')
            $('#conta').val(data.bsconta).next().text(' ')
            $('#pix').val(data.bspix).next().text(' ')
            $('#bsdefaltor').val(data.deflator).next().text(' ')
            $('#endereco').val(data.eiid).next().text(' ')
            $('#bancario').val(data.biid).next().text(' ')
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
              //  $.ajax({
              //       url: "{{url('trabalhador')}}/"+dados,
              //       type: 'get',
              //       contentType: 'application/json',
              //       success: function(data) {
              //         if (data.length > 1) {
              //           data.forEach(element => {
              //             $('#datalistOptions').append(`<option value="${element.tsnome}">`)
              //           });
              //         }
                       
              //       }
              //   });
            }
            // campos('a')
        });
    </script>
@stop