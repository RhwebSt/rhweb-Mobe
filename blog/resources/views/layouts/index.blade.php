<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <title>@yield('titulo')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>
        <link rel="stylesheet" href="{{url('/css/reset.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/animacoes/animacaoSlides.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/configPrincipais.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/configuracoes/configuracoes.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/navbar.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/footer.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/offCanvas.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/modal.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/search.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/botoesPadrao.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/notificacaoUser.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/table.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/accordion.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/modalCamera.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/home/home.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/trabalhador/trabalhador.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/trabalhador/epi/epi.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/tomador/tomador.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/cadastroAcesso/cadastroAcesso.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/comissionado/comissionado.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/cartaoPonto/cartaoPonto.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/boletimTabela/boletimTabela.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/calculoFolha/calculoFolha.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/descontos/descontos.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/reciboAvulso/reciboAvulso.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/usuario/alteraSenha.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/usuario/atualizarEmpresa.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/usuario/atalhos.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/usuario/contador.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/usuario/dadosPessoais.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/fatura/fatura.css')}}">
		<link rel="stylesheet" href="{{url('/css/usuario/feedback/feedback.css')}}">
		<link rel="stylesheet" href="{{url('/css/usuario/esocial/esocial.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script type="text/javascript" src="{{url('/js/jquery.mask.js')}}" ></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vivus@0.4.6/dist/vivus.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

    </head>
    

    <body class="body-content d-none">
        
        
        <script>
          window.Laravel = {!! json_encode([
              'tabelapreco'=>[
                  'condicao'=>isset($atualizar) && $atualizar ?$atualizar:false,
                  'url'=>route('tabela.preco.atualizar')
            ],
            'empresa'=>[
                'id'=>$user->empresa_id,
                'cnpj'=>str_replace(array(".", ",", "-", "/"), "",$empresa->escnpj),
                'pesquisa'=>url('empresa/pesquisa'),
                'lista'=>url('empresa/lista')
            ],
            'csrf'=>csrf_token(),
            'esocial'=>[
                'update'=>route('esocial.trabalhador.update'),
                'show'=>route('esocial.trabalhador.lista'),
                'trabalhador'=>route('esocial.trabalhador'),
                'tomador'=>route('esocial.tomador'),
                'folhar'=>route('gera.evento.1200')
            ],
            'trabalhador'=>[
                'lista'=>route('trabalhador.lista'),
                'pesquisa'=>route('trabalhador.pesquisa'),
                
            ],
            'tomador'=>[
                'lista'=>route('tomador.lista'),
                'boletim'=>route('boletim.tomador'),
                'pesquisa'=>route('tomador.pesquisa'),
            ],
            'tabelapreco'=>[
                'lista'=>route('tabelapreco.lista',isset($tomador)?$tomador:' '),
                'verificar'=>url('verifica/tabela/preco'),
                'pesquisa'=>url('tabelapreco/pesquisa')
            ],
            'folhar'=>[
                'geral'=>route('calculo.folha.geral.filtro'),
                'tomador'=>route('calculo.folha.tomador.filtro')
            ],
            'boletimtabela'=>[
                'lista'=>route('tabela.cartao.ponto.lista'),
                'lancamento'=>[
                    'lista'=>route('boletim.tabela.lista',isset($id)?$id:' ')
                ]
            ],
            'boletimcartaoponto'=>[
                'lista'=>route('cartao.ponto.lista'),
                'lancamento'=>[
                    'diurno'=>route('boletim.cartao.ponto.lista.diurno',isset($id)?$id:' '),
                    'noturno'=>route('boletim.cartao.ponto.lista.noturno',isset($id)?$id:' ')
                ],
                'pesquisa'=>url('tabela/cartao/ponto/pesquisa'),
                'store'=>route('boletimcartaoponto.store'),
                'trabalhador'=>url('boletim/cartao/ponto'),
                'data'=>isset($data)?$data:' ',
                'feriado'=>isset($feriado)?$feriado:' '
            ],
            'desconto'=>[
                'lista'=>route('desconto.lista'),
                'relatorio'=>route('descontos.relatorio.index')
            ],
            'fatura'=>[
                'lista'=>route('fatura.lista')
            ],
            'avuso'=>[
                'lista'=>route('avuso.lista'),
                'pesquisa'=>url('avuso/pesquisa')
            ],
            'comissionado'=>[
                'lista'=>route('comisionado.lista') 
            ],
            'user'=>[
                'pesquisa'=>route('usuario.pesquisa.admin')
            ],
           
            'certificado'=>[
                'cadastro'=>route('certificado.cadastro'),
                'verifica'=>route('certificado.index'),
                'deletar'=>url('certificado/deletar'),
                'situacao'=>url('certificado/situacao')
            ],
            'administrador'=>[
                'cbo'=>route('administrador.cbo.pesquisa'),
                'categoria'=>route('administrador.categoria.pesquisa')
            ]
          ]) !!}
            // if (!localStorage.getItem('bemvindo')) {
            //   const Toast = Swal.mixin({
            //     toast: true,
            //     position: 'top-end',
            //         background: '#F2F6F8' ,
            //         showConfirmButton: false,
            //         padding: 25,
            //         timer: 4000,
            //         width: 500,
            //         timerProgressBar: true,
            //         didOpen: (toast) => {
            //           toast.addEventListener('mouseenter', Swal.stopTimer)
            //           toast.addEventListener('mouseleave', Swal.resumeTimer)
            //         }
            //       })
                  
            //       Toast.fire({
            //         html:'<p style="color:black;"><i class="fas fa-xl fa-user-circle" style="color: black;"></i>  Seja bem vindo {{$user->name}}.</p>',
            //       })
            // }
            // localStorage.setItem('bemvindo',1)
            // function bemvindo() {
            //   localStorage.removeItem('bemvindo')
            // }
        </script>   
            
            
        <div class="d-flex flex-column justify-content-center align-items-center d-none" style="position: fixed; height:100%;width:100%;background-color:rgba(243, 243, 253, 0.8);z-index:1;" id="carregamento" class="">
            <div class="text-center " >
              <img class="imagem" src="{{url('/imagem/carregamento.png')}}" alt="" srcset="">
            </div>
        </div>
        
        <div class="d-flex flex-column justify-content-center align-items-center d-none" style="position: fixed; height:100%;width:100%;background-color:rgba(243, 243, 253, 0.9);z-index:1;" id="desconectado" class="">
            <div class="text-center">
              <h1 class="text-black fs-1 fw-bold">Sem conexão <i class="fad fa-lg fa-wifi-slash"></i></h1>
            </div>
        </div>
        
        
        <header>
            <nav class="navbar navbar-expand-lg nav__bar mb-5">
                <div class="container-fluid">
                    
                    <a class="logo__clickavel" href="{{route('home.index')}}"><img class="navbar-brand" src="{{url('/imagem/NewLogoBrancaRh.png')}}" alt="" srcset="" style="width: 90px;"></a>
                    
                    
                    
                    <div class="collapse navbar-collapse" id="burgerButton">
                        
                        <ul class="navbar-nav">
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fonttop" href="#" id="cadastro" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                  Cadastro
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="cadastro"> 
                                    @can('admin')
                                    <li><a class="dropdown-item" href="{{route('usuario.create')}}"><i class="fad fa-user-plus"></i> Cadastro de Acesso</a></li>
                                    @endcan
                                    <li><a class="dropdown-item " href="{{route('comisionado.index')}}"><i class="fad fa-percentage"></i> Comissionado</a></li>
                                    <li><a class="dropdown-item " href="{{ route('tomador.novo') }}"><i class="fad fa-industry"></i> Tomador</a></li>
                                    <li><a class="dropdown-item" href="{{route('trabalhador.novo')}}"><i class="fad fa-user-hard-hat"></i> Trabalhador</a></li>
                                </ul>
                            </li>
    
    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fonttop" href="#" id="rotinaMensal" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     Rotina Mensal
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="rotinaMensal">
                                    
                                    <li><a class="dropdown-item" href="{{route('cartao.ponto.novo')}}"><i class="fad fa-alarm-clock"></i> Boletim Cartão Ponto</a></li>
                                    <li><a class="dropdown-item" href="{{route('tabela.cartao.ponto.novo')}}"><i class="fad fa-sack-dollar"></i> Boletim com Tabela</a></li>
                                    <li><a class="dropdown-item " href="{{route('calculo.folha.index')}}"><i class="fad fa-calculator-alt"></i> Cálculo da Folha</a></li>
                                    <li><a class="dropdown-item" href="{{route('descontos.index')}}"><i class="fad fa-tags"></i> Descontos</a></li>

                                </ul>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('fatura') }}">Fatura</a>
                            </li>
    
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('avuso.index')}}">Recibo Avulso</a>
                            </li>
                            
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('esocial.index')}}">E-social</a>
                            </li>
    
    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fonttop" href="#" id="relatorios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Relatórios
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="relatorios">
                                    <li><a class="dropdown-item"  href="{{route('relatorio.geral.tomador')}}"><i class="fad fa-file-alt"></i> Rol Tomadores - Ordem Alfabética</a></li>
                                    <li><a class="dropdown-item"  href="{{ url('trabalhadorolnome') }}"><i class="fad fa-file-alt"></i> Rol Trabalhadores - Ordem Alfabética</a></li>
                                </ul>
                            </li>
    
                              
                            <li class="nav-item dropdown">
                                @if($user->name)
                                    <a class="nav-link dropdown-toggle fonttop" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-user-circle fa-lg"></i> {{$user->name}}
                                    </a>
                                @else
                                    <a class="nav-link dropdown-toggle fonttop" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-user-circle fa-lg"></i> {{$user->name}}
                                    </a>
                                @endif
                                
                                <ul class="dropdown-menu " aria-labelledby="navbarDarkDropdownMenuLink">
                                @can('admin')
                                    <li><a class="dropdown-item" href="{{route('altera.index')}}"><i class="fad fa-key"></i> Alterar Senha</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#atalhos"><i class="fad fa-external-link-square"></i> Atalhos</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#contador"><i class="fad fa-abacus"></i> Contador</a></li>
                                    <li><a class="dropdown-item" href="{{route('empresa.perfil.edit',$user->empresa_id)}}"><i class="fad fa-landmark"></i> Dados da Empresa</a></li>
                                    
                                 @endcan
                                 @if(auth()->user()->can('admin'))
                                    <li><a class="dropdown-item" href="{{route('perfil.edit',$user->id)}}"><i class="fad fa-user"></i> Dados Pessoais</a></li>
                                 @else
                                 <li><a class="dropdown-item" href="{{route('dados.editar',$user->id)}}"><i class="fad fa-user"></i> Dados Pessoais</a></li>
                                 @endif
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#configuracoes"><i class="fad fa-cogs"></i> Configurações</a></li>
                                    <li><a class="dropdown-item" href="{{route('logout')}}" onclick="bemvindo()"><i class="fad fa-sign-out"></i> Sair</a></li>
                                </ul>
                            </li>
     
                        </ul>
                    </div>
                
                
                    <?php
                      $quantidade = 0;
                      $naolida = 0;
                      if (isset($esocialtrabalhador) && count($esocialtrabalhador) > 0) {
                        $quantidade += 1;
                        $naolida = count($esocialtrabalhador);
                      }
                    ?>
                    
                    <div class="d-flex justify-content-end flex-row div__botoes--nav">
                        <div class="ms-1">
                           <button type="button" id="buttonNotification" class="btn position-relative button__notification--with--message" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                               <i id="bell__notification" class="fad fa-bell bell__notification"></i>
                               <span id="valueNotification" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                 
                               </span>
                           </button>
                        </div>
        
        
                        <!--<div class="ms-2 me-2">-->
                        <!--    <button class="botao__dark btn" id = "flexSwitchCheckDefault"><i id="iconDarkMode" class="fad fa-moon fa-lg iconbtn"></i></button>-->
                        <!--</div>-->
                        
                        <button class="ms-2 navbar-toggler navb__burger--button btn" type="button" data-bs-toggle="collapse" data-bs-target="#burgerButton" aria-controls="burgerButton" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="icon__color fad fa-bars"></i>
                        </button>
                        
                    </div>
                </div>
                
            </nav>
        
            <section>
                <div class="offcanvas off__canvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notificações <i id="bell__notification--ofcanvas" class="fad fa-bell bell__notification--ofcanvas"></i></h5>
                        <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                    </div>
                    <div class="offcanvas-body off__canvas--body " id="notificacaocontaine">
                        @if(isset($esocialtrabalhador) && count($esocialtrabalhador) > 0)
                          @foreach($esocialtrabalhador as $esocialtrabalhadores)
                            <div class="body__notification d-none" id="notification">
                                <div class="d-flex flex-row justify-content-between header__notification">
                                    {{-- cabecalho da notificação o Rhweb é fixo só muda o tempo que a mensagem foi feita --}}
                                    <div class="">
                                        <p class="content__header-notification">Rhweb <i id="notification__icon-no-read" class="fas fa-circle notification__icon-no-read"></i></p>
                                    </div>
                                    {{-- inicio da contagem do tempo que a mensagem foi postada --}}
                                    <div class="">
                                        <p class="content__header-notification">
                                          <?php
                                            $data = explode(' ',$esocialtrabalhadores->created_at)
                                          ?>
                                          {{date("d/m/Y",strtotime($data[0]))}}
                                        </p>
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
                          @endforeach
                        @endif
        
                        
                        {{-- inicio da contagem de mensagem nao lida --}}
                        <div class="no__read--message">
                            <p class="no__read--message--content">{{$naolida}} notificações não lidas</p>
                        </div>
                        {{-- fim da contagem da mensagem não lida --}}
        
                    
                    </div>
                </div>
            </section>
    
       @yield('conteine')
    
        </header>
        
        @include('usuarios.dadosAnaliticos.contador.listaContador')
        @include('usuarios.atalhos.atalhos')
        @include('configuracoes.modalConfig')
        @include('configuracoes.modalCertificado')
    
        <footer class="footer">
            <p class="">&copy;Copyright Rhweb Sistemas Inteligentes - 2022 - Versão 1.0.0</p>
        </footer>
       
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
        <script src="{{url('/js/animacoes/animacaoPrincipal.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/configuracoes/configuracoes.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/configuracoes/modalCertificado.js')}}"></script>
        <script src="{{url('/js/ferramentas/reabreModal.js')}}"></script>
        <script src="{{url('/js/ferramentas/darkmode.js')}}"></script>
        <script src="{{url('/js/tabela/index.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/trabalhador/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/trabalhador/depedente/create.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/tomador/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/cadastroAcesso/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/cadastroAcesso/modalPermissao.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/cadastroAcesso/index.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/calculoFolha/tabela.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/tomador/tabelaPreco/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/tomador/tabelaPreco/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/boletimCartaoPonto/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/boletimCartaoPonto/cartaoPonto/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/boletimTabela/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/boletimTabela/lancamentoTabelaPreco/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/fatura/index.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/fatura/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/comissionado/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/descontos/index.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/descontos/lista.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/reciboAvulso/index.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/user/reciboAvulso/lista.js')}}"></script>
        <!--<script src="{{url('/js/user/usuario/notificacaoUser.js')}}"></script>-->
        <script src="{{url('/js/ferramentas/masck.js')}}"></script>
        <script src="{{url('/js/ferramentas/limpaCampos.js')}}"></script>
        <!--<script src="{{url('/js/ferramentas/validaInput.js')}}"></script>-->
        <script type="text/javascript" src="{{url('/js/ferramentas/cep.js')}}" ></script>
        <script type="text/javascript" src="{{url('/js/ferramentas/pdf.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/ferramentas/banco.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/ferramentas/paisnascimento.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/ferramentas/categoriatrabalhador.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/ferramentas/criptografa.js')}}"></script>
        <!--<script src="{{url('js/particlesjs.js')}}"></script>-->
        <!--<script src="{{url('js/appParticles.js')}}"></script>-->
        <!-- <script type="text/javascript" src="{{url('/js/validation.js')}}"></script> -->
        <script src="{{url('/js/user/tabelapreco/atualizar.js')}}"></script>

        <script>
        
            window.onload = function () {
                $("body").removeClass('d-none');
                
                var resultado = JSON.parse(localStorage.getItem("configUser"));
                resultAnim = resultado.animacoes.resultAnimacoes;
                
                if(localStorage.getItem("configUser") === null){  
                    $('main').addClass('main__Animation');
                }
                
                if(resultAnim === "true"){
                    $('main').addClass('main__Animation');
                }
                
                if(resultAnim === "false"){
                    $('main').removeClass('main__Animation');
                }
            } 
        
            $('.teste').mouseover(function(){
                $('.teste').addClass('dropdown-menuAnimate');
                $('.teste').addClass('testeActive');
            })
        
        
            setInterval(function(){
                var online = navigator.onLine;
                if(online == false){
                    $('#desconectado').removeClass('d-none');
                }else{
                    $('#desconectado').addClass('d-none');
                }
            },1000);
            
        </script>
        
        

   
  </body>
</html>