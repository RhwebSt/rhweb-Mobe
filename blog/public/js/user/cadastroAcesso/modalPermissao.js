function permissao(trabalhador,permissao,condicao) {
    console.log(permissao,trabalhador);
    $.ajax({
      url: `{{url('permissao')}}/${trabalhador}/${permissao}/${condicao}`,
      type: 'get',
      contentType: 'application/json',
      success: function(data) {
       
      }
    })
  }