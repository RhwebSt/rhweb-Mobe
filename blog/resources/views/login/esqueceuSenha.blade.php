<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="Eliel Felipe dos Santos Rocha" />
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>Esqueci a senha - RHWEB</title>
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <link href="{{url('/css/reset.css')}}" rel="stylesheet" />
        <link href="{{url('/css/login/esqueciSenha.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
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
        
        
        
        <body class="">
            
            <header>
                <nav class="navbar bg-dark">
                  <div class="container-fluid">
                    <a class=""><img class="navbar-brand" src="{{url('/imagem/rhwebTop2.png')}}" alt="" srcset="" style="width: 90px;"></a>
                  </div>
                </nav>
            </header>
            
            
            <main role="main" class="container">
                <section class="section__altera--senha">

                    <form class="row g-3" id="form" action="{{route('verifica.senha')}}" enctype="multipart/form-data"  method="Post" onsubmit="return validaRobo()" style="">
                        @csrf
                        <div class="title__altera--senha">Esqueci a senha <i class="fad fa-key"></i></div>
    
                        <div class="d-flex justify-content-center flex-row">
    
                            <div class="col-11 col-md-8">
                                <label for="email" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Digite seu email</label>
                                <input type="email" id="email" class=" form-control input" value="" maxlength="100" name="email" required>
                            </div>

                        </div>
                        
                        <div class="d-flex justify-content-center flex-row">
                            <div class="h-captcha mt-3" data-sitekey="9a42a3c7-383e-44c2-8c52-361a51bba6da" style="transform:scale(0.70);-webkit-transform:scale(0.70);transform-origin:0 0;-webkit-transform-origin:0 0; margin-right:0px; margin-left:90px"></div>
                        </div>

                        <div class="d-flex justify-content-center flex-row">
                            <div class="">
                                <button type="submit" id="alterar" class="btn botao__alterar">Enviar <i class="fad fa-paper-plane"></i></button>
                            </div>
                        </div>
                        
                    </form>

                </section>
                
                
            </main>
            
            <footer class=" ">
                <p class=" footer text-nowrap fixed-bottom">©Copyright RHWEB Sistemas Inteligentes - 2022</p>
            </footer>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>