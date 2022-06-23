
    localStorage.setItem('boletim','{{$boletim}}')
    $("#pesquisa").on('keyup focus', function() {
      var dados = '0';
      if ($(this).val()) {
        dados = $(this).val();
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados_pesquisa(dados);
        }
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
              nome += `<option value="${element.liboletim}  ${element.tsnome}">`
              // nome += `<option value="${element.tsmatricula}">`
              // nome += `<option value="${element.tscnpj}">`
            });
            $('#listapesquisa').html(nome)
          }
          if (data.length === 1 ) {
            $('#search').val(data[0].liboletim)
            // lancamentoTab(dados, status, data[0].lsdata)
          } 
          // else {
          //   // limpaCamposTab()
          // }
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
      $('#form').attr('action', "{{ route('tabela.cartao.ponto.cadastro') }}");
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
            $('#form').attr('action', "{{ route('tabela.cartao.ponto.cadastro') }}");
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
    function monta_dados_pesquisa(dados) {
      let novodados = dados.split('  ')
      return novodados[0];
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