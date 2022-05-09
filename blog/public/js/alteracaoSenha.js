let btnShow = document.querySelector('.show');

    
    btnShow.addEventListener('click', function(){
        let inputpass = document.querySelector('.password');
        let icon = document.querySelector('.icon');
        if(inputpass.getAttribute('type') == 'password') {
            inputpass.setAttribute('type', 'text');
            icon.classList.remove('fad', 'fa-eye');
            icon.classList.add('fad','fa-eye-slash');
            
        } else {
            inputpass.setAttribute('type', 'password');
            icon.classList.remove('fad','fa-eye-slash');
            icon.classList.add('fad','fa-eye','fa-lg');
        }
})


let btnShow1 = document.querySelector('.show1');
    
    btnShow1.addEventListener('click', function(){
        let inputpass1 = document.querySelector('.password1');
        let icon = document.querySelector('.icon1');
        if(inputpass1.getAttribute('type') == 'password') {
            inputpass1.setAttribute('type', 'text');
            icon.classList.remove('fad', 'fa-eye');
            icon.classList.add('fad','fa-eye-slash');
        } else {
            inputpass1.setAttribute('type', 'password');
            icon.classList.remove('fad','fa-eye-slash');
            icon.classList.add('fad','fa-eye');
        }
    })

    let btnShow2 = document.querySelector('.show2');

    btnShow2.addEventListener('click', function(){
        let inputpass2 = document.querySelector('.password2');
        let icon = document.querySelector('.icon2');
        
        if(inputpass2.getAttribute('type') == 'password') {
            inputpass2.setAttribute('type', 'text');
            icon.classList.remove('fad', 'fa-eye');
            icon.classList.add('fad','fa-eye-slash');
            
        } else {
            inputpass2.setAttribute('type', 'password');
            icon.classList.remove('fad','fa-eye-slash');
            icon.classList.add('fad','fa-eye');
        }
    })


    function validarSenha() {
        var senha1 = document.getElementById("password1");
        var senha2 = document.getElementById("password2");
        var msg = document.getElementById("span");
        var s1 = senha1.value;
        var s2 = senha2.value;

        if(s2 != s1) {
            senha1.classList.add('is-invalid');
            senha2.classList.add('is-invalid');
            msg.innerHTML = "<span style='color: #fff ; background-color: #8F0200; font-size: 13px; padding: 5px; border-radius: 3px; border: 1px solid #CA023B '>As senhas não são compatíveis <i class='fas  fa-exclamation-circle'></i></span>";
            return false;
        }

        if (s2 == s1) {
            senha1.classList.add('is-valid');
            senha1.classList.remove('is-invalid');
            senha2.classList.add('is-valid');
            senha2.classList.remove('is-invalid');
            msg.innerHTML = "";
            return true;
        }


        }

        function verificaForcaSenha() 
        {
            var numeros = /([0-9])/;
            var alfabetomin = /([a-z])/;
            var alfabetomaius = /([A-Z])/;
            var chEspeciais = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;


            if($('#password1').val().length<6) 
            {
                $('#progressBar').html("<div class='progress-bar' role='progressbar' style='width: 25%; background-color:#8F0200;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' id='progressBar'></div>");
                $('#password-status').html("<span class='text-white  rounded text-center text-wrap' style='background-color:#8F0200; color: #FFF; font-size: 13px; padding: 3px; border: 1px solid #CA023B;'>Senha fraca, mínimo 6 carácteres</span>");
            } else {  	
                if($('#password1').val().match(numeros) && $('#password1').val().match(alfabetomin) && $('#password1').val().match(alfabetomaius) && $('#password1').val().match(chEspeciais))
                {  
                    $('#progressBar').html("<div class='progress-bar' role='progressbar' style='width: 100%; background-color:#19BA4A;' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' id='progressBar'></div>");
                    $('#password-status').html("<span class='text-white p-1 rounded mt-3' style='border: 1px solid #50C9CE; background-color: #19BA4A; font-size: 13px;'>Muito Forte</span>");
                } else {
                    $('#progressBar').html("<div class='progress-bar' role='progressbar' style='width: 65%; background-color:#F9BF39;' aria-valuenow='65' aria-valuemin='0' aria-valuemax='100' id='progressBar'></div>");
                    $('#password-status').html("<span class=' p-1 rounded mt-3' style='color: #FFF; border: 1px solid #F9BF39; background-color: #CC8F00; font-size: 13px;'>Média, insira um carácter especial e uma letra maiuscúla</span>");
                }
            }
        }
      

        