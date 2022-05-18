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
          margin-top: 257px; 
          margin-bottom: 110px;
          margin-left: 10px;
          margin-right: 10px;
    }
    #header { position: fixed; left: 0px; top: -257px; right: 0px; height: 257px; background-color:; text-align: center; }
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
        width:506px;
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
        width: 506px;
    }

    .tipoTrab1{
        width: 506px;
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
    
    .name__title--recibo{
        width: 755px;
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

    .assinatura{
        margin-top:10px;
    }

    .fontDeclaracao{
    font-size: 14px;
    }

    .data__ass{
    width:150px;
    }

    .linhaass{
    width:759px;
    }

    .cidade{
        width:375px;
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
    
    .font__valor{
      font-size: 13.5px;  
    }
</style>

<body>

    <div id="header">
        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="7">
                        @if($avusos->esfoto)
                            <img class="logo" src="{{$avusos->esfoto}}">
                        @else
                            @include('imagem')
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td class=" width__padrao padding-left-foto text-bold margin-bottom--title">{{$avusos->esnome}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$avusos->escnpj}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Rua: {{$avusos->eslogradouro}}, {{$avusos->esnum}} - {{$avusos->escep}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Bairro: {{$avusos->esbairro}} - {{$avusos->esuf}}</td>
                </tr>
    
                <tr>

                    <td class="small__font width__padrao capitalize padding-left-foto">Tel: {{$avusos->estelefone}}</td>
                </tr>
    
            </table>
        </div>

        
        <div class="margin-top borderT">
            <table class="margin-top margin-left margin-bottom">
                <tr>
                    <td class="name__title--recibo text-center text-bold destaque">Recibo Avulso</td>
                </tr>
            </table>
            
    
            <table class="margin-bottom">
                <tr>
                    <td class="small__font data-top text-center"><b>Data de Emissão:</b> {{date('d/m/y')}}</td>
                    <td class="small__font data-top text-center"><b>Periodo:</b> 
                
                        <?php
                            $data_inicial = explode('-',$avusos->asinicial);
                            echo($data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                        ?>
                      á 
                
                        <?php
                            $data_final = explode('-',$avusos->asfinal);
                            echo($data_final[2].'/'.$data_final[1].'/'.$data_final[0]);
                        ?>
                    
                    </td>
                    <td class="small__font data-top text-center"><b>Nº do Recibo:</b> {{$avusos->aicodigo}}</td>
                </tr>
            </table>
        </div>
        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">{{$avusos->ascpf}} - {{$avusos->asnome}}</td>
                </tr>
            </table>
        </div>


        <table class="margin-top__md">
            <tr>
                <td class="small__font border-left text-center descricao text-bold border-bottom border-top destaque">Descrição</td>
                <td class="small__font border-left text-center vencimentos text-bold border-bottom border-top destaque">Créditos</td>
                <td class="small__font border-left border-right text-center descontos text-bold border-bottom border-top destaque">Descontos</td>
            </tr>
        </table>
    </div>

    <div id="footer">
        <p class="page padding-footer" style="text-align: right">Página:  </p>
    </div>

    <div id="content">
        <?php
            $credito = 0;
            $desconto = 0;
        ?>
        <table>
            @foreach($descricoes as $descricao)
            <tr>
                <td class="small__font border-left descricao border-bottom">{{$descricao->asdescricao}}</td>
                <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                    @if($descricao->asstatus === 'Crédito')
                        {{number_format((float)$descricao->aivalor, 2, ',', '.')}}
                        <?php
                        $credito += $descricao->aivalor;
                        ?>
                    @endif
                    
                </td>
                <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    @if($descricao->asstatus === 'Desconto')
                        {{number_format((float)$descricao->aivalor, 2, ',', '.')}}
                        <?php
                            $desconto += $descricao->aivalor
                        ?>
                    @endif
                    
                </td>
            </tr>
            @endforeach

        </table>

        <table>
            <tr>
                <td class="small__font border-left tipoTrab text-bold">Declaro ter recebido o Valor Líquido dando pluma e total quitação.</td>
                <td class="small__font border-left text-bold border-top total__vencimentos1 text-center destaque border-bottom border-right">Total Créditos</td>
                <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total Desconto</td>
            </tr>

            <tr>
                <td class="small__font border-left tipoTrab1"> </td>
                <td class="small__font border-left text-bold total__vencimentos1 text-center border-bottom border-right">{{number_format((float)$credito, 2, ',', '.')}}</td>
                <td class="small__font border-left text-bold border-right total__descontos text-center border-bottom">{{number_format((float)$desconto, 2, ',', '.')}}</td>
            </tr>

            <tr>
                <td class="small__font border-left tipoTrab1 border-bottom"></td>
                <td class="small__font border-left text-bold total__vencimentos1 text-center destaque border-top border-bottom font__valor">Valor Líquido</td>
                <td class="small__font text-bold border-right total__descontos text-center destaque border-top border-bottom font__valor">{{number_format((float)$credito - $desconto, 2, ',', '.')}}</td>
            </tr>
        </table>

        
        <div class="borderT margin-top">
            <table class="assinatura">
                <tr>
                    <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
                </tr>
        
                <tr>
                    <td class="fontDeclaracao text-center">Assinatura Trabalhador</td>
                </tr>
            </table>

            <table class="margin-top margin-bottom">
                <tr>
                <td class="fontDeclaracao data__ass  text-center cidade">{{$avusos->esmunicipio}} - {{$avusos->esuf}}</td>
                    <td class="fontDeclaracao data__ass  text-center cidade">Data: {{date("d/m/y")}}</td>
                </tr>
            </table>
        </div>

        

    </div>
</body>
</html>