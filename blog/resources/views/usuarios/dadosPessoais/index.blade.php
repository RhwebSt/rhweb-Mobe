@extends('layouts.index')
@section('titulo','Dados Pessoais - Rhweb')
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


        <form class="row g-3" id="form" action="{{ route('dados.cadastro') }}" method="POST">
            @csrf
           
            
            <section class="section__botao--padrao">
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao">
                        <i class="fad fa-save"></i> Salvar
                    </button>
                </div>
            </section>
   
            <h1 class="title__pagina--padrao">Dados Pessoais <i class="fad fa-user-cog"></i></h1>

            <input type="hidden" name="user" value="{{$user->id}}">
            <input type="hidden" name="trabalhador">
            <input type="hidden" name="empresa">
            <input type="hidden" name="tomador">
            
            <div class="col-md-8">
                <label for="nome" class="form-label ">Nome</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" value="{{$pessoais->name}}" name="nome" id="nome" placeholder="Ex:Maria">
                @error('nome')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-4">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control @error('cpf') is-invalid @enderror" value="{{isset($pessoais->pscpf) ? $pessoais->pscpf : 'Default'}}" name="cpf" id="cpf" placeholder="Ex: 000.000.000-00">
                @error('cpf')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control @error('data__nascimento') is-invalid @enderror" value="{{isset($pessoais->psnascimento) ? $pessoais->psnascimento : 'Default'}}" name="data__nascimento"  id="data__nascimento">
                @error('data__nascimento')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"  value="{{$pessoais->email}}" name="email" id="email" placeholder="Ex: email@email.com">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control @error('telefone') is-invalid @enderror" value="{{isset($pessoais->pstelefone) ? $pessoais->pstelefone : ''}}" name="telefone" id="telefone" placeholder="Ex:(00) 00000-0000">
                @error('telefone')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control @error('cep') is-invalid @enderror" maxlength="16" value="{{isset($pessoais->escep) ? $pessoais->escep : ''}}" name="cep" id="cep" placeholder="Ex: 00000-000">
                @error('cep')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-8">
                <label for="logradouro" class="form-label">Rua</label>
                <input type="text" class="form-control  @error('logradouro') is-invalid @enderror" maxlength="50" value="{{isset($pessoais->eslogradouro) ? $pessoais->eslogradouro : ''}}" name="logradouro" id="logradouro">
                @error('logradouro')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="numero" class="form-label">N??mero</label>
                <input type="text" class="form-control @error('numero') is-invalid @enderror" maxlength="10" value="{{isset($pessoais->esnum) ? $pessoais->esnum : ''}}" name="numero" id="numero">
                @error('numero')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3"> 
                <label for="tipoconstrucao" class="form-label">Tipo</label>
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
                    @if(isset($pessoais->escomplemento))
                        @if($tipos === $pessoais->escomplemento)
                            <option selected >{{$pessoais->escomplemento}}</option>
                        @else
                            <option >{{$tipos}}</option>
                        @endif
                    @else
                        <option >{{$tipos}}</option>
                    @endif
                @endforeach
                </select> 
            </div>
                    
            <div class="col-md-5">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control @error('bairro') is-invalid @enderror" maxlength="40"  value="{{isset($pessoais->esbairro) ? $pessoais->esbairro : ''}}" name="bairro" id="bairro">
                @error('bairro')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-8">
                <label for="localidade" class="form-label">Municipio</label>
                <input type="text" class="form-control @error('localidade') is-invalid @enderror" maxlength="30" value="{{isset($pessoais->esmunicipio) ? $pessoais->esmunicipio : ''}}" name="localidade" id="localidade">
                @error('localidade')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="uf" class="form-label">UF</label>
                <input type="text" class="form-control @error('uf') is-invalid @enderror" maxlength="2" value="{{isset($pessoais->esuf) ? $pessoais->esuf : ''}}" name="uf" id="uf">
                @error('uf')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </form>
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/dadosPessoais/index.js')}}"></script>
@stop