@extends('layouts.index')
@section('titulo','Rhweb - Depedentes')
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

            <div class="container row">
                <div class="col-12 mt-5">
                    <h5 class="card-title text-start fs-3 ">Dependentes <i class="fad fa-users"></i></h5>
                </div>
                
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap">
                    <div class="btn " role="button" aria-label="Basic example">
                            <a class="btn botao" href="{{ route('depedente.mostrar.create',$id) }}" role="button"><i class="fas fa-save"></i> Incluir</a>
                            <a class="btn botao" href="{{ route('trabalhador.index') }}" role="button"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div> 
            </div>
            <div class="table-responsive-xxl">
                <table class="table border-bottom text-white mt-3 mb-5" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                    <thead>
                        <th class="col text-center border-start border-top text-nowrap" style="width: 450px;">Nome</th>
                        <th class="col text-center border-top text-nowrap" style="width:115px;">CPF</th>
                        <th class="col text-center border-top text-nowrap">Tipo</th>
                        <th class="col text-center border-top text-nowrap" style="width:200px">Data de nascimento</th>
                        <th class="col text-center border-top text-nowrap" style="width:110px;">IRRF</th>
                        <th class="col text-center border-top text-nowrap" style="width:110px;">SF</th>
                        <th class="col text-center border-top text-nowrap" style="width:60px;">Editar</th>
                        <th class="col text-center border-end border-top text-nowrap" style="width:60px;">Excluir</th>
                    </thead>
                    <tbody style="background-color: #081049; color: white;">
                    @if(count($depedentes) > 0)
                    @foreach ($depedentes as $depedente)
                        <tr class="bodyTabela">               
                            <td class="col text-center border-bottom border-start text-nowrap text-uppercase" style="width: 450px;">
                                {{$depedente->dsnome}}
                            </td>
                            <td class="col text-center border-bottom text-nowrap" style="width:115px;">
                                {{$depedente->dscpf}}
                            </td>
                            <td class="col text-center border-bottom text-uppercase text-nowrap">
                                {{$depedente->dstipo}}
                            </td>
                            <td class="col text-center border-bottom text-nowrap" style="width:200px">
                                @if($depedente->dsdata)
                                    <?php
                                        $data = explode('-',$depedente->dsdata);
                                        $data = $data[2]."/".$data[1]."/".$data[0];
                                    ?>
                                    {{$data}}
                                @endif
                            </td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:110px;">
                                {{$depedente->dsirrf}}
                            </td>
                            <td class="col text-center border-bottom text-nowrap text-uppercase" style="width:110px;">
                                {{$depedente->dssf}}
                            </td>
                            
                            <td class="col text-center border-bottom text-nowrap" style="width:60px;">
                                <button class="btn" style="background-color:#204E83;">
                                <a href="{{ route('depedente.edit',$depedente->id) }}" class="" ><i style="color:#FFFFFF; padding-left: 3px;" class="fal fa-edit"></i></a>
                                </button>
                            </td>
                            <td class="col text-center border-bottom border-end text-nowrap" style="width:60px;">
                                
                                
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color:#FF331F">
                                    <i style="color:#FFFFFF; padding-right: 3px;" class="fal fa-trash"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('depedente.destroy',$depedente->id) }}" id="formdelete" method="post">
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
                                </div></td>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center border-end border-start text-nowrap" colspan="11" style="background-color: #081049; color: white;">
                            <div class="alert" role="alert" style="background-color: #CC2836;">
                                Não a registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></i>
                            </div>
                        </td>
                    </tr>
                    
                    @endif
                    </tbody>
    
                </table>
            </div>
        </div>
@stop