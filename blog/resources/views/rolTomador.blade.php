<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/reset.css">
        <title>RHWEB - Rol dos Tomadores</title>
    </head>
    
    <style>
    
        @page { 
              margin-top: 230px; 
              margin-bottom: 60px;
              margin-left: 10px;
              margin-right: 10px;
        }
        #header { position: fixed; left: 0px; top: 230px; right: 0px; height: 230px; background-color:; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 60px; text-align: end; }
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
          margin: 0;
          padding: 0;
          text-transform: capitalize;
           border-collapse: collapse;
        
          
        }
    
        .matricula{
          width:24px;
        }
    
        .matricula2{
            width:55.5px;
        }
    
        .nome{
          width:500px;
        }
    
        .nome2{
          width:290px;
          border-right: 1px solid;
        }
    
        .cnpj{
          width:120px;
        }
    
        .cnpj2{
            width:60px;
        }
    
        .telefone{
          width:102px;
        }
    
        .telefone2{
            width:40px;
        }
    
        .nasc{
          width:55px;
          border-right: 1px solid;
          text-align: center;
        }
    
        .pis{
          width:83px;
          border-right: 1px solid;
          text-align: center;
        }
    
        .situacao{
          width:50px;
          text-align: center;
        }
    
        p{
          font-weight: bolder;
          font-size: 12px;
          margin-bottom:10px;
          float:right;
        }
    
       
        
        .rolTitulo{
            margin-left:100px;
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
    
    
        .page {
            position:absolute;
            bottom:0;
            width:100%;
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
            font-size:11.5px
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
            width: 767px;
        }
    
    
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
            width: 758px;
        }
        
        .margin-top{
            margin-top: 10px;
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
        
        .logo{
            width: 100px;
            height: 100px;
        }
        
        .padding-left-foto{
            padding-left: 20px;
        }
        
        .margin-top{
            margin-top: 8px;
        }
        
        .margin-top2{
            margin-top: 30px;
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
    
    
    
    </style>


    <body class="">
        
        <div id="header">
            
            <div class="borderT margin-top">
                <table>
                    <tr>
                        <td rowspan="7" style="padding-left: 15px">
                            @if($empresas->esfoto)
                                <img class="logo" src="{{$empresas->esfoto}}" alt="" srcset="">
                            @else
                                @include('imagem')
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="padding-left-foto text-bold">{{$empresa->esnome}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">CNPJ/MF Nroº : {{$empresas->escnpj}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Rua: {{$empresas->endereco[0]->eslogradouro}}, {{$empresas->endereco[0]->esnum}} - {{$empresas->endereco[0]->escep}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Bairro: {{$empresas->endereco[0]->esbairro}} - {{$empresas->endereco[0]->esuf}}</td>
                    </tr>
        
                    <tr>
                        <td class="small__font padding-left-foto">Tel: {{$empresas->estelefone}}</td>
                    </tr>
        
                </table>
            </div>
            
            <div class="margin-top">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">Rol dos Tomadores - Ordem Alfabética - Data: {{date("d/m/y")}}</td>
                    </tr>
                </table>
            </div>
            
            <div class="margin-top2">
                <table>
                    <tr>
                        <td class="name__title text-center text-bold">{{$empresas->esnome}}</td>
                    </tr>
                </table>
            </div>
    
        </div>
        
        <div id="footer">
            <p class="page" style="text-align: right">Página:  </p>
        </div>
        
        <div id="content">
            <div class="">
    
                <table>
                    @foreach($tomadores as $tomador)
                    <tr class="bottom">
                        <td class="matricula small__font border-right border-top text-center border-left border-bottom uppercase">{{$tomador->tsmatricula}}</td>
                        <td class="nome small__font border-right border-left border-bottom border-top  uppercase">{{$tomador->tsnome}}</td>
                        <td class="cnpj small__font border-right border-left border-bottom text-center border-top  uppercase">{{$tomador->tscnpj}}</td>
                        <td class="telefone small__font border-right border-left border-bottom text-center border-top  uppercase">{{$tomador->tstelefone}}</td>
                    </tr>
                    @endforeach
                </table>
        
            </div>
        </div>
    </body>
</html>