function permissao(trabalhador,permissao,condicao) {
    console.log(permissao,trabalhador);
    $.ajax({
      url: `${window.Laravel.user.permicao}/${trabalhador}/${permissao}/${condicao}`,
      type: 'get',
      contentType: 'application/json',
      success: function(data) {
       
      }
    })
  } 