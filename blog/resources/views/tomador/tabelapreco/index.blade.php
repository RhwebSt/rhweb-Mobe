@extends('layouts.index')
@section('titulo','Rhweb - Tabela de preço')
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
          title: '{{session("success")}}',
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
          title: 'Não foi possível realizar o cadastro!'
        })
        </script>
        @enderror
        @error('tabelavazia')
        <script>
        Swal.fire({
          icon: 'error',
          title: 'Relatório vazio',
          text: '{{ $message }}',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: true,
        })
        </script>
        @enderror
        
        <form class="row g-3" id="form" method="POST" action="{{ route('tabelapreco.store') }}">
            
            <section class="section__botoes--tomador">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="botao__voltar" href="{{ route('tomador.index') }}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
                <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
                    <button type="submit" class="btn botao " id="incluir"><i class="fad fa-save"></i> Incluir </button>

                    <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                      <i class="fad fa-list-ul"></i> Lista
                    </a>
              </div>
                
            </section>
    
    
            <h1 class="title__tomador">Tabela de Preços <i class="fad fa-sack-dollar"></i></h1>
    
    
            <input type="hidden" value="{{$tomador}}" name="tomador" id="tomador">
           
            <input type="hidden" name="empresa" value="{{$user->empresa->id}}">
            @csrf
            <input type="hidden" id="method" name="_method" value="">
            

            <div class="col-md-7">
                <label for="descricao" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Descrição</label>
                <input type="text" class="form-control  @error('descricao') is-invalid @enderror" list="descricoes" value="{{old('descricao')}}" id="descricao">
                <input type="hidden" name="descricao" value="{{old('descricao')}}">
                <datalist id="descricoes"></datalist>
                @error('descricao')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="descricoesmensagem"></span>
            </div>
            
            <input type="hidden" name="status" value="produção">
            
            <div class="col-md-3">
                <label for="rubricas" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Código</label>
                <input type="text" class="form-control  pesquisa @error('rubricas') is-invalid @enderror" value="{{old('rubricas')}}" id="rubricas">
                <input type="hidden" name="rubricas" value="{{old('descricao')}}">
                @error('rubricas')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="rubricas">datalist>
                <span class="text-danger" id="rubricamensagem"></span>
            </div>
    
            <div class="col-md-2">
                <label for="ano" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Ano</label>
                <input type="text" class="form-control @error('ano') is-invalid @enderror" name="ano" value="{{old('ano')}}" id="ano">
                @error('ano')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="valor" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Valor Trabalhador</label>
                <input type="text" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{old('valor')}}" id="valor">
                @error('valor')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6">
                <label for="valor__tomador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Valor Tomador</label>
                <input type="text" class="form-control @error('valor__tomador') is-invalid @enderror" name="valor__tomador" value="{{old('valor__tomador')}}" id="valor__tomador">
                @error('valor__tomador')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            
        </form>
      @include('tomador.tabelapreco.lista')
    </div>
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

 
  $(document).ready(function() {
    $('#refre').click(function() {
      $('#rubricas').val(' ').removeAttr('disabled')
      $('#descricao').val(' ').removeAttr('disabled');
    })
    $('#rubricas').on('keyup', function() {
      $('input[name="rubricas"]').val($(this).val());
    })
    $('#descricao').on('focus keyup', function() {
      let dados = '0'
      if ($(this).val()) {
        dados = $(this).val()
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados(dados);
        }
      }
      $('input[name="descricao"]').val(dados)
      $.ajax({
        url: "{{url('rublica/pesquisa')}}/" + dados,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          let nome = ''
          let rublica = ['1000', '1002', '1003', '1004', '1005', '1006', '1007']
          if (data.length >= 1) {
            data.forEach(element => {
              if (rublica.indexOf(element.rsrublica) !== -1) {
                nome += `<option value="${element.rsrublica}  ${element.rsdescricao}">`
              }
            });
            $('#descricoes').html(nome)
          }
          if (data.length === 1 && dados.length >= 4) {
            buscaItemRublica(dados)
          }
        }
      })
    })
    $("#pesquisa").on('keyup focus', function() {
      let dados = '0'
      if ($(this).val()) {
        dados = $(this).val()
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados(dados);
        }
      }
      var tomador = $('#tomador').val();
      $('#icon').addClass('d-none').next().removeClass('d-none')
      $.ajax({
        url: "{{url('tabelapreco')}}/pesquisa/" + dados + '/' + tomador,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          $('#refres').addClass('d-none').prev().removeClass('d-none')
          let nome = ''
          if (data.length >= 1) {
            data.forEach(element => {
              nome += `<option value="${element.tsdescricao}">`
              // nome += `<option value="${element.tsdescricao}">`
            });
            $('#listapesquisa').html(nome);
          }
          // if (data.length === 1 && dados.length > 3) {
          //   buscaIntem(dados, tomador)
          // } else {
          //   campos()
          // }
        }
      })
    });

    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[0];
    }

    function buscaItemRublica(dados) {
      $.ajax({
        url: "{{url('rublica')}}/" + dados,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          $('#rubricas').val(data.rsrublica).attr('disabled', 'disabled')
          $('#descricao').val(data.rsdescricao).attr('disabled', 'disabled');
          $('input[name="rubricas"]').val(data.rsrublica)
          $('input[name="descricao"]').val(data.rsdescricao)
        }
      })
    }

    function buscaIntem(dados, tomador) {
      $('#carregamento').removeClass('d-none')
      $.ajax({
        url: "{{url('tabelapreco')}}/perfil/" + dados + '/' + tomador,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          tabelapreco(data)
          $('#carregamento').addClass('d-none')
        }
      })
    }

    function campos() {
      $('#form').attr('action', "{{ route('tabelapreco.store') }}");
      $('#incluir').removeAttr("disabled")
      $('#atualizar').attr('disabled', 'disabled')
      $('#deletar').attr('disabled', 'disabled')
      $('#method').val(' ')
      $('#excluir').attr("disabled", "disabled")
      $('#rubricas').val(' ');
      $('#ano').val(' ')
      $('#valor').val(' ')
      $('#descricao').val(' ')
      $('#valor__tomador').val(' ')
    }

    function tabelapreco(data) {
      if (data.id) {
        $('#form').attr('action', "{{ url('tabelapreco')}}/" + data.id);
        $('#formdelete').attr('action', "{{ url('tabelapreco')}}/" + data.id)
        $('#incluir').attr('disabled', 'disabled')
        $('#atualizar').removeAttr("disabled")
        $('#deletar').removeAttr("disabled")
        $('#excluir').removeAttr("disabled")
        $('#method').val('PUT')
      } else {
        $('#form').attr('action', "{{ route('tabelapreco.store') }}");
        $('#incluir').removeAttr("disabled")
        $('#atualizar').attr('disabled', 'disabled')
        $('#deletar').attr('disabled', 'disabled')
        $('#method').val(' ')
        $('#excluir').attr("disabled", "disabled")
      }
      $('#rubricas').val(data.tsrubrica);
      $('#ano').val(data.tsano)
      $('#valor').val(data.tsvalor.toFixed(2).toString().replace(".", ","))
      $('#valor__tomador').val(parseFloat(data.tstomvalor).toFixed(2).toString().replace(".", ","))
      $('#descricao').val(data.tsdescricao)
    }
  });
</script>
@stop