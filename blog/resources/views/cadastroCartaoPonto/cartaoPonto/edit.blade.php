<div class="container"> 
        
    @if(session('success'))
        <script>
                 
            const Toast = Swal.mixin({
              toast: true,
              width: 500,
              color: '#ffffff',
              background: '#5AA300',
              position: 'top-end',
              showCloseButton: true,
              showConfirmButton: false,
              timer: 4000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: '{{ session("success") }}'
            })
        </script>
    @endif
    @error('false')
        <script>
                 
            const Toast = Swal.mixin({
              toast: true,
              width: 500,
              color: '#ffffff',
              background: '#C53230',
              position: 'top-end',
              showCloseButton: true,
              showConfirmButton: false,
              timer: 4000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'error',
              title: '{{ $message }}'
            })
        </script>
    @enderror
    
    
    <form class="row g-3 mt-1 mb-5" id="form" method="POST" action="">
        
        <h1 class="container text-center mt-5 fs-4 mb-5">Editar Cartão Ponto <i class="fad fa-user-clock"></i></h1>
        
        <section class="botoes">
            
            <div class="row">
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                    <button type="submit" id="incluir" class="btn botao"><i class="fas fa-save"></i> Incluir</button>
                    <button type="submit" id="atualizar" disabled class="btn botao d-none"><i class="fas fa-edit"></i> Editar</button>
                    
                    <button type="button" class="btn botao  d-none" disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <i class="fas fa-trash"></i> Excluir
                    </button>
                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#listaDiurno">
                        <i class="fad fa-sun"></i> Lista Diurno
                    </a>
                    
                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#listaNoturno">
                        <i class="fad fa-moon"></i> Lista Noturno
                    </a>
                    <a class="btn botao" href="{{route('cadastrocartaoponto.index')}}" role="button"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </div>
            
        </section>
        
        
        <section>
            
            <div class="col-md-10 mt-5 input">
                <label for="nome__completo" class="form-label">Nome Trabalhador <i class="fad fa-lock"></i></label>
                <input class="pesquisa form-control text-dark fw-bold" list="datalistOptions" value="{{old('nome__completo')}}" name="nome__completo" id="nome__completo" readonly>
                <datalist id="datalistOptions"></datalist>
                <span class="text-danger"></span>
            </div>
            
            
            <div class="col-md-2 input mt-5">
                <label for="matricula" class="form-label">Matrícula <i class="fad fa-lock"></i></label>
                <input type="text" class="form-control text-dark fw-bold" name="matricula" value="{{old('matricula')}}" value="" id="matricula" readonly>
                <span class="text-danger"></span>
            </div>

            
            <h1 class="text-center fs-5 mb-2 mt-5 fw-bold">Diurno <i class="fad fa-sun fa-lg"></i></h1>
            
            <div class="col-md-3 input">
                <label for="entrada1" class="form-label">Entrada</label>
                <input type="time" class="form-control diaurno fw-bold" name="entrada1" value="{{old('entrada1')}}" id="entrada1">
                <small style="font-size: 13px;">De (05:00 ás 12:00)</small>
                <span class="text-danger"></span>
            </div>

            <div class="col-md-3 input">
                <label for="saida1" class="form-label">Saída</label>
                <input type="time" class="form-control horas diaurno fw-bold" name="saida" value="{{old('saida')}}" id="saida">
                <small style="font-size: 13px;">De (05:00 ás 15:00)</small>
                <span class="text-danger"></span>
            </div>

            <div class="col-md-3 input">
                <label for="entrada2" class="form-label">Entrada</label>
                <input type="time" class="form-control horas fw-bold diaurno" name="entrada2" value="{{old('entrada2')}}" id="entrada2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                <span class="text-danger"></span>
            </div>

            <div class="col-md-3 input">
                <label for="saida2" class="form-label">Saída</label>
                <input type="time" class="form-control fw-bold horas diaurno" name="saida2" value="{{old('saida2')}}" id="saida2">
                <small style="font-size: 13px;">De (12:00 ás 22:00)</small>
                <span class="text-danger"></span>
            </div>
            
            <h1 class="text-center fs-5 mb-2 mt-5 fw-bold">Noturno <i class="fad fa-moon fa-md"></i></h1>
            
            <div class="col-md-3 input">
                <label for="entrada3" class="form-label">Entrada(adc.noturno)</label>
                <input type="time" class="form-control fw-bold  adc__noturno" name="entrada3" value="{{old('entrada3')}}" id="entrada3">
                <small style="font-size: 13px;">De (22:00 ás 03:00)</small>
                <span class="text-danger"></span>
            </div>

            <div class="col-md-3 input">
                <label for="saida3" class="form-label">Saída(adc.noturno)</label>
                <input type="time" class="form-control fw-bold  adc__noturno horas" name="saida3" value="{{old('saida3')}}" id="saida3">
                <small style="font-size: 13px;">De (03:00 ás 05:00)</small>
                <span class="text-danger"></span>
            </div>
            
            <div class="col-md-3 input">
                <label for="entrada4" class="form-label">Entrada(adc.noturno)</label>
                <input type="time" class="form-control horas fw-bold adc__noturno" name="entrada4" value="{{old('entrada4')}}" id="entrada4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                <span class="text-danger"></span>
            </div>

            <div class="col-md-3 input">
                <label for="saida5" class="form-label">Saída(adc.noturno)</label>
                <input type="time" class="form-control fw-bold horas adc__noturno" name="saida4" value="{{old('saida4')}}" id="saida4">
                <small style="font-size: 13px;">De (00:00 ás 05:00)</small>
                <span class="text-danger"></span>
            </div>
            
            <h1 class="text-center fs-5 mb-2 mt-5 fw-bold">Totais <i class="fad fa-calculator fa-md"></i></h1>

            <div class="col-md-3 input">
                <label for="horas_normais" class="form-label">Horas Normais <i class="fad fa-lock"></i></label>
                <input type="text" class="form-control fw-bold" name="horas_normais" value="" id="horas_normais" readonly>
            </div>

            <div class="col-md-2 input">
                <label for="hora__extra" class="form-label">Hrs 50% <i class="fad fa-lock"></i></label>
                <input type="text" class="form-control fw-bold" name="hora__extra" value="" id="hora__extra" readonly>
            </div>

            <div class="col-md-2 input">
                <label for="horas__cem" class="form-label">Hrs 100% <i class="fad fa-lock"></i></label>
                <input type="text" class="form-control fw-bold" name="horas__cem" value="" id="horas__cem" readonly>
            </div>

            <div class="col-md-2 input">
                <label for="adc__noturno" class="form-label">Adc.Not <i class="fad fa-lock"></i></label>
                <input type="text" class="form-control fw-bold" name="adc__noturno" value="" id="adc__noturno" readonly>
            </div>
            <div class="col-md-3 input">
                <label for="total" class="form-label">Total <i class="fad fa-lock"></i></label>
                <input type="text" class="form-control fw-bold" name="total" value="" id="total" readonly>
                <span class="text-danger"></span>
            </div>
            
        </section>
        
    </form>
    
    
    
    
</div>