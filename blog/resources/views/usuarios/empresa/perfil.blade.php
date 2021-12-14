@extends('layouts.index')
@section('conteine')
        <div class="container" >
            
            
        @if($errors->all())
            @foreach($errors->all() as  $error)
              @if($error === 'edittrue')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>Atualização realizada com sucesso! <i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
             @elseif($error === 'editfalse')
                <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>Não foi possível atualizar os dados! <i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
            @elseif($error === 'deletatrue')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>Registro deletado com sucesso! <i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
             @elseif($error === 'cadastratrue')
                <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>Cadastro realizada com sucesso! <i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
             @elseif($error === 'cadastrafalse')
                <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>Não foi possível realizar o cadastro! <i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
            @endif
            @endforeach
        @endif     
            <form class="row g-3 mt-1 mb-3" id="form" action="{{ route('empresa.store') }}" method="POST" action="" >
           
            <div class="col-md-5 mb-3">
                <label for="formFileSm" class="form-label d-none">Logo da Empresa</label>
                <img class="trabfoto" id="trabfoto" src="" alt="logo do usuario">
            </div>
                <input type="hidden" id="empresa" value="{{$user->empresa}}">
                <h1 class="container text-center fs-4 fw-bold">Cadastro de Empresas</h1>
                @csrf
                <input type="hidden" name="trabalhador" >
                <input type="hidden" name="tomador">
                <input type="hidden" id="method" name="_method" value="">
                <div class="col-md-8">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>

                <div class="col-md-4">
                    <label for="cnpj_mf" class="form-label ">CNPJ/MF Nº</label>
                    <input type="text" class="form-control " name="cnpj_mf" id="cnpj_mf">
                </div>

                <div class="col-md-4">
                    <label for="nome" class="form-label">Data de Registro</label>
                    <input type="date" class="form-control fw-bold" name="dataregistro" id="dataregistro">
                </div>


                <div class="col-md-2">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" name="cep" id="cep">
                </div>
                
                <div class="col-md-6">
                    <label for="logradouro" class="form-label">Rua</label>
                    <input type="text" class="form-control" name="logradouro" id="logradouro">
                </div>

                <div class="col-md-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name="numero" id="numero">
                </div>

                
                <div class="col-md-4"> 
                                <label for="tipoconstrucao" class="form-label">Tipo da construção</label>
                                <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                                <option selected >Casa</option>
                                <option >Apartamento</option>
                            </select>
                        </div>
                <div class="col-md-6">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" name="bairro" id="bairro">
                </div>


                <div class="col-md-6">
                    <label for="localidade" class="form-label">Municipio</label>
                    <input type="text" class="form-control" name="localidade" id="localidade">
                </div>

                <div class="col-md-2">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control" name="uf" id="uf">
                </div>
 
                <div class="col-md-4">
                    <label for="reponsave" class="form-label">Responsavel</label>
                    <input type="text" class="form-control" name="responsave" id="responsave">
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control fw-bold" name="email" id="email">
                </div>

                <div class="col-md-4">
                    <label for="cnae__codigo" class="form-label">CNAE código</label>
                    <input type="text" class="form-control" name="cnae__codigo" id="cnae__codigo">
                </div>

                <div class="col-md-4">
                    <label for="cod__municipio" class="form-label">Código Município</label>
                    <input type="text" class="form-control" name="cod__municipio" id="cod__municipio">
                </div>

                <div class="col-md-4">
                    <label for="sincalizado" class="form-label">Sindicalizado</label>
                    <select id="sincalizado" name="sincalizado" class="form-select fw-bold">
                        <option>1-Sim</option>
                        <option>2-Não</option>
                    </select>
                </div>

                <div class="col-md-2 d-none">
                    <label for="retem__ferias" class="form-label">Retem Férias</label>
                    <select id="retem__ferias" name="retem__ferias" class="form-select fw-bold">
                        <option>1-Sim</option>
                        <option>2-Não</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="contribuicao__sindicato" class="form-label">Contribuição ao Sindicato</label>
                    <input type="text" class="form-control" name="contribuicao__sindicato" id="contribuicao__sindicato">
                </div>
                
                <div class="col-md-4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone">
                </div>

                <h1 class="container text-center mt-5 mb-3 fs-4 fw-bold">Valores para VT e VA Rúbricas</h1>


                <div class="col-md-4">
                    <label for="vt__trabalhador" class="form-label">VT Trabalhador</label>
                    <input type="text" class="form-control" name="vt__trabalhador" id="vt__trabalhador">
                </div>


                <div class="col-md-4">
                    <label for="va__trabalhador" class="form-label">VA Trabalhador</label>
                    <input type="text" class="form-control" name="va__trabalhador" id="va__trabalhador">
                </div>

                <div class="col-md-4">
                    <label for="nro__fatura" class="form-label">Nro Fatura</label>
                    <input type="text" class="form-control" name="nro__fatura" id="nro__fatura">
                </div>

                <div class="col-md-4">
                    <label for="nro__reciboavulso" class="form-label">Nro Recibo Avulso</label>
                    <input type="text" class="form-control" name="nro__reciboavulso" id="nro__reciboavulso">
                </div>

                <div class="col-md-4 d-none">
                    <label for="matric__trabalhador" class="form-label">Matrícula Trabalhador</label>
                    <input type="text" class="form-control" name="matric__trabalhador" id="matric__trabalhador">
                </div>

                <div class="col-md-4">
                    <label for="nro__requisicao" class="form-label">Nro Requisição</label>
                    <input type="text" class="form-control" name="nro__requisicao" id="nro__requisicao">
                </div>

                <div class="col-md-4">
                    <label for="nro__boletins" class="form-label">Nro Boletins</label>
                    <input type="text" class="form-control" name="nro__boletins" id="nro__boletins">
                </div>

                <div class="col-md-4">
                    <label for="nro__folha" class="form-label">Nro da Folha</label>
                    <input type="text" class="form-control" name="nro__folha" id="nro__folha">
                </div>

                <div class="col-md-4">
                    <label for="nro__cartaoponto" class="form-label">Nro Cartão Ponto</label>
                    <input type="text" class="form-control" name="nro__cartaoponto" id="nro__cartaoponto">
                </div>

                <div class="col-md-4">
                    <label for="seq__esocial" class="form-label">Seque E-Social</label>
                    <input type="text" class="form-control" name="seq__esocial" id="seq__esocial">
                </div>

                <div class="col-md-4">
                    <label for="cbo" class="form-label">CBO</label>
                    <input type="text" class="form-control" name="cbo" id="cbo">
                </div>

                <div class="col-md-4 mb-5 d-none">
                    <label for="ambiente__esocial" class="form-label">Ambiente E-Social</label>
                    <select id="ambiente__esocial" name="ambiente__esocial" class="form-select fw-bold">
                        <option>1-Produção </option>
                        <option>2-Restrita</option>
                    </select>
                </div>
                
                    <input type="hidden" name="endereco" id="endereco">

                    <input type="hidden" name="bancario" id="bancario">
            </div>
        </form>

        
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header " style="background-image: linear-gradient(50deg, rgb(69, 71, 243),rgb(91, 9, 199))">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-image: linear-gradient(170deg, rgb(2, 19, 97),rgb(19, 1, 70));">
                    <p class="text-white text-start fs-5">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer" style="background-image: linear-gradient(50deg, rgb(69, 71, 243),rgb(91, 9, 199))">
                    <button type="button" class="btn btn-success btn-outline-light" data-bs-dismiss="modal">Fechar</button>
                    <form action="" method="post" id="formdelete">
                    @csrf
                        @method('delete')
                        
                        
                        <button type="submit" class="btn btn-danger" >Deletar</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            
            
     <script>
        $(document).ready(function(){
            var empresa = $('#empresa').val()
            $.ajax({
                url: "{{url('listaempresa')}}/"+empresa,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    if (data.empresa) {
                        $('#nome').val(data.esnome)
                        campos(data);
                    }
                }
            })
            function campos(data) {
                $('#nome').val(data.esnome)
                $('#foto').val(data.esfoto)
                $('#trabfoto').attr('src',data.esfoto)
                $('#telefone').val(data.estelefone)
                $('#cnpj_mf').val(data.escnpj)
                $('#dataregistro').val(data.esdataregitro)
                $('#cep').val(data.escep)
                $('#logradouro').val(data.eslogradouro)
                $('#numero').val(data.esnum)
                $('#complemento__endereco').val(data.escomplemento)
                $('#bairro').val(data.esbairro)
                $('#localidade').val(data.esmunicipio)
                $('#uf').val(data.esuf)
                $('#responsave').val(data.esresponsavel)
                $('#email').val(data.esemail)
                $('#cnae__codigo').val(data.escnae)
                $('#cod__municipio').val(data.escodigomunicipio)
                $('#contribuicao__sindicato').val(data.escondicaosindicato)

                $('#vt__trabalhador').val(data.vsvttrabalhador)
                $('#va__trabalhador').val(data.vsvatrabalhador)
                $('#nro__fatura').val(data.vsnrofatura)
                $('#nro__reciboavulso').val(data.vsreciboavulso)
                $('#matric__trabalhador').val(data.vsmatricula)
                $('#nro__requisicao').val(data.vsnrorequisicao)
                $('#nro__boletins').val(data.vsnroboletins)
                $('#nro__folha').val(data.vsnroflha)
                $('#nro__cartaoponto').val(data.vsnrocartaoponto)
                $('#seq__esocial').val(data.vsnroequesocial)
                $('#cbo').val(data.vscbo)
                $('#endereco').val(data.eiid)
                $('#bancario').val(data.biid)
                for (let index = 0; index <  $('#sincalizado option').length; index++) {  
                    if (data.essindicalizado == $('#sincalizado option').eq(index).text()) {
                        
                        $('#sincalizado option').eq(index).attr('selected','selected')
                    }else  {
                        $('#sincalizado option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#retem__ferias option').length; index++) {  
                    if (data.esretemferias == $('#retem__ferias option').eq(index).text()) {
                        
                        $('#retem__ferias option').eq(index).attr('selected','selected')
                    }else  {
                        $('#retem__ferias option').eq(index).removeAttr('selected')
                    }
                }
            }
        });
    </script>
    @stop