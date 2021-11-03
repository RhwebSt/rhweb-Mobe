@extends('layouts.index')
@section('conteine')
    <div class="container">
    <form class="row g-3 mt-1 mb-3" method="POST" action="" >

                <h1 class="container text-center mt-4 mb-2 fs-4 fw-bold">Faixa de Cálculos</h1>

                <div class="row">
                    <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                        <a class="btn ms-2 text-white" href="#" role="button" style="background-color: #194bf0;">Incluir</a>
                        <button type="button" class="btn ms-2  col-md-1 text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #194bf0;">
                            Excluir
                        </button>
                        
                        <a class="btn  btn-md ms-2 col-md-1 text-white" href="#" role="button" style="background-color: #194bf0;;" >Editar</a>
                        <a class="btn ms-2 col-md-1 text-white" href="#" style="background-color: #194bf0;" role="button">Sair</a>
                    </div>
                </div>

                <div class="container block">
                    <div class="col-md-1">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="text" class="form-control" name="ano" id="ano">
                    </div>
                </div>
                
                
                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial" id="valor__inicial">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final" id="valor__final">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">IRRF</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial" id="valor__inicial">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final" id="valor__final">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">IRRF</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial" id="valor__inicial">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final" id="valor__final">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">IRRF</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial" id="valor__inicial">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final" id="valor__final">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">IRRF</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3">
                    <label for="valor__inicial" class="form-label">Valor Inicial</label>
                    <input type="text" class="form-control" name="valor__inicial" id="valor__inicial">
                </div>

                <div class="col-md-3">
                    <label for="valor__final" class="form-label">Valor Final</label>
                    <input type="text" class="form-control" name="valor__final" id="valor__final">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">Indíce %</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

                <div class="col-md-3 ">
                    <label for="indice" class="form-label">IRRF</label>
                    <input type="text" class="form-control" name="indice" id="indice">
                </div>

            </form>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header " style="background-image: linear-gradient(-120deg, rgb(32, 36, 236),rgb(16, 78, 248));">
                      <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color: #fffdfd;">
                      <p class="text-black text-start fs-5">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer" style="background-color: #fffdfd;">
                      <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#1e53ff;">Fechar</button>
                      <form action="">
                      <a class="btn ms-2 text-white" href="#" role="button" style="background-color:#bb0202;">Deletar</a> 
                    </form> 
                    </div>
                  </div>
                </div>
              </div>
    </div>
@stop