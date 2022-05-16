@extends('layouts.index')
@section('titulo','Rhweb - Descontos')
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

        <form class="row g-3" id="form" method="POST" action="{{route('descontos.store')}}">
            @csrf
            <input type="hidden" name="empresa" value="{{$user->empresa_id}}">
            <input type="hidden" class=" @error('trabalhador') is-invalid @enderror" name="trabalhador" id="trabalhador" value="{{old('trabalhador')}}">
            
            <section class="section__botoes--desconto">
                    
                    <div class="d-flex justify-content-start align-items-start div__voltar">
                        <a class="botao__voltar" href="{{route('home.index')}}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                    </div>
                    
                    <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                        <button type="submit" id="incluir" class="btn botao"><i class="fad fa-save"></i> Incluir</button>
                        
                        <button class="btn botao dropdown-toggle" type="button" id="rolDescontos"  data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fad fa-file-alt"></i> Relatórios
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="rolDescontos">
                            <li class=""><a class="dropdown-item text-decoration-none ps-2" onclick ="botaoModal ()"  id="imprimir" role="button">Rol dos Descontos</a></li>
                           
                        </ul>
                        
                        <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                            <i class="fad fa-list-ul"></i> Lista
                        </a>
                        
                    </div>
                    
            </section>
            
            <h1 class="title__desconto">Descontos <i class="fad fa-percentage"></i></h1>

            <script>
                function botaoModal (){
                     
                Swal.fire({
                    title: 'Periodo <i class="far fa-clock"></i>',
                    html:
                    '<div>'+
                    '<label class="fw-bold">Data Inicial</label>' +
                    '</div>'+
                    '<input type="date" name="inicio" id="swal-input1" class="swal2-input">' +
                    '<div class="mt-3">'+
                    '<label class="fw-bold">Data Final</label>' +
                    '</div>'+
                    '<input type="date" name="final" id="swal-input2" class="swal2-input">',
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
                            // let tomador = document.getElementById('tomador').value
                            location.href=`{{url('relatorio/descontos')}}/${ btoa(inicio)}/${btoa(final)}`;
                        } 
                        
                    }
                });
                }
            </script>


            <div class="col-md-3">
                <label for="competencia" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Competência</label>
                <input type="month" class="form-control @error('competencia') is-invalid @enderror" name="competencia" value="{{old('competencia')}}" id="competencia">
                @error('competencia')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-7">
                <label for="nome__trab" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Trabalhador</label>
                <input type="text" class="form-control @error('nome__trab') is-invalid @enderror" list="listatrabalhador" name="nome__trab" value="{{old('nome__trab')}}" id="nome__trab" placeholder="dê um duplo clique para pesquisar">
                <datalist id="listatrabalhador"></datalist>
               @error('nome__trab')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control @error('matricula') is-invalid @enderror" name="matricula" value="{{old('matricula')}}" id="matricula" Readonly>
                @error('matricula')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="descricao" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                <input type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{old('descricao')}}" id="descricao" placeholder="Ex: Botina">
                @error('descricao')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <label for="quinzena" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Quinzena</label>
                <select id="quinzena" name="quinzena" class="form-select text-dark" >
                    <option selected>1 - Primeira</option>
                    <option>2 - Segunda</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="valor" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Valor</label>
                <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{old('valor')}}" id="valor">
                @error('valor')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </form>
    </div>
     @include('desconto.lista')
</main>



  
 
        <script>
              $('.modal-botao').click(function() {
                    localStorage.setItem("modal", "enabled");
                })

                function verficarModal() {
                    var valueModal = localStorage.getItem('modal');
                    if (valueModal === "enabled") {
                    $(document).ready(function() {
                        $("#teste").modal("show");
                    });
                    localStorage.setItem("modal", "disabled");
                    }
                }
                verficarModal()
                var botaolimpaCampos = document.querySelector("#refre");
        
                botaolimpaCampos.addEventListener('click', function(){
                    var nomeTrab = document.querySelector("#nome__trab").value='';
                    var descricao = document.querySelector("#descricao").value='';
                    var valor = document.querySelector("#valor").value='';
                    var competencia = document.querySelector("#competencia").value='';
                })
                
                $('#num__trabalhador').mask('#.##0', {reverse: true});
        </script>
        
        
        <script>
             $( "#nome__trab,#pesquisa" ).on('keyup focus',function() {  
                let  dados = '0'
                if ($(this).val()) {
                  dados = $(this).val()
                  if (dados.indexOf('  ') !== -1) {
                    dados = monta_dados(dados);
                  }
                }
                $.ajax({
                    url: "{{url('trabalhador/pesquisa')}}/"+dados,
                    type: 'get',
                    contentType: 'application/json',
                    success: function(data) {
                      $('#nomemensagem').text(' ')
                      $('#matricula').val(' ')
                      let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscpf}">`
                        });
                        $('#listatrabalhador').html(nome);
                        $('#listapesquisa').html(nome);
                      }
                      if(data.length === 1 && dados.length > 4){
                        $('#nome__trab').html(nome)
                        $('#trabalhador').val(data[0].id)
                        $('#idtrabalhador').val(data[0].id)
                        $('#matricula').val(data[0].tsmatricula)
                      }else if(!data.length && dados.length > 4){
                        $('#nomemensagem').text('Este trabalhador não ta cadastrador!')
                      }              
                    }
                });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
        </script>
        @stop