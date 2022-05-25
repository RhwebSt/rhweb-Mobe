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
    
    
        <form class="row g-3" id="form" method="POST" action="">
            
            <h1 class="container text-center mt-5 fs-4 mb-5">Editar Cartão Ponto <i class="fad fa-user-clock"></i></h1>
            
            <section class="section__botoes--cartao--ponto">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('cadastrocartaoponto.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
        
                        <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>

                        <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#listaDiurno">
                            <i class="fad fa-sun"></i> Lista Diurno
                        </a>
                        
                        <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#listaNoturno">
                            <i class="fad fa-moon"></i> Lista Noturno
                        </a>
                </div>

            </section>

                
                <div class="col-md-10 mt-5 input">
                    <label for="nome__completo" class="form-label">Nome Trabalhador <i class="fad fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                    <input class="pesquisa form-control" list="datalistOptions" value="{{old('nome__completo')}}" name="nome__completo" id="nome__completo" readonly>
                    <datalist id="datalistOptions"></datalist>
                    <span class="text-danger"></span>
                </div>
                
                
                <div class="col-md-2 input mt-5">
                    <label for="matricula" class="form-label">Matrícula <i class="fad fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                    <input type="text" class="form-control" name="matricula" value="{{old('matricula')}}" value="" id="matricula" readonly>
                    <span class="text-danger"></span>
                </div>
    
                
                <h1 class="title__cartao--ponto--secondary">Diurno <i class="fad fa-sun fa-lg"></i></h1>
                
                <div class="col-md-3 input">
                    <label for="entrada1" class="form-label">Entrada</label>
                    <input type="time" class="form-control diaurno" name="entrada1" value="{{old('entrada1')}}" id="entrada1">
                    <small style="font-size: 13px;">De (05:00 ás 12:00)</small>
                    <span class="text-danger"></span>
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida1" class="form-label">Saída</label>
                    <input type="time" class="form-control horas diaurno" name="saida" value="{{old('saida')}}" id="saida">
                    <small style="font-size: 13px;">De (05:00 ás 15:00)</small>
                    <span class="text-danger"></span>
                </div>
    
                <div class="col-md-3 input">
                    <label for="entrada2" class="form-label">Entrada</label>
                    <input type="time" class="form-control horas diaurno" name="entrada2" value="{{old('entrada2')}}" id="entrada2">
                    <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                    <span class="text-danger"></span>
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida2" class="form-label">Saída</label>
                    <input type="time" class="form-control horas diaurno" name="saida2" value="{{old('saida2')}}" id="saida2">
                    <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                    <span class="text-danger"></span>
                </div>
                
                <h1 class="title__cartao--ponto--secondary">Noturno <i class="fad fa-moon fa-md"></i></h1>
                
                <div class="col-md-3 input">
                    <label for="entrada3" class="form-label">Entrada(adc.noturno)</label>
                    <input type="time" class="form-control  adc__noturno" name="entrada3" value="{{old('entrada3')}}" id="entrada3">
                    <small style="font-size: 13px;">De (22:00 ás 03:00)</small>
                    <span class="text-danger"></span>
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida3" class="form-label">Saída(adc.noturno)</label>
                    <input type="time" class="form-control  adc__noturno horas" name="saida3" value="{{old('saida3')}}" id="saida3">
                    <small style="font-size: 13px;">De (03:00 ás 05:00)</small>
                    <span class="text-danger"></span>
                </div>
                
                <div class="col-md-3 input">
                    <label for="entrada4" class="form-label">Entrada(adc.noturno)</label>
                    <input type="time" class="form-control horas adc__noturno" name="entrada4" value="{{old('entrada4')}}" id="entrada4">
                    <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                    <span class="text-danger"></span>
                </div>
    
                <div class="col-md-3 input">
                    <label for="saida5" class="form-label">Saída(adc.noturno)</label>
                    <input type="time" class="form-control horas adc__noturno" name="saida4" value="{{old('saida4')}}" id="saida4">
                    <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                    <span class="text-danger"></span>
                </div>
                
                <h1 class="title__cartao--ponto--secondary">Totais <i class="fad fa-calculator fa-md"></i></h1>
    
                <div class="col-md-3 input">
                    <label for="horas_normais" class="form-label">Horas Normais <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control" name="horas_normais" value="" id="horas_normais" readonly>
                </div>
    
                <div class="col-md-2 input">
                    <label for="hora__extra" class="form-label">Hrs 50% <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control" name="hora__extra" value="" id="hora__extra" readonly>
                </div>
    
                <div class="col-md-2 input">
                    <label for="horas__cem" class="form-label">Hrs 100% <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control" name="horas__cem" value="" id="horas__cem" readonly>
                </div>
    
                <div class="col-md-2 input">
                    <label for="adc__noturno" class="form-label">Adc.Not <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control" name="adc__noturno" value="" id="adc__noturno" readonly>
                </div>
                <div class="col-md-3 input">
                    <label for="total" class="form-label">Total <i class="fad fa-lock"></i></label>
                    <input type="text" class="form-control" name="total" value="" id="total" readonly>
                    <span class="text-danger"></span>
                </div>

        </form>
    </div>
</main>