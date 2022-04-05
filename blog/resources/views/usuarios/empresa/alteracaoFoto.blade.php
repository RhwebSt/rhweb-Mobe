@extends('layouts.index')
@section('titulo','Rhweb - Atualizar dados da Empresa')
@section('conteine')
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
            <div class="bg__form1 container mt-5" style="border: 1px solid white; border-radius:12px;">

               
                <section class="mt-5">
                    <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2" >
                        <form class="column g-3 mt-1 mb-3" id="form" action="" enctype="multipart/form-data"  method="Post">
                            @if($empresas->esfoto)
                            <img src="{{$empresas->esfoto}}" class="rounded mx-auto d-block back__foto" id="foto" alt="..." style="width: 200px; height: 200px;">
                            @else
                            <img src="{{url('/imagem/user1.png')}}" class="rounded mx-auto d-block back__foto" id="foto" alt="..." style="width: 200px; height: 200px;">
                            @endif
                            <div class="d-grid gap-2 col-8 col-sm-4 col-md-4 col-lg-2 mx-auto">
                                
                              </div>
                              <div class="alert alert-danger d-none" id="msgfoto" role="alert">
                                
                              </div>
    
                        </form>
                    </div>
                    
                    
                </section>
                
                <section class="">
                    <div class="container">
                    
                        <form class="row g-3 mt-1" id="form" action="{{ route('empresa.perfil.update',$user->empresa) }}" method="POST" action="" >
                                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                                <a class="btn botao__voltar" href="{{route('home.index')}}"><i class="fas fa-arrow-circle-left"></i> Voltar</a>
                                <button class="btn botao"  type="submit"><i class="fas fa-sync-alt"></i> Atualizar</button>
                                <button class="btn botao__alterar" type="button" onClick="BotaoAlterafoto()">Alterar foto <i class="fas fa-camera"></i></button>
                                </div>
                                <input type="hidden" id="empresa" value="{{$user->empresa}}"> 
                                <h1 class="container text-center text-white fs-4 fw-bold">Atualizar os dados</h1>
                                @csrf
                                <input type="hidden" name="foto" id="inputfoto" value="{{$empresas->esfoto}}">
                                <input type="hidden" name="trabalhador" >
                                <input type="hidden" name="tomador">
                                <input type="hidden" id="method" name="_method" value="PUT">
                                <div class="col-md-8">
                                    <label for="nome" class="form-label text-white">Nome</label>
                                    <input type="text" class="form-control @error('esnome') is-invalid @enderror fw-bold" name="esnome" value="{{$empresas->esnome}}" id="nome">
                                    @error('esnome')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                
                                <div class="col-md-4">
                                    <label for="cnpj_mf" class="form-label text-white ">CNPJ/MF Nº</label>
                                    <input type="text" class="form-control @error('escnpj') is-invalid @enderror fw-bold" name="escnpj" value="{{$empresas->escnpj}}" id="cnpj_mf">
                                    @error('escnpj')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="col-md-4">
                                    <label for="nome" class="form-label text-white">Data de Registro</label>
                                    <input type="date" class="form-control fw-bold @error('dataregistro') is-invalid @enderror" value="{{$empresas->esdataregitro}}" name="dataregistro" id="dataregistro">
                                    @error('dataregistro')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                
                                <div class="col-md-2">
                                    <label for="cep" class="form-label text-white">CEP</label>
                                    <input type="text" class="form-control @error('cep') is-invalid @enderror fw-bold" name="cep" value="{{$empresas->escep}}" id="cep">
                                    @error('cep')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="logradouro" class="form-label text-white">Rua</label>
                                    <input type="text" class="form-control @error('logradouro') is-invalid @enderror fw-bold" name="logradouro" value="{{$empresas->eslogradouro}}" id="logradouro">
                                    @error('logradouro')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="col-md-2">
                                    <label for="numero" class="form-label text-white">Número</label>
                                    <input type="text" class="form-control @error('numero') is-invalid @enderror fw-bold" name="numero" id="numero" value="{{$empresas->esnum}}">
                                    @error('numero')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                
                                <div class="col-md-4"> 
                                                <label for="tipoconstrucao" class="form-label text-white">Tipo da construção</label>
                                                <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                                                <?php
                                                    $tipo = [
                                                        'Casa',
                                                        'Apartamento',
                                                        'Empresa',
                                                        'Área',
                                                        'Acesso',
                                                        'Acampamento',
                                                        'Acesso Local',
                                                        'Área Especial',
                                                        'Aeroporto',
                                                        'Aldeia',
                                                        'Avenida Marginal Direita',
                                                        'Avenida Marginal Esquerda',
                                                        'Anel Viário',
                                                        'Antiga Estrada',
                                                        'Artéria',
                                                        'Alto',
                                                        'Atalho',
                                                        'Área Verde',
                                                        'Avenida',
                                                        'Avenida Contorno',
                                                        'Avenida Marginal',
                                                        'Avenida Velha',
                                                        'Balneário',
                                                        'Beco',
                                                        'Buraco',
                                                        'Bloco',
                                                        'Chácara',
                                                        'Conjunto',
                                                        'Colônia',
                                                        'Comunidade',
                                                        'Condomínio',
                                                        'Distrito',
                                                        'Estrada Intermunicipal',
                                                        'Entrada Particular',
                                                        'Estação',
                                                        'Estância',
                                                        'Eixo Industrial',
                                                        'Favela',
                                                        'Fazenda',
                                                        'Núcleo Habitacional',
                                                        'Jardim',
                                                        'Loteamento',
                                                        'Lote',
                                                        'Morro',
                                                        'Núcleo Rural',
                                                        'Parque Residencial',
                                                        'Quadra',
                                                        'Rua',
                                                        'Residencial',
                                                        'Rodovia',
                                                        'Trevo',
                                                        'Outros',
                                                    ]
                                                ?>
                                                @foreach($tipo as $tipos)
                                                    @if($tipos === $empresas->escomplemento)
                                                        <option selected >{{$empresas->escomplemento}}</option>
                                                    @else
                                                        <option >{{$tipos}}</option>
                                                    @endif
                                                @endforeach
                                               
                                               
                                            </select>
                                        </div>
                                <div class="col-md-6">
                                    <label for="bairro" class="form-label text-white">Bairro</label>
                                    <input type="text" class="form-control @error('bairro') is-invalid @enderror fw-bold" value="{{$empresas->esbairro}}" name="bairro" id="bairro">
                                    @error('bairro')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                
                                <div class="col-md-6">
                                    <label for="localidade" class="form-label text-white">Municipio</label>
                                    <input type="text" class="form-control @error('localidade') is-invalid @enderror fw-bold" value="{{$empresas->esmunicipio}}" name="localidade" id="localidade">
                                    @error('localidade')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="col-md-2">
                                    <label for="uf" class="form-label text-white">UF</label>
                                    <input type="text" class="form-control @error('uf') is-invalid @enderror fw-bold" value="{{$empresas->esuf}}" name="uf" id="uf">
                                    @error('uf')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                 
                                <div class="col-md-4">
                                    <label for="reponsave" class="form-label text-white">Responsável</label>
                                    <input type="text" class="form-control @error('responsave') is-invalid @enderror fw-bold" value="{{$empresas->esresponsavel}}" name="responsave" id="responsave">
                                    @error('responsave')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="cnpj__reponsavel" class="form-label text-white">CPF Responsável</label>
                                    <input type="text" class="form-control  fw-bold" value="" name="cpf" id="cnpj__reponsavel">
                                    @error('')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="col-md-4">
                                    <label for="email" class="form-label text-white">Email</label>
                                    <input type="email" class="form-control fw-bold @error('email') is-invalid @enderror fw-bold" value="{{$empresas->esemail}}" name="email" id="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="seguro" class="form-label text-white">Seguro</label>
                                    <input type="text" class="form-control @error('seguro') is-invalid @enderror fw-bold" value="{{$empresas->esseguro}}" name="seguro" id="seguro">
                                    @error('seguro')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="cnae__codigo" class="form-label text-white">CNAE código</label>
                                    <input type="text" class="form-control @error('cnae__codigo') is-invalid @enderror fw-bold" value="{{$empresas->escnae}}" name="cnae__codigo" id="cnae__codigo">
                                    @error('cnae__codigo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="col-md-4">
                                    <label for="cod__municipio" class="form-label text-white">Código Município</label>
                                    <input type="text" class="form-control @error('cod__municipio') is-invalid @enderror fw-bold" value="{{$empresas->escodigomunicipio}}" name="cod__municipio" id="cod__municipio">
                                    @error('cod__municipio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="col-md-4">
                                    <label for="sincalizado" class="form-label text-white">Sindicalizado</label>
                                    <select id="sincalizado" name="sincalizado"  class="form-select fw-bold">
                                        @if($empresas->escodigomunicipio === '1-Sim')
                                        <option selected>1-Sim</option>
                                        <option>2-Não</option>
                                        @else
                                        <option>1-Sim</option>
                                        <option selected>2-Não</option>
                                        @endif
                                    </select>
                                </div>
                
                                <div class="col-md-2 d-none">
                                    <label for="retem__ferias" class="form-label text-white">Retem Férias</label>
                                    <select id="retem__ferias" name="retem__ferias" class="form-select fw-bold">
                                        @if($empresas->esretemferias === '1-Sim')
                                        <option selected>1-Sim</option>
                                        <option>2-Não</option>
                                        @else
                                        <option>1-Sim</option>
                                        <option selected>2-Não</option>
                                        @endif
                                    </select>
                                </div>
                
                                <div class="col-md-4">
                                    <label for="contribuicao__sindicato" class="form-label text-white">Contribuição ao Sindicato</label>
                                    <input type="text" class="form-control @error('contribuicao__sindicato') is-invalid @enderror fw-bold" name="contribuicao__sindicato" value="{{$empresas->escondicaosindicato}}" id="contribuicao__sindicato">
                                    @error('contribuicao__sindicato')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="telefone" class="form-label text-white">Telefone</label>
                                    <input type="text" class="form-control @error('telefone') is-invalid @enderror fw-bold" name="telefone" value="{{$empresas->estelefone}}" id="telefone">
                                    @error('telefone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        </form>
                </div>
                </section>
            </div>

        <script>
            
            function BotaoAlterafoto() {
                (async () => {
                    const { value: file } = await Swal.fire({
                    title: 'Selecione sua imagem',
                    input: 'file',
                    confirmButtonText:'Enviar <i class="far fa-paper-plane"></i>',
                    inputAttributes: {
                        'accept': 'image/*',
                        'aria-label': 'Upload your profile picture', 
                        'class': 'false'
                    }
                    })

                    if (file) {
                        var ext = ['jpg','jpeg','png','svg','tiff','webp']
                        var type = file.type.split('/')
                        if (file.size < 3145728) {
                            if (ext.indexOf(type[1]) >= 1) {
                                const reader = new FileReader()
                                reader.onload = (e) => {
                                    Swal.fire({
                                    title: 'Foto atualizada!!',
                                    imageUrl: e.target.result,
                                    imageAlt: 'Foto atualizada',
                                    confirmButtonText:'Ok',
                                    })
                                    var myFormData = new FormData();
                                    myFormData.append('image_file', e.target.result);
                                    myFormData.append('_token','{{ csrf_token() }}')
                                    myFormData.append('empresa',"{{$user->empresa}}")
                                    $.ajax({
                                        url: "{{url('foto/editer')}}",
                                        type: 'POST',
                                        data: myFormData,
                                        cache: false,
                                        processData: false,
                                        contentType: false,
                                        beforeSend: function() {    
                                        },  
                                        complete: function() {  
                                        },              
                                        success: function(data) {
                                            $('#foto').attr('src',e.target.result)
                                            $('#inputfoto').val(e.target.result)       
                                        },
                                    })
                                }
                                reader.readAsDataURL(file)
                            }else{
                                $('#msgfoto').removeClass('d-none').text('A extensão não é suportada. Apenas(jpg, png,svg,tiff,webp)')
                            }
                        } else {
                            Swal.showValidationMessage('O tamanho suportado é de até 3MB')
                            $('#msgfoto').removeClass('d-none').text('O tamanho suportado é de até 3MB');
                        }  
                        
                }
            })()  
            }
           
        </script>
@stop