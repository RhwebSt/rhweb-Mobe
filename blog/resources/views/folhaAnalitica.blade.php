<html>
          <head>
            <meta http-equiv="Content-Type" content="text/html;">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RHWEB - Folha de Pagamento Analítica</title>

            <style>
                @page { 
                  margin-top: 60px; 
                  margin-bottom: 30px;
                  margin-left: 10px;
                  margin-right: 10px;
                }
              #header { position: fixed; left: 0px; top: -60px; right: 0px; height: 60px; background-color:; text-align: center; }
              #footer { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 50px; text-align: end; }
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
                  width: 225px;
                }

                .periodo{
                  width: 250px;
                }

                .folhaAnalitica{
                  width: 280px;
                }

                .inss__dec{
                  width: 89.5px;
                }

                .producao{
                  width: 186px;
                }

                .producao1{
                  width: 90px;
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

            </style>
          </head>

          <body>
            <div id="header">
                
                <table class="margin-top">
                  <tr>
                      <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$folhas->esnome}}</td>
                  </tr>
              </table>
                <table>
                    <tr>
                        <td class="border-top border-left border-bottom text-center folhaAnalitica small__font text-bold">Folha de Pagamento Analítica Nº {{$folhas->fscodigo}}</td>
                        <td class="border-top border-left border-bottom text-center dataEmissao text-bold small__font">Data de Emissão: {{date("d/m/y")}}</td>
                        <td class="border-top border-left border-right border-bottom text-center periodo text-bold small__font">
                                <?php
                                    $dataincio = explode('-',$folhas->fsinicio);
                                    $datafinal = explode('-',$folhas->fsfinal)
                                ?>
                            Período de: {{$dataincio[2]}}/{{$dataincio[1]}}/{{$dataincio[0]}} a {{$datafinal[2]}}/{{$datafinal[1]}}/{{$datafinal[0]}}
                        </td>
                    </tr>
                </table>

            </div>

            <div id="footer">
              <p class="page destaque borderT padding-footer">Página:  </p>
            </div>

            <div id="content">
                @foreach($producao as $d => $valor)
                    
                    <table class="margin-top">
                        <tr>
                            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$valor->tsmatricula}} - {{$valor->tsnome}}</td>
                        </tr>
                    </table>
                    
                    
                    <table>
                        <tr>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center producao">Produção</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center dsr">Dsr</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Férias</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">VT</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">VA</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">13º Salário</td>
                            <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total</td>
                        </tr>
        
                        <tr>
        
                            <td class="border-top border-bottom border-left text-bold small__font text-center producao">{{number_format((float)$valor->vencimento, 2, ',', '.')}}</td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center dsr">
                                @foreach($dsr as $d => $valor_dsr)
                                    @if($valor_dsr->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_dsr->vencimento, 2, ',', '.')}}
                                    @endif
                                 @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center ferias">
                                @foreach($ferias as $d => $valor_ferias)
                                    @if($valor_ferias->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_ferias->vencimento, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center vt">
                                @foreach($vt as $d => $valor_vt)
                                    @if($valor_vt->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_vt->vencimento, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center va">
                                @foreach($va as $d => $valor_vt)
                                    @if($valor_vt->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_vt->vencimento, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center decimo">
                                @foreach($salario13 as $d => $valor_salario13)
                                    @if($valor_salario13->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_salario13->vencimento, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-right border-bottom border-left text-bold small__font text-center total">{{number_format((float)$valor->bivalorvencimento, 2, ',', '.')}}</td>
                        </tr>
                    </table>
                
                    <table>

                        <tr>
                            <td class="border-top border-left text-bold small__font text-center destaque border-bottom inss__dec">INSS 13º Sal</td>
                            <td class="border-top border-bottom border-left text-bold destaque small__font text-center producao1">IRRF</td>
                            <td class="border-top border-bottom border-left text-bold destaque small__font text-center dsr">INSS</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Vale</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">Seguro</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">C. Sindical</td>
                            <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">Adiantamento</td>
                            <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total Líquido</td>
                        </tr>
        
                        <tr>
                            <td class="border-bottom  border-left text-bold small__font text-center inss__dec">
                                @foreach($inss_sobre13 as $d => $valor_inss_sobre13)
                                    @if($valor_inss_sobre13->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_inss_sobre13->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-bottom text-bold border-left small__font text-center producao1">
                                @foreach($irrf as $d => $valor_irrf)
                                    @if($valor_irrf->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_irrf->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-bottom text-bold border-left small__font text-center dsr">
                                @foreach($inss as $d => $valor_inss)
                                    @if($valor_inss_sobre13->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_inss->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center ferias">
                                @foreach($vale as $valhes)
                                    @if($valhes->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valhes->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center vt">
                                @foreach($seguro as $d => $valor_seguro)
                                    @if($valor_seguro->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_seguro->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center va">
                                @foreach($sindicator as $d => $valor_sindicator)
                                    @if($valor_sindicator->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$valor_sindicator->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center decimo">
                                @foreach($adiantamento as $adiantamentos)
                                    @if($adiantamentos->trabalhador === $valor->trabalhador)
                                      {{number_format((float)$adiantamentos->desconto, 2, ',', '.')}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-top border-right border-bottom border-left text-bold small__font text-center total">{{number_format((float)$valor->bivalorliquido, 2, ',', '.')}}</td>
                        </tr>
        
                      
                    </table>
                @endforeach
                
                <table class="margin-top">
                  <tr>
                      <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">Resumo Geral</td>
                  </tr>
              </table>


              <table>
                <tr>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center producao">Produção</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center dsr">Dsr</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Férias</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">VT</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">VA</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">13º Salário</td>
                    <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total</td>
                </tr>

                <tr>

                    <td class="border-top border-bottom border-left text-bold small__font text-center producao">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center dsr">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center ferias">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center vt">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center va">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center decimo">999.999.999,99</td>
                    <td class="border-top border-right border-bottom border-left text-bold small__font text-center total">999.999.999,99</td>
                </tr>
              </table>

              <table>

                <tr>
                    <td class="border-top border-left text-bold small__font text-center destaque border-bottom inss__dec">INSS 13º Sal</td>
                    <td class="border-top border-bottom border-left text-bold destaque small__font text-center producao1">IRRF</td>
                    <td class="border-top border-bottom border-left text-bold destaque small__font text-center dsr">INSS</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Vale</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">Seguro</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">C. Sindical</td>
                    <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">Adiantamento</td>
                    <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total Líquido</td>
                </tr>

                <tr>
                    <td class="border-bottom  border-left text-bold small__font text-center inss__dec">999.999.999,99</td>
                    <td class="border-bottom text-bold border-left small__font text-center producao1">999.999.999,99</td>
                    <td class="border-bottom text-bold border-left small__font text-center dsr">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center ferias">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center vt">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center va">999.999.999,99</td>
                    <td class="border-top border-bottom border-left text-bold small__font text-center decimo">999.999.999,99</td>
                    <td class="border-top border-right border-bottom border-left text-bold small__font text-center total">999.999.999,99</td>
                </tr>

              
            </table>

            </div>
          
          </body>
      </html>