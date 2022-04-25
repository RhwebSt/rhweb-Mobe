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

        .width__padrao{
            width:576px;
        }

        .titulo{
            margin-top:10px;
            margin-bottom: 10px;
        }

        .nome__trab{
            width:656.5px;
        }

        .matric{
            width: 95px;
        }

        .doc__padrao{
            width:248.4px;
        }

        .cbo{
            width:757px;
        }

        .quant{
            width:50px;
        }

        .descr{
            width:250px;
        }

        .assina{
            width:190px;
        }

        .data{
            width:65px;
        }

        .ca{
            width:55px;
        }

        .tm{
            width: 49px;
        }

        p{
        text-align: justify;
        }
        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
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
        
        .padding-right{
            padding-right: 10px;
        }

    </style>

    <body>
       
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$empresas->esnome}}</td>
            </tr>
        </table>
        
        <div class="borderT">
            <table >
                <tr>
                    <td rowspan="6">
                        @if($empresas->esfoto)
                            <img class="logo" src="{{$empresas->esfoto}}" alt="" srcset="" style="width:80px; height: 80px; padding:10px">
                        @else
                            @include('imagem')
                        @endif
                    </td>
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
                    <td class="small__font width__padrao capitalize"><strong>Rua:</strong> {{$empresas->endereco[0]->eslogradouro}}, {{$empresas->endereco[0]->esnum}} - {{$empresas->endereco[0]->escep}}</td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Bairro:</strong> {{$empresas->endereco[0]->esbairro}} - {{$empresas->endereco[0]->esuf}}</td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Tel:</strong> {{$empresas->estelefone}}</td>
                </tr>
    
            </table>
        </div>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Termo de Responsabilidade -  EPI: (Equipamento de Proteção Individual)</td>
            </tr>
        </table>

            <h1 class="text-center font text-bold titulo" >Termo de Compromisso</h1>
        <div class="borderT padding-right">
            <table>
                <tr>
                    <td><p>Eu.......................................................................................................................................................... declaro sob minha inteira responsablidade a guarda e conservação dos equipamentos de proteção individual constante nesta ficha-controle e uniforme. Assumo também a responsabilidade de devolvê-los integralmente ou parcialmente, quando solicitado, ou por ocasião de eventual desligamento do quadro de associados. Também estou ciente que, na eventualidade de danificar ou extraviar o equipamento por ato doloso, estarei sujeito a desconto do valor em minha folha de pagamento. Também me comprometo a utilizá-lo de forma correta e de acordo com as intruções de treinamento referentes ao uso correto, guarda, conservação e higienização dos EPI, recebida na presente data, fornecida pela <strong class="uppercase"> {{$empresas->esnome}}</strong>, também estou ciente que a não utilização dos mesmos em minha atividade profissional, é ato faltoso e passível de punições legais e disciplinares.</p></td>
                </tr>
               
            </table>
        </div>

            <table>
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Identificação do Trabalhador</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom small__font nome__trab text-bold capitalize destaque"> Nome do Trabalhador</td>
                    <td class="border-right border-left border-bottom border-top small__font matric text-center text-bold destaque">Matrícula</td>
                </tr>

                <tr>
                    <td class="border-left border-bottom small__font nome__trab capitalize">{{$trabalhadors->tsnome}}</td>
                    <td class="border-right border-left border-bottom small__font matric text-center"> {{$trabalhadors->tsmatricula}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-right border-bottom small__font text-bold doc__padrao text-center">CPF: {{$trabalhadors->tscpf}}</td>
                    <td class="border-left border-top border-right border-bottom small__font text-bold doc__padrao text-center">PIS:  {{$trabalhadors->documento[0]->dspis}}</td>
                    <td class="border-left border-top border-right border-bottom small__font text-bold doc__padrao text-center">CTPS:{{$trabalhadors->documento[0]->dsctps}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-right border-bottom small__font text-bold cbo">CBO: {{$trabalhadors->categoria[0]->cbo}}</td>
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
                @foreach($trabalhadors->epi as $epi_valor) 
                    <tr>
                        <td class="small__font text-bold border-bottom border-left text-center quant">{{$epi_valor->eiquantidade}}</td>
                        <td class="small__font text-bold border-bottom border-left descr">{{$epi_valor->esdescricao}}</td>
                        <td class="small__font text-bold border-bottom border-left text-center tm">{{$epi_valor->estm}}</td>
                        <td class="small__font text-bold border-bottom border-left text-center ca">{{$epi_valor->eica}}</td>
                        <td class="small__font text-bold border-bottom border-left text-center data">
                            @if($epi_valor->esdatares)
                               
                                {{date('d/m/Y',strtotime($epi_valor->esdatares))}}
                            @endif
                        </td>
                        <td class="small__font text-bold border-bottom border-left text-center data">
                            @if($epi_valor->esdatadev)
                               
                                 {{date('d/m/Y',strtotime($epi_valor->esdatadev))}}
                            @endif
                        </td>
                        <td class="small__font text-bold border-bottom border-left text-center border-right assina"></td>
                    </tr>
                @endforeach
                <!-- <tr>
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
                </tr> -->
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
                    <td class="fontDeclaracao data__ass  text-center cidade">{{$empresas->endereco[0]->esmunicipio}} - {{$empresas->endereco[0]->esuf}}</td>
                        <td class="fontDeclaracao data__ass  text-center cidade">Data: {{date("d/m/y")}}</td>
                    </tr>
                </table>
            </div>

            


