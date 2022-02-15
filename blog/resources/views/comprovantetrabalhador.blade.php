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
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$folhar->esnome}}</td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="border-left title-recibo text-bold border-bottom border-top titlename">RECIBO DE PAGAMENTO DE SALÁRIO</td>
            <td class=" small__font text-bold text-center border-top border-bottom comp">Competência:
                <?php
                    $data = explode('-',$folhar->fsfinal)
                ?>
                {{$data[1]}}/{{$data[0]}}
            </td>
            <td class="border-top border-right small__font text-bold cnpj text-center border-bottom cnpj">CNPJ:{{$folhar->escnpj}}</td>
        </tr>

    </table>
    
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">
                {{$folhar->tsnome}}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font matric border-left text-center border-bottom border-top"><strong>Matrícula:</strong>{{$folhar->tsmatricula}}</td>
            <td class="small__font cpf border-left text-center border-bottom border-top"><strong>CPF:</strong>{{$folhar->tscpf}}</td>
            <td class="small__font pis border-left text-center border-bottom border-top"><strong>PIS:</strong>{{$folhar->dspis}}</td>
            <td class="small__font cbo border-left border-right text-center border-bottom border-top"><strong>CBO:</strong>{{$folhar->cbo}}</td>
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
        @foreach($valorcalculos[0] as $v => $valorcalculo)
                @if($valorcalculo->basecalculo === $folhar->id && $valorcalculo->vivencimento || $valorcalculo->basecalculo === $folhar->id && $valorcalculo->videscinto)
                    <tr>
                        <td class="small__font border-left cod text-center border-bottom">{{$valorcalculo->vicodigo}}</td>
                        <td class="small__font border-left descricao border-bottom">{{$valorcalculo->vsdescricao}}</td>
                        <td class="small__font border-left text-center referencia text-bold border-bottom">
                            {{number_format((float)$valorcalculo->vireferencia, 2, ',', '.')}}
                        </td>
                        <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$valorcalculo->vivencimento, 2, ',', '.')}}</td>
                        <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$valorcalculo->videscinto, 2, ',', '.')}}</td>
                    </tr>
                @endif
        @endforeach
        @foreach($valorcalculos[1] as $v => $valorcalculo)
                @if($valorcalculo->basecalculo === $folhar->id && $valorcalculo->vivencimento || $valorcalculo->basecalculo === $folhar->id && $valorcalculo->videscinto)
                    <tr>
                        <td class="small__font border-left cod text-center border-bottom">{{$valorcalculo->vicodigo}}</td>
                        <td class="small__font border-left descricao border-bottom">{{$valorcalculo->vsdescricao}}</td>
                        <td class="small__font border-left text-center referencia text-bold border-bottom">
                            {{number_format((float)$valorcalculo->vireferencia, 2, ',', '.')}}
                        </td>
                        <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$valorcalculo->vivencimento, 2, ',', '.')}}</td>
                        <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$valorcalculo->videscinto, 2, ',', '.')}}</td>
                    </tr>
                @endif
        @endforeach

    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top tipoTrab">
                <?php
                    $categoria = explode('-',$folhar->cscategoria);
                    foreach ($leis[0] as $key => $valor_lei1) {
                        if (strpos($valor_lei1, $categoria[0]) !== false) {
                            $valor_lei1 = explode('-',$valor_lei1);
                            echo($valor_lei1[1]);
                        }
                    }
                ?>
            </td>
            <td class="small__font border-left text-bold border-top total__vencimentos text-center destaque border-bottom border-right">Total Vencimento</td>
            <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total Desconto</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab">
                <?php
                    $categoria = explode('-',$folhar->cscategoria);
                    foreach ($leis[1] as $key => $valor_lei1) {
                        if (strpos($valor_lei1, $categoria[0]) !== false) {
                            $valor_lei1 = explode('-',$valor_lei1);
                            echo($valor_lei1[1]);
                        }
                    }
                ?>
            </td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaque border-bottom border-right">{{number_format((float)$folhar->bivalorvencimento, 2, ',', '.')}}</td>
            <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">{{number_format((float)$folhar->bivalordesconto, 2, ',', '.')}}</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaqueDark border-top border-bottom">Valor Líquido</td>
            <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom">{{number_format((float)$folhar->bivalorliquido, 2, ',', '.')}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top servicosbase text-center  destaque">Serviços</td>
            <td class="small__font border-left border-top servrsr text-center destaque">Serviços+DSR</td>
            <td class="small__font border-left border-top bainss text-center destaque">Base INSS</td>
            <td class="small__font border-left border-top bafgts text-center destaque">Base FGTS</td>
            <td class="small__font border-left border-top fgtsmes text-center destaque">FGTS Mês</td>
            <td class="small__font border-left border-top bairrf text-center destaque">Base IRRF</td>
            <td class="small__font border-left border-top fairrf text-center destaque">Faixa IRRF</td>
            <td class="small__font border-left border-right border-top num__filho text-center destaque">Num.Filho</td>
        </tr>

        <tr>
            <td class="little__font border-left border-top border-bottom servicosbase text-center">{{number_format((float)$folhar->biservico, 2, ',', '.')}}</td>
            <td class="little__font border-left border-top border-bottom servrsr text-center">{{number_format((float)$folhar->biservicodsr, 2, ',', '.')}}</td>
            <td class="little__font border-left border-top border-bottom bainss text-center">{{number_format((float)$folhar->biinss, 2, ',', '.')}}</td>
            <td class="little__font border-left border-top border-bottom bafgts text-center">{{number_format((float)$folhar->bifgts, 2, ',', '.')}}</td>
            <td class="little__font border-left border-top border-bottom fgtsmes text-center">{{number_format((float)$folhar->bifgtsmes, 2, ',', '.')}}</td>
            <td class="little__font border-left border-top border-bottom bairrf text-center">{{number_format((float)$folhar->biirrf > 0 ? $folhar->biirrf : 0, 2, ',', '.')}}</td>
            <td class="little__font border-left border-top border-bottom fairrf text-center">{{number_format((float)$folhar->bifaixairrf, 2, ',', '.')}}</td>
            <td class="little__font border-left border-right border-bottom border-top num__filho text-center">{{$folhar->binumfilhos}}</td>
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
            @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '01' && $relacaodia->basecalculo === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">9</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '09' && $relacaodia->basecalculo === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">17</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '17' && $relacaodia->basecalculo === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">25</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '25' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>
      
        <tr>
            <td class="text-center border-left dia small__font border-bottom">2</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '02' && $relacaodia->basecalculo === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">10</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '10' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">18</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '18' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">26</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '26' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>


        <tr>
            <td class="text-center border-left dia small__font border-bottom">3</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '03' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">11</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '11' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">19</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '19' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">27</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '27' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">4</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '04' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">12</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '12' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">20</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '20' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">28</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '28' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">5</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '05' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">13</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '13' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">21</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '21' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">29</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '29' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">6</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '06' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">14</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '14' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">22</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '22' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">30</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '30' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float) $relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">7</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '07' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">15</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '15' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">23</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '23' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">31</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '31' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">8</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '08' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">16</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '16' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia">24</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '24' && $relacaodia->basecalculo === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left border-top  small__font border-bottom destaqueDark dia text-bold">Total</td>
            <td  class="text-center small__font border-top border-bottom border-right destaqueDark valor text-bold">{{number_format((float)$folhar->bitotaldiaria, 2, ',', '.')}}</td>
        </tr>  
       
    </table>






    <table>
        <tr>
            <td class="declaracao fontDeclaracao border-top border-left border-right">Declaro ter recebido a importância líquida neste recibo do periodo 
            <strong>
                <?php
                    $data_inicial = explode('-',$folhar->fsinicio);
                    echo($data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                ?>
            </strong>  a 
            <strong>
                <?php
                    $data_final = explode('-',$folhar->fsfinal);
                    echo($data_final[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                ?>
            <strong> 
            </td>
        </tr>

        <tr>
            <td class="declaracao fontDeclaracao  border-left border-right">Deposito: Banco: <strong>{{$folhar->bsbanco}}</strong> Agência: <strong>{{$folhar->bsagencia}}</strong> Operação:<strong>{{$folhar->bsoperacao}}</strong> Conta: <strong>{{$folhar->bsconta}}</strong></td>
        </tr>
    </table>

    <table>
        <tr class="assinatura">
            <td class="fontDeclaracao data border-left">Data:{{date("d/m/y")}}</td>
            <td class="fontDeclaracao border-right linhaass text-center">__________________________________________________</td>
        </tr>

        <tr class="assinatura">
            <td class="fontDeclaracao border-left border-bottom"></td>
            <td class="fontDeclaracao text-center border-right border-bottom">Assinatura Trabalhador</td>
        </tr>
    </table>
    <h1 style="page-break-after: always;"></h1>
</body>
</html>