<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Boletim com Tabela</title>
    </head>

    <style>

        *{
            margin: 5px;
            padding: 0px;
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
            width: 763px;
        }

        .firtprad{
            width: 190.8px;
        }

        .tomador{
            margin-top:30px;
        }

        .matric{
            width: 60px;
        }

        .nome{
            width: 702px;
        }

        .desc{
            width:480px;
        }

        .quant{
            width:110px;
        }

        .valor__total{
            width:110px;
        }

        .total__receber{
            width:541px;
        }

        .valor__receber{
            width: 221px;
        }

        .font__receber{
            font-size: 14px;
        }
        

    </style>

    <table>
        <tr>
            <td class="small__font border-top border-bottom border-left firtprad text-center">Folha Para Conferência - 999999</td>
            <td class="small__font border-top border-bottom firtprad text-center">Data do Boletim:
                @if(isset($lancamentotabelas[0]->lsdata))
                    <?php
                        $data = explode('-',$lancamentotabelas[0]->lsdata);
                        $data = $data[2].'/'.$data[1].'/'.$data[0];
                    ?>
                    {{$data}}
                @endif
            </td>
            <td class="small__font border-top border-bottom firtprad text-center">Ano Referência: 2021</td>
            <td class="small__font border-top border-bottom border-right firtprad text-center">Boletim Nº: {{$lancamentotabelas[0]->liboletim}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$lancamentotabelas[0]->esnome}}</td>
        </tr>
    </table>

    <table class="tomador">
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$lancamentotabelas[0]->tsnome}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom small__font text-bold matric text-center"></td>
            <td class="border-left border-right border-top border-bottom small__font text-bold  text-center nome">Eliel Felipe dos Santos Rocha</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom destaque small__font text-bold matric text-center">Código</td>
            <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center desc">Descrição</td>
            <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center quant">Quantidade</td>
            <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center valor__total">Valor Total</td>
        </tr>

        <tr>
            <td class="border-left border-right border-top border-bottom small__font matric text-center">0001</td>
            <td class="border-left border-right border-top border-bottom small__font text-center desc">Hora Extra 50%</td>
            <td class="border-left border-right border-top border-bottom small__font text-center quant">4</td>
            <td class="border-left border-right border-top border-bottom small__font text-center valor__total">R$ 999.999.999,99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom small__font destaque text-bold total__receber font__receber">Total a Receber</td>
            <td class="border-left border-right border-top border-bottom small__font destaque text-bold valor__receber text-center font__receber">R$ 999.999.999,99</td>
        </tr>
    </table>