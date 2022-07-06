<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Controle de frequência diária</title>
    </head>

    <style>

         @page { 
          margin-top: 140px; 
          margin-bottom: 20px;
          margin-left: 10px;
          margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -140px; right: 0px; height: 140px; background-color:; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -20px; right: 0px; height: 20px; text-align: end; }
        #footer .page:after { content: counter(page, upper); }

        table{
            border-collapse: collapse;
        }
        
        .padding-left{
            padding-left: 5px;
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

        .medium__font{
            font-size: 14px;
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
        
        .logo{
            margin-top:10px;
            margin-right: 50px;
            width: 100px;
            height: 120px;
        }

        .firtprad{
            width: 254.7px;
        }

        .tomador{
            margin-top:10px;
        }

        .matric{
            width: 100px;
        }

        .nome{
            width: 480px;
        }

        .competencia{
            width: 164.5px;
        }

        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }
        
        .width__padrao{
            width:576px;
        }

        .margin-top{
            margin-top: 10px;
        }

        .padding-footer{
            padding: 2px;
        }

        .padding-left-texto{
            padding-left: 5px;
        }

        .padding-left-foto{
            padding-left: 20px;
        }

        .margin-left{
            margin-left: 10px;
        }

        .margin-bottom{
            margin-bottom: 10px;
        }

        .padrao__dias{
            width: 70px;
        }

        .dias{
            width: 36px;
        }
        
        .padrao__assinatura{
            width: 151px;
        }

        .padrao__legend{
            width: 287px;
        }

        .margin-left__legend{
            padding-left: 38px;
        }
        
        .margin-top-medium{
            margin-top: 20px;
        }

        .empresa{
            width: 542.5px;
        }

        .setor{
            width: 223px;
        }

        .padraoTotal{
            width: 134px;
        }
    </style>

<body>
    <div id="header">
    
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="7"><img class="logo" src="https://pbs.twimg.com/media/DgJ0aszU0AEX44i?format=jpg&name=small" alt="" srcset="" style="width:80px; height: 80px; padding-left: 10px; padding-bottom: 10px;"></td>
                </tr>

                <tr>
                    <td class=" width__padrao padding-left-foto text-bold">Nome do Usuario (empresa)</td>
                </tr>

                <tr> 
                    <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : </td>
                </tr>

                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Rua:</td>
                </tr>

                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Bairro:</td>
                </tr>

                <tr>
                    <td class="small__font width__padrao padding-left-foto">Tel:</td>
                </tr>

            </table>
        </div>

    </div>

    <div class="content">
        <table>
            <tr>
                <td class="text-center name__title text-bold">Controle de Frequência Diária</td>
            </tr>
        </table>

        <div class="margin-top">
            <table>
                <tr>
                    <td rowspan="6"><img class="logo" src="https://pbs.twimg.com/media/DgJ0aszU0AEX44i?format=jpg&name=small" alt="" srcset="" style="width:80px; height: 80px; padding-left: 10px; padding-bottom: 10px;"></td>
                </tr>

                <tr>
                    <td class=" width__padrao padding-left-foto text-bold">Nome do Trabalhador</td>
                </tr>

                <tr> 
                    <td class="small__font width__padrao padding-left-foto">CPF: 000.000.000-00</td>
                </tr>

                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Matricula: 500</td>
                </tr>

                <tr>
                    <td class="small__font width__padrao padding-left-foto">Tel: (00) 00000-0000</td>
                </tr>

            </table>
        </div>

        <table class="margin-top-medium">
            <tr>
                <td class="margin-left__legend"></td>
                <td class="padrao__legend border-top border-left border-right text-bold text-center medium__font">Diurno</td>
                <td class="padrao__legend border-top border-left border-right text-bold text-center medium__font">Noturno</td>
                <td class="padrao__assinatura"></td>
            </tr>
        </table>

        <table>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font destaque text-bold">Dia</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Entrada</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Saída</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Entrada</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Saída</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Entrada</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Saída</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Entrada</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font destaque text-bold text-center">Saída</td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font destaque text-bold text-center">Assinatura</td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">01</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">02</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">03</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">04</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">05</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">06</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">07</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">08</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">09</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">10</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">11</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">12</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">13</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">14</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">15</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">16</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">17</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">18</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">19</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">20</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">21</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">22</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">23</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">24</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">25</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">26</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">27</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">28</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">29</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">30</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

            <tr>
                <td class="dias text-center border-left border-right border-top border-bottom medium__font">31</td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__dias border-right border-top border-bottom medium__font text-center"></td>
                <td class="padrao__assinatura border-right border-top border-bottom medium__font text-center"></td>
            </tr>

        </table>
        
        <table class="borderT margin-top">
            <tr>
                <td class="empresa text-center text-bold border-left border-right medium__font destaque">Empresa</td>
                <td class="setor medium__font text-center text-bold border-right destaque">Setor</td>
            </tr>

            <tr>
                <td class="empresa text-bold border-left border-right medium__font">*</td>
                <td class="setor medium__font text-bold border-right">*</td>
            </tr>
        </table>

        <table class="margin-top borderT">
            <tr>
                <td class="padraoTotal medium__font border-right text-bold text-center destaque">Diárias</td>
                <td class="padraoTotal medium__font border-right text-bold text-center destaque">HE 50%</td>
                <td class="padraoTotal medium__font border-right text-bold text-center destaque">HE 100%</td>
                <td class="padraoTotal medium__font border-right text-bold text-center destaque">Competência</td>
                <td class="setor medium__font border-right text-bold text-center destaque">Assinatura</td>
            </tr>

            <tr>
                <td class="padraoTotal medium__font border-right text-bold">*</td>
                <td class="padraoTotal medium__font border-right text-bold">*</td>
                <td class="padraoTotal medium__font border-right text-bold">*</td>
                <td class="padraoTotal medium__font border-right text-bold text-center">_____/______</td>
                <td class="setor medium__font border-right text-bold">*</td>
            </tr>
        </table>
    </div>

</body>