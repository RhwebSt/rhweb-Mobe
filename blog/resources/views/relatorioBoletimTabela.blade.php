<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Relatório Boletim com Tabela</title>
    </head>

    <style>

         @page { 
          margin-top: 90px; 
          margin-bottom: 80px;
          margin-left: 10px;
          margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -90px; right: 0px; height: 90px; background-color:; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -80px; right: 0px; height: 80px; text-align: end; }
        #footer .page:after { content: counter(page, upper); }

        table{
            border-collapse: collapse;
        }
        
        .padding-left{
            padding-left: 5px;
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

        .name__title{
            width: 769px;
        }

        .firtprad{
            width: 254.7px;
        }

        .tomador{
            margin-top:10px;
        }

        .matric{
            width: 60px;
        }

        .nome{
            width: 706px;
        }

        .desc{
            width:400px;
        }
        
        .descri{
            width:347px;
        }

        .quant{
            width:110px;
        }

        .valor__total{
            width:190px;
        }
        
        .valor__totalss{
            width:120px;
        }

        .total__receber{
            width:572px;
        }
        
        .empregados{
            width:519px;
        }

        .valor__receber{
            width: 190px;
        }
        
        .total__geral{
            width: 120px;
        }

        .font__receber{
            font-size: 14px;
        }
        
        .margin-tp{
            margin-top: 20px;
        }
        
        .margin-bt{
            margin-bottom: 15px;
        }
        
        .erro{
            width: 763px;
        }
        
        .destaque2{
            background-color: #BABAC9;
        }
        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }

        .margin-top{
            margin-top: 10px;
        }

        .padding-footer{
            padding: 2px;
        }


    </style>
    
    <body>
        <div id="header">
            <table class="margin-top">
                <tr>
                    <td class="small__font  border-top border-bottom border-right firtprad text-center border-left destaque2 text-bold">Boletim Nº: {{$lancamentotabelas[0]->liboletim}}</td>
                    <td class="small__font border-top border-bottom border-right firtprad text-center destaque2 text-bold">Data do Boletim:
                        @if(isset($lancamentotabelas[0]->lsdata))
                            <?php
                                $data = explode('-',$lancamentotabelas[0]->lsdata);
                                $data2 = $data[2].'/'.$data[1].'/'.$data[0];
                            ?>
                            {{$data2}}
                        @endif
                    </td>
                    <td class="small__font border-top border-bottom border-right firtprad text-center destaque2 text-bold">Ano Referência: {{$data[0]}}</td>
                    
                </tr>
            </table>
        
            <table>
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark uppercase">{{$lancamentotabelas[0]->esnome}}</td>
                </tr>
            </table>
        
            <table class="tomador">
                <tr>
                    <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque uppercase">{{$lancamentotabelas[0]->tsnome}}</td>
                </tr>
            </table>
        
        </div>
        
        <div id="footer">
          <p class="page destaque borderT padding-footer">Página:  </p>
        </div>
        
        <div id="content">
               @if(count($trabalhadors) > 0)
                 @foreach($trabalhadors as $trabalhador)
                 <?php
                    $valor = 0;
                ?>
                <table>
                    <tr>
                        <td class="border-left border-right border-top border-bottom small__font text-bold matric text-center destaque2">{{$trabalhador->tsmatricula}}</td>
                        <td class="border-left border-right border-top border-bottom small__font text-bold  text-center nome destaque2 uppercase">{{$trabalhador->tsnome}}</td>
                    </tr>
                </table>
                 
                        <table>
                            <tr>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold matric text-center">Código</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center desc">Descrição</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center quant">Quantidade</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center valor__total">Valor Total</td>
                            </tr>
                            @foreach($lancamentotabelas as $lancamentotabela)
                            @if($lancamentotabela->trabalhador === $trabalhador->id)
                            <tr>
                                <td class="border-left border-right border-top border-bottom small__font matric text-center">{{$lancamentotabela->licodigo}}</td>
                                <td class="border-left border-right border-top border-bottom small__font text-center desc uppercase">{{$lancamentotabela->lshistorico}}</td>
                                <td class="border-left border-right border-top border-bottom small__font text-center quant">{{$lancamentotabela->lsquantidade}}</td>
                                <td class="border-left border-right border-top border-bottom small__font text-center valor__total">R$ {{number_format((float)$lancamentotabela->lsquantidade * $lancamentotabela->lfvalor, 2, ',', '')}}</td>
                            </tr>
                            <?php
                                $valor += $lancamentotabela->lsquantidade * $lancamentotabela->lfvalor
                            ?>
                            @endif
                            @endforeach
                        </table>
                       
                        <table class="">
                            <tr>
                                <td class="border-left border-right border-top border-bottom small__font destaque text-bold total__receber font__receber padding-left">Total</td>
                                <td class="border-left border-right border-top border-bottom small__font destaque text-bold valor__receber text-center font__receber">R$ {{number_format((float)$valor, 2, ',', '')}}
                                </td>
                            </tr>
                        </table>
                        
                        
                      
                      
                   
                @endforeach
                <table class="margin-tp">
                            <tr>
                                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">Resumo do Boletim</td>
                            </tr>
                        </table>
                        
                        <table>
                             <tr>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold matric text-center">Código</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center descri">Descrição</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center quant">Quantidade</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center valor__totalss">Valor Trabalhador</td>
                                <td class="border-left border-right border-top border-bottom destaque small__font text-bold  text-center valor__totalss">Valor Tomador</td>
                            </tr>
                            <?php
                                $dados = [];
                                $total = 0;
                                foreach ($lancamentotabelas as $key => $value) {
                                    if (!in_array($value->licodigo, $dados)) {
                                        array_push($dados,$value->licodigo.':'.$value->lshistorico);
                                    }
                                }
                                foreach ($dados as $key => $value) {
                                    $codigo = explode(':',$value);
                                    $quantidade = 0;
                                    $valor = 0;
                                    $valor2 = 0;
                                    foreach ($lancamentotabelas as $key => $value) {
                                        if ($value->licodigo == $codigo[0]) {
                                            $quantidade += $value->lsquantidade;
                                            $valor += ($value->lfvalor * $value->lsquantidade);
                                            $valor2 += ($value->lftomador * $value->lsquantidade);
                                        }
                                    }
                                    echo'<tr>
                                        <td class="border-left border-right border-top border-bottom small__font matric text-center">
                                        '.$codigo[0].'
                                        </td>
                                        <td class="border-left border-right border-top border-bottom small__font text-center desc2 uppercase">
                                        '.$codigo[1].'
                                        </td>
                                        <td class="border-left border-right border-top border-bottom small__font text-center quant">'.$quantidade.'</td>
                                        <td class="border-left border-right border-top border-bottom small__font text-center valor__totalss">R$ '.number_format((float)$valor, 2, ',', '').'</td>
                                        <td class="border-left border-right border-top border-bottom small__font text-center valor__totalss">R$ '.number_format((float)$valor2, 2, ',', '').'</td>
                                    </tr>';
                                    $total += $valor;
                                }
                              
                               
                            ?>
                                
                            
                        </table>
                        
                        <table>
                            <tr>
                                <td class="border-left border-right border-top border-bottom small__font destaqueDark text-bold empregados small__font padding-left ">Numero de Empregados: {{count($trabalhadors)}}</td>
                                <td class="border-left border-right border-top border-bottom small__font destaqueDark text-bold total__geral text-center small__font">R$ {{number_format((float)$total, 2, ',', '')}}</td>
                                <td class="border-left border-right border-top border-bottom small__font destaqueDark text-bold total__geral text-center small__font">R$ 999.999.999,99</td>
                            </tr>
                        </table>
                        @else
                        
                        <table>
                            <tr>
                                <td class="border-right border-bottom border-top border-left destaque2 erro text-center text-bold" > Não á Nenhum Boletim Cadastrado</td>
                            </tr>
                        </table>
                    @endif
                </div>
            
    </body>    