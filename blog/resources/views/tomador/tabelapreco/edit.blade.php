@extends('layouts.index')
@section('titulo','Rhweb - Editar tabela de preço')
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
          title: 'Cadastro realizado com Sucesso'
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
    
        <form class="row g-3" id="form" method="POST" action="{{ route('tabelapreco.update',$id) }}">
            
            <section class="section__botoes--tomador">
                
                <div class="d-flex justify-content-start align-items-start div__voltar">
                    <a class="btn botao" href="{{ route('tabelapreco.index',[' ',base64_encode($tomador)]) }}" role="button"><i class="fad fa-arrow-left"></i> Voltar </a>
                </div>
                
               <div class="btn d-grid gap-1 mt-1 mx-auto d-md-block d-flex flex-wrap" role="button" aria-label="Basic example">
    
                <button type="submit" class="btn botao " id="atualizar"><i class="fad fa-sync-alt"></i> Atualizar </button>
                
                <a type="button" class="btn botao modal-botao" data-bs-toggle="modal" data-bs-target="#teste">
                    <i class="fad fa-list-ul"></i> Lista
                </a>

              </div> 
                
            </section>
    
            <h1 class="title__tomador">Tabela de Preços <i class="fad fa-sack-dollar"></i></h1>
    
    
            <input type="hidden" value="{{$tomador}}" name="tomador" id="tomador">
            @if($user->empresa)
            <input type="hidden" name="empresa" value="{{$user->empresa}}">
            @else
            <input type="hidden" name="empresa" value="">
            @endif
            @csrf
            <input type="hidden" id="method" name="_method" value="PUT">

    
    
            <div class="col-md-2">
                <label for="ano" class="form-label">Ano</label>
                <input type="text" class=" form-control fw-bold @error('ano') is-invalid @enderror" name="ano" value="{{$tabelaprecos_editar->tsano}}" id="ano">
                @error('ano')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-3">
                <label for="rubricas" class="form-label">Código <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inaterável"></i></label>
                <input type="text" class="form-control pesquisa @error('rubricas') is-invalid @enderror fw-bold" name="rubricas" value="{{$tabelaprecos_editar->tsrubrica}}" id="rubricas" readonly>
                @error('rubricas')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <datalist id="rubricas"></datalist>
                <span class="text-danger" id="rubricamensagem"></span>
            </div>
    
            <div class="col-md-7">
                <label for="descricao" class="form-label">Descrição <i class="fas fa-lock" data-toggle="tooltip" data-placement="top" title="Campo inaterável"></i></label>
                <input type="text" class="form-control fw-bold  @error('descricao') is-invalid @enderror" list="descricoes" name="descricao" value="{{$tabelaprecos_editar->tsdescricao}}" id="descricao" readonly>
                <datalist id="descricoes"></datalist>
                @error('descricao')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span class="text-danger" id="descricoesmensagem"></span>
            </div>
    
            <div class="col-md-6">
                <label for="valor" class="form-label">Valor Trabalhador</label>
                <input type="text" class="form-control fw-bold @error('valor') is-invalid @enderror" name="valor" value="{{number_format((float)$tabelaprecos_editar->tsvalor, 2, ',', '')}}" id="valor">
                @error('valor')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="col-md-6">
                <label for="valor__tomador" class="form-label">Valor Tomador</label>
                <input type="text" class="form-control fw-bold @error('valor__tomador') is-invalid @enderror" name="valor__tomador" value="{{number_format((float)$tabelaprecos_editar->tstomvalor, 2, ',', '')}}" id="valor__tomador">
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