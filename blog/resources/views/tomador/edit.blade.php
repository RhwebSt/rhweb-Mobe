@extends('layouts.index')
@section('titulo','Editar Tomador - Rhweb')
@section('conteine')

<main role="main">
    <div class="container ">
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
        @error('tabelavazia')
            <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        html: '<p class="modal__aviso--title">Tabela de preço vazia</p>'+ '<p class="modal__aviso">{{ $message }}</p>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true,
                        background: '#45484A',
                        showConfirmButton: true,
                        timer: 5000,
                        customClass: {
                          title: 'modal__aviso',
                        }
                    })
            </script>
        @enderror
        @error('dadosvazia')
            <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        html: '<p class="modal__aviso--title">Algo deu errado!</p>'+ '<p class="modal__aviso">{{ $message }}</p>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true,
                        background: '#45484A',
                        showConfirmButton: true,
                        timer: 5000,
                        customClass: {
                          title: 'modal__aviso',
                        }
                    })
            </script>
        @enderror

        <form class="row g-3 mt-1 mb-3  g-3 needs-validation" novalidate id="form" action="{{ route('tomador.atualizar',$tomador->id) }}" method="Post">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('tomador.novo')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar</a>
                </div>

                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="atualizar" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#modalTomador">
                        <i class="fad fa-list-ul"></i> Lista
                    </a>
                    
                </div>
            
            </section>

            <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa" required>
            <div id=" mensagem-pesquisa" class="invalid-feedback"></div>
        
        
            <h1 class="title__pagina--padrao">Editar dados do Tomador <i class="fad fa-industry"></i></h1>  
            @csrf
            <input type="hidden" id="method" name="_method" value="PUT">

        
            <div class="col-md-4">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input type="text" class="form-control @error('cnpj') is-invalid @enderror valid" name="cnpj" value="{{$tomador->tscnpj}}" id="cnpj">
                @error('cnpj')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="col-md-4">
                <label for="tipo" class="form-label">Tipo </label>
                <select id="tipo" name="tipo" class="form-select">
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
                <select name="simples" id="simple" class="form-select">
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
        
            <div class="col-md-8">
                <label for="nome__completo" class="form-label ">Nome Completo</label>
                <input type="text" class="form-control @error('nome__completo') is-invalid @enderror  valid" value="{{$tomador->tsnome}}" name="nome__completo" id="nome__completo">
                @error('nome__completo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="col-md-4">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock"></i></label>
                <input type="text" disabled class="form-control  @error('matricula') is-invalid @enderror" value="{{$tomador->tsmatricula}}" id="matricula">
                <input type="hidden" value="{{$tomador->tsmatricula}}" name="matricula" id="matriculaid">
                @error('matricula')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="col-md-8">
                <label for="nome__fantasia" class="form-label"><input type="checkbox" id="radio" name="radio_fantasia" /> Nome Fantasia</label>
                <input type="text" class="form-control @error('nome__fantasia') is-invalid @enderror valid" name="nome__fantasia" value="{{$tomador->tsfantasia}}" id="nome__fantasia">
                @error('nome__fantasia')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control @error('telefone') is-invalid @enderror valid" name="telefone" value="{{$tomador->tstelefone}}" id="telefone">
                @error('telefone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <section class="section__accoordion row">
                                
                <div class="accordion div__acordion" id="accordionFlushExample">
                    
                    
                    <div class="accordion-item item__acorddion">
                                        
                        <h2 class="accordion-header accoordion__header" id="tomadorTaxas">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#endereco__accordion" aria-expanded="false" aria-controls="endereco__accordion">
                                    Endereço<i class="ms-1 fad fa-map-marked-alt"></i>
                              </button>
                        </h2>
                                
                        <div id="endereco__accordion" class="accordion-collapse collapse" aria-labelledby="tomadorTaxas" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                                
                                <section class="row endereco">
                                    
                                    <div class="col-md-3 mt-2">
                                        <label for="cep" class="form-label letter__color">CEP</label>
                                        <input type="text" class="form-control @error('cep') is-invalid @enderror valid" name="cep" value="{{$tomador->endereco[0]->escep}}" id="cep">
                                        @error('cep')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-7 mt-2">
                                        <label for="logradouro" class="form-label letter__color">Rua</label>
                                        <input type="text" class="form-control  @error('logradouro') is-invalid @enderror valid" name="logradouro" value="{{$tomador->endereco[0]->eslogradouro}}" id="logradouro">
                                        @error('logradouro')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-2 mt-2">
                                        <label for="numero" class="form-label letter__color">Número</label>
                                        <input type="text" class="form-control @error('numero') is-invalid @enderror valid" name="numero" value="{{$tomador->endereco[0]->esnum}}" id="numero">
                                        @error('numero')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mt-2">
                                        <label for="complemento__endereco" class="form-label letter__color">Tipo</label>
                                        <select name="complemento__endereco" id="complemento__endereco" class="form-select">
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
                                            @if($complementos === $tomador->endereco[0]->escomplemento)
                                            <option selected>{{$tomador->endereco[0]->escomplemento}}</option>
                                            @else
                                            <option>{{$complementos}}</option>
                                            @endif
                                            @endforeach
                                    
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-8 mt-2">
                                        <label for="bairro" class="form-label letter__color">Bairro</label>
                                        <input type="text" class="form-control @error('bairro') is-invalid @enderror valid" name="bairro" value="{{$tomador->endereco[0]->esbairro}}" id="bairro">
                                        @error('bairro')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-8 mt-2">
                                        <label for="localidade" class="form-label letter__color">Municipio</label>
                                        <input type="text" class="form-control  @error('localidade') is-invalid @enderror valid" name="localidade" value="{{$tomador->endereco[0]->esmunicipio}}" id="localidade">
                                        @error('localidade')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                    <div class="col-md-4 mt-2">
                                        <label for="uf" class="form-label letter__color">UF</label>
                                        <input type="text" class="form-control @error('uf') is-invalid @enderror valid" name="uf" value="{{$tomador->endereco[0]->esuf}}" id="uf">
                                        @error('uf')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                </section>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                    
                    
                    
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="tomadorTaxas">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#taxas" aria-expanded="false" aria-controls="taxas">
                                Taxas<i class="ms-1 fad fa-badge-percent"></i>
                              </button>
                        </h2>
                                        
                        <div id="taxas" class="accordion-collapse collapse" aria-labelledby="tomadorTaxas" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                            
                                <div class="col-md-3 mt-2">
                                    <label for="taxa_adm" class="form-label letter__color">Taxa Adm %</label>
                                    <input type="text" class="form-control @error('taxa_adm') is-invalid @enderror" name="taxa_adm" value="{{$tomador->taxa[0]->tftaxaadm}}" id="taxa_adm">
                                    @error('taxa_adm')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3 mt-2">
                                    <label for="taxa__fed" class="form-label letter__color">Taxa Fed. %</label>
                                    <input type="text" class="form-control  @error('taxa__fed') is-invalid @enderror" name="taxa__fed" value="{{$tomador->taxa[0]->tftaxafed}}" id="taxa__fed">
                                    @error('taxa__fed')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3 mt-2">
                                    <label for="deflator" class="form-label letter__color">% DEFLATOR</label>
                                    <input type="text" class="form-control @error('deflator') is-invalid @enderror" name="deflator" value="{{$tomador->taxa[0]->tfdefaltor}}" id="deflator">
                                    @error('deflator')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3 mt-2">
                                    <label for="das" class="form-label letter__color">DAS %</label>
                                    <input type="text" class="form-control @error('das') is-invalid @enderror" name="das" value="{{$tomador->taxa[0]->tfdas}}" id="das">
                                    @error('das')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="parametro__sefip">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sefip" aria-expanded="false" aria-controls="sefip">
                                Parâmetros SEFIP <i class="ms-1 fad fa-chart-bar"></i>
                              </button>
                        </h2>
                                        
                        <div id="sefip" class="accordion-collapse collapse" aria-labelledby="parametro__sefip" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                            
                                <div class="col-md-4 mt-2">
                                    <label for="cod__fpas" class="form-label letter__color">Cod FPAS</label>
                                    <input type="text" class="form-control @error('cod__fpas') is-invalid @enderror " name="cod__fpas" value="{{$tomador->parametrosefip[0]->psfpas}}" id="cod__fpas">
                                    @error('cod__fpas')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="cod__fap" class="form-label letter__color">Cod RAT</label>
                                    <input type="text" class="form-control @error('cod__fap') is-invalid @enderror " name="cod__fap" value="{{$tomador->parametrosefip[0]->psconfpas}}" id="cod__fap">
                                    @error('cod__fap')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="cod__grps" class="form-label letter__color">Cod GRPS</label>
                                    <input type="text" class="form-control @error('cod__grps') is-invalid @enderror" name="cod__grps" value="{{$tomador->parametrosefip[0]->psgrps}}" id="cod__grps">
                                    @error('cod__grps')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="cod__recol" class="form-label letter__color">Cod Recol</label>
                                    <input type="text" class="form-control @error('cod__recol') is-invalid @enderror" name="cod__recol" value="{{$tomador->parametrosefip[0]->psresol}}" id="cod__recol">
                                    @error('cod__recol')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="cnae" class="form-label letter__color">CNAE</label>
                                    <input type="text" class="form-control @error('cnae') is-invalid @enderror" name="cnae" value="{{$tomador->parametrosefip[0]->pscnae}}" id="cnae">
                                    @error('cnae')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="fap__aliquota" class="form-label letter__color">FAP Aliquota %</label>
                                    <input type="text" class="form-control @error('fap__aliquota') is-invalid @enderror" name="fap__aliquota" value="{{$tomador->parametrosefip[0]->psfapaliquota}}" id="fap__aliquota">
                                    @error('fap__aliquota')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="rat__ajustado" class="form-label letter__color">RAT Ajustado %</label>
                                    <input type="text" class="form-control @error('rat__ajustado') is-invalid @enderror" name="rat__ajustado" value="{{$tomador->parametrosefip[0]->psratajustados}}" id="rat__ajustado">
                                    @error('rat__ajustado')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="fpas__terceiros" class="form-label letter__color">FPAS Terceiros</label>
                                    <input type="text" class="form-control @error('fpas__terceiros') is-invalid @enderror" name="fpas__terceiros" value="{{$tomador->parametrosefip[0]->psfpasterceiros}}" id="fpas__terceiros">
                                    @error('fpas__terceiros')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="aliq__terceiros" class="form-label letter__color">Aliq. Terceiros</label>
                                    <input type="text" class="form-control @error('aliq__terceiros') is-invalid @enderror" name="aliq__terceiros" value="{{$tomador->parametrosefip[0]->psaliquotaterceiros}}" id="aliq__terceiros">
                                    @error('aliq__terceiros')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    
                    
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="fatura">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#indice__fatura" aria-expanded="false" aria-controls="indice__fatura">
                                Incide Sobre Fatura <i class="ms-1 fad fa-chart-line"></i>
                              </button>
                        </h2>
                                        
                        <div id="indice__fatura" class="accordion-collapse collapse" aria-labelledby="fatura" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                            
                                <div class="col-md-6 mt-2">
                                    <label for="alimentacao" class="form-label letter__color"> Alimentação</label>
                                    <input type="text" class="form-control @error('alimentacao') is-invalid @enderror" name="alimentacao" value="{{$tomador->indicefatura[0]->isalimentacao}}" id="alimentacao">
                                    @error('alimentacao')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    <label for="transporte" class="form-label letter__color">Transporte</label>
                                    <input type="text" class="form-control @error('transporte') is-invalid @enderror" name="transporte" value="{{$tomador->indicefatura[0]->istransporte}}" id="transporte">
                                    @error('transporte')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    <label for="epi" class="form-label letter__color">EPI % (Sobre(PROD+RSR)Folha)</label>
                                    <input type="text" class="form-control @error('epi') is-invalid @enderror" name="epi" value="{{$tomador->indicefatura[0]->isepi}}" id="epi">
                                    @error('epi')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    <label for="seguro__trabalhador" class="form-label letter__color">Seguro (Val.Trab)</label>
                                    <input type="text" class="form-control @error('seguro__trabalhador') is-invalid @enderror" name="seguro__trabalhador" value="{{$tomador->indicefatura[0]->isseguroportrabalhador}}" id="seguro__trabalhador">
                                    @error('seguro__trabalhador')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="folha">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#indiceFolha" aria-expanded="false" aria-controls="indiceFolha">
                                    Incide Sobre a Folha <i class="ms-1 fad fa-chart-line"></i>
                              </button>
                        </h2>
                                        
                        <div id="indiceFolha" class="accordion-collapse collapse" aria-labelledby="folha" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                            
                                
                                <div class="col-md-6 mt-2">
                                    <label for="folhartransporte" class="form-label letter__color">VT Transporte</label>
                                    <input type="text" class="form-control @error('folhartransporte') is-invalid @enderror" name="folhartransporte" value="{{$tomador->incidefolhar[0]->instransporte}}" id="folhartransporte">
                                    @error('folhartransporte')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3 d-none">
                                    
                                    <label for="folhartipotrans" class="form-label letter__color">Tipo</label>
                                    <select class="form-select" id="folhartipotrans" name="folhartipotrans" aria-label="Default select example">
                                        <option selected>1</option>
                                        <option>2</option>
                                    </select>
                                    
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    
                                    <label for="folharalim" class="form-label letter__color">VA Alimentação</label>
                                    <input type="text" class="form-control @error('folharalim') is-invalid @enderror" name="folharalim" value="{{$tomador->incidefolhar[0]->insalimentacao}}" id="folharalim">
                                    @error('folharalim')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>
                                
                                <div class="col-md-3 d-none">
                                    
                                    <label for="folhartipoalim" class="form-label letter__color">Tipo</label>
                                    <select class="form-select" id="folhartipoalim" name="folhartipoalim" aria-label="Default select example">
                                        <option selected>1</option>
                                        <option>2</option>
                                    </select>
                                    
                                </div>
                                
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    
                    
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="cartao">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cartaoPonto" aria-expanded="false" aria-controls="cartaoPonto">
                                    </i>Cartão Ponto <i class="ms-1 fad fa-clock"></i>
                              </button>
                        </h2>
                                        
                        <div id="cartaoPonto" class="accordion-collapse collapse" aria-labelledby="cartao" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                            
                                
                                <div class="col-md-4 mt-2">
                                    <label for="dias_uteis" class="form-label letter__color">Dias Úteis</label>
                                    <input type="time" class="form-control @error('dias_uteis') is-invalid @enderror" name="dias_uteis" value="{{$tomador->cartaoponto[0]->csdiasuteis}}" id="dias_uteis">
                                    @error('dias_uteis')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="sabados" class="form-label letter__color">Sábados</label>
                                    <input type="time" class="form-control @error('sabados') is-invalid @enderror" name="sabados" value="{{$tomador->cartaoponto[0]->cssabados}}" id="sabados">
                                    @error('sabados')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mt-2">
                                    <label for="domingos" class="form-label letter__color">Domingos</label>
                                    <input type="time" class="form-control @error('domingos') is-invalid @enderror" name="domingos" value="{{$tomador->cartaoponto[0]->csdomingos}}" id="domingos">
                                    @error('domingos')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="banco">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dadosBancarios" aria-expanded="false" aria-controls="dadosBancarios">
                                    Dados Bancários <i class="ms-1 fad fa-university"></i>
                              </button>
                        </h2>
                                        
                        <div id="dadosBancarios" class="accordion-collapse collapse" aria-labelledby="banco" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                            
                                
                                <div class="col-md-3 mt-2">
                                    <label for="banco" class="form-label letter__color">Banco</label>
                                    <input type="text" class="form-control @error('banco') is-invalid @enderror " aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="{{$tomador->bancario[0]->bsbanco}}" id="banco">
                                    <div id="menssagem-banco" class="valid-feedback">
                                
                                    </div>
                                    @error('banco')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-2 mt-2">
                                    <label for="agencia" class="form-label letter__color">Agência</label>
                                    <input type="text" class="form-control @error('agencia') is-invalid @enderror" name="agencia" value="{{$tomador->bancario[0]->bsagencia}}" id="agencia">
                                    @error('agencia')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-2 mt-2">
                                    <label for="operacao" class="form-label letter__color">Operação</label>
                                    <input type="text" class="form-control @error('operacao') is-invalid @enderror" name="operacao" value="{{$tomador->bancario[0]->bsoperacao}}" id="operacao">
                                    @error('aperacao')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-2 mt-2">
                                    <label for="conta" class="form-label letter__color">Conta</label>
                                    <input type="text" class="form-control @error('conta') is-invalid @enderror" name="conta" value="{{$tomador->bancario[0]->bsconta}}" id="conta">
                                    @error('conta')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3 mt-2">
                                    <label for="pix" class="form-label letter__color">PIX</label>
                                    <input type="text" class="form-control @error('pix') is-invalid @enderror" name="pix" value="{{$tomador->bancario[0]->bspix}}" id="pix">
                                    @error('pix')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    
                </div>
            </section>


        
        
            <input type="hidden" name="endereco" value="{{$tomador->eiid}}" id="endereco">
        
            <input type="hidden" name="bancario" value="{{$tomador->biid}}" id="bancario">

        </form>
        
        <section class="modal__delete--tomador">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" id="formdelete" method="post">
                            @csrf
                            @method('delete')
                                <div class="modal-header  header__modal">
                                    <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                </div>
                                <div class="modal-body body__modal">
                                        <p class="mb-1">Deseja realmente excluir?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn__deletar">Deletar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
                     
        </section>
        
    </div>
    @include('tomador.lista')
</main>
<script type="text/javascript" src="{{url('/js/user/tomador/edit.js')}}"></script>

    @stop