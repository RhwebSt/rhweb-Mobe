@extends('layouts.index')
@section('conteine')
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
      title: '{{$message}}'
    })
  </script>
  @enderror
  <form class="row g-3" action="{{ route('trabalhador.update',$trabalhador->id) }}" method="POST">
    <div class="container mt-5 ">
      <div class="btn  " role="group" aria-label="Basic example">
        <button type="submit" class="btn botao">Atualizar</button>
        <a class="btn btn btn-outline-dark d-none" href="" role="button">Consultar</a>
        <a class="btn btn btn-outline-dark d-none" href="#" role="button">Dependentes</a>
        <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
          <i class="fa-solid fa-list"></i> Lista
        </a>
        <a class="btn botao" href="{{ route('trabalhador.index') }}" role="button">Sair</a>
      </div>
    </div>
    <div class="container text-center mt-4 mb-3   fs-4 fw-bold">Identificação do Trabalhador <i class="fad fa-user-hard-hat"></i></div>
    @csrf
    @method('put')
    <div>
      <div class="col-md-6">
        <img class="trabfoto" id="trabfoto" src="{{$trabalhador->tsfoto}}" alt="foto do trabalhador">
      </div>
    </div>

    <div>
      <div class="mb-4 col-md-4 inputfoto">
        <label for="formFileSm " class="form-label"><i class="fas fa-file-image fa-lg"></i> Foto do Trabalhador</label>
        <input class="form-control form-control-sm nice" onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
        <span id="msgfoto" class="text-danger"></span>
      </div>
    </div>
    <!-- <input type="hidden"  name="deflator" > -->
    <!-- <input type="hidden"  name="tomador" > -->
    <input type="hidden" name="foto" id="foto" value="{{$trabalhador->tsfoto}}">
    <input type="hidden" name="endereco" id="endereco" value="{{$trabalhador->eiid}}">
    <input type="hidden" name="bancario" id="bancario" value="{{$trabalhador->biid}}">
    <div class="col-md-6">
      <label for="nome__completo" class="form-label">Nome Completo</label>
      <input type="text" class="form-control" name="nome__completo" id="nome__completo" value="{{$trabalhador->tsnome}}">
    </div>
    <div class="col-md-6">
      <label for="nome__social" class="form-label"><input type="checkbox" name="radio_social" id="radio" /> Nome Social (Opcional) </label>
      <input type="text" class="form-control input fw-bold text-dark @error('nome__social') is-invalid @enderror text-dark" value="{{$trabalhador->tsnomesocial}}" maxlength="100" name="nome__social" id="nome__social">
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
    <div class="col-md-2">
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" class="form-control cpf-mask" name="cpf" id="cpf" maxlength="15" value="{{$trabalhador->tscpf}}">
    </div>

    <div class="col-md-2">
      <label for="matricula" class="form-label">Matrícula</label>
      <input type="text" class="form-control" name="matricula" id="matricula" value="{{$trabalhador->tsmatricula}}">
    </div>

    <div class="col-md-2">
      <label for="pis" class="form-label">PIS</label>
      <input type="text" class="form-control" name="pis" id="pis" value="{{$trabalhador->dspis}}">
    </div>


    <div class="col-md-2">
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

    <div class="col-md-2">
      <label for="estado__civil" class="form-label">Estado Civil</label>
      <select id="estado__civil" name="estado__civil" class="form-select" value="">

        @if($trabalhador->nscivil ==='Solteiro')
        <option selected>Solteiro</option>
        <option>Casado</option>
        <option>Separados</option>
        <option>Divorciados</option>
        <option>viúvo</option>
        @elseif($trabalhador->nscivil ==='Casado')
        <option>Solteiro</option>
        <option selected>Casado</option>
        <option>Separados</option>
        <option>Divorciados</option>
        <option>viúvo</option>
        @elseif($trabalhador->nscivil ==='Separados')
        <option>Solteiro</option>
        <option>Casado</option>
        <option selected>Separados</option>
        <option>Divorciados</option>
        <option>viúvo</option>
        @elseif($trabalhador->nscivil ==='Divorciados')
        <option>Solteiro</option>
        <option>Casado</option>
        <option>Separados</option>
        <option selected>Divorciados</option>
        <option>viúvo</option>
        @else
        <option>Solteiro</option>
        <option>Casado</option>
        <option>Separados</option>
        <option>Divorciados</option>
        <option selected>viúvo</option>
        @endif
      </select>
    </div>

    <div class="col-md-2">
      <label for="raca" class="form-label">Raça</label>
      <select id="raca" name="raca" class="form-select">

        @if($trabalhador->nsraca === 'Preto')
        <option selected>Preto</option>
        <option>Pardo</option>
        <option>Branco</option>
        <option>Indígena</option>
        <option>Amarela</option>
        <option>Não informado</option>
        @elseif($trabalhador->nsraca === 'Pardo')
        <option>Preto</option>
        <option selected>Pardo</option>
        <option>Branco</option>
        <option>Indígena</option>
        <option>Amarela</option>
        <option>Não informado</option>
        @elseif($trabalhador->nsraca === 'Branco')
        <option>Preto</option>
        <option>Pardo</option>
        <option selected>Branco</option>
        <option>Indígena</option>
        <option>Amarela</option>
        <option>Não informado</option>
        @elseif($trabalhador->nsraca === 'Indígena')
        <option>Preto</option>
        <option>Pardo</option>
        <option>Branco</option>
        <option selected>Indígena</option>
        <option>Amarela</option>
        <option>Não informado</option>
        @elseif($trabalhador->nsraca === 'Amarela')
        <option>Preto</option>
        <option>Pardo</option>
        <option>Branco</option>
        <option>Indígena</option>
        <option selected>Amarela</option>
        <option>Não informado</option>
        @else
        <option>Preto</option>
        <option>Pardo</option>
        <option>Branco</option>
        <option>Indígena</option>
        <option>Amarela</option>
        <option selected>Não informado</option>
        @endif
      </select>
    </div>

    <div class="col-md-3">
      <label for="grau__instrucao" class="form-label">Grau de Instrução</label>
      <select id="grau__instrucao" name="grau__instrucao" class="form-select" value="">
        @if($trabalhador->tsescolaridade === 'Superior Completo')
        <option selected>Superior Completo</option>
        <option>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option>Analfabetos</option>
        @elseif($trabalhador->tsescolaridade === 'Superior incompleto')
        <option>Superior Completo</option>
        <option selected>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option>Analfabetos</option>
        @elseif($trabalhador->tsescolaridade === 'Ensino Médio Completo')
        <option>Superior Completo</option>
        <option>Superior incompleto</option>
        <option selected>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option>Analfabetos</option>
        @elseif($trabalhador->tsescolaridade === 'Ensino Médio Incompleto')
        <option>Superior Completo</option>
        <option>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option selected>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option>Analfabetos</option>
        @elseif($trabalhador->tsescolaridade === 'Ensino Fundamental Completo')
        <option>Superior Completo</option>
        <option>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option selected>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option>Analfabetos</option>
        @elseif($trabalhador->tsescolaridade === 'Ensino Fundamental Incompleto')
        <option>Superior Completo</option>
        <option>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option selected>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option>Analfabetos</option>
        @elseif($trabalhador->tsescolaridade === 'Lê e Escreve')
        <option>Superior Completo</option>
        <option>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option selected>Lê e Escreve</option>
        <option>Analfabetos</option>
        @else
        <option>Superior Completo</option>
        <option>Superior incompleto</option>
        <option>Ensino Médio Completo</option>
        <option>Ensino Médio Incompleto</option>
        <option>Ensino Fundamental Completo</option>
        <option>Ensino Fundamental Incompleto</option>
        <option>Lê e Escreve</option>
        <option selected>Analfabetos</option>
        @endif
      </select>
    </div>


    <div class="col-md-3">
      <label for="data_nascimento" class="form-label">Data de Nascimento</label>
      <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{$trabalhador->nsnascimento}}">
    </div>


    <div class="col-md-3">
      <label for="pais__nascimento" class="form-label">País de Nascimento</label>
      <input type="text" class="form-control" name="pais__nascimento" id="pais__nascimento" value="{{$trabalhador->nsnaturalidade}}">
    </div>

    <div class="col-md-3">
      <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
      <input type="text" class="form-control" name="pais__nacionalidade" id="pais__nacionalidade" value="{{$trabalhador->nsnacionalidade}}">
    </div>

    <div class="col-md-6">
      <label for="nome__mae" class="form-label">Nome da Mãe</label>
      <input type="text" class="form-control" name="nome__mae" id="nome__mae" value="{{$trabalhador->tsmae}}">
    </div>

    <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Local de Residência</div>

    <div class="col-md-2">
      <label for="cep" class="form-label">Cep</label>
      <input type="text" class="form-control" name="cep" id="cep" value="{{$trabalhador->escep}}">
    </div>



    <div class="col-md-6">
      <label for="logradouro" class="form-label">Rua</label>
      <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$trabalhador->eslogradouro}}">
    </div>

    <div class="col-md-1">
      <label for="numero" class="form-label">Número</label>
      <input type="text" class="form-control" name="numero" id="numero" value="{{$trabalhador->esnum}}">

    </div>

    <div class="col-md-2 d-none">
      <label for="tipo" class="form-label">Tipo</label>
      <input type="text" class="form-control" name="tipo__endereco" id="tipo" value="">
    </div>


    <div class="col-md-5">
      <label for="bairro" class="form-label">Bairro</label>
      <input type="text" class="form-control" name="bairro" id="bairro" value="{{$trabalhador->esbairro}}">
    </div>


    <div class="col-md-5">
      <label for="localidade" class="form-label">Municipio</label>
      <input type="text" class="form-control" name="localidade" id="localidade" value="{{$trabalhador->esmunicipio}}">
    </div>

    <div class="col-md-1">
      <label for="uf" class="form-label">UF</label>
      <input type="text" class="form-control" name="uf" id="uf" value="{{$trabalhador->esuf}}">
    </div>

    <div class="col-md-4">
      <label for="tipoconstrucao" class="form-label">Tipo</label>
      <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
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
        @if($complementos === $trabalhador->escomplemento)
        <option selected>{{$trabalhador->escomplemento}}</option>
        @else
        <option>{{$complementos}}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="col-md-2">
      <label for="telefone" class="form-label">Telefone</label>
      <input type="text" class="form-control" name="telefone" id="telefone" value="{{$trabalhador->tstelefone}}">
    </div>

    <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Contrato de Trabalho</div>

    <div class="col-md-3">
      <label for="data__admissao" class="form-label">Data de Admissão</label>
      <input type="date" class="form-control" name="data__admissao" id="data__admissao" value="{{$trabalhador->csadmissao}}">
    </div>

    <div class="col-md-1">
      <label for="categoria" class="form-label">Categoria</label>
      <input type="text" class="form-control" name="categoria__contrato" id="categoria" value="{{$trabalhador->cscategoria}}">
    </div>

    <div class="col-md-1">
      <label for="cbo" class="form-label">CBO</label>
      <input type="text" class="form-control" name="cbo" id="cbo" value="{{$trabalhador->cbo}}">
    </div>



    <div class="col-md-2">
      <label for="ctps" class="form-label">CTPS</label>
      <input type="text" class="form-control" name="ctps" id="ctps" value="{{$trabalhador->dsctps}}">
    </div>

    <div class="col-md-1">
      <label for="serie__ctps" class="form-label">Série</label>
      <input type="text" class="form-control" name="serie__ctps" id="serie__ctps" value="{{$trabalhador->dsserie}}">
    </div>

    <div class="col-md-1">
      <label for="uf__ctps" class="form-label">UF</label>
      <input type="text" class="form-control" name="uf__ctps" id="uf__ctps" value="{{$trabalhador->dsuf}}">
    </div>

    <div class="col-md-4">
      <label for="situacao__contrato" class="form-label">Situação</label>
      <input type="text" class="form-control" name="situacao__contrato" id="situacao__contrato" value="{{$trabalhador->cssituacao}}">
    </div>

    <div class="col-md-4">
      <label for="data__afastamento" class="form-label">Data de Afastamento</label>
      <input type="date" class="form-control" name="data__afastamento" id="data__afastamento" value="{{$trabalhador->csafastamento}}">
    </div>


    <div class="container text-center mt-5 mb-3 fs-4 fw-bold">Dados Bancários do Trabalhador</div>

    <div class="col-md-6">
      <label for="nome__conta" class="form-label">Nome do Titular</label>
      <input type="text" class="form-control" name="nome__conta" id="nome__conta" value="{{$trabalhador->bsconta}}">
    </div>

    <div class="col-md-2">
      <label for="banco" class="form-label">Banco</label>
      <input type="text" class="form-control" name="banco" id="banco" value="{{$trabalhador->bsbanco}}">
    </div>

    <div class="col-md-2">
      <label for="agencia" class="form-label">Agência</label>
      <input type="text" class="form-control" name="agencia" id="agencia" value="{{$trabalhador->bsagencia}}">
    </div>

    <div class="col-md-2">
      <label for="operacao" class="form-label">Operação</label>
      <input type="text" class="form-control" name="operacao" id="operacao" value="{{$trabalhador->bsoperacao}}">
    </div>

    <div class="col-md-2">
      <label for="conta" class="form-label">Conta</label>
      <input type="text" class="form-control" name="conta" id="conta" value="{{$trabalhador->bsconta}}">
    </div>

    <div class="col-md-2">
      <label for="pix" class="form-label">PIX</label>
      <input type="text" class="form-control" name="pix" id="pix" value="{{$trabalhador->bspix}}">
    </div>
  </form>
  @include('trabalhador.lista')
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
</script>
@stop