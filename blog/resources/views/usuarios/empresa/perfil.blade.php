@extends('layouts.index')
@section('titulo','Rhweb - Meus Dados')
@section('conteine')
        <div class="container" >
            
            
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
                  title: '{{$message}}'
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
        
        <div class="bg__form1 container mt-5" style="border: 1px solid white; border-radius:12px;">
        
            <form class="row g-3 mt-1 mb-3" id="form" action="{{ route('empresa.store') }}" method="POST" action="" >
            <section>
               <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2" >
                        <label for="formFileSm" class="form-label d-none">Logo da Empresa</label>
                        <img class="rounded mx-auto d-block back__foto" id="trabfoto" src="" alt="logo do usuario" style="width: 200px; height: 200px;">
                    <input type="hidden" id="empresa" value="{{$user->empresa}}">
                </div>  
            
            </section>
                
                
                
                <h1 class="container text-center fs-4 fw-bold text-white">Cadastro de Empresas</h1>
                
                
                
                @csrf
                <input type="hidden" name="trabalhador" >
                <input type="hidden" name="tomador">
                <input type="hidden" id="method" name="_method" value="">
                
                
                <div class="col-md-8">
                    <label for="nome" class="form-label text-white">Nome</label>
                    <input type="text" class="form-control fw-bold" name="nome" id="nome">
                </div>

                <div class="col-md-4">
                    <label for="cnpj_mf" class="form-label text-white ">CNPJ/MF Nº</label>
                    <input type="text" class="form-control fw-bold" name="cnpj_mf" id="cnpj_mf">
                </div>

                <div class="col-md-4">
                    <label for="nome" class="form-label text-white">Data de Registro</label>
                    <input type="date" class="form-control fw-bold" name="dataregistro" id="dataregistro">
                </div>


                <div class="col-md-2">
                    <label for="cep" class="form-label text-white">CEP</label>
                    <input type="text" class="form-control fw-bold" name="cep" id="cep">
                </div>
                
                <div class="col-md-6">
                    <label for="logradouro" class="form-label text-white">Rua</label>
                    <input type="text" class="form-control fw-bold" name="logradouro" id="logradouro">
                </div>

                <div class="col-md-2">
                    <label for="numero" class="form-label text-white">Número</label>
                    <input type="text" class="form-control fw-bold" name="numero" id="numero">
                </div>

                
                <div class="col-md-4"> 
                                <label for="tipoconstrucao" class="form-label text-white">Tipo da construção</label>
                                <select name="complemento__endereco" id="complemento__endereco" class="form-select fw-bold">
                                <option selected >Casa</option>
                                <option >Apartamento</option>
                            </select>
                        </div>
                <div class="col-md-6">
                    <label for="bairro" class="form-label text-white">Bairro</label>
                    <input type="text" class="form-control fw-bold" name="bairro" id="bairro">
                </div>


                <div class="col-md-6">
                    <label for="localidade" class="form-label text-white">Municipio</label>
                    <input type="text" class="form-control fw-bold" name="localidade" id="localidade">
                </div>

                <div class="col-md-2">
                    <label for="uf" class="form-label text-white">UF</label>
                    <input type="text" class="form-control fw-bold" name="uf" id="uf">
                </div>
 
                <div class="col-md-4">
                    <label for="reponsave" class="form-label text-white">Responsavel</label>
                    <input type="text" class="form-control fw-bold" name="responsave" id="responsave">
                </div>
                
                <div class="col-md-4">
                    <label for="cnpj__reponsavel" class="form-label">CPF Responsável</label>
                    <input type="text" class="form-control  fw-bold" value="" name="cnpj__reponsavel" id="cnpj__reponsavel">
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="email" class="form-control fw-bold" name="email" id="email">
                </div>
                <div class="col-md-4">
                    <label for="seguro" class="form-label text-white">Seguro</label>
                    <input type="text" class="form-control fw-bold" name="seguro" id="seguro">
                </div>
                <div class="col-md-4">
                    <label for="cnae__codigo" class="form-label text-white">CNAE código</label>
                    <input type="text" class="form-control fw-bold" name="cnae__codigo" id="cnae__codigo">
                </div>

                <div class="col-md-4">
                    <label for="cod__municipio" class="form-label text-white">Código Município</label>
                    <input type="text" class="form-control fw-bold" name="cod__municipio" id="cod__municipio">
                </div>

                <div class="col-md-4">
                    <label for="sincalizado" class="form-label text-white">Sindicalizado</label>
                    <select id="sincalizado" name="sincalizado fw-bold" class="form-select fw-bold">
                        <option>1-Sim</option>
                        <option>2-Não</option>
                    </select>
                </div>

                <div class="col-md-2 d-none">
                    <label for="retem__ferias" class="form-label text-white">Retem Férias</label>
                    <select id="retem__ferias" name="retem__ferias " class="form-select fw-bold">
                        <option>1-Sim</option>
                        <option>2-Não</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="contribuicao__sindicato" class="form-label text-white">Contribuição ao Sindicato</label>
                    <input type="text" class="form-control fw-bold" name="contribuicao__sindicato" id="contribuicao__sindicato">
                </div>
                
                <div class="col-md-4">
                    <label for="telefone" class="form-label text-white">Telefone</label>
                    <input type="text" class="form-control fw-bold" name="telefone" id="telefone">
                </div>

                <h1 class="container text-center mt-5 mb-3 fs-4 fw-bold text-white">Valores para VT e VA Rúbricas</h1>


                

                <div class="col-md-4">
                    <label for="nro__fatura" class="form-label text-white">Nro Fatura <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="nro__fatura" id="nro__fatura" Readonly>
                </div>

                <div class="col-md-4">
                    <label for="nro__reciboavulso" class="form-label text-white">Nro Recibo Avulso <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="nro__reciboavulso" id="nro__reciboavulso" Readonly>
                </div>

                

                <div class="col-md-4">
                    <label for="nro__requisicao" class="form-label text-white">Nro Requisição <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="nro__requisicao" id="nro__requisicao" Readonly>
                </div>

                <div class="col-md-4">
                    <label for="nro__boletins" class="form-label text-white">Nro Boletins <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="nro__boletins" id="nro__boletins" Readonly>
                </div>

                <div class="col-md-4">
                    <label for="nro__folha" class="form-label text-white">Nro da Folha <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="nro__folha" id="nro__folha" Readonly>
                </div>

                <div class="col-md-4">
                    <label for="nro__cartaoponto" class="form-label text-white">Nro Cartão Ponto <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="nro__cartaoponto" id="nro__cartaoponto" Readonly>
                </div>

                <div class="col-md-4">
                    <label for="seq__esocial" class="form-label text-white">Seque E-Social <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="seq__esocial" id="seq__esocial" Readonly>
                </div>

                <div class="col-md-4">
                    <label for="cbo" class="form-label text-white">CBO <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="cbo" id="cbo" Readonly>
                </div>
                <div class="col-md-4 ">
                    <label for="matric__trabalhador" class="form-label text-white">Matrícula Trabalhador <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="matric__trabalhador" id="matric__trabalhador" Readonly>
                </div>
                <div class="col-md-4 ">
                    <label for="matric__tomador" class="form-label text-white">Matrícula Tomador <i class="fas fa-lock"></i></label>
                    <input type="text" class="form-control fw-bold" name="matric__tomador" id="matric__tomador" Readonly>
                </div>
                <div class="col-md-4 mb-5 d-none">
                    <label for="ambiente__esocial" class="form-label text-white">Ambiente E-Social <i class="fas fa-lock"></i></label>
                    <select id="ambiente__esocial" name="ambiente__esocial" class="form-select fw-bold" Readonly>
                        <option>1-Produção </option>
                        <option>2-Restrita</option>
                    </select>
                </div>
                
                    <input type="hidden" name="endereco" id="endereco">

                    <input type="hidden" name="bancario" id="bancario">
            </div>
        </form>
    </div>

        
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
        $(document).ready(function(){
            var empresa = $('#empresa').val()
            $.ajax({
                url: "{{url('listaempresa')}}/"+empresa,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    if (data.empresa) {
                        $('#nome').val(data.esnome)
                        campos(data);
                    }
                }
            })
            function campos(data) {
                $('#nome').val(data.esnome)
                $('#foto').val(data.esfoto)
                $('#trabfoto').attr('src',data.esfoto)
                $('#telefone').val(data.estelefone)
                $('#cnpj_mf').val(data.escnpj)
                $('#dataregistro').val(data.esdataregitro)
                $('#cep').val(data.escep)
                $('#logradouro').val(data.eslogradouro)
                $('#numero').val(data.esnum)
                $('#complemento__endereco').val(data.escomplemento)
                $('#bairro').val(data.esbairro)
                $('#localidade').val(data.esmunicipio)
                $('#uf').val(data.esuf)
                $('#responsave').val(data.esresponsavel)
                $('#email').val(data.esemail)
                $('#cnae__codigo').val(data.escnae)
                $('#cod__municipio').val(data.escodigomunicipio)
                $('#contribuicao__sindicato').val(data.escondicaosindicato)
                $('#seguro').val(data.esseguro)
            
                $('#nro__fatura').val(data.vsnrofatura)
                $('#nro__reciboavulso').val(data.vsreciboavulso)
                $('#matric__trabalhador').val(data.vimatricular)
                $('#matric__tomador').val(data.vimatriculartomador)
                $('#nro__requisicao').val(data.vsnrorequisicao)
                $('#nro__boletins').val(data.vsnroboletins)
                $('#nro__folha').val(data.vsnroflha)
                $('#nro__cartaoponto').val(data.vsnrocartaoponto)
                $('#seq__esocial').val(data.vsnroequesocial)
                $('#cbo').val(data.vscbo)
                $('#endereco').val(data.eiid)
                $('#bancario').val(data.biid)
                for (let index = 0; index <  $('#sincalizado option').length; index++) {  
                    if (data.essindicalizado == $('#sincalizado option').eq(index).text()) {
                        
                        $('#sincalizado option').eq(index).attr('selected','selected')
                    }else  {
                        $('#sincalizado option').eq(index).removeAttr('selected')
                    }
                }
                for (let index = 0; index <  $('#retem__ferias option').length; index++) {  
                    if (data.esretemferias == $('#retem__ferias option').eq(index).text()) {
                        
                        $('#retem__ferias option').eq(index).attr('selected','selected')
                    }else  {
                        $('#retem__ferias option').eq(index).removeAttr('selected')
                    }
                }
            }
        });
    </script>
    @stop