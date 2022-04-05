<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Tabela INSS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/admin/dashboard.css">
        <link rel="stylesheet" href="./css/admin/irrf/irrf.css">
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
            {{-- inicio do botão novo --}}
            <section class="section__btn--new--irrf">
                <div class="">
                    <button type="button" class="button__new--irrf btn">Novo <i class="fad fa-user-plus"></i></button>
                </div>
            </section>
            {{-- final do botao novo --}}

            {{-- incio da pesquisa --}}
                <section class="search">
                    <form action="">
                        <div class="d-flex">
                            <div class="col-10 col-md-3 me-1">
                                <input class="form-control" id="inputPesquisar" type="search" placeholder="Pesquisar...">
                            </div>
                            <div>
                                <button type="button" id="pesquisar" class="button__search btn"><i class="fad fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </section>
            {{-- fim da pesquisa --}}

            {{-- inicio do filtro --}}
                <section>
                    <div class="d-flex justify-content-end">
                        <div>
                            <div class="dropdown">
                                <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-sort"></i>
                                </button>
                                <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                  <li><a class="dropdown-item dropdown__links--filter" href="#"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter" href="#"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
            {{-- fim do filtro --}}

            
            {{-- incicio da tabela --}}
            <section class="table">
                <div class="table-responsive-xxl">
                    <table class="table">
                        {{-- inicio da header da tabela --}}
                        <thead class="table__header">

                            <tr class="tr__header">
                                <th class="th__header text-nowrap" style="width:120px">Ano</th>
                                <th class="th__header text-nowrap" style="width:300px">Descrição</th>
                                <th class="th__header text-nowrap" style="width:80px">Editar</th>
                            </tr>

                        </thead>
                        {{-- final da heaader da tabela --}}

                        {{-- começo do body da tabela --}}
                        <tbody class="table__body">

                            <tr class="tr__body">
                                <td class="td__body text-nowrap col"  style="width:120px">2022</td>
                                <td class="td__body text-nowrap col"  style="width:600px" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliel" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">Tabela do IRRF</td>
                                
                                {{-- inicio do botao de editar --}}
                                <td class="td__body text-nowrap"  style="width:80px">

                                    <button class="btn button__editar"><i class="fad fa-pen"></i></button>

                                </td>
                                {{-- fim do botao de editar --}}
                            </tr>

                            {{--Inicio quando tiver nenhum cadastro --}}
                                <tr class="tr__body">
                                    <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                </tr>
                            {{--fim quando tiver nenhum cadastro --}}
     
                        </tbody>
                        {{-- final do body da tabela --}}



                        {{-- inicio do footer da tabela --}}
                        <tfoot>
                            <tr class="">
                                <td colspan="6" class="teste" style="border: none !important">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination__table pagination-sm">
                                          <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                              <span aria-hidden="true">&laquo;</span>
                                            </a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                                          <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                              <span aria-hidden="true">&raquo;</span>
                                            </a>
                                          </li>
                                        </ul>
                                      </nav>
                                </td>
                            </tr>
                        </tfoot>
                        {{-- fim do footer da tabela --}}
                    </table>
                </div>
            </section>
            {{-- fim da tabela --}}


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
    <script src="\js\irrf/irrf.js"></script>
    <script src="\js\dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>