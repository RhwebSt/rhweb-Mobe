<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="José Luis da costa soares, Eliel Felipe dos Santos Rocha"/>
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>RHWEB - Sistemas Inteligentes</title>
        <link rel="icon" type="image/x-icon" href="{{url('/imagem/arrowMobe.png')}}">
         <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@500&display=swap" rel="stylesheet">
        <link href="{{url('/css/styleLandingPage.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand icone__rhweb" id="home" href="#page-top"><img class="fotoTopo" src="{{url('/imagem/NewLogoBrancaRh.png')}}" alt=""></a>
                <button class="navbar-toggler navbar-toggler-right" id="hamburgerButton" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i id="iconHambButton" class="fad fa-2x fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link text-white" id="sobre" href="#about">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link text-white" id="contato" href="#signup">Contato</a></li>
                        <li class="nav-item"><a class="nav-link text-white" id="login" href="{{route('login.create')}}"><i class="fas fa-user"></i> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center contentPrincipal">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">RHWeb</h1>
                        <h2 class="text-white text-opacity-75 mx-auto mt-2 mb-5">Soluções Inteligentes para a sua empresa.</h2>
                        <a class="btn botao botao__conheca" id="botao__conheca" href="#about">Conheça mais</a>
                    </div>
                </div>
            </div>
        </header>
        
        <svg class="svgCima" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#000C31" fill-opacity="1" d="M0,64L48,85.3C96,107,192,149,288,144C384,139,480,85,576,101.3C672,117,768,203,864,245.3C960,288,1056,288,1152,245.3C1248,203,1344,117,1392,74.7L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        
        <!-- About-->
        <section class="about-section text-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 contentAbout">
                        <h2 class="text-white mb-4">Sobre a empresa</h2>
                        <p class="text-opacity-75 text-white text-sobre">
                            Somos uma empresa especializada em desenvolvimento de softwares voltado para web, temos o intuito de melhorar a organização da sua empresa facilitando nas tarefas do dia a dia.
                             Já estamos no mercado há mais de 32 anos entregando as melhores soluções de softwares, temos uma equipe altamente treinada e capacitada para dar o melhor atendimento para você.
                        </p>
                    </div>
                </div>
                
            </div>
        </section>
        <!-- Contact-->
        
        <!--<img class src="imagem/backgroundHome.svg">-->
        
        <svg class="svgBaixo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path fill="#000C31" fill-opacity="1" d="M0,256L40,240C80,224,160,192,240,181.3C320,171,400,181,480,160C560,139,640,85,720,96C800,107,880,181,960,208C1040,235,1120,213,1200,213.3C1280,213,1360,235,1400,245.3L1440,256L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
        </svg>
        
        <section class="contact-section" id="signup">
            <h2 class="text-center text-white mb-5">Contatos</h2>
            
            <div class="container mt-2 px-4 px-lg-5 contentContato">
                <div class="row d-flex gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fad fa-2x fa-map-marked-alt text-white mb-2"></i>
                                <h4 class="text-uppercase m-0  text-white">Endereço</h4>
                                <hr class="my-4 mx-auto text-white" />
                                <div class="small"><a href="https://goo.gl/maps/mTXxo1uN1hNwCCrT9">Rua Nereu Ramos, 646 - SC</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fad fa-2x fa-headset text-white mb-2"></i>
                                <h4 class="text-uppercase m-0  text-white">Suporte</h4>
                                <hr class="my-4 mx-auto text-white" />
                                <div class="small"><a href="mailto:suporte@rhwebsistemasinteligentes.com.br">suporte@rhwebsistemasinteligentes.com.br</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class=" fa-2x fad fa-briefcase text-white mb-2"></i>
                                <h4 class="text-uppercase m-0 text-white">Comercial</h4>
                                <hr class="my-4 mx-auto  text-white" />
                                <div class="small"><a href="https://wa.me/5567984480740">(67) 98448-0740</a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <footer class="footer small text-center text-white"><div class="container px-4 px-lg-5">Copyright &copy; RHWeb - Sistemas Inteligentes 2022</div></footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/22295284.js"></script>
        <script src="{{url('js/scriptsLandingPage.js')}}"></script>
        <script>
            $('#botao__conheca').click(function(){
                
                $('.contentAbout').addClass('transicaoAbout');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('.contentAbout').removeClass('transicaoAbout'); 
                }
            });
            
            
            $('#sobre').click(function(){
                
                $('.contentAbout').addClass('transicaoAbout');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('.contentAbout').removeClass('transicaoAbout'); 
                }
            });
            
            $('#contato').click(function(){
                
                $('.contentContato').addClass('transicaoAbout');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('.contentContato').removeClass('transicaoAbout'); 
                }
            });
            
            $(document).ready(function(){
                
                $('.contentPrincipal').addClass('transicaoAbout');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('.contentPrincipal').removeClass('transicaoAbout'); 
                }
            });
            
            
            $('#home').click(function(){
                
                $('.contentPrincipal').addClass('transicaoAbout');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('.contentPrincipal').removeClass('transicaoAbout'); 
                }
            });
            
            
            $('#login').click(function(){
                
                $("header").addClass('transicaoLogin');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('body').removeClass('transicaoLogin'); 
                }
                
                $(".contentAbout").addClass('transicaoLogin');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('body').removeClass('transicaoLogin'); 
                }
                
                $(".contentContato").addClass('transicaoLogin');
                esperaTransicao = setTimeout(esperaTransicao, 2000);
                function esperaTransicao(){
                   $('body').removeClass('transicaoLogin'); 
                }
            });
            
            $( "#hamburgerButton" ).click(function() {
              $( '#iconHambButton' ).toggleClass( "fa-times" );
              console.log($("#iconHambButton").hasClass("fa-times"));
            });
            
        </script>
    </body>
</html>
