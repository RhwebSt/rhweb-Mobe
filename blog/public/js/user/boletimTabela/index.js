   
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
            // let tabela = tabelaPreco(data[0].id);
            // if (tabela) {
            
            // }else{
            //   Alerta(data[0].id)
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
          url: `${window.Laravel.tabelapreco.pesquisa}/${tomador}`,
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
            