@extends('layouts.index')
@section('titulo','Rhweb - Editar Boletim com Tabela')
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

        <form class="row g-3 mt-1 mb-3" method="POST" id="form" action="{{route('tabcartaoponto.update',$dados->id)}}">
            <input type="hidden" name="lancamento" value="{{$dados->id}}">
            @csrf
            @method('PATCH')
            
            <section class="section__botoes--boletim-tabela">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{route('tabcartaoponto.index')}}"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" id="incluir" class="btn botao"><i class="fad fa-sync-alt"></i> Atualizar</button>
                    
                    <button type="button" class="btn botao" data-bs-toggle="modal" data-bs-target="#modalLancamentoPreco">
                        <i class="fad fa-list"></i> Lista
                    </button>
                </div>
                
            </section>
            
            <h5 class="title__boletim-tabela">Editar Boletim com Tabela <i class="fad fa-pencil-alt"></i></h5>

            <?php
              if (isset($numboletimtabela->vsnroboletins)) {
                $boletim = $numboletimtabela->vsnroboletins + 1;
              }else{
                $boletim = 1;
              }
            ?>
            
            
            <div class="col-md-4">
                <label for="num__boletim" class="form-label">Nº do Boletim <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" value="{{$dados->liboletim}}" list="listaboletim" class="form-control @error('liboletim') is-invalid @enderror" name="liboletim" id="num__boletim" Readonly>
                @error('liboletim')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="listaboletim"></datalist>
            </div>

            <div class="col-md-8 input">
                <label for="tomador" class="form-label">Tomador <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inalterável"></i></label>
                <input type="text" list="datalistOptions" class=" form-control @error('nome__completo') is-invalid @enderror" name="nome__completo" value="{{$dados->tomador->tsnome}}" id="nome__completo" Readonly>
                <datalist id="datalistOptions"></datalist>
                @error('nome__completo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('tomador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <input type="hidden" name="tomador"  class="@error('tomador') is-invalid @enderror" id="tomador" value="{{$dados->tomador->id}}">
            <input type="hidden" name="status" value="M" id="status">
            <input type="hidden" name="empresa" value="{{$user->empresa}}">


            <div class="col-md-6">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control @error('data') is-invalid @enderror" name="data" value="{{$dados->lsdata}}" id="data">
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="num__trabalhador" class="form-label">Quantidade de cadastros</label>
                <input type="number" class="form-control @error('num__trabalhador') is-invalid @enderror" name="num__trabalhador" value="{{$dados->lsnumero}}" id="num__trabalhador">
                 @error('num__trabalhador')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                
            <div class="col-md-3 d-none">
                <label for="feriado" class="form-label">Feriado</label>
                <select id="feriado" name="feriado" class="form-select text-dark" >
                    <option>Sim</option>
                    <option selected>Não</option>
                </select>
            </div>
                    
                    
        </form>
    </div>
    @include('tabCartaoPonto.lista')
</main>

<script>
    $('.modal-botao').click(function() {
        localStorage.setItem("modal", "enabled");
    })
    function verficarModal(){
      var valueModal = localStorage.getItem('modal');
      if(valueModal === "enabled"){
          $(document).ready(function(){
              $("#teste").modal("show");
          });
          localStorage.setItem("modal","disabled");
      }
    }
    verficarModal()
    localStorage.setItem('boletim','{{$boletim}}')
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
            let nome = ''
            if (data.length >= 1) {
              data.forEach(element => {
                nome += `<option value="${element.tsnome}">`
                // nome += `<option value="${element.tsmatricula}">`
                nome += `<option value="${element.tscnpj}">`
              });
              $('#listapesquisa').html(nome)
            }
            if(data.length === 1 && dados.length >= 1){
              // lancamentoTab(dados,status,data[0].lsdata)
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
      $('#form').attr('action', "{{ route('tabcartaoponto.store') }}");
      $('#incluir').removeAttr( "disabled" )
      $('#atualizar').attr('disabled','disabled')
      $('#deletar').attr('disabled','disabled')
      $('#method').val(' ')
      $('#excluir').attr( "disabled",'disabled' )
      $('#matricula').val(' ')
      $('#nome__completo').val(' ')
      $('#data').val(' ')
      $('#num__trabalhador').val(' ')
      $('#num__boletim').val(localStorage.getItem('boletim'))
    }
    function camposLacamentoTab(data) {
          if (data.id) {
              $('#form').attr('action', "{{ url('tabcartaoponto')}}/"+data.id);
              $('#formdelete').attr('action',"{{ url('tabcartaoponto')}}/"+data.id)
              $('#incluir').attr('disabled','disabled')
              $('#atualizar').removeAttr( "disabled" )
              $('#deletar').removeAttr( "disabled" )
              $('#excluir').removeAttr( "disabled" )
              $('#method').val('PUT')
              buscatomador(data.tomador)
          }else{
            $('#form').attr('action', "{{ route('tabcartaoponto.store') }}");
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
                let tabela = tabelaPreco(data[0].tomador);
                if (tabela) {
                  tomador(data[0])
                }else{
                  Alerta(data[0].tomador)
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
              $('#carregamento').addClass('d-none')
              $('#nome__completo').val(data.tsnome)
            }
          }
      })
    }
    function tomador(data) {
      $('#tomador').val(data.tomador)
      $('#matricula').val(data.tsmatricula)
      $('#domingo').val(data.csdomingos)
      $('#sabado').val(data.cssabados)
      $('#diasuteis').val(data.csdiasuteis)
    }
</script>     
@stop