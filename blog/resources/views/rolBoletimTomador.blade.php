<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RHWEB - Rol dos Boletins Tomador</title>

        <style>
            @page { 
                margin-top: 289px; 
                margin-bottom: 60px;
                margin-left: 10px;
                margin-right: 10px;
            }
            #header { position: fixed; left: 0px; top: -289px; right: 0px; height: 289px; text-align: center; }
            #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 60px; text-align: end; }
            #footer .page:after { content: counter(page, upper); }

            body{
                font-family:sans-serif;
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
                width: 767px;
            }

            .borderT{
                border: 1px solid black;
                border-radius: 3px;
            }

            .margin-top{
                margin-top: 10px;
            }

            .margin-top2{
                margin-top: 20px;
            }

            .margin-bottom2{
                margin-bottom: 20px;
            }
    
            .padding-footer{
                padding: 2px;
            }

            .date{
                width: 251px;
            }

            .padding-tomador{
                padding-top: 20px;
                font-size: 14px !important;
            }

            .padrao{
                width: 186.5px;
            }

            .fontpad{
                font-size: 14px !important;
            }
            

            .cod{
                width: 60px;
            }

            .desc{
                width: 289px;
            }

            .pad2{
                width: 130px;
            }

            .pad3{
                width: 130px;
            }

            .total__bol{
                width:630px;
            }

            .fontbig{
                font-size: 13px;
            }
            
            .margin-big{
                margin-top: 25px;
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
            
            .border-top-left-radius{
                border-top-left-radius: 8px;
            }
            
            .border-top-right-radius{
                border-top-right-radius: 8px;
            }

        </style>
    </head>

    <body>
        <div id="header">
            
            <div class="borderT margin-top">
                <table>
                    <tr>
                        <td rowspan="7">
                            @if($empresa->esfoto)
                                <img class="logo" src="{{$empresa->esfoto}}">
                            @else
                                @include('imagem')
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td class=" width__padrao padding-left-foto text-bold margin-bottom--title">{{$tomadors->esnome}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$empresa->escnpj}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font width__padrao capitalize padding-left-foto">Rua: {{$empresa->eslogradouro}}, {{$empresa->esnum}}  - {{$empresa->escep}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font width__padrao capitalize padding-left-foto">Bairro: {{$empresa->esbairro}} - {{$empresa->esuf}}</td>
                    </tr>
        
                    <tr>
    
                        <td class="small__font width__padrao capitalize padding-left-foto">Tel: {{$empresa->estelefone}}</td>
                    </tr>
        
                </table>
            </div>

            <table class="margin-top">
                <tr>
                    <td class="small__font text-center date text-bold">Data Inicial: 
                        <?php
                            $data = explode('-',$inicio)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                    <td class="small__font text-center date text-bold">Data Final: 
                        <?php
                            $data = explode('-',$final)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                    <td class="small__font text-center date text-bold">Data de Emissão: {{date("d/m/y")}}</td>
                </tr>
            </table>
            
            <div class="margin-top">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">Rol dos Boletins</td>
                    </tr>
                </table>
            </div>
            
            <div class="margin-big">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">{{$tomadors->tsnome}}</td>
                    </tr>
                </table>
            </div>

            
            
            <table class="padding-tomador">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaqueDark padding">Boletim com Tabela</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Nº Boletim</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Data</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Valor Folha</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Valor Boletim</td>
                </tr>
            </table>
        </div>


        <div id="footer">
          <p class="page padding-footer" style="text-align: right">Página:  </p>
        </div>

        <div id="content">
            <?php
                $quantboletim = 0;
                $totaltrabalhado = 0;
                $totaltomadors = 0;
                $resultadogreal = [
                    'item'=>[],
                    'historico'=>[],
                    'quantidade'=>[],
                    'valor'=>[],
                    'total'=>[]
                ];
                function horas_em_segundos($horas)
                {
                    if (strpos($horas,':')) {
                        $horas = explode(':',$horas);
                        list($horas,$minitos) = $horas;
                        $horasex = $horas * 3600 + $minitos * 60;
                        $horasex = $horasex/60;
                        $horasex = ($horasex/60);
                        return $horasex;
                    }else{
                        return $horas;
                    }
                };
            ?>
            <table>
                @foreach($lancamentorublicas as $lancamentorublica)
                    <tr>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                            {{$lancamentorublica->liboletim}}
                            <?php 
                                $quantboletim += 1 ;
                                array_push($resultadogreal['historico'],$lancamentorublica->lshistorico);
                                array_push($resultadogreal['item'],$lancamentorublica->licodigo);
                                if ($lancamentorublica->licodigo == 1002 &&  $lancamentorublica->licodigo == 1003 && 
                                $lancamentorublica->licodigo == 1004 && $lancamentorublica->licodigo == 1005) {
                                    array_push($resultadogreal['quantidade'], horas_em_segundos($lancamentorublica->quantidade));
                                }else{
                                    array_push($resultadogreal['quantidade'], horas_em_segundos($lancamentorublica->quantidade));
                                }
                                
                            ?>
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                        <?php
                            $data = explode('-',$lancamentorublica->lsdata)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao"> 
                            {{number_format((float)$lancamentorublica->lfvalor * horas_em_segundos($lancamentorublica->quantidade), 2, ',', '.')}}
                            <?php 
                                $totaltrabalhado += ($lancamentorublica->lfvalor * horas_em_segundos($lancamentorublica->quantidade)); 
                                
                            ?>
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                            {{number_format((float)$lancamentorublica->lftomador * horas_em_segundos($lancamentorublica->quantidade), 2, ',', '.')}}
                            <?php 
                                $totaltomadors += ($lancamentorublica->lftomador * horas_em_segundos($lancamentorublica->quantidade)); 
                                array_push($resultadogreal['valor'],$lancamentorublica->lftomador);
                            ?>
                        </td>
                    </tr>
                @endforeach
            </table>
                    
            <table>
                <tr>

                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Quantidade:  {{$quantboletim}} </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Total ====></td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">{{number_format((float)$totaltrabalhado, 2, ',', '.')}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">{{number_format((float)$totaltomadors, 2, ',', '.')}}</td>
                </tr>
            </table>

            <table class="margin-top2">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaqueDark padding fontpad">Boletim cartão ponto</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Nº Boletim</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Data</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Valor Folha</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Valor Boletim</td>
                </tr>
            </table>
                <?php
                    $totalfolhar = 0;
                    $totaltomador = 0;
                    $quantcartaoponto = 0;
                    function calculovalores($horas,$valores)
                    {
                        list($horas,$minitos) = explode(':',$horas);
                        $horasex = $horas * 3600 + $minitos * 60;
                        $horasex = $horasex/60;
                        $horasex = $valores * ($horasex/60);
                        return $horasex;
                    }
                    
                ?>
            <table>
                
            @foreach($boletins as $boletim)
                 @if($boletim->lsstatus === 'D')
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">{{$boletim->liboletim}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                        <?php
                            $quantcartaoponto += 1;
                            $data = explode('-',$boletim->lsdata)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                        <?php
                            $valortotal = 0;
                        ?>
                        @foreach($bolcartaopontos as $bolcartaoponto)
                            @if($bolcartaoponto->lancamento === $boletim->id)
                            <?php
                                 
                                foreach ($tabelaprecos as $key => $value) {
                                    if ($value->tsrubrica == 1003 && $bolcartaoponto->bshoraex) {
                                        $valortotal += calculovalores($bolcartaoponto->bshoraex,$value->tsvalor);
                                    }elseif($value->tsrubrica == 1002 && $bolcartaoponto->horas_normais){
                                        $valortotal += calculovalores($bolcartaoponto->horas_normais,$value->tsvalor);
                                    }elseif($value->tsrubrica == 1004 && $bolcartaoponto->bshoraexcem){
                                        $valortotal += calculovalores($bolcartaoponto->bshoraexcem,$value->tsvalor);
                                    }elseif ($value->tsrubrica == 1005 && $bolcartaoponto->bsadinortuno) {
                                        $valortotal += calculovalores($bolcartaoponto->bsadinortuno,$value->tsvalor);
                                    }
                                }
                                
                                // echo(number_format((float)$valortotal, 2, ',', '.'));
                           ?>
                           @endif
                        @endforeach
                        <?php
                            $totalfolhar += $valortotal;
                        ?>
                        {{number_format((float)$valortotal, 2, ',', '.')}}
                    </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                        <?php
                            $valortomador = 0;
                        ?>
                        @foreach($bolcartaopontos as $bolcartaoponto)
                            @if($bolcartaoponto->lancamento === $boletim->id)
                                <?php
                                    
                                    foreach ($tabelaprecos as $key => $value) {
                                        if ($value->tsrubrica == 1003 && (int)$bolcartaoponto->bshoraex > 0) {
                                            $valortomador += calculovalores($bolcartaoponto->bshoraex,$value->tstomvalor);
                                            array_push($resultadogreal['historico'],$value->tsdescricao);
                                            array_push($resultadogreal['item'],$value->tsrubrica);
                                            array_push($resultadogreal['valor'],$valortomador);
                                            array_push($resultadogreal['quantidade'],horas_em_segundos($bolcartaoponto->bshoraex));
                                        }elseif($value->tsrubrica == 1002 && (int)$bolcartaoponto->horas_normais > 0){
                                            $valortomador += calculovalores($bolcartaoponto->horas_normais,$value->tstomvalor);
                                            array_push($resultadogreal['historico'],$value->tsdescricao);
                                            array_push($resultadogreal['item'],$value->tsrubrica);
                                            array_push($resultadogreal['valor'],$valortomador);
                                            array_push($resultadogreal['quantidade'],horas_em_segundos($bolcartaoponto->horas_normais));
                                        }elseif($value->tsrubrica == 1004 &&  (int)$bolcartaoponto->bshoraexcem > 0){
                                            $valortomador += calculovalores($bolcartaoponto->bshoraexcem,$value->tstomvalor);
                                            array_push($resultadogreal['historico'],$value->tsdescricao);
                                            array_push($resultadogreal['item'],$value->tsrubrica);
                                            array_push($resultadogreal['valor'],$valortomador);
                                            array_push($resultadogreal['quantidade'],horas_em_segundos($bolcartaoponto->bshoraexcem));
                                        }elseif ($value->tsrubrica == 1005 && (int)$bolcartaoponto->bsadinortuno > 0) {
                                            $valortomador += calculovalores($bolcartaoponto->bsadinortuno,$value->tstomvalor);
                                            array_push($resultadogreal['historico'],$value->tsdescricao);
                                            array_push($resultadogreal['item'],$value->tsrubrica);
                                            array_push($resultadogreal['valor'],$valortomador);
                                            array_push($resultadogreal['quantidade'],horas_em_segundos($bolcartaoponto->bsadinortuno));
                                        }
                                    }
                                   
                                    // echo(number_format((float)$valortomador, 2, ',', '.'));
                                ?>
                            @endif
                        @endforeach
                        <?php
                             $totaltomador += $valortomador;
                        ?>
                        {{number_format((float)$valortomador, 2, ',', '.')}}
                    </td>
                </tr>
                @endif
                @endforeach
            </table>
           
            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Quantidade:  {{$quantcartaoponto}} </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Total ====></td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">{{number_format((float)$totalfolhar, 2, ',', '.')}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">{{number_format((float)$totaltomador, 2, ',', '.')}}</td>
                </tr>
            </table>

            <table class="margin-top2 margin-bottom2">
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold fontbig">Total Quantidade:  {{$quantcartaoponto + $quantboletim}} </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold fontbig">Total Geral Lançamentos =></td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold fontbig">{{number_format((float)$totalfolhar + $totaltrabalhado, 2, ',', '.')}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold fontbig">{{number_format((float)$totaltomador + $totaltomadors, 2, ',', '.')}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center destaque text-bold cod">Código</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center destaque text-bold desc">Descrição</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center destaque text-bold pad2">Quantidade</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center destaque text-bold pad2">Valor Item</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center destaque text-bold pad2">Valor Total</td>
                </tr>
                
                <?php
                    $valortotal = 0;
                    $valordiaria = 0;
                    foreach ($tabelaprecos as $key => $tabelapreco) {
                        $item = '';
                        $historico = '';
                        $quant = 0;
                        $valor = 0;
                        foreach ($resultadogreal['item'] as $r => $resul) {
                            if ($tabelapreco->tsrubrica == $resul) {
                                $item = $resul;
                                $historico = $resultadogreal['historico'][$r];
                                $quant += $resultadogreal['quantidade'][$r];
                                $valor = $tabelapreco->tstomvalor;
                               
                            }
                        }
                       if ($item) {
                            echo'<tr>
                                    <td class="border-left border-top border-bottom border-right small__font text-center cod">'.$item.'</td>
                                    <td class="border-left border-top border-bottom border-right small__font text-center uppercase desc">'.$historico.'</td>
                                    <td class="border-left border-top border-bottom border-right small__font text-center pad2">'.$quant.'</td>
                                    <td class="border-left border-top border-bottom border-right small__font text-center pad2">'.number_format((float)$valor, 2, ',', '.').'</td>
                                    <td class="border-left border-top border-bottom border-right small__font text-center pad2">'.number_format((float)$quant * $valor, 2, ',', '.').'</td>
                                </tr>';
                       }
                       $valortotal += $quant * $valor;
                      
                    }
                    foreach ($tabelaprecos as $key => $tabela) {
                        if ($tabela->tsrubrica == 1000 && in_array(1000,$resultadogreal['item'])) {
                            $valordiaria = $valortotal / $tabela->tstomvalor;
                        }
                    }
                ?>
                <!-- <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center cod">1005</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center desc">Hora Normal</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center pad2">999.999.999,99</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center pad2">999.999.999,99</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center pad2">999.999.999,99</td>
                </tr> -->

                
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center total__bol">Total dos Boletins</td>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center pad3">{{number_format((float)$valortotal, 2, ',', '.')}}</td>
                </tr>

                <tr>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center total__bol">Total de Diárias</td>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center pad3">{{number_format((float)$valordiaria, 2, ',', '.')}}</td>
                </tr>
            </table>
        </div>
    </body>