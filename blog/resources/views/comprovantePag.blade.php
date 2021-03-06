<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Comprovante de Pagamento</title>
</head>

<style>
    *{
        margin: 5px;
        padding: 0px;
    }
    
    td{
        padding-left:5px;
    }

    table{
        border-collapse: collapse;
    }

    body{
        font-family:sans-serif;
    }
    
    .uppercase{
        text-transform: uppercase;
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

    .tomador{
        width:550px;
        text-transform: uppercase;
    }

    .cnpj{
        width:150px;
        text-transform: uppercase;
    }

    .title-recibo{
        width:300px;
    }

    .title-nome{
        width:500px;
        text-transform: uppercase;
    }

    .matric{
        width:159px;
    }

    .cpf{
        width:200px;
    }

    .pis{
        width:188px;
    }

    .cbo{
        width:200px;
    }

    .destaque{
        background-color: rgb(214, 213, 213);
    }

    .destaqueDark{
        background-color: rgb(168, 168, 168);
    }

    .cod{
        width:50px;
    }

    .descricao{
        width:351.5px;
    }

    .referencia{
        width: 120px;
    }

    .vencimentos{
        width: 120px;
    }

    .descontos{
        width: 100px;
    }

    .tipoTrab{
        width: 533px;
    }

    .total__vencimentos{
        width: 119px;
    }

    .total__descontos{
        width: 100px;
    }

    .servicosbase{
        width: 94px;
    }

    .servrsr{
        width: 94px;
    }

    .bainss{
        width: 94px;
    }

    .bafgts{
        width: 94px;
    }

    .fgtsmes{
        width: 94px;
    }

    .bairrf{
        width: 94px;
    }

    .fairrf{
        width: 94px;
    }

    .num__filho{
        width: 67px;
    }

    .fontDeclaracao{
        font-size: 14px;
    }

    .declaracao{
        width: 763.5px;
    }

    .data{
        width:150px;
    }

    .assinatura{
        margin-top:50px;
    }

    .linhaass{
        width:608.5px;
    }

    .titlename{
        font-size: 14px;
    }
    
    .name__title{
        width: 763px;
    }
    
    .comp{
        width: 250px;
    }
    
    .cnpj{
        width: 203px;
    }
    
    .font__trab{
        font-size:14px;
    }

</style>

<body>
    
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">Mobe Prestadora de Servi??os LTDA</td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="border-left title-recibo text-bold border-bottom border-top titlename">RECIBO DE PAGAMENTO DE SAL??RIO</td>
            <td class=" small__font text-bold text-center border-top border-bottom comp">Compet??ncia: Outubro - 2021</td>
            <td class="border-top border-right small__font text-bold cnpj text-center border-bottom cnpj">CNPJ: 999999999-99</td>
        </tr>

    </table>
    
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">Eliel Felipe dos Santos Rocha</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font matric border-left text-center border-bottom border-top"><strong>Matr??cula:</strong> 9999</td>
            <td class="small__font cpf border-left text-center border-bottom border-top"><strong>CPF:</strong> 999.999.999-99</td>
            <td class="small__font pis border-left text-center border-bottom border-top"><strong>PIS:</strong> 999999999-99</td>
            <td class="small__font cbo border-left border-right text-center border-bottom border-top"><strong>CBO:</strong> 9999999</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left cod text-center text-bold border-bottom border-top destaque">Cod.</td>
            <td class="small__font border-left text-center descricao text-bold border-bottom border-top destaque">Descri????o</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom border-top destaque">Refer??ncia %</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom border-top destaque">Vencimentos</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom border-top destaque">Descontos</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">Horas Normais</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">HE 50%</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">Adc.Noturno S/H Normal</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">Gratifica????o</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">RSR 18,18%</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">INSS</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">Seguro</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">Ferias + 1/3</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">13?? Sal??rio</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">INSS Sobre 13?? Sal??rio</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top tipoTrab">Trabalhador Intermitente Conforme a Lei 13.467/2017</td>
            <td class="small__font border-left text-bold border-top total__vencimentos text-center destaque border-bottom border-right">Total Vencimento</td>
            <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total Desconto</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab">Disp??e sobre atividades de trabalhadores categoria 04 Intermitentes</td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaque border-bottom border-right">999.999.999,99</td>
            <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaqueDark border-top border-bottom">Valor L??quido</td>
            <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom">999.999.999,99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top servicosbase text-center  destaque">Servi??os</td>
            <td class="small__font border-left border-top servrsr text-center destaque">Servi??os+RSR</td>
            <td class="small__font border-left border-top bainss text-center destaque">Base INSS</td>
            <td class="small__font border-left border-top bafgts text-center destaque">Base FGTS</td>
            <td class="small__font border-left border-top fgtsmes text-center destaque">FGTS M??s</td>
            <td class="small__font border-left border-top bairrf text-center destaque">Base IRRF</td>
            <td class="small__font border-left border-top fairrf text-center destaque">Faixa IRRF</td>
            <td class="small__font border-left border-right border-top num__filho text-center destaque">Num.Filho</td>
        </tr>

        <tr>
            <td class="little__font border-left border-top border-bottom servicosbase text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom servrsr text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom bainss text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom bafgts text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom fgtsmes text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom bairrf text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom fairrf text-center">999.999.999,99</td>
            <td class="little__font border-left border-right border-bottom border-top num__filho text-center">99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="declaracao fontDeclaracao border-top border-left border-right">Declaro ter recebido a import??ncia l??quida neste recibo do periodo <strong>01/10/2021</strong>  a <strong>30/10/2021<strong> </td>
        </tr>

        <tr>
            <td class="declaracao fontDeclaracao  border-left border-right">Deposito: Banco: <strong>9999</strong> Ag??ncia: <strong>99999</strong> Opera????o:<strong>0000</strong> Conta: <strong>999999</strong></td>
        </tr>
    </table>

    <table>
        <tr class="assinatura">
            <td class="fontDeclaracao data border-left">Data: 00/00/0000</td>
            <td class="fontDeclaracao border-right linhaass text-center">__________________________________________________</td>
        </tr>

        <tr class="assinatura">
            <td class="fontDeclaracao border-left border-bottom"></td>
            <td class="fontDeclaracao text-center border-right border-bottom">Assinatura Trabalhador</td>
        </tr>
    </table>
</body>
</html>