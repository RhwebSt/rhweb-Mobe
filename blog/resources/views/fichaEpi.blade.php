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
            width: 100px;
            height: 100px;
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
            width:556px;
        }

        .matric{
            width: 182px;
        }

        .doc__padrao{
            width:182px;
        }

        .cbo{
            width:757px;
        }

        .quant{
            width:50px;
        }

        .descr{
            width:235px;
        }

        .assina{
            width:194px;
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
        margin-top:30px;
        }

        .fontDeclaracao{
        font-size: 14px;
        }

        .data__ass{
            width:372.5px;
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
        
        .padding-left-foto{
            padding-left: 20px;
        }
        
        .margin-top{
            margin-top: 8px;
        }
        
        .margin-bottom--title{
            margin-bottom: 4px;
        }
        
        .margin__compromisso{
            margin-top: 40px;
        }
        
        .padding-border{
            margin-top: 10px;
        }
        
        .padding-border-bottom{
            margin-bottom: 10px;
        }
        
        .cpf{
            width:150px;
        }

    </style>

    <body>

        <div class="borderT margin-top">
            <table >
                <tr>
                    <td rowspan="7">
                        @if($empresas->esfoto)
                            <img class="logo" src="{{$empresas->esfoto}}" alt="" srcset="" style="width:80px; height: 80px; padding:10px">
                        @else
                            @include('imagem')
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td class="width__padrao padding-left-foto text-bold margin-bottom--title">{{$empresas->esnome}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$empresas->escnpj}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">Rua: {{$empresas->endereco[0]->eslogradouro}}, {{$empresas->endereco[0]->esnum}} - {{$empresas->endereco[0]->escep}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">Bairro: {{$empresas->endereco[0]->esbairro}} - {{$empresas->endereco[0]->esuf}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">Tel: {{$empresas->estelefone}}</td>
                </tr>
    
            </table>
        </div>
        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Termo de Responsabilidade -  EPI: (Equipamento de Proteção Individual)</td>
                </tr>
            </table>
        </div>

        <div class="margin-top">
            <h1 class="text-center font text-bold margin__compromisso" >Termo de Compromisso</h1>
            <div class="padding-right">
                <table>
                    <tr>
                        <td><p>Eu................................................................................................................................................................ declaro sob minha inteira responsablidade a guarda e conservação dos equipamentos de proteção individual constante nesta ficha-controle e uniforme. Assumo também a responsabilidade de devolvê-los integralmente ou parcialmente, quando solicitado, ou por ocasião de eventual desligamento do quadro de associados. Também estou ciente que, na eventualidade de danificar ou extraviar o equipamento por ato doloso, estarei sujeito a desconto do valor em minha folha de pagamento. Também me comprometo a utilizá-lo de forma correta e de acordo com as intruções de treinamento referentes ao uso correto, guarda, conservação e higienização dos EPI, recebida na presente data, fornecida pela <strong>{{$empresas->esnome}}</strong>, também estou ciente que a não utilização dos mesmos em minha atividade profissional, é ato faltoso e passível de punições legais e disciplinares.</p></td>
                    </tr>
                   
                </table>
            </div>
        </div>

        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Identificação do Trabalhador</td>
                </tr>
            </table>
        </div>

        <div class="margin-top borderT">
            <table class="padding-border">
                <tr>
                    <td class="small__font nome__trab text-bold destaque text-center margin-bottom--title"> Nome do Trabalhador</td>
                    <td class="small__font matric text-center text-bold destaque">Matrícula</td>
                    
                </tr>
    
                <tr>
                    <td class="small__font nome__trab text-center">{{$trabalhadors->tsnome}}</td>
                    <td class="small__font matric text-center"> {{$trabalhadors->tsmatricula}}</td>
                    
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font text-center doc__padrao text-bold destaque ">CPF</td>
                    <td class="small__font text-bold doc__padrao text-center destaque">CBO</td>
                    <td class="small__font text-bold doc__padrao text-center destaque">PIS</td>
                    <td class="small__font text-bold doc__padrao text-center destaque">CTPS</td>
                </tr>
                
                <tr>
                    <td class="small__font doc__padrao text-center cpf">{{$trabalhadors->tscpf}}</td>
                    <td class="small__font doc__padrao text-center">{{$trabalhadors->categoria[0]->cbo}}</td>
                    <td class="small__font doc__padrao text-center">{{$trabalhadors->documento[0]->dspis}}</td>
                    <td class="small__font doc__padrao text-center">{{$trabalhadors->documento[0]->dsctps}}</td>
                </tr>
            </table>

        </div>
        
        <div class="margin-top borderT">

            <table class="padding-border padding-border-bottom">
                <tr>
                    <td class="small__font text-bold text-center destaque quant">Quant.</td>
                    <td class="small__font text-bold text-center destaque descr">Descrição</td>
                    <td class="small__font text-bold text-center destaque tm">TM</td>
                    <td class="small__font text-bold text-center destaque ca">CA</td>
                    <td class="small__font text-bold text-center destaque data">Dta.Rec</td>
                    <td class="small__font text-bold text-center destaque data">Dta.Dev</td>
                    <td class="small__font text-bold text-center destaque assina">Assinatura</td>
                </tr>
                @foreach($trabalhadors->epi as $epi_valor) 
                    <tr>
                        <td class="small__font text-center border-bottom quant">{{$epi_valor->eiquantidade}}</td>
                        <td class="small__font text-center border-bottom descr">{{$epi_valor->esdescricao}}</td>
                        <td class="small__font text-center border-bottom tm">{{$epi_valor->estm}}</td>
                        <td class="small__font text-center border-bottom ca">{{$epi_valor->eica}}</td>
                        <td class="small__font text-center border-bottom data">
                            @if($epi_valor->esdatares)
                               
                                {{date('d/m/Y',strtotime($epi_valor->esdatares))}}
                            @endif
                        </td>
                        <td class="small__font text-center border-bottom data">
                            @if($epi_valor->esdatadev)
                               
                                 {{date('d/m/Y',strtotime($epi_valor->esdatadev))}}
                            @endif
                        </td>
                        <td class="small__font text-center border-bottom assina"></td>
                    </tr>
                    
                    
                @endforeach
               
            </table>
        </div>
            
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
                    <td class="fontDeclaracao data__ass  text-center">{{$empresas->endereco[0]->esmunicipio}} - {{$empresas->endereco[0]->esuf}}</td>
                        <td class="fontDeclaracao data__ass  text-center">Data: {{date("d/m/y")}}</td>
                    </tr>
                </table>
            </div>

            


