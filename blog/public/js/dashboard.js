

var daily = document.querySelector("#daily");
console.log(daily);

daily.addEventListener("click", function(){

    Swal.fire({
        title: 'Escolha um dia <i class="fad fa-calendar-day"></i>',
        html:
          '<input class="input__modal--daily" type="date"></input> ',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
          'Selecionar <i class="fad fa-check"></i>',
        confirmButtonColor: '#0F805E',
        cancelButtonText:
          'Sair <i class="fad fa-times-circle"></i>',
        cancelButtonColor: '#BE2332'
    });

    
});

var month = document.querySelector("#month");

month.addEventListener("click", function(){

    Swal.fire({
        title: 'Escolha um mês <i class="fad fa-calendar-day"></i>',
        html:
          '<input class="input__modal--daily" type="month"></input> ',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
          'Selecionar <i class="fad fa-check"></i>',
        confirmButtonColor: '#0F805E',
        cancelButtonText:
          'Sair <i class="fad fa-times-circle"></i>',
        cancelButtonColor: '#BE2332'
    });

});

var week = document.querySelector("#week");

week.addEventListener("click", function(){

    Swal.fire({
        title: 'Escolha uma semana <i class="fad fa-calendar-day"></i>',
        html:
          '<input class="input__modal--daily" type="week"></input> ',
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText:
          'Selecionar <i class="fad fa-check"></i>',
        confirmButtonColor: '#0F805E',
        cancelButtonText:
          'Sair <i class="fad fa-times-circle"></i>',
        cancelButtonColor: '#BE2332'
    });
})


