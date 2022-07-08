   
 $( "#nome__completo_tomador" ).on('keyup focus',function() {
  var dados = '0';
  if ($(this).val()) {
    dados = $(this).val();
    if (dados.indexOf('  ') !== -1) {
      dados = monta_dados(dados);
    }
  }
  $.ajax({
      url: `${window.Laravel.tomador.pesquisa}/${dados}`, 
      type: 'get',
      contentType: 'application/json',
      success: function(data) {
        tomador(' ')
        let nome = ''
          if (data.length >= 1) {
            data.forEach(element => {
              nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
              // nome += `<option value="${element.tsmatricula}">`
              // nome += `<option value="${element.tscnpj}">`
            });
            $('#listatomador').html(nome)
          }
          if(data.length === 1){
            tomador(data[0])
            let tabela = tabelaPrecoTabela(data[0].id);
            // let rublica = '';
            // let status = '';
            if (!tabela.length) {
              alertatabela(data[0].id)
                // tabela.forEach(element => {
                //   if (!element.tstomvalor) {
                //       status = 'vazia';
                //       rublica += ` <li class="list-group-item">O tomador da rublica ${element.tsdescricao} está R$ 0,00</li>`
                //   }
                //   if (!element.tsvalor) {
                //     status = 'vazia';
                //     rublica += `<li class="list-group-item">O trabalhador da rublica ${element.tsdescricao} está R$ 0,00</li>`
                //   }
                // });
                // if (status) {
                //   Alerta(data[0].id,status,rublica)
                // }
            }
            // else{
            //   status = 'não a tabela'
            //   Alerta(data[0].id,status,rublica)
            // }
          }           
      }
  });
});
   
    function monta_dados(dados) {
      let novodados = dados.split('  ')
      return novodados[0];
    }
    function monta_dados_pesquisa(dados) {
      let novodados = dados.split('  ')
      return novodados[0];
    }
    function alertatabela(tomador) {
      Swal.fire({
        title: '<strong>Algo deu Errado!</strong>',
        icon: 'error',
        html:
          '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
          `<a href="${window.Laravel.tabelapreco.create}/${btoa(tomador)}">Cadastrar</a> `,
        showCloseButton: true,
        allowOutsideClick: false,
        allowEnterKey: true,
      })
      // switch (status) {
      //   case 'vazia':
      //       Swal.fire({
      //         title: '<strong>Algo deu Errado!</strong>',
      //         icon: 'error',
      //         html:
      //           `<strong>Tabela de Preço</strong> existe rublica com o valor 0,
      //           <ul class="list-group">
      //            ${dados}
      //           </ul>
      //           <a href="${window.Laravel.tabelapreco.index}/ /${btoa(tomador)}">Atualizar valores</a> `,
      //         showCloseButton: true,
      //         allowOutsideClick: false,
      //         allowEnterKey: true,
      //       })
      //     break;
      //     case 'não a tabela':
      //       Swal.fire({
      //         title: '<strong>Algo deu Errado!</strong>',
      //         icon: 'error',
      //         html:
      //           '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
      //           `<a href="${window.Laravel.tabelapreco.create}/${btoa(tomador)}">Cadastrar</a> `,
      //         showCloseButton: true,
      //         allowOutsideClick: false,
      //         allowEnterKey: true,
      //       })
      //     break;
      // }
    
    }
    function tabelaPrecoTabela(tomador) {
      var resul = false;
      $.ajax({
          url: `${window.Laravel.tabelapreco.pesquisa}/0/${btoa(tomador)}`,
          type: 'get',
          contentType: 'application/json',
          async: false,
          success: function(data) {
            resul = data
          }
      })
      return resul;
    }
  
    function tomador(data) {
      $('#tomador').val(data.id)
      $('#matricula').val(data.tsmatricula)
      $('#domingo').val(data.csdomingos)
      $('#sabado').val(data.cssabados)
      $('#diasuteis').val(data.csdiasuteis)
    }
            