<!DOCTYPE html>
<html lang="pt-br">
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
            /*margin-top:10px;*/
            /*margin-right: 50px;*/
            width: 100px;
            height: 100px;
        }

        .documentos{
            width:248.5px;
        }
        
        .documento__info{
            width: 182.6px;
        }

        .rua{
            width:370px;
        }

        

        .cep{
            width:182px;
        }

        .cidade2{
            width:398px;
        }
        .telefone{
            width:168px;
        }

        .afiliacao{
            width:745px;
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
            width:393px;
        }


        
        .semdepe{
            width:745px;
        }
        
        .natural{
            width: 180px;
        }

        
        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }
        
        .assinatura{
        margin-top:30px;
        }

        .fontDeclaracao{
        font-size: 14px;
        }

        .data__ass{
            width:372.5px;
        }

        .linhaass{
        width:759px;
        }

        .protco{
            margin-top: 50px;
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
        
        .bairro{
            width: 199px;
        }
        
        .cidade{
            width: 199px;
        }
        
        .nacionalidade{
            width: 200px;
        }
        
        .uf{
            width:100px;
        }
        
        .numero{
            width:100px;
        }
        
        .numero__endereco{
            width:182px;
        }
        
        .padding-border{
            margin-top: 10px;
        }
        
        .nome__depedente{
            width:507px;
        }

    </style>

    <body>

        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="7">
                        @if($empresas->esfoto)
                            <img class="logo" src="{{$empresas->esfoto}}">
                        @else
                            @include('imagem')
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td class=" width__padrao padding-left-foto text-bold margin-bottom--title">{{$empresas->esnome}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">CNPJ/MF Nroº : {{$empresas->escnpj}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Rua: {{$empresas->endereco[0]->eslogradouro}}, {{$empresas->endereco[0]->esnum}} - {{$empresas->endereco[0]->escep}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao capitalize padding-left-foto">Bairro: {{$empresas->endereco[0]->esbairro}} - {{$empresas->endereco[0]->esuf}}</td>
                </tr>
    
                <tr>

                    <td class="small__font width__padrao capitalize padding-left-foto">Tel: {{$empresas->estelefone}}</td>
                </tr>
    
            </table>
        </div>

        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Ficha de Registro do Trabalhador</td>
                </tr>
            </table>
        </div>
        
        
        <div class="borderT margin-top">
            <table>
                <tr>
                    <td rowspan="7">
                        @if($trabalhadors->tsfoto)
                            <img class="logo" src="{{$trabalhadors->tsfoto}}">
                        @else
                            @include('imagemTrabalhador')
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="padding-left-foto text-bold">{{$trabalhadors->tsnome}}</td>
                </tr>
                
                <tr>
                    <td class="small__font padding-left-foto">Matrícula:{{$trabalhadors->tsmatricula}}</td>
                </tr>
    
                <tr>
                    <td class="small__font padding-left-foto">Categoria: {{$trabalhadors->categoria[0]->cscategoria}}</td>
                </tr>
    
                <tr>
                    <td class="small__font padding-left-foto">CBO:{{$trabalhadors->categoria[0]->cbo}}</td>
                </tr>
    
                <tr>
                    <td class="small__font padding-left-foto">Data de Admissão: 
                        {{date('d/m/Y',strtotime($trabalhadors->csadmissao))}}
                    </td>
                </tr>
    
            </table>
        </div>

        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Identificação do Trabalhador</td>
                </tr>
            </table>
        </div>

        <div class="margin-top borderT">
            <table class="padding-border">
                <tr>
                    <td class="small__font documento__info text-center text-bold destaque ">PIS</td>
                    <td class="small__font documento__info text-center text-bold destaque">CPF</td>
                    <td class="small__font documento__info text-center text-bold destaque">Data Nascimento</td>
                    <td class="small__font documento__info text-center text-bold destaque">Telefone</td>
                </tr>
                
                <tr>
                    <td class="small__font documento__info text-center">{{$trabalhadors->documento[0]->dspis}}</td>
                    <td class="small__font documento__info text-center">{{$trabalhadors->tscpf}}</td>
                    <td class="small__font documento__info text-center">{{date('d/m/Y',strtotime($trabalhadors->nsnascimento))}}</td>
                    <td class="small__font documento__info text-center">{{$trabalhadors->tstelefone}}</td>
                </tr>
>
                <tr>
                    <td class="small__font documento__info text-center text-bold destaque">CTPS</td>
                    <td class="small__font documento__info text-center text-bold destaque">Série</td>
                    <td class="small__font documento__info text-center text-bold destaque">Estado Cívil</td>
                    <td class="small__font documento__info text-center text-bold destaque">Sexo</td>
                </tr>
                
                <tr>
                    <td class="small__font documento__info text-center">{{$trabalhadors->documento[0]->dsctps}}</td>
                    <td class="small__font documento__info text-center">{{$trabalhadors->documento[0]->dsserie}} - {{$trabalhadors->documento[0]->dsuf}}</td>
                    <td class="small__font documento__info text-center">{{$trabalhadors->nascimento[0]->nscivil}}</td>
                    <td class="small__font documento__info text-center">{{$trabalhadors->tssexo}}</td>
                </tr>
            </table>
        
        </div>

        

        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Endereço</td>
                </tr>
            </table>
        </div>
        
        
        <div class="margin-top borderT">
            
            <table class="padding-border">
                <tr>
                    <td class="small__font text-center text-bold destaque rua">Rua</td>
                    <td class="small__font text-center text-bold destaque numero__endereco">Número</td>
                    <td class="small__font text-center text-bold destaque cep">CEP</td>
                </tr>
                
                <tr>
                    <td class="small__font  text-center rua">{{$trabalhadors->endereco[0]->eslogradouro}}</td>
                    <td class="small__font numero text-center">{{$trabalhadors->endereco[0]->esnum}}</td>
                    <td class="small__font  text-center cep ">{{$trabalhadors->endereco[0]->escep}}</td>
                </tr>

            </table>
            
            <table>
                <tr>
                    <td class="small__font text-center text-bold destaque documento__info">Bairro</td>
                    <td class="small__font text-center text-bold destaque documento__info">Cidade</td>
                    <td class="small__font text-center text-bold destaque documento__info ">UF</td>
                    <td class="small__font text-center text-bold destaque documento__info">Nacionalidade</td>
                </tr>
                
                <tr>
                    <td class="small__font text-center documento__info">{{$trabalhadors->endereco[0]->esbairro}}</td>
                    <td class="small__font text-center documento__info">{{$trabalhadors->endereco[0]->esmunicipio}}</td>
                    <td class="small__font text-center documento__info">{{$trabalhadors->endereco[0]->esuf}}</td>
                    <td class="small__font text-center documento__info">{{$trabalhadors->nascimento[0]->nsnaturalidade}}</td>
                </tr>
            </table>

        </div>
        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Filiação</td>
                </tr>
            </table>
        </div>
        
        <div class="margin-top borderT">
            
            <table class="padding-border">
                <tr>
                    <td class="small__font afiliacao text-bold destaque text-center">Nome da Mãe</td>
                </tr>
                
                <tr>
                    <td class="small__font afiliacao text-center border-right border-top border-bottom border-left">{{$trabalhadors->tsmae}}</td>
                </tr>
            </table>
            
        </div>

        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Depedentes</td>
                </tr>
            </table>
        </div>
        
        <div class="margin-top borderT">
            <table>
                @if(count($trabalhadors->depedente) > 0)
                        <tr>
                            <td class="small__font text-center text-bold destaque nome__depedente">Nome</td>
                            <td class="small__font text-center text-bold destaque data">Data Nascimento</td>
                        </tr>
                    @foreach($trabalhadors->depedente as $depedente)
                        <tr>
                            <td class="small__font border-top border-left border-bottom nome__depedente text-center">{{$depedente->dsnome}}</td>
                            <td class="small__font border-right border-top border-bottom border-left data text-center">
                                <?php
                                    $data = explode('-',$depedente->dsdata)
                                ?>
                                {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td  class="small__font semdepe text-center"><strong>Não há depedentes.</strong></td>
                        </tr>

                @endif
            </table>
        </div>

        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Informações Bancárias</td>
                </tr>
            </table>
        </div>

        <div class="margin-top borderT">
            <table>
                <tr>
                    <td class="small__font bancario2 text-center destaque">Banco</td>
                    <td class="small__font bancario text-center destaque">Agência</td>
                    <td class="small__font bancario text-center destaque">Conta</td>
                </tr>
                <tr>
                    <td class="small__font bancario2 border-top border-bottom border-left border-right text-center">{{$trabalhadors->bancario[0]->bsbanco}}</td>
                    <td class="small__font bancario text-center border-top border-bottom  border-right">{{$trabalhadors->bancario[0]->bsagencia}}</td>
                    <td class="small__font bancario text-center border-top border-bottom  border-right">{{$trabalhadors->bancario[0]->bsconta}}</td>
                </tr>
            </table>
        </div>

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
                    <td class="fontDeclaracao data__ass  text-center">{{$empresas->endereco[0]->esmunicipio}} - {{$empresas->endereco[0]->esuf}}</td>
                    <td class="fontDeclaracao data__ass  text-center">Data: {{date("d/m/y")}}</td>
                </tr>
            </table>
        </div>
        
    </body>
</html>