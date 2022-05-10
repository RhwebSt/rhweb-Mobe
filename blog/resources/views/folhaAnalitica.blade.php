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
                      <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$folhar->empresa->esnome}}</td>
                  </tr>
              </table>
                <table>
                    <tr>
                        <td class="border-top border-left border-bottom text-center folhaAnalitica small__font text-bold">Folha de Pagamento Analítica Nº {{$folhar->fscodigo}}</td>
                        <td class="border-top border-left border-bottom text-center dataEmissao text-bold small__font">Data de Emissão: {{date('d/m/Y')}}</td>
                        <td class="border-top border-left border-right border-bottom text-center periodo text-bold small__font">Período de: {{date('d/m/Y',strtotime($folhar->fsinicio))}} a {{date('d/m/Y',strtotime($folhar->fsfinal))}}</td>
                    </tr>
                </table>

            </div>

            <div id="footer">
              <p class="page destaque borderT padding-footer">Página:  </p>
            </div>

            <div id="content">
                @foreach($folhar->basecalculo as $trabalhador)
                  @if(!$trabalhador->tomador_id)
                      <table class="margin-top">
                          <tr>
                              <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$trabalhador->trabalhador->tsmatricula}} - {{$trabalhador->trabalhador->tsnome}}</td>
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

                            <td class="border-top border-bottom border-left text-bold small__font text-center producao">{{$trabalhador->biservico?number_format((float)$trabalhador->biservico, 2, ',', '.'):''}}</td>
                            <td class="border-top border-bottom border-left text-bold small__font text-center dsr">
                              @foreach($trabalhador->valorcalculo as $rublica)
                                @if($rublica->vicodigo == 1008)
                                  {{$rublica->vivencimento?number_format((float)$rublica->vivencimento, 2, ',', '.'):''}}
                                @endif
                              @endforeach
                            </td>
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
                  @endif
                @endforeach
              <p style="page-break-before: auto;"></p>
            </div>
          
          </body>
      </html>