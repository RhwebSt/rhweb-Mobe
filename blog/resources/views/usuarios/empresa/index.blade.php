@extends('layouts.index')
@section('titulo','Rhweb - Cadastro de Usuário')
@section('conteine')
<div class="container">
    @if(session('success'))
            <script>
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  html: '<p class="modal__aviso">{{session("success")}}</p>',
                  background: '#45484A',
                  showConfirmButton: true,
                  timer: 2500,
        
                });
            </script>
            @endif
            @error('false')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<p class="modal__aviso">{{ $message }}</p>',
                    background: '#45484A',
                    showConfirmButton: true,
                    timer: 5000,
        
                });
            </script>
        @enderror 
    <form class="row g-3 mt-1 mb-3" id="form" action="{{ route('empresa.store') }}" method="POST" action="">

        @can('admin')
        <div class="row">
            <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                <button type="submit" id="incluir" class="btn botao">
                    <i class="fad fa-save"></i> Incluir
                </button>
                <button type="submit" id="atualizar" disabled class="btn botao d-none">
                    <i class="fad fa-edit"></i> Editar
                </button>
                <button type="button" id="excluir" disabled class="btn botao d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fad fa-trash"></i> Excluir
                </button>
                <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#teste">
                    <i class="fad fa-list"></i> Lista
                </a>
                <a class="btn botao" href="#" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>

        <div>
          



            <div>
                <div class="col-md-5 mb-3">
                    <img class="trabfoto" id="trabfoto" src="" alt="logo do usuario">
                </div>

            </div>


            <div>
                <div class="mb-4 col-md-4 inputfoto">
                    <label for="formFileSm" class="form-label"><i class="fas fa-file-image fa-lg"></i> Logo da Empresa</label>
                    <input class="form-control " type="file" name="file" onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
                    <input type="hidden" name="foto" id="foto">
                    <span id="msgfoto" class="text-danger"></span>
                </div>
            </div>

            <div class="col-md-12 p-0">
                <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa" required>
                <div id="mensagem-pesquisa" class="invalid-feedback">
                </div>
            </div>
        </div>
        @endcan
        <input type="hidden" id="empresa" value="{{$user->empresa}}">
        <h1 class="container text-center fs-4 fw-bold">Cadastro de Empresas</h1>
        @csrf
        <input type="hidden" name="trabalhador">
        <input type="hidden" name="tomador">
        <input type="hidden" name="pessoal">
        <input type="hidden" id="method" name="_method" value="">


        <div class="col-md-4">
            <label for="cnpj_mf" class="form-label ">CNPJ/MF Nº
                <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
            </label>
            <input type="text" class="form-control @error('escnpj') is-invalid @enderror fw-bold" value="{{old('escnpj')}}" name="escnpj" id="cnpj_mf">
            @error('escnpj')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-8">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control @error('esnome') is-invalid @enderror fw-bold" value="{{old('esnome')}}" name="esnome" id="nome">
            @error('esnome')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>



        <div class="col-md-3">
            <label for="nome" class="form-label">Data de Registro</label>
            <input type="date" class="form-control fw-bold @error('dataregistro') is-invalid @enderror fw-bold" value="{{old('dataregistro')}}" name="dataregistro" id="dataregistro">
            @error('dataregistro')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control @error('cep') is-invalid @enderror fw-bold" maxlength="16" value="{{old('cep')}}" name="cep" id="cep">
            @error('cep')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="logradouro" class="form-label">Rua</label>
            <input type="text" class="form-control  @error('logradouro') is-invalid @enderror fw-bold" maxlength="50" value="{{old('logradouro')}}" name="logradouro" id="logradouro">
            @error('logradouro')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="numero" class="form-label">Número</label>
            <input type="text" class="form-control @error('numero') is-invalid @enderror fw-bold" maxlength="10" value="{{old('numero')}}" name="numero" id="numero">
            @error('numero')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-3">
            <label for="tipoconstrucao" class="form-label">Tipo</label>
            <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                <option selected>Casa</option>
                <option>Apartamento</option>
                <option>Empresa</option>
            </select>
        </div>
        <div class="col-md-5">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control @error('bairro') is-invalid @enderror fw-bold" maxlength="40" value="{{old('bairro')}}" name="bairro" id="bairro">
            @error('bairro')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-5">
            <label for="localidade" class="form-label">Município</label>
            <input type="text" class="form-control @error('localidade') is-invalid @enderror fw-bold" maxlength="30" value="{{old('localidade')}}" name="localidade" id="localidade">
            @error('localidade')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="uf" class="form-label">UF</label>
            <input type="text" class="form-control @error('uf') is-invalid @enderror fw-bold" maxlength="2" value="{{old('uf')}}" name="uf" id="uf">
            @error('uf')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="reponsave" class="form-label">Responsável</label>
            <input type="text" class="form-control @error('responsave') is-invalid @enderror fw-bold" value="{{old('responsave')}}" name="responsave" id="responsave">
            @error('responsave')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="cpf" class="form-label">CPF Responsável</label>
            <input type="text" class="form-control  fw-bold" value="{{old('cpf')}}" name="cpf" id="cpf">
            @error('cpf')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control fw-bold @error('email') is-invalid @enderror fw-bold" value="{{old('email')}}" name="email" id="email">
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="seguro" class="form-label">Seguro</label>
            <input type="text" class="form-control fw-bold @error('seguro') is-invalid @enderror fw-bold" value="{{old('seguro')}}" name="seguro" id="seguro">
            @error('seguro')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="cnae__codigo" class="form-label">CNAE código</label>
            <input type="text" class="form-control @error('cnae__codigo') is-invalid @enderror fw-bold" value="{{old('cnae__codigo')}}" name="cnae__codigo" id="cnae__codigo">
            @error('cnae__codigo')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="cod__municipio" class="form-label">Código Município</label>
            <input type="text" class="form-control @error('cod__municipio') is-invalid @enderror fw-bold" value="{{old('cod__municipio')}}" name="cod__municipio" id="cod__municipio">
            @error('cod__municipio')
            <span class="text-danger">{{ $message }}</span>
            @enderror
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
            <input type="text" class="form-control @error('contribuicao__sindicato') is-invalid @enderror fw-bold" value="{{old('contribuicao__sindicato')}}" name="contribuicao__sindicato" id="contribuicao__sindicato">
            @error('contribuicao__sindicato')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control @error('telefone') is-invalid @enderror fw-bold" value="{{old('telefone')}}" name="telefone" id="telefone">
            @error('telefone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!--<h1 class="container text-center mt-5 mb-3 fs-4 fw-bold">Valores para VT e VA Rúbricas</h1>-->



        <!--<div class="col-md-3">-->
        <!--    <label for="nro__fatura" class="form-label">Nro Fatura</label>-->
        <!--    <input type="text" class="form-control  @error('nro__fatura') is-invalid @enderror"  value="{{old('nro__fatura')}}"  name="nro__fatura" id="nro__fatura">-->
        <!--    @error('nro__fatura')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="nro__reciboavulso" class="form-label">Nro Recibo Avulso</label>-->
        <!--    <input type="text" class="form-control @error('nro__reciboavulso') is-invalid @enderror"  value="{{old('nro__reciboavulso')}}" name="nro__reciboavulso" id="nro__reciboavulso">-->
        <!--    @error('nro__reciboavulso')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3 d-none">-->
        <!--    <label for="matric__trabalhador" class="form-label">Matrícula Trabalhador</label>-->
        <!--    <input type="text" class="form-control @error('matric__trabalhador') is-invalid @enderror"  value="{{old('matric__trabalhador')}}" name="matric__trabalhador" id="matric__trabalhador">-->
        <!--    @error('matric__trabalhador')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="nro__requisicao" class="form-label">Nro Requisição</label>-->
        <!--    <input type="text" class="form-control @error('nro__requisicao') is-invalid @enderror"  value="{{old('nro__requisicao')}}" name="nro__requisicao" id="nro__requisicao">-->
        <!--    @error('nro__requisicao')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="nro__boletins" class="form-label">Nro Boletins</label>-->
        <!--    <input type="text" class="form-control @error('nro__boletins') is-invalid @enderror"  value="{{old('nro__boletins')}}" name="nro__boletins" id="nro__boletins">-->
        <!--    @error('nro__boletins')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="nro__folha" class="form-label">Nro da Folha</label>-->
        <!--    <input type="text" class="form-control @error('nro__folha') is-invalid @enderror"  value="{{old('nro__folha')}}" name="nro__folha" id="nro__folha">-->
        <!--    @error('nro__folha')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="nro__cartaoponto" class="form-label">Nro Cartão Ponto</label>-->
        <!--    <input type="text" class="form-control @error('nro__cartaoponto') is-invalid @enderror"  value="{{old('nro__cartaoponto')}}" name="nro__cartaoponto" id="nro__cartaoponto">-->
        <!--    @error('nro__cartaoponto')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="seq__esocial" class="form-label">Seque E-Social</label>-->
        <!--    <input type="text" class="form-control @error('seq__esocial') is-invalid @enderror"  value="{{old('seq__esocial')}}" name="seq__esocial" id="seq__esocial">-->
        <!--    @error('seq__esocial')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-3">-->
        <!--    <label for="cbo" class="form-label">CBO</label>-->
        <!--    <input type="text" class="form-control @error('cbo') is-invalid @enderror"  value="{{old('cbo')}}" name="cbo" id="cbo">-->
        <!--    @error('cbo')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->
        <!--<div class="col-md-3">-->
        <!--    <label for="matricular" class="form-label">N°Trabalhador</label>-->
        <!--    <input type="text" class="form-control @error('matricular') is-invalid @enderror"  value="{{old('matricular')}}" name="matricular" id="matricular">-->
        <!--    @error('matricular')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->
        <!--<div class="col-md-3">-->
        <!--    <label for="matriculartomador" class="form-label">N°Tomador</label>-->
        <!--    <input type="text" class="form-control @error('matriculartomador') is-invalid @enderror"  value="{{old('matriculartomador')}}" name="matriculartomador" id="matriculartomador">-->
        <!--    @error('matriculartomador')-->
        <!--      <span class="text-danger">{{ $message }}</span>-->
        <!--    @enderror-->
        <!--</div>-->
        <!--<div class="col-md-2 mb-5 d-none">-->
        <!--    <label for="ambiente__esocial" class="form-label">Ambiente E-Social</label>-->
        <!--    <select id="ambiente__esocial" name="ambiente__esocial" class="form-select fw-bold">-->
        <!--        <option>1-Produção </option>-->
        <!--        <option>2-Restrita</option>-->
        <!--    </select>-->
        <!--</div>-->

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
                    <p class="mb-1 text-start">Deseja realmente excluir?</p>
                </div>
                <div class="modal-footer modal-delfooter">
                    <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn__deletar">Deletar</button>

                </div>
            </form>
        </div>
    </div>
</div>

@include('usuarios.empresa.lista');
<script>
    $('.modal-botao').click(function() {
        localStorage.setItem("modal", "enabled");
    })

    function verficarModal() {
        var valueModal = localStorage.getItem('modal');
        if (valueModal === "enabled") {
            $(document).ready(function() {
                $("#teste").modal("show");
            });
            localStorage.setItem("modal", "disabled");
        }
    }
    verficarModal()
    function validaInputQuantidade(idCampo, QuantidadeCarcteres) {
        var telefone = document.querySelector(idCampo);

        telefone.addEventListener('input', function() {
            var telefone = document.querySelector(idCampo);
            var result = telefone.value;
            if (result > " " && result.length >= QuantidadeCarcteres) {
                telefone.classList.add('is-valid');
            } else {
                telefone.classList.remove('is-valid');
            }

        });
    }

    var nome = validaInputQuantidade("#nome", 1);
    var dataregistro = validaInputQuantidade("#dataregistro", 10);
    var cep = validaInputQuantidade("#cep", 9);
    var logradouro = validaInputQuantidade("#logradouro", 1);
    var bairro = validaInputQuantidade("#bairro", 1);
    var localidade = validaInputQuantidade("#localidade", 1);
    var numero = validaInputQuantidade("#numero", 1);
    var uf = validaInputQuantidade("#uf", 2);
    var responsave = validaInputQuantidade("#responsave", 1);
    var cpf = validaInputQuantidade("#cpf", 14);
    var seguro = validaInputQuantidade("#seguro", 1);
    var cnae__codigo = validaInputQuantidade("#cnae__codigo", 1);
    var cod__municipio = validaInputQuantidade("#cod__municipio", 1);
    var contribuicao__sindicato = validaInputQuantidade("#contribuicao__sindicato", 1);
    var telefone = validaInputQuantidade("#telefone", 14);
    var nomeFantasia = validaInputQuantidade("#nome", 1);
    var nomeFantasia = validaInputQuantidade("#nome", 1);
    var nomeFantasia = validaInputQuantidade("#nome", 1);

    function validaInputEmail(idCampo, QuantidadeCarcteres) {
        var telefone = document.querySelector(idCampo);

        telefone.addEventListener('input', function() {
            var telefone = document.querySelector(idCampo);
            var result = telefone.value;
            if (result > " " && result.length >= QuantidadeCarcteres && result.search("@") != -1 && result.indexOf(".") != -1) {
                telefone.classList.add('is-valid');
            } else {
                telefone.classList.remove('is-valid');
            }
            console.log(result.indexOf("."));
        });
    }

    var email = validaInputEmail("#email", 1);

    var cepFocusOut = document.querySelector('#cep');
    cepFocusOut.addEventListener('focusout', function() {
        var logradouro = document.querySelector('#logradouro');
        var resultlog = logradouro.value;
        var bairro = document.querySelector('#bairro');
        var resultbairro = bairro.value;
        var localidade = document.querySelector('#localidade');
        var resultlocal = localidade.value;
        var uf = document.querySelector('#uf');
        var resultuf = uf.value;


        if (resultlog > " ") {
            logradouro.classList.add('is-valid');
        } else {
            logradouro.classList.remove('is-valid');
        }

        if (resultbairro > " ") {
            bairro.classList.add('is-valid');
        } else {
            bairro.classList.remove('is-valid');
        }

        if (resultlocal > " ") {
            localidade.classList.add('is-valid');
        } else {
            localidade.classList.remove('is-valid');
        }

        if (resultuf > " " && resultuf.length > 2) {
            uf.classList.add('is-valid');
        } else {
            uf.classList.remove('is-valid');
        }

    });

    var botaolimpaCampos = document.querySelector("#refre");

    botaolimpaCampos.addEventListener('click', function() {
        var cnpjMf = document.querySelector("#cnpj_mf").value = '';
        var nome = document.querySelector("#nome").value = '';
        var dataRegistro = document.querySelector("#dataregistro").value = '';
        var cep = document.querySelector("#cep").value = '';
        var logradouro = document.querySelector("#logradouro").value = '';
        var numero = document.querySelector("#numero").value = '';
        var complementoEndereco = document.querySelector("#complemento__endereco").value = '';
        var bairro = document.querySelector("#bairro").value = '';
        var localidade = document.querySelector("#localidade").value = '';
        var uf = document.querySelector("#uf").value = '';
        var responsavel = document.querySelector("#responsave").value = '';
        var email = document.querySelector("#email").value = '';
        var seguro = document.querySelector("#seguro").value = '';
        var cnaeCodigo = document.querySelector("#cnae__codigo").value = '';
        var codMunicipio = document.querySelector("#cod__municipio").value = '';
        var sindicalizado = document.querySelector("#sincalizado").value = '';
        var retemFerias = document.querySelector("#retem__ferias").value = '';
        var contribuicaoSindicato = document.querySelector("#contribuicao__sindicato").value = '';
        var telefone = document.querySelector("#telefone").value = '';
    });



    function encodeImageFileAsURL(element) {
        var file = element.files[0];
        var ext = ['jpg', 'jpeg', 'png', 'svg', 'tiff', 'webp']
        var type = file.type.split('/')
        if (file.size < 3145728) {
            if (ext.indexOf(type[1]) >= 1) {
                foto(file)
            } else {
                $('#msgfoto').text('A extensão não é suportada. Apenas(jpg, png,svg,tiff,webp)')
            }
        } else {
            $('#msgfoto').text('O tamanho suportado é até 3MB')
        }
    }

    function foto(file) {
        var reader = new FileReader();
        reader.onloadend = function() {
            $('#foto').val(reader.result)
            $('#trabfoto').attr('src', reader.result)
        }
        reader.readAsDataURL(file);
    }
    $(document).ready(function() {

        $("#pesquisa").on('keyup focus', function() {
            var dados = '0';
            if ($(this).val()) {
                dados = $(this).val();
                // if (dados.indexOf('  ') !== -1) {
                //     dados = monta_dados(dados);
                // }
            }
            $.ajax({
                url: "{{url('empresa')}}/pesquisa/" + dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    $('#trabfoto').removeAttr('src')
                    if (data.length >= 1) {
                        data.forEach(element => {
                            nome += `<option value="${element.esnome}">`
                            // nome += `<option value="${element.escnae}">`
                            // nome += `<option value="${element.escnpj}">`
                        });
                        $('#listapesquisa').html(nome)
                    }
                    // if (data.length === 1 && dados.length > 4) {
                    //     empresas(dados)
                    // } else if (dados.length === 14) {
                    //     pesquisa(dados)
                    // }
                }
            });
        });

        function monta_dados(dados) {
            let novodados = dados.split('  ')
            return novodados[1];
        }
        $('#cnpj_mf').on('change', function() {
            let dados = $(this).val();
            dados = dados.replace(/\D/g, '');
            pesquisa(dados)
        })

        function empresas(dados) {
            $('#carregamento').removeClass('d-none')
            if (dados) {
                $.ajax({
                    url: "{{url('listaempresa')}}/" + dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {

                        if (data.empresa) {
                            $('#carregamento').addClass('d-none')
                            modulo(data)
                        }
                    }
                })
            } else {
                modulo('')
            }
        }

        function modulo(data) {
            if (data.empresa) {
                $('#form').attr('action', "{{ url('empresa')}}/" + data.empresa);
                $('#formdelete').attr('action', "{{ url('empresa')}}/" + data.empresa)
                $('#incluir').attr('disabled', 'disabled')
                $('#atualizar').removeAttr("disabled")
                $('#deletar').removeAttr("disabled")
                $('#excluir').removeAttr("disabled")
                $('#method').val('PUT')
                campos(data);
            } else {
                cadastro(data);
            }
        }

        function cadastro(data) {
            $('#form').attr('action', "{{ route('empresa.store') }}");
            $('#incluir').removeAttr("disabled")
            $('#depedente').removeAttr("disabled")
            $('#atualizar').attr('disabled', 'disabled')
            $('#deletar').attr('disabled', 'disabled')
            $('#method').val(' ')
            $('#excluir').attr("disabled", 'disabled')
            campos(data)
        }

        function pesquisa(dados) {
            $('#carregamento').removeClass('d-none')
            $.ajax({
                url: "https://brasilapi.com.br/api/cnpj/v1/" + dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    $('#carregamento').addClass('d-none')
                    //    $("#pesquisa").removeClass('is-invalid')
                    $('#nome').val(data.razao_social)
                    $('#cnpj_mf').val(data.cnpj)
                    $('#dataregistro').val(data.data_situacao_cadastral)
                    $('#cnae__codigo').val(data.cnae_fiscal)
                    $('#cod__municipio').val(data.codigo_municipio)
                    $('#cep').val(data.cep)
                    $('#cnpj').val(data.cnpj.replace(/(\d{2})?(\d{3})?(\d{3})?(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                    $('#logradouro').val(data.logradouro)
                    $('#numero').val(data.numero)
                    $('#bairro').val(data.bairro)
                    $('#localidade').val(data.municipio)
                    $('#uf').val(data.uf)
                    $('#telefone').val(data.ddd_telefone_1)
                    $('#complemento').val(data.descricao_tipo_logradouro)
                    //    $('#mensagem-pesquisa').text(' ').addClass('valid-feedback').removeClass('invalid-feedback')
                },
                error: function(data) {
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

        function campos(data) {
            $('#nome').val(data.esnome)
            $('#foto').val(data.esfoto)
            $('#trabfoto').attr('src', data.esfoto)
            $('#telefone').val(data.estelefone)
            $('#cnpj_mf').val(data.escnpj)
            $('#cpf').val(data.escpf)
            $('#dataregistro').val(data.esdataregitro)
            $('#cep').val(data.escep)
            $('#logradouro').val(data.eslogradouro)
            $('#numero').val(data.esnum)
            // $('#complemento__endereco').val(data.escomplemento)
            $('#bairro').val(data.esbairro)
            $('#localidade').val(data.esmunicipio)
            $('#uf').val(data.esuf)
            $('#responsave').val(data.esresponsavel)
            $('#email').val(data.esemail)
            $('#cnae__codigo').val(data.escnae)
            $('#cod__municipio').val(data.escodigomunicipio)
            $('#contribuicao__sindicato').val(data.escondicaosindicato)
            $('#seguro').val(data.esseguro);
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
            for (let index = 0; index < $('#complemento__endereco option').length; index++) {
                if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {

                    $('#complemento__endereco option').eq(index).attr('selected', 'selected')
                } else {
                    $('#complemento__endereco option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#sincalizado option').length; index++) {
                if (data.essindicalizado == $('#sincalizado option').eq(index).text()) {

                    $('#sincalizado option').eq(index).attr('selected', 'selected')
                } else {
                    $('#sincalizado option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#retem__ferias option').length; index++) {
                if (data.esretemferias == $('#retem__ferias option').eq(index).text()) {

                    $('#retem__ferias option').eq(index).attr('selected', 'selected')
                } else {
                    $('#retem__ferias option').eq(index).removeAttr('selected')
                }
            }
            // for (let index = 0; index <  $('#ambiente__esocial option').length; index++) {  
            //     if (data.esretemferias == $('#ambiente__esocial option').eq(index).text()) {

            //         $('#ambiente__esocial option').eq(index).attr('selected','selected')
            //     }else  {
            //         $('#ambiente__esocial option').eq(index).removeAttr('selected')
            //     }
            // }
        }
    });
</script>
@stop