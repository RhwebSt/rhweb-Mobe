<html>
          <head>
            <meta http-equiv="Content-Type" content="text/html;">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>RHWEB - Folha de Pagamento Analítica</title>

            <style>
                @page { 
                  margin-top: 100px; 
                  margin-bottom: 30px;
                  margin-left: 10px;
                  margin-right: 10px;
                }
              #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px; background-color:; text-align: center; }
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
                    width: 1092px;
                }
        
                .borderT{
                    border: 1px solid black;
                    border-radius: 3px;
                }
        
                .margin-top{
                    margin-top: 5px;
                }
        
                .padding-footer{
                    padding: 2px;
                }

                .dataEmissao{
                  width: 300px;
                }

                .folhaAnalitica{
                  width: 400px;
                }

                .periodo{
                  width: 380px;
                }

                .matric{
                  width: 55px;
                }

                .nome{
                  width: 285px;
                }

                .producao{
                  width: 100px;
                }

                .dsr{
                  width: 100px;
                }

                .ferias{
                  width: 100px;
                }

                .vt{
                  width: 100px;
                }

                .va{
                  width: 100px;
                }

                .decimo{
                  width: 100px;
                }

                .total{
                  width: 100px;
                }

            </style>
          </head>

          <body>
            <div id="header">
                <table class="margin-top">
                    <tr>
                        <td class="destaque border-top border-left border-bottom text-center folhaAnalitica text-bold">Folha de Pagamento Analítica Nº 999999</td>
                        <td class="destaque border-top border-bottom text-center dataEmissao text-bold">Data de Emissão: 05/01/2022</td>
                        <td class="destaque border-top border-right border-bottom text-center periodo text-bold">Período de: 01/12/2021 a 31/12/2021</td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">Nome do Usuário ou Tomador</td>
                    </tr>
                </table>


                <table class="margin-top">
                    <tr>
                        <td class="border-top border-left border-bottom text-bold small__font destaque text-center matric">Matrícula</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center nome">Nome</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center producao">Produção</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center dsr">Dsr</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Férias</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">VT</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">VA</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">13º Salário</td>
                        <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total</td>
                    </tr>

                    <tr>
                        <td class="border-top border-left border-bottom text-bold small__font destaque text-center matric"></td>
                        <td class="border-top border-bottom text-bold small__font destaque text-center nome"></td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center producao">IRRF</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center dsr">INSS</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Vale</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">Seguro</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">C. Sindical</td>
                        <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">Adiantamento</td>
                        <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total Desconto</td>
                    </tr>
                </table>



            </div>

            <div id="footer">
              <p class="page destaque borderT padding-footer">Página:  </p>
            </div>

            <div id="content">
              <table class="margin-top">
              <tr>
                  <td class="border-top border-left border-bottom text-bold small__font destaque text-center matric">Matrícula</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center nome">Nome</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center producao">Produção</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center dsr">Dsr</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Férias</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">VT</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">VA</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">13º Salário</td>
                  <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total</td>
              </tr>

              <tr>
                  <td class="border-top border-left border-bottom text-bold small__font text-center matric">9999999</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center nome">Eliel Felipe dos Santos Rocha</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center producao">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center dsr">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center ferias">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center vt">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center va">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center decimo">999.999.999,99</td>
                  <td class="border-top border-right border-bottom border-left text-bold small__font text-center total">999.999.999,99</td>
              </tr>

              <tr>
                  <td class="border-top border-left text-bold small__font text-center matric"></td>
                  <td class="border-top text-bold small__font text-center nome"></td>
                  <td class="border-top border-bottom border-left text-bold destaque small__font text-center producao">IRRF</td>
                  <td class="border-top border-bottom border-left text-bold destaque small__font text-center dsr">INSS</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center ferias">Vale</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center vt">Seguro</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center va">C. Sindical</td>
                  <td class="border-top border-bottom border-left text-bold small__font destaque text-center decimo">Adiantamento</td>
                  <td class="border-top border-right border-bottom border-left text-bold small__font destaque text-center total">Total Desconto</td>
              </tr>

              <tr>
                  <td class="border-left border-bottom text-bold small__font text-center matric"></td>
                  <td class="border-bottom text-bold small__font text-center nome"></td>
                  <td class="border-bottom text-bold border-left small__font text-center producao">999.999.999,99</td>
                  <td class="border-bottom text-bold border-left small__font text-center dsr">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center ferias">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center vt">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center va">999.999.999,99</td>
                  <td class="border-top border-bottom border-left text-bold small__font text-center decimo">999.999.999,99</td>
                  <td class="border-top border-right border-bottom border-left text-bold small__font text-center total">999.999.999,99</td>
              </tr>

              
        </table>

              <p style="page-break-before: auto;"></p>
            </div>
          
          </body>
      </html>