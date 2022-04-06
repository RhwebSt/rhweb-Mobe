<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <!-- <title>Cadastro Trabalhador</title> -->
        <title>@yield('titulo')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{url('/css/reset.css')}}">
        <link href="{{url('/css/alteracaoSenha.css')}}" rel="stylesheet" />
        <link href="{{url('/css/alteracaoFoto.css')}}" rel="stylesheet" />
        <link href="{{url('/css/notificacaoUser.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="{{url('/css/rhweb.css')}}">
		<link rel="stylesheet" href="{{url('/css/feedback.css')}}">
        <!--<link rel="stylesheet" href="{{url('/css/style.css')}}">-->
        <!--<link rel="stylesheet" href="{{url('/css/folhaPagamento.css')}}">-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&display=swap" rel="stylesheet">
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
         <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script type="text/javascript" src="{{url('/js/jquery.mask.js')}}" ></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.6/dist/sweetalert2.all.min.js"></script>
        
    </head>
    

    <body  class="body-content">
        
        
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
    
    
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark mb-5" style="background-image: linear-gradient(90deg, #366bdd, #0751f3, rgb(71, 42, 236)); ">
            <div class="container-fluid">
            <a class="" href="{{route('home.index')}}"><img class="navbar-brand" src="{{url('/imagem/rhwebTop2.png')}}" alt="" srcset="" style="width: 90px;"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse " id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fonttop " href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                      Cadastro
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item border-secundary " href="{{ route('tomador.index') }}">Tomador</a></li>
                      <li><a class="dropdown-item border-secundary" href="{{route('trabalhador.index')}}">Trabalhador</a></li>
                    
                      @can('admin')
                          <!-- <li><a class="dropdown-item border-secundary" href="">Rúbricas</a></li> -->
                          <!-- <li><a class="dropdown-item border-bottom border-secundary" href="#">Serviços</a></li> -->
                          <!-- <li><a class="dropdown-item border-secundary" href="">INSS</a></li> -->
                          <!-- <li><a class="dropdown-item border-secundary" href="">IRRF</a></li> -->
                          <!-- <li><a class="dropdown-item border-bottom border-secundary" href="#">Bancos</a></li> -->
                          
                          <li><a class="dropdown-item border-secundary" href="{{route('usuario.create')}}">Cadastro de Acesso</a></li>
                          <li><a class="dropdown-item border-secundary" href="{{route('listaempresa.create')}}">Cadastro de Usuário</a></li>
                      @endcan
                      <li><a class="dropdown-item " href="{{route('comisionado.index')}}">Comissionado</a></li>
                    </ul>
                  </li>
                </ul>



                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fonttop" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Rotina Mensal
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink" >
                              <li><a class="dropdown-item border-secundary" href="{{route('cadastrocartaoponto.index')}}">Boletim Cartão Ponto</a></li>
                              <li><a class="dropdown-item border-secundary" href="{{route('tabcartaoponto.index')}}">Boletim com Tabela</a></li>
                              <li><a class="dropdown-item border-secundary " href="{{route('calculo.folha.index')}}">Cálculo da Folha</a></li>
                              <li><a class="dropdown-item border-secundary d-none" href="#">Boletim Extra</a></li>
                              <li><a class="dropdown-item border-secundary" href="{{route('descontos.index')}}">Descontos</a></li>
                              <li><a class="dropdown-item border-secundary d-none" href="#">Planilha de Fechamento- Boletins</a></li>
                              <li><a class="dropdown-item border-secundary d-none" href="#">Rol dos Boletins</a></li>
                              <li><a class="dropdown-item border-secundary d-none" href="#">Extrato Cartão Ponto por Trabalhador</a></li>
                              <li><a class="dropdown-item border-secundary d-none" href="#">Recibos da Folha</a></li>
                             
                            </ul>
                          </li>
                        </ul>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="{{ url('fatura') }}">Fatura</a>
                                </li>
                            </ul>


                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a class="nav-link text-white" href="{{route('avuso.index')}}">Recibo Avulso</a>
                            </li>
                        </ul>

                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white fonttop" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Relatórios
                              </a>
                              <ul class="dropdown-menu " aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item border-secundary"  href="{{ url('trabalhadorolnome') }}">Rol Trabalhadores - Ordem Nome</a></li>
                                <li><a class="dropdown-item border-secundary"  href="{{route('relatorio.geral.tomador')}}">Rol Tomadores - Ordem Nome</a></li>
                              </ul>
                            </li>
                          </ul>
      

                  <div class="userwidth"> 
                    <div class="flex-shrink-0 dropdown flex-row-reverse fonttop">
                      @if($user->name)
                      <a href="#" class="link-dark text-decoration-none dropdown-toggle text-white"  id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fad fa-user-circle fa-lg"></i> {{$user->name}}
                      </a> 
                      @else
                      <a href="#" class="link-dark text-decoration-none dropdown-toggle text-white"  id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-md"></i> MOBE
                      </a>
                      @endif
                     
                      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                      @can('admin')
                        <li><a class="dropdown-item border-bottom border-secundary" href="{{route('empresa.perfil.index')}}">Dados Empresa</a></li>
                        <li><a class="dropdown-item border-bottom border-secundary" href="{{route('altera.index')}}">Alterar Senha</a></li>
                        <li><a class="dropdown-item border-bottom border-secundary" href="{{route('foto.index')}}">Atualizar os dados Empresa</a></li>
                        <li><a class="dropdown-item border-bottom border-secundary" href="{{route('perfil.edit',$user->id)}}">Dados Pessoais</a></li>
                      @endcan
                        <li><a class="dropdown-item" href="{{route('logout')}}" onclick="bemvindo()">Sair</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                

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
            <div>
                <button type="button" id="buttonNotification" class="btn position-relative button__notification--with--message" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i id="bell__notification" class="fad fa-bell bell__notification"></i>
                    <span id="valueNotification" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      {{$quantidade}} 
                    </span>
                </button>
            </div>
          
            <div class="ms-3">
                <button class="botao__dark" id = "flexSwitchCheckDefault"><i class="fas fa-adjust iconbtn"></i></button>
            </div>
            
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

    
    </main>
    
        
    
        
        <!--<div class="d-flex align-items-center">-->
        <!--    <div class="fixed-bottom mb-5 ms-5 align-items-end ms-auto">-->
        <!--      <button type="submit" class="btn btn-success"><i class="fas fa-comment-dots"></i></button>-->
        <!--    </div>-->
        <!--</div>-->
    
    <footer>
        <p class="text-nowrap">&copy; Copyright RHWeb Sistemas Inteligentes - 2021</p>
    </footer>
    <script src="{{url('/js/alteracaoSenha.js')}}"></script>
    <script src="{{url('/js/darkmode.js')}}"></script>
    <script src="{{url('/js/notificacaoUser.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="{{url('/js/masck.js')}}"></script>
    <!--<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>-->
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