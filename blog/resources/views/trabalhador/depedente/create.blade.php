@extends('layouts.index')
@section('titulo','Cadastrar depedentes - Rhweb')
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

        
        <form class="row g-3"  action="{{ route('depedente.store') }}" method="POST" id="form">

            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{ route('depedente.mostrar.index',base64_encode($id)) }}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                        
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap">
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                </div>
                
            </section>
            @csrf
            
            <h1 class="title__pagina--padrao">Dependentes <i class="fad fa-users"></i></h1>
              
            <div class="col-md-8">
                <label for="nome__dependente" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Nome</label>
                <input type="text" class="form-control  @error('nome__dependente') is-invalid @enderror" value="{{old('nome__dependente')}}" name="nome__dependente"  id="nome__dependente" placeholder="digite o nome do depedente">
                @error('nome__dependente')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
              
            <input type="hidden" id="method" name="_method" value="">
            
            <div class="col-md-4">
                <label for="cpf__dependente" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> CPF</label>
                <input type="text" class="form-control  @error('dscpf') is-invalid @enderror" value="{{old('dscpf')}}" name="dscpf"  id="cpf__dependente" placeholder="Ex: 000.000.000-00">
                @error('dscpf')
                    <span class="text-danger">{{ $message }}</span>
                 @enderror
            </div>
            
            <input type="hidden" name="trabalhador" value="{{$id}}">
                
            <div class="col-md-4">
                <label for="tipo__dependente" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Tipo</label>
                <select id="tipo__dependente" name="tipo__dependente" class="form-select" value="{{old('tipo__dependente')}}">
                    <option>Cônjuge</option>
                    <option>Filho(a) ou enteado(a)</option>
                    <option>Irmão(ã), neto(a) ou bisneto(a)</option>
                    <option>Pais, avós e bisavós</option>
                    <option>Tutor ou Cuidador</option>
                    <option>Ex-cônjuge</option>
                    <option>Menor com guarda judicial</option>
                    <option selected>Agregado/Outros</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="data__nascimento" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Data de Nascimento</label>
                <input type="date" class="form-control @error('data__nascimento') is-invalid @enderror" value="{{old('data__nascimento')}}" name="data__nascimento"  id="data__nascimento">
                @error('data__nascimento')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="sexo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Sexo</label>
                <select id="sexo" name="sexo" class="form-select" value="">
                  <option selected>Masculino</option>
                  <option>Feminino</option>
                  <option>Outro</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="irrfs" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> IRRF</label>
                <select id="irrfs" name="irrf" class="form-select" value="">
                    <option >Sim</option>
                    <option selected>Não</option>
                </select> 
            </div>
                
            <div class="col-md-4">
                <label for="sfs" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Salário Familia</label>
                <select id="sfs" name="sf" class="form-select" value="">
                    <option >Sim</option>
                    <option selected>Não</option>
                </select> 
            </div>

        </form>
        
        
    </div>         
</main>

<script type="text/javascript" src="{{url('/js/user/trabalhador/depedente/create.js')}}"></script>
@stop