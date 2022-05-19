<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RHWEB - Rol dos Boletins Tomador</title>

        <style>
            @page { 
                margin-top: 310px; 
                margin-bottom: 60px;
                margin-left: 10px;
                margin-right: 10px;
            }
            #header { position: fixed; left: 0px; top: -310px; right: 0px; height: 310px; text-align: center; }
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
                            @if($boletim[0]->empresa->esfoto)
                                <img class="logo" src="{{$boletim[0]->empresa->esfoto}}">
                            @else
                                @include('imagem')
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td class=" width__padrao padding-left-foto text-bold margin-bottom--title">{{$boletim[0]->empresa->esnome}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$boletim[0]->empresa->escnpj}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font width__padrao capitalize padding-left-foto">Rua: {{$boletim[0]->empresa->endereco[0]->eslogradouro}}, {{$boletim[0]->empresa->endereco[0]->esnum}}  - {{$boletim[0]->empresa->endereco[0]->escep}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font width__padrao capitalize padding-left-foto">Bairro: {{$boletim[0]->empresa->endereco[0]->esbairro}} - {{$boletim[0]->empresa->endereco[0]->esuf}}</td>
                    </tr>
        
                    <tr>
    
                        <td class="small__font width__padrao capitalize padding-left-foto">Tel: {{$boletim[0]->empresa->estelefone}}</td>
                    </tr>
        
                </table>
            </div>

            <table class="margin-top">
                <tr>
                    <td class="small__font text-center date text-bold">Data Inicial: 
                       
                        {{date('d/m/Y',strtotime($inicio))}}
                    </td>
                    <td class="small__font text-center date text-bold">Data Final: 
                      
                        {{date('d/m/Y',strtotime($final))}}
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
                        <td class="name__title text-center text-bold">{{$boletim[0]->tomador->tsnome}}</td>
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

                <?php
                    $rublica = [
                        'numero'=>[],
                        'data'=>[],
                        'vfolhar'=>[],
                        'vboletim'=>[]
                    ];
                    $listarublica = [
                        'codigo'=>[],
                        'rublica'=>[],
                        'quantidade'=>[],
                        'valor'=>[],
                        'total'=>[]
                    ];
                    $totaltrabalhado = 0;
                    $totaltomadors = 0;
                    $quantgeral = 0;
                    foreach ($boletim as $i => $lancamentorublica) {
                        if ($lancamentorublica->lsstatus === 'M') {
                            if (!in_array($lancamentorublica->liboletim,$rublica['numero'])) {
                                array_push($rublica['numero'],$lancamentorublica->liboletim);
                                array_push($rublica['data'],$lancamentorublica->lsdata);
                                foreach ($lancamentorublica->lancamentorublica as $key => $lancamentorublica1) {
                                if (!in_array($lancamentorublica1->licodigo,$listarublica['codigo'])) {
                                    array_push($listarublica['codigo'],$lancamentorublica1->licodigo);
                                    array_push($listarublica['rublica'],$lancamentorublica1->lshistorico);
                                    array_push($listarublica['quantidade'],horas_em_segundos($lancamentorublica1->lsquantidade));
                                    // array_push($listarublica['codigo'],$lancamentorublica1->liboletim);
                                }else{
                                    $ch =  array_search($lancamentorublica1->licodigo,$listarublica['codigo']);
                                    $listarublica['quantidade'][$ch] += horas_em_segundos($lancamentorublica1->lsquantidade);
                                }
                                   $chaver =  array_search($lancamentorublica->liboletim,$rublica['numero']);
                                   if (!array_key_exists($chaver,$rublica['vfolhar'])) {
                                        array_push($rublica['vfolhar'],$lancamentorublica1->lfvalor * horas_em_segundos($lancamentorublica1->lsquantidade));
                                        $totaltrabalhado += $lancamentorublica1->lfvalor * horas_em_segundos($lancamentorublica1->lsquantidade);
                                   }else{
                                        $rublica['vfolhar'][$chaver] += $lancamentorublica1->lfvalor * horas_em_segundos($lancamentorublica1->lsquantidade);
                                        $totaltrabalhado += $lancamentorublica1->lfvalor * horas_em_segundos($lancamentorublica1->lsquantidade);
                                   }
                                   if (!array_key_exists($chaver,$rublica['vboletim'])) {
                                        array_push($rublica['vboletim'],$lancamentorublica1->lftomador * horas_em_segundos($lancamentorublica1->lsquantidade));
                                        $totaltomadors += $lancamentorublica1->lftomador * horas_em_segundos($lancamentorublica1->lsquantidade);
                                    }else{
                                        $rublica['vboletim'][$chaver] += $lancamentorublica1->lftomador * horas_em_segundos($lancamentorublica1->lsquantidade);
                                        $totaltomadors += $lancamentorublica1->lftomador * horas_em_segundos($lancamentorublica1->lsquantidade);
                                    }
                                }
                            }
                        }
                    }
                    
                    $quantgeral += count($rublica['numero']);

                ?>
                @foreach($rublica['numero'] as $r => $rublicavalor)
                    <tr>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                          {{$rublicavalor}}
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                            {{date('d/m/Y',strtotime($rublica['data'][$r]))}}
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao"> 
                        {{number_format((float)$rublica['vfolhar'][$r], 2, ',', '.')}}
                        </td>
                        <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                        {{number_format((float)$rublica['vboletim'][$r], 2, ',', '.')}}
                        </td>
                    </tr>
                @endforeach
            </table>
                    
            <table>
                <tr>

                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Quantidade:  {{count($rublica['numero'])}} </td>
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
            <?php
                $valortotal = 0;
                $valortomador = 0;
                 $rublica = [
                    'numero'=>[],
                    'data'=>[],
                    'vfolhar'=>[],
                    'vboletim'=>[]
                ];
                foreach ($boletim as $i => $bolcartaoponto) {
                    if ($bolcartaoponto->lsstatus === 'D') {
                        if (!in_array($bolcartaoponto->liboletim,$rublica['numero'])) {
                            array_push($rublica['numero'],$bolcartaoponto->liboletim);
                            array_push($rublica['data'],$bolcartaoponto->lsdata);
                            foreach ($bolcartaoponto->tomador->tabelapreco as $key => $tabelapreco) {
                                foreach ($bolcartaoponto->bolcartaoponto as $key => $bolcartaoponto1) {
                                    if ($tabelapreco->tsrubrica == 1003 && $bolcartaoponto1->bshoraex) {
                                        $valortotal += calculovalores($bolcartaoponto1->bshoraex,$tabelapreco->tsvalor);
                                        if (!in_array($tabelapreco->tsrubrica,$listarublica['codigo'])) {
                                            array_push($listarublica['codigo'],$tabelapreco->tsrubrica);
                                            array_push($listarublica['rublica'],$tabelapreco->tsdescricao);
                                            array_push($listarublica['quantidade'],horas_em_segundos($bolcartaoponto1->bshoraex));
                                            // array_push($listarublica['codigo'],$lancamentorublica1->liboletim);
                                        }else{
                                            $ch =  array_search($tabelapreco->tsrubrica,$listarublica['codigo']);
                                            $listarublica['quantidade'][$ch] += horas_em_segundos($bolcartaoponto1->bshoraex);
                                        }
                                    }elseif($tabelapreco->tsrubrica == 1002 && $bolcartaoponto1->horas_normais){
                                        $valortotal += calculovalores($bolcartaoponto1->horas_normais,$tabelapreco->tsvalor);
                                        if (!in_array($tabelapreco->tsrubrica,$listarublica['codigo'])) {
                                            array_push($listarublica['codigo'],$tabelapreco->tsrubrica);
                                            array_push($listarublica['rublica'],$tabelapreco->tsdescricao);
                                            array_push($listarublica['quantidade'],horas_em_segundos($bolcartaoponto1->horas_normais));
                                            // array_push($listarublica['codigo'],$lancamentorublica1->liboletim);
                                        }else{
                                            $ch =  array_search($tabelapreco->tsrubrica,$listarublica['codigo']);
                                            $listarublica['quantidade'][$ch] += horas_em_segundos($bolcartaoponto1->horas_normais);
                                        }
                                    }elseif($tabelapreco->tsrubrica == 1004 && $bolcartaoponto1->bshoraexcem){
                                        $valortotal += calculovalores($bolcartaoponto1->bshoraexcem,$tabelapreco->tsvalor);
                                        if (!in_array($tabelapreco->tsrubrica,$listarublica['codigo'])) {
                                            array_push($listarublica['codigo'],$tabelapreco->tsrubrica);
                                            array_push($listarublica['rublica'],$tabelapreco->tsdescricao);
                                            array_push($listarublica['quantidade'],horas_em_segundos($bolcartaoponto1->bshoraexcem));
                                            // array_push($listarublica['codigo'],$lancamentorublica1->liboletim);
                                        }else{
                                            $ch =  array_search($tabelapreco->tsrubrica,$listarublica['codigo']);
                                            $listarublica['quantidade'][$ch] += horas_em_segundos($bolcartaoponto1->bshoraexcem);
                                        }
                                    }elseif ($tabelapreco->tsrubrica == 1005 && $bolcartaoponto1->bsadinortuno) {
                                        $valortotal += calculovalores($bolcartaoponto1->bsadinortuno,$tabelapreco->tsvalor);
                                        if (!in_array($tabelapreco->tsrubrica,$listarublica['codigo'])) {
                                            array_push($listarublica['codigo'],$tabelapreco->tsrubrica);
                                            array_push($listarublica['rublica'],$tabelapreco->tsdescricao);
                                            array_push($listarublica['quantidade'],horas_em_segundos($bolcartaoponto1->bsadinortuno));
                                            // array_push($listarublica['codigo'],$lancamentorublica1->liboletim);
                                        }else{
                                            $ch =  array_search($tabelapreco->tsrubrica,$listarublica['codigo']);
                                            $listarublica['quantidade'][$ch] += horas_em_segundos($bolcartaoponto1->bsadinortuno);
                                        }
                                    }
                                   
                                }
                            }
                            $chaver =  array_search($bolcartaoponto->liboletim,$rublica['numero']);
                            if (!array_key_exists($chaver,$rublica['vfolhar'])) {
                                 array_push($rublica['vfolhar'],$valortotal);
                                 $totalfolhar += $valortotal;
                            }else{
                                 $rublica['vfolhar'][$chaver] += $valortotal;
                                 $totalfolhar += $valortotal;
                            }
                            foreach ($bolcartaoponto->tomador->tabelapreco as $key => $tabelapreco) {
                                foreach ($bolcartaoponto->bolcartaoponto as $key => $bolcartaoponto1) {
                                    if ($tabelapreco->tsrubrica == 1003 && $bolcartaoponto1->bshoraex) {
                                        $valortomador += calculovalores($bolcartaoponto1->bshoraex,$tabelapreco->tstomvalor);
                                    }elseif($tabelapreco->tsrubrica == 1002 && $bolcartaoponto1->horas_normais){
                                        $valortomador += calculovalores($bolcartaoponto1->horas_normais,$tabelapreco->tstomvalor);
                                    }elseif($tabelapreco->tsrubrica == 1004 && $bolcartaoponto1->bshoraexcem){
                                        $valortomador += calculovalores($bolcartaoponto1->bshoraexcem,$tabelapreco->tstomvalor);
                                    }elseif ($tabelapreco->tsrubrica == 1005 && $bolcartaoponto1->bsadinortuno) {
                                        $valortomador += calculovalores($bolcartaoponto1->bsadinortuno,$tabelapreco->tstomvalor);
                                    }
                                   
                                }
                            }
                           
                            $chaver =  array_search($bolcartaoponto->liboletim,$rublica['numero']);
                            if (!array_key_exists($chaver,$rublica['vboletim'])) {
                                 array_push($rublica['vboletim'],$valortomador);
                                 $totaltomador += $valortomador;
                            }else{
                                 $rublica['vboletim'][$chaver] += $valortomador;
                                 $totaltomador += $valortomador;
                            }
                        }
                    }
                }
                $quantgeral += count($rublica['numero']);
            ?>
            @foreach($rublica['numero'] as $r => $rublicas)
                
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">{{$rublicas}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                    {{date('d/m/Y',strtotime($rublica['data'][$r]))}}
                    </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                       
                    {{number_format((float)$rublica['vfolhar'][$r], 2, ',', '.')}}
                    </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao">
                       
                    {{number_format((float)$rublica['vboletim'][$r], 2, ',', '.')}}
                    </td>
                </tr>
                
                @endforeach
            </table>
           
            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Quantidade:  {{count($rublica['numero'])}} </td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">Total ====></td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">{{number_format((float)$totalfolhar, 2, ',', '.')}}</td>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold">{{number_format((float)$totaltomador, 2, ',', '.')}}</td>
                </tr>
            </table>

            <table class="margin-top2 margin-bottom2">
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font text-center padrao destaque text-bold fontbig">Total Quantidade:  {{$quantgeral}} </td>
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
                
                @foreach ($boletim[0]->tomador->tabelapreco as $key => $tabelapreco) {
                    @foreach($listarublica['codigo'] as $e => $listarublicas)
                        @if($listarublicas == $tabelapreco->tsrubrica)
                            <tr>
                                <td class="border-left border-top border-bottom border-right small__font text-center cod">{{$listarublicas}}</td>
                                <td class="border-left border-top border-bottom border-right small__font text-center desc">{{$tabelapreco->tsdescricao}}</td>
                                <td class="border-left border-top border-bottom border-right small__font text-center pad2">{{number_format((float)$listarublica['quantidade'][$e], 2, ',', '.')}}</td>
                                <td class="border-left border-top border-bottom border-right small__font text-center pad2">999.999.999,99</td>
                                <td class="border-left border-top border-bottom border-right small__font text-center pad2">999.999.999,99</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                
            </table>

            <table>
                <tr>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center total__bol">Total dos Boletins</td>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center pad3"></td>
                </tr>

                <tr>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center total__bol">Total de Diárias</td>
                    <td class="border-left border-top border-bottom border-right small__font destaque text-bold text-center pad3"></td>
                </tr>
            </table>
        </div>
    </body>