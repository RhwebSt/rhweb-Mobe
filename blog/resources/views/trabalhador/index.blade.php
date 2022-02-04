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
                
        
        
        <form class="row g-3" id="form" action="{{ route('trabalhador.store') }}" enctype="multipart/form-data"  method="POST">
        
            <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                <button type="submit" id="incluir" class="btn botao"><i class="fas fa-save"></i> Incluir</button>
                <button type="submit" id="atualizar" disabled class="btn botao"><i class="fas fa-sync-alt"></i> Atualizar</button>
                <button type="button" class="btn botao" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-trash"></i> Excluir
                          </button>
                    <!-- <a class="btn btn btn-primary" href="{{ route('trabalhador.index') }}" role="button">Consultar</a> -->
                    
                    <button class="btn botao dropdown-toggle disabled" type="button" id="relatoriotrabalhador"  data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-file-invoice"></i> Relatórios
                     </button>
                      <ul class="dropdown-menu" aria-labelledby="relatoriotrabalhador">
                        <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="imprimir" role="button">Ficha de Registro</a></li>
                        <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="fichaepi" role="button">Ficha de EPI</a></li>
                        <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="declaracao__afas" role="button">Declaração de Afastamento</a></li>
                        <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="declaracao__adm" role="button">Declaração de Admissão</a></li>
                        <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="cracha" role="button">Crachá</a></li>
                        <li class=""><a class="dropdown-item text-decoration-none ps-2"  id="devolucao__ctps" role="button">Devolução da CTPS</a></li>
                      </ul>
                    <a class="btn botao disabled"  id="depedente" role="button"><i class="fas fa-users"></i> Dependentes</a>
                    
                    <button type="button" class="btn botao disabled d-none" id="recibopagamento" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <i class="fad fa-file-invoice"></i> Recibos
                    </button>
                    

                    <a class="btn botao" href="{{route('home.index')}}" role="button"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
            
            <div class="container mt-5 text-start fs-5 fw-bold">Pesquisar <i class="fas fa-search"></i></div>
 
            <div class="col-md-5 mb-5 p-1 pesquisar">
                <div class="d-flex">
                <label for="exampleDataList" class="form-label"></label>
                <input class="form-control fw-bold text-dark pesquisa text-uppercase" list="datalistOptions" name="pesquisa" id="pesquisa">
                <datalist id="datalistOptions" class="text-uppercase">
                </datalist>
                <i class="fas fa-search fa-md iconsear" id="icon"></i>
                <div class="text-center d-none p-1" id="refres" >
                    <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                </div>
            </div>
            
           
            
            <div class="container text-center mt-4 mb-3   fs-4 fw-bold">Identificação do Trabalhador <i class="fad fa-user-hard-hat"></i></div>
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden"  name="deflator" >
            <input type="hidden"  name="tomador" >
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
                  <input class="form-control form-control-sm nice"   onchange="encodeImageFileAsURL(this)" id="formFileSm" type="file">
                  <span id="msgfoto" class="text-danger"></span>
                </div>
            </div>
    
            <input type="hidden" name="foto" id="foto">
                <div class="col-md-6">
                  <label for="nome__completo" class="form-label">Nome Completo</label>
                  <input type="text" class="form-control input @error('nome__completo') is-invalid @enderror fw-bold text-dark" value="{{old('nome__completo')}}" name="nome__completo" maxlength="100" id="nome__completo">
                  @error('nome__completo')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label for="nome__social" class="form-label">Nome Social (OPICIONAL)</label>
                  <input type="text" class="form-control input fw-bold text-dark @error('nome__social') is-invalid @enderror fw-bold text-dark" value="{{ old('nome__social')}}" maxlength="100" name="nome__social" id="nome__social">
                  @error('nome__social')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
    
                <div class="col-md-3">
                  <label for="cpf" class="form-label">CPF</label>
                  <input type="text" class="form-control input fw-bold text-dark cpf-mask @error('cpf') is-invalid @enderror fw-bold text-dark" value="{{old('cpf')}}" name="cpf" id="cpf" maxlength="15">
                  @error('cpf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
    
                <?php
                  if ($valorrublica_matricular->vimatricular) {
                    $matricular = $valorrublica_matricular->vimatricular + 1;
                  }else{
                    $matricular = 1;
                  }
                ?>
                <div class="col-md-3 " >
                  <label for="matricula" class="form-label">Matrícula<i class="fas fa-lock"></i></label>
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
                    <select id="sexo" name="sexo" class="form-select fw-bold text-dark" >
                      <option selected>Masculino</option>
                      <option>Feminino</option>
                      <option >Outro</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="estado__civil" class="form-label">Estado Civil</label>
                    <select id="estado__civil" name="estado__civil" class="form-select fw-bold text-dark" >
                      <option selected>Solteiro</option>
                      <option>Casado</option>
                      <option>Separados</option>
                      <option>Divorciados</option>
                      <option>viúvo</option>
                    </select>
                </div>
    
                <div class="col-md-4">
                    <label for="raca" class="form-label">Raça</label>
                    <select id="raca" name="raca" class="form-select fw-bold text-dark">
                      <option selected>Negro</option>
                      <option>Pardo</option>
                      <option>Branco</option>
                      <option>Indígena</option>
                      <option>Amarela</option>
                      <option>Não informado</option>
                    </select>
                </div>
    
                <div class="col-md-4">
                    <label for="grau__instrucao" class="form-label">Grau de Instrução</label>
                    <select id="grau__instrucao" name="grau__instrucao" class="form-select fw-bold text-dark" value="">
                      <option selected>Superior Completo</option>
                      <option>Superior incompleto</option>
                      <option>Ensino Médio Completo</option>
                      <option>Ensino Médio Incompleto</option>
                      <option>Ensino Fundamental Completo</option>
                      <option>Ensino Fundamental Incompleto</option>
                      <option>Lê e Escreve</option>
                      <option>Analfabetos</option>
                    </select>
                </div>
    
    
                <div class="col-md-4">
                  <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                  <input type="date" class="form-control input fw-bold text-dark  @error('data_nascimento') is-invalid @enderror" value="{{old('data_nascimento')}}" maxlength="2" name="data_nascimento"  id="data_nascimento" >
                  @error('data_nascimento')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
    
    
                <div class="col-md-4">
                  <label for="pais__nascimento" class="form-label">País de Nascimento</label>
                  <input type="text" list="pais_nascimento_list" class="form-control input fw-bold text-dark  @error('pais__nascimento') is-invalid @enderror"  value="{{old('pais__nascimento')}}" maxlength="20" name="pais__nascimento" id="pais__nascimento" >
                  @error('pais__nascimento')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <datalist id="pais_nascimento_list">
                  </datalist>
                </div>
    
                <div class="col-md-4">
                    <label for="pais__nacionalidade" class="form-label">País de Nacionalidade</label>
                    <input type="text" list="pais_nacionalidade_list" class="form-control input fw-bold text-dark @error('pais__nacionalidade') is-invalid @enderror"  value="{{old('pais__nacionalidade')}}" maxlength="20" name="pais__nacionalidade" id="pais__nacionalidade" >
                    @error('pais__nacionalidade')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <datalist id="pais_nacionalidade_list">
                  </datalist>
                </div>
    
                <div class="col-md-8">
                  <label for="nome__mae" class="form-label">Nome da Mãe</label>
                  <input type="text" class="form-control input fw-bold text-dark @error('nome__mae') is-invalid @enderror"  value="{{old('nome__mae')}}" maxlength="100" name="nome__mae" id="nome__mae" >
                  @error('nome__mae')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
    
                <div class="container text-center  fs-4 fw-bold mt-4 mb-3">Local de Residência <i class="fad fa-map-marked-alt"></i></div>
    
                <div class="col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control input @error('cep') is-invalid @enderror" maxlength="16" value="{{old('cep')}}" name="cep" id="cep">
                    @error('cep')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-7">
                    <label for="logradouro" class="form-label">Rua</label>
                    <input type="text" class="form-control input  @error('logradouro') is-invalid @enderror" maxlength="50" value="{{old('logradouro')}}" name="logradouro" id="logradouro">
                    @error('logradouro')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control input @error('numero') is-invalid @enderror" maxlength="10" value="{{old('numero')}}" name="numero" id="numero">
                    @error('numero')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="col-md-4"> 
                    <label for="tipoconstrucao" class="form-label">Tipo</label>
                    <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                      <option selected >Casa</option>
                      <option >Apartamento</option>
                      <option >Empresa</option>
                      <option >Área</option>
                      <option >Acesso</option>
                      <option >Acampamento</option>
                      <option >Acesso Local</option>
                      <option >Área Especial</option>
                      <option >Aeroporto</option>
                      <option >Aldeia</option>
                      <option >Avenida Marginal Direita</option>
                      <option >Avenida Marginal Esquerda</option>
                      <option >Anel Viário</option>
                      <option >Antiga Estrada</option>
                      <option >Artéria</option>
                      <option >Alto</option>
                      <option >Atalho</option>
                      <option >Área Verde</option>
                      <option >Avenida</option>
                      <option >Avenida Contorno</option>
                      <option >Avenida Marginal</option>
                      <option >Avenida Velha</option>
                      <option >Balneário</option>
                      <option >Beco</option>
                      <option >Buraco</option>
                      <option >Bloco</option>
                      <option >Chácara</option>
                      <option >Conjunto</option>
                      <option >Colônia</option>
                      <option >Comunidade</option>
                      <option >Condomínio</option>
                      <option >Distrito</option>
                      <option >Estrada Intermunicipal</option>
                      <option >Entrada Particular</option>
                      <option >Estação</option>
                      <option >Estância</option>
                      <option >Eixo Industrial</option>
                      <option >Favela</option>
                      <option >Fazenda</option>
                      <option >Núcleo Habitacional</option>
                      <option >Jardim</option>
                      <option >Loteamento</option>
                      <option >Lote</option>
                      <option >Morro</option>
                      <option >Núcleo Rural</option>
                      <option >Parque Residencial</option>
                      <option >Quadra</option>
                      <option >Rua</option>
                      <option >Residencial</option>
                      <option >Rodovia</option>
                      <option >Trevo</option>
                      <option >Outros</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control input @error('bairro') is-invalid @enderror" maxlength="40"  value="{{old('bairro')}}" name="bairro" id="bairro">
                    @error('bairro')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-7">
                    <label for="localidade" class="form-label">Municipio</label>
                    <input type="text" class="form-control input @error('localidade') is-invalid @enderror" maxlength="30" value="{{old('localidade')}}" name="localidade" id="localidade">
                    @error('localidade')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control input @error('uf') is-invalid @enderror" maxlength="2" value="{{old('uf')}}" name="uf" id="uf">
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
                  <input type="date" class="form-control input fw-bold text-dark  @error('data__admissao') is-invalid @enderror" value="{{old('data__admissao')}}"  name="data__admissao" id="data__admissao" >
                  @error('data__admissao')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
    
                <div class="col-md-4">
                  <label for="categoria" class="form-label">Categoria</label>
                  <input type="text" list="categoria_list" class="form-control input fw-bold text-dark  @error('categoria__contrato') is-invalid @enderror" value="{{old('categoria__contrato')}}"  maxlength="100" name="categoria__contrato" id="categoria">
                  @error('categoria__contrato')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                  <datalist id="categoria_list">
                  </datalist>
                </div>
    
                <div class="col-md-4">
                  <label for="cbo" class="form-label">CBO</label>
                  <input type="text" list="cbo_list" class="form-control input fw-bold text-dark  @error('cbo') is-invalid @enderror" value="{{old('cbo')}}"  name="cbo" id="cbo" value="">
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
                      <option selected >Ativo</option>
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
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header modal__delete">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Competência</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form id="formrelatorioempresa" method="post">
                          @csrf
                          <input type="hidden" name="trabalhador" id="trabalhador">
                         
                          <div class="modal-body modal-delbody">
                            <div class="mb-3 bg-dark p-2 rounded">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" id="inlineCheckbox1" name="tipo" value="option1">
                                  <label class="form-check-label mt-1" for="inlineCheckbox1">Recibo de Pagamento</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" id="inlineCheckbox2" name="tipo" value="option2">
                                  <label class="form-check-label mt-1" for="inlineCheckbox2">Empresas Trabalhadas</label>
                                </div>
                                <!-- <div class="form-check d-none form-check-inline">
                                  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                  <label class="form-check-label mt-1" for="inlineCheckbox3">3 (disabled)</label>
                                </div> -->
                                
                                
                            </div>
                            
                            <div>
                                <div class="col-md-12 mt-2 mb-2 p-1 pesquisar">
                                    <div class="d-flex">
                                    <label for="exampleDataList" class="form-label"></label>
                                    <input class="form-control fw-bold text-dark pesquisa" list="datalistOptions" name="pesquisa" id="pesquisa">
                                    <datalist id="datalistOptions">
                                    </datalist>
                                    <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                    <div class="text-center d-none" id="refres" >
                                        <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black;">
                                            <span class="visually-hidden">Carregando...</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                              
                             <div class="d-flex ">
                                <div class="col-md-5 ms-1 input">
                                  <label for="ano" class="form-label">Data Inicial</label>
                                  <input type="date" class="form-control " name="ano_inicial" value="" id="tano">
                                </div>
                                
                                <div class="col-md-5 input ms-3">
                                  <label for="ano" class="form-label">Data Final</label>
                                  <input type="date" class="form-control " name="ano_final" value="" id="tano">
                                </div>
                            </div>

                          </div>
                          <div class="modal-footer modal-delfooter">
                            <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn__deletar"><i class="fas fa-print"></i> Imprimir</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                 
        <script type="text/javascript" src="{{url('/js/cbo.js')}}"></script>
        <script>
         function encodeImageFileAsURL(element) {
            var file = element.files[0];
            var ext = ['jpg','jpeg','png','svg','tiff','webp']
            var type = file.type.split('/')
            if (file.size < 3145728) {
                if (ext.indexOf(type[1]) >= 1) {
                    foto(file)
                }else{
                    $('#msgfoto').text('A extensão não é suportada. Apenas(jpg, png,svg,tiff,webp)')
                }
            }else{
                $('#msgfoto').text('O tamanho suportado é até 3MB')
            }
          }
          function foto(file) {
            var reader = new FileReader();
            reader.onloadend = function() {
            $('#foto').val(reader.result)
            $('#trabfoto').attr('src',reader.result)
            }
            reader.readAsDataURL(file);
          }
          
        $(document).ready(function(){
          let paisnascimento = ''
          let cbolist = ''
          let categorialist = ''
         
          $('#pais__nacionalidade,#pais__nascimento').on('keyup focus',function () {
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
              $('#formrelatorioempresa').attr('action',"")
            }else if ($(this).val() === 'option2') {
              $('#formrelatorioempresa').attr('action',"")
            }
          })
          $('#cbo').on('keyup focus',function () {
            if (!$(this).val()) {
              cbolista(cbo);
            }
          })

          $('#categoria').on('keyup focus',function () {
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
            $( "#pesquisa" ).on('keyup focus',function() {
                let dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                  }
                }
                $('#icon').addClass('d-none').next().removeClass('d-none')
                $.ajax({
                    url: "{{url('trabalhador')}}/pesquisa/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#trabfoto').removeAttr('src')
                      $('#refres').addClass('d-none').prev().removeClass('d-none')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#datalistOptions').html(nome)
                      } 
                      if(data.length === 1 && dados.length >= 4){
                        buscaItem(dados)
                      }else{
                        campo()
                      }              
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
                  url: "{{url('trabalhador')}}/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    localStorage.setItem('hdHlKMtd',btoa(data.trabalhador));
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
              $('#incluir').removeAttr( "disabled" )
              $('#depedente').removeAttr( "disabled" )
              $('#atualizar').attr('disabled','disabled')
              $('#deletar').attr('disabled','disabled')
              $('#method').val(' ')
              $('#excluir').attr('disabled','disabled')
              for (let index = 0; index < $('.input').length; index++) {
                  $('.input').eq(index).val(' ') 
              }
            }
            function trabalhador(data) {
              if (data.trabalhador) {
                  $('#form').attr('action', "{{ url('trabalhador')}}/"+data.trabalhador);
                  $('#formdelete').attr('action',"{{ url('trabalhador')}}/"+data.trabalhador)
                  $('#depedente').removeClass('disabled')
                  $('#depedente').attr('href',"{{ url('depedente')}}/"+data.trabalhador+'/mostrar')
                  $('#incluir').attr('disabled','disabled')
                  $('#atualizar').removeAttr( "disabled" )
                  $('#deletar').removeAttr( "disabled" )
                  $('#excluir').removeAttr( "disabled" )

                  $('#method').val('PUT')
                  $('#recibopagamento').removeClass('disabled')
                  $('#relatoriotrabalhador').removeClass('disabled')
                  $('#imprimir').removeClass('disabled').attr('href',"{{url('ficha/registro/trabalhador')}}/"+btoa(data.trabalhador))
                  $('#fichaepi').removeClass('disabled').attr('href',"{{url('ficha/epi/trabalhador')}}/"+btoa(data.trabalhador))
                  $('#cracha').removeClass('disabled').attr('href',"{{url('cracha/trabalhador')}}/"+btoa(data.trabalhador))
                  $('#declaracao__adm').removeClass('disabled').attr('href',"{{url('declaracao/admissao/trabalhador')}}/"+btoa(data.trabalhador))
                  $('#declaracao__afas').removeClass('disabled').attr('href',"{{url('declaracao/afastamento/trabalhador')}}/"+btoa(data.trabalhador))
                  $('#devolucao__ctps').removeClass('disabled').attr('href',"{{url('devolucao/ctps/trabalhador')}}/"+btoa(data.trabalhador))
                  $('#trabalhador').val(data.trabalhador)
              }else{
                $('#relatoriotrabalhador').addClass('disabled')
                $('#imprimir').addClass('disabled')
                $('#fichaepi').addClass('disabled')
                $('#depedente').addClass('disabled')
                $('#form').attr('action', "{{ route('trabalhador.store') }}");
                $('#incluir').removeAttr( "disabled" )
                $('#depedente').removeAttr( "disabled" )
                $('#atualizar').attr('disabled','disabled')
                $('#deletar').attr('disabled','disabled')
                $('#recibopagamento').addClass('disabled')
                $('#method').val(' ')
                $('#excluir').attr('disabled','disabled')
              }
              $('#nome__completo').val(data.tsnome).next().text(' ')
              $('#nome__social').val(data.tsnomesocial).next().text(' ')
              $('#foto').val(data.tsfoto)
              $('#trabfoto').attr('src',data.tsfoto)
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
             
              for (let index = 0; index <  $('#situacao__contrato option').length; index++) {  
                if (data.cssituacao == $('#situacao__contrato option').eq(index).text()) {
                  $('#situacao__contrato option').eq(index).attr('selected','selected')
                }else  {
                  $('#situacao__contrato option').eq(index).removeAttr('selected')
                }
              }
              for (let index = 0; index <  $('#sexo option').length; index++) {  
                if (data.tssexo == $('#sexo option').eq(index).text()) {
                  $('#sexo option').eq(index).attr('selected','selected')
                }else  {
                  $('#sexo option').eq(index).removeAttr('selected')
                }
              }
              for (let index = 0; index <  $('#complemento__endereco option').length; index++) {  
                if (data.escomplemento == $('#complemento__endereco option').eq(index).text()) {
                  $('#complemento__endereco option').eq(index).attr('selected','selected')
                }else  {
                  $('#complemento__endereco option').eq(index).removeAttr('selected')
                }
              }
              for (let index = 0; index <  $('#estado__civil option').length; index++) {  
                if (data.nscivil === $('#estado__civil option').eq(index).text()) {
                  $('#estado__civil option').eq(index).attr('selected','selected')
                }else{
                  $('#estado__civil option').eq(index).removeAttr('selected')
                }
              }
              for (let index = 0; index <  $('#raca option').length; index++) {  
                if (data.nsraca === $('#raca option').eq(index).text()) {
                  $('#raca option').eq(index).attr('selected','selected')
                }else{
                  $('#raca option').eq(index).removeAttr('selected')
                }
              }
              for (let index = 0; index <  $('#grau__instrucao option').length; index++) {  
                if (data.tsescolaridade === $('#grau__instrucao option').eq(index).text()) {
                  $('#grau__instrucao option').eq(index).attr('selected','selected')
                }else{
                  $('#grau__instrucao option').eq(index).removeAttr('selected')
                }
              }
                
              }
        });
    </script>
@stop