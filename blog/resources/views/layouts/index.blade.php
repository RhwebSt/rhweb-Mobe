<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <title>@yield('titulo')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{url('/css/reset.css')}}">
        <link rel="stylesheet" href="{{url('/css/rhweb.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/navbar.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/footer.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/offCanvas.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/modal.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/search.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/botoesPadrao.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/notificacaoUser.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/table.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/componentes/accordion.css')}}">
        <link href="{{url('/css/alteracaoSenha.css')}}" rel="stylesheet" />
        <link href="{{url('/css/alteracaoFoto.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{url('/css/usuario/trabalhador/trabalhador.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/trabalhador/epi/epi.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/tomador/tomador.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/cadastroAcesso/cadastroAcesso.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/comissionado/comissionado.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/cartaoPonto/cartaoPonto.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/boletimTabela/boletimTabela.css')}}">
        <link rel="stylesheet" href="{{url('/css/usuario/calculoFolha/calculoFolha.css')}}">
		<link rel="stylesheet" href="{{url('/css/feedback.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
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
        
    </head>
    

    <body class="body-content">
        
        
        <script>
          
            if (!localStorage.getItem('bemvindo')) {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                    background: '#F2F6F8' ,
                    showConfirmButton: false,
                    padding: 25,
                    timer: 4000,
                    width: 500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  
                  Toast.fire({
                    html:'<p style="color:black;"><i class="fas fa-xl fa-user-circle" style="color: black;"></i>  Seja bem vindo {{$user->name}}.</p>',
                  })
            }
            localStorage.setItem('bemvindo',1)
            function bemvindo() {
              localStorage.removeItem('bemvindo')
            }
        </script>   
            
            
        <div class="d-flex flex-column justify-content-center align-items-center d-none" style="position: fixed; height:100%;width:100%;background-color:rgba(243, 243, 253, 0.8);z-index:1;" id="carregamento" class="">
            <div class="text-center " >
              <img class="imagem" src="{{url('/imagem/carregamento.png')}}" alt="" srcset="">
            </div>
        </div>
        
        
        <header>
            <nav class="navbar navbar-expand-lg nav__bar mb-5">
                <div class="container-fluid">
                    
                    <a class="logo__clickavel" href="{{route('home.index')}}"><img class="navbar-brand" src="{{url('/imagem/rhwebTop2.png')}}" alt="" srcset="" style="width: 90px;"></a>
                    
                    <button class="navbar-toggler navb__burger--button" type="button" data-bs-toggle="collapse" data-bs-target="#burgerButton" aria-controls="burgerButton" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="icon__color fad fa-bars"></i>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="burgerButton">
                        
                        <ul class="navbar-nav">
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fonttop" href="#" id="cadastro" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                  Cadastro
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="cadastro">
                                    <li><a class="dropdown-item " href="{{ route('tomador.index') }}">Tomador</a></li>
                                    <li><a class="dropdown-item" href="{{route('trabalhador.index')}}">Trabalhador</a></li>
                                    
                                    @can('admin')
                                    <li><a class="dropdown-item" href="{{route('usuario.create')}}">Cadastro de Acesso</a></li>
                                    <li><a class="dropdown-item d-none" href="{{route('listaempresa.create')}}">Cadastro de Usuário</a></li>
                                    @endcan
                                    <li><a class="dropdown-item " href="{{route('comisionado.index')}}">Comissionado</a></li>
                                    
                                </ul>
                            </li>
    
    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fonttop" href="#" id="rotinaMensal" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     Rotina Mensal
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="rotinaMensal">
                                    
                                    <li><a class="dropdown-item" href="{{route('cadastrocartaoponto.index')}}">Boletim Cartão Ponto</a></li>
                                    <li><a class="dropdown-item" href="{{route('tabcartaoponto.index')}}">Boletim com Tabela</a></li>
                                    <li><a class="dropdown-item " href="{{route('calculo.folha.index')}}">Cálculo da Folha</a></li>
                                    <li><a class="dropdown-item d-none" href="#">Boletim Extra</a></li>
                                    <li><a class="dropdown-item" href="{{route('descontos.index')}}">Descontos</a></li>
                                    <li><a class="dropdown-item d-none" href="#">Planilha de Fechamento- Boletins</a></li>
                                    <li><a class="dropdown-item d-none" href="#">Rol dos Boletins</a></li>
                                    <li><a class="dropdown-item d-none" href="#">Extrato Cartão Ponto por Trabalhador</a></li>
                                    <li><a class="dropdown-item d-none" href="#">Recibos da Folha</a></li>
                                 
                                </ul>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('fatura') }}">Fatura</a>
                            </li>
    
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('avuso.index')}}">Recibo Avulso</a>
                            </li>
    
    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fonttop" href="#" id="relatorios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Relatórios
                                </a>
                                
                                <ul class="dropdown-menu" aria-labelledby="relatorios">
                                    <li><a class="dropdown-item"  href="{{ url('trabalhadorolnome') }}">Rol Trabalhadores - Ordem Nome</a></li>
                                    <li><a class="dropdown-item"  href="{{route('relatorio.geral.tomador')}}">Rol Tomadores - Ordem Nome</a></li>
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
                                    <li><a class="dropdown-item" href="{{route('empresa.perfil.index')}}">Dados Empresa</a></li>
                                    <li><a class="dropdown-item" href="{{route('altera.index')}}">Alterar Senha</a></li>
                                    <li><a class="dropdown-item" href="{{route('foto.index')}}">Atualizar os dados Empresa</a></li>
                                    <li><a class="dropdown-item" href="#">Atalhos</a></li>
                                    <li><a class="dropdown-item" href="{{route('perfil.edit',$user->id)}}">Dados Pessoais</a></li>
                                 @endcan
                                    <li><a class="dropdown-item" href="{{route('logout')}}" onclick="bemvindo()">Sair</a></li>
                                </ul>
                            </li>
     
                        </ul>
                    </div>
                </div>
                
                <?php
                  $quantidade = 0;
                  $naolida = 0;
                  if (isset($esocialtrabalhador) && count($esocialtrabalhador) > 0) {
                    $quantidade += 1;
                    $naolida = count($esocialtrabalhador);
                  }
                ?>
                
                <div class="d-flex justify-content-end flex-row">
                    <div class="ms-1">
                        <button type="button" id="buttonNotification" class="btn position-relative button__notification--with--message" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <i id="bell__notification" class="fad fa-bell bell__notification"></i>
                            <span id="valueNotification" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                              {{$quantidade}} 
                            </span>
                        </button>
                    </div>
    
    
                    <div class="ms-2 me-2">
                        <button class="botao__dark" id = "flexSwitchCheckDefault"><i class="fas fa-adjust iconbtn"></i></button>
                    </div>
                </div>
                
            </nav>
        
            <section>
                <div class="offcanvas off__canvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notificações <i id="bell__notification--ofcanvas" class="fad fa-bell bell__notification--ofcanvas"></i></h5>
                        <i class="fas fa-2x fa-times icon__exit--side--bar" data-bs-dismiss="offcanvas"></i>
                    </div>
                    <div class="offcanvas-body off__canvas--body">
                        @if(isset($esocialtrabalhador) && count($esocialtrabalhador) > 0)
                          @foreach($esocialtrabalhador as $esocialtrabalhadores)
                            <div class="body__notification" id="notification">
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
    
        <footer>
            <p class="text-nowrap">&copy;Copyright RHWEB Sistemas Inteligentes - 2021</p>
        </footer>
        
        <script src="{{url('/js/alteracaoSenha.js')}}"></script>
        <script src="{{url('/js/darkmode.js')}}"></script>
        <script src="{{url('/js/notificacaoUser.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
        <script src="{{url('/js/masck.js')}}"></script>
        <script src="{{url('/js/ferramentas/limpaCampos.js')}}"></script>
        <script src="{{url('/js/ferramentas/validaInput.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/cep.js')}}" ></script>
        <script type="text/javascript" src="{{url('/js/pdf.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/banco.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/paisnascimento.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/categoriatrabalhador.js')}}"></script>
        <script type="text/javascript" src="{{url('/js/criptografa.js')}}"></script>
        <!-- <script type="text/javascript" src="{{url('/js/validation.js')}}"></script> -->
        <script src="{{url('/js/esocial/index.js')}}">
        </script>
        <script src="{{url('/js/tabelapreco/atualizar.js')}}">
        </script>
   
  </body>
</html>