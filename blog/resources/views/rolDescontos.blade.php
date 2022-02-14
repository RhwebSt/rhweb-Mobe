<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/reset.css">
    <title>Rol dos Descontos</title>
</head>

<style>

    @page { 
          margin-top: 225px; 
          margin-bottom: 60px;
          margin-left: 10px;
          margin-right: 10px;
    }
    #header { position: fixed; left: 0px; top: -225px; right: 0px; height: 225px; background-color:; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 55px; text-align: end; }
    #footer .page:after { content: counter(page, upper); }


    table{
        border-collapse:collapse;
    }

    body{
        font-family:sans-serif;
    }
    
    td{
        padding-left:5px;
    }


    h2{
      font-size:14px;
      text-align: center;
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    table{
     
      width:100%;
      margin: 0;
      padding: 0;
      text-transform: capitalize;
       border-collapse: collapse;
    
      
    }

    p{
      font-weight: bolder;
      font-size: 12px;
      margin-bottom:10px;
      float:right;
    }

    
    thead{
      border: 1px solid black;
      text-align: center;

    }

    th{
      font-weight: bold;
    }
    
    footer{
      float: right;
    }
    
    figure{
        vertical-align: middle;
        font-size:16px;
        font-weight:bold;
        margin-top:10px;
        
    }
    
    .container{
        display:block;
    }
    
    .logo{
            margin-top:10px;
            margin-right: 50px;
            width: 100px;
            height: 120px;
        }


    .page {
        font-size: 16px;
        font-weight: bold;
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
        width: 758px;
    }


    .borderT{
        border: 1px solid black;
        border-radius: 3px;
        width: 772px;
    }
    
    .width__padrao{
            width:576px;
        }

    
    .margin-top{
        margin-top: 10px;
    }
    
    .footer{
      float: right;
    }

    .padding-footer{
        padding: 2px;
        width:770px;
    }
    
    .widthHeader{
        width:773px;
        margin-bottom: 10px;
    }
    
    .margin-bottom{
        margin-bottom: 10px;
    }
    
    .title-data{
        font-size: 16px;
        margin-right: 10px;
    }

    .matric{
        width:55px;
    }

    .trabalhador{
        width: 282px;
    }

    .descri{
        width: 240px;
    }

    .quinze{
        width:70px;
    }

    .valor{
        width: 90px;
    }

    .valor2{
        width: 90px;
    }


    .font{
        font-size: 10px;
    }

    .quanti{
        width: 200px;;
    }

    .totalGeral{
        width: 230px;
    }

</style>

<body class="">
    
    <div id="header" class="margin-top">
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$descontos[0]->esnome}}</td>
            </tr>
        </table>
        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="6"><img class="logo" src="https://img1.gratispng.com/20180202/jtw/kisspng-astronaut-outer-space-computer-file-astronauts-from-space-5a7433930a6c97.5428240515175648190427.jpg" alt="" srcset="" style="width:80px; height: 80px; padding:0px"></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao"><strong>CNPJ/MF Nroº :</strong></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Rua:</strong> ,  - </td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Bairro:</strong>  - </td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao"><strong>Tel:</strong> (48) 3086-0103</td>
                </tr>
    
            </table>
        </div>
        
        
        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Rol dos Descontos</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase text-center small__font text-bold">Competência: 
                    <?php
                        // $data = explode('-',$descontos[0]->dscompetencia);
                        $datainicio = 0;
                        $datafinal = 0;
                        foreach ($descontos as $key => $desconto) {
                            if ($desconto->dscompetencia == substr($inicio,0,7)) {
                                $datainicio = explode('-',$desconto->dscompetencia);
                            }
                            if ($desconto->dscompetencia == substr($final,0,7)) {
                                $datafinal = explode('-',$desconto->dscompetencia);
                            }
                        }
                    ?>
                    @if($datainicio != $datafinal)
                        {{$datainicio[1]}}/{{$datainicio[0]}} a {{$datafinal[1]}}/{{$datafinal[0]}}
                    @else
                        {{$datafinal[1]}}/{{$datafinal[0]}}
                    @endif
                </td>
                <td class="border-left border-right border-top border-bottom uppercase text-center small__font text-bold">Data de Emissão: {{date("d/m/y")}}</td>
            </tr>
        </table>

        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font matric">Matrícula</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font trabalhador">Trabalhador</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font descri">Descrição</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font quinze">Quinzena</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font valor">Valor R$</td>
            </tr>
        </table>
    </div>

    

    <div id="content">
        <?php
            $total = 0;
        ?>
        <table>
            @foreach($descontos as $desconto)
                <tr>
                    <td class="border-left border-right border-top border-bottom text-center uppercase small__font font matric">{{$desconto->tsmatricula}}</td>
                    <td class="border-left border-right border-top border-bottom text-center uppercase small__font font trabalhador">{{$desconto->tsnome}}</td>
                    <td class="border-left border-right border-top border-bottom text-center uppercase small__font font descri">{{$desconto->dsdescricao}}</td>
                    <td class="border-left border-right border-top border-bottom text-center uppercase small__font font quinze">{{$desconto->dsquinzena}}</td>
                    <td class="border-left border-right border-top border-bottom text-center uppercase small__font font valor">R$ {{number_format((float)$desconto->dfvalor, 2, ',', '.')}}</td>
                </tr>
                <?php
                    $total += $desconto->dfvalor;
                ?>
            @endforeach
        </table>
        


        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom text-center small__font destaque font text-bold matric">Quantidade trabalhador: {{count($descontos)}}</td>
                <td class="border-left border-top border-bottom text-center small__font destaque font text-bold descri quinze"> Total ============></td>
                <td class="border-right border-top border-bottom text-center small__font destaque font text-bold valor">R$ {{number_format((float)$total, 2, ',', '.')}}</td>
            </tr>
        </table>
        
        <div id="footer">
          <p class="page destaque borderT padding-footer">Página:  </p>
        </div>
    </div>
</body>
</html>