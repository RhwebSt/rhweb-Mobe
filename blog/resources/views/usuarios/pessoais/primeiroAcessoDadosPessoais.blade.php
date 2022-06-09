<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="" />
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>Cadastrar dados pessoais - RHWEB</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/reset.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/usuario/cadastroEmpresa.css')}}">
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <nav class="navbar bg-dark">
          <div class="container-fluid">
            <a class=""><img class="navbar-brand" src="{{url('/imagem/rhwebTop2.png')}}" alt="" srcset="" style="width: 90px;"></a>
          </div>
        </nav>
        
        <main class="container">
            @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: "{{session('success')}}",
                    text: 'Agora que está tudo pronto, faça o login.',
                    footer: `<a href="{{route('login.create')}}">Clique aqui para fazer o login</a>`,
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
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
            
            <h1 class="text__welcome">Bem Vindo!!</h1>
            
            

            <section class="mt-5">
                <div class="container d-flex justify-content-center flex-column align-items-center">
                    <img class="foto__empresa" id="trabfoto" src="{{url('imagem/iconFotoTrab.jpg')}}" alt="logo do usuario">
                </div>
            </section>
            
            <h1 class="title__principal">Dados Pessoais</h1>
    
            <section class="">
                <form class="row g-3" id="form" action="" method="POST">
                    @csrf


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
                        <?php
                            $tipo = [
                                'A-Área',
                                'AC-Acesso',
                                'ACA-Acampamento',
                                'ACL-Acesso Local',
                                'AD-Adro',
                                'AE-Área Especial',
                                'AER-Aeroporto',
                                'AL-Alameda',
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
                                'BEL-Belvedere',
                                'BL-Bloco',
                                'BLO-Balão',
                                'BLS-Blocos',
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
                                'CJM-Conjunto Mutirão',
                                'CMP-Complexo Viário',
                                'COL-Colônia',
                                'COM-Comunidade',
                                'CON-Condomínio',
                                'COR-Corredor',
                                'CPO-Campo',
                                'CRG-Córrego',
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
                                'ETD-Estádio',
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
                                'MRG-Projeção',
                                'MRO-Morro',
                                'MTE-Monte',
                                'NUC-Núcleo',
                                'NUR-Núcleo Rural',
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
                                'PSP-Passagem de Pedestre',
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
                                'VLE-Vale',
                                'VLT-Via Litorânea',
                                'VPE-Via de Pedestre',
                                'VRT-Variante',
                                'ZIG-Zigue-Zague'
                            ]
                        ?>
                        @foreach($tipo as $tipos)
                            @if($tipos === $pessoais->escomplemento)
                                <option selected >{{$pessoais->escomplemento}}</option>
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

                    <div class="justify-content-end d-flex" role="group" aria-label="Basic example">
                        <button class="btn botao__cadastrar" type="submit">Cadastrar <i class="fas fa-save"></i></button>
                    </div>
                </form>
            </section>
            
            
            
        </main>
        
        <footer>
            <p class="text-nowrap">&copy;Copyright RHWEB Sistemas Inteligentes - 2022</p>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
            $('#cep').mask("00000-000")
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $("#telefone").mask("(00) 00000-0000");
        </script>
    </body>
</html>