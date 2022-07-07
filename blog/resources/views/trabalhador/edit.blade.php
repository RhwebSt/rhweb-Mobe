@extends('layouts.index')
@section('titulo','Editar Trabalhador - Rhweb')
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

        <form class="row g-3" action="{{ route('trabalhador.atualizar',$trabalhador->id) }}" method="POST">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{ route('trabalhador.novo') }}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <button type="submit" id="atualizar" class="btn botao"><i id="animacaoAtualizar" class="fad fa-sync-alt"></i> Atualizar</button>
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalTrabalhador">
                        <i class="fad fa-list-ul"></i> Lista
                    </a>
                </div>
            </section>
            
            <h1 class="title__pagina--padrao">Identificação do Trabalhador <i class="fad fa-user-hard-hat"></i></h1>
            
            @csrf
            @method('put')
            <section class="foto__trabalhador">
                @if($trabalhador->tsfoto === null)
                <img class="trabfoto" id="trabfoto" src="{{url('imagem/iconFotoTrab.jpg')}}" alt="foto do trabalhador">
                @else
                <img class="trabfoto" id="trabfoto" src="{{$trabalhador->tsfoto}}" alt="foto do trabalhador">
                @endif
                <div class="col-md-4 div__input--foto">
                    <label for="formFileSm " class="form-label"><i class="fad fa-lg fa-camera-alt"></i> Foto do Trabalhador</label>
                    <input class="form-control form-control-sm color__input--foto" onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
                    <span id="msgfoto" class="text-danger"></span>
                    
                    <button  type="button" class="btn botao mt-2" data-bs-toggle="modal" data-bs-target="#modalCamera"><i class="fad fa-camera"></i> Tirar foto</button>
                </div>
            </section>

            <input type="hidden" name="foto" id="foto" value="{{$trabalhador->tsfoto}}">
            <input type="hidden" name="endereco" id="endereco" value="{{$trabalhador->endereco[0]->eiid}}">
            <input type="hidden" name="bancario" id="bancario" value="{{$trabalhador->bancario[0]->biid}}">
            
            <div class="col-md-6">
                <label for="nome__completo" class="form-label">Nome Completo</label>
                <input type="text" class="form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" id="nome__completo" value="{{$trabalhador->tsnome}}">
                @error('nome__completo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
    
            <div class="col-md-6">
                <label for="nome__social" class="form-label"><input type="checkbox" name="radio_social" id="radio" data-toggle="tooltip" data-placement="top" title="Deseja tornar esse nome como padrão? clique" /> Nome Social (Opcional) </label>
                <input type="text" class="form-control @error('nome__social') is-invalid @enderror" value="{{$trabalhador->tsnomesocial}}" maxlength="100" name="nome__social" id="nome__social">
                @error('nome__social')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-md-4">
                    <label for="rg" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> RG</label>
                    <input type="text" class="form-control @error('rg') is-invalid @enderror" value="{{$trabalhador->arquivo[0]->dstipo === 'rg'? $trabalhador->arquivo[0]->dsnumero:''}}" name="rg" id="rg" maxlength="8" placeholder="Ex: 0000-000">
                    @error('rg')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            
            <div class="col-md-4">
                  <label for="ufRg" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> UF <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="UF referente ao RG"></i></label>
                  <input type="text" class="form-control @error('ufRg') is-invalid @enderror" value="{{$trabalhador->arquivo[0]->dstipo === 'rg'? $trabalhador->arquivo[0]->dsuf:''}}" name="ufRg" id="ufRg" maxlength="2" placeholder="Ex: SC">
                  @error('ufRg')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            
            <div class="col-md-4">
                  <label for="dataEmissaoRg" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data de Emissão <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Data de emissão do RG"></i></label>
                  <input type="date" class="form-control @error('dataEmissaoRg') is-invalid @enderror" value="{{$trabalhador->arquivo[0]->dstipo === 'rg'? $trabalhador->arquivo[0]->dsemissao:''}}" name="dataEmissaoRg" id="dataEmissaoRg" maxlength="15">
                  @error('dataEmissaoRg')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control cpf-mask @error('cpf') is-invalid @enderror" name="cpf" id="cpf" maxlength="15" value="{{$trabalhador->tscpf}}">
                @error('cpf')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-md-3">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" id="matricula" value="{{$trabalhador->tsmatricula}}" readonly>
                @error('matricula')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="col-md-3">
                <label for="pis" class="form-label">PIS</label>
                <input type="text" class="form-control @error('pis') is-invalid @enderror" name="pis" id="pis" value="{{$trabalhador->documento[0]->dspis}}">
                @error('pis')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>


            <div class="col-md-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" name="sexo" class="form-select">
                    @if($trabalhador->tssexo === 'Masculino')
                    <option selected>Masculino</option>
                    <option>Feminino</option>
                    <option>Outro</option>
                    @elseif($trabalhador->tssexo === 'Feminino')
                    <option>Masculino</option>
                    <option selected>Feminino</option>
                    <option>Outro</option>
                    @else
                    <option>Masculino</option>
                    <option>Feminino</option>
                    <option selected>Outro</option>
                    @endif
                </select>
            </div>

            <div class="col-md-6">
                <label for="estado__civil" class="form-label">Estado Civil</label>
                <select id="estado__civil" name="estado__civil" class="form-select" value="">
                    <?php
                        $civil = [
                          '1-Solteiro',
                          '2-Casado',
                          '3-Divorciados',
                          '4-Separados',
                          '5-Viúvo',
                        ];
                    ?>
                    @foreach($civil as $civis)
                        @if($trabalhador->nascimento[0]->nscivil === $civis)
                          <option selected>{{$civis}}</option>
                        @else
                          <option>{{$civis}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="raca" class="form-label">Raça</label>
                <select id="raca" name="raca" class="form-select">
                    <?php
                      $raca = [
                        '1-Branco',
                        '2-Preta',
                        '3-Pardo',
                        '4-Amarela',
                        '5-Indígena',
                        '6-Não informado',
                      ];
                    ?>
                     @foreach($raca as $racas)
                        @if($trabalhador->nascimento[0]->nsraca === $racas)
                          <option selected>{{$racas}}</option>
                        @else
                          <option>{{$racas}}</option>
                        @endif
                    @endforeach
             
                </select>
            </div>

            <div class="col-md-6">
                <label for="grau__instrucao" class="form-label">Grau de Instrução</label>
                <select id="grau__instrucao" name="grau__instrucao" class="form-select" value="">
                    <?php
                      $escolaridade = [
                            '01-Analfabetos'
                            ,'02-Até o 5º incompleto do ensino fundamental'
                            ,'03-5º ano completo do ensino fundamental'
                            ,'04-Do 6º ao 9º ano do ensino fundamental incompleto (antiga 5ª a 8ª série)'
                            ,'05-Ensino Fundamental Completo'
                            ,'06-Ensino Médio Incompleto'
                            ,'07-Ensino Médio Completo'
                            ,'08-Educação superior incompleta'
                            ,'09-Educação superior completa'
                            ,'10-Pós-graduação completa'
                            ,'11-Mestrado completo'
                            ,'12-Doutorado completo'
                      ];
                    ?>
                    @foreach($escolaridade as $escolaridades)
                      @if($trabalhador->tsescolaridade === $escolaridades)
                        <option selected>{{$escolaridades}}</option>
                      @else
                        <option>{{$escolaridades}}</option>
                      @endif
                    @endforeach
                </select>
            </div>


            <div class="col-md-6">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" name="data_nascimento" id="data_nascimento" value="{{$trabalhador->nascimento[0]->nsnascimento}}">
                @error('data_nascimento')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>


            <div class="col-md-6">
                <label for="pais__nascimento" class="form-label">País de Nascimento</label>
                <input type="text" list="pais_nascimento_list" class="form-control @error('pais__nascimento') is-invalid @enderror" name="pais__nascimento" id="pais__nascimento" value="{{$trabalhador->nascimento[0]->nsnaturalidade}}">
                @error('pais__nascimento')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
                <datalist id="pais_nascimento_list"></datalist>
            </div>
            

            <div class="col-md-6">
                <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
                <input type="text" list="pais_nacionalidade_list" class="form-control @error('pais__nacionalidade') is-invalid @enderror" name="pais__nacionalidade" id="pais__nacionalidade" value="{{$trabalhador->nascimento[0]->nsnacionalidade}}">
                @error('pais__nacionalidade')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="pais_nacionalidade_list"></datalist>
            </div>

            <div class="col-md-6">
                <label for="nome__mae" class="form-label">Nome da Mãe</label>
                <input type="text" class="form-control @error('nome__mae') is-invalid @enderror" name="nome__mae" id="nome__mae" value="{{$trabalhador->tsmae}}">
                @error('nome__mae')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>
    
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" id="telefone" value="{{$trabalhador->tstelefone}}">
                @error('telefone')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>
    
    
            <section class="section__accoordion row">
                                    
                <div class="accordion div__acordion" id="accordionFlushExample">

                    <div class="accordion-item item__acorddion">
                            
                        <h2 class="accordion-header accoordion__header" id="contrato">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#localResidencia" aria-expanded="false" aria-controls="localResidencia">
                                Local de Residência <i class="ms-1 fad fa-map-marked-alt"></i>
                              </button>
                        </h2>
                        
                        <div id="localResidencia" class="accordion-collapse collapse" aria-labelledby="contrato" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                                
                                <section class="row residencia">
                                
                                    <div class="col-md-3 mt-2">
                                      <label for="cep" class="form-label letter__color">Cep</label>
                                      <input type="text" class="form-control @error('cep') is-invalid @enderror" name="cep" id="cep" value="{{$trabalhador->endereco[0]->escep}}">
                                      @error('cep')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                
                                
                                    <div class="col-md-7 mt-2">
                                      <label for="logradouro" class="form-label letter__color">Rua</label>
                                      <input type="text" class="form-control @error('logradouro') is-invalid @enderror" name="logradouro" id="logradouro" value="{{$trabalhador->endereco[0]->eslogradouro}}">
                                      @error('logradouro')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                    <div class="col-md-2 mt-2">
                                      <label for="numero" class="form-label letter__color">Número</label>
                                      <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" id="numero" value="{{$trabalhador->endereco[0]->esnum}}">
                                      @error('numero')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                
                                    </div>
                                
        
                                    <div class="col-md-4 mt-2">
                                      <label for="tipoconstrucao" class="form-label letter__color">Tipo</label>
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
                                        @if($complementos === $trabalhador->endereco[0]->escomplemento)
                                        <option selected>{{$trabalhador->endereco[0]->escomplemento}}</option>
                                        @else
                                        <option>{{$complementos}}</option>
                                        @endif
                                        @endforeach
                                      </select>
                                    </div>
                                
                                    <div class="col-md-8 mt-2">
                                      <label for="bairro" class="form-label letter__color">Bairro</label>
                                      <input type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro" id="bairro" value="{{$trabalhador->endereco[0]->esbairro}}">
                                      @error('bairro')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                
                                    <div class="col-md-8 mt-2">
                                      <label for="localidade" class="form-label letter__color">Municipio</label>
                                      <input type="text" class="form-control @error('localidade') is-invalid @enderror" name="localidade" id="localidade" value="{{$trabalhador->endereco[0]->esmunicipio}}">
                                      @error('localidade')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                      <label for="uf" class="form-label letter__color">UF</label>
                                      <input type="text" class="form-control @error('uf') is-invalid @enderror" name="uf" id="uf" value="{{$trabalhador->endereco[0]->esuf}}">
                                      @error('uf')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                </section>
                                
                            </div>
                            
                        </div>
                            
                    </div>
                        
                        
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="contrato">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contratoTrabalho" aria-expanded="false" aria-controls="contratoTrabalho">
                                Contrato de Trabalho <i class="ms-1 fad fa-file-contract"></i>
                              </button>
                        </h2>
                        
                        <div id="contratoTrabalho" class="accordion-collapse collapse" aria-labelledby="contrato" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                                
                                <section class="row contrato__trabalho">
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="data__admissao" class="form-label letter__color">Data de Admissão</label>
                                      <input type="date" class="form-control @error('data__admissao') is-invalid @enderror" name="data__admissao" id="data__admissao" value="{{$trabalhador->categoria[0]->csadmissao}}">
                                      @error('data__admissao')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="categoria" class="form-label letter__color">Categoria</label>
                                      <input type="text" list="categoria_list" class="form-control @error('categoria__contrato') is-invalid @enderror" name="categoria__contrato" id="categoria" value="{{$trabalhador->categoria[0]->cscategoria}}">
                                      @error('categoria__contrato')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                      <datalist id="categoria_list">
                                          </datalist>
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="cbo" class="form-label letter__color">CBO</label>
                                      <input type="text" class="form-control @error('cbo') is-invalid @enderror" name="cbo" id="cbo" value="{{$trabalhador->categoria[0]->cbo}}">
                                      @error('cbo')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="ctps" class="form-label letter__color">CTPS</label>
                                      <input type="text" class="form-control @error('ctps') is-invalid @enderror" name="ctps" id="ctps" value="{{$trabalhador->documento[0]->dsctps}}">
                                      @error('ctps')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="serie__ctps" class="form-label letter__color">Série</label>
                                      <input type="text" class="form-control @error('serie__ctps') is-invalid @enderror" name="serie__ctps" id="serie__ctps" value="{{$trabalhador->documento[0]->dsserie}}">
                                      @error('serie__ctps')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="uf__ctps" class="form-label letter__color">UF</label>
                                      <input type="text" class="form-control @error('uf__ctps') is-invalid @enderror" name="uf__ctps" id="uf__ctps" value="{{$trabalhador->documento[0]->dsuf}}">
                                      @error('uf__ctps')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="situacao__contrato" class="form-label letter__color">Situação</label>
                                     
                                      <select name="situacao__contrato" id="situacao__contrato" class="form-select">
                                     
                                        <?php
                                          $situacao=['Ativo','Inativo','Afastado','Em processo'];
                                        ?>
                                        @foreach($situacao as $situacaos)
                                          @if($situacaos === $trabalhador->categoria[0]->cssituacao)
                                            <option selected>{{$situacaos}}</option>
                                          @else
                                          <option >{{$situacaos}}</option>
                                          @endif
                                        @endforeach
                                      </select>
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="data__afastamento" class="form-label letter__color">Data de Afastamento</label>
                                      <input type="date" class="form-control @error('data__afastamento') is-invalid @enderror" name="data__afastamento" id="data__afastamento" value="{{$trabalhador->categoria[0]->csafastamento}}">
                                      @error('data__afastamento')
                                      <span class="text-danger">{{ $message }}</span> 
                                      @enderror
                                      
                                    </div>
                                
                                </section>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                        
                        
                    <div class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="banco">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dadosBancarios" aria-expanded="false" aria-controls="dadosBancarios">
                                Dados Bancários<i class="ms-1 fad fa-university"></i>
                              </button>
                        </h2>
                        
                        <div id="dadosBancarios" class="accordion-collapse collapse" aria-labelledby="banco" data-bs-parent="#accordionFlushExample">
                            
                            <div class="accordion-body row">
                                <section class="dados__bancarios row">
                                
                                    <div class="col-md-4 mt-2">
                                      <label for="banco" class="form-label letter__color">Banco</label>
                                      <input type="text" class="form-control" name="banco" id="banco" value="{{$trabalhador->bancario[0]->bsbanco}}">
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                      <label for="agencia" class="form-label letter__color">Agência</label>
                                      <input type="text" class="form-control" name="agencia" id="agencia" value="{{$trabalhador->bancario[0]->bsagencia}}">
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                      <label for="operacao" class="form-label letter__color">Operação</label>
                                      <input type="text" class="form-control" name="operacao" id="operacao" value="{{$trabalhador->bancario[0]->bsoperacao}}">
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                      <label for="conta" class="form-label letter__color">Conta</label>
                                      <input type="text" class="form-control" name="conta" id="conta" value="{{$trabalhador->bancario[0]->bsconta}}">
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                      <label for="pix" class="form-label letter__color">PIX</label>
                                      <input type="text" class="form-control" name="pix" id="pix" value="{{$trabalhador->bancario[0]->bspix}}">
                                    </div>
                                
                                </section>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </section>
        </form>
    </div>
    @include('trabalhador.lista')
    @include('trabalhador.modalCamera')
</main>

<script type="text/javascript" src="{{url('/js/user/trabalhador/editar.js')}}"></script>

@stop