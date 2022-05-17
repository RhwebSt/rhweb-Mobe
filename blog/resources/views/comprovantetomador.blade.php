<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Comprovante de Pagamento por dia</title>
</head>

<style>
    @page { 
          margin-bottom: 50px;
          margin-right: 10px;
          margin-left: 10px;
          margin-top: 10px;
    }
    
    #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px; text-align: end; }

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
    
    .medium__font{
        font-size:13.5px
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
        width:145px;
    }

    .cpf{
        width:200px;
    }

    .pis{
        width:188px;
    }

    .cbo{
        width:201.2px;
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
        width: 100.3px;
    }

    .tipoTrab{
        width: 534.3px;
    }

    .total__vencimentos{
        width: 119.7px;
    }

    .total__descontos{
        width: 100.3px;
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
        width: 81.5px;
    }

    .num__filho{
        width: 67px;
    }

    .fontDeclaracao{
        font-size: 14px;
    }

    .declaracao{
        width: 768px;
    }

    .data{
        width:153.8px;
    }

    .assinatura{
        margin-top:60px;
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
        width: 134.1px;
    }

    .dia{
        width: 46.5px;
    }
    
    .name__title{
        width: 768px;
    }
    
    .name__title--tomador{
        width: 753px;
    }
    
     .comp{
        width: 250px;
    }
    
    .cnpj{
        width: 206px;
    }
    
    .font__trab{
        font-size:14px;
    }
    
    .container__rodape{
        display: flex;
        flex-direction: column;
        justify-content: end;
    }
    
    .margin-top{
        margin-top: 10px;
    }
    
    .borderT
    {
        border: 1px solid black;
        border-radius: 3px;
        width:773.5px;
    }
    
    .padding-footer{
        padding: 2px;
        width:770px;
    }
    
    .margin-bottom{
        margin-bottom: 10px;
    }
    
    .margin-bottom--small{
        margin-bottom: 5px;
    }
    
    .margin-left{
        margin-left: 5px;
    }
    
    .dataEmissao{
      width: 381px;
    }
    
    .banco{
        width:138.5;
    }
    
    .medium__font{
        font-size: 13.5px;
    }
</style>

<body>
    
   @foreach($folhas as $f => $folhar)
    <div class="margin-top">
        <table>
            <tr>
                <td class="name__title text-center text-bold">Recibo de Pagamento de Salário</td>
            </tr>
        </table>
    </div>
   
    <div class="borderT margin-top margin-bottom--small">
        <table class="margin-top margin-left ">
            <tr>
                <td class="name__title--tomador text-center text-bold destaque">{{$folhar->esnome}}</td>
            </tr>
        </table>
        
        <table class="margin-bottom--small">
            <tr>
                <td class="small__font text-center dataEmissao"><b>Competência:</b>
                    
                    {{date('d/m/Y',strtotime($folhar->fsfinal))}}
                </td>
                <td class="small__font text-center dataEmissao"><b>CNPJ:</b> {{$folhar->escnpj}}</td>
            </tr>
    
        </table>
    </div>
    
    <div class="borderT margin-bottom--small">
        <table class="margin-top">
            <tr>
                <td class="name__title font__trab text-center text-bold">
                    {{$folhar->tsnome}}
                </td>
            </tr>
        </table>
    
        <table class="margin-left margin-bottom--small">
            <tr>
                <td class="small__font matric text-center destaque text-bold">Matrícula</td>
                <td class="small__font cpf text-center destaque text-bold">CPF</td>
                <td class="small__font pis text-center destaque text-bold">PIS</td>
                <td class="small__font cbo text-center destaque text-bold">CBO</td>
            </tr>
            
            <tr>
                <td class="small__font matric text-center">{{$folhar->tsmatricula}}</td>
                <td class="small__font cpf text-center">{{$folhar->tscpf}}</td>
                <td class="small__font pis text-center">{{$folhar->dspis}}</td>
                <td class="small__font cbo text-center">
                    <?php
                        $cbo = explode('-',$folhar->cbo);
                    ?>
                    {{$cbo[0]}}
                </td>
            </tr>
        </table>
    
    </div>

    <table>
        <tr>
            <td class="small__font border-left cod text-center text-bold border-bottom border-top destaque">Cod.</td>
            <td class="small__font border-left text-center descricao text-bold border-bottom border-top destaque">Descrição</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom border-top destaque">Referência %</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom border-top destaque">Vencimentos</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom border-top destaque">Descontos</td>
        </tr>
        @foreach($valorcalculos[0] as $v => $valorcalculo)
                @if($valorcalculo->base_calculo_id === $folhar->id && $valorcalculo->vivencimento || $valorcalculo->base_calculo_id === $folhar->id && $valorcalculo->videscinto)
                    <tr>
                        <td class="small__font border-left cod text-center border-bottom">{{$valorcalculo->vicodigo}}</td>
                        <td class="small__font border-left descricao border-bottom">{{$valorcalculo->vsdescricao}}</td>
                        <td class="small__font border-left text-center referencia border-bottom">
                            {{$valorcalculo->vireferencia?number_format((float)$valorcalculo->vireferencia, 2, ',', '.'):''}}
                        </td>
                        <td class="small__font border-left text-center vencimentos border-bottom">{{$valorcalculo->vivencimento?number_format((float)$valorcalculo->vivencimento, 2, ',', '.'):''}}</td>
                        <td class="small__font border-left border-right text-center descontos border-bottom">{{$valorcalculo->videscinto?number_format((float)$valorcalculo->videscinto, 2, ',', '.'):''}}</td>
                    </tr>
                @endif
        @endforeach
        @foreach($valorcalculos[1] as $v => $valorcalculo)
                @if($valorcalculo->base_calculo_id === $folhar->id && $valorcalculo->vivencimento || $valorcalculo->base_calculo_id === $folhar->id && $valorcalculo->videscinto)
                    <tr>
                        <td class="small__font border-left cod text-center border-bottom">{{$valorcalculo->vicodigo}}</td>
                        <td class="small__font border-left descricao border-bottom">{{$valorcalculo->vsdescricao}}</td>
                        <td class="small__font border-left text-center referencia border-bottom">
                            {{$valorcalculo->vireferencia?number_format((float)$valorcalculo->vireferencia, 2, ',', '.'):''}}
                        </td>
                        <td class="small__font border-left text-center vencimentos border-bottom">{{$valorcalculo->vivencimento?number_format((float)$valorcalculo->vivencimento, 2, ',', '.'):''}}</td>
                        <td class="small__font border-left border-right text-center descontos border-bottom">{{$valorcalculo->videscinto?number_format((float)$valorcalculo->videscinto, 2, ',', '.'):''}}</td>
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
            <td class="small__font border-left total__vencimentos text-center border-bottom border-right">{{$folhar->bivalorvencimento?number_format((float)$folhar->bivalorvencimento, 2, ',', '.'):''}}</td>
            <td class="small__font border-left border-right total__descontos text-center border-bottom">{{$folhar->bivalordesconto?number_format((float)$folhar->bivalordesconto, 2, ',', '.'):''}}</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="border-left text-bold total__vencimentos text-center destaque border-top border-bottom medium__font">Valor Líquido</td>
            <td class="text-bold border-right total__descontos text-center destaque border-top border-bottom medium__font">{{$folhar->bivalorliquido?number_format((float)$folhar->bivalorliquido, 2, ',', '.'):''}}</td>
        </tr>
    </table>

    <div class="margin-top borderT">
        <table class="margin-top margin-bottom--small margin-left">
            <tr>
                <td class="small__font servicosbase text-center destaque text-bold">Serviços</td>
                <td class="small__font servrsr text-center destaque text-bold">Serviços+DSR</td>
                <td class="small__font bainss text-center destaque text-bold">Base INSS</td>
                <td class="small__font bafgts text-center destaque text-bold">Base FGTS</td>
                <td class="small__font fgtsmes text-center destaque text-bold">FGTS Mês</td>
                <td class="small__font bairrf text-center destaque text-bold">Base IRRF</td>
                <td class="small__font fairrf text-center destaque text-bold">Faixa IRRF</td>
                <td class="small__font num__filho text-center destaque text-bold">Dependente</td>
            </tr>
    
            <tr>
                <td class="little__font servicosbase text-center">{{$folhar->biservico?number_format((float)$folhar->biservico, 2, ',', '.'):''}}</td>
                <td class="little__font servrsr text-center">{{$folhar->biservicodsr?number_format((float)$folhar->biservicodsr, 2, ',', '.'):''}}</td>
                <td class="little__font bainss text-center">{{$folhar->biinss?number_format((float)$folhar->biinss, 2, ',', '.'):''}}</td>
                <td class="little__font bafgts text-center">{{$folhar->bifgts?number_format((float)$folhar->bifgts, 2, ',', '.'):''}}</td>
                <td class="little__font fgtsmes text-center">{{$folhar->bifgtsmes?number_format((float)$folhar->bifgtsmes, 2, ',', '.'):''}}</td>
                <td class="little__font bairrf text-center">{{$folhar->biirrf > 0? number_format((float)$folhar->biirrf, 2, ',', '.'):''}}</td>
                <td class="little__font fairrf text-center">{{$folhar->bifaixairrf?number_format((float)$folhar->bifaixairrf, 2, ',', '.'):''}}</td>
                <td class="little__font num__filho text-center">{{$folhar->binumfilhos?$folhar->binumfilhos:''}}</td>
            </tr>
        </table>
    </div>

    <table class="margin-top margin-bottom">
        <tr>
            <td class="name__title font__trab text-center text-bold">Relação da Produção por Dia</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="text-center border-left border-top border-bottom dia small__font destaque text-bold">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque text-bold">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque text-bold">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque text-bold">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque text-bold">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque text-bold">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque text-bold">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font border-right valor destaque text-bold">Valor</td>
        </tr>

        
      
            
        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">1</td>
            <td  class="text-center border-left small__font border-bottom valor">
            @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '01' && $relacaodia->base_calculo_id === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">9</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '09' && $relacaodia->base_calculo_id === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">17</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '17' && $relacaodia->base_calculo_id === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">25</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '25' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>
      
        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">2</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                    @if($relacaodia->rsdia === '02' && $relacaodia->base_calculo_id === $folhar->id)
                        {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                    @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">10</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '10' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">18</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '18' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">26</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '26' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>


        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">3</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '03' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">11</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '11' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">19</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '19' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">27</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '27' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">4</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '04' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">12</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '12' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">20</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '20' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">28</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '28' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">5</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '05' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">13</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '13' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">21</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '21' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">29</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '29' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">6</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '06' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">14</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '14' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">22</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '22' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">30</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '30' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float) $relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">7</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '07' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">15</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '15' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">23</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '23' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">31</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '31' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom text-bold">8</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '08' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '.')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">16</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '16' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left small__font border-bottom dia text-bold">24</td>
            <td  class="text-center border-left small__font border-bottom valor">
                @foreach($relacaodias as $r => $relacaodia)
                        @if($relacaodia->rsdia === '24' && $relacaodia->base_calculo_id === $folhar->id)
                            {{number_format((float)$relacaodia->rivalor, 2, ',', '')}}
                        @endif
                @endforeach
            </td>
            <td  class="text-center border-left border-top  small__font border-bottom destaque dia text-bold">Total</td>
            <td  class="text-center small__font border-top border-bottom border-right destaque valor text-bold">{{number_format((float)$folhar->bitotaldiaria, 2, ',', '.')}}</td>
        </tr>  
       
    </table>





    <div class="margin-top borderT">
        <table class="margin-top margin-bottom--small">
            <tr class="">
                <td class="declaracao fontDeclaracao">Declaro ter recebido a importância líquida neste recibo do periodo 
                    <strong>
                       
                        {{date('d/m/Y',strtotime($folhar->fsinicio))}}
                    </strong>  a 
                    <strong>
                       
                         {{date('d/m/Y',strtotime($folhar->fsfinal))}}
                    <strong> 
                </td>
            </tr>

        </table>
        
        <table class="margin-left">
            <tr>
                <td class="small__font text-bold banco destaque text-center">Banco</td>
                <td class="small__font text-bold banco destaque text-center">Agência</td>
                <td class="small__font text-bold banco destaque text-center">Operação</td>
                <td class="small__font text-bold banco destaque text-center">Conta</td>
            </tr>
            
            <tr>
                <td class="small__font banco text-center">{{$folhar->bsbanco}}</td>
                <td class="small__font banco text-center">{{$folhar->bsagencia}}</td>
                <td class="small__font banco text-center">{{$folhar->bsoperacao}}</td>
                <td class="small__font banco text-center">{{$folhar->bsconta}}</td>
            </tr>
        </table>
    
        <table class="margin-top">
            <tr class="assinatura">
                <td class="fontDeclaracao data">Data:{{date("d/m/y")}}</td>
                <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
            </tr>
    
            <tr class="assinatura">
                <td class="fontDeclaracao"></td>
                <td class="fontDeclaracao text-center">Assinatura Trabalhador</td>
            </tr>
        </table>
    </div>
    
    
    
    @if($f < count($folhas) - 1)
    <div class="footer">
        <h1 style="page-break-after: always;"></h1>
    </div>
    @endif
    
    @endforeach
</body>
</html>