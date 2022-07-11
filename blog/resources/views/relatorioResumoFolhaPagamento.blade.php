<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Resumo da Folha de Pagamento</title>
    </head>

    <style>

         @page { 
          margin-top: 350px; 
          margin-bottom: 80px;
          margin-left: 10px;
          margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: -350px; right: 0px; height: 350px; background-color:; text-align: center; }
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

        .medium__font{
            font-size: 14px;
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
        
        .logo{
            margin-top:10px;
            margin-right: 50px;
            width: 100px;
            height: 120px;
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

        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }
        
        .width__padrao{
            width:576px;
        }

        .margin-top{
            margin-top: 10px;
        }

        .padding-footer{
            padding: 2px;
        }
        
        .logo{
            width: 100px;
            height: 100px;
        }

        .padding-left-foto{
            padding-left: 20px;
        }

        .border-radius{
            border-radius: 10px;
            border: 1px solid black;
        }

        .nome__tomador{
            width: 700px;
        }

        .matricula__tomador{
            width: 67px;
        }

        .rua{
            width: 450px;
        }

        .padding-left-texto{
            padding-left: 3px;
        }

        .bairro{
            width: 330px;
        }

        .cidade{
            width: 330px;
        }

        .estado{
            width: 101px;
        }

        .cep, .cnpj, .tel{
            width: 252.58px;
        }

        .descricao{
            width: 613px;
        }

        .valor{
            width: 150px;
        }

        .data{
            width: 220px;
            padding: 10px;
        }

        .ass{
            width: 510px;
            padding: 10px;
        }

        .descri{
            width: 509px;
        }


        .porcentagem{
            width: 100px;
        }
        
        .name__title--evento{
            width: 755px;
        }
        
        .margin-left{
            margin-left:5px
        }
        
        .margin-bottom{
            margin-bottom:5px
        }
        
        .rua{
            width:502.4px;
        }
        
        .numero{
            width: 249.2px;
        }
        
        .padrao{
            width: 249.2px;
        }

    </style>

    <body>
        <div id="header">
            
            <div class="borderT margin-top">
                <table >
                    <tr>
                    <td rowspan="7" style="padding-left: 15px">
                            @if($relatorio[0]->folhar->empresa->esfoto)
                                <img class="logo" src="{{$relatorio[0]->folhar->empresa->esfoto}}" alt="" srcset="">
                            @else
                                @include('imagem')
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="padding-left-foto text-bold">{{$relatorio[0]->folhar->empresa->esnome}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">CNPJ/MF Nroº : {{$relatorio[0]->folhar->empresa->escnpj}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Rua: {{$relatorio[0]->folhar->empresa->endereco[0]->eslogradouro}}, {{$relatorio[0]->folhar->empresa->endereco[0]->esnum}} - {{$relatorio[0]->folhar->empresa->endereco[0]->escep}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Bairro: {{$relatorio[0]->folhar->empresa->endereco[0]->esbairro}} - {{$relatorio[0]->folhar->empresa->endereco[0]->esuf}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Tel: {{$relatorio[0]->folhar->empresa->estelefone}}</td>
                    </tr>
        
                </table>
            </div>
            
            <div class="margin-top">
                <table>
                    <tr>
                        <td class="name__title text-center small__font">Período de  {{date('d/m/Y',strtotime($relatorio[0]->folhar->fsinicio))}} á {{date('d/m/Y',strtotime($relatorio[0]->folhar->fsfinal))}}</td>
                    </tr>
                </table>
            </div>
            
            <div  class="margin-top borderT">
                <table class="margin-left margin-bottom margin-top">
                    <tr>
                        <td class="text-center name__title--evento text-bold">{{$relatorio[0]->tomador->tsnome}}</td>
                    </tr>
                </table>
                
                <table class="margin-left margin-top">
                    
                    <tr>
                        <td class="padding-left-texto small__font rua text-center destaque text-bold">Rua</td>
                        <td class="text-center small__font numero text-center destaque text-bold">Número</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto small__font rua text-center">{{$relatorio[0]->tomador->endereco[0]->eslogradouro}}</td>
                        <td class="text-center small__font numero text-center">{{$relatorio[0]->tomador->endereco[0]->esnum}}</td>
                    </tr>
                    
                </table>

                <table class="margin-left margin-top">
                    <tr>
                        <td class="padding-left-texto padrao small__font text-center destaque text-bold">Bairro</td>
                        <td class="padding-left-texto padrao small__font text-center destaque text-bold">Cidade</td>
                        <td class="small__font padrao text-center destaque text-bold">Estado</td>
                    </tr>
                    
                    <tr>
                        <td class="padding-left-texto padrao small__font  text-center">{{$relatorio[0]->tomador->endereco[0]->esbairro}}</td>
                        <td class="padding-left-texto padrao small__font text-center">{{$relatorio[0]->tomador->endereco[0]->esmunicipio}}</td>
                        <td class="small__font padrao text-center">{{$relatorio[0]->tomador->endereco[0]->esuf}}</td>
                    </tr>
                </table>

                <table class="margin-left margin-top margin-bottom">
                    <tr>
                        <td class="padding-left-texto padrao small__font text-center destaque text-bold">CEP</td>
                        <td class="padding-left-texto padrao small__font text-center destaque text-bold">CNPJ</td>
                        <td class="padding-left-texto padrao small__font text-center destaque text-bold">Telefone</td>
                    </tr>
                    
                    <tr>
                        <td class="padding-left-texto padrao small__font  text-center">{{$relatorio[0]->tomador->endereco[0]->escep}}</td>
                        <td class="padding-left-texto padrao small__font  text-center">{{$relatorio[0]->tomador->tscnpj}}</td>
                        <td class="padding-left-texto padrao small__font  text-center">{{$relatorio[0]->tomador->tstelefone}}</td>
                    </tr>
                </table>

            </div>

        </div>
    
        <div class="content">
            
            <div class="margin-top">
                <table class="margin-left margin-bottom margin-top">
                    <tr>
                        <td class="text-center name__title--evento text-bold">Evento s-1270</td>
                    </tr>
                </table>
            </div>

            <div  class="margin-top borderT">

                <table>
                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom">Produção</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom">R$ 
                            <?php
                                $producao = 0;
                                $totalgeral = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    $producao += $relatorios->biservico;
                                }
                            ?>
                            {{number_format((float)$producao, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom">DSR - Descanso Semanal Remunerado 18,18%</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom">R$ 
                            <?php
                                $dsr = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                   
                                    foreach ($relatorios->valorcalculo as $key => $dsrs) {
                                        if (mb_strpos(mb_strtoupper($dsrs->vsdescricao,'UTF-8'), 'DSR') !== false) {
                                            $dsr += $dsrs->vivencimento;
                                        }
                                    }
                                }
                            ?>
                            {{number_format((float)$dsr, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom">Férias 11,12%</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom">R$ 
                        <?php
                                $feria = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                   
                                    foreach ($relatorios->valorcalculo as $key => $ferias) {
                                        if (mb_strpos(mb_strtoupper($ferias->vsdescricao,'UTF-8'), 'FERIAS') !== false) {
                                            $feria += $ferias->vivencimento;
                                        }
                                    }
                                }
                            ?>
                            {{number_format((float)$feria, 2, ',', '.')}}
                            <?php
                                $total = $producao + $dsr + $feria;
                                $totalgeral += $total;
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom destaque text-bold">Sub-Total</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom destaque">R$ {{number_format((float)$total, 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom">INSS sobre (Produção/DSR/Férias)</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom">R$  
                            <?php
                                $inss2 = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    foreach ($relatorios->valorcalculo as $key => $inss5) {
                                        if (mb_strpos(mb_strtoupper($inss5->vsdescricao,'UTF-8'), 'INSS') !== false) {
                                            $inss2 += $inss5->videscinto;
                                        }
                                    }
                                }
                                $totalgeral += $inss2;
                            ?>
                             {{number_format((float)$inss2, 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom">13º Salário - 8,34%</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom">R$ 
                        <?php
                                $salario13 = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    foreach ($relatorios->valorcalculo as $key => $salario13s) {
                                        if (mb_strpos(mb_strtoupper($salario13s->vsdescricao,'UTF-8'), '13º SALÁRIO') !== false) {
                                            $salario13 += $salario13s->vivencimento;
                                        }
                                    }
                                }
                                $totalgeral += $salario13;
                            ?>
                             {{number_format((float)$salario13, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao border-bottom">INSS sobre 13º Salário</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold border-bottom">R$ 
                        <?php
                                $insalario13 = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    foreach ($relatorios->valorcalculo as $key => $insalario13s) {
                                        if (mb_strpos(mb_strtoupper($insalario13s->vsdescricao,'UTF-8'), 'INSS SOBRE 13º SALÁRIO') !== false) {
                                            $insalario13 += $insalario13s->videscinto;
                                        }
                                    }
                                }
                                $totalgeral += $insalario13;
                            ?>
                             {{number_format((float)$insalario13, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descricao destaque text-bold">Total Geral da Folha</td>
                        <td class="padding-left-texto medium__font text-center valor text-bold destaque">R$ {{number_format((float)$totalgeral, 2, ',', '.')}}</td>
                    </tr>
                </table>
            

            </div>

            <div class="margin-top">
                <table class="margin-left margin-bottom margin-top">
                    <tr>
                        <td class="text-center name__title--evento text-bold">Resumo da Folha de Pagamento</td>
                    </tr>
                </table>
            </div>

            <div class="borderT margin-top">

                <table>
                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">Produção + Repouso Semanal Remunerado</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem">18,18%</td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ {{number_format((float)$producao + $dsr, 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">Total Base de Cálculo INSS (Produção + Dsr 18,18% + Férias 11,12%)</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem"></td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ {{number_format((float)$total, 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">Férias</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem">11,12%</td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ {{number_format((float)$feria, 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">13° Salário Proporcional</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem">8,34%</td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ {{number_format((float)$salario13, 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">Base de Cálculo do FGTS</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem"></td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ 
                            <?php
                                $basefgts = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    $basefgts += $relatorios->bifgts;
                                }
                            ?>
                            {{number_format((float)$basefgts, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">FGTS a Recolher</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem">8,0%</td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ {{number_format((float)$total*(8/100), 2, ',', '.')}}</td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">Base de Cálculo do INSS</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem"></td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ 
                        <?php
                                $baseinss = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    $baseinss += $relatorios->biinss;
                                }
                            ?>
                            {{number_format((float)$baseinss, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right border-bottom descri">INSS a recolher do Trabalhador (Produção + Dsr + Férias)</td>
                        <td class="padding-left-texto medium__font border-right border-bottom text-center porcentagem"></td>
                        <td class="padding-left-texto medium__font text-center border-bottom valor">R$ 
                        <?php
                                $in = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    foreach ($relatorios->valorcalculo as $key => $inss) {
                                        if (mb_strtoupper($inss->vsdescricao,'UTF-8') === "INSS") {
                                            $in += $inss->videscinto;
                                        }
                                    }
                                }
                            ?>
                             {{number_format((float)$in, 2, ',', '.')}}
                        </td>
                    </tr>

                    <tr>
                        <td class="padding-left-texto medium__font border-right descri">INSS a recolher do Trabalhador 13° Salário</td>
                        <td class="padding-left-texto medium__font border-right text-center porcentagem"></td>
                        <td class="padding-left-texto medium__font text-center valor">R$ 
                        <?php
                                $insalario13 = 0;
                                foreach ($relatorio as $key => $relatorios) {
                                    foreach ($relatorios->valorcalculo as $key => $insalario13s) {
                                        if (mb_strpos(mb_strtoupper($insalario13s->vsdescricao,'UTF-8'), 'INSS SOBRE 13º SALÁRIO') !== false) {
                                            $insalario13 += $insalario13s->videscinto;
                                        }
                                    }
                                }
                            ?>
                             {{number_format((float)$insalario13, 2, ',', '.')}}
                        </td>
                    </tr>
                </table>
                    
            </div>


            <div class="borderT margin-top">
                <table>
                    <tr>
                        <td class="medium__font text-center text-bold data">Data de Emissão: {{date('d/m/Y')}}</td>
                        <td class="medium__font text-center text-bold ass">Assinatura_____________________________________________</td>
                    </tr>
                </table>
                
            </div>


        </div>


    </body>
</html>