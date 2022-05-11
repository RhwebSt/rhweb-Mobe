@extends('layouts.index')
@section('titulo','Rhweb - Dados Pessoais')
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


    <form class="row g-3 mt-1 mb-3" id="form" action="" method="POST" action="" >
           
            @can('admin')
                <div class="row">
                    <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" class="btn botao"  >
                            <i class="fad fa-save"></i>Salvar
                        </button>
                        <a class="btn botao" href="#" role="button" ><i class="fad fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
                
                <h1 class="container text-center fs-4 fw-bold">Dados Pessoais</h1>

                
                
                <div class="col-md-8">
                    <label for="nome" class="form-label ">Nome
                        <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                    </label>
                    <input type="text" class="form-control fw-bold" value="" name="nome" id="nome">

                </div>
                
                
                <div class="col-md-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control fw-bold" value="" name="cpf" id="cpf">
                </div>

                

                <div class="col-md-3">
                    <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control fw-bold" value="" name="data__nascimento"  id="data__nascimento">
                </div>


                <div class="col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control @error('cep') is-invalid @enderror fw-bold" maxlength="16" value="{{old('cep')}}" name="cep" id="cep">
                    @error('cep')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="logradouro" class="form-label">Rua</label>
                    <input type="text" class="form-control  @error('logradouro') is-invalid @enderror fw-bold" maxlength="50" value="{{old('logradouro')}}" name="logradouro" id="logradouro">
                    @error('logradouro')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control @error('numero') is-invalid @enderror fw-bold" maxlength="10" value="{{old('numero')}}" name="numero" id="numero">
                    @error('numero')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                
                <div class="col-md-3"> 
                                <label for="tipoconstrucao" class="form-label">Tipo</label>
                                <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                                <option selected >Casa</option>
                                <option >Apartamento</option>
                                <option >Empresa</option>
                            </select>
                        </div>
                <div class="col-md-5">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control @error('bairro') is-invalid @enderror fw-bold" maxlength="40"  value="{{old('bairro')}}" name="bairro" id="bairro">
                    @error('bairro')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-5">
                    <label for="localidade" class="form-label">Municipio</label>
                    <input type="text" class="form-control @error('localidade') is-invalid @enderror fw-bold" maxlength="30" value="{{old('localidade')}}" name="localidade" id="localidade">
                    @error('localidade')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control @error('uf') is-invalid @enderror fw-bold" maxlength="2" value="{{old('uf')}}" name="uf" id="uf">
                    @error('uf')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
 
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control fw-bold @error('email') is-invalid @enderror fw-bold"  value="{{old('email')}}" name="email" id="email">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                
                <div class="col-md-4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control @error('telefone') is-invalid @enderror fw-bold" value="{{old('telefone')}}" name="telefone" id="telefone">
                    @error('telefone')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                

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
                            <p class="mb-1 text-start">Deseja realmente excluir?</p>
                        </div>
                        <div class="modal-footer modal-delfooter">
                        <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn__deletar">Deletar</button>

                        </div>
                    </form>
                </div>
                </div>
            </div>
            
            <script>
                 var botaolimpaCampos = document.querySelector("#refre");

                botaolimpaCampos.addEventListener('click', function(){
                    var cep = document.querySelector("#cep").value='';
                    var logradouro = document.querySelector("#logradouro").value='';
                    var numero = document.querySelector("#numero").value='';
                    var complementoEndereco = document.querySelector("#complemento__endereco").value='';
                    var bairro = document.querySelector("#bairro").value='';
                    var localidade = document.querySelector("#localidade").value='';
                    var uf = document.querySelector("#uf").value='';
                    var nome = document.querySelector("#nome").value='';
                    var cpf = document.querySelector("#cpf").value='';
                    var telefone = document.querySelector("#telefone").value='';
                }
            
                </script>