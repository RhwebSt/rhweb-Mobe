<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Recibo Avulso</title>
</head>

<style>
    @page { 
          margin-top: 252.5px; 
          margin-bottom: 110px;
          margin-left: 10px;
          margin-right: 10px;
    }
    #header { position: fixed; left: 0px; top: -252.5px; right: 0px; height: 252.5px; background-color:; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -110px; right: 0px; height: 55px; text-align: end; }
    #footer .page:after { content: counter(page, upper); }
    
    td{
        padding-left:5px;
    }

    table{
        border-collapse: collapse;
    }

    body{
        font-family:sans-serif;
    }
    
    .uppercase{
        text-transform: uppercase;
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

    .tomador{
        width:550px;
        text-transform: uppercase;
    }

    .cnpj{
        width:150px;
        text-transform: uppercase;
    }

    .title-recibo{
        width:300px;
    }

    .title-nome{
        width:500px;
        text-transform: uppercase;
    }

    .matric{
        width:159px;
    }

    .cpf{
        width:200px;
    }

    .pis{
        width:188px;
    }

    .cbo{
        width:201.5px;
    }

    .destaque{
        background-color: rgb(214, 213, 213);
    }

    .destaqueDark{
        background-color: rgb(168, 168, 168);
    }

    .cod{
        width:50px;
    }

    .descricao{
        width:508.3px;
    }

    .referencia{
        width: 120px;
    }

    .vencimentos{
        width: 123.5px;
    }

    .descontos{
        width: 123.5px;
    }

    .tipoTrab{
        width: 508px;
    }

    .tipoTrab1{
        width: 508.3px;
    }

    .total__vencimentos{
        width: 123.5px;
    }

    .total__vencimentos1{
        width: 123.2px;
    }

    .total__descontos{
        width: 123.5px;
    }


    .servicosbase{
        width: 94px;
    }

    .servrsr{
        width: 94px;
    }

    .bainss{
        width: 94px;
    }

    .bafgts{
        width: 94px;
    }

    .fgtsmes{
        width: 94px;
    }

    .bairrf{
        width: 94px;
    }

    .fairrf{
        width: 94px;
    }

    .num__filho{
        width: 67px;
    }

    .fontDeclaracao{
        font-size: 14px;
    }

    .declaracao{
        width: 763.5px;
    }

    .data{
        width:150px;
    }

    .assinatura{
        margin-top:10px;
    }

    .linhaass{
        width:608.5px;
    }

    .titlename{
        font-size: 14px;
    }

    .prodDia{
        width:702px;
    }

    .valor{
        width: 134.7px;
    }

    .dia{
        width: 46.5px;
    }
    
    .name__title{
        width: 768px;
    }
    
     .comp{
        width: 250px;
    }
    
    .cnpj{
        width: 203px;
    }
    
    .font__trab{
        font-size:14px;
    }

    .borderT
    {
        border: 1px solid black;
        border-radius: 3px;
        width:773.5px;
    }

    .margin-top{
        margin-top:20px;
    }

    .marginTerm{
        margin-top:60px;
        margin-bottom:100px;
    }

    .indentificacao{
        width: 184.7px;
    }

    .text-white{
        color:white;
    }

    .uppercase{
        text-transform: uppercase;
    }

    .data-top{
        width: 251.3px;
    }

    .margin-top__md{
        margin-top: 5px;
    }

    .margin-top__xl{
        margin-top: 10px;
    }

    .padrao{
        width: 251.5px;
    }

    .padrao1{
        width: 380.5px;
    }

    footer{
      float: right;
    }

    .padding-footer{
        padding: 2px;
        width:770px;
    }
</style>

<body>

    <div id="header">

        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">{{$avusos->esnome}}</td>
            </tr>
        </table>
   
        <div class="borderT margin-top__md">
            <table>
                    <tr>
                        <td rowspan="6"><img class="logo" src="{{$avusos->esfoto}}" title="foto" alt="" style="width:80px; height: 80px; padding:4px;"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>CNPJ/MF Nroº : </strong>{{$avusos->escnpj}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>Rua:</strong>{{$avusos->eslogradouro}}, {{$avusos->esnum}} - {{$avusos->escep}}</td>
                        
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>Bairro:</strong>{{$avusos->esbairro}} - {{$avusos->esuf}}</td>
                        
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="small__font width__padrao"><strong>Tel:</strong>{{$avusos->estelefone}}</td>
                    </tr>
            </table>
        </div>

        <table class="margin-top__md">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">Rol dos Recibos Avulsos</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-right border-left border-bottom border-top small__font text-center text-bold padrao1">Data de Emissão: {{date('d/m/y')}}</td>
                <td class="border-right border-left border-bottom border-top small__font text-center text-bold padrao1">Período: 
                <?php
                        $data_inicial = explode('-',$avusos->asinicial);
                        echo($data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                    ?>
                  a 
            
                    <?php
                        $data_final = explode('-',$avusos->asfinal);
                        echo($data_final[2].'/'.$data_final[1].'/'.$data_final[0]);
                    ?>
                
                </td>
            </tr>
        </table>
        
        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">{{$avusos->tsmatricula}} - {{$avusos->tsnome}}</td>
            </tr>
        </table>

        <table class="margin-top__md">
            <tr>
                <td class="border-right border-left border-bottom border-top small__font destaque padrao text-center text-bold">Nº do Recibo</td>
                <td class="border-right border-left border-bottom border-top small__font destaque padrao text-center text-bold">Data de Emissão</td>
                <td class="border-right border-left border-bottom border-top small__font destaque padrao text-center text-bold">Valor Líquido</td>
            </tr>
        </table>
    </div>

    <div id="footer padding-footer">
        <p class="page destaque borderT padding-footer">Página:  </p>
    </div>

    <div id="content">
        <table>
            @foreach($listaavuso as $listaavusos)
            <tr>
                <td class="border-right border-left border-bottom border-top small__font padrao text-center text-bold">{{$listaavusos->aicodigo}}</td>
                <td class="border-right border-left border-bottom border-top small__font padrao text-center text-bold">
                    <?php
                        $data_final = explode(' ',$listaavusos->created_at);
                        $data_final = explode('-',$data_final[0]);
                        echo($data_final[2].'/'.$data_final[1].'/'.$data_final[0]);
                    ?>
                </td>
                <td class="border-right border-left border-bottom border-top small__font padrao text-center text-bold">R$ {{number_format((float)$listaavusos->ailiquido, 2, ',', '')}}</td>
            </tr>
            @endforeach
        </table>
    </div>