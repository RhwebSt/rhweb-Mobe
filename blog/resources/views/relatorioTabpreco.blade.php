<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Tabela de Preço</title>
    </head>

    <style>

         @page { 
                  margin-top: 44px; 
                  margin-bottom: 30px;
                  margin-left: 10px;
                  margin-right: 10px;
                }
              #header { position: fixed; left: 0px; top: -44px; right: 0px; height: 44px; background-color:; text-align: center; }
              #footer { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 50px; text-align: end; }
              #footer .page:after { content: counter(page, upper); }
        

        table{
            border-collapse: collapse;
        }

        body{
            font-family:sans-serif;
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
            width: 771px;
            
        }
        
        .ano{
            width: 60px;
        }

        .codigo{
            width: 80px;
        }

        .descricao{
            width: 380px;
        }

        .valor{
            width: 120.5px;
        }
        
        .margin-top{
            margin-top: 5px;
        }
        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }
        
        .padding-footer{
            padding: 2px;
        }
    </style>
    
    
    <body>
        <div id="header">
            <table class="margin-top">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$tomadores->tsnome}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-bottom border-left destaque ano text-center text-bold">Ano</td>
                    <td class="small__font border-top border-bottom border-left destaque text-center codigo text-bold">Código</td>
                    <td class="small__font border-top border-bottom border-left destaque text-center descricao text-bold">Descrição</td>
                    <td class="small__font border-top border-bottom border-left destaque text-center valor text-bold">Valor Trabalhador</td>
                    <td class="small__font border-top border-bottom border-left border-right destaque text-center valor text-bold">Valor Tomador</td>
                </tr>
            </table>
        
        </div>
        
        <div id="footer">
          <p class="page destaque borderT padding-footer">Página:  </p>
        </div>
        
        <div id="content">
            <table>
                @foreach($tabelaprecos as $tabelapreco)
                <tr>
                    <td class="small__font border-top border-bottom border-left ano text-center">{{$tabelapreco->tsano}}</td>
                    <td class="small__font border-top border-bottom border-left text-center codigo">{{$tabelapreco->tsrubrica}}</td>
                    <td class="small__font border-top border-bottom border-left text-center descricao">{{$tabelapreco->tsdescricao}}</td>
                    <td class="small__font border-top border-bottom border-left text-center valor">{{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}</td>
                    <td class="small__font border-top border-bottom border-left border-right text-center valor">{{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
    </body>
    
</html>
    

    