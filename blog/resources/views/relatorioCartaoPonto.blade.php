<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Cartão Ponto</title>
    </head>

    <style>

        *{
            margin: 5px;
            padding: 0px;
        }


        .spacing{
            padding-left:5px;
        }

        table{
            border-collapse: collapse;
        }

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
            width: 1090px;
        }

        .width__padrao{
            width:576px;
        }

        .titulo{
            margin-top:10px;
            margin-bottom: 10px;
        }

        .planilha{
            width:800px;
        }

        .boletim{
            width:124px;
        }

        .data__ref{
            width:164px;
        }

        .valor__padrao{
            width: 181.2px;
        }

        .nome{
            width: 370px;
        }

        .pad{
            width: 45px;
        }

        .ent{
            width:35px;
        }

        .valor{
            width: 93px;
        }

        .adcnot{
            width: 55px;
        }

        .normais{
            width: 57px; 
        }

        .diurno{
            width: 161px;
            height:8px;
        }

        .vazio{
            width: 376px;
        }

        .fontex{
            font-size: 10px;
        }

        .white{
            color: white;
        }

        .totalizacao{
            width:160px;
        }

        .qtnd__trab{
            width:539px;
        }



        </style>

        <body>
            
            <table>
                <tr>
                    <td class="name__title border-right border-left border-bottom border-top destaque text-center text-bold">{{$lancamentotabelas[0]->esnome}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font planilha text-bold border-top border-bottom border-left border-right">Planilha do Cartão Ponto - 9999</td>
                    <td class="small__font boletim text-center border-top border-bottom border-left border-right  text-bold">Boletim n° {{$lancamentotabelas[0]->liboletim}}</td>
                    <td class="small__font text-center data__ref border-top border-bottom border-left border-right text-bold">Data Referência:
                    @if(isset($lancamentotabelas[0]->lsdata))
                        <?php
                            $data = explode('-',$lancamentotabelas[0]->lsdata);
                            $data2 = $data[2].'/'.$data[1].'/'.$data[0];
                        ?>
                        {{$data2}}
                     @endif
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao destaque">Valor</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Diária</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Hora</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Hora Extra 50%</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao  destaque">Hora Extra 100%</td>
                    <td class="small__font border-top border-left border-bottom text-center text-bold valor__padrao border-right  destaque">Adicional Noturno</td>
                </tr>

                <tr>
                    <td class="small__font border-left border-bottom text-center valor__padrao">Base Empresa</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'diaria normal')
                                {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'hora normal')
                                {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'hora extra 50%')
                                {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'hora extra 100%')
                                {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao border-right">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'adicional noturno')
                                {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td class="small__font border-left border-bottom text-center valor__padrao">Base Folha</td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'diaria normal')
                                {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'hora normal')
                                {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'hora extra 50%')
                                {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'hora extra 100%')
                                {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                    <td class="small__font border-left border-bottom text-center valor__padrao border-right">R$ 
                        @foreach($tabelaprecos as $tabelapreco)
                            @if($tabelapreco->tsdescricao == 'adicional noturno')
                                {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                            @endif
                        @endforeach
                    </td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="name__title border-right border-left border-bottom border-top destaque text-center text-bold">Boletim Cartão Ponto - Diário</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class=" small__font vazio white">.</td>
                    <td class=" small__font border-top border-left border-right diurno text-center text-bold fontex">Diurno</td>
                    <td class=" small__font border-top border-left border-right  text-center diurno text-bold fontex">Noturno</td>
                    <td class="nome  small__font"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font border-top border-bottom border-left text-center text-bold destaque">Nome</td>
                    <td class="small__font border-top border-bottom border-left ent text-center text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left pad text-center text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left ent text-center text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left pad text-center text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left text-center ent text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left text-center ent text-bold destaque">Ent</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">Saída</td>
                    <td class="small__font border-top border-bottom border-left text-center normais text-bold destaque">Normais</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">50%</td>
                    <td class="small__font border-top border-bottom border-left text-center pad text-bold destaque">100%</td>
                    <td class="small__font border-top border-bottom border-left text-center adcnot text-bold destaque">Adc.Not</td>
                    <td class="small__font border-top border-bottom border-left text-center valor text-bold destaque">Valor Folha</td>
                    <td class="small__font border-top border-bottom border-left border-right text-center valor text-bold destaque">Valor Total</td>
                </tr>
                <?php
                    $totalfolhar = 0;
                    $totaltomador = 0;
                ?>
                @foreach($lancamentotabelas as $lancamentotabela)
                <tr>
                    <td class="small__font border-top border-bottom border-left nome spacing">{{$lancamentotabela->trabalhadornome}}</td>
                    <td class="small__font border-top border-bottom border-left ent text-center">{{$lancamentotabela->bsentradamanhao?$lancamentotabela->bsentradamanhao:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left pad text-center">{{$lancamentotabela->bssaidamanhao?$lancamentotabela->bssaidamanhao:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left ent  text-center">{{$lancamentotabela->bsentradatarde?$lancamentotabela->bsentradatarde:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left pad text-center">{{$lancamentotabela->bssaidatarde?$lancamentotabela->bssaidatarde:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center ent ">{{$lancamentotabela->bsentradanoite?$lancamentotabela->bsentradanoite:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bssaidanoite?$lancamentotabela->bssaidanoite:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center ent ">{{$lancamentotabela->bsentradamadrugada?$lancamentotabela->bsentradamadrugada:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bssaidamadrugada?$lancamentotabela->bssaidamadrugada:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center normais">{{$lancamentotabela->horas_normais?$lancamentotabela->horas_normais:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bshoraex?$lancamentotabela->bshoraex:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bshoraexcem?$lancamentotabela->bshoraexcem:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center adcnot">{{$lancamentotabela->bsadinortuno?$lancamentotabela->bsadinortuno:'00:00'}}</td>
                    <td class="small__font border-top border-bottom border-left text-center valor">
                       <?php
                            $valortotal = 0;
                            foreach ($tabelaprecos as $key => $value) {
                                if ($value->tsdescricao == 'hora extra 50%' && $lancamentotabela->bshoraex) {
                                    $horasex = explode(':',$lancamentotabela->bshoraex);
                                    $horasex = $horasex[0].'.'.$horasex[1];
                                    $horasex = $value->tsvalor * $horasex ;
                                    $valortotal += $horasex;
                                }elseif($value->tsdescricao == 'hora normal' && $lancamentotabela->horas_normais){
                                    $horasnormal = explode(':',$lancamentotabela->horas_normais);
                                    $horasnormal = $horasnormal[0].'.'.$horasnormal[1];
                                    $horasnormal = $value->tsvalor * $horasnormal;
                                    $valortotal += $horasnormal;
                                }elseif($value->tsdescricao == 'hora extra 100%' && $lancamentotabela->bshoraexcem){
                                    $horaexcem = explode(':',$lancamentotabela->bshoraexcem);
                                    $horaexcem = $horaexcem[0].'.'.$horaexcem[1];
                                    $horaexcem = $value->tsvalor * $horaexcem;
                                    $valortotal += $horaexcem;
                                }elseif ($value->tsdescricao == 'adicional noturno' && $lancamentotabela->bsadinortuno) {
                                    $noturno = explode(':',$lancamentotabela->bsadinortuno);
                                    $noturno = $noturno[0].'.'.$noturno[1];
                                    $noturno = $value->tsvalor * $noturno;
                                    $valortotal += $noturno;
                                }
                            }
                            $totalfolhar += $valortotal;
                            echo(number_format((float)$valortotal, 2, ',', ''));
                       ?>
                    </td>
                    <td class="small__font border-top border-bottom border-left border-right text-center valor">
                        <?php
                            $valortomador = 0;
                            foreach ($tabelaprecos as $key => $value) {
                                if ($value->tsdescricao == 'hora extra 50%' && $lancamentotabela->bshoraex) {
                                    $horasextomador = explode(':',$lancamentotabela->bshoraex);
                                    $horasextomador = $horasextomador[0].'.'.$horasextomador[1];
                                    $horasextomador = $value->tstomvalor * $horasextomador ;
                                    $valortomador += $horasextomador;
                                }elseif($value->tsdescricao == 'hora extra 100%' && $lancamentotabela->bshoraexcem){
                                    $tomadorexcem = explode(':',$lancamentotabela->bshoraexcem);
                                    $tomadorexcem = $tomadorexcem[0].'.'.$horaexcem[1];
                                    $tomadorexcem = $value->tstomvalor * $tomadorexcem;
                                    $valortomador += $tomadorexcem;
                                }elseif ($value->tsdescricao == 'adicional noturno' && $lancamentotabela->bsadinortuno) {
                                    $tomadornoturno = explode(':',$lancamentotabela->bsadinortuno);
                                    $tomadornoturno = $tomadornoturno[0].'.'.$tomadornoturno[1];
                                    $tomadornoturno = $value->tstomvalor * $tomadornoturno;
                                    $valortomador += $tomadornoturno;
                                }
                            }
                            $totaltomador += $valortomador;
                            echo(number_format((float)$valortomador, 2, ',', ''));
                        ?>
                    </td>
                </tr>
                @endforeach
            </table>
             <?php
                function segundo_em_horas($segundo)
                {
                    $horas = floor($segundo/3600);
                    $minitos = floor($segundo%3600/60);
                    return sprintf('%d:%02d',$horas,$minitos);
                }
             ?>
            <table>
                <tr>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left totalizacao">Totalizações</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left qtnd__trab">Quantidades de Trabalhadores: {{count($trabalhadors)}}</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left normais">
                        <?php
                            $horasnormal = 0;
                            foreach ($lancamentotabelas as $key => $value) {
                                if ($value->horas_normais) {
                                    list($horas,$minitos) = explode(':',$value->horas_normais);
                                    $horasnormal += $horas * 3600 + $minitos * 60;
                                }
                            }
                            echo segundo_em_horas($horasnormal);
                        ?>
                    </td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left pad">
                        <?php
                            $horasex = 0;
                            foreach ($lancamentotabelas as $key => $value) {
                                if ($value->bshoraex) {
                                    list($horas,$minitos) = explode(':',$value->bshoraex);
                                    $horasex += $horas * 3600 + $minitos * 60;
                                }
                            }
                            echo segundo_em_horas($horasex);
                        ?>
                    </td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left pad">
                        <?php
                            $horascem = 0;
                            foreach ($lancamentotabelas as $key => $value) {
                                if ($value->bshoraexcem) {
                                    list($horas,$minitos) = explode(':',$value->bshoraexcem);
                                    $horascem += $horas * 3600 + $minitos * 60;
                                }
                            }
                            echo segundo_em_horas($horascem);
                        ?>
                    </td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left adcnot">
                        <?php
                            $noturno = 0;
                            foreach ($lancamentotabelas as $key => $value) {
                                if ($value->bsadinortuno) {
                                    list($horas,$minitos) = explode(':',$value->bsadinortuno);
                                    $noturno += $horas * 3600 + $minitos * 60;
                                }
                            }
                            echo segundo_em_horas($noturno);
                        ?>
                    </td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left valor">R$ {{number_format((float)$totalfolhar, 2, ',', '')}}</td>
                    <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left border-right valor">R$ {{number_format((float)$totaltomador, 2, ',', '')}}</td>
                </tr>
            </table>
        
        
        </body>