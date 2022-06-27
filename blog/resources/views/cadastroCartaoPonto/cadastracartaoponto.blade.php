@extends('layouts.index')
@section('titulo','Cartão Ponto - Rhweb')
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

        <form class="row g-3" id="form" method="POST" action="{{route('boletimcartaoponto.store')}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            <input type="hidden" name="domingo" id="domingo" value="{{$domingo}}">
            <input type="hidden" name="sabado" id="sabado" value="{{$sabado}}">
            <input type="hidden" name="diasuteis" id="diasuteis" value="{{$diasuteis}}">
            <input type="hidden" name="data" value="{{$data}}">
            <input type="hidden" name="tomador" value="{{$tomador}}">
            <input type="hidden" name="feriado" value="{{$feriado}}">
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('cartao.ponto.novo')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">

                    <button type="submit" id="incluir" class="btn botao"><i class="fas fa-save"></i> Incluir</button>
    
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#listaDiurno">
                        <i class="fad fa-sun"></i> Lista Diurno
                    </a>
                    
                    <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#listaNoturno">
                        <i class="fad fa-moon"></i> Lista Noturno
                    </a>
                </div>
                
            </section>

            <h1 class="title__pagina--padrao">Cartão Ponto <i class="fad fa-user-clock"></i></h1>
        
            <input type="hidden" name="lancamento" id="lancamento" value="{{$id}}"> 
            <input type="hidden" name="trabalhador" value="{{old('matricula')}}" id="trabalhador">
            <input type="hidden" name="boletim" value="{{$boletim}}">
           
            
             
            <div class="col-md-10">
                <label for="nome__completo" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Trabalhador</label>
                <input class="form-control @error('nome__completo') is-invalid @enderror" list="datalistOptions" value="{{old('nome__completo')}}" name="nome__completo" id="nome__completo" placeholder="dê um duplo clique para pesquisar">
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label> 
                <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" value="" id="matricula" readonly>
                @error('matricula')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            
            <h1 class="title__pagina--padrao-secondary">Diurno <i class="fad fa-sun fa-lg"></i></h1>
            
            <div class="col-md-3">
                <label for="entrada1" class="form-label">Entrada</label>
                <input type="time" class="form-control diaurno @error('entrada1') is-invalid @enderror" name="entrada1" value="{{old('entrada1')}}" id="entrada1">
                <small style="font-size: 13px;">De (05:00 ás 12:00)</small>
                @error('entrada1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="saida1" class="form-label">Saída</label>
                <input type="time" class="form-control horas diaurno  @error('saida') is-invalid @enderror" name="saida" value="{{old('saida')}}" id="saida">
                <small style="font-size: 13px;">De (05:00 ás 15:00)</small>
                @error('saida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="entrada2" class="form-label">Entrada</label>
                <input type="time" class="form-control horas  diaurno @error('entrada2') is-invalid @enderror" name="entrada2" value="{{old('entrada2')}}" id="entrada2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                @error('entrada2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="saida2" class="form-label">Saída</label>
                <input type="time" class="form-control  horas diaurno @error('saida2') is-invalid @enderror" name="saida2" value="{{old('saida2')}}" id="saida2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                @error('saida2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <h1 class="title__pagina--padrao-secondary">Noturno <i class="fad fa-moon fa-md"></i></h1>
            
            <div class="col-md-3">
                <label for="entrada3" class="form-label">Entrada(adc.noturno)</label>
                <input type="time" class="form-control   adc__noturno @error('entrada3') is-invalid @enderror" name="entrada3" value="{{old('entrada3')}}" id="entrada3">
                <small style="font-size: 13px;">De (22:00 ás 03:00)</small>
                @error('entrada3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="saida3" class="form-label">Saída(adc.noturno)</label>
                <input type="time" class="form-control   adc__noturno horas  @error('saida3') is-invalid @enderror" name="saida3" value="{{old('saida3')}}" id="saida3">
                <small style="font-size: 13px;">De (03:00 ás 05:00)</small>
                @error('saida3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-3">
                <label for="entrada4" class="form-label">Entrada(adc.noturno)</label>
                <input type="time" class="form-control horas  adc__noturno @error('entrada4') is-invalid @enderror" name="entrada4" value="{{old('entrada4')}}" id="entrada4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                @error('entrada4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="saida5" class="form-label">Saída(adc.noturno)</label>
                <input type="time" class="form-control  horas adc__noturno @error('saida4') is-invalid @enderror" name="saida4" value="{{old('saida4')}}" id="saida4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                @error('saida4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <h1 class="title__pagina--padrao-secondary">Totais <i class="fad fa-calculator fa-md"></i></h1>

            <div class="col-md-3">
                <label for="horas_normais" class="form-label">Horas Normais <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="horas_normais" value="" id="horas_normais" readonly>
            </div>

            <div class="col-md-2">
                <label for="hora__extra" class="form-label">Hrs 50% <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="hora__extra" value="" id="hora__extra" readonly>
            </div>

            <div class="col-md-2">
                <label for="horas__cem" class="form-label">Hrs 100% <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="horas__cem" value="" id="horas__cem" readonly>
            </div>

            <div class="col-md-2">
                <label for="adc__noturno" class="form-label">Adc.Not <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="adc__noturno" value="" id="adc__noturno" readonly>
            </div>
            
            <div class="col-md-3">
                <label for="total" class="form-label">Total <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control  @error('total') is-invalid @enderror" name="total" value="" id="total" readonly>
                @error('total')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

        </form>
    </div>
    @include('cadastroCartaoPonto.cartaoPonto.listaDiurno')
    @include('cadastroCartaoPonto.cartaoPonto.listaNoturno')
</main>

      
@stop