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
                      title: '{{$message}}'
                    })
                </script>
            @enderror     
            <form class="row g-3 mt-1 mb-3" id="form" action="{{ route('usuariotrabalhador.store') }}" method="POST" action="" >
           
            @can('admin')
                <div class="row">
                    <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" class="btn  text-white btn-primary "  >
                            Incluir
                        </button>
                        <button type="submit" id="atualizar" disabled class="btn  text-white btn-primary "  >
                            Editar
                        </button>
                        <button type="button" id="excluir" disabled class="btn  text-white btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                            Excluir
                        </button>
                    
                        <a class="btn   text-white btn-primary " href="#" role="button" >Sair</a>
                    </div>
                </div>
                
                @else
                <input type="hidden" id="empresa" value="{{$user->empresa}}">
                @endcan
                <h1 class="container text-center mt-5 fs-4 fw-bold">Cadastro de Empresas</h1>
                @csrf
                <input type="hidden" name="trabalhador" >
                <input type="hidden" name="tomador">
        <input type="hidden" id="method" name="_method" value="">
                <div class="col-md-7">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control pesquisa" name="nome" id="nome">
                </div>

                <div class="col-md-2">
                    <label for="cnpj_mf" class="form-label ">CNPJ/MF Nº</label>
                    <input type="text" class="form-control " name="cnpj_mf" id="cnpj_mf">
                </div>

                <div class="col-md-3">
                    <label for="nome" class="form-label">Data de Registro</label>
                    <input type="date" class="form-control" name="dataregistro" id="dataregistro">
                </div>


                <div class="col-md-2">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" name="cep" id="cep">
                </div>
                
                <div class="col-md-6">
                    <label for="logradouro" class="form-label">Rua</label>
                    <input type="text" class="form-control" name="logradouro" id="logradouro">
                </div>

                <div class="col-md-1">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name="numero" id="numero">
                </div>

                
                <div class="col-md-3"> 
                                <label for="tipoconstrucao" class="form-label">Tipo da construção</label>
                                <select name="complemento__endereco" id="complemento__endereco" class="form-select">
                                <option selected >Casa</option>
                                <option >Apartamento</option>
                            </select>
                        </div>
                <div class="col-md-5">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" name="bairro" id="bairro">
                </div>


                <div class="col-md-5">
                    <label for="localidade" class="form-label">Municipio</label>
                    <input type="text" class="form-control" name="localidade" id="localidade">
                </div>

                <div class="col-md-2">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control" name="uf" id="uf">
                </div>

                <div class="col-md-2">
                    <label for="reponsave" class="form-label">Responsavel</label>
                    <input type="text" class="form-control" name="responsave" id="responsave">
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>

                <div class="col-md-2">
                    <label for="cnae__codigo" class="form-label">CNAE código</label>
                    <input type="text" class="form-control" name="cnae__codigo" id="cnae__codigo">
                </div>

                <div class="col-md-2">
                    <label for="cod__municipio" class="form-label">Código Município</label>
                    <input type="text" class="form-control" name="cod__municipio" id="cod__municipio">
                </div>

                <div class="col-md-2">
                    <label for="sincalizado" class="form-label">Sindicalizado</label>
                    <select id="sincalizado" name="sincalizado" class="form-select">
                        <option>1-Sim</option>
                        <option>2-Não</option>
                    </select>
                </div>

                <div class="col-md-2 d-none">
                    <label for="retem__ferias" class="form-label">Retem Férias</label>
                    <select id="retem__ferias" name="retem__ferias" class="form-select">
                        <option>1-Sim</option>
                        <option>2-Não</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="contribuicao__sindicato" class="form-label">Contribuição ao Sindicato</label>
                    <input type="text" class="form-control" name="contribuicao__sindicato" id="contribuicao__sindicato">
                </div>

                <h1 class="container text-center mt-5 mb-3 fs-4 fw-bold">Valores para VT e VA Rúbricas</h1>


                <div class="col-md-2">
                    <label for="vt__trabalhador" class="form-label">VT Trabalhador</label>
                    <input type="text" class="form-control" name="vt__trabalhador" id="vt__trabalhador">
                </div>


                <div class="col-md-2">
                    <label for="va__trabalhador" class="form-label">VA Trabalhador</label>
                    <input type="text" class="form-control" name="va__trabalhador" id="va__trabalhador">
                </div>

                <div class="col-md-2">
                    <label for="nro__fatura" class="form-label">Nro Fatura</label>
                    <input type="text" class="form-control" name="nro__fatura" id="nro__fatura">
                </div>

                <div class="col-md-2">
                    <label for="nro__reciboavulso" class="form-label">Nro Recibo Avulso</label>
                    <input type="text" class="form-control" name="nro__reciboavulso" id="nro__reciboavulso">
                </div>

                <div class="col-md-2 d-none">
                    <label for="matric__trabalhador" class="form-label">Matrícula Trabalhador</label>
                    <input type="text" class="form-control" name="matric__trabalhador" id="matric__trabalhador">
                </div>

                <div class="col-md-2">
                    <label for="nro__requisicao" class="form-label">Nro Requisição</label>
                    <input type="text" class="form-control" name="nro__requisicao" id="nro__requisicao">
                </div>

                <div class="col-md-2">
                    <label for="nro__boletins" class="form-label">Nro Boletins</label>
                    <input type="text" class="form-control" name="nro__boletins" id="nro__boletins">
                </div>

                <div class="col-md-2">
                    <label for="nro__folha" class="form-label">Nro da Folha</label>
                    <input type="text" class="form-control" name="nro__folha" id="nro__folha">
                </div>

                <div class="col-md-2">
                    <label for="nro__cartaoponto" class="form-label">Nro Cartão Ponto</label>
                    <input type="text" class="form-control" name="nro__cartaoponto" id="nro__cartaoponto">
                </div>

                <div class="col-md-2">
                    <label for="seq__esocial" class="form-label">Seque E-Social</label>
                    <input type="text" class="form-control" name="seq__esocial" id="seq__esocial">
                </div>

                <div class="col-md-2">
                    <label for="cbo" class="form-label">CBO</label>
                    <input type="text" class="form-control" name="cbo" id="cbo">
                </div>

                <div class="col-md-2 mb-5 d-none">
                    <label for="ambiente__esocial" class="form-label">Ambiente E-Social</label>
                    <select id="ambiente__esocial" name="ambiente__esocial" class="form-select">
                        <option>1-Produção </option>
                        <option>2-Restrita</option>
                    </select>
                </div>
                <input type="hidden" name="endereco" id="endereco">

<input type="hidden" name="bancario" id="bancario">
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
    </div>
    <script>
        $(document).ready(function(){
            var empresa = $('#empresa').val()
            $.ajax({
                url: "{{url('usuariotrabalhador')}}/"+empresa,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                    if (data.empresa) {
                        $('#nome').val(data.esnome)
                        campos(data);
                    }
                }
            })
            $( ".pesquisa" ).keyup(function() {
                var dados = $(this).val();
                $.ajax({
                    url: "{{url('usuariotrabalhador')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data.empresa) {
                            $('#form').attr('action', "{{ url('usuariotrabalhador')}}/"+data.empresa);
                            $('#formdelete').attr('action',"{{ url('usuariotrabalhador')}}/"+data.empresa)
                            $('#incluir').attr('disabled','disabled')
                            $('#atualizar').removeAttr( "disabled" )
                            $('#deletar').removeAttr( "disabled" )
                            $('#excluir').removeAttr( "disabled" )
                            $('#method').val('PUT')
                            
                        }else{
                        
                            $('#form').attr('action', "{{ route('usuariotrabalhador.store') }}");
                            $('#incluir').removeAttr( "disabled" )
                            $('#depedente').removeAttr( "disabled" )
                            $('#atualizar').attr('disabled','disabled')
                            $('#deletar').attr('disabled','disabled')
                            $('#method').val(' ')
                            $('#excluir').attr( "disabled" )
                        }
                        campos(data);
                    }
                });
            });
            function campos(data) {
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

                $('#vt__trabalhador').val(data.vsvttrabalhador)
                $('#va__trabalhador').val(data.vsvatrabalhador)
                $('#nro__fatura').val(data.vsnrofatura)
                $('#nro__reciboavulso').val(data.vsreciboavulso)
                $('#matric__trabalhador').val(data.vsmatricula)
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
                // for (let index = 0; index <  $('#ambiente__esocial option').length; index++) {  
                //     if (data.esretemferias == $('#ambiente__esocial option').eq(index).text()) {
                        
                //         $('#ambiente__esocial option').eq(index).attr('selected','selected')
                //     }else  {
                //         $('#ambiente__esocial option').eq(index).removeAttr('selected')
                //     }
                // }
            }
        });
    </script>
    @stop