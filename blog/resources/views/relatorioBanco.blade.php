<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RHWEB - Relatório Bancos</title>

        <style>
            @page { 
                margin-top: 170px; 
                margin-bottom: 30px;
                margin-left: 10px;
                margin-right: 10px;
            }
            #header { position: fixed; left: 0px; top: -170px; right: 0px; height: 170px; background-color:; text-align: center; }
            #footer { position: fixed; left: 0px; bottom: -30px; right: 0px; height: 55px; text-align: end; }
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
                width: 767px;
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

            .date{
                width: 380px;
            }

            .matric{
                width: 55.5px;
            }

            .matric1{
                width: 55.5px;
            }

            .nome{
                width: 300px;
            }

            .banco{
                width:75px;
            }

            .agencia{
                width: 60px;
            }
            .operacao{
                width: 63.5px;
            }

            .conta{
                width: 70px; 
            }

            .valor{
                width: 101px;
            }

            .totalGeral{
                width: 659px;
            }

            .valorGeral{
                width: 101px;
            }
            
            .margin-bottom{
                margin-bottom: 10px;
            }
            
            .margin-left{
                margin-left: 5px;
            }
    
            .name__title--tomador {
                width: 753px;
            }
        </style>
    </head>

    <body>
        <div id="header">
            
            <div class="margin-top">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">Folha de pagamento para crédito em Conta</td>
                    </tr>
                </table>
            </div>
            
            <div class="margin-top borderT">
                <table class="margin-top margin-bottom margin-left">
                    <tr>
                        <td class="name__title--tomador text-center text-bold destaque">{{$folhars[0]->esnome}}</td>
                    </tr>
                </table>
                
                <table class="margin-bottom">
                    <tr>
                        <td class="small__font date text-center"><b>Data de Emissão:</b> {{date("d/m/y")}}</td>
                        <td class="small__font date text-center">
                            <?php
                                $data_inicial = explode('-',$folhars[0]->fsinicio);
                                $data_inicial = $data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0];
                                $data_final = explode('-',$folhars[0]->fsfinal);
                                $data_final = $data_final[2].'/'.$data_final[1].'/'.$data_final[0];
                            ?>
                                <b>Período de</b> {{$data_inicial}} á {{$data_final}}
                        </td>
                    </tr>
                </table>

            </div>
            
            <div class="margin-top">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">
                            <?php
                                $banco = explode('-',$folhars[0]->bsbanco)
                            ?>
                            {{$banco[1]}}
                        </td>
                    </tr>
                </table>
            </div>


            <table class="margin-top">
               
                    <tr>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center matric">Matrícula</td>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center nome">Nome</td>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center banco">Cod.Banco</td>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center agencia">Agência</td>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center operacao">Operação</td>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center conta">Conta</td>
                        <td class="small__font border-top border-bottom border-right border-left text-bold destaque text-center valor">Valor Líquido</td>
                    </tr>
                
            </table>
        </div>

        <div id="footer">
          <p class="page destaque borderT padding-footer">Página:  </p>
        </div>

        <div id="content">
          
            <?php
                $total = 0;
            ?>
            <table>
            @foreach($folhars as $folhar)
                <tr>
                    <td class="small__font border-top border-bottom border-right border-left text-center matric1">{{$folhar->tsmatricula}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center nome">{{$folhar->tsnome}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center banco">
                        <?php
                            $codigobanco = explode('-',$folhar->bsbanco)
                        ?>
                        {{$codigobanco[0]}}
                    </td>
                    <td class="small__font border-top border-bottom border-right border-left text-center agencia">{{$folhar->bsagencia}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center operacao">{{$folhar->bsoperacao}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center conta">{{$folhar->bsconta}}</td>
                    <td class="small__font border-top border-bottom border-right border-left text-center valor"> {{number_format((float)$folhar->bivalorliquido, 2, ',', '.')}}</td>
                </tr>
                <?php
                    $total += $folhar->bivalorliquido;
                ?>
            @endforeach
            </table>

            <table class="margin-top">

                <tr>
                    <td class="small__font border-top border-bottom border-right border-left text-bold text-center totalGeral destaque">Total Geral</td>
                    <td class="small__font border-top border-bottom border-right border-left text-bold text-center valorGeral destaque">{{number_format((float)$total, 2, ',', '.')}}</td>
                </tr>
            </table>

          <p style="page-break-before: auto;"></p>
        </div>
      
    </body>
</html>