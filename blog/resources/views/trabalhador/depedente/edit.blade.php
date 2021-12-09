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
              <form class="row g-3 mt-1 mb-3"  action="{{ route('depedente.update',$id) }}" method="POST" id="form">

                <div class="row">
                  <div class="col-2">
                     <h5 class="card-title text-center fs-3 ">Dependentes</h5>
                  </div>
                  <div class="col">
                    <div class="btn text-end form-control" role="button" aria-label="Basic example">
                      <a class="btn botao " href="{{ route('depedente.mostrar.index',$depedentes->trabalhador) }}"  role="button">Sair</a>
                      <button type="submit" id="incluir" class="btn botao">Atualizar</button>
                    </div>
                  </div>
              </div>
              @csrf
              <input type="hidden" id="method" name="_method" value="PUT">
              <input type="hidden" name="trabalhador" value="{{$depedentes->trabalhador}}">
                
                <input type="hidden" name="trabalhador" value="{{$id}}">
              
                <div class="col-md-2">
                  <label for="cpf__dependente" class="form-label">CPF do dependente</label>
                  <input type="text" class="form-control  @error('cpf__dependente') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dscpf}}" name="cpf__dependente"  id="cpf__dependente">
                  @error('cpf__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <input type="hidden" name="trabalhador" value="{{$id}}">
                <div class="col-md-2">
                    <label for="data__nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control @error('data__nascimento') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dsdata}}" name="data__nascimento"  id="data__nascimento">
                    @error('data__nascimento')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-2">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select fw-bold text-dark" value="">
                      <option selected>Masculino</option>
                      <option>Feminino</option>
                      <option>Outro</option>
                    </select>
                </div>

                <div class="col-md-6">
                  <label for="nome__dependente" class="form-label">Nome do dependente</label>
                  <input type="text" class="form-control  @error('nome__dependente') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dsnome}}" name="nome__dependente"  id="nome__dependente">
                  @error('nome__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-4">
                    <label for="tipo__dependente" class="form-label">Tipo do dependente</label>
                    <input type="text" class="form-control @error('tipo__dependente') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dstipo}}" name="tipo__dependente"  id="tipo__dependente">
                    @error('tipo__dependente')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-md-4">
                    <label for="irrf" class="form-label">IRRF</label>
                    <input type="text" class="form-control @error('irrf') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dsirrf}}" name="irrf" id="irrf">
                    @error('irrf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                    <!-- <select id="irrf" name="irrf" class="form-select" value="">
                      <option selected>Sim</option>
                      <option>Não</option>
                    </select> -->
                </div>
                
                <div class="col-md-4">
                    <label for="sf" class="form-label">Salário Familia</label>
                    <input type="text" class="form-control @error('sf') is-invalid @enderror  fw-bold text-dark" value="{{$depedentes->dssf}}" name="sf" value="" id="sf">
                    @error('sf')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                    <!-- <select id="sf" name="sf" class="form-select" value="">
                      <option selected>Sim</option>
                      <option>Não</option>
                    </select> -->
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