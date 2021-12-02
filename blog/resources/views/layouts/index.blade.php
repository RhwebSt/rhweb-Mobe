<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="shortcut icon" href="{{url('/imagem/arrowMobe.png')}}" type="image/x-icon">
        <!-- <title>Cadastro Trabalhador</title> -->
        <title>@yield('titulo')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{url('/css/reset.css')}}">
		<link rel="stylesheet" href="{{url('/css/rhweb.css')}}">
        <link rel="stylesheet" href="{{url('/css/style.css')}}">
        <!--<link rel="stylesheet" href="{{url('/css/folhaPagamento.css')}}">-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
         <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script type="text/javascript" src="{{url('/js/jquery.mask.js')}}" ></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        

    </head>
    <style>
        form input[type="text"] {
            text-transform: uppercase !important;
            color:black !important;
            font-weight: bold !important;
        }
    </style>
    <body >
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark " style="background-image: linear-gradient(90deg, #366bdd, #0751f3, rgb(71, 42, 236)); ">
            <div class="container-fluid">
            <a class="" href="{{route('home.index')}}"><img class="navbar-brand" src="{{url('/imagem/rhwebTop2.png')}}" alt="" srcset="" style="width: 90px;"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse " id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white " href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                      Cadastro
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item border-secundary border-bottom " href="{{ route('tomador.index') }}">Tomador</a></li>
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('trabalhador.index')}}">Trabalhador</a></li>
                    
                      @can('admin')
                          <li><a class="dropdown-item border-bottom border-secundary" href="{{route('rublica.index')}}">Rúbricas</a></li>
                          <!-- <li><a class="dropdown-item border-bottom border-secundary" href="#">Serviços</a></li> -->
                          <li><a class="dropdown-item border-bottom border-secundary" href="{{route('inss.index')}}">INSS</a></li>
                          <li><a class="dropdown-item border-bottom border-secundary" href="{{route('irrf.index')}}">IRRF</a></li>
                          <!-- <li><a class="dropdown-item border-bottom border-secundary" href="#">Bancos</a></li> -->
                          
                          <li><a class="dropdown-item border-bottom border-secundary" href="{{route('user.create')}}">Cadastro de Acesso</a></li>
                          <li><a class="dropdown-item border-bottom border-secundary" href="{{route('listaempresa.create')}}">Cadastro de Usuário</a></li>
                      @endcan
                      <li><a class="dropdown-item " href="{{route('comisionado.index')}}">Comissionado</a></li>
                    </ul>
                  </li>
                </ul>

                  <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Recibos da Folha 
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                          <li><a class="dropdown-item border-bottom border-secundary" href="./HTML/Folha de pagamento/Serviços/Recibos da Folha/por tomador/Por-Tomador.php">Por Tomador</a></li>
                          <li><a class="dropdown-item  " href="./HTML/Folha de pagamento/Serviços/Recibos da Folha/Geral/Geral.php">Geral</a></li>
                        </ul>
                      </li>
                    </ul>


                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 Rotina Mensal
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink" >
                              <li><a class="dropdown-item border-bottom border-secundary" href="{{route('cadastrocartaoponto.index')}}">Boletim Cartão Ponto</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="{{route('tabcartaoponto.index')}}">Boletim com Tabela</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Boletim Extra</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Descontos</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Calcular Folha</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Planilha de Fechamento- Boletins</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol dos Boletins</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Extrato Cartão Ponto por Trabalhador</a></li>
                              <li><a class="dropdown-item border-secundary" href="#">Recibos da Folha</a></li>
                             
                            </ul>
                          </li>
                        </ul>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Faturas
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                              <li><a class="dropdown-item border-bottom border-secundary" href="{{ url('fatura') }}">Recibos</a></li>
                              <li><a class="dropdown-item " href="#">Rol dos recibos</a></li>
                            </ul>
                          </li>
                        </ul>


                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Recibo Avulsos
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                              <li><a class="dropdown-item border-bottom border-secundary" href="{{ url('comprovantepagamento') }}">Recibos</a></li>
                              <li><a class="dropdown-item " href="{{ url('comprovantepagamentodiaria') }}">Rol dos recibos</a></li>
                            </ul>
                          </li>
                        </ul>

                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Relatórios
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                               
                                
                                
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol dos Boletin</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Boletins do Trabalhador</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Trabalhador no Boletim</a></li>
                                
                                <li><a class="dropdown-item border-secundary"  href="{{ url('trabalhadorolnome') }}">Rol Trabalhadores - Ordem Nome</a></li>

                                
                              </ul>
                            </li>
                          </ul>
      

                  <div class="dbg-primary-flex align-items-end bguser "> 
                    <div class="flex-shrink-0 dropdown flex-row-reverse">
                      @if($user->name)
                      <a href="#" class="link-dark text-decoration-none dropdown-toggle text-white"  id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-md"></i> {{$user->name}}
                      </a>
                      @else
                      <a href="#" class="link-dark text-decoration-none dropdown-toggle text-white"  id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-md"></i> MOBE
                      </a>
                      @endif
                     
                      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item border-bottom border-secundary" href="{{route('listaempresa.create')}}">Meus da dados</a></li>
                        <li><a class="dropdown-item" href="{{route('logout.create')}}">Sair</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                

              </ul>
            </div>
          </div>
            <div class="">
                <button class="botao__dark" id = "flexSwitchCheckDefault"><i class="fas fa-adjust"></i></button>
            </div>
            
        </div>
        </div>
    </nav>
</main>

   @yield('conteine')

    <footer class="mt-5 footer d-none" style="background-image: linear-gradient(75deg, #03256C, #0751f3, rgb(33, 5, 197)); color: #ffff;">
        <p class="text-center p-4">&copy; Copyright RHWeb Sistemas Inteligentes - 2021</p>
    </footer>
    <script src="{{url('/js/darkmode.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="{{url('/js/masck.js')}}"></script>
    
    
    <script type="text/javascript" src="{{url('/js/cep.js')}}" ></script>
    <script type="text/javascript" src="{{url('/js/pdf.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/banco.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/validation.js')}}"></script>
   
  </body>
</html>
