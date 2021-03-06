<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Crachá</title>
    </head>

    <style>
    
        body{
            font-family:sans-serif;
        }

        *{
            margin: 3px;
            padding: 0px;
        }

        .break{
            word-wrap: break-word;
        }

        .capitalize{
            text-transform: capitalize;
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
            width: 381.75px;
        }

        .assinatura{
            width: 381px;
        }

        .name__title2{
            width: 376px;
            padding-left: 5px;
        }

        .font__trab{
            font-size:11px;
        }

        .border{
            border-color: black;
        }

        .cover{
            color: white;
        }

        .foto2{
            width:55px; 
            height: 55px;
            border-radius: 5px;
        }

        .margin__top{
            padding-top: 10px;
        }

        .margin__bottom{
            padding-bottom: 4px;
        }

        .pad{
            padding-top: 4px;
        }

        .pad2{
            padding-top: 5.1px;
        }

        .padass{
            padding-top: 3.7px;
        }

        .fontnome{
            font-size: 12px;
        }

        .fontnome1{
            font-size: 12px;
        }

        .nome{
            font-size: 13px;
            width: 370px;
        }

        .container{
            display: inline-block;
            
        }

        .div1{
            width: 50%;
            margin-right:10px;
        }

        .div2{
            width: 50%;
            order: 2;
            transform: rotate(180deg);
        }

        .tomador{
            width: 387.5px;
        }

        .foto1{
            width:55px; 
            height: 55px;
        }

        .name__title__trab{
            width: 296px;
        }

        .radius{
            border-radius: 3px;
        }
        
        .width{
             width: 387.5px;
        }
        
        .width2{
             width: 382px;
        }
        
        .padding-left-foto{
            padding-left: 15px;
        }

    </style>

    <body>
        <div class="container">
            <div class="div1 border-bottom border-right border-top border-left width">

                <div class="border-right border-bottom border-left border-top radius">
                    <table class="tomador">
                        <tr>
                            <td class="border" rowspan="3">
                                @if($empresas->esfoto)
                                    <img class="foto1" src="{{$empresas->esfoto}}" alt="" srcset="">
                                @else
                                    @include('imagemCrachaTomador')
                                @endif
                            </td>
                            
                        </tr>

                        <tr>
                            <td class="fontnome1 text-bold">{{$empresas->esnome}}</td>
                        </tr>

                    </table>
                </div>

                <div class="">
                    
                    <table>
                        <tr>
                            <td class="name__title2 font__trab text-center nome destaque">{{$trabalhadors->tsnome}} </td>
                        </tr>
                    </table>

                
                    <table>
                        <tr>
                            <td class="foto1" rowspan="5">
                                @if($empresas->esfoto)
                                    <img class="foto2" src="{{$trabalhadors->tsfoto}}" alt="" srcset="">
                                @else
                                    @include('imagemCrachaTrabalhador')
                                @endif
                                <!--<img class="logo" src="" alt="" srcset="" style="width:55px; height: 55px; padding:5px">-->
                            </td>
                        </tr>

                        <tr>
                            <td class="name__title__trab font__trab pad padding-left-foto">Matrícula:{{$trabalhadors->tsmatricula}}</td>
                        </tr>

                        <tr>
                            <td class="name__title__trab font__trab pad padding-left-foto">CTPS: {{$trabalhadors->documento[0]->dsctps}}  UF: {{$trabalhadors->documento[0]->dsuf}}  Série: {{$trabalhadors->documento[0]->dsserie}}</td>
                        </tr>

                        <tr>
                            <td class="name__title__trab font__trab pad margin__bottom padding-left-foto">Data de Nascimento:
                                
                                {{date('d/m/Y',strtotime($trabalhadors->nascimento[0]->nsnascimento))}}
                            </td>
                        </tr>
                        
                    </table>
                </div>

                <table>
                    <tr>
                        <td class="font__trab text-center assinatura margin__top text-bold">____________________________________________</td>
                    </tr>

                    <tr>
                        <td class="text-center font__trab assinatura text-bold margin__bottom padass">Associado</td>
                    </tr>
                </table>

            </div>

            <div class="div2 border-right border-top border-left border-bottom width">
                <table class="tomador width2">
                    <td rowspan="3" class=" fontnome text-center text-bold destaque break">{{$empresas->esnome}}</td>
                </table>

                <div class="border-right border-bottom border-left border-top radius">
                    <table>
                        <tr>
                            <td class="font__trab name__title2 pad2 capitalize"><strong>Nome da Mãe:</strong> {{$trabalhadors->tsmae}}</td>
                        </tr>

                        <tr>
                            <td class="font__trab  name__title2 pad2"><strong>RG:</strong> {{$trabalhadors->arquivo[0]->dsnumero}}</td>
                        </tr>

                        <tr>
                            <td class="font__trab name__title2 pad2"><strong>CPF:</strong> {{$trabalhadors->tscpf}}</td>
                        </tr>

                        <tr>
                            <td class="font__trab name__title2 pad2"><strong>PIS:</strong> {{$trabalhadors->documento[0]->dspis}}</td>
                        </tr>

                        <tr>
                            <td class="font__trab name__title2 margin__bottom pad2"><strong>Data de Admissão:</strong>
                                
                                {{date('d/m/Y',strtotime($trabalhadors->categoria[0]->csadmissao))}}
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="border-right border-bottom border-left border-top radius">
                    <table>
                        <tr>
                            <td class="font__trab text-center assinatura margin__top text-bold">____________________________________________</td>
                        </tr>

                        <tr>
                            <td class="text-center font__trab assinatura text-bold margin__bottom">Responsavel Sindicato</td>
                        </tr>

                        <tr>
                            <td class="font__trab name__title2"><strong>Telefone:</strong>{{$trabalhadors->tstelefone}}</td>
                        </tr>

                        <tr>
                            <td class="font__trab name__title2 pad2 capitalize"><strong>Rua:</strong> {{$trabalhadors->endereco[0]->eslogradouro}}, {{$trabalhadors->endereco[0]->esnum}}</td>
                        </tr>

                        <tr>
                            <td class="font__trab name__title2 pad2 capitalize margin__bottom"><strong>Cidade:</strong> {{$trabalhadors->endereco[0]->esmunicipio}}  {{$trabalhadors->endereco[0]->esuf}}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

    </body>