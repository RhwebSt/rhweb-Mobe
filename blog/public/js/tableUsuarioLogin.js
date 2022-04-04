// inciio da verificação se a pessoa deseja realmente exluir
const buttonDelete = document.querySelector('#button__delete');

buttonDelete.addEventListener('click', function(e){
    e.preventDefault();
    Swal.fire({
        icon: 'warning',
        html: '<h2>Deseja Realmente excluir?</h2>',
        allowOutsideClick: false,
        allowEnterKey: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonText: 'Sim, desejo excluir',
        confirmButtonColor: '#BE2332',
        // inicio se a pessoa apertou no botão
        preConfirm: () =>{
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'success',
                title: 'Excluído com Sucesso'
              })
            console.log('deu certo');
        }
        //fim da ação 
    
      });

    
})
// fim da verificação de deleção
