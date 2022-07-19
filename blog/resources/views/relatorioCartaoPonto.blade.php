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
          margin-top: 300px; 
          margin-bottom: 50px;
          margin-left: 10px;
          margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -300px; right: 0px; height: 300px; background-color:; text-align: center; }
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
            /*border-top-left-radius: 3px;*/
            /*border-top-right-radius: 3px;*/
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
            width: 179px;
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

        <body>
            <div id="header">
            
                <div class="borderT margin-top"> 
                    <table>
                        <tr>
                            <td rowspan="7" style="padding-left: 15px">
                                @if($lancamentotabelas->empresa->esfoto)
                                    <img class="logo" src="{{$lancamentotabelas->empresa->esfoto}}" alt="" srcset="">
                                @else
                                    @include('imagem')
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="padding-left-foto text-bold">{{$lancamentotabelas->empresa->esnome}}</td>
                        </tr>
            
                        <tr>
                            <td class="small__font padding-left-foto">CNPJ/MF Nroº : {{$lancamentotabelas->empresa->escnpj}}</td>
                        </tr>
            
                        <tr>
                            <td class="small__font padding-left-foto">Rua: {{$lancamentotabelas->empresa->endereco[0]->eslogradouro}}, {{$lancamentotabelas->empresa->endereco[0]->esnum}} - {{$lancamentotabelas->empresa->endereco[0]->escep}}</td>
                        </tr>
            
                        <tr>
                            <td class="small__font padding-left-foto">Bairro: {{$lancamentotabelas->empresa->endereco[0]->esbairro}} - {{$lancamentotabelas->empresa->endereco[0]->esuf}}</td>
                        </tr>
            
                        <tr>
                            <td class="small__font padding-left-foto">Tel: {{$lancamentotabelas->empresa->estelefone}}</td>
                        </tr>
            
                    </table>
                </div>

                <table class="margin-top">
                    <tr>
                        <td class="small__font planilha text-bold text-center uppercase">Planilha do Cartão Ponto</td>
                        <td class="small__font boletim text-center  text-bold">Boletim N° {{$lancamentotabelas->liboletim}}</td>
                        <td class="small__font text-center data__ref text-bold">Data Referência:
                       
                         {{date('d/m/Y',strtotime($lancamentotabelas->lsdata))}}
                        </td>
                    </tr>
                </table>
                
                <div class="borderT margin-top">
                    <table class="margin-top" style="padding-left: 5px; padding-bottom: 5px;">
                        <tr>
                            <td class="small__font text-center text-bold valor__padrao destaque">Valor</td>
                            <td class="small__font text-center text-bold valor__padrao  destaque">Diária</td>
                            <td class="small__font text-center text-bold valor__padrao  destaque">Hora</td>
                            <td class="small__font text-center text-bold valor__padrao  destaque">Hora Extra 50%</td>
                            <td class="small__font text-center text-bold valor__padrao  destaque">Hora Extra 100%</td>
                            <td class="small__font text-center text-bold valor__padrao  destaque">Adicional Noturno</td>
                        </tr>
        
                        <tr>
                            <td class="small__font text-center border-bottom valor__padrao">Base Empresa</td>
                            <td class="small__font text-center border-bottom valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1000 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center border-bottom valor__padrao">R$
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1002 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center border-bottom valor__padrao">R$
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1003 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center border-bottom valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1004 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center border-bottom valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1005 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
        
                        <tr>
                            <td class="small__font text-center valor__padrao">Base Folha</td>
                            <td class="small__font text-center valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1000 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center valor__padrao">R$
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1002 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1003 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1004 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center valor__padrao">R$ 
                                @foreach($tomador->tabelapreco as $tabelapreco)
                                    @if($tabelapreco->tsrubrica == 1005 && $tabelapreco->tsano == date('Y'))
                                        {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="margin-top">
                    <table>
                        <tr>
                            <td class="name__title text-center text-bold">Boletim Cartão Ponto - Diário</td>
                        </tr>
                    </table>
                </div>

                <table class="margin-top">
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
              <p class="page padding-footer" style="text-align: right">Página:  </p>
            </div>
            
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
            <div id="content">
               
                <table>
                    
                  
                    @foreach($bolcartaoponto as $bolcartaopontos)
                
                    <tr>
                        
                        <td class="small__font border-top border-bottom border-left nome spacing uppercase">{{$bolcartaopontos->trabalhador->tsnome}}</td>
                        <td class="small__font border-top border-bottom border-left ent text-center">{{$bolcartaopontos->bsentradamanhao}}</td>
                        <td class="small__font border-top border-bottom border-left pad text-center">{{$bolcartaopontos->bssaidamanhao}}</td>
                        <td class="small__font border-top border-bottom border-left ent  text-center">{{$bolcartaopontos->bsentradatarde}}</td>
                        <td class="small__font border-top border-bottom border-left pad text-center">{{$bolcartaopontos->bssaidatarde}}</td>
                        <td class="small__font border-top border-bottom border-left text-center ent ">{{$bolcartaopontos->bsentradanoite}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$bolcartaopontos->bssaidanoite}}</td>
                        <td class="small__font border-top border-bottom border-left text-center ent ">{{$bolcartaopontos->bsentradamadrugada}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$bolcartaopontos->bssaidamadrugada}}</td>
                        <td class="small__font border-top border-bottom border-left text-center normais">{{$bolcartaopontos->horas_normais}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$bolcartaopontos->bshoraex}}</td>
                        <td class="small__font border-top border-bottom border-left text-center pad">{{$bolcartaopontos->bshoraexcem}}</td>
                        <td class="small__font border-top border-bottom border-left text-center adcnot">{{$bolcartaopontos->bsadinortuno}}</td>
                        <td class="small__font border-top border-bottom border-left text-center valor">
                           <?php
                                $valortotal = 0; 
                                foreach ($tomador->tabelapreco as $key => $value) {
                                    if ($value->tsdescricao == 'hora extra 50%' && $bolcartaopontos->bshoraex && $value->tsano == date('Y')) {
                                        $valortotal += calculovalores($bolcartaopontos->bshoraex,$value->tsvalor);
                                    }elseif($value->tsdescricao == 'hora normal' && $bolcartaopontos->horas_normais && $value->tsano == date('Y')){
                                        $valortotal += calculovalores($bolcartaopontos->horas_normais,$value->tsvalor );
                                    }elseif($value->tsdescricao == 'hora extra 100%' && $bolcartaopontos->bshoraexcem && $value->tsano == date('Y')){
                                        $valortotal += calculovalores($bolcartaopontos->bshoraexcem,$value->tsvalor);
                                    }elseif ($value->tsdescricao == 'adicional noturno' && $bolcartaopontos->bsadinortuno && $value->tsano == date('Y')) {
                                        $valortotal += calculovalores($bolcartaopontos->bsadinortuno,$value->tsvalor);
                                    }
                                }
                                $totalfolhar += $valortotal;
                                echo(number_format((float)$valortotal, 2, ',', ''));
                           ?>
                        </td>
                        <td class="small__font border-top border-bottom border-left border-right text-center valor">
                            <?php
                                $valortomador = 0;
                                foreach ($tomador->tabelapreco as $key => $value) {
                                    if ($value->tsdescricao == 'hora extra 50%' && $bolcartaopontos->bshoraex  && $value->tsano == date('Y')) {
                                        $valortomador += calculovalores($bolcartaopontos->bshoraex,$value->tstomvalor);
                                    }elseif($value->tsdescricao == 'hora normal' && $bolcartaopontos->horas_normais  && $value->tsano == date('Y')){
                                        $valortomador += calculovalores($bolcartaopontos->horas_normais,$value->tstomvalor);
                                    }elseif($value->tsdescricao == 'hora extra 100%' && $bolcartaopontos->bshoraexcem && $value->tsano == date('Y')){
                                        $valortomador += calculovalores($bolcartaopontos->bshoraexcem,$value->tstomvalor);
                                    }elseif ($value->tsdescricao == 'adicional noturno' && $bolcartaopontos->bsadinortuno && $value->tsano == date('Y')) {
                                        $valortomador += calculovalores($bolcartaopontos->bsadinortuno,$value->tstomvalor);
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
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left qtnd__trab">Quantidades de Trabalhadores:{{$bolcartaoponto->count()}}</td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left totalizacao">Totalizações</td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left normais">
                            <?php
                                $horasnormal = 0;
                                foreach ($bolcartaoponto as $key => $value) {
                                    if ($value->horas_normais) {
                                        list($horas,$minitos) = explode(':',$value->horas_normais);
                                        $horasnormal += $horas * 3600 + $minitos * 60;
                                    }
                                }
                                echo segundo_em_horas($horasnormal);
                            ?>
                        </td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left pad">
                            <?php
                                $horasex = 0;
                                foreach ($bolcartaoponto as $key => $value) {
                                    if ($value->bshoraex) {
                                        list($horas,$minitos) = explode(':',$value->bshoraex);
                                        $horasex += $horas * 3600 + $minitos * 60;
                                    }
                                }
                                echo segundo_em_horas($horasex);
                            ?>
                        </td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left pad">
                            <?php
                                $horascem = 0;
                                foreach ($bolcartaoponto as $key => $value) {
                                    if ($value->bshoraexcem) {
                                        list($horas,$minitos) = explode(':',$value->bshoraexcem);
                                        $horascem += $horas * 3600 + $minitos * 60;
                                    }
                                }
                                echo segundo_em_horas($horascem);
                            ?>
                        </td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left adcnot">
                            <?php
                                $noturno = 0;
                                foreach ($bolcartaoponto as $key => $value) {
                                    if ($value->bsadinortuno) {
                                        list($horas,$minitos) = explode(':',$value->bsadinortuno);
                                        $noturno += $horas * 3600 + $minitos * 60;
                                    }
                                }
                                echo segundo_em_horas($noturno);
                            ?>
                        </td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left valor">R$ {{number_format((float)$totalfolhar, 2, ',', '')}}</td>
                        <td class="small__font border-top border-bottom text-center text-bold destaque border-left border-right valor">R$ {{number_format((float)$totaltomador, 2, ',', '')}}</td>
                    </tr>
                </table>
            </div>
        
        </body>