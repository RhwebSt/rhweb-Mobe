function tomador(empresa){

console.log(empresa);
    Swal.fire({
        // title: '<strong>Importando Dados</strong>',
        // icon: 'success',
        html: '<div class="progress mt-5 mb-3" style="height: 12px;">' +
        '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
        '</div>' +
        '<p id="msg" alert alert-danger></p>', 
        input: 'file',
        inputAttributes: {
            'accept': 'text/*',
            'multiple':'multiple',
            'aria-label': 'Upload your profile picture'
          },
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        showConfirmButton: true,
        confirmButtonText: 'Importar <i class="fad fa-lg fa-cloud-upload-alt"></i>',
        confirmButtonColor: '#04888B',
        allowOutsideClick: false,
        allowEscapeKey: false,
        preConfirm: (event) => {
          console.log(event);
          var ext = ['text'];
          var nome = ['tomador','tabela']
          if (event) {
            if (event.length < 2) {
              $('#msg').text('E preciso passa 2 arquivo.').addClass('alert alert-danger')
              return false;
            }
           
            for (let index = 0; index < event.length; index++) {
              var type = event[index].type.split('/')
              var name = event[index].name.split('.')
              if (ext.indexOf(type[0]) === -1) {
                  $('#msg').text('O formato do arquivo não é txt.').addClass('alert alert-danger')
                  return false;
              }
              if (nome.indexOf(name[0]) === -1) {
                $('#msg').text('Renomeie os arquivo para tomador e tabela.').addClass('alert alert-danger')
                return false;
              }
            }
           
            var myFormData = new FormData();
            for (let i = 0; i < event.length; i++) {
              myFormData.append(`file${i}`, event[i])
            }
            // myFormData.append('file', event);
            myFormData.append('empresa',empresa)
            tomador_txt(myFormData);
          }
          return false;
        }
    })
    
};

function trabalhador(empresa){

    Swal.fire({
        // title: '<strong>Importando Dados</strong>',
        // icon: 'success',
        html: '<div class="progress mt-5 mb-3" style="height: 12px;">' +
        '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
        '</div>' +
        '<p id="msg">Em processamento...</p>',
        input: 'file',
        inputAttributes: {
            'accept': 'text/*',
            'aria-label': 'Upload your profile picture'
          },
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: false,
        showConfirmButton: true,
        confirmButtonText: 'Importar <i class="fad fa-lg fa-cloud-upload-alt"></i>',
        confirmButtonColor: '#04888B',
        allowOutsideClick: false,
        allowEscapeKey: false,
        preConfirm: (event) => {
          if (event) {
            var ext = ['text']
            var type = event.type.split('/')
            if (ext.indexOf(type[0]) !== -1) {
                // $('#msg').text('Evento sendo enviado para SEFAZ.')
                $('#progress').text('50%').css({"width": "50%"});
                var myFormData = new FormData();
                myFormData.append('file', event);
                myFormData.append('empresa',empresa)
                trabalhador_txt(myFormData)
            }  
          }
          return false;
        }
    })
    
};
function trabalhador_txt(dados) {
  
  $('#progress').text('50%').css({"width": "50%"});
  $.ajax({
      url: `${window.location.protocol}//${window.location.host}/administrador/cadastro/texto/trabalhador`,
      type: "POST",
      data: dados,
      dataType: 'json',
      contentType: false,
      processData: false,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }, 
      async:false,
      // cache: false,
      success: function(retorno){
          $('#msg').text('Backup realizado com Sucesso.')
          $('#progress').text('100%').css({"width": "100%"});
      }
   });
}
function tomador_txt(dados) {
  $('#msg').text(' ').removeClass('alert alert-danger')
  $('#progress').text('50%').css({"width": "50%"});
  $.ajax({
      url: `${window.location.protocol}//${window.location.host}/administrador/cadastro/texto/tomador`,
      type: "POST",
      data: dados,
      dataType: 'json',
      contentType: false,
      processData: false,
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }, 
      async:false,
      // cache: false,
      success: function(retorno){
          $('#msg').text('Backup realizado com Sucesso.')
          $('#progress').text('100%').css({"width": "100%"});
      }
   });
}

