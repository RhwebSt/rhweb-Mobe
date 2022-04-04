@extends('layouts.index')
@section('titulo','Rhweb - Trabalhador')
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
      title: '{{ $message }}'
    })
  </script>
  @enderror
  
  <script>
       
        Swal.fire({
          title: '<strong>Evento baixado com sucesso</strong>',
          icon: 'success',
          html:
            '<div class="progress mb-3" style="height: 12px;">'+
                '<div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">50%</div>'+
            '</div>' + 
            '<p>Deseja Integrar esse arquivo com o E-SOCIAL?</p>' +
            '<a href="">Clique aqui</a> ',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          showConfirmButton: false,
          cancelButtonText:
            'Fechar <i class="fad fa-times"></i>',
          cancelButtonColor: '#04888B',
          allowOutsideClick: false,
          allowEscapeKey: false,
        })
  </script>

  <!-- <form id="formulario" method="post" enctype="multipart/form-data">
    <input type="text" name="campo1" value="hello" />
    <input type="text" name="campo2" value="world" />
    <input name="arquivo" type="file" />
    <button>Enviar</button>
</form> -->

  <form class="row g-3" id="form" action="{{ route('trabalhador.store') }}" enctype="multipart/form-data" method="POST">

    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
      <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
      <button type="submit" id="atualizar" disabled class="btn botao d-none"><i class="fad fa-sync-alt"></i> Atualizar</button>
      <button type="button" class="btn botao d-none" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <i class="fad fa-trash"></i> Excluir
      </button>
      <!-- <a class="btn btn btn-primary" href="{{ route('trabalhador.index') }}" role="button">Consultar</a> -->

      <button class="btn botao dropdown-toggle disabled d-none" type="button" id="relatoriotrabalhador" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fad fa-file-alt"></i> Relatórios
      </button>
      <ul class="dropdown-menu" aria-labelledby="relatoriotrabalhador">
        <li class=""><a class="dropdown-item text-decoration-none ps-2" id="imprimir" role="button">Ficha de Registro</a></li>
        <li class=""><a class="dropdown-item text-decoration-none ps-2" id="fichaepi" role="button">Ficha de EPI</a></li>
        <li class=""><a class="dropdown-item text-decoration-none ps-2" id="declaracao__afas" role="button">Declaração de Afastamento</a></li>
        <li class=""><a class="dropdown-item text-decoration-none ps-2" id="declaracao__adm" role="button">Declaração de Admissão</a></li>
        <li class=""><a class="dropdown-item text-decoration-none ps-2" id="cracha" role="button">Crachá</a></li>
        <li class=""><a class="dropdown-item text-decoration-none ps-2" id="devolucao__ctps" role="button">Devolução da CTPS</a></li>
      </ul>
      <a class="btn botao disabled d-none" id="depedente" role="button"><i class="fad fa-users"></i> Dependentes</a>

      <button type="button" class="btn botao disabled d-none" id="recibopagamento" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fad fa-file-invoice"></i> Recibos
      </button>

      <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
        <i class="fa-solid fa-list"></i> Lista
      </a>

      <a class="btn botao" href="{{route('home.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
    </div>





    <div class="container text-center mt-4 mb-3   fs-4 fw-bold">Identificação do Trabalhador <i class="fad fa-user-hard-hat"></i></div>
    @csrf
    <input type="hidden" id="method" name="_method" value="">
    <input type="hidden" name="deflator">
    <input type="hidden" name="tomador">
    <input type="hidden" name="pessoal">
    <!-- <input type="hidden" name="empresa">  -->
    <input type="hidden" name="empresa" value="{{$user->empresa}}">

    <div>
      <div class="col-md-6">
        <img class="trabfoto" id="trabfoto" src="" alt="foto do trabalhador">
      </div>
    </div>

    <div>
      <div class="mb-4 col-md-4 inputfoto">
        <label for="formFileSm " class="form-label"><i class="fas fa-file-image fa-lg"></i> Foto do Trabalhador</label>
        <input class="form-control form-control-sm nice" onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
        <span id="msgfoto" class="text-danger"></span>
      </div>
    </div>

    <input type="hidden" name="foto" id="foto">
    <div class="col-md-6">
      <label for="nome__completo" class="form-label">Nome Completo
        <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
      </label>
      <input type="text" class="form-control input @error('nome__completo') is-invalid @enderror fw-bold text-dark" value="{{old('nome__completo')}}" name="nome__completo" maxlength="100" id="nome__completo">
      @error('nome__completo')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-6">
      <label for="nome__social" class="form-label"><input type="checkbox" name="radio_social" id="radio" /> Nome Social (Opcional) </label>
      <input type="text" class="form-control input fw-bold text-dark @error('nome__social') is-invalid @enderror text-dark" value="{{ old('nome__social')}}" maxlength="100" name="nome__social" id="nome__social">
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
      <label for="cpf" class="form-label">CPF</label>
      <input type="text" class="form-control input fw-bold text-dark cpf-mask @error('cpf') is-invalid @enderror fw-bold text-dark" value="{{old('cpf')}}" name="cpf" id="cpf" maxlength="15">
      @error('cpf')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <?php
    if (isset($valorrublica_matricular->vimatricular)) {
      $matricular = $valorrublica_matricular->vimatricular + 1;
    } else {
      $matricular = 1;
    }
    ?>
    <div class="col-md-3 ">
      <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock"></i></label>
      <input type="text" disabled class="form-control  input fw-bold text-dark  @error('matricula') is-invalid @enderror" value="{{$matricular}}" id="matricula">
      <input type="hidden" value="{{$matricular}}" name="matricula" id="matricularid">
      @error('matricula')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-3">
      <label for="pis" class="form-label">PIS</label>
      <input type="text" class="form-control input fw-bold text-dark  @error('pis') is-invalid @enderror" value="{{old('pis')}}" name="pis" id="pis">
      @error('pis')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>


    <div class="col-md-3">
      <label for="sexo" class="form-label">Sexo</label>
      <select id="sexo" name="sexo" class="form-select fw-bold text-dark">
        <option selected>Masculino</option>
        <option>Feminino</option>
        <option>Outro</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="estado__civil" class="form-label">Estado Civil</label>
      <select id="estado__civil" name="estado__civil" class="form-select fw-bold text-dark">
        <option selected>1-Solteiro</option>
        <option>2-Casado</option>
        <option>3-Divorciados</option>
        <option>4-Separados</option>
        <option>5-Viúvo</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="raca" class="form-label">Raça</label>
      <select id="raca" name="raca" class="form-select fw-bold text-dark">
        <option selected>01-Branco</option>
        <option>2-Preta</option>
        <option>3-Pardo</option>
        <option>4-Amarela</option>
        <option>5-Indígena</option>
        <option>6-Não informado</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="grau__instrucao" class="form-label">Grau de Instrução</label>
      <select id="grau__instrucao" name="grau__instrucao" class="form-select fw-bold text-dark" value="">
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


    <div class="col-md-4">
      <label for="data_nascimento" class="form-label">Data de Nascimento</label>
      <input type="date" class="form-control input fw-bold text-dark  @error('data_nascimento') is-invalid @enderror" value="{{old('data_nascimento')}}" maxlength="2" name="data_nascimento" id="data_nascimento">
      @error('data_nascimento')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>


    <div class="col-md-4">
      <label for="pais__nascimento" class="form-label">País de Nascimento</label>
      <input type="text" list="pais_nascimento_list" class="form-control input fw-bold text-dark  @error('pais__nascimento') is-invalid @enderror" value="{{old('pais__nascimento')}}" maxlength="20" name="pais__nascimento" id="pais__nascimento">
      @error('pais__nascimento')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      <datalist id="pais_nascimento_list">
      </datalist>
    </div>

    <div class="col-md-4">
      <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
      <input type="text" list="pais_nacionalidade_list" class="form-control input fw-bold text-dark @error('pais__nacionalidade') is-invalid @enderror" value="{{old('pais__nacionalidade')}}" maxlength="20" name="pais__nacionalidade" id="pais__nacionalidade">
      @error('pais__nacionalidade')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      <datalist id="pais_nacionalidade_list">
      </datalist>
    </div>

    <div class="col-md-8">
      <label for="nome__mae" class="form-label">Nome da Mãe</label>
      <input type="text" class="form-control input fw-bold text-dark @error('nome__mae') is-invalid @enderror" value="{{old('nome__mae')}}" maxlength="100" name="nome__mae" id="nome__mae">
      @error('nome__mae')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="container text-center  fs-4 fw-bold mt-4 mb-3">Local de Residência <i class="fad fa-map-marked-alt"></i></div>

    <div class="col-md-3">
      <label for="cep" class="form-label">CEP</label>
      <input type="text" class="form-control input @error('cep') is-invalid @enderror fw-bold" maxlength="16" value="{{old('cep')}}" name="cep" id="cep">
      @error('cep')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-7">
      <label for="logradouro" class="form-label">Rua</label>
      <input type="text" class="form-control input  @error('logradouro') is-invalid @enderror fw-bold" maxlength="50" value="{{old('logradouro')}}" name="logradouro" id="logradouro">
      @error('logradouro')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-2">
      <label for="numero" class="form-label">Número</label>
      <input type="text" class="form-control input @error('numero') is-invalid @enderror fw-bold" maxlength="10" value="{{old('numero')}}" name="numero" id="numero">
      @error('numero')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>


    <div class="col-md-4">
      <label for="tipoconstrucao" class="form-label">Tipo</label>
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
    <div class="col-md-8">
      <label for="bairro" class="form-label">Bairro</label>
      <input type="text" class="form-control input @error('bairro') is-invalid @enderror fw-bold" maxlength="40" value="{{old('bairro')}}" name="bairro" id="bairro">
      @error('bairro')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>


    <div class="col-md-7">
      <label for="localidade" class="form-label">Municipio</label>
      <input type="text" class="form-control input @error('localidade') is-invalid @enderror fw-bold" maxlength="30" value="{{old('localidade')}}" name="localidade" id="localidade">
      @error('localidade')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-2">
      <label for="uf" class="form-label">UF</label>
      <input type="text" class="form-control input @error('uf') is-invalid @enderror fw-bold" maxlength="2" value="{{old('uf')}}" name="uf" id="uf">
      @error('uf')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="col-md-3">
      <label for="telefone" class="form-label">Telefone</label>
      <input type="text" class="form-control input fw-bold text-dark  @error('telefone') is-invalid @enderror" value="{{old('telefone')}}" name="telefone" id="telefone" value="">
      @error('telefone')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="container text-center mt-4 mb-3 fs-4 fw-bold">Contrato de Trabalho <i class="fad fa-file-contract"></i></div>

    <div class="col-md-4">
      <label for="data__admissao" class="form-label">Data de Admissão</label>
      <input type="date" class="form-control input fw-bold text-dark  @error('data__admissao') is-invalid @enderror" value="{{old('data__admissao')}}" name="data__admissao" id="data__admissao">
      @error('data__admissao')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-4">
      <label for="categoria" class="form-label">Categoria</label>
      <input type="text" list="categoria_list" class="form-control input fw-bold text-dark  @error('categoria__contrato') is-invalid @enderror" value="{{old('categoria__contrato')}}" maxlength="100" name="categoria__contrato" id="categoria">
      @error('categoria__contrato')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      <datalist id="categoria_list">
      </datalist>
    </div>

    <div class="col-md-4">
      <label for="cbo" class="form-label">CBO</label>
      <input type="text" list="cbo_list" class="form-control input fw-bold text-dark  @error('cbo') is-invalid @enderror" value="{{old('cbo')}}" name="cbo" id="cbo" value="">
      @error('cbo')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      <datalist id="cbo_list">
      </datalist>
    </div>



    <div class="col-md-4">
      <label for="ctps" class="form-label">CTPS</label>
      <input type="text" class="form-control input fw-bold text-dark @error('ctps') is-invalid @enderror" maxlength="20" value="{{old('ctps')}}" name="ctps" id="ctps">
      @error('ctps')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-4">
      <label for="serie__ctps" class="form-label">Série</label>
      <input type="text" class="form-control input fw-bold text-dark @error('serie__ctps') is-invalid @enderror" value="{{old('serie__ctps')}}" name="serie__ctps" id="serie__ctps">
      @error('serie__ctps')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-4">
      <label for="uf__ctps" class="form-label">UF</label>
      <input type="text" class="form-control input fw-bold text-dark  @error('uf__ctps') is-invalid @enderror" value="{{old('uf__ctps')}}" name="uf__ctps" maxlength="2" id="uf__ctps">
      @error('uf__ctps')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-5">
      <label for="situacao__contrato" class="form-label">Situação</label>
      <select name="situacao__contrato" id="situacao__contrato" class="form-select fw-bold text-dark">
        <option selected>Ativo</option>
        <option>Inativo</option>
        <option>Afastado</option>
        <option>Em processo</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="data__afastamento" class="form-label">Data de Afastamento</label>
      <input type="date" class="form-control input fw-bold text-dark  @error('data__afastamento') is-invalid @enderror" value="{{old('data__afastamento')}}" name="data__afastamento" id="data__afastamento">
      @error('data__afastamento')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>


    <div class="container text-center mt-4 mb-3 fs-4 fw-bold">Dados Bancários do Trabalhador <i class="fad fa-university"></i></div>

    <div class="col-md-3">
      <label for="banco" class="form-label">Banco</label>
      <input type="text" class="form-control input @error('banco') is-invalid @enderror input fw-bold text-dark" aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="{{old('banco')}}" id="banco">
      <div id="menssagem-banco" class="valid-feedback">

      </div>
      @error('banco')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-2">
      <label for="agencia" class="form-label">Agência</label>
      <input type="text" class="form-control input @error('agencia') is-invalid @enderror input fw-bold text-dark" name="agencia" value="{{old('agencia')}}" id="agencia">
      @error('agencia')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-2">
      <label for="operacao" class="form-label">Operação</label>
      <input type="text" class="form-control input @error('operacao') is-invalid @enderror input fw-bold text-dark" name="operacao" value="{{old('operacao')}}" id="operacao">
      @error('aperacao')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-2">
      <label for="conta" class="form-label">Conta</label>
      <input type="text" class="form-control input @error('conta') is-invalid @enderror input fw-bold text-dark" name="conta" value="{{old('conta')}}" id="conta">
      @error('conta')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <div class="col-md-3">
      <label for="pix" class="form-label">PIX</label>
      <input type="text" class="form-control input @error('pix') is-invalid @enderror input fw-bold text-dark" name="pix" value="{{old('pix')}}" id="pix">
      @error('pix')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>


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
          <p class="mb-2">Obs:( Caso exclua os dados do trabalhador seus depedentes serão excluidos.)</p>
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

@include('trabalhador.lista')

<script type="text/javascript" src="{{url('/js/cbo.js')}}"></script>

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
  var nome__completo = validaInputQuantidade("#nome__completo", 1);
  var nome__social = validaInputQuantidade("#nome__social", 1);
  var cpf = validaInputQuantidade("#cpf", 14);
  var pis = validaInputQuantidade("#pis", 14);
  var pais__nascimento1 = validaInputQuantidade("#pais__nascimento", 1);
  var pais__nacionalidade = validaInputQuantidade("#pais__nacionalidade", 1);
  var nome__mae = validaInputQuantidade("#nome__mae", 1);
  var cep = validaInputQuantidade("#cep", 9);
  var logradouro = validaInputQuantidade("#logradouro", 1);
  var bairro = validaInputQuantidade("#bairro", 1);
  var localidade = validaInputQuantidade("#localidade", 1);
  var numero = validaInputQuantidade("#numero", 1);
  var uf = validaInputQuantidade("#uf", 2);
  var data_nascimento = validaInputQuantidade("#data_nascimento", 10);
  var telefone = validaInputQuantidade("#telefone", 14);
  var data__admissao = validaInputQuantidade("#data__admissao", 10);
  var categoria = validaInputQuantidade("#categoria", 2);
  var cbo1 = validaInputQuantidade("#cbo", 5);
  var ctps = validaInputQuantidade("#ctps", 14);
  var serie__ctps = validaInputQuantidade("#serie__ctps", 1);
  var uf__ctps = validaInputQuantidade("#uf__ctps", 2);
  var data__afastamento = validaInputQuantidade("#data__afastamento", 10);
  var banco = validaInputQuantidade("#banco", 2);
  var agencia = validaInputQuantidade("#agencia", 4);
  var operacao = validaInputQuantidade("#operacao", 3);
  var conta = validaInputQuantidade("#conta", 8);
  var pix = validaInputQuantidade("#pix", 1);

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
    var cep = document.querySelector("#cep").value = '';
    var logradouro = document.querySelector("#logradouro").value = '';
    var numero = document.querySelector("#numero").value = '';
    var tipo = document.querySelector("#complemento__endereco").value = '';
    var bairro = document.querySelector("#bairro").value = '';
    var localidade = document.querySelector("#localidade").value = '';
    var uf = document.querySelector("#uf").value = '';
    var nome = document.querySelector("#nome__completo").value = '';
    var nomeSocial = document.querySelector("#nome__social").value = '';
    var cpf = document.querySelector("#cpf").value = '';
    var pis = document.querySelector("#pis").value = '';
    var dataNascimento = document.querySelector("#data_nascimento").value = '';
    var paisNascimento = document.querySelector("#pais__nascimento").value = '';
    var paisNacionalidade = document.querySelector("#pais__nacionalidade").value = '';
    var nomeMae = document.querySelector("#nome__mae").value = '';
    var telefone = document.querySelector("#telefone").value = '';
    var dataAdmissao = document.querySelector("#data__admissao").value = '';
    var categoriaContrato = document.querySelector("#categoria").value = '';
    var cbo = document.querySelector("#cbo").value = '';
    var ctps = document.querySelector("#ctps").value = '';
    var serieCtps = document.querySelector("#serie__ctps").value = '';
    var ufCtps = document.querySelector("#uf__ctps").value = '';
    var dataAfastamento = document.querySelector("#data__afastamento").value = '';
    var banco = document.querySelector("#banco").value = '';
    var agencia = document.querySelector("#agencia").value = '';
    var operacao = document.querySelector("#operacao").value = '';
    var conta = document.querySelector("#conta").value = '';
    var pix = document.querySelector("#pix").value = '';
  })



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
    $('#cbo').on('keyup focus', function() {
      if (!$(this).val()) {
        cbolista(cbo);
      }
    })

    $('#categoria').on('keyup focus', function() {
      if (!$(this).val()) {
        listacategoria(categoriatrabalhador);
      }
    })

    function cbolista(cbo) {
      cbo.forEach(element => {
        cbolist += `<option value="${element.code} - ${element.name}">`
      });
      $('#cbo_list').html(cbolist)
    }
    cbolista(cbo)

    function listacategoria(categoriatrabalhador) {
      categoriatrabalhador.forEach(element => {
        categorialist += `<option value="${element}">`
      });
      $('#categoria_list').html(categorialist);
    }
    listacategoria(categoriatrabalhador)
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