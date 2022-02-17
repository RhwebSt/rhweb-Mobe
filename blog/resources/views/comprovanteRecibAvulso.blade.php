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
          margin-top: 253px; 
          margin-bottom: 110px;
          margin-left: 10px;
          margin-right: 10px;
    }
    #header { position: fixed; left: 0px; top: -253px; right: 0px; height: 253px; background-color:; text-align: center; }
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

    .assinatura{
    margin-top:20px;
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
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">RECIBO Avulso</td>
            </tr>
        </table>
        

        <table>
            <tr>
                <td class="small__font border-right border-left border-top border-bottom data-top text-center">Data de Emissão: {{date('d/m/y')}}</td>
                <td class="small__font border-right border-left border-top border-bottom data-top text-center">Periodo: 
            
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
                <td class="small__font border-right border-left border-top border-bottom data-top text-center">Nº do Recibo: {{$avusos->aicodigo}}</td>
            </tr>
        </table>

        <table class="margin-top">
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">{{$avusos->ascpf}} - {{$avusos->asnome}}</td>
            </tr>
        </table>

        <table class="margin-top__md">
            <tr>
                <td class="small__font border-left text-center descricao text-bold border-bottom border-top destaque">Descrição</td>
                <td class="small__font border-left text-center vencimentos text-bold border-bottom border-top destaque">Créditos</td>
                <td class="small__font border-left border-right text-center descontos text-bold border-bottom border-top destaque">Descontos</td>
            </tr>
        </table>
    </div>

    <div id="footer">
        <p class="page destaque borderT padding-footer">Página:  </p>
    </div>

    <div id="content">
        <?php
            $credito = 0;
            $desconto = 0;
        ?>
        <table>
            @foreach($descricoes as $descricao)
            <tr>
                <td class="small__font border-left descricao border-bottom uppercase">{{$descricao->asdescricao}}</td>
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
                <td class="small__font border-left border-top tipoTrab text-bold">Declaro ter recebido o Valor Líquido dando pluma e total quitação.</td>
                <td class="small__font border-left text-bold border-top total__vencimentos1 text-center destaque border-bottom border-right">Total Créditos</td>
                <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total Desconto</td>
            </tr>

            <tr>
                <td class="small__font border-left tipoTrab1"> . </td>
                <td class="small__font border-left text-bold total__vencimentos1 text-center destaque border-bottom border-right">{{number_format((float)$credito, 2, ',', '.')}}</td>
                <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">{{number_format((float)$desconto, 2, ',', '.')}}</td>
            </tr>

            <tr>
                <td class="small__font border-left tipoTrab1 border-bottom"></td>
                <td class="small__font border-left text-bold total__vencimentos1 text-center destaqueDark border-top border-bottom">Valor Líquido</td>
                <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom">{{number_format((float)$credito - $desconto, 2, ',', '.')}}</td>
            </tr>
        </table>

        
        <div class="borderT margin-top__md">
            <table class="assinatura">
                <tr>
                    <td class="fontDeclaracao linhaass text-center">__________________________________________________</td>
                </tr>
        
                <tr>
                    <td class="fontDeclaracao text-center">Assinatura Trabalhador</td>
                </tr>
            </table>

            <table class="margin-top">
                <tr>
                <td class="fontDeclaracao data__ass  text-center cidade">{{$avusos->esmunicipio}} - {{$avusos->esuf}}</td>
                    <td class="fontDeclaracao data__ass  text-center cidade">Data: {{date("d/m/y")}}</td>
                </tr>
            </table>
        </div>

        

    </div>
</body>
</html>