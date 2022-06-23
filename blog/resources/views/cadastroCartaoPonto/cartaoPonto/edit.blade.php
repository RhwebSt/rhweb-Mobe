@extends('layouts.index')
@section('titulo','Editar Cartão Ponto -Rhweb')
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
    
    
        <form class="row g-3" id="form" method="POST" action="{{route('boletimcartaoponto.update',$bolcartaoponto->id)}}"> 
        @csrf
            <input type="hidden" id="method" name="_method" value="PUT">
            <h1 class="container text-center mt-5 fs-4 mb-5">Editar Cartão Ponto <i class="fad fa-user-clock"></i></h1>
            
            <section class="section__botao--padrao">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('boletimcartaoponto.create',[base64_encode($id),base64_encode($domingo)?$domingo:' ',$sabado?base64_encode($sabado):' ',$diasuteis?base64_encode($diasuteis):' ',base64_encode($data),base64_encode($boletim),base64_encode($tomador),base64_encode($feriado)])}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
        
                        <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>

                        <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#listaDiurno">
                            <i class="fad fa-sun"></i> Lista Diurno
                        </a>
                        
                        <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#listaNoturno">
                            <i class="fad fa-moon"></i> Lista Noturno
                        </a>
                </div>

            </section>

                
                <div class="col-md-10 mt-5 input">
                    <label for="nome__completo" class="form-label">Nome Trabalhador <i class="fad fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                    <input class="pesquisa form-control @error('nome__completo') is-invalid @enderror" list="datalistOptions" value="{{$bolcartaoponto->trabalhador->tsnome}}" name="nome__completo" id="nome__completo" readonly >
                    <datalist id="datalistOptions"></datalist>
                    @error('nome__completo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                
                <div class="col-md-2 input mt-5">
                    <label for="matricula" class="form-label">Matrícula <i class="fad fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                    <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{$bolcartaoponto->trabalhador->tsmatricula}}" id="matricula" readonly>
                    @error('matricula')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                <input type="hidden" name="domingo" id="domingo" value="{{$domingo}}">
                <input type="hidden" name="sabado" id="sabado" value="{{$sabado}}">
                <input type="hidden" name="diasuteis" id="diasuteis" value="{{$diasuteis}}">
                <input type="hidden" name="data" value="{{$data}}">
                <input type="hidden" name="tomador" value="{{$tomador}}">
                <input type="hidden" name="feriado" value="{{$feriado}}">
                
                <h1 class="title__pagina--padrao-secondary">Diurno <i class="fad fa-sun fa-lg"></i></h1>
                
                <div class="col-md-3 input">
                    <label for="entrada1" class="form-label">Entrada</label>
                    <input type="time" class="form-control @error('entrada1') is-invalid @enderror diaurno" name="entrada1" value="{{$bolcartaoponto->bsentradamanhao}}" id="entrada1">
                    <small style="font-size: 13px;">De (05:00 ás 12:00)</small>
                    @error('entrada1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida1" class="form-label">Saída</label>
                    <input type="time" class="form-control @error('saida') is-invalid @enderror horas diaurno" name="saida" value="{{$bolcartaoponto->bssaidamanhao}}" id="saida">
                    <small style="font-size: 13px;">De (05:00 ás 15:00)</small>
                    @error('saida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
    
                <div class="col-md-3 input">
                    <label for="entrada2" class="form-label">Entrada</label>
                    <input type="time" class="form-control @error('entrada2') is-invalid @enderror horas diaurno" name="entrada2" value="{{$bolcartaoponto->bsentradatarde}}" id="entrada2">
                    <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                    @error('entrada2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida2" class="form-label">Saída</label>
                    <input type="time" class="form-control @error('saida2') is-invalid @enderror horas diaurno" name="saida2" value="{{$bolcartaoponto->bssaidatarde}}" id="saida2">
                    <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                    @error('saida2')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                
                <h1 class="title__pagina--padrao-secondary">Noturno <i class="fad fa-moon fa-md"></i></h1>
                
                <div class="col-md-3 input">
                    <label for="entrada3" class="form-label">Entrada(adc.noturno)</label>
                    <input type="time" class="form-control @error('entrada3') is-invalid @enderror  adc__noturno" name="entrada3" value="{{$bolcartaoponto->bsentradanoite}}" id="entrada3">
                    <small style="font-size: 13px;">De (22:00 ás 03:00)</small>
                    @error('entrada3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida3" class="form-label">Saída(adc.noturno)</label>
                    <input type="time" class="form-control @error('saida3') is-invalid @enderror  adc__noturno horas" name="saida3" value="{{$bolcartaoponto->bssaidanoite}}" id="saida3">
                    <small style="font-size: 13px;">De (03:00 ás 05:00)</small>
                    @error('saida3')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                
                <div class="col-md-3 input">
                    <label for="entrada4" class="form-label">Entrada(adc.noturno)</label>
                    <input type="time" class="form-control @error('entrada4') is-invalid @enderror horas adc__noturno" name="entrada4" value="{{$bolcartaoponto->bsentradamadrugada}}" id="entrada4">
                    <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                    @error('entrada4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida5" class="form-label">Saída(adc.noturno)</label>
                    <input type="time" class="form-control @error('saida4') is-invalid @enderror horas adc__noturno" name="saida4" value="{{$bolcartaoponto->bssaidamadrugada}}" id="saida4">
                    <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                    @error('saida4')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                
                <h1 class="title__pagina--padrao-secondary">Totais <i class="fad fa-calculator fa-md"></i></h1>
    
                <div class="col-md-3 input">
                    <label for="horas_normais" class="form-label">Horas Normais <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control @error('horas_normais') is-invalid @enderror" name="horas_normais" value="{{$bolcartaoponto->horas_normais}}" id="horas_normais" readonly>
                    @error('horas_normais')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="col-md-2 input">
                    <label for="hora__extra" class="form-label">Hrs 50% <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control @error('hora__extra') is-invalid @enderror" name="hora__extra" value="{{$bolcartaoponto->bshoraex}}" id="hora__extra" readonly>
                    @error('hora__extra')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="col-md-2 input">
                    <label for="horas__cem" class="form-label">Hrs 100% <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control @error('horas__cem') is-invalid @enderror" name="horas__cem" value="{{$bolcartaoponto->bshoraexcem}}" id="horas__cem" readonly>
                    @error('horas__cem')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="col-md-2 input">
                    <label for="adc__noturno" class="form-label">Adc.Not <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control @error('adc__noturno') is-invalid @enderror" name="adc__noturno" value="{{$bolcartaoponto->bsadinortuno}}" id="adc__noturno" readonly>
                    @error('adc__noturno')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 input">
                    <label for="total" class="form-label">Total <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="{{$bolcartaoponto->bstotal}}" id="total" readonly>
                    @error('total')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                @include('cadastroCartaoPonto.cartaoPonto.listaDiurno')
                @include('cadastroCartaoPonto.cartaoPonto.listaNoturno')
        </form>
    </div>
</main>

<script type="text/javascript" src="{{url('/js/user/boletimCartaoPonto/cartaoPonto/edit.js')}}"></script>

@stop