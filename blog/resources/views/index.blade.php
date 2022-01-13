<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=" Empresa com o foco em desenvolvimento de software para web" />
        <meta name="author" content="José Luis da costa soares"/>
        <meta name="keywords" content="recursos humanos, software, software web, e-social, sistemas inteligentes, sistemas, sindicato, desenvolvimento de software">
        <meta name="copyright" content="© 2022 RHWeb sistemas inteligentes" />
        <title>RHWEB - Sistemas Inteligentes</title>
        <link rel="icon" type="image/x-icon" href="{{url('/imagem/arrowMobe.png')}}">
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,600;1,900&display=swap" rel="stylesheet">
        <link href="{{url('/css/styleLandingPage.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top"><img class="fotoTopo" src="{{url('/imagem/rhwebTop2.png')}}" alt=""></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link text-white" href="#about">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="#signup">Contato</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{route('login.create')}}"><i class="fas fa-user"></i> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">RHWeb</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Soluções Inteligentes para a sua empresa.</h2>
                        <a class="btn botao" href="#about">Conheça mais</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="about-section text-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Sobre a empresa</h2>
                        <p class="text-opacity-75 text-white">
                            Somos uma empresa especializada em desenvolvimento de softwares voltado para web, temos o intuito de melhorar a organização da sua empresa facilitando nas tarefas do dia a dia.
                             Já estamos no mercado há mais de 32 anos entregando as melhores soluções de softwares, temos uma equipe altamente treinada e capacitada para dar o melhor atendimento para você.
                        </p>
                    </div>
                </div>
                <img class="img-fluid" src="/images/devices.svg" alt="..." />
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section" id="signup">
            <div class="container px-4 px-lg-5">
                <div class="row d-flex gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-white mb-2"></i>
                                <h4 class="text-uppercase m-0  text-white">Endereço</h4>
                                <hr class="my-4 mx-auto text-white" />
                                <div class="small text-white">Rua Nereu Ramos, 646 - SC</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-headset text-white mb-2"></i>
                                <h4 class="text-uppercase m-0  text-white">Suporte</h4>
                                <hr class="my-4 mx-auto text-white" />
                                <div class="small"><a href="mailto:suporte@rhwebsistemasinteligentes.com.br" class="text-white">suporte@rhwebsistemasinteligentes.com.br</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-white mb-2"></i>
                                <h4 class="text-uppercase m-0 text-white">Telefone</h4>
                                <hr class="my-4 mx-auto  text-white" />
                                <div class="small text-white">(67) 98448-0740</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2 d-none" href="#!"><i class="fab fa-linkedin"></i></a>
                    <a class="mx-2 d-none" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2 d-none" href="#!"><i class="fab fa-instagram"></i></a>
                    <a class="mx-2" href="mailto:suporte@rhwebsistemasinteligentes.com.br"><i class="far fa-envelope"></i></a>
                    <a class="mx-2" href="https://wa.me/5567984480740"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </section>
        <footer class="footer small text-center text-white"><div class="container px-4 px-lg-5">Copyright &copy; RHWeb - Sistemas Inteligentes 2022</div></footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('js/scriptsLandingPage.js')}}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
