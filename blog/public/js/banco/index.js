$(document).ready(function(){
    console.log(window.location.protocol,window.location.host);
    // Swal.fire({
    //     title: '<strong>Evento baixado com sucesso</strong>',
    //     icon: 'success',
    //     html: '<div class="progress mb-3" style="height: 12px;">' +
    //     '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
    //     '</div>' +
    //     '<p id="msg">Deseja Integrar esse arquivo com o E-SOCIAL?</p>',
    //     input: 'file',
    //     inputAttributes: {
    //         'accept': 'text/*',
    //         'aria-label': 'Upload your profile picture'
    //       },
    //     showCloseButton: true,
    //     showCancelButton: false,
    //     focusConfirm: false,
    //     showConfirmButton: true,
    //     confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
    //     confirmButtonColor: '#04888B',
    //     allowOutsideClick: false,
    //     allowEscapeKey: false,
    //     preConfirm: (event) => {
    //     if (event) {
    //         var ext = ['text']
    //         var type = event.type.split('/')
    //         if (ext.indexOf(type[0]) !== -1) {
    //             $('#msg').text('Evento sendo enviado para SEFAZ.')
    //             $('#progress').text('50%').css({"width": "50%"});
    //             var myFormData = new FormData();
    //             myFormData.append('file', event);
    //             tomador_txt(myFormData)
    //         }  
    //     }
    //     return false;
    //     }
    // })
    function tomador_txt(dados) {
        $.ajax({
            url: `http://127.0.0.1:8000/administrador/cadastro/texto/trabalhador`,
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
                $('#msg').text('Lote Recebido com Sucesso.')
                $('#progress').text('50%').css({"width": "50%"});
            }
         });
    }
})