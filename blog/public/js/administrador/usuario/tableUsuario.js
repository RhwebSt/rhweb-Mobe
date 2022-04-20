$("#txtTomador").click(function(){

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

         }
    })
    
});

$("#txtTrabalhador").click(function(){

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

         }
    })
    
});

