@extends('layouts.index')
@section('conteine')
<div class="card login-form align-self-center" style="width: 30rem; padding: 0.5rem;">
            <img src="" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title text-center fs-3 ">Cadastro de Usuários</h5>
                @if(isset($msg))
                <p class="text-success">{{$msg['mensagem']}}</p>
                @endif
                

                <!-- <p class="text-danger">Não foi possivel cadastrar o usuario.</p>

                <p class="text-danger">Usuario não cadastrado.</p> -->


              <form class=""  action="{{ route('usuario.store') }}" method="POST">
                <div class="mb-2 col-md-12 form-group ">
                  <label for="nome " class="form-label">Nome</label>
                  <input type="text" class="form-control form-control-sm" name="nome" id="nome" >
                </div>
                @csrf
                <div class="mb-2 col-md-12 form-group ">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control form-control-sm" name="usuario" id="usuario" >
                </div>
                
                <div class="mb-2 col-md-12 form-group ">
                    <label for="cargo" class="form-label">Cargo</label>
                    <input type="text" class="form-control form-control-sm" name="cargo" id="cargo" >
                </div>
                <div class="mb-2 col-md-12 form-group d-none">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" id="email" >
                </div>
                <div class="mb-2 col-md-12 form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control form-control-sm" name="senha" id="senha" >
                </div>

                <div class="mb-2 col-md-12 form-group">
                    <label for="comfirmesenha" class="form-label">Confirme sua Senha</label>
                    <input type="password" class="form-control form-control-sm" name="comfirmesenha" id="comfirmesenha" >
                </div>
                <button type="submit" class="btn botao">Cadastrar</button>
                <a href="#" class="btn botao btn-block mt-3">Consultar</a>
                <a href="#" class="btn botao btn-block mt-3">Sair</a>
              </form>
              
            </div>
          </div>
@stop