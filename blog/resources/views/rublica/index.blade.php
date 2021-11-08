@extends('layouts.index')
@section('conteine')
    <div class="container">
    <form class="row g-3 mt-1 mb-3 mt-5" method="POST" action="" >
                <div class="row">
                    <div class="btn mt-3 form-control" role="button" aria-label="Basic example">
                        <a class="btn ms-2 text-white table-hover botao" href="#" role="button">Incluir</a>
                        <a class="btn  btn-md ms-2 col-md-1 text-white botao table-hover" href="#" role="button" >Editar</a>
                        <a class="btn ms-2 col-md-1 text-white botao table-hover" href="#" role="button">Sair</a>
                    </div>
                </div>

                <h1 class="container text-center mt-4 mb-2 fs-3 fw-bold">Rúbricas</h1>

                <div class="col-md-2">
                    <label for="rubricas" class="form-label">Rúbricas</label>
                    <input type="text" class="form-control" name="rubricas" id="rubricas" value="">
                </div>

                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="">
                </div>

                <div class="col-md-2">
                    <label for="descricao" class="form-label">Incidência</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="">
                </div>

                <div class="col-md-2">
                    <label for="dc" class="form-label">D/C</label>
                    <select id="dc" name="dc" class="form-select" value="">
                      <option selected>Créditos</option>
                      <option>Descontos</option>
                    </select>
                </div>


            </form>
    </div>
@stop