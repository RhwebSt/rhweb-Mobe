<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/reset.css">
    <title>Document</title>
</head>

<style>

    @page { 
        margin-top: 593px; 
        margin-bottom: 30px;
        margin-left: 10px;
        margin-right: 10px;
    }
    #header { position: fixed; left: 0px; top: -593px; right: 0px; height: 593px; background-color:; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 50px; text-align: end; }
    #footer .page:after { content: counter(page, upper); }

    body{
        font-family:sans-serif;
    }

    table{
        border-collapse: collapse;
    }

    .nome__sind {
        width:500px;
        border-top: 1px solid;
        border-right: 1px solid;
        border-left: 1px solid;
    }

    .nome__empresa{
        width:1100px;
        font-size: 16px;
        text-transform: uppercase;

    }

    .fatura{
        border-top: 1px solid;
        border-right: 1px solid;
        border-left: 1px solid;
        text-align: center;
    }


    .cnpj{
        width: 220px;
    }

    .price{
        font-size:20px;
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
        font-size:11px;
    }

    .text-bold{
        font-weight: bold;
    }

    .space{
        width:60px;
    }

    .space-big{
        width:106px;
    }

    .space-bigger{
        width:196px;
    }

    .sub-total{
        width:77px;
    }

    .destaque{
        background-color: rgb(214, 213, 213);
    }

    .destaqueDark{
        background-color: rgb(168, 168, 168);
    }

    .small__block{
        width:93.9px;
    }

    .item{
        width:43px;
    }

    .item2{
        width:44px;
    }

    .descricao{
        width:420px;
    }
    .descricao2{
        width:421px;
    }

    .unidades{
        width:85px;
    }

    .preco{
        width:90px;
    }

    .total{
        width:99px;
    }


    .agencia{
        width:60px;
    }

    .conta{
        width:60px;
    }
    .data{
        width:100px;
    }

    .assinatura{
        width:600px;
    }

    .empresa{
        width:765px;
    }

    .num__fat{
        width:100px;
    }

    .width__padrao{
        width:475px;
    }

    .dissapear{
        color:white;
    }

    .font__destak{
        font-size: 15px;
    }

    .logo{
        width:100px;
        height:100px;
    }

    td{
        padding-left: 5px;
    }

    .last{
        width:145px;
    }

    .padr{
        width:250.3px;
    }

    .cep{
        width:222px;
    }

    .footer{
        width:251px;
    }

    .margin-top{
        margin-top:25px;
    }

    .fontDeclaracao{
        font-size: 14px;
    }

    .data{
        width: 200px;
    }

    .borderT{
        border: 1px solid black;
        border-radius: 3px;
        width: 771px;
    }
    
    .margin-top{
        margin-top: 10px;
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

    .margin-bottom{
            margin-bottom: 10px;
        }

    .producao{
        width: 200px;
    }

    .dsr{
        width: 200px;
    }

    .indice{
        width: 40px;
    }

    .vlr{
        width: 125px;
    }

    .sefip{
        width: 43px;
    }

    .padding-footer{
        padding: 2px;
        width:770px;
    }
</style>

<body>

    <div id="header">
        <table class="margin-top">
            <tr>
                <td class="empresa border-top border-left border-right border-bottom destaque text-center text-bold">{{$empresas->esnome}}</td>
            </tr>
        </table>

        <div class="borderT margin-top margin-bottom">
        <table >
            <tr>
                <td rowspan="10"><img class="logo" src="{{$empresas->esfoto}}" alt="" srcset=""></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao border-right margin-left"></td>
                <td class="small__font border-top text-center border-left border-right text-bold last">Fatura N° 999999</td>
            </tr>

            <tr class="teste">
                <td></td>
                <td></td>
                <td> </td>
                <td class="small__font width__padrao border-right"><strong>CNPJ/MF Nroº : {{$empresas->escnpj}}</strong></td>
                <td class="small__font border-top text-center border-left border-right font__destak text-bold last destaque">Valor a Pagar</td>
            </tr>

            <tr  class="teste">
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao  border-right"><strong>Rua:</strong> {{$empresas->eslogradouro}}, {{$empresas->esnum}} </td>
                <td class="small__font border-bottom text-center border-left border-right font__destak text-bold last destaque">R$ 999.999.999,99</td>
                
            </tr>

            <tr  class="teste">
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao  border-right"><strong>Bairro:</strong> {{$empresas->esbairro}}</td>
                <td class="small__font text-center text-bold border-right border-left last">Período</td>
                
            </tr>

            <tr class="teste">
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao  border-right"><strong>Tel:</strong> {{$empresas->estelefone}}</td>
                <td class="small__font  border-right border-left border-bottom text-center last">00/00/0000 a 00/00/0000</td>
            </tr>

            <tr class="teste">
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao  border-right"><strong>CEP:</strong>  {{$empresas->escep}} - {{$empresas->esuf}}</td>
                <td class="small__font  border-right border-left border-bottom text-center text-bold last">Vencimento 00/00/0000</td>
            </tr>

            <tr class="teste">
                <td></td>
                <td></td>
                <td></td>
                <td class="small__font width__padrao  border-right"><strong>Email:</strong>{{$empresas->esemail}}</td>
                <td class="small__font border-right border-left border-bottom text-center text-bold last">Nº Folha pgto: 00000</td>
            </tr>

        </table>    

    </div>

        <table>
            <tr>
                <td class="empresa border-top border-left border-right border-bottom destaque text-center text-bold">{{$tomadores->tsnome}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-bottom border-right border-left border-top small__font padr"><strong>Matrícula:</strong> {{$tomadores->tsmatricula}}</td>
                <td class="border-bottom border-right border-left border-top small__font padr"><strong>CNPJ:</strong> {{$tomadores->tscnpj}}</td>
                <td class="border-bottom border-right border-left border-top small__font padr"><strong>Telefone: </strong>{{$tomadores->tstelefone}}</td>
            </tr>

            <tr>
                <td class="border-bottom border-right border-left border-top small__font cep"><strong>CEP:</strong> {{$tomadores->escep}}</td>
                <td class="border-bottom border-right border-left border-top small__font padr"><strong>Cidade:</strong>{{$tomadores->esmunicipio}}</td>
                <td class="border-bottom border-right border-left border-top small__font padr"><strong>UF: </strong>{{$tomadores->esuf}}</td>
            </tr>
        </table>


        <table>
            <tr>
                <td class="border-top border-right border-bottom small__font border-left empresa"><strong>Endereço: </strong>{{$tomadores->eslogradouro}}, {{$tomadores->esnum}}</td>
            </tr>
        </table>
        
        <table class="margin-top">
            <tr>
                <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[0]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[0]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[0]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">INSS Trabalhador</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[1]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[1]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[1]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">FGTS</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaque">A - SubTotal </td>
                <td class="small__font border-bottom border-top indice  text-center destaque"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaque">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaque">Total Bruto</td>
                <td class="small__font border-bottom border-top indice  text-center destaque"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaque">R$ 999.999.999,99</td>
            </tr>

            <tr>
            <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[2]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[2]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[2]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Retênção</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
            </tr>

            <tr>
            <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[3]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[3]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[3]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Adiantamentos</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaque">B - SubTotal </td>
                <td class="small__font border-bottom border-top indice  text-center destaque"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaque">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Créditos</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
            </tr>

            <tr>
            <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[4]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[4]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[4]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaque">Total Líquido</td>
                <td class="small__font border-bottom border-top indice  text-center destaque"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaque">R$ 999.999.999,99</td>
            </tr>

            <tr>
            <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[5]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[5]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[5]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaqueDark"></td>
                <td class="small__font border-bottom border-top indice  text-center destaqueDark"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaqueDark"></td>
                
            </tr>

            <tr>
            <td class="small__font border-bottom border-left border-right border-top producao text-bold">{{$faturaprincipais[6]->dsdescricao}}</td>
                <td class="small__font border-bottom border-left border-right border-top indice text-center">{{number_format((float)$faturaprincipais[6]->fiindece, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ {{number_format((float)$faturaprincipais[6]->fivalor, 2, ',', '.')}}</td>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaqueDark"></td>
                <td class="small__font border-bottom border-top indice  text-center destaqueDark"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaqueDark"></td>
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Vale Transporte</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left  border-top text-bold dsr text-center">Demonstrativo Evento S - 1270</td>
                <td class="small__font border-bottom  border-top indice  text-center"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold"></td>
                
                
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Vale Alimentação</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Produção + Dsr 18,18% + Férias</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center"></td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                
                
                
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr"></td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr"> Base Cálculo 13º Salário</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center"></td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                
                
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr"></td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr"> Base Cálculo FGTS</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center"></td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr"></td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">00,00</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr"> INSS Trabalhador</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center"></td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                
            </tr>

            <tr>
                <td class="small__font border-bottom border-left border-right border-top text-bold dsr">Federação</td>
                <td class="small__font border-bottom border-left border-right border-top indice  text-center">1,99</td>
                <td class="small__font border-bottom border-left border-right border-top vlr text-center text-bold">R$ 999.999.999,99</td>
                <td class="small__font border-bottom border-left border-top text-bold dsr destaque">Folha Base</td>
                <td class="small__font border-bottom border-top indice  text-center destaque"></td>
                <td class="small__font border-bottom border-right border-top vlr text-center text-bold destaque">R$ 999.999.999,99</td>
            </tr>
        </table>
        

        <table class="margin-top">
            <tr>
                <td class="text-bold small__font destaque border-top border-left border-bottom border-right text-center sefip">SEFIP</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>FPAS:</strong> {{$tomadores->psfpas}}</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>Terceiros:</strong> {{$tomadores->psfpasterceiros}}</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>CNAE:</strong> {{$tomadores->pscnae}}</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>FAP:</strong> {{$tomadores->psfapaliquota}}</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>RAT:</strong> {{$tomadores->psconfpas}}</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>Ajustado:</strong> {{$tomadores->psratajustados}}</td>
                <td class="text-center small__font border-top border-left border-bottom border-right small__block"><strong>Trabalhadores:</strong>10000</td>
            </tr>
        </table>
    
        <table class="margin-top">
            <tr>
                <td class="border-right border-left border-bottom border-top item text-center small__font destaque text-bold">Item</td>
                <td class="border-right border-left border-bottom border-top descricao text-center small__font destaque text-bold">Descrição</td>
                <td class="border-right border-left border-bottom border-top unidades text-center small__font destaque text-bold">Unidades</td>
                <td class="border-right border-left border-bottom border-top text-center preco small__font destaque text-bold">Preço Unitário</td>
                <td class="border-right border-left border-bottom border-top text-center total small__font destaque text-bold">Total</td>
            </tr>
        </table>
    </div>

    <div id="footer">
        <p class="page destaque borderT padding-footer">Página:  </p>
    </div>

    <div id="content">
        <table>

            <tr>
                <td class="text-center border-right border-left small__font item">0002</td>
                <td class="descricao2 small__font">Hora Normal</td>
                <td class="unidades text-center border-right border-left small__font">999.999.999,00</td>
                <td class="text-center preco small__font border-right border-left">999.999.999,00</td>
                <td class="text-center total small__font border-right border-left">999.999.999,00</td>
            </tr>


            <tr>
                <td class="text-center border-left border-bottom border-top destaque"></td>
                <td class="descricao small__font border-bottom text-bold border-top destaque">Total da Produção</td>
                <td class="unidades text-center small__font border-bottom border-top destaque"></td>
                <td class="text-center preco small__font border-bottom border-top destaque"></td>
                <td class="text-center total small__font border-right border-bottom text-bold border-top destaque">999.999.999,00</td>
            </tr>

            
            
        </table>

        <table class="margin-top">
            <tr>
                <td class="small__font text-center footer"><strong>Banco:</strong> {{$tomadores->bsbanco}}</td>
                <td class="small__font text-center footer"><strong>Agência:</strong> {{$tomadores->bsagencia}}</td>
                <td class="small__font text-center footer"><strong>Conta:</strong> {{$tomadores->bsconta}}</td>
            </tr>
        </table>

        <div class="borderT margin-top">
            <table class="assinatura">
                <tr>
                    <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
                </tr>
        
                <tr>
                    <td class="fontDeclaracao text-center">Assinatura</td>
                </tr>
            </table>

            <table class="margin-top">
                <tr>
                <td class="fontDeclaracao data__ass  text-center cidade">{{date("d/m/y")}}</td>
                    <td class="fontDeclaracao data__ass  text-center cidade">{{$empresas->esmunicipio}} - {{$empresas->esuf}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>