@extends('layouts.index')
@section('titulo','Rhweb - Cadastro do Trabalhador')
@section('conteine')

<main role="main">
    <div class="container">
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
          title: "{{session('success')}}"
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

        <form class="row g-3" id="form" action="{{ route('trabalhador.store') }}" enctype="multipart/form-data" method="POST">
            
            <section class="section__botoes--trabalhador">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>

                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                        <i class="fad fa-list-ul"></i> Lista
                    </a>

                </div>
            </section>

            <h1 class="title__trabalhador">Identificação do Trabalhador <i class="fad fa-user-hard-hat"></i></h1>
            
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="deflator">
            <input type="hidden" name="tomador">
            <input type="hidden" name="pessoal">
            <!-- <input type="hidden" name="empresa">  -->
            <input type="hidden" name="empresa" value="{{$user->empresa->id}}">
            
            <section class="foto__trabalhador">

                <img class="trabfoto" id="trabfoto" src="imagem/iconFotoTrab.jpg" alt="foto do trabalhador">

                <div class="col-md-4 div__input--foto">
                    <label for="formFileSm " class="form-label"><i class="fad fa-lg fa-camera-alt"></i> Foto do Trabalhador</label>
                    <input class="form-control form-control-sm color__input--foto" onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
                    <span id="msgfoto" class="text-danger"></span>
                </div>
                
            </section>
    
            <input type="hidden" name="foto" id="foto">
            

            <div class="col-md-6">
                  <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nome Completo</label>
                  <input type="text" class="form-control @error('nome__completo') is-invalid @enderror" value="{{old('nome__completo')}}" name="nome__completo" maxlength="40" id="nome__completo" placeholder="digite seu nome completo">
                  @error('nome__completo')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

            <div class="col-md-6">
                  <label for="nome__social" class="form-label"><input type="checkbox" name="radio_social" id="radio" data-toggle="tooltip" data-placement="top" title="Deseja tornar esse nome como padrão? clique" /> Nome Social (Opcional) </label>
                  <input type="text" class="form-control @error('nome__social') is-invalid @enderror" value="{{ old('nome__social')}}" maxlength="40" name="nome__social" id="nome__social" placeholder="digite seu nome social">
                  @error('nome__social')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

            <script>
              var radio = document.getElementById("radio");
              var radioResult = radio.value;
        
        
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

            <div class="col-md-3">
                  <label for="cpf" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CPF</label>
                  <input type="text" class="form-control cpf-mask @error('cpf') is-invalid @enderror" value="{{old('cpf')}}" name="cpf" id="cpf" maxlength="15" placeholder="Ex: 000.000.000-00">
                  @error('cpf')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

            <?php
            if (isset($valorrublica_matricular->valoresrublica[0]->vimatricular)) {
              $matricular = $valorrublica_matricular->valoresrublica[0]->vimatricular + 1;
            } else {
              $matricular = 1;
            }
            ?>
        
            <div class="col-md-3 ">
                  <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                  <input type="text" disabled class="form-control @error('matricula') is-invalid @enderror" value="{{$matricular}}" id="matricula" maxlength="6">
                  <input type="hidden" value="{{$matricular}}" name="matricula" id="matricularid">
                  @error('matricula')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
    
            <div class="col-md-3">
                  <label for="pis" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> PIS</label>
                  <input type="text" class="form-control @error('pis') is-invalid @enderror" value="{{old('pis')}}" name="pis" id="pis" maxlength="14" placeholder="Ex: 000.00000.00-0">
                  @error('pis')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
    
    
            <div class="col-md-3">
                  <label for="sexo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Sexo</label>
                  <select id="sexo" name="sexo" class="form-select">
                        <option selected>Masculino</option>
                        <option>Feminino</option>
                        <option>Outro</option>
                  </select>
            </div>
    
            <div class="col-md-6">
              <label for="estado__civil" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Estado Civil</label>
              <select id="estado__civil" name="estado__civil" class="form-select">
                    <option selected>1-Solteiro</option>
                    <option>2-Casado</option>
                    <option>3-Divorciados</option>
                    <option>4-Separados</option>
                    <option>5-Viúvo</option>
              </select>
            </div>
    
            <div class="col-md-6">
              <label for="raca" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Raça</label>
              <select id="raca" name="raca" class="form-select">
                    <option selected>1-Branco</option>
                    <option>2-Preta</option>
                    <option>3-Pardo</option>
                    <option>4-Amarela</option>
                    <option>5-Indígena</option>
                    <option>6-Não informado</option>
              </select>
            </div>
    
            <div class="col-md-6">
              <label for="grau__instrucao" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Grau de Instrução</label>
              <select id="grau__instrucao" name="grau__instrucao" class="form-select" value="">
                    <option selected>01-Analfabetos</option>
                    <option>02-Até o 5º incompleto do ensino fundamental</option>
                    <option>03-5º ano completo do ensino fundamental</option>
                    <option>04-Do 6º ao 9º ano do ensino fundamental incompleto (antiga 5ª a 8ª série)</option>
                    <option>05-Ensino Fundamental Completo</option>
                    <option>06-Ensino Médio Incompleto</option>
                    <option>07-Ensino Médio Completo</option>
                    <option>08-Educação superior incompleta</option>
                    <option>09-Educação superior completa</option>
                    <option>10-Pós-graduação completa</option>
                    <option>11-Mestrado completo</option>
                    <option>12-Doutorado completo</option>
              </select>
            </div>
    
    
            <div class="col-md-6">
                  <label for="data_nascimento" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data de Nascimento</label>
                  <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{old('data_nascimento')}}" maxlength="10" name="data_nascimento" id="data_nascimento">
                  @error('data_nascimento')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
    
    
            <div class="col-md-6">
                  <label for="pais__nascimento" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> País de Nascimento</label>
                  <input type="text" list="pais_nascimento_list" class="form-control @error('pais__nascimento') is-invalid @enderror" value="{{old('pais__nascimento')}}" maxlength="20" name="pais__nascimento" id="pais__nascimento" placeholder="clique e escolha o país de nascimento">
                  @error('pais__nascimento')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <datalist id="pais_nascimento_list">
                  </datalist>
            </div>
    
            <div class="col-md-6">
                  <label for="pais__nacionalidade" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> País de Nacionalidade</label>
                  <input type="text" list="pais_nacionalidade_list" class="form-control @error('pais__nacionalidade') is-invalid @enderror" value="{{old('pais__nacionalidade')}}" maxlength="20" name="pais__nacionalidade" id="pais__nacionalidade" placeholder="clique e escolha o país de nacionalidade">
                  @error('pais__nacionalidade')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <datalist id="pais_nacionalidade_list">
                  </datalist>
            </div>
    
            <div class="col-md-6">
                  <label for="nome__mae" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nome da Mãe</label>
                  <input type="text" class="form-control @error('nome__mae') is-invalid @enderror" value="{{old('nome__mae')}}" maxlength="40" name="nome__mae" id="nome__mae" placeholder="digite o nome da sua mãe">
                  @error('nome__mae')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>
        
            <div class="col-md-6">
                  <label for="telefone" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Telefone</label>
                  <input type="text" class="form-control @error('telefone') is-invalid @enderror" value="{{old('telefone')}}" name="telefone" id="telefone" value="" maxlength="15" placeholder="Ex: (00) 00000-0000">
                  @error('telefone')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

        
            <section  class="section__accoordion row">
                                
                <div class="accordion div__acordion" id="accordionFlushExample">
                    
                    
                    <div id="divEndereco" class="accordion-item item__acorddion">
                        
                        <h2 class="accordion-header accoordion__header" id="contrato">
                              <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#localResidencia" aria-expanded="false" aria-controls="localResidencia">
                                    <i class="fa-sm me-1 required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i>Local de Residência <i class="ms-1 fad fa-map-marked-alt"></i>
                              </button>
                        </h2>
                        
                        <div id="localResidencia" class="accordion-collapse collapse" aria-labelledby="contrato" data-bs-parent="#accordionFlushExample">
                            
                            <div id="endereco" class="accordion-body row">
                                
                                <section  class="row residencia">
                                
                                    <div class="col-md-3 mt-2">
                                          <label for="cep" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CEP <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Após preencher o cep aperte a tecla 'tab' ou clique em outro campo para que seja preenchido alguns dados automáticamente."></i></label>
                                          <input type="text" class="form-control @error('cep') is-invalid @enderror" maxlength="16" value="{{old('cep')}}" name="cep" id="cep" placeholder="Ex: 00000-000">
                                          @error('cep')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-7 mt-2">
                                          <label for="logradouro" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Rua</label>
                                          <input type="text" class="form-control @error('logradouro') is-invalid @enderror" maxlength="50" value="{{old('logradouro')}}" name="logradouro" id="logradouro" placeholder="Ex: Rua sem fim">
                                          @error('logradouro')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-2 mt-2">
                                          <label for="numero" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Número</label>
                                          <input type="text" class="form-control @error('numero') is-invalid @enderror" maxlength="6" value="{{old('numero')}}" name="numero" id="numero">
                                          @error('numero')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                
                                    <div class="col-md-4 mt-2">
                                          <label for="tipoconstrucao" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tipo</label>
                                          <select name="complemento__endereco" id="complemento__endereco" class="form-select">
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
                                    
                                    
                                    <div class="col-md-8 mt-2">
                                          <label for="bairro" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Bairro</label>
                                          <input type="text" class="form-control @error('bairro') is-invalid @enderror" maxlength="40" value="{{old('bairro')}}" name="bairro" id="bairro" placeholder="Ex: Eldorado">
                                          @error('bairro')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                
                                    <div class="col-md-8 mt-2">
                                          <label for="localidade" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Municipio</label>
                                          <input type="text" class="form-control @error('localidade') is-invalid @enderror" maxlength="40" value="{{old('localidade')}}" name="localidade" id="localidade" placeholder="Ex: Florianópolis">
                                          @error('localidade')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                          <label for="uf" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> UF</label>
                                          <input type="text" class="form-control @error('uf') is-invalid @enderror" maxlength="2" value="{{old('uf')}}" name="uf" id="uf" placeholder="Ex: SC">
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
                                          <input type="date" class="form-control @error('data__admissao') is-invalid @enderror" value="{{old('data__admissao')}}" name="data__admissao" id="data__admissao">
                                          @error('data__admissao')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                          <label for="categoria" class="form-label letter__color">Categoria</label>
                                          <input type="text" list="categoria_list" class="form-control @error('categoria__contrato') is-invalid @enderror" value="{{old('categoria__contrato')}}" maxlength="100" name="categoria__contrato" id="categoria" placeholder="clique ou digite para selecionar a categoria">
                                          @error('categoria__contrato')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                          <datalist id="categoria_list">
                                          </datalist>
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                          <label for="cbo" class="form-label letter__color">CBO</label>
                                          <input type="text" list="cbo_list" class="form-control @error('cbo') is-invalid @enderror" value="{{old('cbo')}}" name="cbo" id="cbo" value="" placeholder="clique ou digite para selecionar o cbo">
                                          @error('cbo')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                          <datalist id="cbo_list">
                                          </datalist>
                                    </div>
                                
                                
                                
                                    <div class="col-md-6 mt-2">
                                          <label for="ctps" class="form-label letter__color">CTPS</label>
                                          <input type="text" class="form-control @error('ctps') is-invalid @enderror" maxlength="20" value="{{old('ctps')}}" name="ctps" id="ctps" placeholder="Ex: 0000000">
                                          @error('ctps')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                          <label for="serie__ctps" class="form-label letter__color">Série</label>
                                          <input type="text" class="form-control @error('serie__ctps') is-invalid @enderror" value="{{old('serie__ctps')}}" name="serie__ctps" id="serie__ctps" placeholder="Ex:00000">
                                          @error('serie__ctps')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                          <label for="uf__ctps" class="form-label letter__color">UF</label>
                                          <input type="text" class="form-control @error('uf__ctps') is-invalid @enderror" value="{{old('uf__ctps')}}" name="uf__ctps" maxlength="2" id="uf__ctps" placeholder="Ex: SC">
                                          @error('uf__ctps')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                      <label for="situacao__contrato" class="form-label letter__color">Situação</label>
                                      <select name="situacao__contrato" id="situacao__contrato" class="form-select">
                                            <option selected>Ativo</option>
                                            <option>Inativo</option>
                                            <option>Afastado</option>
                                            <option>Em processo</option>
                                      </select>
                                    </div>
                                
                                    <div class="col-md-6 mt-2">
                                          <label for="data__afastamento" class="form-label letter__color">Data de Afastamento</label>
                                          <input type="date" class="form-control @error('data__afastamento') is-invalid @enderror" value="{{old('data__afastamento')}}" name="data__afastamento" id="data__afastamento">
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
                                          <input type="text" class="form-control @error('banco') is-invalid @enderror" aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="{{old('banco')}}" id="banco" placeholder="digite o número do seu banco">
                                          <div id="menssagem-banco" class="valid-feedback">
                                    
                                          </div>
                                          @error('banco')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                          <label for="agencia" class="form-label letter__color">Agência</label>
                                          <input type="text" class="form-control @error('agencia') is-invalid @enderror" name="agencia" value="{{old('agencia')}}" id="agencia" placeholder="Ex: 0000">
                                          @error('agencia')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                          <label for="operacao" class="form-label letter__color">Operação</label>
                                          <input type="text" class="form-control @error('operacao') is-invalid @enderror" name="operacao" value="{{old('operacao')}}" id="operacao" placeholder="Ex: 000">
                                          @error('aperacao')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div class="col-md-4 mt-2">
                                          <label for="conta" class="form-label letter__color">Conta</label>
                                          <input type="text" class="form-control @error('conta') is-invalid @enderror" name="conta" value="{{old('conta')}}" id="conta" placeholder="Ex: 00000000-0">
                                          @error('conta')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                    <div id="divpix" class="col-md-4 mt-2">
                                          <label for="pix" class="form-label letter__color">PIX</label>
                                          <input type="text" class="form-control @error('pix') is-invalid @enderror" name="pix" value="{{old('pix')}}" id="pix">
                                          @error('pix')
                                          <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                    </div>
                                
                                </section>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                
                </div>
                
            </section>

            <input type="hidden" name="endereco" id="endereco">
            <input type="hidden" name="bancario" id="bancario">

        </form>
        
        <section class="modal__excluir">
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                          <form action="" id="formdelete" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-header  header__modal">
                                      <h5 class="modal-title text-white fs-5" id="staticBackdropLabel"><i class="fad fa-trash"></i> Excluir</h5>
                                      <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                </div>
                                
                                <div class="modal-body body__modal">
                                      <p class="mb-2">Obs:( Caso exclua os dados do trabalhador seus depedentes serão excluidos.)</p>
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
</main>




@include('trabalhador.lista')

<script type="text/javascript" src="{{url('/js/cbo.js')}}"></script>

<script>


    // faz com que quando algum campo que está dentro do accordion não for preenchido//
            // ele abra e não deixe enviar o formulário até que tudo esteje preenchido.//
            function verificaCampoObrigatorioAccordion(){

                $('#incluir').click(function(e){
                    var cep = $('#cep').val();
                    var logradouro = $('#logradouro').val();
                    var numero = $('#numero').val();
                    var bairro = $('#bairro').val();
                    var localidade = $('#localidade').val();
                    var uf = $('#uf').val();
                    
                    let div = document.querySelector("#divEndereco");
                    let divCoordenadas = div.getBoundingClientRect();
                    
                    var valorBottom = divCoordenadas.y;
                    var valorTop = divCoordenadas.x;

                    if(cep, logradouro, numero, bairro, localidade, uf != ""){
                        $('#localResidencia').removeClass('show');
                        $('#localResidencia').removeClass('collapse');
                        event.defaultPrevented;
                        

                    }else{
                        e.preventDefault(); 
                        $('#localResidencia').addClass('show');
                        $('#localResidencia').addClass('collapse');
                        window.scrollTo(valorTop, valorBottom);
                        
                        
                    }

                });
                
                
            }
            
            verificaCampoObrigatorioAccordion();
            // fim da verificação do accordion//

    


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
    let paisnascimento = ''
    let cbolist = ''
    let categorialist = ''

    $('#pais__nacionalidade,#pais__nascimento').on('keyup focus', function() {
      if (!$(this).val()) {
        paisnascimento = ''
        paisnascimentolista(pais__nascimento)
      }
    })

    function paisnascimentolista(pais__nascimento) {
      pais__nascimento.forEach(element => {
        paisnascimento += `<option value="${element}">`
      });
      $('#pais_nascimento_list').html(paisnascimento)
      $('#pais_nacionalidade_list').html(paisnascimento)
    }
    paisnascimentolista(pais__nascimento)


    $('.form-check-input').click(function() {
      if ($(this).val() === 'option1') {
        $('#formrelatorioempresa').attr('action', "")
      } else if ($(this).val() === 'option2') {
        $('#formrelatorioempresa').attr('action', "")
      }
    })
    // $('#cbo').on('keyup focus', function() {
    //   // if (!$(this).val()) {
    //   //   cbolista(cbo);
    //   // }
    // })
    $.ajax({
      url: "{{route('administrador.cbo.pesquisa')}}",
      type: 'get',
      contentType: 'application/json',
      success: function(data) {
          let nome = ''
          data.forEach(element => {
              nome += `<option value="${element.cscodigo}-${element.csdescricao}">`
              // nome += `<option value="${element.csdescricao}">`
          });
          $('#cbo_list').html(nome)
      }
    })
    $.ajax({
        url: "{{route('administrador.categoria.pesquisa')}}",
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
            let nome = ''
            data.forEach(element => {
                nome += `<option value="${element.codigo}-${element.descricao}">`
                // nome += `<option value="${element.descricao}">`
            });
            $('#categoria_list').html(nome)
        }
    })
    // $('#categoria').on('keyup focus', function() {
    //   if (!$(this).val()) {
    //     listacategoria(categoriatrabalhador);
    //   }
    // })

    // function cbolista(cbo) {
    //   cbo.forEach(element => {
    //     cbolist += `<option value="${element.code} - ${element.name}">`
    //   });
    //   $('#cbo_list').html(cbolist)
    // }
    // cbolista(cbo)

    // function listacategoria(categoriatrabalhador) {
    //   categoriatrabalhador.forEach(element => {
    //     categorialist += `<option value="${element}">`
    //   });
    //   $('#categoria_list').html(categorialist);
    // }
    // listacategoria(categoriatrabalhador)
    $("#pesquisa").on('keyup focus', function() {
      let dados = '0'
      if ($(this).val()) {
        dados = $(this).val()
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados(dados);
        }
      }
      $('#icon').addClass('d-none').next().removeClass('d-none')
      $.ajax({
        url: "{{url('trabalhador')}}/pesquisa/" + dados,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          $('#trabfoto').removeAttr('src')
          $('#refres').addClass('d-none').prev().removeClass('d-none')
          let nome = ''
          if (data.length >= 1) {
            data.forEach(element => {
              nome += `<option value="${element.tsnome}">`
              // nome += `<option value="${element.tsmatricula}">`
              nome += `<option value="${element.tscpf}">`
            });
            $('#listapesquisa').html(nome)
          }
          // if(data.length === 1 && dados.length >= 4){
          //   buscaItem(dados)
          // }else{
          //   campo()
          // }              
        }
      });
    });

    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }

    function buscaItem(dados) {
      $('#carregamento').removeClass('d-none')
      $.ajax({
        url: "{{url('trabalhador')}}/" + dados,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          localStorage.setItem('hdHlKMtd', btoa(data.trabalhador));
          trabalhador(data)
          $('#carregamento').addClass('d-none')
        }
      });
    }
    // if (localStorage.getItem('hdHlKMtd')) {
    //   buscaItem(atob(localStorage.getItem('hdHlKMtd')))
    // }
    function campo() {
      $('#relatoriotrabalhador').addClass('disabled')
      $('#imprimir').addClass('disabled')
      $('#fichaepi').addClass('disabled')
      $('#depedente').addClass('disabled')
      $('#form').attr('action', "{{ route('trabalhador.store') }}");
      $('#incluir').removeAttr("disabled")
      $('#depedente').removeAttr("disabled")
      $('#atualizar').attr('disabled', 'disabled')
      $('#deletar').attr('disabled', 'disabled')
      $('#method').val(' ')
      $('#excluir').attr('disabled', 'disabled')
      for (let index = 0; index < $('.input').length; index++) {
        $('.input').eq(index).val(' ')
      }
    }

    function trabalhador(data) {
      if (data.trabalhador) {
        $('#form').attr('action', "{{ url('trabalhador')}}/" + data.trabalhador);
        $('#formdelete').attr('action', "{{ url('trabalhador')}}/" + data.trabalhador)
        $('#depedente').removeClass('disabled')
        $('#depedente').attr('href', "{{ url('depedente')}}/" + data.trabalhador + '/mostrar')
        $('#incluir').attr('disabled', 'disabled')
        $('#atualizar').removeAttr("disabled")
        $('#deletar').removeAttr("disabled")
        $('#excluir').removeAttr("disabled")

        $('#method').val('PUT')
        $('#recibopagamento').removeClass('disabled')
        $('#relatoriotrabalhador').removeClass('disabled')
        $('#imprimir').removeClass('disabled').attr('href', "{{url('ficha/registro/trabalhador')}}/" + btoa(data.trabalhador))
        $('#fichaepi').removeClass('disabled').attr('href', "{{url('epi')}}/" + btoa(data.trabalhador))
        $('#cracha').removeClass('disabled').attr('href', "{{url('cracha/trabalhador')}}/" + btoa(data.trabalhador))
        $('#declaracao__adm').removeClass('disabled').attr('href', "{{url('declaracao/admissao/trabalhador')}}/" + btoa(data.trabalhador))
        $('#declaracao__afas').removeClass('disabled').attr('href', "{{url('declaracao/afastamento/trabalhador')}}/" + btoa(data.trabalhador))
        $('#devolucao__ctps').removeClass('disabled').attr('href', "{{url('devolucao/ctps/trabalhador')}}/" + btoa(data.trabalhador))
        $('#trabalhador').val(data.trabalhador)
      } else {
        $('#relatoriotrabalhador').addClass('disabled')
        $('#imprimir').addClass('disabled')
        $('#fichaepi').addClass('disabled')
        $('#depedente').addClass('disabled')
        $('#form').attr('action', "{{ route('trabalhador.store') }}");
        $('#incluir').removeAttr("disabled")
        $('#depedente').removeAttr("disabled")
        $('#atualizar').attr('disabled', 'disabled')
        $('#deletar').attr('disabled', 'disabled')
        $('#recibopagamento').addClass('disabled')
        $('#method').val(' ')
        $('#excluir').attr('disabled', 'disabled')
      }
      $('#nome__completo').val(data.tsnome).next().text(' ')
      $('#nome__social').val(data.tsnomesocial).next().text(' ')
      $('#foto').val(data.tsfoto)
      $('#trabfoto').attr('src', data.tsfoto)
      $('#cpf').val(data.tscpf).next().text(' ')
      $('#matricula').val(data.tsmatricula).next().text(' ')
      $('#matricularid').val(data.tsmatricula).next().text(' ')
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

      for (let index = 0; index < $('#situacao__contrato option').length; index++) {
        if (data.cssituacao == $('#situacao__contrato option').eq(index).text()) {
          $('#situacao__contrato option').eq(index).attr('selected', 'selected')
        } else {
          $('#situacao__contrato option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#sexo option').length; index++) {
        if (data.tssexo == $('#sexo option').eq(index).text()) {
          $('#sexo option').eq(index).attr('selected', 'selected')
        } else {
          $('#sexo option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#complemento__endereco option').length; index++) {
        if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {
          $('#complemento__endereco option').eq(index).attr('selected', 'selected')
        } else {
          $('#complemento__endereco option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#estado__civil option').length; index++) {
        if (data.nscivil === $('#estado__civil option').eq(index).text()) {
          $('#estado__civil option').eq(index).attr('selected', 'selected')
        } else {
          $('#estado__civil option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#raca option').length; index++) {
        if (data.nsraca === $('#raca option').eq(index).text()) {
          $('#raca option').eq(index).attr('selected', 'selected')
        } else {
          $('#raca option').eq(index).removeAttr('selected')
        }
      }
      for (let index = 0; index < $('#grau__instrucao option').length; index++) {
        if (data.tsescolaridade === $('#grau__instrucao option').eq(index).text()) {
          $('#grau__instrucao option').eq(index).attr('selected', 'selected')
        } else {
          $('#grau__instrucao option').eq(index).removeAttr('selected')
        }
      }

    }
  });
</script>
@stop