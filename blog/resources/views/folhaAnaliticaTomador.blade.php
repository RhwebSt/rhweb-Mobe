<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RHWEB - Folha Analítica Tomador</title>
    
        <style>
            @page { 
              margin-top: 140px; 
              margin-bottom: 60px;
              margin-left: 10px;
              margin-right: 10px;
            }
            #header { position: fixed; left: 0px; top: -140px; right: 0px; height: 140px; background-color:; text-align: center; }
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
                font-size:13px
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
    
            .borderT{
                border: 1px solid black;
                border-radius: 3px;
            }
    
            .margin-top{
                margin-top: 15px;
            }
    
            .padding-footer{
                padding: 2px;
            }
    
            .dataEmissao{
              width: 540px;
            }
    
            .periodo{
              width: 250px;
            }
    
            .folhaAnalitica{
              width: 280px;
            }
    
            .inss__dec{
              width: 84.5px;
            }
    
            .producao{
              width: 236px;
            }
    
            .producao1{
              width: 85px;
            }
    
            .dsr{
              width: 90px;
            }
    
            .ferias{
              width: 90px;
            }
    
            .vt{
              width: 90px;
            }
            
            .va{
              width: 90px;
            }
    
            .decimo{
              width: 90px;
            }
    
            .total{
              width: 93px;
            }
            
            .padding-left-foto{
            padding-left: 20px;
            }
            
            .margin-top{
                margin-top: 10px;
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
            
            .margin-top--bigger{
                margin-top: 25px;
            }
            
            .margin-bottom{
                margin-bottom: 10px;
            }
            
            .margin-left{
                margin-left: 5px;
            }
            
            .field__padrao{
                width:115px;
            }
    
        </style>
    </head>

    <body>
        <div id="header">
            
            <div class="margin-top borderT">
                <table class="margin-top">
                    <tr>
                        <td class="name__title text-center text-bold">Folha de Pagamento Analítica Tomador Nº {{$folhar[0]->folhar->fscodigo}}</td>
                    </tr>
                </table>

                <table class="margin-top margin-bottom">
                    <tr>
                        <td class="text-center dataEmissao small__font"><b>Data de Emissão:</b> {{date("d/m/y")}}</td>
                        <td class="text-center dataEmissao small__font">
                              
                            <b>Período de:</b> {{date('d/m/Y',strtotime($folhar[0]->folhar->fsinicio))}} á {{date('d/m/Y',strtotime($folhar[0]->folhar->fsfinal))}} 
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="margin-top--bigger">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">{{$folhar[0]->tomador->tsnome}}</td>
                    </tr>
                </table>
            </div>
    
        </div>
    
        <div id="footer">
          <p class="page" style="text-align: right">Página:  </p>
        </div>
        
        <?php
            $resumo_geral=[
                'produção'=> 0,
                'dsr'=>0,
                'Férias'=>0,
                'VT'=>0,
                'VA'=>0,
                '13º Salário'=>0,
                'INSS 13º Sal'=>0,
                'IRRF'=>0,
                'INSS'=>0,
                'Vale'=>0,
                'Seguro'=>0,
                'C. Sindical'=>0,
                'Adiantamento'=>0,
                'Total'=>0,
                'Total Líquido'=>0
            ];
        ?>
        <div id="content">
            @foreach($folhar as $d => $valor)
                
                <div class="margin-top borderT">
                    <table class="margin-top">
                        <tr>
                            <td class="name__title text-center text-bold">{{$valor->trabalhador->tsmatricula}} - {{$valor->trabalhador->tsnome}}</td>
                        </tr>
                    </table>
                    
                    
                    <table class="margin-left margin-top">
                        <tr>
                            <td class="text-bold small__font destaque text-center producao">Produção</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Comissionado</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Dsr</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Férias</td>
                            <td class="text-bold small__font destaque text-center field__padrao">VT</td>
                            <td class="text-bold small__font destaque text-center field__padrao">VA</td>
                            <td class="text-bold small__font destaque text-center field__padrao">13º Salário</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Total</td>
                        </tr>
        
                        <tr>
        
                            <td class="small__font text-center producao">
                                {{$valor->biservico?number_format((float)$valor->biservico, 2, ',', '.'):''}}
                                <?php $resumo_geral['produção'] += $valor->biservico;?>
                            </td>
                            
                            <td class="small__font text-center field__padrao">
                                
                            </td>
                            
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_dsr)
                                    @if(mb_strpos($valor_dsr->vsdescricao, 'dsr') !== false)
                                    
                                      {{$valor_dsr->vivencimento?number_format((float)$valor_dsr->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['dsr'] += $valor_dsr->vivencimento;?>
                                    @endif
                                 @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_ferias)
                                    @if(mb_strpos(mb_strtoupper($valor_ferias->vsdescricao,'UTF-8'), 'FERIAS') !== false)
                                    
                                      {{$valor_ferias->vivencimento?number_format((float)$valor_ferias->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Férias'] += $valor_ferias->vivencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_vt)
                                    @if(mb_strpos(strtoupper($valor_vt->vsdescricao), 'TRANSPORTE') !== false)
                                      {{$valor_vt->vivencimento?number_format((float)$valor_vt->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['VT'] += $valor_vt->vivencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_va)
                                    @if(mb_strpos(mb_strtoupper($valor_va->vsdescricao,'UTF-8'), 'ALIMENTAÇÃO') !== false)
                                      {{$valor_va->vivencimento?number_format((float)$valor_va->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['VA'] += $valor_va->vivencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_salario13)
                                    @if(mb_strpos(mb_strtoupper($valor_salario13->vsdescricao,'UTF-8'), '13º SALÁRIO') !== false)
                                      {{$valor_salario13->vivencimento?number_format((float)$valor_salario13->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['13º Salário'] += $valor_salario13->vivencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                {{$valor->bivalorvencimento?number_format((float)$valor->bivalorvencimento, 2, ',', '.'):''}}
                                <?php $resumo_geral['Total'] += $valor->bivalorvencimento;?>
                            </td>
                        </tr>
                    </table>
                
                    <table class="margin-left margin-top margin-bottom">
        
                        <tr>
                            <td class="text-bold small__font text-center destaque field__padrao">INSS 13º Sal</td>
                            <td class="text-bold destaque small__font text-center field__padrao">IRRF</td>
                            <td class="text-bold destaque small__font text-center field__padrao">Comissionado</td>
                            <td class="text-bold destaque small__font text-center field__padrao">INSS</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Vale</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Seguro</td>
                            <td class="text-bold small__font destaque text-center field__padrao">C. Sindical</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Adiantamento</td>
                            <td class="text-bold small__font destaque text-center field__padrao">Total Líquido</td>
                        </tr>
        
                        <tr>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_inss_sobre13)
                                    @if(mb_strpos(mb_strtoupper($valor_inss_sobre13->vsdescricao,'UTF-8'), 'INSS SOBRE 13º SALÁRIO') !== false)
                                      {{$valor_inss_sobre13->videscinto?number_format((float)$valor_inss_sobre13->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['INSS 13º Sal'] += $valor_inss_sobre13->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_irrf)
                                    @if(mb_strpos(mb_strtoupper($valor_irrf->vsdescricao,'UTF-8'), 'IRRF') !== false)
                                      {{$valor_irrf->videscinto?number_format((float)$valor_irrf->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['IRRF'] += $valor_irrf->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            
                            <td class="small__font text-center field__padrao">
                                
                            </td>
                            
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_inss)
                                    @if(mb_strtoupper($valor_inss->vsdescricao,'UTF-8') === "INSS")
                                    {{$valor_inss->vsdescricao}}
                                      {{$valor_inss->videscinto?number_format((float)$valor_inss->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['INSS'] += $valor_inss->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $valhes)
                                    @if(!$valhes->vicodigo)
                                      {{$valhes->videscinto?number_format((float)$valhes->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Vale'] += $valhes->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_seguro)
                                    @if(mb_strpos(mb_strtoupper($valor_seguro->vsdescricao,'UTF-8'), 'SEGURO') !== false)
                                      {{$valor_seguro->videscinto?number_format((float)$valor_seguro->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Seguro'] += $valor_seguro->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $d => $valor_sindicator)
                                    @if(mb_strpos(mb_strtoupper($valor_seguro->vsdescricao,'UTF-8'), 'SINDICATOR') !== false)
                                      {{$valor_sindicator->videscinto?number_format((float)$valor_sindicator->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['C. Sindical'] += $valor_sindicator->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                @foreach($valor->valorcalculo as $adiantamentos)
                                    @if(mb_strpos(mb_strtoupper($adiantamentos->vsdescricao,'UTF-8'), 'ADIANTAMENTO') !== false)
                                      {{$adiantamentos->videscinto?number_format((float)$adiantamentos->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Adiantamento'] += $adiantamentos->videscinto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center field__padrao">
                                {{$valor->bivalorliquido?number_format((float)$valor->bivalorliquido, 2, ',', '.'):''}}
                                <?php $resumo_geral['Total Líquido'] += $valor->bivalorliquido;?>
                            </td>
                        </tr>
        
                      
                    </table>
                </div>
            @endforeach
            
            <div class="margin-top borderT">
                <table class="margin-top">
                  <tr>
                      <td class="name__title text-center text-bold">Resumo Geral</td>
                  </tr>
                </table>
        
        
                <table class="margin-left margin-top">
                    <tr>
                        <td class="text-bold small__font destaque text-center producao">Produção</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Comissionado</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Dsr</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Férias</td>
                        <td class="text-bold small__font destaque text-center field__padrao">VT</td>
                        <td class="text-bold small__font destaque text-center field__padrao">VA</td>
                        <td class="text-bold small__font destaque text-center field__padrao">13º Salário</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Total</td>
                    </tr>
            
                    <tr>
            
                        <td class="small__font text-center producao">{{$resumo_geral['produção']?number_format((float)$resumo_geral['produção'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao"></td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['dsr']?number_format((float)$resumo_geral['dsr'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Férias']?number_format((float)$resumo_geral['Férias'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['VT']?number_format((float)$resumo_geral['VT'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['VA']?number_format((float)$resumo_geral['VA'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['13º Salário']?number_format((float)$resumo_geral['13º Salário'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Total']?number_format((float)$resumo_geral['Total'], 2, ',', '.'):''}}</td>
                    </tr>
                </table>
        
                <table class="margin-left margin-top margin-bottom">
                    <tr>
                        <td class="text-bold small__font text-center destaque field__padrao">INSS 13º Sal</td>
                        <td class="text-bold destaque small__font text-center field__padrao">IRRF</td>
                        <td class="text-bold destaque small__font text-center field__padrao">Comissionado</td>
                        <td class="text-bold destaque small__font text-center field__padrao">INSS</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Vale</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Seguro</td>
                        <td class="text-bold small__font destaque text-center field__padrao">C. Sindical</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Adiantamento</td>
                        <td class="text-bold small__font destaque text-center field__padrao">Total Líquido</td>
                    </tr>
            
                    <tr>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['INSS 13º Sal']?number_format((float)$resumo_geral['INSS 13º Sal'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['IRRF']?number_format((float)$resumo_geral['IRRF'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao"></td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['INSS']?number_format((float)$resumo_geral['INSS'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Vale']?number_format((float)$resumo_geral['Vale'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Seguro']?number_format((float)$resumo_geral['Seguro'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['C. Sindical']?number_format((float)$resumo_geral['C. Sindical'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['C. Sindical']?number_format((float)$resumo_geral['Adiantamento'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Total Líquido']?number_format((float)$resumo_geral['Total Líquido'], 2, ',', '.'):''}}</td>
                    </tr>
                </table>
    
            </div>
  
    </body>
      </html>