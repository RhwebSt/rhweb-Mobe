<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Comprovante de Pagamento por dia</title>
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

    .prodDia{
        width:702px;
    }

    .valor{
        width: 134.7px;
    }

    .dia{
        width: 46.5px;
    }
    
    .name__title{
        width: 763.5px;
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
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$empresas->esnome}}</td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="border-left title-recibo text-bold border-bottom border-top titlename">RECIBO DE PAGAMENTO DE SALÁRIO</td>
            <td class=" small__font text-bold text-center border-top border-bottom comp">Competência: Outubro - 2021</td>
            <td class="border-top border-right small__font text-bold cnpj text-center border-bottom cnpj">CNPJ: {{$empresas->escnpj}}</td>
        </tr>

    </table>
    
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">{{$trabalhadors->tsnome}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font matric border-left text-center border-bottom border-top"><strong>Matrícula:</strong> {{$trabalhadors->tsmatricula}}</td>
            <td class="small__font cpf border-left text-center border-bottom border-top"><strong>CPF:</strong> {{$trabalhadors->tscpf}}</td>
            <td class="small__font pis border-left text-center border-bottom border-top"><strong>PIS:</strong> {{$trabalhadors->dspis}}</td>
            <td class="small__font cbo border-left border-right text-center border-bottom border-top"><strong>CBO:</strong> {{$trabalhadors->cbo}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left cod text-center text-bold border-bottom border-top destaque">Cod.</td>
            <td class="small__font border-left text-center descricao text-bold border-bottom border-top destaque">Descrição</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom border-top destaque">Referência %</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom border-top destaque">Vencimentos</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom border-top destaque">Descontos</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">{{$rublicas->rsrublica}}</td>
            <td class="small__font border-left descricao border-bottom">{{$rublicas->rsdescricao}}</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                <?php
                    $total_vencimento = [];
                    $vencimento = 0;
                    $vecimento_total = 0;
                    if ($rublicas->rsdc === 'Créditos') {
                        foreach ($lancamentorublicas as $key => $value) {
                            $vencimento = $value->lfvalor * $value->lsquantidade;
                            $vecimento_total += $vencimento;
                        }
                        array_push( $total_vencimento, $vecimento_total);
                    }
                ?>
                {{number_format((float)$vecimento_total, 2, ',', '')}}
            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                <?php
                    $total_descontor = [];
                    $desconto = 0;
                    $desconto_total = 0;
                    if ($rublicas->rsdc === 'Descontos') {
                        foreach ($lancamentorublicas as $key => $value) {
                            $desconto = $value->lfvalor * $value->lsquantidade;
                            $desconto_total += $desconto;
                        }
                        array_push($total_descontor,  $desconto_total);
                    }
                ?>
                {{number_format((float)$desconto_total, 2, ',', '')}}
            </td>
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
            <td class="small__font border-left descricao border-bottom">Gratificação</td>
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
            <td class="small__font border-left descricao border-bottom">13º Salário</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">999.999.999,99</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">999.999.999,99</td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">INSS Sobre 13º Salário</td>
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
            <td class="small__font border-left tipoTrab">Dispõe sobre atividades de trabalhadores categoria 04 Intermitentes</td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaque border-bottom border-right">
                <?php
                    $totalvencimento = 0;
                    foreach ($total_vencimento as $key => $value) {
                        $totalvencimento += $value;
                    }
                ?>
                 {{number_format((float)$totalvencimento, 2, ',', '')}}
            </td>
            <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">
                <?php
                    $totaldescontor = 0;
                    foreach ($total_descontor as $key => $value) {
                        $totaldescontor += $value;
                    }
                ?>
                {{number_format((float)$totaldescontor, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaqueDark border-top border-bottom">Valor Líquido</td>
            <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom"> {{number_format((float)$totaldescontor + $totalvencimento, 2, ',', '')}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top servicosbase text-center  destaque">Serviços</td>
            <td class="small__font border-left border-top servrsr text-center destaque">Serviços+RSR</td>
            <td class="small__font border-left border-top bainss text-center destaque">Base INSS</td>
            <td class="small__font border-left border-top bafgts text-center destaque">Base FGTS</td>
            <td class="small__font border-left border-top fgtsmes text-center destaque">FGTS Mês</td>
            <td class="small__font border-left border-top bairrf text-center destaque">Base IRRF</td>
            <td class="small__font border-left border-top fairrf text-center destaque">Faixa IRRF</td>
            <td class="small__font border-left border-right border-top num__filho text-center destaque">Num.Filho</td>
        </tr>

        <tr>
            <td class="little__font border-left border-top border-bottom servicosbase text-center">999.999.999,99</td>
            <td class="little__font border-left border-top border-bottom servrsr text-center">999.999.999,99 </td>
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
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">Relação da Produção por Dia</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="text-center border-left border-top border-bottom dia small__font destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font border-right valor destaque">Valor</td>
        </tr>

        
      
            
        <tr>
            <td class="text-center border-left dia small__font border-bottom">1</td>
            
            <td  class="text-center border-left small__font border-bottom valor"> 
                
            </td>
            <td  class="text-center border-left small__font border-bottom dia">9</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">17</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">25</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>
      
        <tr>
            <td class="text-center border-left dia small__font border-bottom">2</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">10</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">18</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">26</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>


        <tr>
            <td class="text-center border-left dia small__font border-bottom">3</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">11</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">19</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">27</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">4</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">12</td>
            <td  class="text-center border-left small__font border-bottom valor">
                <?php
                    $valortotal = 0;
                    foreach ($bolcartaopontos as $key => $value) {
                        if (mb_strpos($value->created_at, '15')) {
                            foreach ($bolcartaopontos as $key => $bolcartaoponto) {
                                if ($value->tsdescricao == 'hora extra 50%' && $bolcartaoponto->bshoraex) {
                                    $horasex = explode(':',$bolcartaoponto->bshoraex);
                                    $horasex = $horasex[0].'.'.$horasex[1];
                                    $horasex = $value->tsvalor * $horasex ;
                                    $valortotal += $horasex;
                                }elseif($value->tsdescricao == 'hora normal' && $bolcartaoponto->horas_normais){
                                    $horasnormal = explode(':',$bolcartaoponto->horas_normais);
                                    $horasnormal = $horasnormal[0].'.'.$horasnormal[1];
                                    $horasnormal = $value->tsvalor * $horasnormal;
                                    $valortotal += $horasnormal;
                                }elseif($value->tsdescricao == 'hora extra 100%' && $bolcartaoponto->bshoraexcem){
                                    $horaexcem = explode(':',$bolcartaoponto->bshoraexcem);
                                    $horaexcem = $horaexcem[0].'.'.$horaexcem[1];
                                    $horaexcem = $value->tsvalor * $horaexcem;
                                    $valortotal += $horaexcem;
                                }elseif ($value->tsdescricao == 'adicional noturno' && $bolcartaoponto->bsadinortuno) {
                                    $noturno = explode(':',$bolcartaoponto->bsadinortuno);
                                    $noturno = $noturno[0].'.'.$noturno[1];
                                    $noturno = $value->tsvalor * $noturno;
                                    $valortotal += $noturno;
                                }
                            }
                           
                           
                        }
                    }
                    echo(number_format((float)$valortotal, 2, ',', ''));
                ?>
            </td>
            <td  class="text-center border-left small__font border-bottom dia">20</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">28</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">5</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">13</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">21</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">29</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">6</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">14</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">22</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">30</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">7</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">15</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">23</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">31</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">999.999.999,99</td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">8</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">16</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left small__font border-bottom dia">24</td>
            <td  class="text-center border-left small__font border-bottom valor">999.999.999,99</td>
            <td  class="text-center border-left border-top  small__font border-bottom destaqueDark dia text-bold">Total</td>
            <td  class="text-center small__font border-top border-bottom border-right destaqueDark valor text-bold">999.999.999,99</td>
        </tr> 
       
    </table>






    <table>
        <tr>
            <td class="declaracao fontDeclaracao border-top border-left border-right">Declaro ter recebido a importância líquida neste recibo do periodo 
            <strong>
                <?php
                    $data_inicial = explode('-',$dados['ano_inicial']);
                    echo($data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                ?>
            </strong>  a 
            <strong>
                <?php
                    $data_final = explode('-',$dados['ano_final']);
                    echo($data_final[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                ?>
            <strong> 
            </td>
        </tr>

        <tr>
            <td class="declaracao fontDeclaracao  border-left border-right">Deposito: Banco: <strong>{{$trabalhadors->bsbanco}}</strong> Agência: <strong>{{$trabalhadors->bsagencia}}</strong> Operação:<strong>{{$trabalhadors->bsoperacao}}</strong> Conta: <strong>{{$trabalhadors->bsconta}}</strong></td>
        </tr>
    </table>

    <table>
        <tr class="assinatura">
            <td class="fontDeclaracao data border-left">Data: {{date("m/d/y")}}</td>
            <td class="fontDeclaracao border-right linhaass text-center">__________________________________________________</td>
        </tr>

        <tr class="assinatura">
            <td class="fontDeclaracao border-left border-bottom"></td>
            <td class="fontDeclaracao text-center border-right border-bottom">Assinatura Trabalhador</td>
        </tr>
    </table>
    {{dd($bolcartaopontos)}}
</body>
</html>