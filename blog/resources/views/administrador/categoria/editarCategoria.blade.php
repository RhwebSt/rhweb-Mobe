<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Editar Categoria</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/admin/dashboard.css">
        <link rel="stylesheet" href="./css/admin/categoriaAutomatica/categoriaAutomatica.css">
        <link rel="stylesheet" href="./css/admin/tableAdmin.css">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <head>
            <nav class="navbar nav__bar">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img class="img__navbar" src="images/rhwebTop2.png" alt="logo da rhweb - possui duas setas com direções opostas" srcset=""></a>
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
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel1">Dashboard <i class="fad fa-tachometer-alt"></i></h5>
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
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Cadastro de Login</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Gerador de Acesso</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-chart-network"></i> Principais
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="#">INSS</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">IRRF</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Rúbricas</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">CBO</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Categoria do trabalhador</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle color-Link" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-text"></i> Textos Automáticos
                                    </a>
                                    <ul class="dropdown-menu dropDown__menu--list" aria-labelledby="offcanvasNavbarDropdown">
                                        <li><a class="dropdown-item dropdown__item--list" href="#">CBO</a></li>
                                        <li><a class="dropdown-item dropdown__item--list" href="#">Categoria do Trabalhador</a></li>
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
                            </ul>

                        </div>
                  </div>
                  {{-- fim da sidebar --}}
                </div>
              </nav>
        </head>

        <div class="container">

            

            {{-- Inicio botoes principais --}}
            <section class="section__botao--voltar--categoria">
                <div class="btn d-grid gap-1 mt-5 mx-auto d-md-block d-flex flex-wrap" role="group" aria-label="Basic example">
                    <a href="#" class="btn button__voltar--categoria"><i class="fad fa-long-arrow-left"></i> Voltar</a>
                    <button type="button" class="button__atualizar--categoria btn"><i class="fad fa-sync"></i> Atualizar</button>
                </div>
            </section>
            {{-- fim dos botoes principais --}}


            <section class="section__title--categoria">
                <div>
                    <h1 class="title__categoria">Cadastrar Categoria <i class="fad fa-comment-alt-plus"></i></h1>
                </div>
            </section>


            <section class="conteudo__categoria">

                <form class=" row g-3" action="">

                    <div class="d-flex justify-content-center flex-column align-items-center div__form--categoria">

                        <div class="mb-3 col-12 col-md-6">
                            <label for="codigo__categoria" class="form-label">Código</label>
                            <input type="text" class="form-control" id="codigo__categoria" name="codigo__categoria" placeholder="código" maxlength="5">
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="descricao__categoria" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="descricao__categoria" name="descricao__categoria" placeholder="descrição" maxlength="60">
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="texto1" class="form-label">Texto 1 - Recibo</label>
                            <input type="text" class="form-control" id="texto1" name="texto1" placeholder="Primeiro texto do recibo" maxlength="60">
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="texto2" class="form-label">Texto 2 - Recibo</label>
                            <input type="text" class="form-control" id="texto2" name="texto2" placeholder="Segundo texto do recibo" maxlength="60">
                        </div>

                    </div>

                </form>

            </section>







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
                                  <p class="text__body--notification">O sistema será atualizado no dia 30/03/22 as  </p>
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
        </div>
            
    </script>
    <script src="\js\dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>