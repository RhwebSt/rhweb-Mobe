@extends('layouts.index')
@section('titulo','Rhweb - Dados Pessoais')
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


        <form class="row g-3" id="form" action="{{ route('perfil.update',$user->id) }}" method="POST">
            @csrf
            @method('put')
            
            <section class="section__botoes--dados--pessoais">
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao">
                        <i class="fad fa-save"></i> Salvar
                    </button>
                </div>
            </section>
   
            <h1 class="title__dados--pessoais">Dados Pessoais <i class="fad fa-user-cog"></i></h1>

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
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control @error('numero') is-invalid @enderror" maxlength="10" value="{{isset($pessoais->esnum) ? $pessoais->esnum : ''}}" name="numero" id="numero">
                @error('numero')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3"> 
                <label for="tipoconstrucao" class="form-label">Tipo</label>
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
@stop