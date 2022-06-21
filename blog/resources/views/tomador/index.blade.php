@extends('layouts.index')
@section('titulo','Tomador - Rhweb')
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
        
        <!--Modal de Acesso não permitido-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--      icon: 'error',-->
        <!--      allowOutsideClick: false,-->
        <!--      allowEscapeKey: false,-->
        <!--      allowEnterKey: true,-->
        <!--      html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+-->
        <!--      '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+-->
        <!--      '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',-->
        <!--      showConfirmButton: false,-->
        <!--    });-->
        <!--</script>-->
        <!--Fim do modal de Acesso não permitido-->

        <!--Modal de não permitido para o Editar, relatorio, excluir e outros botoes-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--        icon: 'error',-->
        <!--        title: 'Você não tem Permissão',-->
        <!--        text: 'Contate seu Administrador para receber acesso.',-->
        <!--        allowOutsideClick: false,-->
        <!--        allowEscapeKey: false,-->
        <!--        allowEnterKey: true,-->
        <!--    });-->
        <!--</script>-->
        <!--fim do modal-->

            <form class="row g-3" novalidate id="form" action="{{ route('tomador.cadastra') }}"  method="Post">
                
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
                    if ( isset($valorrublica_matricular->valoresrublica[0]->vimatriculartomador)) {
                        $matricular = $valorrublica_matricular->valoresrublica[0]->vimatriculartomador + 1;
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
                                            <input type="time" class="form-control @error('dias_uteis') is-invalid @enderror" name="dias_uteis" value="{{old('dias_uteis') ?? '08:00'}}" id="dias_uteis">
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

<script type="text/javascript" src="{{url('/js/user/tomador/index.js')}}"></script>

@stop