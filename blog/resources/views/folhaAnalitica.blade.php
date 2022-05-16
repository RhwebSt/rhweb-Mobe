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
                width: 768px;
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
              width: 381px;
            }

            .periodo{
              width: 250px;
            }

            .folhaAnalitica{
              width: 280px;
            }

            .inss__dec{
              width: 85px;
            }

            .producao{
              width: 85px;
            }
            
            .comissionado{
               width: 85px
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
                        <td class="name__title text-center text-bold">Folha de Pagamento Analítica Geral Nº {{$folhar->fscodigo}}</td>
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
                                <td class="name__title text-center text-bold">{{$trabalhador->trabalhador->tsmatricula}} - {{$trabalhador->trabalhador->tsnome}}</td>
                            </tr>
                        </table>
    
    
                        <table class="margin-left margin-top">
                            <tr>
                                <td class="text-bold small__font destaque text-center producao">Produção</td>
                                <td class="text-bold small__font destaque text-center comissionado">Comissionado</td>
                                <td class="text-bold small__font destaque text-center dsr">Dsr</td>
                                <td class="text-bold small__font destaque text-center ferias">Férias</td>
                                <td class="text-bold small__font destaque text-center vt">VT</td>
                                <td class="text-bold small__font destaque text-center va">VA</td>
                                <td class="text-bold small__font destaque text-center decimo">13º Salário</td>
                                <td class="text-bold small__font destaque text-center total">Total</td>
                            </tr>
        
                            <tr>
        
                                <td class="small__font text-center producao">{{$trabalhador->biservico?number_format((float)$trabalhador->biservico, 2, ',', '.'):''}}</td>
                                <td class="small__font text-center comissionado">99999</td>
                                <td class="small__font text-center dsr">
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 1008)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center ferias">
                                @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 1009)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center vt">@foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 1013)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach</td>
                                <td class="small__font text-center va">
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 1012)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach</td>
                                <td class="small__font text-center decimo">@foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 1010)
                                      {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach</td>
                                <td class="small__font text-center total">
                                 
                                  {{$trabalhador->bivalorvencimento?number_format((float)$trabalhador->bivalorvencimento, 2, ',', '.'):''}}
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
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 2002)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center producao1"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 2004)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center dsr"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 2001)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center ferias"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 0)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center vt"> 
                                  @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 1011)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center va"> @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 2005)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center decimo"> @foreach($trabalhador->valorcalculo as $rublica)
                                    @if($rublica->vicodigo == 2003)
                                      {{$rublica->videscinto?number_format((float)$rublica->videscinto, 2, ',', '.'):''}}
                                    @endif
                                  @endforeach
                                </td>
                                <td class="small__font text-center total"> 
                                  {{$trabalhador->bivalorliquido?number_format((float)$trabalhador->bivalorliquido, 2, ',', '.'):''}}
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
                        <td class="text-bold small__font destaque text-center comissionado">Comissionado</td>
                        <td class="text-bold small__font destaque text-center dsr">Dsr</td>
                        <td class="text-bold small__font destaque text-center ferias">Férias</td>
                        <td class="text-bold small__font destaque text-center vt">VT</td>
                        <td class="text-bold small__font destaque text-center va">VA</td>
                        <td class="text-bold small__font destaque text-center decimo">13º Salário</td>
                        <td class="text-bold small__font destaque text-center total">Total</td>
                    </tr>
    
                    <tr>
                        <td class="small__font text-center producao">999999</td>
                        <td class="small__font text-center comissionado">9999</td>
                        <td class="small__font text-center dsr">9999</td>
                        <td class="small__font text-center ferias">9999</td>
                        <td class="small__font text-center vt">9999</td>
                        <td class="small__font text-center va">999</td>
                        <td class="small__font text-center decimo">9999</td>
                        <td class="small__font text-center total"></td>
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
                        <td class="small__font text-center inss__dec">999</td>
                        <td class="small__font text-center producao1">999</td>
                        <td class="small__font text-center dsr">999</td>
                        <td class="small__font text-center ferias">999</td>
                        <td class="small__font text-center vt">999</td>
                        <td class="small__font text-center va">999</td>
                        <td class="small__font text-center decimo">999</td>
                        <td class="small__font text-center total">99999</td>
                    </tr>

              
                </table>
            </div>
          
          </body>
      </html>