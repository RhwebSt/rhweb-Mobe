<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Protocolo de Devolução da CTPS</title>
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
        
        td{
            padding-left: 5px;
        }
        
        .uppercase{
            text-transform: uppercase;
        }
        
        .capitalize{
            text-transform: capitalize;
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
            width: 757px;
        }

        .name__title2{
            width: 98%;
            font-size: 17px;
            word-break: break-all;
            text-align: justify-all;
        }

        .width__padrao{
            width:646px;
        }

        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }

        .margin-top{
            margin-top:20px;
        }

        .marginTerm{
            margin-top:40px;
            margin-bottom:220px;
        }

        .indentificacao{
            width: 184.7px;
        }

        .assinatura{
        margin-top:50px;
        }

        .fontDeclaracao{
        font-size: 14px;
        }

        .data__ass{
        width:150px;
        }

        .linhaass{
        width:759px;
        }

        .cidade{
            width:375px;
        }

        .protco{
            margin-top: 50px;
        }

    </style>

    <body>
    <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$empresas->esnome}}</td>
            </tr>
        </table>
        
        <div class="borderT">
            <table>
                    <tr>
                        <td rowspan="6"><img class="logo" src="{{$empresas->esfoto}}" title="foto" alt="" style="width:80px; height: 80px; padding:4px;"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>CNPJ/MF Nroº : </strong>{{$empresas->escnpj}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>Rua:</strong> {{$empresas->eslogradouro}}, {{$empresas->esnum}} - {{$empresas->escep}}</td>
                        
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>Bairro:</strong> {{$empresas->esbairro}} - {{$empresas->esuf}}</td>
                        
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>Tel:</strong> {{$empresas->estelefone}}</td>
                    </tr>
            </table>
        </div>

        <table class=" protco">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Protocolo de Devolução da Carteira de Trabalho e Previdência Social</td>
            </tr>
        </table>

        <div class="marginTerm">
            <p class=" name__title2">Eu,<strong>{{$trabalhadors->tsnome}} </strong></p>

            <p class=" text name__title2">abaixo identificado, declaro que recebi a devolução da CTPS - Carteira de Trabalho e Previdência Social<strong>Nroº: {{$trabalhadors->dspis}} Série: {{$trabalhadors->dsserie}}</strong> com suas respectivas anotações, de acordo com a disposições legais vigentes.</p>
            
            <p class="name__title2">Atenciosamente,</p>

        </div>


        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Identificação do Trabalhador</td>
            </tr>
        </table>

        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold">{{$trabalhadors->tsnome}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font border-right border-left border-top indentificacao text-center destaque text-bold">PIS/PASEP</td>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">CPF</td>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">RG</td>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">Data Nascimento</td>
            </tr>

            <tr>
                <td class="small__font border-right border-left border-top border-bottom indentificacao text-center">{{$trabalhadors->dspis}}</td>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">{{$trabalhadors->tscpf}}</td>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">0000-000</td>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">
                    <?php
                        $data = explode('-',$trabalhadors->nsnascimento);
                    ?>
                    {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                </td>
                
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">Data Admissão</td>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">Num CTPS</td>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">Série CTPS</td>
                <td class="small__font border-right border-left border-top text-center indentificacao destaque text-bold">UF CTPS</td>
            </tr>

            <tr>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">
                    <?php
                        $data = explode('-',$trabalhadors->csadmissao);
                    ?>
                    {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                </td>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">{{$trabalhadors->dsctps}}</td>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">{{$trabalhadors->dsserie}}</td>
                <td class="small__font border-right border-left border-top border-bottom text-center indentificacao">{{$trabalhadors->dsuf}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom small__font name__title text-bold">Nome da Mãe:{{$trabalhadors->tsmae}}</td>
            </tr>
        </table>

        <div class="borderT margin-top">
            <table class="assinatura">
                <tr>
                    <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
                </tr>
        
                <tr>
                    <td class="fontDeclaracao text-center">Assinatura Trabalhador</td>
                </tr>
            </table>

            <table class="margin-top">
                <tr>
                <td class="fontDeclaracao data__ass  text-center cidade">{{$empresas->esmunicipio}} - {{$empresas->esuf}}</td>
                    <td class="fontDeclaracao data__ass  text-center cidade">Data: {{date("d/m/y")}}</td>
                </tr>
            </table>
        </div>

    </body>

</html>