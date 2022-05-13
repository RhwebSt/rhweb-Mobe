
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Tabela de Preço</title>
    </head>

    <style>
         @page { 
                  margin-top: 185px; 
                  margin-bottom: 30px;
                  margin-left: 10px;
                  margin-right: 10px;
                }
              #header { position: fixed; left: 0px; top: -185px; right: 0px; height: 185px;  text-align: center; }
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
            margin-top: 10px;
        }
        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }
        
        .padding-footer{
            padding: 2px;
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
    
    
    <body>
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
                        <td class="name__title text-center text-bold">{{$tomador[0]->tsnome}}</td>
                    </tr>
                </table>
            </div>


            <table class="margin-top">
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
          <p class="page padding-footer" style="text-align: right">Página:  </p>
        </div>
        
        <div id="content">
            <table>
                @foreach($tomador[0]->tabelapreco as $tabelapreco)
                <tr>
                    <td class="small__font border-top border-bottom border-left ano text-center">{{$tabelapreco->tsano}}</td>
                    <td class="small__font border-top border-bottom border-left text-center codigo">{{$tabelapreco->tsrubrica}}</td>
                    <td class="small__font border-top border-bottom border-left text-center descricao uppercase">{{$tabelapreco->tsdescricao}}</td>
                    <td class="small__font border-top border-bottom border-left text-center valor">{{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}</td>
                    <td class="small__font border-top border-bottom border-left border-right text-center valor">{{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
    </body>
    
</html>
    

    