@extends('layouts.index')
@section('titulo','Atualizar os Dados - Rhweb')
@section('conteine')

<main role="main">
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
        
        <form class="row g-3 mt-1" id="form" action="{{ route('empresa.perfil.update',$user->empresa) }}" method="POST" action="" >
            @csrf
            <input type="hidden" id="empresa" value="{{$user->empresa}}">
            <input type="hidden" name="foto" id="inputfoto" value="{{$empresas->esfoto}}">
            <input type="hidden" name="trabalhador">
            <input type="hidden" name="tomador">
            <input type="hidden" id="method" name="_method" value="PUT">
            
            <section class="section__botoes--atualiza--empresa">
                    
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <button class="btn botao"  type="submit"><i class="fas fa-sync-alt"></i> Atualizar</button>
                    <button class="btn botao" type="button" onClick="BotaoAlterafoto()"><i class="fad fa-camera-retro"></i> Alterar foto</button>
                </div>
                
            </section>
            
            <h1 class="title__atualiza--empresa">Atualizar os dados da empresa <i class="fad fa-building"></i></h1>
    
            <section class="section__foto--atualizar--empresa">
                
                <div class="container d-flex justify-content-center flex-column align-items-center" >
                        @if($empresas->esfoto)
                        <img src="{{$empresas->esfoto}}" class="foto__empresa" id="foto" alt="...">
                        @else
                        <img src="{{url('imagem/iconFotoTrab.jpg')}}" class="foto__empresa" id="foto" alt="...">
                        @endif
                </div>
    
            </section>
           
            <div class="col-md-8">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control @error('esnome') is-invalid @enderror" name="esnome" value="{{$empresas->esnome}}" id="nome">
                @error('esnome')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="col-md-4">
                <label for="cnpj_mf" class="form-label ">CNPJ/MF N??</label>
                <input type="text" class="form-control @error('escnpj') is-invalid @enderror" name="escnpj" value="{{$empresas->escnpj}}" id="cnpj_mf">
                @error('escnpj')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-4">
                <label for="nome" class="form-label">Data de Registro</label>
                <input type="date" class="form-control @error('dataregistro') is-invalid @enderror" value="{{$empresas->esdataregitro}}" name="dataregistro" id="dataregistro">
                @error('dataregistro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-2">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" value="{{$empresas->escep}}" id="cep">
                @error('cep')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                                
            <div class="col-md-6">
                <label for="logradouro" class="form-label">Rua</label>
                <input type="text" class="form-control @error('logradouro') is-invalid @enderror" name="logradouro" value="{{$empresas->eslogradouro}}" id="logradouro">
                @error('logradouro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-2">
                <label for="numero" class="form-label">N??mero</label>
                <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" id="numero" value="{{$empresas->esnum}}">
                @error('numero')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
                                
            <div class="col-md-4"> 
                <label for="tipoconstrucao" class="form-label">Tipo da constru????o</label>
                <select name="complemento__endereco" id="complemento__endereco" class="form-select">
                <?php
                    $tipo = [
                        'A-??rea',
                        'AC-Acesso',
                        'ACA-Acampamento',
                        'ACL-Acesso Local',
                        'AD-Adro',
                        'AE-??rea Especial',
                        'AER-Aeroporto',
                        'AL-Alameda',
                        'AMD-Avenida Marginal Direita',
                        'AME-Avenida Marginal Esquerda',
                        'AN-Anel Vi??rio',
                        'ANT-Antiga Estrada',
                        'ART-Art??ria',
                        'AT-Alto',
                        'ATL-Atalho',
                        'A V-??rea Verde',
                        'AV-Avenida',
                        'AVC-Avenida Contorno',
                        'AVM-Avenida Marginal',
                        'AVV-Avenida Velha',
                        'BAL-Balne??rio',
                        'BC-Beco',
                        'BCO-Buraco',
                        'BEL-Belvedere',
                        'BL-Bloco',
                        'BLO-Bal??o',
                        'BLS-Blocos',
                        'BLV-Bulevar',
                        'BSQ-Bosque',
                        'BVD-Boulevard',
                        'BX-Baixa',
                        'C-Cais',
                        'CAL-Cal??ada',
                        'CAM-Caminho',
                        'CAN-Canal',
                        'CH-Ch??cara',
                        'CHA-Chapad??o',
                        'CIC-Ciclovia',
                        'CIR-Circular',
                        'CJ-Conjunto',
                        'CJM-Conjunto Mutir??o',
                        'CMP-Complexo Vi??rio',
                        'COL-Col??nia',
                        'COM-Comunidade',
                        'CON-Condom??nio',
                        'COR-Corredor',
                        'CPO-Campo',
                        'CRG-C??rrego',
                        'CTN-Contorno',
                        'DSC-Descida',
                        'DSV-Desvio',
                        'DT-Distrito',
                        'EB-Entre Bloco',
                        'EIM-Estrada Intermunicipal',
                        'ENS-Enseada',
                        'ENT-Entrada Particular',
                        'EQ-Entre Quadra',
                        'ESC-Escada',
                        'ESD-Escadaria',
                        'ESE-Estrada Estadual',
                        'ESI-Estrada Vicinal',
                        'ESL-Estrada de Liga????o',
                        'ESM-Estrada Municipal',
                        'ESP-Esplanada',
                        'ESS-Estrada de Servid??o',
                        'EST-Estrada',
                        'ESV-Estrada Velha',
                        'ETA-Estrada Antiga',
                        'ETC-Esta????o',
                        'ETD-Est??dio',
                        'ETN-Est??ncia',
                        'ETP-Estrada Particular',
                        'ETT-Estacionamento',
                        'EVA-Evang??lica',
                        'EVD-Elevada',
                        'EX-Eixo Industrial',
                        'FAV-Favela',
                        'FAZ-Fazenda',
                        'FER-Ferrovia',
                        'FNT-Fonte',
                        'FRA-Feira',
                        'FTE-Forte',
                        'GAL-Galeria',
                        'GJA-Granja',
                        'HAB-N??cleo Habitacional',
                        'IA-Ilha',
                        'IND-Indeterminado',
                        'IOA-Ilhota',
                        'JD-Jardim',
                        'JDE-Jardinete',
                        'LD-Ladeira',
                        'LGA-Lagoa',
                        'LGO-Lago',
                        'LOT-Loteamento',
                        'LRG-Largo',
                        'LT-Lote',
                        'MER-Mercado',
                        'MNA-Marina',
                        'MOD-Modulo',
                        'MRG-Proje????o',
                        'MRO-Morro',
                        'MTE-Monte',
                        'NUC-N??cleo',
                        'NUR-N??cleo Rural',
                        'OUT-Outeiro',
                        'PAR-Paralela',
                        'PAS-Passeio',
                        'PAT-P??tio',
                        'PC-Pra??a',
                        'PCE-Pra??a de Esportes',
                        'PDA-Parada',
                        'PDO-Paradouro',
                        'PNT-Ponta',
                        'PR-Praia',
                        'PRL-Prolongamento',
                        'PRM-Parque Municipal',
                        'PRQ-Parque',
                        'PRR-Parque Residencial',
                        'PSA-Passarela',
                        'PSG-Passagem',
                        'PSP-Passagem de Pedestre',
                        'PSS-Passagem Subterr??nea',
                        'PTE-Ponte',
                        'PTO-Porto',
                        'Q-Quadra',
                        'QTA-Quinta',
                        'QTS-Quintas',
                        'R-Rua',
                        'R I-Rua Integra????o',
                        'R L-Rua de Liga????o',
                        'R P-Rua Particular',
                        'R V-Rua Velha',
                        'RAM-Ramal',
                        'RCR-Recreio',
                        'REC-Recanto',
                        'RER-Retiro',
                        'RES-Residencial',
                        'RET-Reta',
                        'RLA-Ruela',
                        'RMP-Rampa',
                        'ROA-Rodo Anel',
                        'ROD-Rodovia',
                        'ROT-Rotula',
                        'RPE-Rua de Pedestre',
                        'RPR-Margem',
                        'RTN-Retorno',
                        'RTT-Rotat??ria',
                        'SEG-Segunda Avenida',
                        'SIT-Sitio',
                        'SRV-Servid??o',
                        'ST-Setor',
                        'SUB-Subida',
                        'TCH-Trincheira',
                        'TER-Terminal',
                        'TR-Trecho',
                        'TRV-Trevo',
                        'TUN-T??nel',
                        'TV-Travessa',
                        'TVP-Travessa Particular',
                        'TVV-Travessa Velha',
                        'UNI-Unidade',
                        'V-Via',
                        'V C-Via Coletora',
                        'V L-Via Local',
                        'VAC-Via de Acesso',
                        'VAL-Vala',
                        'VCO-Via Costeira',
                        'VD-Viaduto',
                        'V-E-Via Expressa',
                        'VER-Vereda',
                        'VEV-Via Elevado',
                        'VL-Vila',
                        'VLA-Viela',
                        'VLE-Vale',
                        'VLT-Via Litor??nea',
                        'VPE-Via de Pedestre',
                        'VRT-Variante',
                        'ZIG-Zigue-Zague'
                    ]
                ?>
                @foreach($tipo as $tipos)
                    @if($tipos === $empresas->escomplemento)
                        <option selected >{{$empresas->escomplemento}}</option>
                    @else
                        <option >{{$tipos}}</option>
                    @endif
                @endforeach
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control @error('bairro') is-invalid @enderror" value="{{$empresas->esbairro}}" name="bairro" id="bairro">
                @error('bairro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-8">
                <label for="localidade" class="form-label">Municipio</label>
                <input type="text" class="form-control @error('localidade') is-invalid @enderror" value="{{$empresas->esmunicipio}}" name="localidade" id="localidade">
                @error('localidade')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="uf" class="form-label">UF</label>
                <input type="text" class="form-control @error('uf') is-invalid @enderror" value="{{$empresas->esuf}}" name="uf" id="uf">
                @error('uf')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                 
            <div class="col-md-4">
                <label for="reponsave" class="form-label">Respons??vel</label>
                <input type="text" class="form-control @error('responsave') is-invalid @enderror" value="{{$empresas->esresponsavel}}" name="responsave" id="responsave">
                @error('responsave')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="cnpj__reponsavel" class="form-label">CPF Respons??vel</label>
                <input type="text" class="form-control " value="" name="cpf" id="cnpj__reponsavel">
                @error('')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{$empresas->esemail}}" name="email" id="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="seguro" class="form-label">Seguro</label>
                <input type="text" class="form-control @error('seguro') is-invalid @enderror" value="{{$empresas->esseguro}}" name="seguro" id="seguro">
                @error('seguro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="cnae__codigo" class="form-label">CNAE c??digo</label>
                <input type="text" class="form-control @error('cnae__codigo') is-invalid @enderror" value="{{$empresas->escnae}}" name="cnae__codigo" id="cnae__codigo">
                @error('cnae__codigo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="cod__municipio" class="form-label">C??digo Munic??pio</label>
                <input type="text" class="form-control @error('cod__municipio') is-invalid @enderror" value="{{$empresas->escodigomunicipio}}" name="cod__municipio" id="cod__municipio">
                @error('cod__municipio')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="sincalizado" class="form-label">Sindicalizado</label>
                <select id="sincalizado" name="sincalizado"  class="form-select">
                    @if($empresas->escodigomunicipio === '1-Sim')
                    <option selected>1-Sim</option>
                    <option>2-N??o</option>
                    @else
                    <option>1-Sim</option>
                    <option selected>2-N??o</option>
                    @endif
                </select>
            </div>

            <div class="col-md-2 d-none">
                <label for="retem__ferias" class="form-label">Retem F??rias</label>
                <select id="retem__ferias" name="retem__ferias" class="form-select">
                    @if($empresas->esretemferias === '1-Sim')
                    <option selected>1-Sim</option>
                    <option>2-N??o</option>
                    @else
                    <option>1-Sim</option>
                    <option selected>2-N??o</option>
                    @endif
                </select>
            </div>

            <div class="col-md-4">
                <label for="contribuicao__sindicato" class="form-label">Contribui????o ao Sindicato</label>
                <input type="text" class="form-control @error('contribuicao__sindicato') is-invalid @enderror" name="contribuicao__sindicato" value="{{$empresas->escondicaosindicato}}" id="contribuicao__sindicato">
                @error('contribuicao__sindicato')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{$empresas->estelefone}}" id="telefone">
                @error('telefone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <h1 class="title__atualiza--empresa">Contadores <i class="fad fa-abacus"></i></h1>
            
            <div class="col-md-3">
                <label for="nro__fatura" class="form-label">Fatura <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de faturas cadastradas"></i></label>
                <input type="text" class="form-control" name="nro__fatura" id="nro__fatura"  maxlength="9">
            </div>
            
            <div class="col-md-3">
                <label for="nro__reciboavulso" class="form-label">Recibo Avulso <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de recibos avulsos cadastrados"></i></label>
                <input type="text" class="form-control" name="nro__reciboavulso" id="nro__reciboavulso"  maxlength="9">
            </div>

            <div class="col-md-3">
                <label for="nro__boletins" class="form-label">Boletins  <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de boletins cadastrados"></i></label>
                <input type="text" class="form-control" name="nro__boletins" id="nro__boletins"  maxlength="9">
            </div>
            
            <div class="col-md-3">
                <label for="nro__folha" class="form-label">Nro Folha  <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de folhas calculadas"></i></label>
                <input type="text" class="form-control" name="nro__folha" id="nro__folha"  maxlength="9">
            </div>
            
            <div class="col-md-3">
                <label for="nro__cartaoponto" class="form-label">Cart??o Ponto <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de cart??es pontos cadastrados"></i></label>
                <input type="text" class="form-control" name="nro__cartaoponto" id="nro__cartaoponto"  maxlength="9">
            </div>
            
            <div class="col-md-3">
                <label for="seq__esocial" class="form-label">E-Social <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title=""></i></label>
                <input type="text" class="form-control" name="seq__esocial" id="seq__esocial"  maxlength="9">
            </div>

            <div class="col-md-3">
                <label for="matric__trabalhador" class="form-label">Trabalhador <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de trabalhadores cadastrados"></i></label>
                <input type="text" class="form-control" name="matric__trabalhador" id="matric__trabalhador" >
            </div>
            
            <div class="col-md-3">
                <label for="matric__tomador" class="form-label">Tomador <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Quantidade de tomadores cadastrados"></i></label>
                <input type="text" class="form-control" name="matric__tomador" id="matric__tomador" >
            </div>
        
            
        </form>
    </div>
</section>


        <script>
            
            function BotaoAlterafoto() {
                (async () => {
                    const { value: file } = await Swal.fire({
                    title: 'Selecione sua imagem',
                    input: 'file',
                    confirmButtonText:'Enviar <i class="far fa-paper-plane"></i>',
                    inputAttributes: {
                        'accept': 'image/*',
                        'aria-label': 'Upload your profile picture', 
                        'class': 'false'
                    }
                    })

                    if (file) {
                        var ext = ['jpg','jpeg','png','svg','tiff','webp']
                        var type = file.type.split('/')
                        if (file.size < 3145728) {
                            if (ext.indexOf(type[1]) >= 1) {
                                const reader = new FileReader()
                                reader.onload = (e) => {
                                    Swal.fire({
                                    title: 'Foto atualizada!!',
                                    imageUrl: e.target.result,
                                    imageAlt: 'Foto atualizada',
                                    confirmButtonText:'Ok',
                                    })
                                    var myFormData = new FormData();
                                    myFormData.append('image_file', e.target.result);
                                    myFormData.append('_token','{{ csrf_token() }}')
                                    myFormData.append('empresa',"{{$user->empresa}}")
                                    $.ajax({
                                        url: "{{url('foto/editer')}}",
                                        type: 'POST',
                                        data: myFormData,
                                        cache: false,
                                        processData: false,
                                        contentType: false,
                                        beforeSend: function() {    
                                        },  
                                        complete: function() {  
                                        },              
                                        success: function(data) {
                                            $('#foto').attr('src',e.target.result)
                                            $('#inputfoto').val(e.target.result)       
                                        },
                                    })
                                }
                                reader.readAsDataURL(file)
                            }else{
                                $('#msgfoto').removeClass('d-none').text('A extens??o n??o ?? suportada. Apenas(jpg, png,svg,tiff,webp)')
                            }
                        } else {
                            Swal.showValidationMessage('O tamanho suportado ?? de at?? 3MB')
                            $('#msgfoto').removeClass('d-none').text('O tamanho suportado ?? de at?? 3MB');
                        }  
                        
                }
            })()  
            }
           
        </script>
@stop