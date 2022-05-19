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
          margin-top: 261.5px; 
          margin-bottom: 110px;
          margin-left: 10px;
          margin-right: 10px;
    }
    #header { position: fixed; left: 0px; top: -261.5px; right: 0px; height: 261.5px; background-color:; text-align: center; }
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
    
    .logo{
        width: 100px;
        height: 100px;
        }
        
    .margin-left{
        margin-left: 5px;
    }
    
    .margin-bottom{
        margin-bottom: 5px;
    }
    
    .name__title--recibo{
        width: 755px;
    }
</style>

<body>

    <div id="header">
        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="7">
                        @if($avuso[0]->empresa->esfoto)
                        <img class="logo" src="{{$avuso[0]->empresa->esfoto}}" alt="" srcset="">
                        @else
                            @include('imagem')
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td class=" width__padrao padding-left-foto text-bold margin-bottom--title">{{$avuso[0]->empresa->esnome}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$avuso[0]->empresa->escnpj}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Rua: {{$avuso[0]->empresa->endereco[0]->eslogradouro}}, {{$avuso[0]->empresa->endereco[0]->esnum}} - {{$avuso[0]->empresa->endereco[0]->escep}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Bairro: {{$avuso[0]->empresa->endereco[0]->esbairro}} - {{$avuso[0]->empresa->endereco[0]->esuf}}</td>
                </tr>
    
                <tr>

                    <td class="small__font width__padrao capitalize padding-left-foto">Tel: {{$avuso[0]->empresa->estelefone}}</td>
                </tr>
    
            </table>
        </div>

        <div class="margin-top borderT">
            <table class="margin-top margin-left margin-bottom">
                <tr>
                    <td class="name__title--recibo text-center text-bold destaque">Rol dos Recibos Avulsos</td>
                </tr>
            </table>
    
            <table class="margin-bottom">
                <tr>
                    <td class="small__font text-center text-bold padrao1">Data de Emissão: {{date('d/m/Y')}}</td>
                    <td class="small__font text-center text-bold padrao1">Período: {{date('d/m/Y',strtotime($dados['ano_inicial1']))}} a {{date('d/m/Y',strtotime($dados['ano_final1']))}}</td>
                </tr>
            </table>

        </div>
        
        <table class="margin-top">
            <tr>
                <td class="name__title text-center text-bold">{{$avuso[0]->asnome}}</td>
            </tr>
        </table>
        
        <table class="margin-top">
            <tr>
                <td class="border-right border-left border-bottom border-top small__font destaque padrao text-center text-bold">Nº do Recibo</td>
                <td class="border-right border-left border-bottom border-top small__font destaque padrao text-center text-bold">Data de Emissão</td>
                <td class="border-right border-left border-bottom border-top small__font destaque padrao text-center text-bold">Valor Líquido</td>
            </tr>
        </table>
    </div>

    <div id="footer">
        <p class="page padding-footer" style="text-align: right">Página:  </p>
    </div>

    <div id="content">
        <table>
            @foreach($avuso as $avusos)
            <tr>
                <td class="border-right border-left border-bottom border-top small__font padrao text-center">{{$avusos->aicodigo}}</td>
                <td class="border-right border-left border-bottom border-top small__font padrao text-center">{{date('d/m/Y',strtotime($avusos->asinicial))}} a {{date('d/m/Y',strtotime($avusos->asfinal))}}</td>
                <td class="border-right border-left border-bottom border-top small__font padrao text-center">R$ {{number_format((float)$avusos->ailiquido, 2, ',', '')}}</td>
            </tr>
            @endforeach
        </table>
    </div>