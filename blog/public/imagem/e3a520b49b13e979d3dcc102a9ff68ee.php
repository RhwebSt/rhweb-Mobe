<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Comprovante de Pagamento</title>
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

    .tomador{
        width:550px;
        text-transform: uppercase;
    }

    .cnpj{
        width:150px;
        text-transform: uppercase;
    }

    .title-recibo{
        width:500px;
        text-transform: uppercase;
    }

    .title-nome{
        width:500px;
        text-transform: uppercase;
    }

    .matric{
        width:100px;
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
        width:362px;
    }

    .referencia{
        width: 90px;
    }

    .vencimentos{
        width: 90px;
    }

    .descontos{
        width: 90px;
    }

    .tipoTrab{
        width: 512px;
    }

    .total__vencimentos{
        width: 90px;
    }

    .total__descontos{
        width: 90px;
    }

    .servicosbase{
        width: 87px;
    }

    .servrsr{
        width: 87px;
    }

    .bainss{
        width: 85px;
    }

    .bafgts{
        width: 87px;
    }

    .fgtsmes{
        width: 87px;
    }

    .bairrf{
        width: 87px;
    }

    .fairrf{
        width: 87px;
    }

    .num__filho{
        width: 60px;
    }

    .fontDeclaracao{
        font-size: 14px;
    }

    .declaracao{
        width: 702px;
    }

    .data{
        width:150px;
    }

    .assinatura{
        margin-top:50px;
    }

    .linhaass{
        width:548px;
    }

    .titlename{
        font-size: 14px;
    }
</style>

<body>
    <table>
        <tr>
            <td class="border-top border-left tomador small__font text-bold">Mobe Prestadora de Serviços LTDA</td>
            <td class="border-top border-right small__font text-bold cnpj text-center">CNPJ: 999999999-99</td>
        </tr>

        <tr>
            <td class=" border-left title-recibo text-bold border-bottom titlename">RECIBO DE PAGAMENTO DE SALÁRIO</td>
            <td class=" border-right small__font text-bold text-center border-bottom">Comp: Outubro - 2021</td>
        </tr>

        <tr>
            <td class=" border-left title-nome text-bold border-bottom destaque titlename">Eliel Felipe dos Santos Rocha</td>
            <td class=" border-right small__font text-bold text-center border-bottom destaque"></td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font matric border-left text-center border-bottom"><strong>Matric:</strong> 9999</td>
            <td class="small__font cpf border-left text-center border-bottom"><strong>CPF:</strong> 999.999.999-99</td>
            <td class="small__font pis border-left text-center border-bottom"><strong>PIS:</strong> 999999999-99</td>
            <td class="small__font cbo border-left border-right text-center border-bottom"><strong>CBO:</strong> 9999999</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left cod text-center text-bold border-bottom">Cod.</td>
            <td class="small__font border-left text-center descricao text-bold border-bottom">Descrição</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">Referência %</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">Vencimentos</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">Descontos</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">Horas Normais</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">HE 50%</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">Adc.Noturno S/H Normal</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">Gratificação</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">RSR 18,18%</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">INSS</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">Seguro</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">Ferias + 1/3</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">13º Salário</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center">9999</td>
            <td class="small__font border-left descricao">INSS Sobre 13º Salário</td>
            <td class="small__font border-left text-center referencia text-bold">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold">999.999.999,99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top tipoTrab">Trabalhador Intermitente Conforme a Lei 13.467/2017</td>
            <td class="small__font border-left text-bold border-top total__vencimentos text-center destaque border-bottom border-right">Total.Venc</td>
            <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total.Desc</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab">Dispõe sobre atividades de trabalhadores categoria 04 Intermitentes</td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaque border-bottom border-right">999.999.999,99</td>
            <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaqueDark border-top border-bottom">Valor Líquido</td>
            <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom">999.999.999,99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top servicosbase text-center">Serviços</td>
            <td class="small__font border-left border-top servrsr text-center">Serviços+RSR</td>
            <td class="small__font border-left border-top bainss text-center">Base INSS</td>
            <td class="small__font border-left border-top bafgts text-center">Base FGTS</td>
            <td class="small__font border-left border-top fgtsmes text-center">FGTS Mês</td>
            <td class="small__font border-left border-top bairrf text-center">Base IRRF</td>
            <td class="small__font border-left border-top fairrf text-center">Faixa IRRF</td>
            <td class="small__font border-left border-right border-top num__filho text-center">Num.Filho</td>
        </tr>

        <tr>
            <td class="little__font border-left border-top border-bottom servicosbase text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom servrsr text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom bainss text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom bafgts text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom fgtsmes text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom bairrf text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom fairrf text-center destaque">999.999.999,99</td>
            <td class="little__font border-left border-right border-bottom border-top num__filho text-center destaque">99</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="declaracao fontDeclaracao border-top border-left border-right">Declaro ter recebido a importância líquida neste recibo do periodo <strong>01/10/2021</strong>  a <strong>30/10/2021<strong> </td>
        </tr>

        <tr>
            <td class="declaracao fontDeclaracao  border-left border-right">Deposito: Banco: <strong>9999</strong> Agência: <strong>99999</strong> Operação:<strong>0000</strong> Conta: <strong>999999</strong></td>
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