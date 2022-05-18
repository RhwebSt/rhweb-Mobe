<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RHWEB - Folha de Pagamento Analítica</title>

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
                width: 1100px;
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

            .dataEmissao{
              width: 540px;
            }

            .periodo{
              width: 250px;
            }

            .producao{
              width: 236px;
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
            
            .name__title--tomador {
                width: 1080px;
            }
            
            .field__padrao{
                width:115px;
            }
            
        </style>
    </head>
    <?php
            $resumo_geral=[
                'produção'=> 0,
                'COMISSIONADO'=>0,
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
    <body>
        <div id="header">
            
            
            <div class="margin-top borderT">
                <table class="margin-top margin-left">
                    <tr>
                        <td class="name__title--tomador text-center text-bold destaque">Folha de Pagamento Analítica Geral Nº {{$folhar->fscodigo}}</td>
                    </tr>
                </table>
                
                <table class="margin-top margin-bottom">
                    <tr>
                        <td class="text-center dataEmissao text-bold small__font">Data de Emissão: {{date('d/m/Y')}}</td>
                        <td class="text-center dataEmissao text-bold small__font">Período de: {{date('d/m/Y',strtotime($folhar->fsinicio))}} a {{date('d/m/Y',strtotime($folhar->fsfinal))}}</td>
                    </tr>
                </table>
                
            </div>
            
            <div class="margin-top--bigger">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">{{$folhar->empresa->esnome}}</td>
                    </tr>
                </table>
            </div>

        </div>

        <div id="footer">
            <p class="page" style="text-align: right">Página:  </p>
        </div>

        <div id="content">
            @foreach($folhar->basecalculo as $trabalhador)
                @if(!$trabalhador->tomador_id)
                    <div class="margin-top borderT">
                        <table class="margin-top">
                            <tr>
                                <td class="name__title text-center text-bold">{{$trabalhador->trabalhador->tsmatricula}} - {{$trabalhador->trabalhador->tsnome}}
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vivencimento && mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'COMISSIONADO') !== false)
                                      {{'(COMISSIONADO)'}}
                                      <?php $resumo_geral['COMISSIONADO'] += $rublica->vivencimento;?>
                                    @endif
                                  @endforeach
                                </td>
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
                                  {{$trabalhador->biservico?number_format((float)$trabalhador->biservico, 2, ',', '.'):''}}
                                  <?php $resumo_geral['produção'] += $trabalhador->biservico;?>
                                </td>
                                <td class="small__font text-center field__padrao">
                               
                                </td>
                                <td class="small__font text-center field__padrao">
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'DSR') !== false)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['dsr'] += $rublica->vivencimento;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao">
                                @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'FERIAS') !== false)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Férias'] += $rublica->vivencimento;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao">@foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'TRANSPORTE') !== false)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['VT'] += $rublica->vivencimento;?>
                                    @endif
                                  @endforeach</td>
                                <td class="small__font text-center field__padrao">
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'ALIMENTAÇÃO') !== false)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['VA'] += $rublica->vivencimento;?>
                                    @endif
                                  @endforeach</td>
                                <td class="small__font text-center field__padrao">@foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), '13º SALÁRIO') !== false)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                      <?php $resumo_geral['13º Salário'] += $rublica->vivencimento;?>
                                    @endif
                                  @endforeach</td>
                                <td class="small__font text-center field__padrao">
                                 
                                  {{$trabalhador->bivalorvencimento?number_format((float)$trabalhador->bivalorvencimento, 2, ',', '.'):''}}
                                  <?php $resumo_geral['Total'] += $trabalhador->bivalorvencimento;?>
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
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'INSS SOBRE 13º SALÁRIO') !== false)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['INSS 13º Sal'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'IRRF') !== false)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['IRRF'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                
                                <td class="small__font text-center field__padrao">
                                @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'COMISSIONADO') !== false)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      
                                    @endif
                                  @endforeach
                                </td>
                                
                                <td class="small__font text-center field__padrao"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strtoupper($rublica->vsdescricao,'UTF-8') === "INSS")
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      
                                      <?php $resumo_geral['INSS'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 0)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      
                                      <?php $resumo_geral['Vale'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'SEGURO') !== false)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Seguro'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao"> @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'SINDICATOR') !== false)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['C. Sindical'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao"> @foreach($trabalhador->valorcalculo as $rublica)
                                    @if(mb_strpos(mb_strtoupper($rublica->vsdescricao,'UTF-8'), 'ADIANTAMENTO') !== false)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                      <?php $resumo_geral['Adiantamento'] += $rublica->videscinto;?>
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center field__padrao"> 
                                  {{$trabalhador->bivalorliquido?number_format((float)$trabalhador->bivalorliquido, 2, ',', '.'):''}}
                                  <?php $resumo_geral['Total Líquido'] += $trabalhador->bivalorliquido;?>
                                </td>
                            </tr>
    
                      
                        </table>
                    </div>
                @endif
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
                        <td class="small__font text-center field__padrao">{{$resumo_geral['COMISSIONADO']?number_format((float)$resumo_geral['COMISSIONADO'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['INSS']?number_format((float)$resumo_geral['INSS'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Vale']?number_format((float)$resumo_geral['Vale'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Seguro']?number_format((float)$resumo_geral['Seguro'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['C. Sindical']?number_format((float)$resumo_geral['C. Sindical'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Adiantamento']?number_format((float)$resumo_geral['Adiantamento'], 2, ',', '.'):''}}</td>
                        <td class="small__font text-center field__padrao">{{$resumo_geral['Total Líquido']?number_format((float)$resumo_geral['Total Líquido'], 2, ',', '.'):''}}</td>
                    </tr>

              
                </table>
            </div>
          
          </body>
      </html>