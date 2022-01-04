<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Comprovante de Pagamento por dia</title>
</head>

<style>
    *{
        margin: 5px;
        padding: 0px;
    }
    
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
        width:200px;
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
        width:351.5px;
    }

    .referencia{
        width: 120px;
    }

    .vencimentos{
        width: 120px;
    }

    .descontos{
        width: 100px;
    }

    .tipoTrab{
        width: 533px;
    }

    .total__vencimentos{
        width: 119px;
    }

    .total__descontos{
        width: 100px;
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
        margin-top:50px;
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
        width: 763.5px;
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
</style>

<body>
   @foreach($trabalhadores as $t => $trabalhado)
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$trabalhado->esnome}}</td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="border-left title-recibo text-bold border-bottom border-top titlename">RECIBO DE PAGAMENTO DE SALÁRIO</td>
            <td class=" small__font text-bold text-center border-top border-bottom comp">Competência:</td>
            <td class="border-top border-right small__font text-bold cnpj text-center border-bottom cnpj">CNPJ:{{$trabalhado->escnpj}}</td>
        </tr>

    </table>
    
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">{{$trabalhado->tsnome}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font matric border-left text-center border-bottom border-top"><strong>Matrícula:</strong>{{$trabalhado->tsmatricula}}</td>
            <td class="small__font cpf border-left text-center border-bottom border-top"><strong>CPF:</strong>{{$trabalhado->tscpf}}</td>
            <td class="small__font pis border-left text-center border-bottom border-top"><strong>PIS:</strong>{{$trabalhado->dspis}}</td>
            <td class="small__font cbo border-left border-right text-center border-bottom border-top"><strong>CBO:</strong>{{$trabalhado->cbo}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left cod text-center text-bold border-bottom border-top destaque">Cod.</td>
            <td class="small__font border-left text-center descricao text-bold border-bottom border-top destaque">Descrição</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom border-top destaque">Referência %</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom border-top destaque">Vencimentos</td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom border-top destaque">Descontos</td>
        </tr>
                @foreach($boletim_tabela['diariaNormais']['id'] as $i => $boletim_tabela_diariaNormais_id)
                    @if($boletim_tabela_diariaNormais_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">1000</td>
                            <td class="small__font border-left descricao border-bottom">Diaria normais</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['diariaNormais']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['diariaNormais']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['horasNormais']['id'] as $i => $boletim_tabela_horasNormais_id)
                    @if($boletim_tabela_horasNormais_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">1002</td>
                            <td class="small__font border-left descricao border-bottom">Horas normais</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['horasNormais']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['horasNormais']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['hora extra 50%']['id'] as $i => $boletim_tabela_ex50_id)
                    @if($boletim_tabela_ex50_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">1003</td>
                            <td class="small__font border-left descricao border-bottom">hora extra 50%</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['hora extra 50%']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['hora extra 50%']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['hora extra 100%']['id'] as $i => $boletim_tabela_ex100_id)
                    @if($boletim_tabela_ex100_id === $trabalhado->id && $boletim_tabela['hora extra 100%']['valor'][$i] > 0)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">1004</td>
                            <td class="small__font border-left descricao border-bottom">Hora extra 100%</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['hora extra 100%']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['hora extra 100%']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['adicional noturno']['id'] as $i => $boletim_tabela_noturno_id)
                    @if($boletim_tabela_noturno_id === $trabalhado->id && $boletim_tabela['adicional noturno']['valor'][$i] > 0)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">1005</td>
                            <td class="small__font border-left descricao border-bottom">Adicional noturno</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['adicional noturno']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['adicional noturno']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['gratificação']['id'] as $i => $boletim_tabela_gradificacao_id)
                    @if($boletim_tabela_gradificacao_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">1005</td>
                            <td class="small__font border-left descricao border-bottom">Gratifição</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['gratificação']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['gratificação']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['dsr1818']['id'] as $i => $boletim_tabela_dsr1818_id)
                    @if($boletim_tabela_dsr1818_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">9999</td>
                            <td class="small__font border-left descricao border-bottom">DSR 18,18%</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">18,18</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['dsr1818']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['inss']['id'] as $i => $boletim_tabela_inss_id)
                    @if($boletim_tabela_inss_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">9999</td>
                            <td class="small__font border-left descricao border-bottom">INSS</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['inss']['indece'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$boletim_tabela['inss']['resultadoinss'][$i], 2, ',', '')}}</td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['irrf']['id'] as $i => $boletim_tabela_irrf_id)
                    @if($boletim_tabela_irrf_id === $trabalhado->id && $boletim_tabela['irrf']['resultadoinss'][$i])
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">9999</td>
                            <td class="small__font border-left descricao border-bottom">IRRF</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$boletim_tabela['irrf']['indece'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$boletim_tabela['irrf']['resultadoinss'][$i], 2, ',', '')}}</td>
                        </tr>
                    @endif
                @endforeach
                @if($sindicator)
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">9999</td>
                    <td class="small__font border-left descricao border-bottom">Sindicator</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom"></td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$sindicator, 2, ',', '')}}</td>
                </tr>
                @endif
                @foreach($boletim_tabela['ferias_decimoter']['id'] as $i => $boletim_tabela_ferias_decimoter_id)
                    @if($boletim_tabela_ferias_decimoter_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">9999</td>
                            <td class="small__font border-left descricao border-bottom">Ferias + 1/3</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">11,12</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['ferias_decimoter']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['decimo_ter']['id'] as $i => $boletim_tabela_decimo_ter_id)
                    @if($boletim_tabela_decimo_ter_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">9999</td>
                            <td class="small__font border-left descricao border-bottom">13º Salário</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">8,34</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$boletim_tabela['decimo_ter']['valor'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['inss_sobre_ter']['id'] as $i => $boletim_tabela_inss_sobre_ter_id)
                    @if($boletim_tabela_inss_sobre_ter_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom">9999</td>
                            <td class="small__font border-left descricao border-bottom">INSS Sobre 13º Salário</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">7,5</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$boletim_tabela['inss_sobre_ter']['resultadoinss'][$i], 2, ',', '')}}</td>
                        </tr>
                    @endif
                @endforeach
                @foreach($dadosTrabalhador['id'] as $i => $boletim_tabela_vt_id)
                    @if($boletim_tabela_vt_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom"></td>
                            <td class="small__font border-left descricao border-bottom">Vale transporte</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$dadosTrabalhador['tomador_cartao_ponto_quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$dadosTrabalhador['tomador_cartao_ponto_vt'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($dadosTrabalhador['id'] as $i => $boletim_tabela_vt_id)
                    @if($boletim_tabela_vt_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom"></td>
                            <td class="small__font border-left descricao border-bottom">Vale alimentação</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float)$dadosTrabalhador['tomador_cartao_ponto_quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom">{{number_format((float)$dadosTrabalhador['tomador_cartao_ponto_va'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
                        </tr>
                    @endif
                @endforeach
                @foreach($boletim_tabela['adiantamento']['id'] as $i => $boletim_tabela_adiantamento_id)
                    @if($boletim_tabela_adiantamento_id === $trabalhado->id)
                        <tr>
                            <td class="small__font border-left cod text-center border-bottom"></td>
                            <td class="small__font border-left descricao border-bottom">Adiantamento</td>
                            <td class="small__font border-left text-center referencia text-bold border-bottom">{{number_format((float) $boletim_tabela['adiantamento']['quantidade'][$i], 2, ',', '')}}</td>
                            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
                            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">{{number_format((float)$boletim_tabela['adiantamento']['valor'][$i], 2, ',', '')}}</td>
                        </tr>
                    @endif
                @endforeach

    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top tipoTrab">Trabalhador Intermitente Conforme a Lei 13.467/2017</td>
            <td class="small__font border-left text-bold border-top total__vencimentos text-center destaque border-bottom border-right">Total Vencimento</td>
            <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total Desconto</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab">Dispõe sobre atividades de trabalhadores categoria 04 Intermitentes</td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaque border-bottom border-right">{{number_format((float)$boletim_tabela['vencimento']['valor'][$t], 2, ',', '')}}</td>
            <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">{{number_format((float)$boletim_tabela['novodesconto']['valor'][$t], 2, ',', '')}}</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaqueDark border-top border-bottom">Valor Líquido</td>
            <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom">{{number_format((float)$boletim_tabela['vencimento']['valor'][$t] - $boletim_tabela['novodesconto']['valor'][$t], 2, ',', '')}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top servicosbase text-center  destaque">Serviços</td>
            <td class="small__font border-left border-top servrsr text-center destaque">Serviços+DSR</td>
            <td class="small__font border-left border-top bainss text-center destaque">Base INSS</td>
            <td class="small__font border-left border-top bafgts text-center destaque">Base FGTS</td>
            <td class="small__font border-left border-top fgtsmes text-center destaque">FGTS Mês</td>
            <td class="small__font border-left border-top bairrf text-center destaque">Base IRRF</td>
            <td class="small__font border-left border-top fairrf text-center destaque">Faixa IRRF</td>
            <td class="small__font border-left border-right border-top num__filho text-center destaque">Num.Filho</td>
        </tr>

        <tr>
            <td class="little__font border-left border-top border-bottom servicosbase text-center">{{number_format((float)$boletim_tabela['salario']['valor'][$t], 2, ',', '')}}</td>
            <td class="little__font border-left border-top border-bottom servrsr text-center">{{number_format((float)$boletim_tabela['serviso_dsr']['valor'][$t], 2, ',', '')}}</td>
            <td class="little__font border-left border-top border-bottom bainss text-center">{{number_format((float)$boletim_tabela['base_inss']['valor'][$t], 2, ',', '')}}</td>
            <td class="little__font border-left border-top border-bottom bafgts text-center">{{number_format((float)$boletim_tabela['base_fgts']['valor'][$t], 2, ',', '')}}</td>
            <td class="little__font border-left border-top border-bottom fgtsmes text-center">{{number_format((float)$boletim_tabela['fgts_mes']['valor'][$t], 2, ',', '')}}</td>
            <td class="little__font border-left border-top border-bottom bairrf text-center">{{number_format((float)$boletim_tabela['base_irrf']['valor'][$t], 2, ',', '')}}</td>
            
            <td class="little__font border-left border-top border-bottom fairrf text-center">{{number_format((float)$boletim_tabela['irrf']['indece'][$t], 2, ',', '')}}</td>
            <td class="little__font border-left border-right border-bottom border-top num__filho text-center">{{$depedentes[$t]->depedentes}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">Relação da Produção por Dia</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="text-center border-left border-top border-bottom dia small__font destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font valor destaque">Valor</td>
            <td  class="text-center border-left border-top border-bottom small__font dia destaque">Dia</td>
            <td  class="text-center border-left border-top border-bottom small__font border-right valor destaque">Valor</td>
        </tr>

        
      
            
        <tr>
            <td class="text-center border-left dia small__font border-bottom">1</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '01' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '01' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">9</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '09' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '09' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">17</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '17' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '17' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">25</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '25' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '25' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>
      
        <tr>
            <td class="text-center border-left dia small__font border-bottom">2</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '02' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '02' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">10</td>
            <td  class="text-center border-left small__font border-bottom valor">
                <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '10' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '10' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">18</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '18' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '18' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">26</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '26' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '26' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>


        <tr>
            <td class="text-center border-left dia small__font border-bottom">3</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '03' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '03' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">11</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '11' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '11' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">19</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '19' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '19' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">27</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '27' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '27' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">4</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '04' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '04' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">12</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '12' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '12' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">20</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '20' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '20' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">28</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '28' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '28' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">5</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '05' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '05' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">13</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '13' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '13' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">21</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '21' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '21' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">29</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '29' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '29' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">6</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '06' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '06' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">14</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '14' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '14' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">22</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '22' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '22' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">30</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '30' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '30' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">7</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '07' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '07' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">15</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '15' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '15' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">23</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '23' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '23' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">31</td>
            <td  class="text-center border-left small__font border-bottom border-right valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '31' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '31' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="text-center border-left dia small__font border-bottom">8</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '08' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '08' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">16</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '16' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '16' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left small__font border-bottom dia">24</td>
            <td  class="text-center border-left small__font border-bottom valor">
            <?php
                  $vencimento = 0;
                  $valorboletim = 0;
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '24' && $trabalhado->id == $cartaoponto_diarias['campos']['id'][$key]) {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '24' && $trabalhado->id == $boletim_tabela['campos']['id'][$key]) {
                         $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
            ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left border-top  small__font border-bottom destaqueDark dia text-bold">Total</td>
            <td  class="text-center small__font border-top border-bottom border-right destaqueDark valor text-bold"></td>
        </tr>  
       
    </table>






    <table>
        <tr>
            <td class="declaracao fontDeclaracao border-top border-left border-right">Declaro ter recebido a importância líquida neste recibo do periodo 
            <strong></strong> 
            <strong><strong> 
            </td>
        </tr>

        <tr>
            <td class="declaracao fontDeclaracao  border-left border-right">Deposito: Banco: <strong>{{$trabalhado->bsbanco}}</strong> Agência: <strong>{{$trabalhado->bsagencia}}</strong> Operação:<strong>{{$trabalhado->bsoperacao}}</strong> Conta: <strong>{{$trabalhado->bsconta}}</strong></td>
        </tr>
    </table> 

    <table>
        <tr class="assinatura">
            <td class="fontDeclaracao data border-left">Data:{{date("d/m/y")}}</td>
            <td class="fontDeclaracao border-right linhaass text-center">__________________________________________________</td>
        </tr>

        <tr class="assinatura">
            <td class="fontDeclaracao border-left border-bottom"></td>
            <td class="fontDeclaracao text-center border-right border-bottom">Assinatura Trabalhador</td>
        </tr>
    </table>
    
    <h1 style="page-break-after: always;">{{$t+1}}</h1>
    @endforeach
</body>
</html>