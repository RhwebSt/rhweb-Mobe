  $(document).ready(function() {
    // $("#pesquisa").on('keyup focus', function() {
    //   let dados = '0'
    //   if ($(this).val()) {
    //     dados = $(this).val()
    //     if (dados.indexOf('  ') !== -1) {
    //       dados = monta_dados(dados);
    //     }
    //   }
    //   var tomador = $('#tomador').val();
    //   $('#icon').addClass('d-none').next().removeClass('d-none')
      
    // });
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