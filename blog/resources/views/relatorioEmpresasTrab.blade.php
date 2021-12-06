<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório de Empresas Trabalhadas</title>
    </head>

    <style>
        body{
            font-family:sans-serif;
        }

        *{
            margin: 5px;
            padding: 0px;
        }

        table{
            border-collapse: collapse;
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

        .fontDeclaracao{
        font-size: 14px;
        }

        .matric{
            width:174px;
        }

        .cpf{
            width:200px;
        }

        .pis{
            width:188px;
        }

        .cbo{
            width:200px;
        }

        .name__title{
        width: 763.5px;
        }

        .font__trab{
        font-size:14px;
        }

        .margin-bottom{
            margin-bottom: 20px;
        }

        .tomador{
            width: 500px;
        }

        .dias{
            width: 120px;
        }

        .total{
            width: 141px;
        }

    </style>

    <body>
        
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">Eliel Felipe dos Santos Rocha</td>
            </tr>
        </table>
    
        <table class="margin-bottom">
            <tr>
                <td class="small__font matric border-left text-center border-bottom border-top"><strong>Matrícula:</strong> 9999</td>
                <td class="small__font cpf border-left text-center border-bottom border-top"><strong>CPF:</strong> 999.999.999-99</td>
                <td class="small__font pis border-left text-center border-bottom border-top"><strong>PIS:</strong> 999999999-99</td>
                <td class="small__font cbo border-left border-right text-center border-bottom border-top"><strong>CBO:</strong> 9999999</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font border-top border-bottom border-left border-right text-center destaque text-bold tomador">Nome do Tomador</td>
                <td class="small__font border-top border-bottom border-left border-right text-center destaque text-bold dias">Total de Dias</td>
                <td class="small__font border-top border-bottom border-left border-right text-center destaque text-bold total">Total R$</td>
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right text-center text-bold tomador">Mobe Mão de Obra Terceirizada</td>
                <td class="small__font border-bottom border-left border-right text-center text-bold dias">30</td>
                <td class="small__font border-bottom border-left border-right text-center text-bold total">R$ 999.999.999,99</td>
            </tr>
        </table>

    </body>