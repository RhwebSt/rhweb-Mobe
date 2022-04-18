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
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap">
                    <div class="btn " role="button" aria-label="Basic example">
                            <a class="btn botao" href="{{ route('depedente.mostrar.create',$id) }}" role="button"><i class="fad fa-save"></i> Incluir</a>
                            <a class="btn botao" href="{{ route('trabalhador.index') }}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
                
                <div class="col-12 mb-5 mt-5">
                    <h5 class="card-title text-center fs-3 ">Dependentes <i class="fad fa-users"></i></h5>
                </div>
            </div>
            
            <section class="table">
                <div class="table-responsive-xxl">
                    <table class="table">
                        <thead class="tr__header">
                            <th class="th__header text-nowrap">Nome</th>
                            <th class="th__header text-nowrap" style="width:100px;">CPF</th>
                            <th class="th__header text-nowrap">Tipo</th>
                            <th class="th__header text-nowrap" style="width:100px">Data de nascimento</th>
                            <th class="th__header text-nowrap" style="width:100px;">IRRF</th>
                            <th class="th__header text-nowrap" style="width:100px;">SF</th>
                            <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                            <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                        </thead>
                        
                        <tbody class="table__body">
                        @if(count($depedentes) > 0)
                        @foreach ($depedentes as $key=>$depedente)
                            <tr class="tr__body">               
                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$depedente->dsnome}}" style="max-width: 40ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                        <a>{{$depedente->dsnome}}</a>
                                </td>
                                <td class="td__body text-nowrap col" style="width:100px;">
                                    {{$depedente->dscpf}}
                                </td>
                                <td class="td__body text-nowrap col">
                                    {{$depedente->dstipo}}
                                </td>
                                <td class="td__body text-nowrap col" style="width:100px">
                                    @if($depedente->dsdata)
                                        <?php
                                            $data = explode('-',$depedente->dsdata);
                                            $data = $data[2]."/".$data[1]."/".$data[0];
                                        ?>
                                        {{$data}} 
                                    @endif
                                </td>
                                <td class="td__body text-nowrap col" style="width:100px;">
                                    {{$depedente->dsirrf}}
                                </td>
                                <td class="td__body text-nowrap col" style="width:100px;">
                                    {{$depedente->dssf}}
                                </td>
                                
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    <a class="button__editar btn modal-botao" href="{{ route('depedente.edit',base64_encode($depedente->id)) }}"><i class="icon__color fas fa-pen"></i></a>
                                </td>
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    
                                    <button class="btn button__excluir modal-botao" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$key}}">
                                        <i class="icon__color fad fa-trash"></i>
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <tfoot>
                            <tr class="">
                                <td colspan="11">
                                    
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </section>
            
        </div>
@stop