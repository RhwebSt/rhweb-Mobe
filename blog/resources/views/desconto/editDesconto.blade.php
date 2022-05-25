@extends('layouts.index')
@section('titulo','Rhweb - Editar Descontos')
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
        @error('tabelavazia')
            <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        html: '<p class="modal__aviso--title">Tabela de preço vazia</p>'+ '<p class="modal__aviso">{{ $message }}</p>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true,
                        background: '#45484A',
                        showConfirmButton: true,
                        timer: 5000,
                        customClass: {
                          title: 'modal__aviso',
                        }
                    })
            </script>
        @enderror
        @error('dadosvazia')
            <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        html: '<p class="modal__aviso--title">Algo deu errado!</p>'+ '<p class="modal__aviso">{{ $message }}</p>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true,
                        background: '#45484A',
                        showConfirmButton: true,
                        timer: 5000,
                        customClass: {
                          title: 'modal__aviso',
                        }
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
                    <ul class="dropdown-menu" aria-labelledby="rolDescontos">
                            <li class=""><a class="dropdown-item text-decoration-none ps-2" onclick ="botaoModal ()"  id="imprimir" role="button">Rol dos Descontos</a></li>
                        </ul>
                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#modalDesconto">
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
                <label for="nome__trab" class="form-label">Nome do Trabalhador <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="nome__trab" value="{{$dadosdescontos->tsnome}}" id="nome__trab" Readonly>
            </div>
            <div class="col-md-2">
                <label for="matricula" class="form-label">Matrícula  <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo automático"></i></label>
                <input type="text" class="form-control " name="matricula" value="{{$dadosdescontos->tsmatricula}}" id="matricula" Readonly>
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
</main>
@stop