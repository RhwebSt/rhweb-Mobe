function buttonNotification(){
    const button = document.querySelector('#buttonNotification');
    const valueNotification = document.querySelector('#valueNotification');
    const resultNotification = valueNotification.textContent;
    const bellNotification = document.querySelector('#bell__notification');

    if (resultNotification <= 0) {
        button.classList.add('button__notification--no--message');
        button.classList.remove('button__notification--with--message');
        valueNotification.classList.add('d-none');
        bellNotification.classList.remove('bell__notification');
    }else{
        button.classList.remove('button__notification--no--message');
        button.classList.add('button__notification--with--message');
        valueNotification.classList.remove('d-none');
        bellNotification.classList.add('bell__notification');
    }

}

buttonNotification();


function vizualizarNotificacao(){
    const notificacao = document.querySelector("#notification");
    const iconeVizualizado = document.querySelector("#notification__icon-no-read");

    notificacao.addEventListener('click', function(){
        
        Swal.fire({
            html:
                '<h2>RHWEB - Agora</h2>'+
              '<p id="mensagem__notificacao">O sistema será atualizado no dia 30/03/22 as </p> ',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
              'Ok <i class="fad fa-check"></i>',
            confirmButtonColor: '#0F805E',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
        });

    });
}

vizualizarNotificacao();
