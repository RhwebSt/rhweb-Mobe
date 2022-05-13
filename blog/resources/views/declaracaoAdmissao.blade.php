<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RHWEB - Declaração de Admissão</title>
    </head>

    <style>


        body{
            font-family:sans-serif;
        }

        *{
            margin: 5px;
            padding: 0px;
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

        .italic{
            font-style: italic;
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
            width: 100px;
            height: 100px;
        }

        .name__title{
            width: 757px;
        }

        .name__title2{
            width: 97%;
            font-size: 16px;
            text-align: justify;
        }

        .width__padrao{
            width:646px;
        }

        .borderT{
            border: 1px solid black;
            border-radius: 3px;
        }

        .marginTerm{
            margin-top:40px;
            margin-bottom:30px;
        }

        .indentificacao{
            width: 182.3px;
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

        .cidade{
            width:375px;
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
        
        .nome__trab{
            width: 745px;
        }

    </style>

    <body>

        <div class="borderT margin-top">
            <table >
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
                    <td class="small__font width__padrao padding-left-foto">Rua: {{$empresas->endereco[0]->eslogradouro}}, {{$empresas->endereco[0]->esnum}} - {{$empresas->endereco[0]->escep}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">Bairro: {{$empresas->endereco[0]->esbairro}} - {{$empresas->endereco[0]->esuf}}</td>
                </tr>
    
                <tr>
                    <td class="small__font width__padrao padding-left-foto">Tel: {{$empresas->estelefone}}</td>
                </tr>
    
            </table>
        </div>
        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Declaração de Admissão do Trabalhador Avulso</td>
                </tr>
            </table>
        </div>


        <div class="marginTerm">
            <p class=" text name__title2">Declaro para todos os fíns de direito, principalmente trabalhistas e previdênciárias, que irei exercer a atividade de <b>
                
                {{date('d/m/Y',strtotime($trabalhadors->categoria[0]->cbo))}},
            </b> na condição de <b>
               
                 {{date('d/m/Y',strtotime($trabalhadors->categoria[0]->cscategoria))}}
            </b> sob a representação do <b>{{$empresas->esnome}}</b> (sem vínculo empregatício), com a remuneração por tarefa e anotações em carteria a teor do artigo VI do decreto 611 de 21/07/1992.</p>
            <p class="text name__title2">Outrosim, declaro que tenho pleno conhecimento do sistema de pagamento  da minha <b>Remuneração</b> e dos adicionais, cujo indices são os seguintes:<i>Férias 11,12% incidente sobre 18,18% repouso remunerado sobre a produção (LEI 5.085/66, já acrescida de 1/3 , CF/88, valores pagos e discriminados nos recibos.) 13º Salário 8,34% incidente sobre 18,18% repouso remunerado sobre a produção, (LEI 5.080/68, regulamentada pelo Decreto 63.912/68) Valores pagos e discriminados nos recibos.</i></p>
            <p class="text name__title2"><i>FGTS (LEI 8.036//90, deposito mensal em conta na Caixa, (produção + repouso(18,18%)) + férias + 13º salário) incidência de 8%.</i></b></p>
            <p class="text name__title2">Sei também do procedimento para saque do FGTS determinado pela legislação vigente, ou seja por um periodo igual ou superior a <b>90 (noventa) dias.</b></p>
            <p class="text name__title2">Assim como declaro estar ciente de que, como trabalhador avulso, por ocasião do meu desligamento, não haverá remuneração referente ao aviso prévio, multa FGTS, bem como <b>"Seguro Desemprego".</b>Remunerações estarão pertinentes somente aos trabalhadores com vínculo empregatício</p>
            <p class="text name__title2"><b>Pelo que estou ciente, firmo e presente, em duas vias do mesmo teor e forma</b></p>

           
        </div>
        
        <div class="margin-top">
            <table>
                <tr>
                    <td class="name__title text-center text-bold">Identificação do Trabalhador</td>
                </tr>
            </table>
        </div>
        

        <div class="margin-top borderT">
            <table class="">
                <tr>
                    <td class="small__font nome__trab text-center text-bold destaque">Nome</td>
                </tr>
                
                <tr>
                    <td class="small__font nome__trab text-center">{{$trabalhadors->tsnome}}</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td class="small__font text-center indentificacao destaque text-bold">PIS/PASEP</td>
                    <td class="small__font text-center indentificacao destaque text-bold">CPF</td>
                    <td class="small__font text-center indentificacao destaque text-bold">RG</td>
                    <td class="small__font text-center indentificacao destaque text-bold">Data Nascimento</td>
                </tr>
    
                <tr>
                    <td class="small__font text-center indentificacao">{{$trabalhadors->documento[0]->dspis}}</td>
                    <td class="small__font text-center indentificacao">{{$trabalhadors->tscpf}}</td>
                    <td class="small__font text-center indentificacao">0000-000</td>
                    <td class="small__font text-center indentificacao">
                        {{date('d/m/Y',strtotime($trabalhadors->nascimento[0]->nsnascimento))}}
                    </td>
                    
                </tr>
            </table>
    
            <table>
                <tr>
                    <td class="small__font text-center indentificacao destaque text-bold">Data Admissão</td>
                    <td class="small__font text-center indentificacao destaque text-bold">Num CTPS</td>
                    <td class="small__font text-center indentificacao destaque text-bold">Série CTPS</td>
                    <td class="small__font text-center indentificacao destaque text-bold">UF CTPS</td>
                </tr>
    
                <tr>
                    <td class="small__font text-center indentificacao">
                        
                       {{date('d/m/Y',strtotime($trabalhadors->categoria[0]->csadmissao))}}
                    </td>
                    <td class="small__font text-center indentificacao">{{$trabalhadors->documento[0]->dsctps}}</td>
                    <td class="small__font text-center indentificacao">{{$trabalhadors->documento[0]->dsserie}}</td>
                    <td class="small__font text-center indentificacao">{{$trabalhadors->documento[0]->dsuf}}</td>
                </tr>
            </table>
    
            <table>
                <tr>
                    <td class="small__font nome__trab text-center text-bold destaque">Nome da Mãe</td>
                </tr>
                
                <tr>
                    <td class="small__font nome__trab text-center">{{$trabalhadors->tsmae}}</td>
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