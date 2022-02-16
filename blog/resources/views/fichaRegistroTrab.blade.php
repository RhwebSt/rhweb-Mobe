<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Ficha de Registro do Trabalhador</title>
    </head>

    <style>
        .capitalize{
            text-transform: capitalize;
        }
        
        *{
            margin: 5px;
            padding: 0px;
        }
        
        body{
            font-family:sans-serif;
        }
        
         table{
            border-collapse: collapse;
        }
        
        td{
            padding-left: 5px;
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
            width: 757px;
        }

        .flex{
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            align-content: flex-start;

            
        }

        .width__padrao{
            width:576px;
        }

        .logo{
            margin-top:10px;
            margin-right: 50px;
            width: 100px;
            height: 120px;
        }

        .documentos{
            width:248.5px;
        }
        
        .documento__info{
            width: 185px;
        }

        .rua{
            width:513.5px;
        }

        .uf{
            width:100px;
        }

        .cep{
            width:132px;
        }

        .cidade2{
            width:398px;
        }
        .telefone{
            width:168px;
        }

        .afiliacao{
            width:757px;
        }

        .nome{
            width:522px;
        }

        .data{
            width:230px;
        }

        .bancario{
            width:170px;
        }
        
        .bancario2{
            width:406px;
        }


        
        .semdepe{
            width:757px;
        }
        
        .natural{
            width: 180px;
        }
        
        .margin-top{
            margin-top:20px;
        }
        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }
        
        .assinatura{
        margin-top:50px;
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

        .protco{
            margin-top: 50px;
        }
        


    </style>

    <body>
        
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">{{$empresas->esnome}}</td>
            </tr>
        </table>
        <div class="borderT">
            <table >
                <tr>
                    <td rowspan="6"><img class="logo" src="{{$empresas->esfoto}}" alt="" srcset="" style="width:80px; height: 80px; padding:10px"></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao"><strong>CNPJ/MF Nroº : {{$empresas->escnpj}}</strong></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Rua:</strong> {{$empresas->eslogradouro}}, {{$empresas->esnum}} - {{$empresas->escep}}</td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Bairro:</strong> {{$empresas->esbairro}} - {{$empresas->esuf}}</td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Tel:</strong> {{$empresas->estelefone}}</td>
                </tr>
    
            </table>
        </div>


        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Ficha de Registro do Trabalhador</td>
            </tr>
        </table>
        <div class="borderT">
            <table>
                <tr>
                    <td rowspan="7"><img class="logo" src="{{$trabalhadors->tsfoto}}"></td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="width__padrao uppercase"><strong>{{$trabalhadors->tsnome}}</strong></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="width__padrao small__font capitalize"><strong>Matrícula:</strong> {{$trabalhadors->tsmatricula}}</td>
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Categoria:</strong> {{$trabalhadors->cscategoria}}</td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>CBO: </strong>{{$trabalhadors->cbo}}</td>
                    
                </tr>
    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="small__font width__padrao capitalize"><strong>Data de Admissão:</strong> 
                            <?php
                                $data = explode('-',$trabalhadors->csadmissao)
                            ?>
                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                    </td>
                </tr>
    
            </table>
        </div>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Documentos</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font documentos border-left border-top capitalize border-bottom border-right"><strong>PIS:</strong>  {{$trabalhadors->dspis}}</td>
                <td class="small__font documentos border-top capitalize border-bottom border-right"><strong>CPF:</strong> {{$trabalhadors->tscpf}}</td>
                <td class="small__font documentos border-right border-top capitalize border-bottom border-left"><strong>Data Nascimento:</strong> 
                    <?php
                        $data = explode('-',$trabalhadors->nsnascimento)
                    ?>
                    {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                </td>
            </tr>
        </table>
            
        <table>
            <tr>
                <td class="small__font documento__info border-left border-bottom capitalize border-right border-top"><strong>CTPS:</strong> {{$trabalhadors->dsctps}}</td>
                <td class="small__font documento__info uppercase border-bottom border-right  border-top"><strong>Série:</strong> {{$trabalhadors->dsserie}} - {{$trabalhadors->dsuf}}</td>
                <td class="small__font documento__info  capitalize border-bottom border-right  border-top"><strong>Estado Cívil:</strong> {{$trabalhadors->nscivil}}</td>
                <td class="small__font documento__info border-right capitalize border-bottom border-left border-top"><strong>Sexo:</strong> {{$trabalhadors->tssexo}}</td>
            </tr>
        </table>

        

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Endereço</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font border-left rua border-top border-bottom capitalize border-right"><strong>Endereço:</strong>  {{$trabalhadors->eslogradouro}}, {{$trabalhadors->esnum}}</td>
                <td class="small__font uf border-top text-center capitalize border-bottom  border-right"><strong>UF:</strong> {{$trabalhadors->esuf}}</td>
                <td class="small__font border-right cep text-center border-top border-bottom capitalize  border-left"><strong>CEP:</strong> {{$trabalhadors->escep}}</td>
            </tr>
        </table>
        <table>    
            <tr>
                <td class="small__font cidade2 border-left border-bottom capitalize border-top border-right"><strong>Cidade:</strong> {{$trabalhadors->esmunicipio}}</td>
                <td class="small__font natural border-bottom capitalize border-top text-center border-right"><strong>Natural:</strong> {{$trabalhadors->nsnaturalidade}}</td>
                <td class="small__font border-right cep telefone border-bottom capitalize border-top border-left"><strong>Telefone:</strong>{{$trabalhadors->tstelefone}}</td>
            </tr>
        </table>
        
        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Filiação</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font afiliacao border-left border-right border-bottom border-top capitalize"><strong>Nome da Mãe:</strong>{{$trabalhadors->tsmae}}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Dependentes</td>
            </tr>
        </table>

        <table>
            @if(count($depedentes) > 0)
                @foreach($depedentes as $depedente)
                    <tr>
                        <td class="small__font border-top border-left border-bottom nome capitalize"><strong>Nome: </strong>{{$depedente->dsnome}}</td>
                        <td class="small__font border-right border-top border-bottom border-left data capitalize"><strong>Data Nascimento: </strong>
                            <?php
                                $data = explode('-',$depedente->dsdata)
                            ?>
                            {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td  class="small__font semdepe border-top border-bottom border-left nome text-center border-right"><strong>Não á depedentes.</strong></td>
                    </tr>
             @endif
        </table>

        <table>
            <tr>
                <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaque">Informações Bancárias</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="small__font bancario2 border-top border-bottom border-left border-right text-center capitalize"><strong>Banco:</strong> {{$trabalhadors->bsbanco}}</td>
                <td class="small__font bancario text-center border-top border-bottom  border-right capitalize"><strong>Agência:</strong> {{$trabalhadors->bsagencia}}</td>
                <td class="small__font bancario text-center border-top border-bottom  border-right  capitalize"><strong>Conta:</strong> {{$trabalhadors->bsconta}}</td>
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

            <table class="margin-top">
                <tr>
                <td class="fontDeclaracao data__ass  text-center cidade">{{$empresas->esmunicipio}} - {{$empresas->esuf}}</td>
                    <td class="fontDeclaracao data__ass  text-center cidade">Data: {{date("d/m/y")}}</td>
                </tr>
            </table>
        </div>
    </body>
</html>