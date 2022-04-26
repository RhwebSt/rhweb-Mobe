@extends('layouts.index')
@section('titulo','Rhweb - Editar Cartão Ponto')
@section('conteine')
<div class="card-body">
      
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
        
             

              <h5 class="card-title text-center mt-5 fs-3">Editar Boletim Cartão Ponto <i class="fad fa-alarm-clock"></i></h5>
              <div class="container">
                  <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('cadastrocartaoponto.update',$dados->id)}}">
                  @csrf
                  <input type="hidden" id="method" name="_method" value="PUT">
                    <div class="row">
                      <div class="btn d-grid gap-1 mt-5 mb-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
           
                            <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                            <a type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#teste">
                              <i class="fad fa-list-ul"></i> Lista
                            </a>
                            <a href="{{route('boletimcartaoponto.create',[base64_encode($dados->id),$dados->csdomingos ? base64_encode($dados->csdomingos):' ',base64_encode($dados->cssabados)?base64_encode($dados->cssabados):' ',base64_encode($dados->csdiasuteis),base64_encode($dados->lsdata),base64_encode($dados->liboletim),base64_encode($dados->tomador),base64_encode($dados->lsferiado)])}}" id="atualizar"  class="btn botao d-none"><i class="fad fa-user-clock"></i> Cartão Ponto</a>
                            <a class="btn botao" href="{{route('cadastrocartaoponto.index')}}" role="button"><i class="fad fa-sign-out-alt"></i> Sair</a>
                      </div>
                  </div>

                    
                    
                  
                    <div class="col-md-4">
                        <label for="num__boletim" class="form-label">Nº do Boletim <i class="fas fa-lock"></i></label>
                        <input type="text"  class="form-control fw-bold @error('liboletim') is-invalid @enderror" list="listaboletim" name="liboletim" value="{{$dados->liboletim}}" id="num__boletim" Readonly>
                        @error('liboletim')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <datalist id="listaboletim">
                        </datalist>
                    </div>
    
                    <div class="col-md-8 input">
                      <label for="tomador" class="form-label ">Tomador
                        <span id="refre" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpar todos os campos" style="background-color:#A71113; padding: 0.6px 4px; border: 1px solid #DF1619; border-radius: 20px;"><i class="fad fa-sync-alt " style="color: #fff"></i></span>
                      </label>
                      <input type="text" class="form-control fw-bold @error('nome__completo') is-invalid @enderror" list="datalistOptions" name="nome__completo" value="{{$dados->tomador->tsnome}}" id="nome__completo">
                      <datalist id="datalistOptions">
                      </datalist>
                      @error('nome__completo')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      @error('tomador')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                      <input type="hidden" name="tomador" class="@error('tomador') is-invalid @enderror" id="tomador" value="{{$dados->tomador->id}}">
                      <input type="hidden" id="domingo" name="domingo">
                      <input type="hidden" name="sabado" id="sabado">
                      <input type="hidden" name="diasuteis" id="diasuteis">


                    <div class="col-md-4">
                      <label for="data" class="form-label">Data</label>
                      <input type="date" class="form-control fw-bold @error('data') is-invalid @enderror" name="data" value="{{$dados->lsdata}}" id="data">
                        @error('data')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-4">
                      <label for="num__trabalhador" class="form-label">Quantidade de Cadastros</label>
                      <input type="text" class="form-control fw-bold @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{$dados->lsnumero}}" id="num__trabalhador">
                      @error('num__trabalhador')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-4">
                        <label for="feriado" class="form-label">Feriado</label>
                        <select id="feriado" name="feriado" class="form-select fw-bold text-dark" >
                          @if($dados->lsferiado === 'Sim')
                          <option selected>Sim</option>
                          <option >Não</option>
                          @else
                          <option >Sim</option>
                          <option selected>Não</option>
                          @endif
                        </select>
                    </div>
                  </form>
                  @include('cadastroCartaoPonto.lista')
            </div>
            
            <script>
                var botaolimpaCampos = document.querySelector("#refre");
        
                botaolimpaCampos.addEventListener('click', function(){
                    var quantidade = document.querySelector("#num__trabalhador").value='';
                    var tomador = document.querySelector("#nome__completo").value='';
                    var data = document.querySelector("#data").value='';
                })
                
                $('#num__trabalhador').mask('#.##0', {reverse: true});
            </script>
            
            <script>
            
            $( "#pesquisa" ).on('keyup focus',function() {
                var dados = '0';
                if ($(this).val()) {
                  dados = $(this).val();
                }
                var status = $('#status').val();
                $.ajax({
                  url: "{{url('tabela/cartao/ponto/pesquisa')}}/"+dados+'/'+status,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    console.log(data)
                    let nome = ''
                    if (data.length >= 1) {
                      data.forEach(element => {
                        nome += `<option value="${element.liboletim}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        // nome += `<option value="${element.tscpf}">`
                      });
                      $('#listapesquisa').html(nome)
                    }
                    if(data.length === 1 && dados.length > 0){
                      lancamentoTab(dados,status,data[0].lsdata)
                    }else{
                      limpaCamposTab()
                    }
                  }
                });
            });
            function lancamentoTab(dados,status,data) {
              $('#carregamento').removeClass('d-none')
              $.ajax({
                url: "{{url('tabela/cartao/ponto/unidade')}}/"+dados+'/'+status,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                  camposLacamentoTab(data)
                  $('#carregamento').addClass('d-none')
                }
              })
            }
            function limpaCamposTab() {
              $('#form').attr('action', "{{ route('cadastrocartaoponto.store') }}");
              $('#incluir').removeAttr( "disabled" )
              $('#atualizar').attr('disabled','disabled')
              $('#deletar').attr('disabled','disabled')
              $('#method').val(' ')
              $('#excluir').attr( "disabled",'disabled' )
              $('#matricula').val(' ')
              $('#nome__completo').val(' ')
              $('#data').val(' ')
              $('#num__trabalhador').val(' ')
              $('#num__boletim').val(localStorage.getItem('cartao'))
            }
            function camposLacamentoTab(data) {
                  if (data.id) {
                      $('#form').attr('action', "{{ url('cadastrocartaoponto')}}/"+data.id);
                      $('#formdelete').attr('action',"{{ url('cadastrocartaoponto')}}/"+data.id)
                      $('#incluir').attr('disabled','disabled')
                      $('#atualizar').removeAttr( "disabled" )
                      $('#deletar').removeAttr( "disabled" )
                      $('#excluir').removeAttr( "disabled" )
                      $('#method').val('PUT')
                      buscatomador(data.tomador)
                  }else{
                    $('#form').attr('action', "{{ route('cadastrocartaoponto.store') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#excluir').attr( "disabled",'disabled' ) 
                  }
                  $('#num__boletim').val(data.liboletim).removeClass('is-invalid').next().text(' ')
                  $('#matricula').removeClass('is-invalid').next().text(' ')
                  $('#nome__completo').removeClass('is-invalid').next().text(' ')
                  $('#data').val(data.lsdata).removeClass('is-invalid').next().text(' ')
                  $('#num__trabalhador').val(data.lsnumero).removeClass('is-invalid').next().text(' ')
                  for (let index = 0; index <  $('#feriado option').length; index++) {  
                    if (data.lsferiado == $('#feriado option').eq(index).text()) {
                      $('#feriado option').eq(index).attr('selected','selected')
                    }else  {
                      $('#feriado option').eq(index).removeAttr('selected')
                    }
                  }
            }
            $( "#nome__completo" ).on('keyup focus',function() {
              var dados = '0';
              if ($(this).val()) {
                dados = $(this).val();
                if (dados.indexOf('  ') !== -1) {
                  dados = monta_dados(dados);
                }
              }
              $.ajax({
                  url: "{{url('tomador')}}/pesquisa/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    tomador(' ')
                    let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscnpj}">`
                        });
                        $('#datalistOptions').html(nome)
                      }
                      if(data.length === 1 && dados.length >= 4){
                        let tabela = tabelaPreco(data[0].id);
                        if (tabela) {
                          tomador(data[0])
                        }else{
                          Alerta(data[0].id)
                        }
                      }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function Alerta(tomador) {
                Swal.fire({
                title: '<strong>Algo deu Errado!</strong>',
                icon: 'error',
                html:
                  '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
                  `<a href="{{url('tabelapreco')}}/ /${tomador}">Cadastrar</a> `,
                showCloseButton: true,
                allowOutsideClick: false,
                allowEnterKey: true,
              })
            }
            function tabelaPreco(tomador) {
              var resul = false;
              $.ajax({
                  url: "{{url('verifica/tabela/preco')}}/"+tomador,
                  type: 'get',
                  contentType: 'application/json',
                  async: false,
                  success: function(data) {
                    resul = data
                  }
              })
              return resul;
            }
            function buscatomador(dados) {
              $.ajax({
                  url: "{{url('tomador')}}/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    if (data) {
                      tomador(data)
                      $('#nome__completo').val(data.tsnome)
                    }
                  }
              })
            }
            function tomador(data) {
              $('#tomador').val(data.id)
              $('#matricula').val(data.tsmatricula)
              $('#domingo').val(data.csdomingos?data.csdomingos: 0.00)
              $('#sabado').val(data.cssabados?data.cssabados:0.00)
              $('#diasuteis').val(data.csdiasuteis)
            }
      </script>
@stop