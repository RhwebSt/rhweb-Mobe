@extends('layouts.index')
@section('titulo','Rhweb - Editar Tomador')
@section('conteine')
<div class="container ">
    @if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            width: 500,
            color: '#ffffff',
            background: '#5AA300',
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
            icon: 'success',
            title: '{{session("success")}}'
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
            title: '{{$message}}'
        })
    </script>
    @enderror
    @error('tabelavazia')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Tabela de preço vazia',
            text: '{{ $message }}',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
        })
    </script>
    @enderror
    @error('dadosvazia')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Algo deu errado!',
            text: '{{ $message }}',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
        })
    </script>
    @enderror




    <form class="row g-3 mt-1 mb-3  g-3 needs-validation" novalidate id="form" action="{{ route('tomador.update',$tomador->id) }}" method="Post">
        <!-- <input type="hidden" name="tomador" id="tomador"> -->
        <!-- <input type="hidden" name="pessoal"> -->
        <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
            <button type="submit" id="atualizar" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
            <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                <i class="fa-solid fa-list"></i> Lista
            </a>
            <a class="btn botao" href="{{route('home.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
        </div>


        <script>
            function botaoModal() {

                Swal.fire({
                    title: 'Periodo',
                    html: '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
                        '<input type="date" name="final" id="swal-input2" class="swal2-input">',
                    inputLabel: 'teste',
                    confirmButtonText: 'Buscar',
                    showDenyButton: true,
                    denyButtonText: 'Sair',
                    showConfirmButton: true,
                    focusConfirm: false,
                    preConfirm: () => {
                        if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                            Swal.showValidationMessage('Preencha todos os campos')
                        } else {
                            let inicio = document.getElementById('swal-input1').value
                            let final = document.getElementById('swal-input2').value
                            let tomador = document.getElementById('tomador').value
                            location.href = `{{url('boletim/tomador')}}/${tomador}/${inicio}/${final}`;
                        }

                    }
                });
            }
        </script>


        <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa"" required>
                        <div id=" mensagem-pesquisa" class="invalid-feedback">
</div>


<div class="container text-center mb-3  fs-4 fw-bold">Dados da Empresa <i class="fad fa-building"></i></div>
@csrf
<input type="hidden" id="method" name="_method" value="PUT">
<!-- <input type="hidden" name="empresa" value=""> -->
<!-- <input type="hidden" name="trabalhador"> -->

<div class="col-md-4">
    <label for="cnpj" class="form-label">CNPJ
        <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
    </label>
    <input type="text" class="form-control  fw-bold text-dark @error('cnpj') is-invalid @enderror valid" name="cnpj" value="{{$tomador->tscnpj}}" id="cnpj">
    @error('cnpj')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-4">
    <label for="tipo" class="form-label">Tipo </label>
    <select id="tipo" name="tipo" class="form-select fw-bold text-dark">
        @if($tomador->tstipo === '1-CNPJ')
        <option selected>1-CNPJ</option>
        <option>2-CPF</option>
        @else
        <option>1-CNPJ</option>
        <option selected>2-CPF</option>
        @endif
    </select>
</div>

<div class="col-md-4">
    <label for="simple" class="form-label">Simples</label>
    <select name="simples" id="simple" class="form-select fw-bold text-dark">
        @if($tomador->tssimples === 'Não')
        <option selected>Não</option>
        <option>Sim</option>
        @else
        <option>Não</option>
        <option selected>Sim</option>
        @endif
    </select>
    @error('simples')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-6">
    <label for="nome__completo" class="form-label ">Nome Completo</label>
    <input type="text" class="form-control input @error('nome__completo') is-invalid @enderror  fw-bold text-dark valid" value="{{$tomador->tsnome}}" name="nome__completo" id="nome__completo">
    @error('nome__completo')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-6">
    <label for="nome__fantasia" class="form-label"><input type="checkbox" id="radio" name="radio_fantasia" /> Nome Fantasia</label>
    <input type="text" class="form-control input fw-bold text-dark @error('nome__fantasia') is-invalid @enderror valid" name="nome__fantasia" value="{{$tomador->tsfantasia}}" id="nome__fantasia">
    @error('nome__fantasia')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<script>
    var radio = document.getElementById("radio");
    var radioResult = radio.value;
    if ('{{$tomador->tsstatusfantasia}}' === 'on') {
        radio.checked = true;
    }

    radio.addEventListener('click', function() {

        if (radio.checked) {

            Swal.fire({
                icon: 'warning',
                title: 'Deseja definir esse nome como padrão?',
                showDenyButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'Sim <i class="far fa-check-circle"></i>',
                confirmButtonColor: '#40A06B',
                denyButtonText: `Não <i class="far fa-times-circle"></i>`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Definido com sucesso!!', '', 'success');
                    radio.checked = true;
                } else if (result.isDenied) {
                    Swal.fire('Nada foi alterado!!', '', 'info')
                    radio.checked = false;
                }
            })

        }
    })
</script>


<div class="col-md-4">
    <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock"></i></label>
    <input type="text" disabled class="form-control  fw-bold text-dark @error('matricula') is-invalid @enderror" value="{{$tomador->tsmatricula}}" id="matricula">
    <input type="hidden" value="{{$tomador->tsmatricula}}" name="matricula" id="matriculaid">
    @error('matricula')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>



<div class="col-md-4">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control input fw-bold text-dark @error('telefone') is-invalid @enderror valid" name="telefone" value="{{$tomador->tstelefone}}" id="telefone">
    @error('telefone')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Endereço <i class="fad fa-map-marked-alt"></i></h1>

<div class="col-md-3">
    <label for="cep" class="form-label">CEP</label>
    <input type="text" class="form-control input fw-bold text-dark @error('cep') is-invalid @enderror valid" name="cep" value="{{$tomador->escep}}" id="cep">
    @error('cep')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-7">
    <label for="logradouro" class="form-label">Rua</label>
    <input type="text" class="form-control input fw-bold text-dark  @error('logradouro') is-invalid @enderror valid" name="logradouro" value="{{$tomador->eslogradouro}}" id="logradouro">
    @error('logradouro')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-2">
    <label for="numero" class="form-label">Número</label>
    <input type="text" class="form-control input fw-bold text-dark @error('numero') is-invalid @enderror valid" name="numero" value="{{$tomador->esnum}}" id="numero">
    @error('numero')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-4">
    <label for="complemento__endereco" class="form-label">Tipo</label>
    <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold text-dark">
        <?php
        $complemento = [
            'A-Área',
            'AC-Acesso',
            'ACA-Acampamento',
            'ACL-Acesso Local',
            'AE-Área Especial',
            'AER-Aeroporto',
            'AL-Alameda',
            'ALD-Aldeia',
            'AMD-Avenida Marginal Direita',
            'AME-Avenida Marginal Esquerda',
            'AN-Anel Viário',
            'ANT-Antiga Estrada',
            'ART-Artéria',
            'AT-Alto',
            'ATL-Atalho',
            'A V-Área Verde',
            'AV-Avenida',
            'AVC-Avenida Contorno',
            'AVM-Avenida Marginal',
            'AVV-Avenida Velha',
            'BAL-Balneário',
            'BC-Beco',
            'BCO-Buraco',
            'BL-Bloco',
            'BLO-Balão',
            'BLV-Bulevar',
            'BSQ-Bosque',
            'BVD-Boulevard',
            'BX-Baixa',
            'C-Cais',
            'CAL-Calçada',
            'CAM-Caminho',
            'CAN-Canal',
            'CH-Chácara',
            'CHA-Chapadão',
            'CIC-Ciclovia',
            'CIR-Circular',
            'CJ-Conjunto',
            'COL-Colônia',
            'COM-Comunidade',
            'CON-Condomínio',
            'COR-Corredor',
            'CPO-Campo',
            'CGR-Córrego',
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
            'ESL-Estrada de Ligação',
            'ESM-Estrada Municipal',
            'ESP-Esplanada',
            'ESS-Estrada de Servidão',
            'EST-Estrada',
            'ESV-Estrada Velha',
            'ETA-Estrada Antiga',
            'ETC-Estação',
            'ETC-Estádio',
            'ETN-Estância',
            'ETP-Estrada Particular',
            'ETT-Estacionamento',
            'EVA-Evangélica',
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
            'HAB-Núcleo Habitacional',
            'IA-Ilha',
            'IGP-Igarapé',
            'IND-Indeterminado',
            'IOA-Ilhota',
            'JD-Jardim',
            'JDE-Jardinete',
            'LD-Ladeira',
            'LGA-Lagoa',
            'LGO-Lago',
            'LOT-Loteamento',
            'LRG- Largo',
            'LT-Lote',
            'MER-Mercado',
            'MNA-Marina',
            'MOD-Modulo',
            'MRG-Projeção',
            'MRO-Morro',
            'MTE-Monte',
            'NUC-Núcleo',
            'NUR-Núcleo Rural',
            'O-Outros',
            'OUT-Outeiro',
            'PAR-Paralela',
            'PAS-Passeio',
            'PAT-Pátio',
            'PC-Praça',
            'PCE-Praça de Esportes',
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
            'PSP- Passagem de Pedestre',
            'PSS-Passagem Subterrânea',
            'PTE-Ponte',
            'PTO-Porto',
            'Q-Quadra',
            'QTA-Quinta',
            'QTS-Quintas',
            'R-Rua',
            'R I-Rua Integração',
            'R L-Rua de Ligação',
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
            'RTT-Rotatória',
            'SEG-Segunda Avenida',
            'SIT-Sitio',
            'SRV-Servidão',
            'ST-Setor',
            'SUB-Subida',
            'TCH-Trincheira',
            'TER-Terminal',
            'TR-Trecho',
            'TRV-Trevo',
            'TUN-Túnel',
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
            'VLE- Vale',
            'VLT-Via Litorânea',
            'VPE-Via de Pedestre',
            'VRT-Variante',
            'ZIG- Zigue-Zague'
        ];
        ?>
        @foreach($complemento as $complementos)
        @if($complementos === $tomador->escomplemento)
        <option selected>{{$tomador->escomplemento}}</option>
        @else
        <option>{{$complementos}}</option>
        @endif
        @endforeach

    </select>
</div>

<div class="col-md-8">
    <label for="bairro" class="form-label">Bairro</label>
    <input type="text" class="form-control input fw-bold text-dark @error('bairro') is-invalid @enderror valid" name="bairro" value="{{$tomador->esbairro}}" id="bairro">
    @error('bairro')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-8">
    <label for="localidade" class="form-label">Municipio</label>
    <input type="text" class="form-control input fw-bold text-dark  @error('localidade') is-invalid @enderror valid" name="localidade" value="{{$tomador->esmunicipio}}" id="localidade">
    @error('localidade')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="col-md-4">
    <label for="uf" class="form-label">UF</label>
    <input type="text" class="form-control input fw-bold text-dark @error('uf') is-invalid @enderror valid" name="uf" value="{{$tomador->esuf}}" id="uf">
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
    <input type="text" class="form-control input fw-bold text-dark @error('taxa_adm') is-invalid @enderror" name="taxa_adm" value="{{$tomador->tftaxaadm}}" id="taxa_adm">
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
    <input type="text" class="form-control input fw-bold text-dark  @error('taxa__fed') is-invalid @enderror" name="taxa__fed" value="{{$tomador->tftaxafed}}" id="taxa__fed">
    @error('taxa__fed')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-3">
    <label for="deflator" class="form-label">% DEFLATOR</label>
    <input type="text" class="form-control input fw-bold text-dark @error('deflator') is-invalid @enderror" name="deflator" value="{{$tomador->tfdefaltor}}" id="deflator">
    @error('deflator')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-3">
    <label for="das" class="form-label">DAS %</label>
    <input type="text" class="form-control @error('das') is-invalid @enderror input fw-bold text-dark" name="das" value="{{$tomador->tfdas}}" id="das">
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
    <input type="text" class="form-control input fw-bold text-dark @error('cod__fpas') is-invalid @enderror " name="cod__fpas" value="{{$tomador->psfpas}}" id="cod__fpas">
    @error('cod__fpas')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="cod__fap" class="form-label">Cod RAT</label>
    <input type="text" class="form-control input fw-bold text-dark @error('cod__fap') is-invalid @enderror " name="cod__fap" value="{{$tomador->psconfpas}}" id="cod__fap">
    @error('cod__fap')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="cod__grps" class="form-label">Cod GRPS</label>
    <input type="text" class="form-control @error('cod__grps') is-invalid @enderror input fw-bold text-dark" name="cod__grps" value="{{$tomador->psgrps}}" id="cod__grps">
    @error('cod__grps')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="cod__recol" class="form-label">Cod Recol</label>
    <input type="text" class="form-control @error('cod__recol') is-invalid @enderror input fw-bold text-dark" name="cod__recol" value="{{$tomador->psresol}}" id="cod__recol">
    @error('cod__recol')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="cnae" class="form-label">CNAE</label>
    <input type="text" class="form-control @error('cnae') is-invalid @enderror input fw-bold text-dark" name="cnae" value="{{$tomador->pscnae}}" id="cnae">
    @error('cnae')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="fap__aliquota" class="form-label">FAP Aliquota %</label>
    <input type="text" class="form-control @error('fap__aliquota') is-invalid @enderror input fw-bold text-dark" name="fap__aliquota" value="{{$tomador->psfapaliquota}}" id="fap__aliquota">
    @error('fap__aliquota')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="rat__ajustado" class="form-label">RAT Ajustado %</label>
    <input type="text" class="form-control @error('rat__ajustado') is-invalid @enderror input fw-bold text-dark" name="rat__ajustado" value="{{$tomador->psratajustados}}" id="rat__ajustado">
    @error('rat__ajustado')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="fpas__terceiros" class="form-label">FPAS Terceiros</label>
    <input type="text" class="form-control @error('fpas__terceiros') is-invalid @enderror input fw-bold text-dark" name="fpas__terceiros" value="{{$tomador->psfpasterceiros}}" id="fpas__terceiros">
    @error('fpas__terceiros')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="aliq__terceiros" class="form-label">Aliq. Terceiros</label>
    <input type="text" class="form-control @error('aliq__terceiros') is-invalid @enderror input fw-bold text-dark" name="aliq__terceiros" value="{{$tomador->psaliquotaterceiros}}" id="aliq__terceiros">
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
    <input type="text" class="form-control @error('alimentacao') is-invalid @enderror input fw-bold text-dark" name="alimentacao" value="{{$tomador->isalimentacao}}" id="alimentacao">
    @error('alimentacao')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-2">
    <label for="transporte" class="form-label">Transporte</label>
    <input type="text" class="form-control @error('transporte') is-invalid @enderror input fw-bold text-dark" name="transporte" value="{{$tomador->istransporte}}" id="transporte">
    @error('transporte')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-5">
    <label for="epi" class="form-label">EPI % (Sobre(PROD+RSR)Folha)</label>
    <input type="text" class="form-control @error('epi') is-invalid @enderror input fw-bold text-dark" name="epi" value="{{$tomador->isepi}}" id="epi">
    @error('epi')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="seguro__trabalhador" class="form-label">Seguro (Val.Trab)</label>
    <input type="text" class="form-control @error('seguro__trabalhador') is-invalid @enderror input fw-bold text-dark" name="seguro__trabalhador" value="{{$tomador->isseguroportrabalhador}}" id="seguro__trabalhador">
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


<div class="col-md-6">
    <label for="folhartransporte" class="form-label">VT Transporte</label>
    <input type="text" class="form-control @error('folhartransporte') is-invalid @enderror input fw-bold text-dark" name="folhartransporte" value="{{$tomador->instransporte}}" id="folhartransporte">
    @error('folhartransporte')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-3 d-none">
    <label for="folhartipotrans" class="form-label">Tipo</label>
    <select class="form-select fw-bold text-dark" id="folhartipotrans" name="folhartipotrans" aria-label="Default select example">
        <option selected>1</option>
        <option>2</option>
    </select>
</div>
<div class="col-md-6">
    <label for="folharalim" class="form-label">VA Alimentação</label>
    <input type="text" class="form-control @error('folharalim') is-invalid @enderror input fw-bold text-dark" name="folharalim" value="{{$tomador->insalimentacao}}" id="folharalim">
    @error('folharalim')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-3 d-none">
    <label for="folhartipoalim" class="form-label">Tipo</label>
    <select class="form-select fw-bold text-dark" id="folhartipoalim" name="folhartipoalim" aria-label="Default select example">
        <option selected>1</option>
        <option>2</option>
    </select>
</div>
<h1 class="container text-center mt-4 mb-3  fs-4 fw-bold">Informação para o Cartão Ponto <i class="fad fa-clock"></i></h1>

<div class="col-md-4">
    <label for="dias_uteis" class="form-label">Dias Úteis</label>
    <input type="time" class="form-control @error('dias_uteis') is-invalid @enderror input fw-bold text-dark" name="dias_uteis" value="{{$tomador->csdiasuteis}}" id="dias_uteis">
    @error('dias_uteis')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-4">
    <label for="sabados" class="form-label">Sábados</label>
    <input type="time" class="form-control @error('sabados') is-invalid @enderror input fw-bold text-dark" name="sabados" value="{{$tomador->cssabados}}" id="sabados">
    @error('sabados')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-4">
    <label for="domingos" class="form-label">Domingos</label>
    <input type="time" class="form-control @error('domingos') is-invalid @enderror input fw-bold text-dark" name="domingos" value="{{$tomador->csdomingos}}" id="domingos">
    @error('domingos')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<h1 class="container text-center mt-4 mb-3  fs-4 fw-bold d-none">Retenções na Fatura <i class="fad fa-calculator"></i></h1>


<div class="col-md-3 d-none">
    <label for="inss__empresa" class="form-label">INSS Empresa %</label>
    <input type="text" class="form-control @error('inss__empresa') is-invalid @enderror input fw-bold text-dark" name="inss__empresa" value="" id="inss__empresa">
    @error('inss__empresa')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-3 d-none">
    <label for="retencaoinss" class="form-label">Retenção INSS</label>
    <select class="form-select fw-bold text-dark" id="retencaoinss" name="retencaoinss" aria-label="Default select example">

        <option selected>SIM</option>
        <option>NÃO</option>

    </select>
</div>
<div class="col-md-3 d-none">
    <label for="fgts__empresa" class="form-label">FGTS Empresa %</label>
    <input type="text" class="form-control @error('fgts__empresa') is-invalid @enderror input fw-bold text-dark" name="fgts__empresa" value="" id="fgts__empresa">
    @error('fgts__empresa')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="col-md-3 d-none">
    <label for="retencaofgts" class="form-label">Retenção FGTS</label>
    <select class="form-select fw-bold text-dark" id="retencaofgts" name="retencaofgts" aria-label="Default select example">
        <option selected>SIM</option>
        <option>NÃO</option>
    </select>
</div>
<div class="col-md-3 d-none">
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
    <input type="text" class="form-control @error('banco') is-invalid @enderror input fw-bold text-dark " aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="{{$tomador->bsbanco}}" id="banco">
    <div id="menssagem-banco" class="valid-feedback">

    </div>
    @error('banco')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-2">
    <label for="agencia" class="form-label">Agência</label>
    <input type="text" class="form-control @error('agencia') is-invalid @enderror input fw-bold text-dark" name="agencia" value="{{$tomador->bsagencia}}" id="agencia">
    @error('agencia')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-2">
    <label for="operacao" class="form-label">Operação</label>
    <input type="text" class="form-control @error('operacao') is-invalid @enderror input fw-bold text-dark" name="operacao" value="{{$tomador->bsoperacao}}" id="operacao">
    @error('aperacao')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-2">
    <label for="conta" class="form-label">Conta</label>
    <input type="text" class="form-control @error('conta') is-invalid @enderror input fw-bold text-dark" name="conta" value="{{$tomador->bsconta}}" id="conta">
    @error('conta')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-3">
    <label for="pix" class="form-label">PIX</label>
    <input type="text" class="form-control @error('pix') is-invalid @enderror input fw-bold text-dark" name="pix" value="{{$tomador->bspix}}" id="pix">
    @error('pix')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<input type="hidden" name="endereco" value="{{$tomador->eiid}}" id="endereco">

<input type="hidden" name="bancario" value="{{$tomador->biid}}" id="bancario">
</div>

</form>
@include('tomador.lista')
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
            <form action="" method="post">
                @csrf
                <input type="hidden" name="trabalhador" id="trabalhador">

                <div class="modal-body modal-delbody">
                    <div class="mb-3 bg-dark p-2 rounded">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" name="tipo" value="option1">
                            <label class="form-check-label mt-1" for="inlineCheckbox1">Recibo Geral</label>
                        </div>
                        <div class="form-check form-check-inline d-none">
                            <input class="form-check-input" type="radio" id="inlineCheckbox2" name="tipo" value="option2">
                            <label class="form-check-label mt-1" for="inlineCheckbox2">Empresas Trabalhadas</label>
                        </div>
                        <!-- <div class="form-check d-none form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                  <label class="form-check-label mt-1" for="inlineCheckbox3">3 (disabled)</label>
                                </div> -->


                    </div>

                    <div>
                        <div class="col-md-12 mt-2 mb-2 p-1 pesquisar d-none">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                <datalist id="datalistOptions">
                                </datalist>
                                <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                <div class="text-center d-none" id="refres">
                                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                        <span class="visually-hidden">Carregando...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12  col-md-12  input">
                            <label for="ano" class="form-label">Data Inicial</label>
                            <input type="date" class="form-control " name="ano_inicial" value="" id="tano">
                        </div>

                        <div class="col-12  mt-2 col-md-12 ms-1 input">
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
    var nomeFantasia = document.querySelector('#nome__fantasia');

    nomeFantasia.addEventListener('input', function() {
        var nomeFantasia = document.querySelector('#nome__fantasia');
        var result = nomeFantasia.value;
        if (result > " ") {
            nomeFantasia.classList.add('is-valid');
        } else {
            nomeFantasia.classList.remove('is-valid');
        }

    });


    var nomeCompleto = document.querySelector('#nome__completo');

    nomeCompleto.addEventListener('input', function() {
        var nomeCompleto = document.querySelector('#nome__completo');
        var result = nomeCompleto.value;
        if (result > " ") {
            nomeCompleto.classList.add('is-valid');
        } else {
            nomeCompleto.classList.remove('is-valid');
        }

    });

    var telefone = document.querySelector('#telefone');

    telefone.addEventListener('input', function() {
        var telefone = document.querySelector('#telefone');
        var result = telefone.value;
        if (result > " " && result.length >= 15) {
            telefone.classList.add('is-valid');
        } else {
            telefone.classList.remove('is-valid');
        }

    });

    var cep = document.querySelector('#cep');

    cep.addEventListener('input', function() {
        var cep = document.querySelector('#cep');
        var result = cep.value;
        if (result > " " && result.length >= 9) {
            cep.classList.add('is-valid');
        } else {
            cep.classList.remove('is-valid');
        }

    });


    cep.addEventListener('focusout', function() {
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

    var logradouro = document.querySelector('#logradouro');

    logradouro.addEventListener('input', function() {
        var logradouro = document.querySelector('#logradouro');
        var result = logradouro.value;
        if (result > " ") {
            logradouro.classList.add('is-valid');
        } else {
            logradouro.classList.remove('is-valid');
        }

    });

    var numero = document.querySelector('#numero');

    numero.addEventListener('input', function() {
        var numero = document.querySelector('#numero');
        var result = numero.value;
        if (result > " ") {
            numero.classList.add('is-valid');
        } else {
            numero.classList.remove('is-valid');
        }

    });

    var bairro = document.querySelector('#bairro');

    bairro.addEventListener('input', function() {
        var bairro = document.querySelector('#bairro');
        var result = bairro.value;
        if (result > " ") {
            bairro.classList.add('is-valid');
        } else {
            bairro.classList.remove('is-valid');
        }

    });

    var localidade = document.querySelector('#localidade');

    localidade.addEventListener('input', function() {
        var localidade = document.querySelector('#localidade');
        var result = localidade.value;
        if (result > " ") {
            localidade.classList.add('is-valid');
        } else {
            localidade.classList.remove('is-valid');
        }

    });

    var uf = document.querySelector('#uf');

    uf.addEventListener('input', function() {
        var uf = document.querySelector('#uf');
        var result = uf.value;
        if (result > " " && result.length >= 2) {
            uf.classList.add('is-valid');
        } else {
            uf.classList.remove('is-valid');
        }

    });

    var diasUteis = document.querySelector('#dias_uteis');

    diasUteis.addEventListener('input', function() {
        var diasUteis = document.querySelector('#dias_uteis');
        var result = diasUteis.value;
        if (result > " ") {
            diasUteis.classList.add('is-valid');
        } else {
            diasUteis.classList.remove('is-valid');

        }

    });

    var sabados = document.querySelector('#sabados');

    sabados.addEventListener('input', function() {
        var sabados = document.querySelector('#sabados');
        var result = sabados.value;
        if (result > " ") {
            sabados.classList.add('is-valid');
        } else {
            sabados.classList.remove('is-valid');
        }

    });

    var domingos = document.querySelector('#domingos');

    domingos.addEventListener('input', function() {
        var domingos = document.querySelector('#domingos');
        var result = domingos.value;
        if (result > " ") {
            domingos.classList.add('is-valid');
        } else {
            domingos.classList.remove('is-valid');
        }

    });




    var botaolimpaCampos = document.querySelector("#refre");

    botaolimpaCampos.addEventListener('click', function() {
        var cnpj = document.querySelector("#cnpj").value = '';
        var nome = document.querySelector("#nome__completo").value = '';
        var nomeFantasia = document.querySelector("#nome__fantasia").value = '';
        var telefone = document.querySelector("#telefone").value = '';
        var cep = document.querySelector("#cep").value = '';
        var logradouro = document.querySelector("#logradouro").value = '';
        var numero = document.querySelector("#numero").value = '';
        var tipo = document.querySelector("#complemento__endereco").value = '';
        var bairro = document.querySelector("#bairro").value = '';
        var localidade = document.querySelector("#localidade").value = '';
        var uf = document.querySelector("#uf").value = '';
        var taxaAdm = document.querySelector("#taxa_adm").value = '';
        var taxaFed = document.querySelector("#taxa__fed").value = '';
        var defaltor = document.querySelector("#deflator").value = '';
        var das = document.querySelector("#das").value = '';
        var codFpas = document.querySelector("#cod__fpas").value = '';
        var codFap = document.querySelector("#cod__fap").value = '';
        var codGrps = document.querySelector("#cod__grps").value = '';
        var codRecol = document.querySelector("#cod__recol").value = '';
        var cnae = document.querySelector("#cnae").value = '';
        var fapAliquota = document.querySelector("#fap__aliquota").value = '';
        var ratAjustado = document.querySelector("#rat__ajustado").value = '';
        var fpasTerceiros = document.querySelector("#fpas__terceiros").value = '';
        var aliqTerceiros = document.querySelector("#aliq__terceiros").value = '';
        var alimentacao = document.querySelector("#alimentacao").value = '';
        var transporte = document.querySelector("#transporte").value = '';
        var epi = document.querySelector("#epi").value = '';
        var seguroTrabalhador = document.querySelector("#seguro__trabalhador").value = '';
        var vt = document.querySelector("#folhartransporte").value = '';
        var tipoVt = document.querySelector("#folhartipotrans").value = '';
        var va = document.querySelector("#folharalim").value = '';
        var tipoVa = document.querySelector("#folhartipoalim").value = '';
        var diasUteis = document.querySelector("#dias_uteis").value = '';
        var sabados = document.querySelector("#sabados").value = '';
        var domingos = document.querySelector("#domingos").value = '';
        var inssEmpresa = document.querySelector("#inss__empresa").value = '';
        var retencaoInss = document.querySelector("#retencaoinss").value = '';
        var fgtsEmpresa = document.querySelector("#fgts__empresa").value = '';
        var retencaoFgts = document.querySelector("#retencaofgts").value = '';
        var baseFatura = document.querySelector("#valor_fatura").value = '';
        var banco = document.querySelector("#banco").value = '';
        var agencia = document.querySelector("#agencia").value = '';
        var operacao = document.querySelector("#operacao").value = '';
        var conta = document.querySelector("#conta").value = '';
        var pix = document.querySelector("#pix").value = '';



    });








    $(document).ready(function() {

        $('#pesquisa').on('keyup focus', function() {
            var dados = '0';
            if ($(this).val()) {
                dados = $(this).val();
                if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                }
            }
            $('#icon').addClass('d-none').next().removeClass('d-none')
            $.ajax({
                url: "{{url('tomador')}}/pesquisa/" + dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    let nome = ''
                    $('#refres').addClass('d-none').prev().removeClass('d-none')
                    if (data.length >= 1) {
                        data.forEach(element => {
                            nome += `<option value="${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            // nome += `<option value="${element.tscnpj}">`
                        });
                        $('#listapesquisa').html(nome)
                    }
                    // if (data.length === 1 && dados.length >= 2) {
                    //     tomador(dados)
                    // } else if (dados.length === 14) {
                    //     pesquisa(dados)
                    // } else {
                    //     campo()
                    // }
                }
            });
        })
        $('#cnpj').on('change', function() {
            let dados = $(this).val();
            dados = dados.replace(/\D/g, '');
            pesquisa(dados)
        })

        function monta_dados(dados) {
            let novodados = dados.split('  ')
            return novodados[1];
        }

        function tomador(dados) {
            $('#carregamento').removeClass('d-none')
            $.ajax({
                url: "{{url('tomador')}}/" + dados,
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
            $('#relatoriotomador').addClass('disabled')
            $('#form').attr('action', "{{ route('tomador.store') }}");
            $('#incluir').removeAttr("disabled")
            $('#atualizar').attr('disabled', 'disabled')
            $('#deletar').attr('disabled', 'disabled')
            $('#method').val(' ')
            $('#excluir').attr("disabled", 'disabled')
            $('#tabelapreco').addClass('disabled').removeAttr('href')
            for (let index = 0; index < $('.input').length; index++) {
                $('.input').eq(index).val(' ')
            }
        }

        function carregado(data) {
            if (data.id) {
                $('#form').attr('action', "{{ url('tomador')}}/" + data.tomador);
                $('#formdelete').attr('action', "{{ url('tomador')}}/" + data.tomador)
                $('#incluir').attr('disabled', 'disabled')
                $('#atualizar').removeAttr("disabled")
                $('#deletar').removeAttr("disabled")
                $('#excluir').removeAttr("disabled")
                $('#tabelapreco').removeClass('disabled').attr('href', "{{ url('tabelapreco')}}/ /" + btoa(data.tomador))
                $('#esocial').removeClass('disabled').attr('href', "{{ url('esocial/tomador')}}/" + btoa(data.tomador))
                $('#method').val('PUT')
                $('#tomador').val(data.tomador);
                $('#relatoriotomador').removeClass('disabled')
            }
            $('#nome__completo').val(data.tsnome)
            $('#cnpj').val(data.tscnpj)
            $('#matricula').val(data.tsmatricula).next().text(' ')
            $('#matricularid').val(data.tsmatricula).next().text(' ')
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
            // $('#inss__empresa').val(data.rsinssempresa.toFixed(2).toString().replace(".", ","))
            // $('#fgts__empresa').val(data.rsfgts.toFixed(2).toString().replace(".", ","))
            // $('#valor_fatura').val(data.rsvalorfatura.toFixed(2).toString().replace(".", ","))
            $('#nome__conta').val(data.bstitular)
            $('#banco').val(data.bsbanco)
            $('#agencia').val(data.bsagencia)
            $('#operacao').val(data.bsoperacao)
            $('#cod__fap').val(data.psconfpas)
            $('#conta').val(data.bsconta)
            $('#pix').val(data.bspix)
            $('#folhartransporte').val(data.instransporte.toFixed(2).toString().replace(".", ","))
            $('#folharalim').val(data.insalimentacao.toFixed(2).toString().replace(".", ","))
            $('#deflator').val(data.tfdefaltor)
            $('#endereco').val(data.eiid)
            $('#bancario').val(data.biid)
            for (let index = 0; index < $('#tipo option').length; index++) {
                if (data.tstipo == $('#tipo option').eq(index).text()) {
                    $('#tipo option').eq(index).attr('selected', 'selected')
                } else {
                    $('#tipo option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#simple option').length; index++) {
                if (data.tssimples == $('#simple option').eq(index).text()) {
                    $('#simple option').eq(index).attr('selected', 'selected')
                } else {
                    $('#simple option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#complemento__endereco option').length; index++) {
                if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {

                    $('#complemento__endereco option').eq(index).attr('selected', 'selected')
                } else {
                    $('#complemento__endereco option').eq(index).removeAttr('selected')
                }
            }

            for (let index = 0; index < $('#folhartipotrans option').length; index++) {
                if (data.instipotrans == $('#folhartipotrans option').eq(index).text()) {

                    $('#folhartipotrans option').eq(index).attr('selected', 'selected')
                } else {
                    $('#folhartipotrans option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#folhartipoalim option').length; index++) {
                if (data.instipoali == $('#folhartipoalim option').eq(index).text()) {

                    $('#folhartipoalim option').eq(index).attr('selected', 'selected')
                } else {
                    $('#folhartipoalim option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#retencaofgts option').length; index++) {
                if (data.rstipofgts == $('#retencaofgts option').eq(index).text()) {

                    $('#retencaofgts option').eq(index).attr('selected', 'selected')
                } else {
                    $('#retencaofgts option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#retencaoinss option').length; index++) {
                if (data.rstipoinssempresa == $('#retencaoinss option').eq(index).text()) {

                    $('#retencaoinss option').eq(index).attr('selected', 'selected')
                } else {
                    $('#retencaoinss option').eq(index).removeAttr('selected')
                }
            }
            for (let index = 0; index < $('#valorfatura option').length; index++) {
                if (data.rsvalorfatura == $('#valorfatura option').eq(index).text()) {

                    $('#valorfatura option').eq(index).attr('selected', 'selected')
                } else {
                    $('#valorfatura option').eq(index).removeAttr('selected')
                }
            }
        }

        function pesquisa(dados) {
            $.ajax({
                url: "https://brasilapi.com.br/api/cnpj/v1/" + dados,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    // for (let index = 0; index < $('.input').length; index++) {
                    //     $('.input').eq(index).val(' ')
                    // }
                    if (data) {
                        $('#nome__completo').val(data.razao_social)
                        $('#nome__fantasia').val(data.nome_fantasia)
                        $('#telefone').val(data.ddd_telefone_1)
                        $('#cnae').val(data.cnae_fiscal)
                        $('#cep').val(data.cep)
                        $('#cnpj').val(data.cnpj.replace(/(\d{2})?(\d{3})?(\d{3})?(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"));
                        $('#logradouro').val(data.logradouro)
                        $('#numero').val(data.numero)
                        $('#bairro').val(data.bairro)
                        $('#localidade').val(data.municipio)
                        $('#uf').val(data.uf)
                        $('#telefone').val(data.ddd_telefone_1)
                        $('#complemento').val(data.descricao_tipo_logradouro)
                    } else {
                        $('#nome__completo').val(' ')
                        $('#nome__fantasia').val(' ')
                        $('#telefone').val(' ')
                        $('#cnae').val(' ')
                        $('#cep').val(' ')
                        // $('#cnpj').val(' ')
                        $('#logradouro').val(' ')
                        $('#numero').val(' ')
                        $('#bairro').val(' ')
                        $('#localidade').val(' ')
                        $('#uf').val(' ')
                        $('#telefone').val(' ')
                        $('#complemento').val(' ')
                    }
                    $("#pesquisa").removeClass('is-invalid')

                    $('#mensagem-pesquisa').text(' ').addClass('valid-feedback', ).removeClass('invalid-feedback')
                },
                error: function(data) {
                    // $("#pesquisa").addClass('is-invalid')
                    // $('#nome__completo').val(' ')
                    // $('#nome__fantasia').val('')
                    // $('#cnpj').val('')
                    // $('#telefone').val(' ')
                    // $('#cnae').val(' ')
                    // $('#mensagem-pesquisa').text( data.responseJSON.message).removeClass('valid-feedback').addClass('invalid-feedback')
                    $('#nome__completo').val(' ')
                    $('#nome__fantasia').val(' ')
                    $('#telefone').val(' ')
                    $('#cnae').val(' ')
                    $('#cep').val(' ')
                    // $('#cnpj').val(' ')
                    $('#logradouro').val(' ')
                    $('#numero').val(' ')
                    $('#bairro').val(' ')
                    $('#localidade').val(' ')
                    $('#uf').val(' ')
                    $('#telefone').val(' ')
                    $('#complemento').val(' ')
                }
            })
        }
    });
</script>

@stop