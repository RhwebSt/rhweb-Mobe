<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/reset.css">
        <title>RHWEB - Rol dos Trabalhadores</title>
    </head>

    <style>
    
        @page { 
              margin-top: 230px; 
              margin-bottom: 30px;
              margin-left: 10px;
              margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -230px; right: 0px; height: 230px; background-color:; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 55px; text-align: end; }
        #footer .page:after { content: counter(page, upper); }
    
    
        table{
            border-collapse:collapse;
        }
    
        body{
            font-family:sans-serif;
        }

        .matricula{
            width:70px;
        }
    
        .nome{
          width:250px;
        }
    
        .cpf{
          width:93px;
        }
    
        .adm{
          width:70px;
        }
    
        .nasc{
          width:70px;
        }
    
        .pis{
          width:95px;
        }
    
        .situacao{
          width:101px;
        }

        .rolTitulo{
            margin-left:100px;
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
            width: 769px;
        }
    
    
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
            width: 769px;
        }
        
        .margin-top{
            margin-top: 10px;
        }
    
        .padding-footer{
            padding: 2px;
            width:770px;
        }

        
        .margin-bottom{
            margin-bottom: 10px;
        }
        
        .title-data{
            font-size: 16px;
            margin-right: 10px;
        }
    
        .logo{
            width: 100px;
            height: 100px;
        }
        
        .padding-left-foto{
            padding-left: 20px;
        }
        
        .margin-top{
            margin-top: 8px;
        }
        
        .margin-top2{
            margin-top: 30px;
        }

        .margin-bottom--title{
            margin-bottom: 4px;
        }
        
        .border-top-left-radius{
            border-top-left-radius: 8px;
        }
        
        .border-top-right-radius{
            border-top-right-radius: 8px;
        }

        .nome__trab{
            width: 745px;
        }
    
    </style>


    <body class="">
    
        <div id="header">
            
            <div class="borderT margin-top">
                <table>
                    <tr>
                    <td rowspan="7" style="padding-left: 15px">
                            @if($empresas->esfoto)
                                <img class="logo" src="{{$empresas->esfoto}}" alt="" srcset="">
                            @else
                                @include('imagem')
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="padding-left-foto text-bold">{{$empresas->esnome}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">CNPJ/MF Nroº : {{$empresas->escnpj}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Rua: {{$empresas->endereco[0]->eslogradouro}}, {{$empresas->endereco[0]->esnum}} - {{$empresas->endereco[0]->escep}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Bairro: {{$empresas->endereco[0]->esbairro}} - {{$empresas->endereco[0]->esuf}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Tel: {{$empresas->estelefone}}</td>
                    </tr>
        
                </table>
            </div>
            
            <div class="margin-top">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">Rol dos Trabalhadores - Ordem Alfabética - Data: {{date("d/m/y")}}</td>
                    </tr>
                </table>
            </div>
            
            <div class="margin-top2">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">{{$empresas->esnome}}</td>
                    </tr>
                </table>
            </div>

            
        </div>
    
        <div id="footer">
          <p class="page" style="text-align: right">Página:  </p>
        </div>
    
        <div id="content">
            <table>
                <tr class="">
                    <th class="matricula small__font destaque text-center border-right border-left border-bottom border-top">Matríc</th>
                    <th class="nome small__font destaque text-center border-right border-left border-bottom border-top">Nome</th>
                    <th class="cpf small__font destaque text-center border-right border-left border-bottom border-top">CPF</th>
                    <th class="adm small__font destaque text-center border-right border-left border-bottom border-top">Data Adm</th>
                    <th class="nasc small__font destaque text-center border-right border-left border-bottom border-top">Data Nasc</th>
                    <th class="pis small__font destaque text-center border-right border-left border-bottom border-top">PIS</th>
                    <th class="situacao small__font destaque text-center border-right border-left border-bottom border-top">Situação</th>
                </tr>
                
                @foreach($trabalhadors as $trabalhador)
                    <tr class="bottom">
                        <td class="matricula small__font border-right border-left border-bottom text-center">{{$trabalhador->tsmatricula}}</td>
                        <td class="nome small__font border-right border-left border-bottom text-center">{{$trabalhador->tsnome}}</td>
                        <td class="cpf small__font border-right border-left border-bottom text-center">{{$trabalhador->tscpf}}</td>
                        <td class="adm small__font border-right border-left border-bottom text-center">
                            
                            {{date('d/m/Y',strtotime($trabalhador->categoria[0]->csadmissao))}}
                           
                        </td>
                        <td class="nasc small__font border-right border-left border-bottom text-center">
                           
                            {{date('d/m/Y',strtotime($trabalhador->nascimento[0]->nsnascimento))}}
                            
                        </td>
                        <td class="pis small__font border-right border-left border-bottom text-center">{{$trabalhador->documento[0]->dspis}}</td>
                        <td class="situacao small__font border-right border-left border-bottom text-center">{{$trabalhador->categoria[0]->cssituacao}}</td>
                    </tr>
                @endforeach

            </table>
        </div>

</body>
</html>