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
        
        
        
        <body>
            <section class="mt-5">
                <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2" >
                    <form class="row g-3 needs-validation form-control bg__form" id="form" action="{{route('verifica.senha')}}" enctype="multipart/form-data"  method="Post" onsubmit="return validaRobo()" style="">
                    @csrf
                    <div class="container text-center text-white mt-4 mb-3 fs-4 fw-bold">Esqueceu a senha</div>

                    <div>

                        <div class="d-flex align-items-center">
                            <div class="col-11 col-sm-11 col-md-11 col-lg-4">
                            <label for="email" class="form-label text-white">Digite seu email</label>
                                <input type="email" id="email" class=" form-control input fw-bold text-dark fw-bold text-dark" value="" maxlength="100" name="email">
                                    <div class="mt-2">
                                        <span style="color: #fff ; background-color: #8F0200; font-size: 13px; padding: 5px; border-radius: 3px; border: 1px solid #CA023B; margin-top: 10px;"></span>
                                    </div>
                            </div>

                            <!--<div class="align-self-center mt-4 ms-2">-->
                            <!--    <span class="show"><i class="fas fa-lg fa-eye icon" id="" style="margin-top: 10px; background-color: #FFF; padding-bottom: 11px; padding-top: 11px; padding-left: 2px; padding-right: 2px; border-radius: 100%;"></i></span>-->
                            <!--</div>-->
                        </div>

                    </div>

                    <!--<div>-->

                    <!--    <div class="d-flex align-items-center">-->
                    <!--        <div class="col-11 col-sm-11 col-md-11 col-lg-4">-->
                    <!--        <label for="nome__social" class="form-label text-white">Nova Senha</label>-->
                    <!--        <input type="hidden" name="id" value="">-->
                    <!--        <input type="password" id="password1" class="form-control input fw-bold text-dark fw-bold text-dark password1 pass" onKeyUp="verificaForcaSenha();"   value="" maxlength="100" name="password1">-->
                                <!--@error('password1')-->
                                <!--    <span class="text-danger">{{ $message }}</span>-->
                                <!--@enderror-->
                    <!--        </div>-->

                    <!--        <div class="align-self-center mt-4 ms-2" >-->
                    <!--            <span class="show1" ><i class="fas fa-lg fa-eye icon1" style="margin-top: 10px; background-color: #FFF; padding-bottom: 11px; padding-top: 11px; padding-left: 2px; padding-right: 2px; border-radius: 100%;"></i></span>-->
                    <!--        </div>-->

                            
                    <!--    </div>-->

                    <!--        <div class="mt-2 mb-2">-->
                    <!--            <span class="" id="password-status"></span>-->
                    <!--        </div>-->

                    <!--        <div class="progress col-11 col-sm-11 col-md-11 col-lg-4 mb-1" style="height: 3px;" id="progressBar">-->
                    <!--            <div class="progress-bar"  role="progressbar" style="width: 0%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ></div>-->
                    <!--        </div>-->


                    <!--            <div class="d-flex align-items-center">-->
                    <!--                <div class="col-11 col-sm-11 col-md-11 col-lg-4">-->
                    <!--                <label for="nome__social" class="form-label text-white">Confirme sua senha</label>-->
                    <!--                <input type="password" id="password2" class="form-control input fw-bold text-dark fw-bold text-dark password2 pass" onblur="validarSenha()" value="" maxlength="100" name="password2">-->
                                    <!--@error('password2')-->
                                    <!--    <span class="text-danger">{{ $message }}</span>-->
                                    <!--@enderror-->
                    <!--                </div>-->

                    <!--                <div class="align-self-center mt-4 ms-2">-->
                    <!--                    <span class="show2"><i class="fas fa-lg fa-eye icon2" style="margin-top: 10px; background-color: #FFF; padding-bottom: 11px; padding-top: 11px; padding-left: 2px; padding-right: 2px; border-radius: 100%;"></i></span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--                <div class="mt-2">-->
                    <!--                    <span class="span" id="span" style=" "></span>-->
                    <!--                </div>-->

                    <!--</div>      -->
                            
                                 
                                <div class="container">
                                    <div class="d-flex row justify-content-start" style="width:180px;">
                                        <div class="h-captcha mt-3" data-sitekey="9a42a3c7-383e-44c2-8c52-361a51bba6da" style="transform:scale(0.80);-webkit-transform:scale(0.80);transform-origin:0 0;-webkit-transform-origin:0 0; margin-right:0px;"></div>
                                    </div>
                                </div>


                            <div class="col-md-4">
                                <button type="submit" id="alterar" class="btn botao__alteracao">Enviar</button>
                            </div>
                    
                    </form>
                </div>

            </section>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>