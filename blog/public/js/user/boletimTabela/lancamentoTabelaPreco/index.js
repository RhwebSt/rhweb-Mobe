 let rublicas = ['1002','1003','1004','1005']
    $( "#rubrica" ).on('keyup',function() {
        var dados = '0';
        if ($(this).val()) {
          dados = $(this).val()
          if (dados.indexOf('  ') !== -1) {
            dados = monta_dados(dados);
            if (dados.indexOf('%') !== -1) {
                dados = dados.replace('%','')
            }
          }
        }
        $.ajax({
            url: `${window.Laravel.tabelapreco.pesquisa}/${dados}/${$('#tomador').val()}`,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                $('#codigo').val(' ')
                $('#valor').val(' ')
                $('#lftomador').val(' ')
                // $('#quantidade').attr('type','text')
                $('#conteinarquant').html(`<input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="quantidade">`)
                $('#quantidade').mask('000.000.000.000.000.00', {reverse: true});
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.tsrubrica}  ${element.tsdescricao}">`
                    });
                    $('#rublicas').html(nome)
                }
                if(data.length === 1 && dados.length > 3){
                  let rublica = '';
                  if (!data[0].tsvalor) {
                    rublica = ` <li class="list-group-item">O tomador da rublica ${data[0].tsdescricao} está R$ 0,00</li>`
                    alertatabela(data[0].tomador_id,rublica)
                  }
                    $('#valor').val(data[0].tsvalor)
                    $('#lftomador').val(data[0].tstomvalor)
                    $('#rubrica').val(data[0].tsdescricao)
                    $('#codigo').val(data[0].tsrubrica)
                    $('#descricao').val(data[0].tsdescricao)
                    if (rublicas.indexOf(data[0].tsrubrica) !== -1) {
                        // $('#quantidade').attr('type','time')
                        $('#conteinarquant').html(`<input type="time" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="">`)
                    }
                }else if(dados.length > 3 && !data.length){
                    let rublica = '';
                    if (!data[0].tsvalor) {
                      rublica = ` <li class="list-group-item">O tomador da rublica ${data[0].tsdescricao} está R$ 0,00</li>`
                      alertatabela(data[0].tomador_id,rublica)
                    }
                    $('#valor').val(' ')
                    $('#lftomador').val(' ')
                    $('#conteinarquant').html(`<input type="text" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade" value="{{old('quantidade')}}" id="quantidade">`)
                    $('#quantidade').mask('000.000.000.000.000.00', {reverse: true});
                    // $('#quantidade').attr('type','text')
                }
            }
        });
    });
    function alertatabela(tomador,dados) {
      Swal.fire({
        title: '<strong>Algo deu Errado!</strong>',
        icon: 'error',
        html:
          `<strong>Tabela de Preço</strong> existe rublica com o valor R$0,00,
          <ul class="list-group">
            ${dados}
          </ul>
          <a href="${window.Laravel.tabelapreco.index}/ /${btoa(tomador)}">Atualizar valores</a> `,
        // showCloseButton: false,
        // allowOutsideClick: false,
        // allowEnterKey: true,
      })
    }
    $.ajax({
            url: `${window.Laravel.trabalhador.pesquisa}/0`,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
              let nome = ''
              if (data.length >= 1) {
                data.forEach(element => {
                  nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                  // nome += `<option value="${element.tsmatricula}">`
                  nome += `<option value="${element.tscpf}">`
                });
                $('#listapesquisa').html(nome)
              }            
            }
        });
    $( "#nome__completo_boletim_tabela_trabalhador" ).on('keyup focus',function() { 
        let  dados = '0'
        if ($(this).val()) {
          dados = $(this).val()
          if (dados.indexOf('  ') !== -1) {
            dados = monta_dados(dados);
          }
        }
        $.ajax({
            url: `${window.Laravel.trabalhador.pesquisa}/${dados}`,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
              $('#nomemensagem').text(' ')
              $('#matricula').val(' ')
            //   $( "#nome__completo" ).removeClass('is-invalid')
              let nome = ''
              if (data.length >= 1) {
                data.forEach(element => {
                  nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                  // nome += `<option value="${element.tsmatricula}">`
                  nome += `<option value="${element.tscpf}">`
                });
                $('#nomecompleto').html(nome)
              }
              if(data.length === 1 && dados.length > 4){
                $('#nomecompleto').html(nome)
                $('#trabalhador').val(data[0].id)
                $('#matricula').val(data[0].tsmatricula)
              }else if(!data.length && dados.length > 4){
                $('#nomemensagem').text('Este trabalhador não ta cadastrador!')
                // $( "#nome__completo" ).addClass('is-invalid')
              }              
            }
        });
    });
    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[1];
    }