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

    
    .container{
        display:block;
    }
    
    .logo{
        width: 100px;
        height: 100px;
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
        font-size:12.5px
    }

    .little__font{
        font-size:12.5px;
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
    
    .name__title--tomador{
        width: 753px;
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
        width:50px;
    }

    .trabalhador{
        width: 282px;
    }

    .descri{
        width: 235px;
    }

    .quinze{
        width:76px;
    }

    .valor{
        width: 95px;
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
    
    .padding-left-foto{
        padding-left: 20px;
    }
    
    .margin-top{
        margin-top: 8px;
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
    
    .dados__padrao{
        width: 365px;
    }
    
    .margin-left{
        margin-left: 5px;
    }
    
    .margin-bottom{
        margin-bottom: 5px;
    }
    
    .qtd__trab{
        width: 339px;
    }
    
    .total__title{
        width:318px;
    }

</style>

<body class="">
    
    <div id="header">
        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="7">
                        @if($empresa->esfoto)
                            <img class="logo" src="{{$empresa->esfoto}}" alt="" srcset="">
                        @else
                            @include('imagem')
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td class=" width__padrao padding-left-foto text-bold margin-bottom--title">{{$descontos[0]->esnome}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$empresa->escnpj}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Rua: {{$empresa->eslogradouro}},{{$empresa->esnum}} - {{$empresa->escep}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Bairro: {{$empresa->esbairro}} - {{$empresa->esuf}}</td>
                </tr>
    
                <tr>

                    <td class="small__font width__padrao capitalize padding-left-foto">Tel: {{$empresa->estelefone}}</td>
                </tr>
    
            </table>
        </div>
        
        <div class="borderT margin-top">
            <table class="margin-top margin-left margin-bottom">
                <tr>
                    <td class="name__title--tomador text-center text-bold destaque">Rol dos Descontos</td>
                </tr>
            </table>
    
            <table class="margin-bottom">
                <tr>
                    <td class="text-center small__font text-bold dados__padrao">Competência: 
                        <?php
                            // $data = explode('-',$descontos[0]->dscompetencia);
                            $datainicio = 0;
                            $datafinal = 0;
                            foreach ($descontos as $key => $desconto) {
                                if ($desconto->dscompetencia == substr($inicio,0,7)) {
                                    $datainicio =  date('m/Y',strtotime($desconto->dscompetencia));
                                }
                                if ($desconto->dscompetencia == substr($final,0,7)) {
                                    $datafinal =  date('m/Y',strtotime($desconto->dscompetencia));
                                }
                            }
                        ?>
                        @if($datainicio != $datafinal)
                            {{datainicio}} a {{datafinal}}
                        @else
                         {{$datafinal}}
                        @endif
                        
                    </td>
                    <td class="text-center small__font text-bold dados__padrao">Data de Emissão: {{date("d/m/y")}}</td>
                </tr>
            </table>
        </div>

        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font matric">Matric</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font trabalhador">Trabalhador</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font descri">Descrição</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font quinze">Quinzena</td>
                <td class="border-left border-right border-top border-bottom text-center text-bold destaque small__font valor">Valor</td>
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
                    <td class="border-left border-right border-top border-bottom text-center small__font matric">{{$desconto->tsmatricula}}</td>
                    <td class="border-left border-right border-top border-bottom text-center small__font trabalhador">{{$desconto->tsnome}}</td>
                    <td class="border-left border-right border-top border-bottom text-center small__font descri">{{$desconto->dsdescricao}}</td>
                    <td class="border-left border-right border-top border-bottom text-center small__font quinze">{{$desconto->dsquinzena}}</td>
                    <td class="border-left border-right border-top border-bottom text-center small__font valor">R$ {{number_format((float)$desconto->dfvalor, 2, ',', '.')}}</td>
                </tr>
                <?php
                    $total += $desconto->dfvalor;
                ?>
            @endforeach
        </table>
        


        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom text-center destaque text-bold small__font qtd__trab">Quantidade trabalhador: {{count($descontos)}}</td>
                <td class="border-left border-top border-bottom text-center text-bold small__font total__title destaque"> Total ============></td>
                <td class="border-right border-top border-bottom text-center destaque text-bold small__font valor">R$ {{number_format((float)$total, 2, ',', '.')}}</td>
            </tr>
        </table>
        
        
    </div>
    
    <div id="footer">
        <p class="page padding-footer" style="text-align: right">Página:  </p>
    </div>
</body>
</html>