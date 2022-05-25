@extends('layouts.index')
@section('titulo','Rhweb - Tomador')
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

            <form class="row g-3" novalidate id="form" action="{{ route('tomador.store') }}"  method="Post">
                
                <input type="hidden" name="tomador" id="tomador">
                <input type="hidden" name="pessoal">
                
                <section class="section__botoes--tomador">
                    
                    <div class="d-flex justify-content-start align-items-start div__voltar">
                        <a class="botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                    </div>
                    
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" class="btn botao" value="Validar!"><i class="fad fa-save"></i> Incluir </button>
                        
                         <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalTomador">
                            <i class="fad fa-list-ul"></i> Lista
                         </a>
                    </div>
                    
                </section>
                        

                <script>
                    function botaoModal (tomador){
                    Swal.fire({
                        title: 'Periodo',
                        html:
                        '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
                        '<input type="date" name="final" id="swal-input2" class="swal2-input">',
                       Label: 'teste',
                        confirmButtonText: 'Buscar',
                        showDenyButton: true,
                        denyButtonText: 'Sair',
                        showConfirmButton: true,
                        focusConfirm: false,
                        preConfirm: () => {
                            if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                                Swal.showValidationMessage('Preencha todos os campos')   
                            }else{
                                let inicio =  document.getElementById('swal-input1').value
                                let final = document.getElementById('swal-input2').value
                                // let tomador = document.getElementById('tomador').value
                                location.href=`{{url('boletim/tomador')}}/${tomador}/${inicio}/${final}`;
                            } 
                            
                        }
                    });
                    }
                </script>
                        
                        
                <input type="hidden" class="form-control is-invalid" id="validationServer05" aria-describedby="mensagem-pesquisa" required>
                <div id="mensagem-pesquisa" class="invalid-feedback"></div>
                
                <h1 class="title__tomador">Dados do Tomador <i class="fad fa-industry"></i></h1>            

                @csrf
                <input type="hidden" id="method" name="_method" value="">
                <input type="hidden" name="empresa" value="{{$user->empresa->id}}">
                <input type="hidden" name="trabalhador">
                       
                <div class="col-md-4">
                    <label for="cnpj" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CNPJ <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Após preencher o cnpj aperte a tecla 'tab' ou clique em outro campo para que seja preenchido alguns dados automáticamente."></i></label>
                    <input type="text" class="form-control @error('cnpj') is-invalid @enderror valid" name="cnpj" value="{{old('cnpj')}}" id="cnpj" placeholder="Ex: 00.000.000/0000-00">
                    @error('cnpj')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                        
                <div class="col-md-4">
                    <label for="tipo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tipo </label>
                    <select id="tipo" name="tipo" class="form-select">
                        <option >1-CNPJ</option>
                        <option >2-CPF</option>
                    </select>
                </div>
                        
                <div class="col-md-4">
                    <label for="simple" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Simples</label>
                    <select name="simples" value="{{old('simples')}}" id="simple" class="form-select">
                        <option selected >Não</option>
                        <option >Sim</option>
                    </select>
                    @error('simples')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                       
                <div class="col-md-8">
                    <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nome</label>
                    <input type="text" class="form-control @error('nome__completo') is-invalid @enderror  valid" value="{{old('nome__completo')}}" name="nome__completo"  id="nome__completo" placeholder="digite o nome da empresa">
                    @error('nome__completo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                        
                <?php
                    if ( isset($valorrublica_matricular->vimatriculartomador)) {
                        $matricular = $valorrublica_matricular->vimatriculartomador + 1;
                    }else{
                        $matricular = 1; 
                    }
                ?>
                <div class="col-md-4">
                    <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                    <input type="text" disabled class="form-control  @error('matricula') is-invalid @enderror"  value="{{$matricular}}" id="matricula">
                    <input type="hidden" value="{{$matricular}}" name="matricula" id="matriculaid">
                    @error('matricula')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label for="nome__fantasia" class="form-label"><input type="checkbox" id="radio" name="radio_fantasia" data-bs-toggle="tooltip" data-bs-placement="top" title="Deseja definir como padrão? Clique aqui"> Nome Fantasia </label>
                    <input type="text" class="form-control @error('nome__fantasia') is-invalid @enderror valid" name="nome__fantasia" value="{{old('nome__fantasia')}}" id="nome__fantasia" placeholder="digite o nome fantasia da empresa">
                    @error('nome__fantasia')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                        
                <script>
                    var radio = document.getElementById("radio");
                    var radioResult = radio.value;
                    
                    
                    radio.addEventListener('click', function(){
                        
                        if(radio.checked){
                            
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
                    <label for="telefone" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Telefone</label>
                    <input type="text" class="form-control @error('telefone') is-invalid @enderror valid" name="telefone" value="{{old('telefone')}}" id="telefone" placeholder="Ex: (00) 00000-0000">
                    @error('telefone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                        
                <section class="section__accoordion row">
                    
                    <div class="accordion div__acordion" id="accordionFlushExample">
                                
                        <div id="divEndereco" class="accordion-item item__acorddion">
                                    
                            <h2 class="accordion-header accoordion__header" id="tomadorTaxas">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#endereco__accordion" aria-expanded="false" aria-controls="endereco__accordion">
                                    <i class="me-1 fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i>Endereço<i class="ms-1 fad fa-map-marked-alt"></i>
                                  </button>
                            </h2>
                                    
                            <div id="endereco__accordion" class="accordion-collapse collapse" aria-labelledby="tomadorTaxas" data-bs-parent="#accordionFlushExample">
                                
                                <div class="accordion-body row">
                                    
                                    <section class="row endereco">
                                        
                                        <div class="col-md-3 mt-2">
                                            <label for="cep" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CEP <i class="fad fa-question-circle" data-toggle="tooltip" data-placement="top" title="Após preencher o cep aperte a tecla 'tab' ou clique em outro campo para que seja preenchido alguns dados automáticamente."></i></label>
                                            <input type="text" class="form-control @error('cep') is-invalid @enderror valid" name="cep" value="{{old('cep')}}" id="cep" placeholder="Ex: 00000-000">
                                            @error('cep')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                                
                                        <div class="col-md-7 mt-2">
                                            <label for="logradouro" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Rua</label>
                                            <input type="text" class="form-control @error('logradouro') is-invalid @enderror valid" name="logradouro" value="{{old('logradouro')}}" id="logradouro" placeholder="Ex: Rua sem fim">
                                            @error('logradouro')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                        
                                        <div class="col-md-2 mt-2">
                                            <label for="numero" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Número</label>
                                            <input type="text" class="form-control @error('numero') is-invalid @enderror valid" name="numero" value="{{old('numero')}}" id="numero">
                                            @error('numero')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                        
                                        <div class="col-md-4 mt-2"> 
                                                <label for="complemento__endereco" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tipo</label>
                                                <select name="complemento__endereco" id="complemento__endereco" class="form-select">
                        
                                                    <option >A-Área</option>
                                                    <option >AC-Acesso</option>
                                                    <option >ACA-Acampamento</option>
                                                    <option >ACL-Acesso Local</option>
                                                    <option >AE-Área Especial</option>
                                                    <option >AER-Aeroporto</option>
                                                    <option >AL-Alameda</option>
                                                    <option >ALD-Aldeia</option>
                                                    <option >AMD-Avenida Marginal Direita</option>
                                                    <option >AME-Avenida Marginal Esquerda</option>
                                                    <option >AN-Anel Viário</option>
                                                    <option >ANT-Antiga Estrada</option>
                                                    <option >ART-Artéria</option>
                                                    <option >AT-Alto</option>
                                                    <option >ATL-Atalho</option>
                                                    <option >A V-Área Verde</option>
                                                    <option >AV-Avenida</option>
                                                    <option >AVC-Avenida Contorno</option>
                                                    <option >AVM-Avenida Marginal</option>
                                                    <option >AVV-Avenida Velha</option>
                                                    <option >BAL-Balneário</option>
                                                    <option >BC-Beco</option>
                                                    <option >BCO-Buraco</option>
                                                    <option >BL-Bloco</option>
                                                    <option >BLO-Balão</option>
                                                    <option >BLV-Bulevar</option>
                                                    <option >BSQ-Bosque</option>
                                                    <option >BVD-Boulevard</option>
                                                    <option >BX-Baixa</option>
                                                    <option >C-Cais</option>
                                                    <option >CAL-Calçada</option>
                                                    <option >CAM-Caminho</option>
                                                    <option >CAN-Canal</option>
                                                    <option >CH-Chácara</option>
                                                    <option >CHA-Chapadão</option>
                                                    <option >CIC-Ciclovia</option>
                                                    <option >CIR-Circular</option>
                                                    <option >CJ-Conjunto</option>
                                                    <option >COL-Colônia</option>
                                                    <option >COM-Comunidade</option>
                                                    <option >CON-Condomínio</option>
                                                    <option >COR-Corredor</option>
                                                    <option >CPO-Campo</option>
                                                    <option >CGR-Córrego</option>
                                                    <option >CTN-Contorno</option>
                                                    <option >DSC-Descida</option>
                                                    <option >DSV-Desvio</option>
                                                    <option >DT-Distrito</option>
                                                    <option >EB-Entre Bloco</option>
                                                    <option >EIM-Estrada Intermunicipal</option>
                                                    <option >ENS-Enseada</option>
                                                    <option >ENT-Entrada Particular</option>
                                                    <option >EQ-Entre Quadra</option>
                                                    <option >ESC-Escada</option>
                                                    <option >ESD-Escadaria</option>
                                                    <option >ESE-Estrada Estadual</option>
                                                    <option >ESI-Estrada Vicinal</option>
                                                    <option >ESL-Estrada de Ligação</option>
                                                    <option >ESM-Estrada Municipal</option>
                                                    <option >ESP-Esplanada</option>
                                                    <option >ESS-Estrada de Servidão</option>
                                                    <option >EST-Estrada</option>
                                                    <option >ESV-Estrada Velha</option>
                                                    <option >ETA-Estrada Antiga</option>
                                                    <option >ETC-Estação</option>
                                                    <option >ETC-Estádio</option>
                                                    <option >ETN-Estância</option>
                                                    <option >ETP-Estrada Particular</option>
                                                    <option >ETT-Estacionamento</option>
                                                    <option >EVA-Evangélica</option>
                                                    <option >EVD-Elevada</option>
                                                    <option >EX-Eixo Industrial</option>
                                                    <option >FAV-Favela</option>
                                                    <option >FAZ-Fazenda</option>
                                                    <option >FER-Ferrovia</option>
                                                    <option >FNT-Fonte</option>
                                                    <option >FRA-Feira</option>
                                                    <option >FTE-Forte</option>
                                                    <option >GAL-Galeria</option>
                                                    <option >GJA-Granja</option>
                                                    <option >HAB-Núcleo Habitacional</option>
                                                    <option >IA-Ilha</option>
                                                    <option >IGP-Igarapé</option>
                                                    <option >IND-Indeterminado</option>
                                                    <option >IOA-Ilhota</option>
                                                    <option >JD-Jardim</option>
                                                    <option >JDE-Jardinete</option>
                                                    <option >LD-Ladeira</option>
                                                    <option >LGA-Lagoa</option>
                                                    <option >LGO-Lago</option>
                                                    <option >LOT-Loteamento</option>
                                                    <option >LRG-	Largo</option>
                                                    <option >LT-Lote</option>
                                                    <option >MER-Mercado</option>
                                                    <option >MNA-Marina</option>
                                                    <option >MOD-Modulo</option>
                                                    <option >MRG-Projeção</option>
                                                    <option >MRO-Morro</option>
                                                    <option >MTE-Monte</option>
                                                    <option >NUC-Núcleo</option>
                                                    <option >NUR-Núcleo Rural</option>
                                                    <option >O-Outros</option>
                                                    <option >OUT-Outeiro</option>
                                                    <option >PAR-Paralela</option>
                                                    <option >PAS-Passeio</option>
                                                    <option >PAT-Pátio</option>
                                                    <option >PC-Praça</option>
                                                    <option >PCE-Praça de Esportes</option>
                                                    <option >PDA-Parada</option>
                                                    <option >PDO-Paradouro</option>
                                                    <option >PNT-Ponta</option>
                                                    <option >PR-Praia</option>
                                                    <option >PRL-Prolongamento</option>
                                                    <option >PRM-Parque Municipal</option>
                                                    <option >PRQ-Parque</option>
                                                    <option >PRR-Parque Residencial</option>
                                                    <option >PSA-Passarela</option>
                                                    <option >PSG-Passagem</option>
                                                    <option >PSP-	Passagem de Pedestre</option>
                                                    <option >PSS-Passagem Subterrânea</option>
                                                    <option >PTE-Ponte</option>
                                                    <option >PTO-Porto</option>
                                                    <option >Q-Quadra</option>
                                                    <option >QTA-Quinta</option>
                                                    <option >QTS-Quintas</option>
                                                    <option >R-Rua</option>
                                                    <option >R I-Rua Integração</option>
                                                    <option >R L-Rua de Ligação</option>
                                                    <option >R P-Rua Particular</option>
                                                    <option >R V-Rua Velha</option>
                                                    <option >RAM-Ramal</option>
                                                    <option >RCR-Recreio</option>
                                                    <option >REC-Recanto</option>
                                                    <option >RER-Retiro</option>
                                                    <option >RES-Residencial</option>
                                                    <option >RET-Reta</option>
                                                    <option >RLA-Ruela</option>
                                                    <option >RMP-Rampa</option>
                                                    <option >ROA-Rodo Anel</option>
                                                    <option >ROD-Rodovia</option>
                                                    <option >ROT-Rotula</option>
                                                    <option >RPE-Rua de Pedestre</option>
                                                    <option >RPR-Margem</option>
                                                    <option >RTN-Retorno</option>
                                                    <option >RTT-Rotatória</option>
                                                    <option >SEG-Segunda Avenida</option>
                                                    <option >SIT-Sitio</option>
                                                    <option >SRV-Servidão</option>
                                                    <option >ST-Setor</option>
                                                    <option >SUB-Subida</option>
                                                    <option >TCH-Trincheira</option>
                                                    <option >TER-Terminal</option>
                                                    <option >TR-Trecho</option>
                                                    <option >TRV-Trevo</option>
                                                    <option >TUN-Túnel</option>
                                                    <option >TV-Travessa</option>
                                                    <option >TVP-Travessa Particular</option>
                                                    <option >TVV-Travessa Velha</option>
                                                    <option >UNI-Unidade</option>
                                                    <option >V-Via</option>
                                                    <option >V C-Via Coletora</option>
                                                    <option >V L-Via Local</option>
                                                    <option >VAC-Via de Acesso</option>
                                                    <option >VAL-Vala</option>
                                                    <option >VCO-Via Costeira</option>
                                                    <option >VD-Viaduto</option>
                                                    <option >V-E-Via Expressa</option>
                                                    <option >VER-Vereda</option>
                                                    <option >VEV-Via Elevado</option>
                                                    <option >VL-Vila</option>
                                                    <option >VLA-Viela</option>
                                                    <option >VLE-	Vale</option>
                                                    <option >VLT-Via Litorânea</option>
                                                    <option >VPE-Via de Pedestre</option>
                                                    <option >VRT-Variante</option>
                                                    <option >ZIG-	Zigue-Zague</option>
                                            </select>
                                        </div>
                        
                                        <div class="col-md-8 mt-2">
                                            <label for="bairro" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Bairro</label>
                                            <input type="text" class="form-control @error('bairro') is-invalid @enderror valid" name="bairro" value="{{old('bairro')}}" id="bairro" placeholder="Ex: Eldorado">
                                            @error('bairro')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                        
                                        <div class="col-md-8 mt-2">
                                            <label for="localidade" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Municipio</label>
                                            <input type="text" class="form-control @error('localidade') is-invalid @enderror valid" name="localidade" value="{{old('localidade')}}" id="localidade" placeholder="Ex: Florianópolis">
                                            @error('localidade')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                        
                        
                                        <div class="col-md-4 mt-2">
                                            <label for="uf" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> UF</label>
                                            <input type="text" class="form-control @error('uf') is-invalid @enderror valid" name="uf" value="{{old('uf')}}" id="uf" placeholder="Ex: SC">
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
                                    
                                    <section class="row taxas">
                                    
                                        <div class="col-md-3 mt-2">
                                            <label for="taxa_adm" class="form-label letter__color">Taxa Adm %</label>
                                            <input type="text" class="form-control @error('taxa_adm') is-invalid @enderror" name="taxa_adm" value="{{old('taxa_adm')}}" id="taxa_adm">
                                            @error('taxa_adm')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-3 mt-2">
                                            <label for="taxa__fed" class="form-label letter__color">Taxa Fed. %</label>
                                            <input type="text" class="form-control @error('taxa__fed') is-invalid @enderror" name="taxa__fed" value="{{old('taxa__fed')}}" id="taxa__fed">
                                            @error('taxa__fed')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <label for="deflator" class="form-label letter__color">% DEFLATOR</label>
                                            <input type="text" class="form-control @error('deflator') is-invalid @enderror" name="deflator" value="{{old('deflator')}}" id="deflator">
                                            @error('deflator')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <label for="das" class="form-label letter__color">DAS %</label>
                                            <input type="text" class="form-control @error('das') is-invalid @enderror" name="das" value="{{old('das')}}" id="das">
                                            @error('das')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                    </section>
                                    
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
                                    
                                    <section class="row parametro__sefip">
                                    
                                        <div class="col-md-4 mt-2">
                                            <label for="cod__fpas" class="form-label letter__color">Cod FPAS</label>
                                            <input type="text" class="form-control @error('cod__fpas') is-invalid @enderror " name="cod__fpas" value="{{old('cod__fpas')}}" id="cod__fpas">
                                            @error('cod__fpas')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-4 mt-2">
                                            <label for="cod__fap" class="form-label letter__color">Cod RAT</label>
                                            <input type="text" class="form-control @error('') is-invalid @enderror " name="cod__fap" value="" id="cod__fap">
                                            @error('cod__fap')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="cod__grps" class="form-label letter__color">Cod GRPS</label>
                                            <input type="text" class="form-control @error('cod__grps') is-invalid @enderror" name="cod__grps" value="{{old('cod__grps')}}" id="cod__grps">
                                            @error('cod__grps')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="cod__recol" class="form-label letter__color">Cod Recol</label>
                                            <input type="text" class="form-control @error('cod__recol') is-invalid @enderror" name="cod__recol" value="{{old('cod__recol')}}" id="cod__recol">
                                            @error('cod__recol')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="cnae" class="form-label letter__color">CNAE</label>
                                            <input type="text" class="form-control @error('cnae') is-invalid @enderror" name="cnae" value="{{old('cnae')}}" id="cnae">
                                            @error('cnae')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="fap__aliquota" class="form-label letter__color">FAP Aliquota %</label>
                                            <input type="text" class="form-control @error('fap__aliquota') is-invalid @enderror" name="fap__aliquota" value="{{old('fap__aliquota')}}" id="fap__aliquota">
                                            @error('fap__aliquota')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="rat__ajustado" class="form-label letter__color">RAT Ajustado %</label>
                                            <input type="text" class="form-control @error('rat__ajustado') is-invalid @enderror" name="rat__ajustado" value="{{old('rat__ajustado')}}" id="rat__ajustado">
                                            @error('rat__ajustado')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="fpas__terceiros" class="form-label letter__color">FPAS Terceiros</label>
                                            <input type="text" class="form-control @error('fpas__terceiros') is-invalid @enderror" name="fpas__terceiros" value="{{old('fpas__terceiros')}}" id="fpas__terceiros">
                                            @error('fpas__terceiros')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="aliq__terceiros" class="form-label letter__color">Aliq. Terceiros</label>
                                            <input type="text" class="form-control @error('aliq__terceiros') is-invalid @enderror" name="aliq__terceiros" value="{{old('aliq__terceiros')}}" id="aliq__terceiros">
                                            @error('aliq__terceiros')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div
                                    
                                    </section>
                                    
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
                                    
                                    <section class="row indice__fatura">
                                    
                                        <div class="col-md-6 mt-2">
                                            <label for="alimentacao" class="form-label letter__color"> Alimentação</label>
                                            <input type="text" class="form-control @error('alimentacao') is-invalid @enderror" name="alimentacao" value="{{old('alimentacao')}}" id="alimentacao">
                                            @error('alimentacao')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mt-2">
                                            <label for="transporte" class="form-label letter__color">Transporte</label>
                                            <input type="text" class="form-control @error('transporte') is-invalid @enderror" name="transporte" value="{{old('transporte')}}" id="transporte">
                                            @error('transporte')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mt-2">
                                            <label for="epi" class="form-label letter__color">EPI % (Sobre(PROD+DSR)Folha)</label>
                                            <input type="text" class="form-control @error('epi') is-invalid @enderror" name="epi" value="{{old('epi')}}" id="epi">
                                            @error('epi')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mt-2">
                                            <label for="seguro__trabalhador" class="form-label letter__color">Seguro (Val.Trab)</label>
                                            <input type="text" class="form-control @error('seguro__trabalhador') is-invalid @enderror" name="seguro__trabalhador" value="{{old('seguro__trabalhador')}}" id="seguro__trabalhador">
                                            @error('seguro__trabalhador')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    </section>
                                    
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
                                    
                                    <section class="indice__folha row">
                                    
                                        <div class="col-md-6 mt-2">
                                            <label for="folhartransporte" class="form-label letter__color">Vale Transporte</label>
                                            <input type="text" class="form-control @error('folhartransporte') is-invalid @enderror" name="folhartransporte" value="{{old('folhartransporte')}}" id="folhartransporte">
                                            @error('folhartransporte')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        
                                        <div class="col-md-6 mt-2">
                                            <label for="folharalim" class="form-label letter__color">Vale Alimentação</label>
                                            <input type="text" class="form-control @error('folharalim') is-invalid @enderror" name="folharalim" value="{{old('folharalim')}}" id="folharalim">
                                            @error('folharalim')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                    </section>    
                                    
                                </div>
                                
                            </div>
                        </div>
                                
                                
                                
                        <div class="accordion-item item__acorddion">
                            
                            <h2 class="accordion-header accoordion__header" id="cartao">
                                <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cartaoPonto__accoordion" aria-expanded="false" aria-controls="cartaoPonto__accoordion">
                                    <i class="me-1 fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i>Cartão Ponto <i class="ms-1 fad fa-clock"></i>
                                </button>
                            </h2>
                            
                            <div id="cartaoPonto__accoordion" class="accordion-collapse collapse" aria-labelledby="cartao" data-bs-parent="#accordionFlushExample">
                                
                                <div class="accordion-body row">
                                    
                                    <section class="row cartao__ponto">
                                    
                                        <div class="col-md-4 mt-2">
                                            <label for="dias_uteis" class="form-label letter__color"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Dias Úteis</label>
                                            <input type="time" class="form-control @error('dias_uteis') is-invalid @enderror" name="dias_uteis" value="{{old('dias_uteis')}}" id="dias_uteis">
                                            @error('dias_uteis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="sabados" class="form-label letter__color">Sábados</label>
                                            <input type="time" class="form-control @error('sabados') is-invalid @enderror" name="sabados" value="{{old('sabados')}}" id="sabados">
                                            @error('sabados')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mt-2">
                                            <label for="domingos" class="form-label letter__color">Domingos</label>
                                            <input type="time" class="form-control @error('domingos') is-invalid @enderror" name="domingos" value="{{old('domingos')}}" id="domingos">
                                            @error('domingos')
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
                                    Dados Bancários <i class="ms-1 fad fa-university"></i>
                                </button>
                            </h2>
                            
                            <div id="dadosBancarios" class="accordion-collapse collapse" aria-labelledby="banco" data-bs-parent="#accordionFlushExample">
                                
                                <div class="accordion-body row">
                                    
                                    <section class="dados__bancarios row">
                                    
                                        <div class="col-md-3 mt-2">
                                            <label for="banco" class="form-label letter__color">Banco</label>
                                            <input type="text" class="form-control @error('banco') is-invalid @enderror"  aria-describedby="inputGroupPrepend3 menssagem-banco" name="banco" value="{{old('banco')}}" id="banco" placeholder="digite o número do seu banco">
                                            <div id="menssagem-banco" class="valid-feedback">
                                               
                                            </div>
                                            @error('banco')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-2 mt-2">
                                            <label for="agencia" class="form-label letter__color">Agência</label>
                                            <input type="text" class="form-control @error('agencia') is-invalid @enderror" name="agencia" value="{{old('agencia')}}" id="agencia" placeholder="Ex: 0000">
                                            @error('agencia')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-2 mt-2">
                                            <label for="operacao" class="form-label letter__color">Operação</label>
                                            <input type="text" class="form-control @error('operacao') is-invalid @enderror" name="operacao" value="{{old('operacao')}}" id="operacao" placeholder="Ex: 000">
                                            @error('aperacao')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-2 mt-2">
                                            <label for="conta" class="form-label letter__color">Conta</label>
                                            <input type="text" class="form-control @error('conta') is-invalid @enderror" name="conta" value="{{old('conta')}}" id="conta" placeholder="Ex: 00000000-0">
                                            @error('conta')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-3 mt-2">
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
            @include('tomador.lista')
    </div>       
</main>
                 
            
            <script>

            // faz com que quando algum campo que está dentro do accordion não for preenchido
            // ele abra e não deixe enviar o formulário até que tudo esteje preenchido.
            function verificaCampoObrigatorioAccordion(){

                $('#incluir').click(function(e){
                    var cep = $('#cep').val();
                    var logradouro = $('#logradouro').val();
                    var numero = $('#numero').val();
                    var bairro = $('#bairro').val();
                    var localidade = $('#localidade').val();
                    var uf = $('#uf').val();
                    var diasUteis = $('#dias_uteis').val();
                    
                    // descobri na onde a section esta posicionada na tela//
                    let div = document.querySelector("#divEndereco");
                    let divCoordenadas = div.getBoundingClientRect();
                    // fim//
                    
                    var valorBottom = divCoordenadas.y;
                    var valorTop = divCoordenadas.x;
                    
                    if(cep, logradouro, numero, bairro, localidade, uf, diasUteis != ""){
                        $('#endereco__accordion').removeClass('show');
                        $('#endereco__accordion').removeClass('collapse');
                        $('#cartaoPonto__accoordion').removeClass('show');
                        $('#cartaoPonto__accoordion').removeClass('collapse');
                        event.defaultPrevented;
                    }else{
                        e.preventDefault(); 
                        $('#endereco__accordion').addClass('show');
                        $('#endereco__accordion').addClass('collapse');
                        $('#cartaoPonto__accoordion').addClass('show');
                        $('#cartaoPonto__accoordion').addClass('collapse');
                        // caso não tiver preenchido ele leva até a section que não foi preenchida
                        window.scrollTo(valorTop, valorBottom);
                        //fim
                    }

                });
            }
            
            verificaCampoObrigatorioAccordion();
            // fim da verificação do accordion//

            
        $(document).ready(function(){
           
            $('#pesquisa').on('keyup focus',function(){
                var dados = '0';
                if ($(this).val()) {
                    dados = $(this).val();
                    if (dados.indexOf('  ') !== -1) {
                        dados = monta_dados(dados);
                    }
                }
                $('#icon').addClass('d-none').next().removeClass('d-none')
                $.ajax({
                    url: "{{url('tomador')}}/pesquisa/"+dados,
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
                        // if(data.length === 1 && dados.length >= 2){
                        //     tomador(dados)
                        // }else if (dados.length === 14) {
                        //     pesquisa(dados)
                        // }else{
                        //     campo()
                        // }         
                     }
                });
            })
            $('#cnpj').on('change',function(){
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
                    url: "{{url('tomador')}}/"+dados,
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
                $('#incluir').removeAttr( "disabled" )
                $('#atualizar').attr('disabled','disabled')
                $('#deletar').attr('disabled','disabled')
                $('#method').val(' ')
                $('#excluir').attr( "disabled",'disabled' )
                $('#tabelapreco').addClass('disabled').removeAttr('href')
                for (let index = 0; index < $('.input').length; index++) {
                   $('.input').eq(index).val(' ')
                }
            }
            function carregado(data) {
                if (data.id) {
                    $('#form').attr('action', "{{ url('tomador')}}/"+data.tomador);
                    $('#formdelete').attr('action',"{{ url('tomador')}}/"+data.tomador) 
                    $('#incluir').attr('disabled','disabled')
                    $('#atualizar').removeAttr( "disabled" )
                    $('#deletar').removeAttr( "disabled" )
                    $('#excluir').removeAttr( "disabled" )
                    $('#tabelapreco').removeClass('disabled').attr('href',"{{ url('tabelapreco')}}/ /"+btoa(data.tomador))
                    $('#esocial').removeClass('disabled').attr('href',"{{ url('esocial/tomador')}}/"+btoa(data.tomador))
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
                for (let index = 0; index <  $('#tipo option').length; index++) {  
                    if (data.tstipo == $('#tipo option').eq(index).text()) {
                        $('#tipo option').eq(index).attr('selected','selected')
                    }else  {
                        $('#tipo option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#simple option').length; index++) {  
                    if (data.tssimples == $('#simple option').eq(index).text()) {
                        $('#simple option').eq(index).attr('selected','selected')
                    }else  {
                        $('#simple option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#complemento__endereco option').length; index++) {  
                    if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {
                        
                        $('#complemento__endereco option').eq(index).attr('selected','selected')
                    }else  {
                        $('#complemento__endereco option').eq(index).removeAttr('selected')
                    }
                }
                
                for (let index = 0; index <  $('#folhartipotrans option').length; index++) {  
                    if (data.instipotrans == $('#folhartipotrans option').eq(index).text()) {
                        
                        $('#folhartipotrans option').eq(index).attr('selected','selected')
                    }else  {
                        $('#folhartipotrans option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#folhartipoalim option').length; index++) {  
                    if (data.instipoali == $('#folhartipoalim option').eq(index).text()) {
                        
                        $('#folhartipoalim option').eq(index).attr('selected','selected')
                    }else  {
                        $('#folhartipoalim option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#retencaofgts option').length; index++) {  
                    if (data.rstipofgts == $('#retencaofgts option').eq(index).text()) {
                        
                        $('#retencaofgts option').eq(index).attr('selected','selected')
                    }else  {
                        $('#retencaofgts option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#retencaoinss option').length; index++) {  
                    if (data.rstipoinssempresa == $('#retencaoinss option').eq(index).text()) {
                        
                        $('#retencaoinss option').eq(index).attr('selected','selected')
                    }else  {
                        $('#retencaoinss option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#valorfatura option').length; index++) {  
                    if (data.rsvalorfatura == $('#valorfatura option').eq(index).text()) {
                        
                        $('#valorfatura option').eq(index).attr('selected','selected')
                    }else  {
                        $('#valorfatura option').eq(index).removeAttr('selected')
                    }
                }
            }
            function pesquisa(dados) {
                $.ajax({
                    url: "https://brasilapi.com.br/api/cnpj/v1/"+dados,
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
                        }else{
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
                        
                        $('#mensagem-pesquisa').text(' ').addClass('valid-feedback',).removeClass('invalid-feedback')
                    },
                    error: function(data){
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