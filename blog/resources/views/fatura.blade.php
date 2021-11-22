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
        font-size:12px
    }

    .text-bold{
        font-weight: bold;
    }

    .space{
        width:60px
    }

    .space-big{
        width:106px;
    }

    .space-bigger{
        width:170px;
    }

    .sub-total{
        width:77px;
    }

    .destaque{
        background-color: rgb(214, 213, 213);
    }

    .small__block{
        width:84.8px;
    }

    .item{
        width:40px;
    }

    .descricao{
        width:365px;
    }

    .unidades{
        width:85px;
    }

    .preco{
        width:90px;
    }

    .total{
        width:91px;
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
    
</style>

<body>
    <table>
          <tr class="">
            <td class="nome__sind text-bold" colspan="3">Sind dos Trab na Mov de Merc em Geral de São José</td>
            <td class="fatura text-bold">Fatura n° 19/20</td>
          </tr>
          
        <tr>
          <td class="border-left"></td>
          <td class=""></td>
          <td class="border-right cnpj small__font text-bold">CNPJ Nro: 0000003005590001.37</td>
          <td class="border-right border-left border-top text-center text-bold">Valor a Pagar</td>
        </tr>

        <tr>
            <td class="border-left"></td>
            <td class=""></td>
            <td class="border-right small__font text-bold">Telefone: (48) 3246-8286</td>
            <td class="border-right border-left price  text-center">R$ 56.657,87</td>
        </tr>

        <tr>
            <td class="border-left"></td>
            <td class="border"></td>
            <td class="border-right small__font">Rua Nossa Senhora Aparecida, 493</td>
            <td class="border-right border-left border-top text-center text-bold">Período</td>
        </tr>

        <tr>
            <td class="border-left"></td>
            <td class=""></td>
            <td class="border-right small__font">CEP: 88133-400 Palhoça - SC</td>
            <td class="border-right border-left text-center">01/05/2020 a 15/05/2020</td>
        </tr>

        <tr>
            <td class="border-left"></td>
            <td class=""></td>
            <td class=" border-right small__font text-bold">Atendimento@sintrammassj.com.br</td>
            <td class="border-right border-left border-top text-center text-bold">Vencimento 15/05/2020</td>
        </tr>

        <tr>
            <td class="border-left border-bottom"></td>
            <td class="border-bottom"></td>
            <td class="border-bottom border-right small__font"></td>
            <td class="border-right border-left border-bottom text-center border-top text-bold small__font">N° da Folha pagto  000000</td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="3" class="nome__empresa border-top border-left text-bold">A Angeloni Cia LTDA Diarias</td>
            <td class="border-right border-top">154</td>
        </tr>

        <tr>
            <td class="border-left small__font">Rod BR 101 Km 156 </td>
            <td class=" small__font"></td>
            <td class="small__font">88210-000 - Porto Belo</td>
            <td class="small__font border-right">SC</td>
        </tr>

        <tr>
            <td class="border-left small__font border-bottom">Telefone (48) 3246-8208</td>
            <td class="small__font border-bottom"></td>
            <td class="small__font border-bottom"></td>
            <td class="border-right small__font border-bottom text-bold">CNPJ - 836469840069.06</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="space-bigger border-left border-top small__font text-bold" colspan="5">Produção</td>
            <td class="space text-center border-top small__font">0,00</td>
            <td class="border-right space-big text-center border-top small__font  text-bold">30.997,79</td>
            <td class="space-bigger border-left border-top small__font text-bold  border-top " colspan="5">INSS Trabalhador</td>
            <td class="space text-center text-bold border-top small__font border-top">0,00</td>
            <td class="border-right space-big text-center border-top small__font border-top  text-bold">3.325,76</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5">RSR</td>
            <td class="space text-center small__font">18,18</td>
            <td class="border-right space-big text-center small__font  text-bold">5.635,40</td>
            <td class="space-bigger border-left small__font text-bold" colspan="5">INSS Empresa</td>
            <td class="space text-center text-bold small__font">20,00</td>
            <td class="border-right space-big text-center small__font  text-bold">8.752,33</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold destaque" colspan="5">A- SUB TOTAL</td>
            <td class="space text-center small__font destaque"></td>
            <td class="border-right space-big text-center small__font destaque  text-bold">36.663,19</td>
            <td class="space-bigger border-left small__font text-bold" colspan="5">INSS Terceiros</td>
            <td class="space text-center text-bold small__font">5,80</td>
            <td class="border-right space-big text-center small__font  text-bold">2.538,18</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5">Férias</td>
            <td class="space text-center small__font">11,12</td>
            <td class="border-right space-big text-center small__font  text-bold">4.073,49</td>
            <td class="space-bigger border-left small__font text-bold" colspan="5">RAT Ajustado</td>
            <td class="space text-center text-bold small__font">2,34</td>
            <td class="border-right space-big text-center small__font  text-bold">1.479,98</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5">13 Salário</td>
            <td class="space text-center small__font">8,34</td>
            <td class="border-right space-big text-center small__font  text-bold">3.055,03</td>
            <td class="space-bigger border-left small__font text-bold destaque border-top border-bottom" colspan="5">Sub Total Encargos INSS</td>
            <td class="space text-center text-bold small__font destaque border-top border-bottom"></td>
            <td class="border-right space-big text-center small__font destaque border-top border-bottom  text-bold">16.096,25</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold destaque" colspan="5">A- SUB TOTAL</td>
            <td class="space text-center small__font destaque"></td>
            <td class="border-right space-big text-center small__font destaque  text-bold">43
                761,71
            </td>
            <td class="space-bigger border-left small__font text-bold text-center border-bottom" colspan="5">FGTS</td>
            <td class="space text-center text-bold small__font border-bottom">8,00</td>
            <td class="border-right space-big text-center small__font border-bottom  text-bold">3.500,93</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5">Ferias Sind</td>
            <td class="space text-center small__font">1,00</td>
            <td class="border-right space-big text-center small__font  text-bold">366,33</td>
            <td class="space-bigger border-left small__font text-center destaque text-bold border-top" colspan="5">Total Bruto</td>
            <td class="space text-center text-bold small__font destaque border-top">R$</td>
            <td class="border-right space-big text-center small__font destaque border-top  text-bold">63.484,58</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold " colspan="5">13 Salário Sind.</td>
            <td class="space text-center small__font ">0,66</td>
            <td class="border-right space-big text-center small__font  text-bold">241,78</td>
            <td class="space-bigger border-left small__font text-bold" colspan="5">Retênção</td>
            <td class="space text-center text-bold small__font">R$</td>
            <td class="border-right space-big text-center small__font  text-bold">6.826,69</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5">Taxa ADM/Trab. Avulso</td>
            <td class="space text-center small__font ">1,990</td>
            <td class="border-right space-big text-center small__font  text-bold">218.70</td>
            <td class="space-bigger small__font border-left text-bold" colspan="5">Adiantamentos</td>
            <td class="space text-center text-bold small__font">R$</td>
            <td class="space-big text-center small__font border-right  text-bold">0,00</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5"></td>
            <td class="space text-center small__font ">0,00</td>
            <td class="border-right space-big text-center small__font  text-bold">0,00</td>
            <td class="space-bigger small__font border-left text-bold" colspan="5">Créditos</td>
            <td class="space text-center text-bold small__font">R$</td>
            <td class="space-big text-center small__font border-right  text-bold">0,00</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5"></td>
            <td class="space text-center small__font ">0,00</td>
            <td class="border-right space-big text-center small__font  text-bold">0,00</td>
            <td class="space-bigger small__font text-center border-left text-bold destaque" colspan="5">Total Líquido</td>
            <td class="space text-center text-bold small__font destaque">R$</td>
            <td class="space-big text-center small__font border-right destaque  text-bold">56.657,89</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5"></td>
            <td class="space text-center small__font ">0,00</td>
            <td class="border-right space-big text-center small__font  text-bold">0,00</td>
            <td class="space-bigger small__font border-left text-bold" colspan="5">Demonstrativo Cálculos INSS</td>
            <td class="space text-center text-bold small__font"></td>
            <td class="space-big text-center small__font border-right"></td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5"></td>
            <td class="space text-center small__font ">0,00</td>
            <td class="border-right space-big text-center small__font text-bold">0,00</td>
            <td class="space-bigger small__font border-left  text-bold" colspan="5">RSR+Férias: 999.999.999,99</td>
            <td class="space text-center text-bold small__font">INSS</td>
            <td class="space-big text-center small__font border-right text-bold">3.096,51</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold" colspan="5"></td>
            <td class="space text-center small__font ">0,00</td>
            <td class="border-right space-big text-center  text-bold small__font">0,00</td>
            <td class="space-bigger small__font border-left border-bottom  text-bold" colspan="5">13° Salário: 999.999.999,99</td>
            <td class="space text-center text-bold small__font border-bottom">INSS</td>
            <td class="space-big text-center small__font border-right border-bottom text-bold">229,25</td>
        </tr>

        <tr>
            <td class="space-bigger border-left  small__font text-bold border-bottom" colspan="5">Federação</td>
            <td class="space text-center small__font border-bottom">1,990</td>
            <td class="border-right space-big text-center small__font border-bottom text-bold">218,70</td>
            <td class="space-bigger small__font text-center destaque text-bold" colspan="5">FOLHA BASE</td>
            <td class="space text-center text-bold small__font destaque"></td>
            <td class="space-big text-center small__font destaque text-bold">30.997,79</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="text-bold small__font destaque border-top border-left border-bottom border-right">SEFIP</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>FPAS:</strong> 515</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>Terceiros:</strong> 0115</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>CNAE:</strong> 4711302</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>FAP:</strong> 1,1700</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>RAT:</strong> 2,0</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>Ajustado:</strong> 2,34</td>
            <td class="space text-center small__font border-top border-left border-bottom border-right small__block"><strong>Trabalhadores:</strong>10000</td>
        </tr>
    </table>
   
    <table>
        <tr>
            <td class="border-right border-left border-bottom border-top item text-center small__font">Item</td>
            <td class="border-right border-left border-bottom border-top descricao text-center small__font">Descrição</td>
            <td class="border-right border-left border-bottom border-top unidades text-center small__font">Unidades</td>
            <td class="border-right border-left border-bottom border-top text-center preco small__font">Preço Unitário</td>
            <td class="border-right border-left border-bottom border-top text-center total small__font">Total</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>

        <tr>
            <td class="text-center border-right border-left small__font">0002</td>
            <td class="descricao small__font">Hora Normal</td>
            <td class="unidades text-center border-right border-left small__font">999.999,00</td>
            <td class="text-center preco small__font border-right border-left">999.999,00</td>
            <td class="text-center total small__font border-right border-left">999.999,00</td>
        </tr>


        <tr>
            <td class="text-center border-left border-bottom"></td>
            <td class="descricao small__font border-bottom text-bold">Total da Produção</td>
            <td class="unidades text-center small__font border-bottom"></td>
            <td class="text-center preco small__font border-bottom"></td>
            <td class="text-center total small__font border-right border-bottom text-bold">999.999.999,00</td>
        </tr>

        
        
    </table>

    <table>
        <tr>
            <td class="Text-bold space-bigger small__font ">Banco:013</td>
            <td class="Text-bold space-bigger small__font ">Agência:0000</td>
            <td class="Text-bold space-bigger small__font ">Conta:00000000-0</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="Text-bold space-bigger small__font ">Data:20/21/2121</td>
            <td class="Text-bold space-bigger small__font ">SINTRAMMASJ</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    

    <table>
        <tr>
            <td class="Text-bold border-bottom assinatura small__font ">Assinatura:</td>
        </tr>
    </table>
</body>
</html>