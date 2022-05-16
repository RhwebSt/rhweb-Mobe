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
                width: 768px;
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
              width: 381px;
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
              width: 176px;
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
    
        </style>
    </head>

    <body>
        <div id="header">
            
            <div class="margin-top borderT">
                <table class="margin-top">
                    <tr>
                        <td class="name__title text-center text-bold">Folha de Pagamento Analítica Tomador Nº {{$folhas->fscodigo}}</td>
                    </tr>
                </table>

                <table class="margin-top margin-bottom">
                    <tr>
                        <td class="text-center dataEmissao text-bold small__font">Data de Emissão: {{date("d/m/y")}}</td>
                        <td class="text-center dataEmissao text-bold small__font">
                                <?php
                                    $dataincio = explode('-',$folhas->fsinicio);
                                    $datafinal = explode('-',$folhas->fsfinal)
                                ?>
                            Período de: {{$dataincio[2]}}/{{$dataincio[1]}}/{{$dataincio[0]}} a {{$datafinal[2]}}/{{$datafinal[1]}}/{{$datafinal[0]}}
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="margin-top--bigger">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">{{$folhas->tsnome}}</td>
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
            @foreach($producao as $d => $valor)
                
                <div class="margin-top borderT">
                    <table class="margin-top">
                        <tr>
                            <td class="name__title text-center text-bold">{{$valor->tsmatricula}} - {{$valor->tsnome}}</td>
                        </tr>
                    </table>
                    
                    
                    <table class="margin-left margin-top">
                        <tr>
                            <td class="text-bold small__font destaque text-center producao">Produção</td>
                            <td class="text-bold small__font destaque text-center dsr">Dsr</td>
                            <td class="text-bold small__font destaque text-center ferias">Férias</td>
                            <td class="text-bold small__font destaque text-center vt">VT</td>
                            <td class="text-bold small__font destaque text-center va">VA</td>
                            <td class="text-bold small__font destaque text-center decimo">13º Salário</td>
                            <td class="text-bold small__font destaque text-center total">Total</td>
                        </tr>
        
                        <tr>
        
                            <td class="small__font text-center producao">
                                {{$valor->vencimento?number_format((float)$valor->vencimento, 2, ',', '.'):''}}
                                <?php $resumo_geral['produção'] += $valor->vencimento;?>
                            </td>
                            <td class="small__font text-center dsr">
                                @foreach($dsr as $d => $valor_dsr)
                                    @if($valor_dsr->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_dsr->vencimento?number_format((float)$valor_dsr->vencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['dsr'] += $valor_dsr->vencimento;?>
                                    @endif
                                 @endforeach
                            </td>
                            <td class="small__font text-center ferias">
                                @foreach($ferias as $d => $valor_ferias)
                                    @if($valor_ferias->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_ferias->vencimento?number_format((float)$valor_ferias->vencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Férias'] += $valor_ferias->vencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center vt">
                                @foreach($vt as $d => $valor_vt)
                                    @if($valor_vt->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_vt->vencimento?number_format((float)$valor_vt->vencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['VT'] += $valor_vt->vencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center va">
                                @foreach($va as $d => $valor_va)
                                    @if($valor_va->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_va->vencimento?number_format((float)$valor_va->vencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['VA'] += $valor_va->vencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center decimo">
                                @foreach($salario13 as $d => $valor_salario13)
                                    @if($valor_salario13->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_salario13->vencimento?number_format((float)$valor_salario13->vencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['13º Salário'] += $valor_salario13->vencimento;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center total">
                                {{$valor->bivalorvencimento?number_format((float)$valor->bivalorvencimento, 2, ',', '.'):''}}
                                <?php $resumo_geral['Total'] += $valor->bivalorvencimento;?>
                            </td>
                        </tr>
                    </table>
                
                    <table class="margin-left margin-top margin-bottom">
        
                        <tr>
                            <td class="text-bold small__font text-center destaque inss__dec">INSS 13º Sal</td>
                            <td class="text-bold destaque small__font text-center producao1">IRRF</td>
                            <td class="text-bold destaque small__font text-center dsr">INSS</td>
                            <td class="text-bold small__font destaque text-center ferias">Vale</td>
                            <td class="text-bold small__font destaque text-center vt">Seguro</td>
                            <td class="text-bold small__font destaque text-center va">C. Sindical</td>
                            <td class="text-bold small__font destaque text-center decimo">Adiantamento</td>
                            <td class="text-bold small__font destaque text-center total">Total Líquido</td>
                        </tr>
        
                        <tr>
                            <td class="small__font text-center inss__dec">
                                @foreach($inss_sobre13 as $d => $valor_inss_sobre13)
                                    @if($valor_inss_sobre13->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_inss_sobre13->desconto?number_format((float)$valor_inss_sobre13->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['INSS 13º Sal'] += $valor_inss_sobre13->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center producao1">
                                @foreach($irrf as $d => $valor_irrf)
                                    @if($valor_irrf->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_irrf->desconto?number_format((float)$valor_irrf->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['IRRF'] += $valor_irrf->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center dsr">
                                @foreach($inss as $d => $valor_inss)
                                    @if($valor_inss->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_inss->desconto?number_format((float)$valor_inss->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['INSS'] += $valor_inss->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center ferias">
                                @foreach($vale as $valhes)
                                    @if($valhes->trabalhador_id === $valor->trabalhador_id)
                                      {{$valhes->desconto?number_format((float)$valhes->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Vale'] += $valhes->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center vt">
                                @foreach($seguro as $d => $valor_seguro)
                                    @if($valor_seguro->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_seguro->desconto?number_format((float)$valor_seguro->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Seguro'] += $valor_seguro->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center va">
                                @foreach($sindicator as $d => $valor_sindicator)
                                    @if($valor_sindicator->trabalhador_id === $valor->trabalhador_id)
                                      {{$valor_sindicator->desconto?number_format((float)$valor_sindicator->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['C. Sindical'] += $valor_sindicator->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center decimo">
                                @foreach($adiantamento as $adiantamentos)
                                    @if($adiantamentos->trabalhador_id === $valor->trabalhador_id)
                                      {{$adiantamentos->desconto?number_format((float)$adiantamentos->desconto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Adiantamento'] += $adiantamentos->desconto;?>
                                    @endif
                                @endforeach
                            </td>
                            <td class="small__font text-center total">
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
                        <td class="text-bold small__font destaque text-center dsr">Dsr</td>
                        <td class="text-bold small__font destaque text-center ferias">Férias</td>
                        <td class="text-bold small__font destaque text-center vt">VT</td>
                        <td class="text-bold small__font destaque text-center va">VA</td>
                        <td class="text-bold small__font destaque text-center decimo">13º Salário</td>
                        <td class="text-bold small__font destaque text-center total">Total</td>
                    </tr>
            
                    <tr>
            
                        <td class="small__font text-center producao">{{$resumo_geral['produção']?number_format((float)$resumo_geral['produção'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center dsr">{{$resumo_geral['dsr']?number_format((float)$resumo_geral['dsr'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center ferias">{{$resumo_geral['Férias']?number_format((float)$resumo_geral['Férias'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center vt">{{$resumo_geral['VT']?number_format((float)$resumo_geral['VT'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center va">{{$resumo_geral['VA']?number_format((float)$resumo_geral['VA'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center decimo">{{$resumo_geral['13º Salário']?number_format((float)$resumo_geral['13º Salário'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center total">{{$resumo_geral['Total']?number_format((float)$resumo_geral['Total'], 2, ',', '.'):''}}</td>
                    </tr>
                </table>
        
                <table class="margin-left margin-top margin-bottom">
                    <tr>
                        <td class="text-bold small__font text-center destaque inss__dec">INSS 13º Sal</td>
                        <td class="text-bold destaque small__font text-center producao1">IRRF</td>
                        <td class="text-bold destaque small__font text-center dsr">INSS</td>
                        <td class="text-bold small__font destaque text-center ferias">Vale</td>
                        <td class="text-bold small__font destaque text-center vt">Seguro</td>
                        <td class="text-bold small__font destaque text-center va">C. Sindical</td>
                        <td class="text-bold small__font destaque text-center decimo">Adiantamento</td>
                        <td class="text-bold small__font destaque text-center total">Total Líquido</td>
                    </tr>
            
                    <tr>
                        <td class="small__font text-center inss__dec">{{$resumo_geral['INSS 13º Sal']?number_format((float)$resumo_geral['INSS 13º Sal'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center producao1">{{$resumo_geral['IRRF']?number_format((float)$resumo_geral['IRRF'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center dsr">{{$resumo_geral['INSS']?number_format((float)$resumo_geral['INSS'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center ferias">{{$resumo_geral['Vale']?number_format((float)$resumo_geral['Vale'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center vt">{{$resumo_geral['Seguro']?number_format((float)$resumo_geral['Seguro'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center va">{{$resumo_geral['C. Sindical']?number_format((float)$resumo_geral['C. Sindical'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center decimo">{{$resumo_geral['C. Sindical']?number_format((float)$resumo_geral['Adiantamento'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center total">{{$resumo_geral['Total Líquido']?number_format((float)$resumo_geral['Total Líquido'], 2, ',', '.'):''}}</td>
                    </tr>
                </table>
    
            </div>
  
    </body>
      </html>