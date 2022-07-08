


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="Eliel Felipe dos Santos Rocha" />
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>Login - RHWEB</title>
        <link rel="stylesheet" href="{{url('/css/reset.css')}}">
        <link href="{{url('/css/login/login.css')}}" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="{{url('/imagem/arrowMobe.png')}}">
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>

    <body>
      <section class="vh-100 d-flex align-items-center justify-content-center">
          <div class="col-md-4 col-lg-4">
              <div class="background">
                  <div class="shape"></div>
                  <div class="shape"></div>
                  <div class="shape"></div>
              </div>

            <div class="card-body col-12 slide-in">

              <form action="{{ route('login.store') }}" method="POST" onsubmit="return validaRobo()">
                @csrf
                
                @error('user')
                    <span class="errorInput">{{ $message }} <i class="fad fa-exclamation-triangle"></i></span>
                @enderror
                
                @error('password')
                    <span class="errorInput">{{ $message }} <i class="fad fa-exclamation-triangle"></i></span>
                @enderror
                
                <div class="div-log">
                  <img class="logo-login" src="{{url('imagem/NewLogoBrancaRh.png')}}" alt="">
                </div>

                <div class="col-12 mb-2">
                  <label class="form-label " for="usuario"><i class="fad fa-user"></i> Usuário</label>
                  <input type="text" id="usuario" name="user" class="form-control usuario @error('user') is-invalid @enderror">
                  <span class="d-none errorInput" id="errorUsuario">Campo usuário precisar ser preenchido. <i class="fad fa-exclamation-triangle"></i></span>
                </div>

                <div class="col-12 div__icone--inside">
                    <label for="password" class="form-label"><i class="fad fa-lock"></i> Senha</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" maxlength="10">
                    <span class="show icone__inside"><i class="fad fa-lg fa-eye eye__icon" id=""></i></span>
                   <a href="{{route('esqueci.senha.index')}}"> <span class="small esqueceuSenha-title mt-0" >Esqueceu sua senha? </span></a>
                    <span class="d-none errorInput" id="errorSenha">Campo senha precisar ser preenchido. <i class="fad fa-exclamation-triangle"></i></span>
                </div>

               
                <div class="d-flex flex-row justify-content-start" style="width:100px;">
                    <div class="h-captcha mt-3" data-sitekey="9a42a3c7-383e-44c2-8c52-361a51bba6da" style="transform:scale(0.70);-webkit-transform:scale(0.70); transform-origin:0 0; -webkit-transform-origin:0 0; margin-right:0px;"></div>
                </div>

                <div class="d-flex justify-content-end align-items-end">
                  <button class="btn botao-entrar" id="botaoEntrar" type="submit">Entrar</button>
                </div>


                
              </form>

            </div>
          </div>

      </section>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script>
      <script type="text/javascript" src="../hcaptcha.js" integrity="sha256-CX7Tp6FpoWYaK8BICJFoGGhySgB9ldMXbkQOpFZMXxw=" crossorigin="anonymous" defer="defer"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/22295284.js"></script>
    </body>

</html>

<script>
    function validaRobo(){

       if(hcaptcha.getResponse() != "") return true;

        Swal.fire({
    icon: 'error',
    title: 'Algo deu errado!!',
    text: 'Preencha a caixa de "Sou Humano"',
    })
    return false;
 
    }


  $('#botaoEntrar').click(function(e){
    console.log($('#usuario').val());
    
    if($('#usuario').val() == ""){
      e.preventDefault();
      $('#errorUsuario').removeClass('d-none');
      $('#usuario').addClass('inputErro');
    }

    if($('#password').val() == ""){
      e.preventDefault();
      $('#errorSenha').removeClass('d-none');
      $('#password').addClass('inputErro');
    }
    
  });

  $('#usuario').bind('input',function(){

    if($('#usuario').val() != " "){
      $('#errorUsuario').addClass('d-none');
      $('#usuario').removeClass('inputErro');
    };

  });

  $('#password').bind('input',function(){

  if($('#password').val() != " "){
    $('#errorSenha').addClass('d-none');
    $('#password').removeClass('inputErro');
  };

  });
  

  let btnShow = document.querySelector('.show');
  btnShow.addEventListener('click', function(){
      let inputpass = document.querySelector("#password");
      let icon = document.querySelector('.icon');
      if(inputpass.getAttribute("type") === 'password') {
          inputpass.setAttribute('type', 'text');
          icon.classList.remove('far', 'fa-eye');
          icon.classList.add('far','fa-eye-slash');
          
      } else {
          inputpass.setAttribute('type', 'password');
          icon.classList.remove('far','fa-eye-slash');
          icon.classList.add('far','fa-eye');
      }
  });
</script>