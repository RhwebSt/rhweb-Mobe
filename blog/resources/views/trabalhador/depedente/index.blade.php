@extends('layouts.index')
@section('conteine')
<div class="container">
@if($errors->all())
                    @foreach($errors->all() as  $error)
                      @if($error === 'edittrue')
                        <div class="alert alert-success mt-2 alert-block">
                            <strong>Atualização realizada com sucesso!</strong>
                        </div>
                    @elseif($error === 'editfalse')
                        <div class="alert alert-danger mt-2 alert-block">
                            <strong>Não foi possível atualizar os dados!</strong>
                        </div>
                    @elseif($error === 'deletatrue')
                        <div class="alert alert-success mt-2 alert-block">
                            <strong>Registro deletado com sucesso!</strong>
                        </div>
                    @elseif($error === 'cadastratrue')
                        <div class="alert alert-success mt-2 alert-block">
                            <strong>Cadastrado realizada com sucesso!</strong>
                        </div>
                    @elseif($error === 'cadastrafalse')
                        <div class="alert alert-danger mt-2 alert-block">
                            <strong>Não foi possível realizar o cadastro !</strong>
                        </div>
                    @endif
                    @endforeach
                @endif  

            <div class="container row">
                <div class="col-2 mt-5">
                    <h5 class="card-title text-center fs-3 ">Dependentes</h5>
                </div>
                <div class="col text-end mt-5">
                    <div class="btn " role="button" aria-label="Basic example">
                            <a class="btn botao" href="{{ route('depedente.mostrar.create',$id) }}" role="button">Incluir</a>
                            <a class="btn botao" href="{{ route('trabalhador.index') }}" role="button">Sair</a>
                    </div>
                </div> 
            </div>
            <table class="table border-bottom text-white mt-3 mb-5 table-responsive" style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236));">
                <thead>
                    <th class="col text-black border-right border-left text-white text-center" style="width: 400px;">Nome</th>
                    <th class="col text-center" style="width:115px;">CPF</th>
                    <th class="col text-center">Tipo</th>
                    <th class="col text-center" style="width:170px">Data de nascimento</th>
                    <th class="col text-center" style="width:110px;">IRRF</th>
                    <th class="col text-center" style="width:110px;">SF</th>
                    <th colspan="2" class="col text-center" style="width:190px;">Ações</th>
                </thead>
                <tbody style="background-color: #4C5454; color: white;">
                @if(count($depedentes) > 0)
                @foreach ($depedentes as $depedente)
                    <tr>               
                        <td class=" border-right border-left text-center  border-right border-left text-capitalize" style="width: 400px;">
                            {{$depedente->dsnome}}
                        </td>
                        <td class=" text-center  border-right border-left" style="width:115px;">
                            {{$depedente->dscpf}}
                        </td>
                        <td class=" text-center  border-right border-left text-capitalize">
                            {{$depedente->dstipo}}
                        </td>
                        <td class=" text-center" style="width:170px">
                            @if($depedente->dsdata)
                                <?php
                                    $data = explode('-',$depedente->dsdata);
                                    $data = $data[2]."/".$data[1]."/".$data[0];
                                ?>
                                {{$data}}
                            @endif
                        </td>
                        <td class=" text-center  border-right border-left" style="width:110px;">
                            {{$depedente->dsirrf}}
                        </td>
                        <td class=" text-center  border-right border-left" style="width:110px;">
                            {{$depedente->dssf}}
                        </td>
                        <td class=" text-center" style="width:190px;">
                            <a href="{{ route('depedente.edit',$depedente->id) }}" class="btn btn-block botao me-3">Editar</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Excluir
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('depedente.destroy',$depedente->id) }}" id="formdelete" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header " style="background-image:linear-gradient(80deg, rgb(71, 42, 236), #1250d6, #0751f3, rgb(71, 42, 236))">
                                        <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <p class="text-black">Deseja realmente excluir?</p>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn botao" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-danger">Deletar</button>

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
                    <td class="bg-light text-black" colspan="7">
                    <div class="alert alert-danger" role="alert">
                    Não a resgistro cadastrador!
                </div>
                    </td>
                </tr>
                
                @endif
                </tbody>

            </table>
        </div>
@stop