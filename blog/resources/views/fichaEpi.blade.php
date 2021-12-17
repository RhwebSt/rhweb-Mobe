<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Ficha de EPI</title>
    </head>

    <style>

        body{
            font-family:sans-serif;
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
            width: 700px;
        }

        .width__padrao{
            width:576px;
        }

        .titulo{
            margin-top:10px;
            margin-bottom: 10px;
        }

        .nome__trab{
            width:598px;
        }

        .matric{
            width: 95px;
        }

        .doc__padrao{
            width:228.5px;
        }

        .cbo{
            width:700px;
        }

        .quant{
            width:40px;
        }

        .descr{
            width:225px;
        }

        .assina{
            width:181px;
        }

        .data{
            width:65px;
        }

        .ca{
            width:55px;
        }

        .tm{
            width: 30px;
        }

        .assinatura{
        margin-top:13px;
        }

        .fontDeclaracao{
        font-size: 14px;
        }

        .data__ass{
        width:150px;
        }

        .linhaass{
        width:545px;
        }

        p{
        text-align: justify;
        }

    </style>

    <body>
       
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$empresas->esnome}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td rowspan="6"><img class="logo" src="{{$empresas->esfoto}}" alt="" srcset="" style="width:80px; height: 80px; padding:10px"></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao"><strong>CNPJ/MF Nroº : {{$empresas->escnpj}}</strong></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao capitalize"><strong>Rua:</strong> {{$empresas->eslogradouro}}, {{$empresas->esnum}} - {{$empresas->escep}}</td>
                
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao capitalize"><strong>Bairro:</strong> {{$empresas->esbairro}} - {{$empresas->esuf}}</td>
                
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
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Termo de Responsabilidade -  EPI: (Equipamento de Proteção Individual)</td>
            </tr>
        </table>

            <h1 class="text-center font text-bold titulo" >Termo de Compromisso</h1>
        <table>
            <tr>
                <td><p>Eu.......................................................................................................................................................... declaro sob minha inteira responsablidade a guarda e conservação dos equipamentos de proteção individual constante nesta ficha-controle e uniforme. Assumo também a responsabilidade de devolvê-los integralmente ou parcialmente, quando solicitado, ou por ocasião de eventual desligamento do quadro de associados. Também estou ciente que, na eventualidade de danificar ou extraviar o equipamento por ato doloso, estarei sujeito a desconto do valor em minha folha de pagamento. Também me comprometo a utilizá-lo de forma correta e de acordo com as intruções de treinamento referentes ao uso correto, guarda, conservação e higienização dos EPI, recebida na presente data, fornecida pela <strong class="uppercase"> {{$empresas->esnome}}</strong>, também estou ciente que a não utilização dos mesmos em minha atividade profissionais, é ato faltoso e passível de punições legais e disciplinares</p></td>
            </tr>
           
        </table>

            <table>
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Identificação do Trabalhador</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom small__font nome__trab text-bold capitalize"> Nome do Trabalhador</td>
                    <td class="border-right border-left border-bottom border-top small__font matric text-center text-bold">Matrícula</td>
                </tr>

                <tr>
                    <td class="border-left border-bottom small__font nome__trab capitalize">{{$trabalhadors->tsnome}}</td>
                    <td class="border-right border-left border-bottom small__font matric text-center"> {{$trabalhadors->tsmatricula}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-right small__font text-bold doc__padrao">CPF: {{$trabalhadors->tscpf}}</td>
                    <td class="border-left border-top border-right small__font text-bold doc__padrao">PIS:  {{$trabalhadors->dspis}}</td>
                    <td class="border-left border-top border-right small__font text-bold doc__padrao">CTPS:{{$trabalhadors->dsctps}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-right small__font text-bold cbo">CBO: {{$trabalhadors->cbo}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font text-bold border-top border-bottom border-left text-center quant">Quant.</td>
                    <td class="small__font text-bold border-top border-bottom border-left text-center descr capitalize">Descrição</td>
                    <td class="small__font text-bold border-top border-bottom border-left text-center tm">TM</td>
                    <td class="small__font text-bold border-top border-bottom border-left text-center ca">CA</td>
                    <td class="small__font text-bold border-top border-bottom border-left text-center data">Dta.Rec</td>
                    <td class="small__font text-bold border-top border-bottom border-left text-center data">Dta.Dev</td>
                    <td class="small__font text-bold border-top border-bottom border-left text-center border-right assina">Assinatura</td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Camiseta</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Calças</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Botina</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Proteção Auricular</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Capacete</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Óculos</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Luvas</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Colete</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Blusa de Frio</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Cinto</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>

                <tr>
                    <td class="small__font text-bold border-bottom border-left text-center quant"></td>
                    <td class="small__font text-bold border-bottom border-left descr">Bermuda</td>
                    <td class="small__font text-bold border-bottom border-left text-center tm"></td>
                    <td class="small__font text-bold border-bottom border-left text-center ca"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center data"></td>
                    <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                </tr>
            </table>

            <table class="assinatura">
                <tr>
                    <td class="fontDeclaracao data__ass">  <?php
                        $today = date("d/m/y"); 
                    ?>
                    Data: {{$today}}</td>
                    
                    <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
                </tr>
        
                <tr>
                    <td class="fontDeclaracao"></td>
                    <td class="fontDeclaracao text-center">Assinatura Trabalhador</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="fontDeclaracao data__ass">{{$trabalhadors->esmunicipio}} - {{$trabalhadors->esuf}}</td>
                </tr>
            </table>


