<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/reset.css">
    <title>PDF</title>
</head>

<style>

     *{
        margin: 5px;
        padding: 0px;
    }

    table{
        border-collapse:collapse;
    }

    body{
        font-family:sans-serif;
    }
    
    td{
        padding-left:5px;
    }


    h2{
      font-size:14px;
      text-align: center;
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    table{
     
      width:100%;
      margin: 0;
      padding: 0;
      text-transform: capitalize;
       border-collapse: collapse;
    
      
    }

    .matricula{
      width:10px;
      border-right: 1px solid;
      text-align: center;
    }

    .nome{
      width:270px;
      border-right: 1px solid;
    }

    .cpf{
      width:93px;
      border-right: 1px solid;
      text-align:center;
    }

    .adm{
      width:63px;
      border-right: 1px solid;
      text-align: center;
    }

    .nasc{
      width:55px;
      border-right: 1px solid;
      text-align: center;
    }

    .pis{
      width:83px;
      border-right: 1px solid;
      text-align: center;
    }

    .situacao{
      width:50px;
      text-align: center;
    }

    p{
      font-weight: bolder;
      font-size: 12px;
      margin-bottom:10px;
      float:right;
    }

   
    
    .rolTitulo{
        margin-left:100px;
    }
    
    
    thead{
      border: 1px solid black;
      text-align: center;

    }

    th{
      font-weight: bold;
    }
    
    footer{
      float: right;
    }
    
    figure{
        vertical-align: middle;
        font-size:16px;
        font-weight:bold;
        margin-top:10px;
        
    }
    
    .container{
        display:block;
    }


    .page {
        position:absolute;
        bottom:0;
        width:100%;
        font-size: 16px;
        font-weight: bold;
     }
  
    .border-left{
            border-left: 1px solid;
    }

    .border-right{
        border-right: 1px solid;
    }

    .border-bottom{
        border-bottom: 1px solid;
    }

    .border-top{
        border-top: 1px solid;
    }

    .text-center{
        text-align: center;
    }

    .small__font{
        font-size:12px
    }

    .little__font{
        font-size:11px;
    }

    .text-bold{
        font-weight: bold;
    }

    .destaque{
        background-color: rgb(214, 213, 213);
    }

    .destaqueDark{
        background-color: rgb(168, 168, 168);
    }

    .uppercase{
        text-transform: uppercase;
    }

    .name__title{
        width: 758px;
    }


    .borderT{
        border: 1px solid black;
        border-radius: 3px;
        width: 758px;
    }



</style>


<body class="">
    <div class="container">
     
    <p>
         <?php
            $today = date("m.d.y"); 
          ?>
         Data: {{$today}}
    </p>
    <div class="borderT">
        <table>
            <tr>
                <td rowspan="3"><img  class="image" style="width: 90px; height:90px" src="data:image/png;base64,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" alt="" srcset=""></td>
            </tr>
            
            <tr>
                <td></td>
                <td class="text-bold">ROL DOS TRABALHADORES - ORDEM ALFABÉTICA</td>
            </tr>
        </table>
    </div>

    @if( isset($empresas->esnome))
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$empresas->esnome}}</td>
        </tr>
    </table>
    @else
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">MOBE PRESTADORA DE SERVIÇOS LTDA</td>
        </tr>
    </table>
    @endif

      <table>
        <thead>
          <tr class="">
            <th class="matricula small__font destaque">Matrícula</th>
            <th class="nome small__font destaque">Nome</th>
            <th class="cpf small__font destaque">CPF</th>
            <th class="adm small__font destaque">Data ADM</th>
            <th class="nasc small__font destaque">Data Nasc</th>
            <th class="pis small__font destaque">PIS</th>
            <th class="situacao small__font destaque">Situação</th>
          </tr>
      </thead>
      <tbody>
          @foreach($trabalhadors as $trabalhador)
            <tr class="bottom">
                <td class="matricula small__font border-right border-left border-bottom uppercase">{{$trabalhador->tsmatricula}}</td>
                <td class="nome small__font border-right border-left border-bottom uppercase">{{$trabalhador->tsnome}}</td>
                <td class="cpf small__font border-right border-left border-bottom uppercase">{{$trabalhador->tscpf}}</td>
                <td class="adm small__font border-right border-left border-bottom uppercase">
                     @if($trabalhador->csadmissao)
                        <?php
                            $dataadmissao = explode('-',$trabalhador->csadmissao);
                            $dataadmissao = $dataadmissao[2]."/".$dataadmissao[1]."/".$dataadmissao[0];
                        ?>
                     {{$dataadmissao}}
                    @endif
                   
                </td>
                <td class="nasc small__font border-right border-left border-bottom uppercase">
                    @if($trabalhador->nsnascimento)
                        <?php
                            $datanascimento = explode('-',$trabalhador->nsnascimento);
                            $datanascimento = $datanascimento[2]."/".$datanascimento[1]."/".$datanascimento[0];
                        ?>
                    {{$datanascimento}}
                    @endif
                    
                </td>
                <td class="pis small__font border-right border-left border-bottom uppercase">{{$trabalhador->dspis}}</td>
                <td class="situacao small__font border-right border-left border-bottom uppercase">{{$trabalhador->cssituacao}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>

</div>
<footer class="footer">
  <p class="page">1</p>
</footer>

</body>
</html>