
    // $( "#rubrica" ).on('keyup focus',function() {
    //     var dados = '0';
    //     if ($(this).val()) {
    //       dados = $(this).val()
    //       if (dados.indexOf('  ') !== -1) {
    //         dados = monta_dados(dados);
    //         if (dados.indexOf('%') !== -1) {
    //             dados = dados.replace('%','')
    //         }
    //       }
    //     }
    //     $.ajax({
    //         url: "{{url('tabelapreco')}}/pesquisa/"+dados+"/"+$('#tomador').val(),
    //         type: 'get',
    //         contentType: 'application/json',
    //         success: function(data) {
    //             $('#codigo').val(' ')
    //             // $('#codigomensagem').text(' ')
    //             $('#valor').val(' ')
    //             $('#lftomador').val(' ')
    //             let nome = ''
    //             if (data.length >= 1) {
    //                 data.forEach(element => {
    //                     nome += `<option value="${element.tsrubrica}  ${element.tsdescricao}">`
    //                 });
    //                 $('#rublicas').html(nome)
    //             }
    //             if(data.length === 1 && dados.length > 3){
    //                 $('#valor').val(data[0].tsvalor)
    //                 $('#lftomador').val(data[0].tstomvalor)
    //                 $('#rubrica').val(data[0].tsdescricao)
    //                 $('#codigo').val(data[0].tsrubrica)
    //                 $('#descricao').val(data[0].tsdescricao)
    //             }else if(dados.length > 3 && !data.length){
    //                 $('#valor').val(' ')
    //                 $('#lftomador').val(' ')
    //                 // $('#codigo').addClass('is-invalid')
    //                 // $('#codigomensagem').text('Esta rublica não esta cadastra.')
    //             }
    //         }
    //     });
    // });
    // $( "#pesquisa" ).on('keyup focus',function() { 
    //     let  dados = '0'
    //     if ($(this).val()) {
    //       dados = $(this).val()
    //       if (dados.indexOf('  ') !== -1) {
    //         dados = monta_dados(dados);
    //       }
    //     }
        
    // });
    $.ajax({
            url: "{{url('trabalhador/pesquisa')}}/"+0,
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
    $( "#nome__completo" ).on('keyup focus',function() { 
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