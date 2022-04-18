<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <title>@yield('titulo')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/css/dashboard.css')}}">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <!-- <link rel="stylesheet" href="{{url('/css/cadastroLoginUsuario.css')}}"> -->
        <link rel="stylesheet" href="{{url('/css/inss.css')}}">
        <link rel="stylesheet" href="{{url('/css/irrf.css')}}">
        <link rel="stylesheet" href="{{url('/css/tableAdmin.css')}}">
        <link rel="stylesheet" href="{{url('/css/categoriaAutomatica.css')}}">
        <link rel="stylesheet" href="{{url('/css/rubrica.css')}}">
        <link rel="stylesheet" href="{{url('/css/cbo.css')}}">
        <link rel="stylesheet" href="{{url('/css/historicoTrab.css')}}">
        <link rel="stylesheet" href="{{url('/css/administrador/usuario/geradorAcesso.css')}}"
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script type="text/javascript" src="{{url('/js/jquery.mask.js')}}" ></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.all.min.js"></script>
    </head>
    <script>
        var url = window.location.protocol + "//" +window.location.host+window.location.pathname
    </script>
    <body>
<main>
            
        <head>
            <nav class="navbar nav__bar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img class="img__navbar" src="{{url('imagem/rhwebTop2.png')}}" alt="logo da rhweb - possui duas setas com direções opostas" srcset=""></a>
                    <div class="d-flex flew-row justify-content-end">
                        {{-- pesquisar da navbar --}}
                        <div class="me-2">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                                <button class="btn button__search type="submit"><i class="fad fa-search"></i></button>
                            </form>
                        </div>
                        {{-- fim do pesquisar navbar --}}
                        <div class="me-4">
                            {{-- inicio da contagem da notificação --}}
                            <button type="button" id="buttonNotification" class="btn position-relative button__notification--no--message" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <i id="bell__notification" class="fad fa-bell"></i>
                                <span id="valueNotification" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                  99  {{-- colocar a quantidade de notificação não lidas que possui--}}
                                </span>
                            </button>
                            {{-- fim da contagem da notificação --}}
                        </div>

                        {{-- icone(botao) que aciona a sidebar --}}
                        <div class="align-self-center">
                            <button class="navbar-toggler button__side--bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                                <i class="fad fa-bars icon__side--bar"></i>
                            </button>
                        </div>
                        {{-- fim do botao que aciona a sidebar --}}

                    </div>

                    
                    {{-- inicio da sidebar --}}
                    <div class="off__canvas offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Dashboard <i class="fad fa-tachometer-alt"></i></h5>
                            <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                        </div>
                        <div class="offcanvas-body off__canvas--body">
                            <ul class="navbar-nav off__canvas--list justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active color-Link " aria-current="page" href="#"><i class="fad fa-home"></i> Home</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-user-plus"></i> Cadastros de Acesso
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Cadastro de Usuário</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('administrador.usuarios.index')}}">Cadastro de Login</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('user.create')}}">Gerador de Acesso</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-chart-network"></i> Principais
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('inss.index')}}">INSS</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('irrf.index')}}">IRRF</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('rublica.index')}}">Rúbricas</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="">CBO</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Categoria do trabalhador</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('administrador.trabalhador.historico.index')}}">Trabalhador</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-text"></i> Textos Automáticos
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('administrador.cbo.index')}}">CBO</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="{{route('administrador.categoria.index')}}">Categoria do Trabalhador</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Recibo Avulso</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-comments"></i> Chat
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Cadastrar suporte</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-comment-alt-dots"></i> Notificações Usuários
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Enviar notificação</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">atualização do sistema</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Recibo Avulso</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active color-Link " aria-current="page" href="#"><i class="fad fa-cogs"></i> Configurações</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active color-Link" href="{{route('logout.administrador')}}"><i class="fad fa-sign-out"></i> Sair</a>
                                </li>
                            </ul>

                        </div>
                  </div>
                  {{-- fim da sidebar --}}
                </div>
                
            
              </nav>
              <!-- inicio do sidebar da notificação-->
              <section>
                <div class="offcanvas off__canvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notificações <i id="bell__notification--ofcanvas" class="fad fa-bell bell__notification--ofcanvas"></i></h5>
                        <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                    </div>
                    <div class="offcanvas-body off__canvas--body">
        
                        <div class="body__notification" id="notification">
                            <div class="d-flex flex-row justify-content-between header__notification">
                                {{-- cabecalho da notificação o Rhweb é fixo só muda o tempo que a mensagem foi feita --}}
                                <div class="">
                                    <p class="content__header-notification">Rhweb <i id="notification__icon-no-read" class="fas fa-circle notification__icon-no-read"></i></p>
                                </div>
                                {{-- inicio da contagem do tempo que a mensagem foi postada --}}
                                <div class="">
                                    <p class="content__header-notification">1s</p>
                                </div>
                                {{-- fim da contagem do tempo que a mensagem foi postada --}}
                            </div>
                            {{-- fim do cabecalho --}}
        
                            {{-- inicio corpo da mensagem --}}
                            <div class="teste">
                                <p class="text__body--notification">O sistema será atualizado no dia 30/03/22 as </p>
                            </div>
                            {{-- fim do corpo da mensagem --}}
        
        
                            {{-- inicio da  exclusao da notificacao --}}
                            <div class="d-flex justify-content-end footer-notification">
                                <form action=""></form>
                                <div class="content__footer-notification">
                                    <a href="#"><i class="fas icone__footer-notification fa-trash"></i></a>
                                </div>
                            </div>
                            {{-- fim da exclusão da notificação --}}
                        </div>
        
        
                        {{-- inicio da contagem de mensagem nao lida --}}
                        <div class="no__read--message">
                            <p class="no__read--message--content">20 notificações não lidas</p>
                        </div>
                        {{-- fim da contagem da mensagem não lida --}}
        
        
                    </div>
                </div>
            </section>
            <!--fim da side bar da notificação-->
        </head>
        @yield('conteine')
</main>
<!-- <script src="{{url('/js/cadastroUsuarioLogin.js')}}"></script> -->
<!-- <script src="{{url('/js/inss.js')}}"></script> -->
<script src="{{url('/js/banco/index.js')}}"></script>
<script src="{{url('/js/irrf.js')}}"></script>

    <script src="{{url('/js/dashboard.js')}}"></script>
            <script src="{{url('/js/navbarAdmin.js')}}"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </body>
    </html>