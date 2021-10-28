@extends('layouts.index')
@section('conteine')
<div class="container">
            <div class="btn mt-5  " role="button" aria-label="Basic example">
                   <a class="btn btn btn-outline-dark" href="{{ route('home.index') }}" role="button">Sair</a>
                    <a class="btn btn btn-outline-dark" href="{{ route('tomador.create') }}" role="button" style="">Cadastrar</a>
                    
            </div>
        </div>

        <h1 class="container text-center mt-3 fs-4">Tomadores Cadastrados</h1>
       

        

        <div class="container responsive">
            <table class="table border-bottom text-white table-responsive" style="background-color: #310FC9">
                <thead>
                    <th colspan="2" class="col">Nome</th>
                    <th class="col">CNPJ</th>
                    <th class="col">Estado</th>
                    <th class="col">Matrícula</th>
                    <th class="col">Data de Entrada</th>
                    <th colspan="2" class="col">Ações</th>
                </thead>
                <tbody>
                @foreach ($tomadors as $tomador)
                <tr>

                
                    <td class="text-black bg-white">
                    {{ $tomador->tsnome }}
                    </td>
                    <td class="text-black bg-white">
                    {{ $tomador->tscnpj }}
                    </td>
                    <td class="text-black bg-white">
                    
                    </td>
                    <td class="text-black bg-white">
                    
                    </td>
                    <td class="text-black bg-white">
                    {{ $tomador->tsmatricula }}
                    </td>
                    <td class="text-black bg-white">
                    {{ $tomador->created_at }}
                    </td> 
                    
                    <td class="bg-light"><a href="#" class="btn btn-block me-4" style="background-color:#1750ee; Color: #fefeff;">Editar</a><a class="btn btn-danger" href="">Excluir</a></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" class="bg-white">
                        {{ $tomadors->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
           
            
        </div>
        @stop