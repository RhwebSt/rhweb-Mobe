<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Cartão Ponto</title>
    </head>

    <style>

        @page { 
          margin-top: 168.5px; 
          margin-bottom: 50px;
          margin-left: 10px;
          margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -168.5px; right: 0px; height: 168.5px; background-color:; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 60px; text-align: end; }
        #footer .page:after { content: counter(page, upper); }


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
            width: 1100px;
        }

        .width__padrao{
            width:576px;
        }

        .titulo{
            margin-top:10px;
            margin-bottom: 10px;
        }

        .planilha{
            width:732px;
        }

        .boletim{
            width:180.5px;
        }

        .data__ref{
            width:181.2px;
        }

        .valor__padrao{
            width: 181.2px;
        }

        .nome{
            width: 353px;
        }
        
        .nome2{
            width: 357px;
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
            width: 166.7px;
            height:8px;
        }

        .vazio{
            width: 358px;
        }

        .fontex{
            font-size: 10px;
        }

        .white{
            color: white;
        }

        .totalizacao{
            width:337.7px;
        }

        .qtnd__trab{
            width:357px;
        }
        
        .margin-top{
            margin-top: 10px;
        }
        
        .margin-bottom{
            margin-bottom: 10px;
        }

        .padding-footer{
            padding: 2px;
            width:99.6%;
        }
        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }



        </style>

        <body>
            <div id="header">
            
                <table class="margin-top">
                    <tr>
                        <td class="name__title border-right border-left border-bottom border-top destaque text-center text-bold">{{$lancamentotabelas[0]->esnome}}</td>
                    </tr>
                </table>
    
                <table>
                    <tr>
                        <td class="small__font planilha text-bold border-top border-bottom border-left border-right text-center">Planilha do Cartão Ponto - 9999</td>
                        <td class="small__font boletim text-center border-top border-bottom border-left border-right  text-bold">Boletim N° {{$lancamentotabelas[0]->liboletim}}</td>
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
    
                <table class="margin-bottom">
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
                    <td class="small__font border-top border-bottom border-left text-center text-bold destaque nome2">Nome</td>
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
                </table>
                
            </div>
            
            <div id="footer">
              <p class="page destaque borderT padding-footer">Página:  </p>
            </div>
            
            <div id="content">
                <table>
                    
                    <?php
                        $totalfolhar = 0;
                        $totaltomador = 0;
                        function calculovalores($horas,$valores)
                        {
                            list($horas,$minitos) = explode(':',$horas);
                            $horasex = $horas * 3600 + $minitos * 60;
                            $horasex = $horasex/60;
                            $horasex = $valores * ($horasex/60);
                            return $horasex;
                        }
                    ?>
                    @foreach($lancamentotabelas as $lancamentotabela)
                    <tr>
                        <td class="small__font border-top border-bottom border-left nome spacing uppercase">{{$lancamentotabela->trabalhadornome}}</td>
                        <td class="small__font border-top border-bottom border-left ent text-center">{{$lancamentotabela->bsentradamanhao?$lancamentotabela->bsentradamanhao:' '}}</td>
                        <td class="small__font border-top border-bottom border-left pad text-center">{{$lancamentotabela->bssaidamanhao?$lancamentotabela->bssaidamanhao:' '}}</td>
                        <td class="small__font border-top border-bottom border-left ent  text-center">{{$lancamentotabela->bsentradatarde?$lancamentotabela->bsentradatarde:' '}}</td>
                        <td class="small__font border-top border-bottom border-left pad text-center">{{$lancamentotabela->bssaidatarde?$lancamentotabela->bssaidatarde:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center ent ">{{$lancamentotabela->bsentradanoite?$lancamentotabela->bsentradanoite:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bssaidanoite?$lancamentotabela->bssaidanoite:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center ent ">{{$lancamentotabela->bsentradamadrugada?$lancamentotabela->bsentradamadrugada:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bssaidamadrugada?$lancamentotabela->bssaidamadrugada:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center normais">{{$lancamentotabela->horas_normais?$lancamentotabela->horas_normais:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bshoraex?$lancamentotabela->bshoraex:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$lancamentotabela->bshoraexcem?$lancamentotabela->bshoraexcem:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center adcnot">{{$lancamentotabela->bsadinortuno?$lancamentotabela->bsadinortuno:' '}}</td>
                        <td class="small__font border-top border-bottom border-left text-center valor">
                           <?php
                                $valortotal = 0;
                                foreach ($tabelaprecos as $key => $value) {
                                    if ($value->tsdescricao == 'hora extra 50%' && $lancamentotabela->bshoraex) {
                                        $valortotal += calculovalores($lancamentotabela->bshoraex,$value->tsvalor);
                                    }elseif($value->tsdescricao == 'hora normal' && $lancamentotabela->horas_normais){
                                        $valortotal += calculovalores($lancamentotabela->horas_normais,$value->tsvalor);
                                    }elseif($value->tsdescricao == 'hora extra 100%' && $lancamentotabela->bshoraexcem){
                                        $valortotal += calculovalores($lancamentotabela->bshoraexcem,$value->tsvalor);
                                    }elseif ($value->tsdescricao == 'adicional noturno' && $lancamentotabela->bsadinortuno) {
                                        $valortotal += calculovalores($lancamentotabela->bsadinortuno,$value->tsvalor);
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
                                        $valortomador += calculovalores($lancamentotabela->bshoraex,$value->tstomvalor);
                                    }elseif($value->tsdescricao == 'hora normal' && $lancamentotabela->horas_normais){
                                        $valortomador += calculovalores($lancamentotabela->horas_normais,$value->tstomvalor);
                                    }elseif($value->tsdescricao == 'hora extra 100%' && $lancamentotabela->bshoraexcem){
                                        $valortomador += calculovalores($lancamentotabela->bshoraexcem,$value->tstomvalor);
                                    }elseif ($value->tsdescricao == 'adicional noturno' && $lancamentotabela->bsadinortuno) {
                                        $valortomador += calculovalores($lancamentotabela->bsadinortuno,$value->tstomvalor);
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
                        <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left qtnd__trab">Quantidades de Trabalhadores: {{count($trabalhadors)}}</td>
                        <td class="small__font border-top border-bottom text-center text-bold destaqueDark border-left totalizacao">Totalizações</td>
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
            </div>
        
        </body>