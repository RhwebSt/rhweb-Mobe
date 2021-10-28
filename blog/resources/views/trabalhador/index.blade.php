@extends('layouts.index')
@section('conteine')
<div class="container">
            <div class="btn mt-5  " role="button" aria-label="Basic example">
                    <a class="btn btn btn-outline-dark" href="{{route('trabalhador.create')}}" role="button">Cadastrar</a>
                    <a class="btn btn btn-outline-dark" href="" role="button">Sair</a>
            </div>
        </div>

        <h1 class="container text-center mt-3 fs-4">Trabalhadores Cadastrados</h1>
        
        <div class="container responsive">
            <table class="table border-bottom text-white table-responsive" style="background-color: #310FC9">
                <thead>
                    <th class="col">Nome</th>
                    <th class="col">CPF</th>
                    <th class="col">Mátricula</th>
                    <th class="col">Cargo</th>
                    <th class="col">Data de Admissão</th>
                    <th class="col">Data de Afastamento</th>
                    <th colspan="2" class="col">Ações</th>
                </thead>
                <tbody>
                @if(count($trabalhadors) > 0)
                    @foreach ($trabalhadors as $trabalhador)
                        <tr>
                    <td class="bg-light text-black">
                        {{$trabalhador->tsnome}}
                    </td>
                    <td class="bg-light text-black">
                        {{$trabalhador->tscpf}}
                    </td>
                    <td class="bg-light text-black">
                        {{$trabalhador->tsmatricula}}
                    </td>
                    <td class="bg-light text-black"></td>
                    <td class="bg-light text-black">
                        {{$trabalhador->csafastamento}}
                    </td>
                    <td class="bg-light text-black">
                        {{$trabalhador->csafastamento}}
                    </td>
                    <td class="bg-light text-black"><a href="#" class="btn btn-block me-3" style="background-color:#1750ee; Color: #fefeff;">Editar</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Excluir
                          </button>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header " style="background-color:#000000;">
                                  <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                                  <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p class="text-black">Deseja realmente excluir?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                  <button type="button" class="btn btn-danger">Deletar</button>
                                </div>
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
                <tfoot>
                    <tr >
                        <td class="bg-light text-black" colspan="8">
                        {{ $trabalhadors->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
@stop