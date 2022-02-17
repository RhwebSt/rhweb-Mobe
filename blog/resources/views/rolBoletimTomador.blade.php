<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RHWEB - Rol dos Boletins Tomador</title>

        <style>
            @page { 
                margin-top: 289px; 
                margin-bottom: 30px;
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
                margin-top:10px;
                margin-right: 50px;
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
                width: 186.8px;
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

        </style>
    </head>

    <body>
        <div id="header">
            
            <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$tomadors->esnome}}</td>
            </tr>
        </table>
        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="6"><img class="logo" src="https://img1.gratispng.com/20180202/jtw/kisspng-astronaut-outer-space-computer-file-astronauts-from-space-5a7433930a6c97.5428240515175648190427.jpg" alt="" srcset="" style="width:80px; height: 80px; padding:5px;"></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao"><strong>CNPJ/MF Nroº : </strong></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Rua:</strong>,   - </td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Bairro:</strong> - </td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao"><strong>Tel:</strong></td>
                </tr>
    
            </table>
        </div>


            <table class="margin-top">
                <tr>
                    <td class="border-left border-top border-bottom small__font text-center date text-bold destaque">Rol dos Boletins</td>
                    <td class="border-top border-bottom small__font border-left text-center date text-bold">Data Inicial: 
                        <?php
                            $data = explode('-',$inicio)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                    <td class="border-top border-bottom small__font border-left text-center date text-bold">Data Final: 
                        <?php
                            $data = explode('-',$final)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                    <td class="border-top border-bottom border-right small__font border-left text-center date text-bold">Data de Emissão: {{date("d/m/y")}}</td>
                </tr>
            </table>


            <table class="margin-big">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque padding">Tomador: {{$tomadors->tsnome}}</td>
                </tr>
            </table>

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
            <p class="page destaque borderT padding-footer">Página:  </p>
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
                    $horas = explode(':',$horas);
                    if (count($horas) > 1) {
                        list($horas,$minitos) = $horas;
                        $horasex = $horas * 3600 + $minitos * 60;
                        $horasex = $horasex/60;
                        $horasex = ($horasex/60);
                        return $horasex;
                    }else{
                        return $horas[0] * 3600;
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
                                    array_push($resultadogreal['quantidade'], $lancamentorublica->quantidade);
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
                            {{number_format((float)$lancamentorublica->lfvalor * $lancamentorublica->quantidade, 2, ',', '.')}}
                            <?php 
                                $totaltrabalhado += ($lancamentorublica->lfvalor * $lancamentorublica->quantidade); 
                                
                            ?>
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                            {{number_format((float)$lancamentorublica->lftomador * $lancamentorublica->quantidade, 2, ',', '.')}}
                            <?php 
                                $totaltomadors += ($lancamentorublica->lftomador * $lancamentorublica->quantidade); 
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
                
                @foreach($bolcartaopontos as $bolcartaoponto)
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">{{$bolcartaoponto->liboletim}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                        <?php
                            $quantcartaoponto += 1;
                            $data = explode('-',$bolcartaoponto->lsdata)
                        ?>
                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                            <?php
                                $valortotal = 0; 
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
                                $totalfolhar += $valortotal;
                                echo(number_format((float)$valortotal, 2, ',', '.'));
                           ?>
                    </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                            <?php
                                $valortomador = 0;
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
                                $totaltomador += $valortomador;
                                echo(number_format((float)$valortomador, 2, ',', '.'));
                            ?>
                    </td>
                </tr>
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