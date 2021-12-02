<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Cartão Ponto</title>
    </head>

    <style>

        *{
            margin: 5px;
            padding: 0px;
        }


        .spacing{
            padding-left:5px;
        }

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

        .font{
            font-size: 18px;
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

        .logo{
            margin-top:10px;
            margin-right: 50px;
        }

        .name__title{
            width: 1090px;
        }

        .width__padrao{
            width:576px;
        }

        .titulo{
            margin-top:10px;
            margin-bottom: 10px;
        }

        .planilha{
            width:800px;
        }

        .boletim{
            width:124px;
        }

        .data__ref{
            width:164px;
        }

        .valor__padrao{
            width: 181.2px;
        }

        .nome{
            width: 370px;
        }

        .pad{
            width: 45px;
        }

        .ent{
            width:35px;
        }

        .valor{
            width: 93px;
        }

        .adcnot{
            width: 55px;
        }

        .normais{
            width: 57px; 
        }

        .diurno{
            width: 161px;
            height:8px;
        }

        .vazio{
            width: 376px;
        }

        .fontex{
            font-size: 10px;
        }

        .white{
            color: white;
        }

        .totalizacao{
            width:160px;
        }

        .qtnd__trab{
            width:539px;
        }



        </style>

        <body>

            <table>
                <tr>
                    <td class="name__title border-right border-left border-bottom border-top destaque text-center text-bold">Nome da Empresa</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font planilha text-bold border-top border-bottom border-left border-right">Planilha do Cartão Ponto - 9999</td>
                    <td class="small__font boletim text-center border-top border-bottom border-left border-right  text-bold">Boletim n° 999999</td>
                    <td class="small__font text-center data__ref border-top border-bottom border-left border-right text-bold">Data Referência: 99/99/9999</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao destaque">Valor</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Diária</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Hora</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Hora Extra 50%</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Hora Extra 100%</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao border-right  destaque">Adicional Noturno</td>
                </tr>

                <tr>
                    <td class="small__font border-left border-bottom text-center valor__padrao">Base Empresa</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao border-right">R$ 999.999.999,99</td>
                </tr>

                <tr>
                    <td class="small__font border-left border-bottom text-center valor__padrao">Base Folha</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 999.999.999,99</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao border-right">R$ 999.999.999,99</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="name__title border-right border-left border-bottom border-top destaque text-center text-bold">Boletim Cartão Ponto - Diário</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class=" small__font vazio white">.</td>
                    <td class=" small__font border-top border-left border-right diurno text-center text-bold fontex">Diurno</td>
                    <td class=" small__font border-top border-left border-right  text-center diurno text-bold fontex">Noturno</td>
                    <td class="nome  small__font"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-bottom border-left text-center text-bold destaque">Nome</td>
                    <td class="small__font border-top border-bottom border-left ent text-center text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left pad text-center text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left ent text-center text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left pad text-center text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left text-center ent text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left text-center ent text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left text-center normais text-bold destaque">Normais</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">50%</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">100%</td>
                    <td class="small__font border-top border-bottom border-left text-center adcnot text-bold destaque">Adc.Not</td>
                    <td class="small__font border-top border-bottom border-left text-center valor text-bold destaque">Valor Folha</td>
                    <td class="small__font border-top border-bottom border-left border-right text-center valor text-bold destaque">Valor Total</td>
                </tr>

                <tr>
                    <td class="small__font border-top border-bottom border-left nome spacing">Eliel Felipe dos Santos Rocha</td>
                    <td class="small__font border-top border-bottom border-left ent text-center">00:00</td>
                    <td class="small__font border-top border-bottom border-left pad text-center">00:00</td>
                    <td class="small__font border-top border-bottom border-left ent  text-center">00:00</td>
                    <td class="small__font border-top border-bottom border-left pad text-center">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center ent ">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center ent ">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center normais">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center adcnot">00:00</td>
                    <td class="small__font border-top border-bottom border-left text-center valor">999.999.999,99</td>
                    <td class="small__font border-top border-bottom border-left border-right text-center valor">999.999.999,99</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left totalizacao">Totalizações</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left qtnd__trab">Quantidades de Trabalhadores: 9999999</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left normais">99:99</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left pad">99:99</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left pad">99:99</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left adcnot">99:99</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left valor">R$ 999.999,99</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left border-right valor">R$ 999.999,99</td>
                </tr>
            </table>
        
        
        </body>