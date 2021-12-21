<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Rol das Rúbricas</title>


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

            .name__title{
                width: 763.5px;
            }

            .font__trab{
                font-size:14px;
            }

            .margin-bottom{
                margin-bottom: 20px;
            }

            .padding{
                padding: 5px;
            }

            .rubricas{
                width:120px;
            }

            .descricao{
                width:350px;
            }

            .incidencia{
                width:150px;
            }

            .dc{
                width:152px;
            }

            .capitalize{
                text-transform: capitalize;
            }

            .margin-top{
                margin-top: 20px;
            }


            </style>
    </head>

    <body>
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaqueDark padding">Rol das Rúbricas</td>
            </tr>
        </table>

        <table class="margin-top">
            <tr>
                <td class="small__font border-left text-center border-bottom border-top text-bold destaque rubricas">Rúbricas</td>
                <td class="small__font border-left text-center border-bottom border-top text-bold destaque descricao">Descrição</td>
                <td class="small__font border-left text-center border-bottom border-top text-bold destaque incidencia">Incidência</td>
                <td class="small__font border-left border-right text-center border-bottom border-top text-bold destaque dc">D/C</td>
            </tr>

            <tr>
                <td class="small__font border-left text-center border-bottom border-top text-bold rubricas">1001</td>
                <td class="small__font border-left text-center border-bottom border-top text-bold descricao capitalize">Hora Normal</td>
                <td class="small__font border-left text-center border-bottom border-top text-bold incidencia capitalize">Sim</td>
                <td class="small__font border-left border-right text-center border-bottom border-top text-bold dc capitalize">Desconto</td>
            </tr>
        </table>
    </body>

</html>