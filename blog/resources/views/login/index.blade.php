 
 <?php
 $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://hcaptcha.com/siteverify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => [
            'response' => $_POST['h-captcha-response'] ?? '',
            'secret' => '0x955E220995438CBC12CEde4BCC6fEc9c7BE28465'
            ]
        ] );
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $responseArray = json_decode($response, true);
        
        $sucesso = $responseArray['success'] ?? false;

    ?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="Eliel Felipe dos Santos Rocha" />
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>RHWEB - Login</title>
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <link href="{{url('/css/newLogin.css')}}" rel="stylesheet" />
        {{-- <link href="/css/rhweb.css" rel="stylesheet" /> --}}
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    
     <script>
                function validaRobo(){

                    if(hcaptcha.getResponse() != "") return true;

                    Swal.fire({
                      icon: 'error',
                      title: 'Algo deu errado!!',
                      text: 'Preencha a caixa de "Sou Humano"',
                    })
 
                }
    </script>

    <body>
      <section class="vh-100" style="background-image: linear-gradient( 120deg, #0746f2, #2901da, #5629d1 );">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="{{url('/imagem/bglogin.png')}}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; width:650px; height:650px;"/>
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
                    
                      <form class="" action="{{ route('login.store') }}" method="POST" onsubmit="return validaRobo()">
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                          {{-- <img src="/images/arrowMobe.png" alt="" srcset="" style="width: 70px; height: 70px;"> --}}
                          <span class="h1 fw-bold mb-0">Bem Vindo!</span>
                        </div>
                        @csrf
    
                        @error('user')
                            <span style="color: #CC2836;">{{ $message }} <i class="fad fa-exclamation-triangle fa-lg"></i></span>
                        @enderror
                        
                        @error('password')
                            <span style="color: #CC2836;">{{ $message }} <i class="fad fa-exclamation-triangle fa-lg"></i></span>
                        @enderror
    
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Faça seu login!</h5>
                        @error('mensagem')
                            <div class="col-12" style="color: #CC2836;" class="mb-2">
                                {{$message}}
                            </div>
                        @enderror
      
                        <div class="form-outline col-10 mb-4">
                          <label class="form-label " for="form2Example17">Usuário</label>
                          <input type="text" id="form2Example17" class="form-control usuario @error('user') is-invalid @enderror" name="user" required>
                        </div>
      
                        <div class="form-outline  col-10 mb-4">
                          <label class="form-label" for="form2Example27">Senha</label>
                          <div class="align-items-center d-flex">
                              <input type="password" id="form2Example27" name="password" class="form-control col-10 @error('password') is-invalid @enderror"/>
                              <div class="align-self-center ms-2" >
                                  <span class="show" ><i class="fas fa-lg fa-eye icon" style="margin-top: 4px; background-color: rgb(0, 0, 0); color:white; padding:3px; border-radius:20px;"></i></span>
                              </div>
                          </div>
                          
                            <div class="d-flex flex-row justify-content-start">
                                <div class="container-sm"> <!--style="width:200px;"-->
                                    <div class="h-captcha mt-3" data-sitekey="9a42a3c7-383e-44c2-8c52-361a51bba6da" style="transform:scale(0.80);-webkit-transform:scale(0.80);transform-origin:0 0;-webkit-transform-origin:0 0; margin-right:0px;"></div>
                                </div>
                            </div>
                          <script>
                            let btnShow = document.querySelector('.show');
                            
    
                              btnShow.addEventListener('click', function(){
                                  let inputpass = document.querySelector("#form2Example27");
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
                          })
                          </script>
                          
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg botao" type="submit" type="button">Entrar</button>
                        </div>
      
                        <a class="small text-muted" href="#!">Esqueceu sua senha?</a>
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>