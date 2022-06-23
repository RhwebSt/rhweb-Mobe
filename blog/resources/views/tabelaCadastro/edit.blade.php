@extends('layouts.index')
@section('titulo','Editar lançamento Tabela de Preço - Rhweb')
@section('conteine')
<main role="main">
    <div class="container">
        @if(session('success'))
            <script>
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  html: '<p class="modal__aviso">{{session("success")}}</p>',
                  background: '#45484A',
                  showConfirmButton: true,
                  timer: 2500,
        
                });
            </script>
        @endif
        @error('false')
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    html: '<p class="modal__aviso">{{ $message }}</p>',
                    background: '#45484A',
                    showConfirmButton: true,
                    timer: 5000,
        
                });
            </script>
        @enderror
        
        <form class="row g-3" id="form" method="POST" action="{{route('boletim.tabela.update',$lancamentorublicas->id)}}">
            
            @csrf
            <input type="hidden" id="method" name="_method" value="put">
            
            <section class="section__botoes--boletim-tabela">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('boletim.tabela.create',[base64_encode($quantidade),base64_encode($boletim),base64_encode($tomador),base64_encode($id),base64_encode($data)])}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-4 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="atualizar"  class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalBoletimTabela">
                          <i class="fad fa-list-ul"></i> Lista
                    </button>
                </div>
                
            </section>

          
            <h1 class="title__boletim-tabela">Editar Lançamento com Tabela de Preço <i class="fad fa-sack-dollar"></i></h1>
              
            <input type="hidden" name="lancamento" value="{{$id}}">
            <input type="hidden" name="numtrabalhador" value="{{$quantidade}}">
            <input type="hidden" name="valor" id="valor" value="{{$lancamentorublicas->lfvalor}}">
            <input type="hidden" name="lftomador" id="lftomador" value="{{$lancamentorublicas->lftomador}}">
            <input type="hidden" name="boletim" value="{{$boletim}}">
            <input type="hidden" name="tomador" id="tomador" value="{{$tomador}}">
            <input type="hidden" name="data" value="{{$data}}">
            <input type="hidden" name="descricao" id="descricao">
            
            
            <div class="col-md-10">
                <label for="nome__completo" class="form-label">Trabalhador <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input value="{{$lancamentorublicas->tsnome}}" class="pesquisa form-control  @error('nome__completo') is-invalid @enderror" list="nomecompleto" name="nome__completo" id="nome__completo" Readonly>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="nomemensagem"></span>
                <datalist id="nomecompleto"></datalist>
            </div>
            
            <input type="hidden" name="trabalhador" id="trabalhador" value="{{$lancamentorublicas->trabalhador_id}}">
            
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$lancamentorublicas->tsmatricula}}" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="" id="matricula" Readonly>
                @error('matricula')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-7 ">
                <label for="rubrica" class="form-label">Descrição <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$lancamentorublicas->lshistorico}}" class="form-control @error('rubrica') is-invalid @enderror" list="rublicas" name="rubrica" value="" id="rubrica" Readonly>
                <datalist id="rublicas"></datalist>
                @error('rubrica')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
               
            </div>

            <div class="col-md-2">
                <label for="codigo" class="form-label">Código <i class="fas fa-lock" <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$lancamentorublicas->licodigo}}" class="form-control rubrica @error('codigo') is-invalid @enderror" name="codigo" list="codigos" value="" id="codigo" Readonly>
                @error('codigo')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="codigos"></datalist>
                <span class="text-danger" id="codigomensagem"></span>
            </div>

            

            <div class="col-md-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                    @if(strpos($lancamentorublicas->lsquantidade,':'))
                      <input type="time" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{$lancamentorublicas->lsquantidade}}" id="">
                    @else
                      <input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{$lancamentorublicas->lsquantidade}}" id="quantidade">
                    @endif
                
                @error('quantidade')
                      <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
        </form>
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/boletimTabela/lancamentoTabelaPreco/edit.js')}}"></script> 

        <?php
        function calculovalores($horas,$valores)
        {
            if(strpos($horas,':')){
               list($horas,$minitos) = explode(':',$horas);
               $horasex = $horas * 3600 + $minitos * 60;
               $horasex = $horasex/60;
               $horasex = $valores * ($horasex/60);
            }else{
               $horasex = $valores * $horas;
            }
            return $horasex; 
       }
    ?>
        @include('tabelaCadastro.lista')

@stop