@extends('layouts.index')
@section('conteine')
<div class="container">
              <h5 class="card-title text-center fs-3 ">Cadastro de Usuários</h5>

                <!-- <p class="text-success">Usuario cadastrado com sucesso.</p>

                <p class="text-danger">Não foi possivel cadastrar o usuario.</p>

                <p class="text-danger">Usuario não cadastrado.</p> -->


              <form class="row g-3 mt-1 mb-3" method="POST" action="">

                <div class="row">
                  <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                      <a class="btn btn-outline-dark ms-2" href="#" role="button">Incluir</a>
                      <button type="button" class="btn btn-outline-dark ms-2  col-md-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Excluir
                        </button>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header " style="background-color:#000000;">
                                <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p class="text-black text-start">Deseja realmente excluir?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                <a class="btn btn-danger ms-2" href="#" role="button">Deletar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      <a class="btn btn-outline-dark ms-2 col-md-1" href="#" role="button">Editar</a>

                      <button type="button" class="btn btn-outline-dark ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Permissões
                      </button>
  
                      <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#080808;">
                              <h5 class="modal-title text-black text-white" id="exampleModalLabel">Permissões</h5>
                              <button type="button" class="btn-close bg-white " data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-black ">
                                <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                      Administrador
                                    </label>
                                  </div>
                                  <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label text-black text-start" for="defaultCheck1">
                                      Usuário
                                    </label>
                                  </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                              <a class="btn btn-success" href="#" role="button">Salvar</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <a class="btn btn-outline-dark ms-2 col-md-1" href="#" role="button">Sair</a>
                  </div>
              </div>

                <div class="col-md-4">
                  <label for="nome__completo" class="form-label">Nome</label>
                  <input type="text" class="form-control" name="nome__completo" value="" id="nome__completo">
                </div>

                <div class="col-md-3">
                  <label for="usuario" class="form-label">Usuario</label>
                  <input type="text" class="form-control" name="usuario" value="" id="usuario">
                </div>

                <div class="col-md-2">
                  <label for="cargo" class="form-label">Cargo</label>
                  <input type="text" class="form-control" name="cargo" value="" id="cargo">
                </div>

                <div class="col-md-3">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control" name="senha" value="" id="senha">
                </div>
              </form>  
            </div>         
@stop