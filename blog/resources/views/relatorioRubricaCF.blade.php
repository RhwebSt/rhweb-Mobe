<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/reset.css">
        <title>RHWeb - Relatório por Rúbrica</title>
    </head>

    <style>

        @page { 
            margin-top: 100px; 
            margin-bottom: 30px;
            margin-left: 10px;
            margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px; background-color:; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 55px; text-align: end; }
        #footer .page:after { content: counter(page, upper); }


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
        text-transform: capitalize;
        border-collapse: collapse;
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
            width: 768px;
        }


        .borderT{
            border: 1px solid black;
            border-radius: 3px;
            width: 758px;
        }
        
        .margin-top{
            margin-top: 10px;
        }

        .padding-footer{
            padding: 2px;
            width:770px;
        }
        
        .widthHeader{
            width:773px;
            margin-bottom: 10px;
        }
        
        .margin-bottom{
            margin-bottom: 10px;
        }
        
        .title-data{
            font-size: 16px;
            margin-right: 10px;
        }


        .data{
            width:251.3px;
        }

        .matric{
            width:55px;
        }

        .nome{
            width:482px;
        }

        .quantidade{
            width: 80px;
        }

        .valor{
            width:130px;
        }

        .trabQuant{
            width: 200px;
        }

        .totalGeral{
            width: 337px;
        }


    </style>

    <body>
        <div id="header">
            <table class="margin-top">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$folhas[0]->esnome}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold data">Competência 
                    <strong>
                        <?php
                            $data_inicial = explode('-',$folhas[0]->fsinicio);
                            echo($data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                        ?>
                    </strong>  a 
                    <strong>
                        <?php
                            $data_final = explode('-',$folhas[0]->fsfinal);
                            echo($data_final[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                        ?>
                    <strong> 
                    </td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold data">Data de Emissão {{date("d/m/y")}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold data">código da Folha: {{$folhas[0]->fscodigo}}</td>
                </tr>
            </table>

            <table class="margin-top">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$folhas[0]->vicodigo}} - {{$folhas[0]->vsdescricao}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque matric">Matrícula</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque nome">Nome</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque quantidade">Quantidade</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque valor">Valor</td>
                </tr>
            </table>
        </div>

        <div id="footer">
            <p class="page destaque borderT padding-footer">Página:  </p>
        </div>

        <div id="content">
            <?php
                $quantidade = 0;
                $valor = 0;
            ?>
            <table>
                @foreach($folhas as $folha)
                    <tr>
                        <td class="small__font border-top border-bottom border-right border-left text-center text-bold matric">{{$folha->tsmatricula}}</td>
                        <td class="small__font border-top border-bottom border-right border-left text-center text-bold nome">{{$folha->tsnome}}</td>
                        <td class="small__font border-top border-bottom border-right border-left text-center text-bold quantidade">{{number_format((float)$folha->vireferencia, 2, ',', '.')}}</td>
                        <td class="small__font border-top border-bottom border-right border-left text-center text-bold valor">R$ {{number_format((float)$folha->vivencimento, 2, ',', '.')}}</td>
                    </tr>
                    <?php
                        $quantidade += $folha->vireferencia;
                        $valor += $folha->vivencimento;
                    ?>
                @endforeach
            </table>

            <table class="margin-top">
                <tr>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque trabQuant">Quantidade:  {{count($folhas)}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque totalGeral">Total ==================></td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque quantidade">{{number_format((float)$quantidade, 2, ',', '.')}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center text-bold destaque valor">R$ {{number_format((float)$valor, 2, ',', '.')}}</td>
                </tr>
            </table>
        </div>
    </body>

</html>