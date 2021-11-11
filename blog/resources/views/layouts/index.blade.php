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
        <link rel="stylesheet" href="../../../../../reset.css">
		<link rel="stylesheet" href="../../../../../Mobe-style.css">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
            rel="stylesheet">
         <link rel="stylesheet" href="./cadastroTrabalhador.css">
         <!-- <link rel="stylesheet" href="{{url('/css/folhaPagamento.css')}}"> -->
         <link rel="stylesheet" href="../../../../../CSS/Rodapé/Rodapé.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
        <script type="text/javascript" src="{{url('/js/jquery.mask.js')}}" ></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
        <script src="http://jqueryvalidation.org/files/dist
/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        

    </head>
    <style>
        form input[type="text"] {
    text-transform: uppercase !important;
}
    </style>
    <body >
    <main >
        <nav class="navbar navbar-expand-lg navbar-dark " style="background-image: linear-gradient(90deg, #366bdd, #0751f3, rgb(71, 42, 236)); ">
            <div class="container-fluid">
              <!-- <a class="navbar-brand" href=""></a> -->
              <img class="navbar-brand" src="{{url('/imagem/rhwebTop.png')}}" alt="" srcset="" style="width: 90px">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse " id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                      Cadastro
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-image: linear-gradient(100deg, #ffffff, #fdfdfd, #f5f5fa);">
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{ route('tomador.index') }}">Tomador</a></li>
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('trabalhador.index')}}">Trabalhador</a></li>
                      <?php
                        $permissao = [
                          'admin'
                        ]
                      ?>
                      @if(in_array($user->cargo,$permissao))
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('rublica.index')}}">Rúbricas</a></li>
                      <!-- <li><a class="dropdown-item border-bottom border-secundary" href="#">Serviços</a></li> -->
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('inss.index')}}">INSS</a></li>
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('irrf.index')}}">IRRF</a></li>
                      <!-- <li><a class="dropdown-item border-bottom border-secundary" href="#">Bancos</a></li> -->
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('usuariotrabalhador.index')}}">Cadastro de Acesso</a></li>
                      <li><a class="dropdown-item border-bottom border-secundary" href="{{route('usuario.index')}}">Cadastro de Usuário</a></li>
                      
                      @endif
                      <li><a class="dropdown-item " href="{{route('comisionado.index')}}">Comissionador</a></li>
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
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Boletim com Cartão</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Boletim com Tabela</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Descontos</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Calcular Folha</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Planilha de Fechamento- Boletins</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol dos Boletins</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Extrato Cartão Ponto por Trabalhador</a></li>
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Recibos da Folha</a></li>
                              <li><a class="dropdown-item" href="#">Imprimir Cartão Ponto</a></li>
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
                              <li><a class="dropdown-item border-bottom border-secundary" href="#">Recibos</a></li>
                              <li><a class="dropdown-item " href="#">Rol dos recibos</a></li>
                            </ul>
                          </li>
                        </ul>

                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Relatórios
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink""
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Folha Produção por Ano</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Folha Produção por Mês</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Relação dos Sálarios- Contribuição INSS</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Produção do Trabalhador Semestral- Tomador-INSS</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Produção do Trabalhador Anual- Tomador-INSS</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Folha de Produção Anual</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol dos Boletin</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Boletins do Trabalhador</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Trabalhador no Boletim</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol Frequencia na Produção</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary"  href="{{ url('rolnome') }}">Rol Trabalhadores Gráficos- Ordem Nome</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol Trabalhadores Gráficos- Ordem Cadastro</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol Trabalhadores Gráficos- Rol RG</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol Trabalhadores Gráficos- Rol Contas Bancos</a></li>
                                <li><a class="dropdown-item border-bottom border-secundary" href="#">Rol Trabalhadores Gráficos- Rol Telefones</a></li>
                                <li><a class="dropdown-item " href="#">Rol Trabalhadores Gráficos- Rol Exames</a></li>
                              </ul>
                            </li>
                          </ul>

                          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Tabela Anual
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Gerar</a></li>
                                  <li><a class="dropdown-item " href="#">Exibir</a></li>
                                </ul>
                              </li>
                            </ul>

                          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Administração
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Administrador</a></li>
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Históricos</a></li>
                                  <li><a class="dropdown-item " href="#">SEFIP Geral</a></li>
                                </ul>
                              </li>
                            </ul>


                          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Auxiliar
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Alterar data de Tomador</a></li>
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Simulador de Cálculos</a></li>
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Controlador de uniformes</a></li>
                                  <li><a class="dropdown-item border-bottom border-secundary" href="#">Recalculos da Folha</a></li>
                                  <li><a class="dropdown-item " href="#">Recalculos do Boletim</a></li>
                                </ul>
                              </li>
                            </ul>

                  <div class="d-flex align-items-end"> 
                    <div class="flex-shrink-0 dropdown flex-row-reverse">
                      @if($user->name)
                      <a href="#" class="link-dark text-decoration-none dropdown-toggle text-white ms-3"  id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-md"></i> {{$user->name}}
                      </a>
                      @else
                      <a href="#" class="link-dark text-decoration-none dropdown-toggle text-white ms-3"  id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-md"></i> MOBE
                      </a>
                      @endif
                     
                      <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="background-image: linear-gradient(90deg, #ffffff, #ebecf7, #e8e8fa)";>
                        <li><a class="dropdown-item border-bottom border-secundary" href="{{route('usuariotrabalhador.index')}}">Meus da dados</a></li>
                        <li><a class="dropdown-item" href="{{route('login.create')}}">Sair</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                

              </ul>
            </div>
          </div>
</nav>

<div class="container d-none" id="template_invoice">
  <div class="row">
    <div class="col-xs-6">
      <address>
        <strong>ROL DOS TRABALHADOR ALFABETICA: </strong>
    	R121<br>
    	MOBE PRESTADORA DE SERVIÇOS LTDA<br>
      </address>
    </div>
   
  </div>
 

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- <h3 class="panel-title"><strong>Order summary</strong></h3> -->
        </div>
        <div class="">
          <div class="table-responsive">
            <table class="table  table-borderless" id="table" style="font-size: 10px;">
              <thead>
                <tr>
                  <td class="text-center"><strong>MAT</strong></td>
                  <td class="text-center"><strong>NOME</strong></td>
                  <td class="text-center"><strong>DTA.ADM</strong></td>
                  <td class="text-right"><strong>DTA.NAS</strong></td>
                  <td class="text-right"><strong>PIS</strong></td>
                  <td class="text-right"><strong>CPF</strong></td>
                  <td class="text-right"><strong>SITUAC</strong></td>
                </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    @yield('conteine')

    <footer style="background-image: linear-gradient(75deg, #03256C, #0751f3, rgb(33, 5, 197)); color: #ffff;">
        <p class="text-center p-4  col-md-12" style="margin-top: 100px;">&copy; Copyright RHWeb Sistemas Inteligentes - 2021</p>
    </footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="{{url('/js/masck.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/validation.js')}}" ></script>
    <script type="text/javascript" src="{{url('/js/cep.js')}}" ></script>
    <script type="text/javascript" src="{{url('/js/pdf.js')}}"></script>
    <script>
       
        $(document).ready(function(){
          $.ajax({
                url: "{{url('rolnomealfabetica')}}",
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                  if (data.length > 0) {
                    data.forEach(element => {
                      $('#table tbody').prepend( `<tr>
                                                  <td>${branco(element.tsmatricula)}</td>
                                                  <td class="text-center">${branco(element.tsnome)}</td>
                                                  <td class="text-center">${converte(element.csadmissao)}</td>
                                                  <td class="text-right">${converte(element.nsnascimento)}</td>
                                                  <td class="text-right">${branco(element.dspis)}</td>
                                                  <td class="text-right">${branco(element.tscpf)}</td>
                                                  <td class="text-right">${branco(element.cssituacao)}</td>
                                              </tr>` );
                    });
                    
                  }
                    console.log(data)
                }
            });
            function converte(valor) {
              if (valor) {
                var novadata = valor.split('-')
                return `${novadata[2]}/${novadata[1]}/${novadata[0]}`
              }else{
                return ' '
              }
            }
            function branco(valor) {
              if (valor) {
                return valor
              }else{
                return ' '
              }
            }
        })
       
    </script>
  </body>
</html>
