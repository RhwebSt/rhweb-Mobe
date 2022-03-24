<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="" />
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>RHWEB - Gerar Acesso</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="icon" type="image/x-icon" href="images/arrowMobe.ico">
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="/css/rhweb.css" rel="stylesheet" />
        <link href="/css/alteracaoSenha.css" rel="stylesheet" />      
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>

    <body>
                
        

        <section class="mt-5">
            <div class="container d-flex justify-content-center flex-column align-items-center mt-5 p-2" >
                <form class="row g-3 needs-validation form-control bg__form" id="form" action="{{route('usuario.pre.cadastro')}}" enctype="multipart/form-data"  method="Post">
                @csrf
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <h1 class="text-center fs-4 text-white mt-5 mb-5">Gerar Código de Acesso <i class="fas fa-door-open"></i></h1>

                            <div class="col-md-4">
                                <label for="usuario" class="form-label text-white">Usuário <i class="fas fa-lock"></i></label>
                                <input type="text" class="form-control input input fw-bold text-dark" name="name" value="" id="usuario" readonly>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="codigo" class="form-label text-white">Código <i class="fas fa-lock"></i></label>
                                <input type="text" class="form-control input input fw-bold text-dark" name="senha" value="" id="codigo" readonly>
                            </div>


                            <div class="col-md-4 mt-2">
                                <label for="email" class="form-label text-white">Email</label>
                                <input type="email" class="form-control input input fw-bold text-dark" name="email" value="" id="email">
                                <div class="invalid-feedback" id="emailFeedback">
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <button type="submit" id="vincular" name="vincular" class="btn botao__alteracao">Vincular <i class="fas fa-link"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
        <script>

            var campoCodigo = document.querySelector("#codigo");
            var campoUsuario = document.querySelector("#usuario");
            var msgErroEmail = document.querySelector("#emailFeedback");

            function geraStringAleatoria(tamanho) {
                var stringAleatoria = '';
                var caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                for (var i = 0; i < tamanho; i++) {
                    stringAleatoria += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
                }
                return stringAleatoria;
            }

            function geraUsuario(tamanho) {
                var stringAleatoria = '';
                var caracteres = '0123456789';
                for (var i = 0; i < tamanho; i++) {
                    stringAleatoria += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
                }
                return stringAleatoria;
            }

            var codigoGerado = campoCodigo.value = geraStringAleatoria(6);
            var codigoUsuarioGerado = campoUsuario.value = geraUsuario(5);

            var campoEmail = document.querySelector("#email");
            
            
            function validateEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }

            campoEmail.addEventListener('input', function(){
                var teste = validateEmail(campoEmail.value);

                if(teste == true){
                    campoEmail.classList.add('is-valid');
                }else{
                    campoEmail.classList.remove('is-valid');
                }

                if(campoEmail.value.length > 0){
                    msgErroEmail.textContent = "";
                    campoEmail.classList.remove('is-invalid');
                }


            });

            var botaoVincular = document.querySelector("#vincular");

            botaoVincular.addEventListener('click', function(e){
                
                if(campoEmail.value <= 0){
                    campoEmail.classList.add('is-invalid');
                    e.preventDefault();
                    msgErroEmail.textContent = "Preencha o campo de Email!";
                }else{
                    msgErroEmail.textContent = "";
                    campoEmail.classList.remove('is-invalid');
                }
            })

            
            
        </script>
    </body>
</html>