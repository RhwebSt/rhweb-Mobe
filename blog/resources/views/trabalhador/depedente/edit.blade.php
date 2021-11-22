@extends('layouts.index')
@section('conteine')
<main class="container">
            <div class="card-body">
              

              @if($errors->all())
                    @foreach($errors->all() as  $error)
                      @if($error === 'edittrue')
                        <div class="alert alert-success mt-2 alert-block">
                            <strong>Atualização realizada com sucesso!</strong>
                        </div>
                    @elseif($error === 'editfalse')
                        <div class="alert alert-danger mt-2 alert-block">
                            <strong>Não foi porssivél atualizar os dados!</strong>
                        </div>
                    @elseif($error === 'deletatrue')
                        <div class="alert alert-success mt-2 alert-block">
                            <strong>Registro deletador com sucesso!</strong>
                        </div>
                    @elseif($error === 'cadastratrue')
                        <div class="alert alert-success mt-2 alert-block">
                            <strong>Cadastrador realizada com sucesso!</strong>
                        </div>
                    @elseif($error === 'cadastrafalse')
                        <div class="alert alert-danger mt-2 alert-block">
                            <strong>Não foi porssivél realizar o cadastro !</strong>
                        </div>
                    @endif
                    @endforeach
                @endif  
              <form class="row g-3 mt-1 mb-3"  action="{{ route('depedente.update',$id) }}" method="POST" id="form">

                <div class="row">
                  <div class="col-2">
                     <h5 class="card-title text-center fs-3 ">Dependentes</h5>
                  </div>
                  <div class="col">
                    <div class="btn text-end form-control" role="button" aria-label="Basic example">
                      <a class="btn btn-primary ms-2 " href="{{ route('depedente.mostrar.index',$depedentes->trabalhador) }}"  role="button">Sair</a>
                      <button type="submit" id="incluir" class="btn btn-primary">Atualizar</button>
                    </div>
                  </div>
              </div>
              @csrf
              <input type="hidden" id="method" name="_method" value="PUT">
              <input type="hidden" name="trabalhador" value="{{$depedentes->trabalhador}}">
                <div class="col-md-2">
                  <label for="cpf__dependente" class="form-label">CPF do dependente</label>
                  <input type="text" class="form-control" name="cpf__dependente" value="{{$depedentes->dscpf}}" id="cpf__dependente">
                </div>
                <input type="hidden" name="trabalhador" value="{{$id}}">
                <div class="col-md-2">
                    <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" name="data__nascimento" value="{{$depedentes->dsdata}}" id="data__nascimento">
                </div>

                <div class="col-md-2">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select" value="">
                      <option selected>Masculino</option>
                      <option  >Feminino</option>
                      <option>Outro</option>
                    </select>
                </div>

                <div class="col-md-6">
                  <label for="nome__dependente" class="form-label">Nome do dependente</label>
                  <input type="text" class="form-control" name="nome__dependente" value="{{$depedentes->dsnome}}" id="nome__dependente">
                </div>

                <div class="col-md-4">
                    <label for="tipo__dependente" class="form-label">Tipo do dependente</label>
                    <input type="text" class="form-control" name="tipo__dependente" value="{{$depedentes->dstipo}}" id="tipo__dependente">
                </div>

                <div class="col-md-2">
                    <label for="irrf" class="form-label">IRRF</label>
                    <input type="text" class="form-control" name="irrf" value="{{$depedentes->dsirrf}}" id="irrf">
                </div>


                <div class="col-md-2">
                    <label for="sf" class="form-label">SF</label>
                    <input type="text" class="form-control" name="sf" value="{{$depedentes->dssf}}" id="sf">
                </div>

              </form> 
              
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
                      <form action="">
                      <a class="btn btn-danger ms-2" href="#" role="button">Deletar</a> 
                    </form> 
                    </div>
                  </div>
                </div>
              </div>
            </div>         
      </main>
@stop