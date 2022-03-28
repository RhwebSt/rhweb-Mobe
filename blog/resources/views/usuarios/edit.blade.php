<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
    <meta name="author" content="" />
    <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
    <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
    <title>RHWEB - Cadastro</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="icon" type="image/x-icon" href="images/arrowMobe.ico">
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/css/rhweb.css" rel="stylesheet" />
    <link href="/css/alteracaoSenha.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.all.min.js"></script>
</head>

<body>

    <div class="container">
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{session('success')}}",
                text: 'Agora que está tudo pronto, faça o login novamente.',
                footer: `<a href="{{route('login.create')}}">Clique aqui para fazer o login</a>`,
                showConfirmButton: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                allowOutsideClick: false,
            })
        </script>
        @endif
        @error('false')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                width: 500,
                color: '#ffffff',
                background: '#C53230',
                position: 'top-end',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: '{{ $message }}'
            })
        </script>
        @enderror
        <div class="bg__form container mt-5" style="border: 1px solid white; border-radius:12px;">

            <section class="mt-5">
                <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2">
                    <img class="trabfoto" id="trabfoto" src="{{old('foto')}}" alt="logo do usuario">
                </div>
            </section>

            <section class="">
                <div class="container">

                    <form class="row g-3 mt-1" id="form" action="{{ route('empresa.store') }}" method="POST">

                        @csrf
                        <input type="hidden" name="usuario" value="{{$id}}">
                        <div>
                            <div>
                                <div class="mb-4 col-md-4 inputfoto">
                                    <label for="formFileSm" class="form-label"><i class="fas fa-file-image fa-lg"></i> Logo da Empresa</label>
                                    <input class="form-control " type="file" name="file" onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
                                    <input type="hidden" name="foto" id="foto" value="{{old('foto')}}">
                                    <span id="msgfoto" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-12 p-0">
                                <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa" required>
                                <div id="mensagem-pesquisa" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="btn d-grid gap-1 mt-2 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                            <button class="btn botao__alterar" type="button">Alterar foto <i class="fas fa-camera"></i></button>
                        </div> -->
                        <input type="hidden" name="trabalhador">
                        <input type="hidden" name="tomador">
                        <input type="hidden" name="pessoal">
                        <h1 class="container text-center mt-5 mb-3 fs-4 fw-bold text-white">Dados da Empresa</h1>

                        <div class="col-md-4">
                            <label for="cnpj_mf" class="form-label text-white">CNPJ/MF Nº
                                <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                            </label>
                            <input type="text" class="form-control @error('escnpj') is-invalid @enderror fw-bold" value="{{old('escnpj')}}" name="escnpj" id="cnpj_mf">
                            @error('escnpj')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="col-md-8">
                            <label for="nome" class="form-label text-white">Nome</label>
                            <input type="text" class="form-control @error('esnome') is-invalid @enderror fw-bold" value="{{old('esnome')}}" name="esnome" id="nome">
                            @error('esnome')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="nome" class="form-label text-white">Data de Registro</label>
                            <input type="date" class="form-control @error('dataregistro') is-invalid @enderror fw-bold" value="{{old('dataregistro')}}" name="dataregistro" id="dataregistro">
                            @error('dataregistro')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="cep" class="form-label text-white">CEP</label>
                            <input type="text" class="form-control @error('cep') is-invalid @enderror fw-bold" maxlength="16" value="{{old('cep')}}" name="cep" id="cep">
                            @error('cep')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="logradouro" class="form-label text-white">Rua</label>
                            <input type="text" class="form-control @error('logradouro') is-invalid @enderror fw-bold" maxlength="50" value="{{old('logradouro')}}" name="logradouro" id="logradouro">
                            @error('logradouro')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="numero" class="form-label text-white">Número</label>
                            <input type="text" class="form-control  @error('numero') is-invalid @enderror fw-bold" maxlength="10" value="{{old('numero')}}" name="numero" id="numero">
                            @error('numero')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-3">
                            <label for="tipoconstrucao" class="form-label text-white">Tipo</label>
                            <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                                <option>A-Área</option>
                                <option>AC-Acesso</option>
                                <option>ACA-Acampamento</option>
                                <option>ACL-Acesso Local</option>
                                <option>AE-Área Especial</option>
                                <option>AER-Aeroporto</option>
                                <option>AL-Alameda</option>
                                <option>ALD-Aldeia</option>
                                <option>AMD-Avenida Marginal Direita</option>
                                <option>AME-Avenida Marginal Esquerda</option>
                                <option>AN-Anel Viário</option>
                                <option>ANT-Antiga Estrada</option>
                                <option>ART-Artéria</option>
                                <option>AT-Alto</option>
                                <option>ATL-Atalho</option>
                                <option>A V-Área Verde</option>
                                <option>AV-Avenida</option>
                                <option>AVC-Avenida Contorno</option>
                                <option>AVM-Avenida Marginal</option>
                                <option>AVV-Avenida Velha</option>
                                <option>BAL-Balneário</option>
                                <option>BC-Beco</option>
                                <option>BCO-Buraco</option>
                                <option>BL-Bloco</option>
                                <option>BLO-Balão</option>
                                <option>BLV-Bulevar</option>
                                <option>BSQ-Bosque</option>
                                <option>BVD-Boulevard</option>
                                <option>BX-Baixa</option>
                                <option>C-Cais</option>
                                <option>CAL-Calçada</option>
                                <option>CAM-Caminho</option>
                                <option>CAN-Canal</option>
                                <option>CH-Chácara</option>
                                <option>CHA-Chapadão</option>
                                <option>CIC-Ciclovia</option>
                                <option>CIR-Circular</option>
                                <option>CJ-Conjunto</option>
                                <option>COL-Colônia</option>
                                <option>COM-Comunidade</option>
                                <option>CON-Condomínio</option>
                                <option>COR-Corredor</option>
                                <option>CPO-Campo</option>
                                <option>CGR-Córrego</option>
                                <option>CTN-Contorno</option>
                                <option>DSC-Descida</option>
                                <option>DSV-Desvio</option>
                                <option>DT-Distrito</option>
                                <option>EB-Entre Bloco</option>
                                <option>EIM-Estrada Intermunicipal</option>
                                <option>ENS-Enseada</option>
                                <option>ENT-Entrada Particular</option>
                                <option>EQ-Entre Quadra</option>
                                <option>ESC-Escada</option>
                                <option>ESD-Escadaria</option>
                                <option>ESE-Estrada Estadual</option>
                                <option>ESI-Estrada Vicinal</option>
                                <option>ESL-Estrada de Ligação</option>
                                <option>ESM-Estrada Municipal</option>
                                <option>ESP-Esplanada</option>
                                <option>ESS-Estrada de Servidão</option>
                                <option>EST-Estrada</option>
                                <option>ESV-Estrada Velha</option>
                                <option>ETA-Estrada Antiga</option>
                                <option>ETC-Estação</option>
                                <option>ETC-Estádio</option>
                                <option>ETN-Estância</option>
                                <option>ETP-Estrada Particular</option>
                                <option>ETT-Estacionamento</option>
                                <option>EVA-Evangélica</option>
                                <option>EVD-Elevada</option>
                                <option>EX-Eixo Industrial</option>
                                <option>FAV-Favela</option>
                                <option>FAZ-Fazenda</option>
                                <option>FER-Ferrovia</option>
                                <option>FNT-Fonte</option>
                                <option>FRA-Feira</option>
                                <option>FTE-Forte</option>
                                <option>GAL-Galeria</option>
                                <option>GJA-Granja</option>
                                <option>HAB-Núcleo Habitacional</option>
                                <option>IA-Ilha</option>
                                <option>IGP-Igarapé</option>
                                <option>IND-Indeterminado</option>
                                <option>IOA-Ilhota</option>
                                <option>JD-Jardim</option>
                                <option>JDE-Jardinete</option>
                                <option>LD-Ladeira</option>
                                <option>LGA-Lagoa</option>
                                <option>LGO-Lago</option>
                                <option>LOT-Loteamento</option>
                                <option>LRG- Largo</option>
                                <option>LT-Lote</option>
                                <option>MER-Mercado</option>
                                <option>MNA-Marina</option>
                                <option>MOD-Modulo</option>
                                <option>MRG-Projeção</option>
                                <option>MRO-Morro</option>
                                <option>MTE-Monte</option>
                                <option>NUC-Núcleo</option>
                                <option>NUR-Núcleo Rural</option>
                                <option>O-Outros</option>
                                <option>OUT-Outeiro</option>
                                <option>PAR-Paralela</option>
                                <option>PAS-Passeio</option>
                                <option>PAT-Pátio</option>
                                <option>PC-Praça</option>
                                <option>PCE-Praça de Esportes</option>
                                <option>PDA-Parada</option>
                                <option>PDO-Paradouro</option>
                                <option>PNT-Ponta</option>
                                <option>PR-Praia</option>
                                <option>PRL-Prolongamento</option>
                                <option>PRM-Parque Municipal</option>
                                <option>PRQ-Parque</option>
                                <option>PRR-Parque Residencial</option>
                                <option>PSA-Passarela</option>
                                <option>PSG-Passagem</option>
                                <option>PSP- Passagem de Pedestre</option>
                                <option>PSS-Passagem Subterrânea</option>
                                <option>PTE-Ponte</option>
                                <option>PTO-Porto</option>
                                <option>Q-Quadra</option>
                                <option>QTA-Quinta</option>
                                <option>QTS-Quintas</option>
                                <option>R-Rua</option>
                                <option>R I-Rua Integração</option>
                                <option>R L-Rua de Ligação</option>
                                <option>R P-Rua Particular</option>
                                <option>R V-Rua Velha</option>
                                <option>RAM-Ramal</option>
                                <option>RCR-Recreio</option>
                                <option>REC-Recanto</option>
                                <option>RER-Retiro</option>
                                <option>RES-Residencial</option>
                                <option>RET-Reta</option>
                                <option>RLA-Ruela</option>
                                <option>RMP-Rampa</option>
                                <option>ROA-Rodo Anel</option>
                                <option>ROD-Rodovia</option>
                                <option>ROT-Rotula</option>
                                <option>RPE-Rua de Pedestre</option>
                                <option>RPR-Margem</option>
                                <option>RTN-Retorno</option>
                                <option>RTT-Rotatória</option>
                                <option>SEG-Segunda Avenida</option>
                                <option>SIT-Sitio</option>
                                <option>SRV-Servidão</option>
                                <option>ST-Setor</option>
                                <option>SUB-Subida</option>
                                <option>TCH-Trincheira</option>
                                <option>TER-Terminal</option>
                                <option>TR-Trecho</option>
                                <option>TRV-Trevo</option>
                                <option>TUN-Túnel</option>
                                <option>TV-Travessa</option>
                                <option>TVP-Travessa Particular</option>
                                <option>TVV-Travessa Velha</option>
                                <option>UNI-Unidade</option>
                                <option>V-Via</option>
                                <option>V C-Via Coletora</option>
                                <option>V L-Via Local</option>
                                <option>VAC-Via de Acesso</option>
                                <option>VAL-Vala</option>
                                <option>VCO-Via Costeira</option>
                                <option>VD-Viaduto</option>
                                <option>V-E-Via Expressa</option>
                                <option>VER-Vereda</option>
                                <option>VEV-Via Elevado</option>
                                <option>VL-Vila</option>
                                <option>VLA-Viela</option>
                                <option>VLE- Vale</option>
                                <option>VLT-Via Litorânea</option>
                                <option>VPE-Via de Pedestre</option>
                                <option>VRT-Variante</option>
                                <option>ZIG- Zigue-Zague</option>
                            </select>
                        </div>


                        <div class="col-md-5">
                            <label for="bairro" class="form-label text-white">Bairro</label>
                            <input type="text" class="form-control @error('bairro') is-invalid @enderror fw-bold" maxlength="40" value="{{old('bairro')}}" name="bairro" id="bairro">
                            @error('bairro')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-5">
                            <label for="localidade" class="form-label text-white">Município</label>
                            <input type="text" class="form-control @error('localidade') is-invalid @enderror fw-bold" maxlength="30" value="{{old('localidade')}}" name="localidade" id="localidade">
                            @error('localidade')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="uf" class="form-label text-white">UF</label>
                            <input type="text" class="form-control @error('uf') is-invalid @enderror fw-bold" maxlength="2" value="{{old('uf')}}" name="uf" id="uf">
                            @error('uf')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="reponsave" class="form-label text-white">Responsável</label>
                            <input type="text" class="form-control @error('responsave') is-invalid @enderror fw-bold" value="{{old('responsave')}}" name="responsave" id="responsave">
                            @error('responsave')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cpf" class="form-label text-white">CPF Responsável</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror fw-bold" value="{{old('cpf')}}" name="cpf" id="cpf">
                            @error('cpf')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror fw-bold fw-bold" value="{{old('email')}}" name="email" id="email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="seguro" class="form-label text-white">Seguro</label>
                            <input type="text" class="form-control @error('seguro') is-invalid @enderror fw-bold fw-bold" value="{{old('seguro')}}" name="seguro" id="seguro">
                            @error('seguro')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cnae__codigo" class="form-label text-white">CNAE código</label>
                            <input type="text" class="form-control @error('cnae__codigo') is-invalid @enderror fw-bold" value="{{old('cnae_codigo')}}" name="cnae__codigo" id="cnae__codigo">
                            @error('cnae__codigo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cod__municipio" class="form-label text-white">Código Município</label>
                            <input type="text" class="form-control @error('cod__municipio') is-invalid @enderror fw-bold" value="{{old('cod_municipio')}}" name="cod__municipio" id="cod__municipio">
                            @error('cod__municipio')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="sincalizado" class="form-label text-white">Sindicalizado</label>
                            <select id="sincalizado" name="sincalizado" class="form-select fw-bold">
                                <option>1-Sim</option>
                                <option>2-Não</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-none">
                            <label for="retem__ferias" class="form-label text-white">Retem Férias</label>
                            <select id="retem__ferias" name="retem__ferias" class="form-select fw-bold">
                                <option>1-Sim</option>
                                <option>2-Não</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="contribuicao__sindicato" class="form-label text-white">Contribuição ao Sindicato</label>
                            <input type="text" class="form-control @error('contribuicao__sindicato') is-invalid @enderror fw-bold" value="{{old('contribuicao_sindicato')}}" name="contribuicao__sindicato" id="contribuicao__sindicato">
                            @error('contribuicao__sindicato')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="telefone" class="form-label text-white">Telefone</label>
                            <input type="text" class="form-control @error('telefone') is-invalid @enderror fw-bold" value="{{old('telefone')}}" name="telefone" id="telefone">
                            @error('telefone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="justify-content-end d-flex" role="group" aria-label="Basic example">
                            <button class="btn botao__alterar" type="submit">Cadastrar <i class="fas fa-save"></i></button>
                        </div>
                    </form>
                </div>
            </section>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
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
            $('#cnpj_mf').on('change', function() {
            let dados = $(this).val();
            dados = dados.replace(/\D/g, '');
            pesquisa(dados)
        })
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
        </script>
</body>

</html>