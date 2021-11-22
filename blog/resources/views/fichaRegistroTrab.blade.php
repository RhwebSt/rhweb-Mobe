<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Ficha de Registro do Trabalhador</title>
    </head>

    <style>
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
            width: 700px;
        }

        .flex{
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            align-content: flex-start;

            
        }

        .width__padrao{
            width:576px;
        }

        .logo{
            margin-top:10px;
            margin-right: 50px;
            width: 90px;
            height: 120px;
        }

        .documentos{
            width:230.7px;
        }

        .rua{
            width:519px;
        }

        .uf{
            width:40px;
        }

        .cep{
            width:133px;
        }

        .cidade{
            width:260px;
        }
        .telefone{
            width:172px;
        }

        .afiliacao{
            width:700px;
        }

        .nome{
            width:505px;
        }

        .data{
            width:191px;
        }

        .bancario{
            width:230px;
        }

        .fontDeclaracao{
        font-size: 14px;
        }

        .assinatura{
        margin-top:20px;
        }

        .linhaass{
        width:545px;
        }

        .data__ass{
        width:150px;
        }

    </style>

    <body>
        
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Mobe Prestadora de Serviços LTDA</td>
            </tr>
        </table>

        <table>
            <tr>
                <td rowspan="6"><img class="logo" src="https://lh3.googleusercontent.com/proxy/7XVxRZ-bvU9WJtieivDc5c4XXjoX-XcEZXdZ1X5kJpoN8vEGcSO-_p-_ikG1YW9JLmboS3Zomxnci0MLDfXrqIQevO9o9w" alt="" srcset="" style="width:80px; height: 80px; padding:10px"></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>CNPJ/MF Nroº : 343509150001.49</strong></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>Rua:</strong> Nereu Ramos, 646 - 88133-330</td>
                
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>Bairro:</strong> Jardim Eldorado - SC</td>
                
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>Tel:</strong> (48) 3086-0103</td>
            </tr>

        </table>


        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Ficha de Registro do Trabalhador Matrícula: {{$trabalhadors->tsmatricula}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td rowspan="6"><img class="logo" src="{{$trabalhadors->tsfoto}}"></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="width__padrao"><strong>{{$trabalhadors->tsnome}}</strong></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>Categoria:</strong> {{$trabalhadors->cscategoria}}</td>
                
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>CBO: {{$trabalhadors->cbo}}</strong> - Desenvolvedor de Software</td>
                
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>Data de Admissão:</strong> {{$trabalhadors->csadmissao}}</td>
            </tr>

        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Documentos</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font documentos border-left border-top"><strong>PIS:</strong>  {{$trabalhadors->dspis}}</td>
                <td class="small__font documentos border-top"><strong>CPF:</strong> {{$trabalhadors->tscpf}}</td>
                <td class="small__font documentos border-right border-top"><strong>Data Nascimento:</strong> {{$trabalhadors->nsnascimento}}</td>
            </tr>

            <tr>
                <td class="small__font documentos border-left"><strong>CTPS:</strong> {{$trabalhadors->dsctps}}</td>
                <td class="small__font documentos"><strong>Série:</strong> {{$trabalhadors->dsserie}} - {{$trabalhadors->dsuf}}</td>
                <td class="small__font documentos border-right"><strong>Data Emissão:</strong> 99/99/9999</td>
            </tr>

            <tr>
                <td class="small__font documentos border-left"><strong>RG:</strong> 9999999999</td>
                <td class="small__font documentos"><strong>SSP:</strong> SC</td>
                <td class="small__font documentos border-right"><strong>Data Emissão:</strong> 99/99/9999</td>
            </tr>

            <tr>
                <td class="small__font documentos border-left border-bottom"><strong>Estado Cívil:</strong> {{$trabalhadors->nscivil}}</td>
                <td class="small__font documentos border-bottom"><strong>Sexo:</strong> {{$trabalhadors->tssexo}}</td>
                <td class="small__font documentos  border-bottom border-right"></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Endereço</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font border-left rua border-top"><strong>Endereço:</strong>  {{$trabalhadors->eslogradouro}}, {{$trabalhadors->esnum}}</td>
                <td class="small__font uf border-top"><strong>UF:</strong> {{$trabalhadors->esuf}}</td>
                <td class="small__font border-right cep text-center border-top"><strong>CEP:</strong> {{$trabalhadors->escep}}</td>
            </tr>
        </table>
        <table>    
            <tr>
                <td class="small__font cidade border-left border-bottom"><strong>Cidade:</strong> {{$trabalhadors->esmunicipio}}</td>
                <td class="small__font cidade border-bottom"><strong>Natural:</strong> {{$trabalhadors->nsnaturalidade}}</td>
                <td class="small__font border-right cep text-center telefone border-bottom"><strong>Telefone:</strong>{{$trabalhadors->tstelefone}}</td>
            </tr>
        </table>
        
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Filiação</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font afiliacao border-left border-right border-top"><strong>Nome da Mãe:</strong>{{$trabalhadors->tsmae}}</td>
                
            </tr>
            <tr>
                <td class="small__font afiliacao border-left border-right border-bottom"><strong>Nome do Pai:</strong></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Dependentes</td>
            </tr>
        </table>

        <table>
            @if(count($depedentes) > 0)
                @foreach($depedentes as $depedente)
                    <tr>
                        <td class="small__font border-top border-left nome"><strong>Nome: </strong>{{$depedente->dsnome}}</td>
                        <td class="small__font border-right border-top data"><strong>Data de Nascimento: </strong>{{$depedente->dsdata}}</td>
                    </tr>
                @endforeach
            @endif
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Informações Bancárias</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font bancario text-center"><strong>Banco:</strong> {{$trabalhadors->bsbanco}}</td>
                <td class="small__font bancario text-center"><strong>Agência:</strong> {{$trabalhadors->bsagencia}}</td>
                <td class="small__font bancario text-center"><strong>Conta:</strong> {{$trabalhadors->bsconta}}</td>
            </tr>
        </table>

        <table class="assinatura">
            <tr>
                <td class="fontDeclaracao data__ass"> 
                    <?php
                        $today = date("m.d.y"); 
                    ?>
                    Data: {{$today}}
                </td>
                <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
            </tr>
    
            <tr>
                <td class="fontDeclaracao"></td>
                <td class="fontDeclaracao text-center">Assinatura Trabalhador</td>
            </tr>
        </table>
    </body>
</html>