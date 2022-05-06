@extends('layouts.index')
@section('titulo','Rhweb - Editar Descontos')
@section('conteine')
<main role="main">
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
                  title: '{{session("success")}}'
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
                  title: '{{$message}}'
                })
            </script>
        @enderror
        @error('tabelavazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Tabela de preço vazia',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
        @error('dadosvazia')
            <script>
                Swal.fire({
                  icon: 'error',
                  title: 'Algo deu errado!',
                  text: '{{ $message }}',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: true,
                })
            </script>
        @enderror
        

        <form class="row g-3" id="form" method="POST" action="{{route('descontos.update',$dadosdescontos->id)}}">
            @csrf
            @method('PATCH')
            <section class="section__botoes--desconto">
                    
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('descontos.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                        <i class="fad fa-list-ul"></i> Lista
                    </a>
                </div>
                    
            </section>
            
            <div class="title__desconto">Editar Descontos <i class="fad fa-percentage"></i></div>

            <script>
                function botaoModal (){
                     
                Swal.fire({
                    title: 'Periodo',
                    html:
                    '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
                    '<input type="date" name="final" id="swal-input2" class="swal2-input">',
                    inputLabel: 'teste',
                    confirmButtonText: 'Buscar',
                    showDenyButton: true,
                    denyButtonText: 'Sair',
                    showConfirmButton: true,
                    focusConfirm: false,
                    preConfirm: () => {
                        if (!document.getElementById('swal-input1').value || !document.getElementById('swal-input1').value) {
                            Swal.showValidationMessage('Preencha todos os campos')   
                        }else{
                            let inicio =  document.getElementById('swal-input1').value
                            let final = document.getElementById('swal-input2').value
                            let tomador = document.getElementById('tomador').value
                            location.href=`{{url('boletim/tomador')}}/${tomador}/${inicio}/${final}`;
                        } 
                        
                    }
                });
                }
            </script>


            <div class="col-md-3">
                <label for="competencia" class="form-label">Competência</label>
                <input type="month" class="form-control @error('competencia') is-invalid @enderror" name="competencia" value="{{$dadosdescontos->dscompetencia}}" id="competencia">
                @error('competencia')
                        <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-7">
                <label for="matricula" class="form-label">Matrícula  <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="matricula" value="{{$dadosdescontos->tsmatricula}}" id="matricula" Readonly>
            </div>

            <div class="col-md-2">
                <label for="nome__trab" class="form-label">Nome do Trabalhador <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="nome__trab" value="{{$dadosdescontos->tsnome}}" id="nome__trab" Readonly>
            </div>

            <div class="col-md-6">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control  @error('descricao') is-invalid @enderror" name="descricao" value="{{$dadosdescontos->dsdescricao}}" id="descricao">
                @error('descricao')
                            <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>

            <div class="col-md-3">
                <label for="quinzena" class="form-label">Quinzena</label>
                <select id="quinzena" name="quinzena" class="form-select" >
                    @if($dadosdescontos->dsquinzena === '1 - Primeira')
                        <option selected>1 - Primeira</option>
                        <option>2 - Segunda</option>
                    @else
                        <option >1 - Primeira</option>
                        <option selected>2 - Segunda</option>
                    @endif
                </select>
            </div>

            <div class="col-md-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{number_format((float)$dadosdescontos->dfvalor, 2, ',', '.')}}" id="valor">
                @error('valor')
                            <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>

        </form>
    </div>
    @include('desconto.lista')
</main>
@stop