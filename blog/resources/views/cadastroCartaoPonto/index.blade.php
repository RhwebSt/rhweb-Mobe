@extends('layouts.index')
@section('conteine')
<div class="card-body">
      
        @if(session('success'))
              <div class="alert mt-2 text-center text-white" style="background-color: #4EAA4B">
                    <strong>{{session('success')}}<i class="fad fa-check-circle fa-lg"></i></strong>
                </div>
          @endif
        @error('false')
            <div class="alert mt-2 text-center text-white" style="background-color: #CC2836;">
                    <strong>{{$message}}<i class="fad fa-exclamation-triangle fa-lg"></i></strong>
                </div>
        @enderror

              <h5 class="card-title text-center fs-3 ">Cartão Ponto <i class="far fa-clock"></i></h5>
              <div class="container">
                  <form class="row g-3 mt-1 mb-3" id="form" method="POST" action="{{route('cadastrocartaoponto.store')}}">
                  @csrf
                  <input type="hidden" id="method" name="_method" value="">
                  <input type="hidden" name="status" value="D" id="status">
                  <input type="hidden" name="empresa" value="{{$user->empresa}}">
                    <div class="row">
                      <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
           
                            <button type="submit" id="incluir" class="btn botao">Incluir</button>
                            <button type="submit" id="atualizar" disabled class="btn botao">Editar</button>
                            <button type="button" class="btn botao  " disabled id="excluir" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                              Excluir
                          </button>
                          
                   
                        <a class="btn botao" href="{{route('home.index')}}" role="button">Sair</a>
                      </div>
                  </div>
                  
                    <div class="col-md-3">
                        <label for="num__boletim" class="form-label">Nº do Boletim</label>
                        <input type="text" class="form-control fw-bold @error('liboletim') is-invalid @enderror" list="listaboletim" name="liboletim" id="num__boletim">
                        @error('liboletim')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <datalist id="listaboletim">
                        </datalist>
                    </div>
    
                    <div class="col-md-6 input">
                      <label for="tomador" class="form-label ">Tomador</label>
                      <input type="text" class="form-control fw-bold @error('nome__completo') is-invalid @enderror" list="datalistOptions" name="nome__completo" value="" id="nome__completo">
                      <datalist id="datalistOptions">
                      </datalist>
                      @error('nome__completo')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      @error('tomador')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                      <input type="hidden" name="tomador" class="@error('tomador') is-invalid @enderror" id="tomador">
                      <input type="hidden" id="domingo" name="domingo">
                      <input type="hidden" name="sabado" id="sabado">
                      <input type="hidden" name="diasuteis" id="diasuteis">
                    <div class="col-md-2 d-none">
                        <label for="matricula" class="form-label ">Matrícula</label>
                        <input type="text" class="form-control fw-bold @error('matricula') is-invalid @enderror " name="matricula" value="" id="matricula">
                        @error('matricula')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    <div class="col-md-3">
                      <label for="data" class="form-label">Data</label>
                      <input type="date" class="form-control fw-bold @error('data') is-invalid @enderror" name="data" value="" id="data">
                        @error('data')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-3">
                      <label for="num__trabalhador" class="form-label">Nº de Trabalhador</label>
                      <input type="text" class="form-control fw-bold @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="" id="num__trabalhador">
                      @error('num__trabalhador')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="col-md-3">
                        <label for="feriado" class="form-label">Feriado</label>
                        <select id="feriado" name="feriado" class="form-select fw-bold text-dark" >
                          <option selected>Sim</option>
                          <option>Não</option>
                        </select>
                    </div>
                        
                    
                  </form> 
              </div>
              
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header " style="background-image: linear-gradient(-120deg, rgb(32, 36, 236),rgb(16, 78, 248));">
                      <h5 class="modal-title text-white" id="staticBackdropLabel">Excluir</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="background-color: #fffdfd;">
                      <p class="text-black text-start fs-5">Deseja realmente excluir?</p>
                    </div>
                    <div class="modal-footer" style="background-color: #fffdfd;">
                      <button type="button" class="btn text-white" data-bs-dismiss="modal" style="background-color:#1e53ff;">Fechar</button>
                    <form action="" id="formdelete" method="post">
                    @csrf
                    @method('delete')
                      
                      <button type="submit" class="btn btn-danger">Deletar</button>
                    </form> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
            $( "#num__boletim" ).on('keyup focus',function() {
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
                      $('#listaboletim').html(nome)
                    }
                    if(data.length === 1 && dados.length >= 3){
                      lancamentoTab(dados,status)
                    }else{
                      limpaCamposTab()
                    }
                  }
                });
            });
            function lancamentoTab(dados,status) {
              $('#carregamento').removeClass('d-none')
              $.ajax({
                url: "{{url('tabela/cartao/ponto')}}/"+dados+'/'+status,
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
                  $('#num__boletim').removeClass('is-invalid').next().text(' ')
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
                        tomador(data[0])
                      }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
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
              $('#tomador').val(data.tomador)
              $('#matricula').val(data.tsmatricula)
              $('#domingo').val(data.csdomingos?data.csdomingos: 0.00)
              $('#sabado').val(data.cssabados?data.cssabados:0.00)
              $('#diasuteis').val(data.csdiasuteis)
            }
      </script>
@stop