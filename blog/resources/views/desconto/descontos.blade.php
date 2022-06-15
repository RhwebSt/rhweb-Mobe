@extends('layouts.index')
@section('titulo','Descontos - Rhweb')
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
        
        <!--Modal de Acesso não permitido-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--      icon: 'error',-->
        <!--      allowOutsideClick: false,-->
        <!--      allowEscapeKey: false,-->
        <!--      allowEnterKey: true,-->
        <!--      html: '<h1 class="fw-bold mb-3 fs-3">Permissão Negada!</h1>'+-->
        <!--      '<p class=" mb-4 fs-6">Contate seu Administrador para receber acesso.</p>'+-->
        <!--      '<div><a class="btn btn-secondary mb-3" href="{{route("home.index")}}">Voltar</a></div>',-->
        <!--      showConfirmButton: false,-->
        <!--    });-->
        <!--</script>-->
        <!--Fim do modal de Acesso não permitido-->

        <!--Modal de não permitido para o Editar, relatorio, excluir e outros botoes-->
        <!--<script>-->
        <!--    Swal.fire({-->
        <!--        icon: 'error',-->
        <!--        title: 'Você não tem Permissão',-->
        <!--        text: 'Contate seu Administrador para receber acesso.',-->
        <!--        allowOutsideClick: false,-->
        <!--        allowEscapeKey: false,-->
        <!--        allowEnterKey: true,-->
        <!--    });-->
        <!--</script>-->
        <!--fim do modal-->

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
                            <li class=""><a class="dropdown-item text-decoration-none ps-2" onclick ="botaoModal ()"  id="imprimir" role="button"><i class="fad fa-file-alt"></i> Rol dos Descontos</a></li>
                        </ul>
                        
                        <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalDesconto">
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
                <select id="quinzena" name="quinzena" class="form-select" >
                    <option selected>1 - Primeira</option>
                    <option>2 - Segunda</option>
                    <!-- <option selected>3 - Mês</option> -->
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