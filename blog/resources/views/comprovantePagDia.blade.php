<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RHWEB - Comprovante de Pagamento por dia1212</title>
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
   
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title text-center text-bold destaqueDark">{{$empresas->esnome}}</td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td class="border-left title-recibo text-bold border-bottom border-top titlename">RECIBO DE PAGAMENTO DE SALÁRIO</td>
            <td class=" small__font text-bold text-center border-top border-bottom comp">Competência: 
                <?php
                    $data = explode('-',$dados['ano_final'])
                ?>
                {{$data[1]}}/{{$data[0]}}
            </td>
            <td class="border-top border-right small__font text-bold cnpj text-center border-bottom cnpj">CNPJ: {{$empresas->escnpj}}</td>
        </tr>

    </table>
    
    <table>
        <tr>
            <td class="border-left border-right border-top border-bottom uppercase name__title font__trab text-center text-bold destaque">{{$trabalhadors->tsnome}}</td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="small__font matric border-left text-center border-bottom border-top"><strong>Matrícula:</strong> {{$trabalhadors->tsmatricula}}</td>
            <td class="small__font cpf border-left text-center border-bottom border-top"><strong>CPF:</strong> {{$trabalhadors->tscpf}}</td>
            <td class="small__font pis border-left text-center border-bottom border-top"><strong>PIS:</strong> {{$trabalhadors->dspis}}</td>
            <td class="small__font cbo border-left border-right text-center border-bottom border-top"><strong>CBO:</strong> {{$trabalhadors->cbo}}</td>
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
        @foreach($boletim_tabela as $key => $boletimtabela)
            @if($key === 'diariaNormais' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1000</td>
                    <td class="small__font border-left descricao border-bottom">Diaria normais</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @elseif($key === 'horasNormais' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1002</td>
                    <td class="small__font border-left descricao border-bottom">Horas normais</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @elseif($key === 'hora extra 50%' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1003</td>
                    <td class="small__font border-left descricao border-bottom">hora extra 50%</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @elseif($key === 'hora extra 100%' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1004</td>
                    <td class="small__font border-left descricao border-bottom">Hora extra 100%</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @elseif($key === 'adicional noturno' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1005</td>
                    <td class="small__font border-left descricao border-bottom">Adicional noturno</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @elseif($key === 'adicional noturno' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1005</td>
                    <td class="small__font border-left descricao border-bottom">Adicional noturno</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @elseif($key === 'gratificação' && $boletimtabela['quantidade'])
                <tr>
                    <td class="small__font border-left cod text-center border-bottom">1005</td>
                    <td class="small__font border-left descricao border-bottom">Gratifição</td>
                    <td class="small__font border-left text-center referencia text-bold border-bottom">
                        {{number_format((float)$boletimtabela['quantidade'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                        {{number_format((float)$boletimtabela['valor'], 2, ',', '')}}
                    </td>
                    <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                    
                    </td>
                </tr>
            @endif
            
        @endforeach
        <tr>
            <td class="small__font border-left cod text-center border-bottom">1002</td>
            <td class="small__font border-left descricao border-bottom">DSR 18,18%</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">18,18</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                {{number_format((float)$dsr1818, 2, ',', '')}}
            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
           
            </td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">1003</td>
            <td class="small__font border-left descricao border-bottom">INSS</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">
               {{$indece}}
            </td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                {{number_format((float)$resultadoinss, 2, ',', '')}}
            </td>
        </tr>
        @if($dados_irrf['resultado'])
        <tr>
            <td class="small__font border-left cod text-center border-bottom">9999</td>
            <td class="small__font border-left descricao border-bottom">IRRF</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">
                {{$dados_irrf['indece']}}
            </td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">

            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                {{number_format((float)$dados_irrf['resultado'], 2, ',', '')}}
            </td>
        </tr>
        @endif
        @if($sindicator)
        <tr>
            <td class="small__font border-left cod text-center border-bottom">1011</td>
            <td class="small__font border-left descricao border-bottom">Sindicator</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">
               
            </td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">

            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
                {{number_format((float)$sindicator, 2, ',', '')}}
            </td>
        </tr>
        @endif
        <tr>
            <td class="small__font border-left cod text-center border-bottom">1004</td>
            <td class="small__font border-left descricao border-bottom">Ferias + 1/3</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">11,12</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                {{number_format((float)$ferias_decimoter, 2, ',', '')}} 
                
            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"></td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">1005</td>
            <td class="small__font border-left descricao border-bottom">13º Salário</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">8,34</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">
                {{number_format((float)$decimo_ter, 2, ',', '')}}
            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
            
            </td>
        </tr>

        <tr>
            <td class="small__font border-left cod text-center border-bottom">1006</td>
            <td class="small__font border-left descricao border-bottom">INSS Sobre 13º Salário</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">7,5</td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom">
            
                {{number_format((float)$inss_sobre_ter, 2, ',', '')}}
            </td>
        </tr>
        @if($tomador_cartao_ponto_vt)
        <tr>
            <td class="small__font border-left cod text-center border-bottom">1007</td>
            <td class="small__font border-left descricao border-bottom">Vale transporte</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">
                {{number_format((float) ceil($tomador_cartao_ponto_quantidade), 2, ',', '')}}
            </td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">
            {{number_format((float)$tomador_cartao_ponto_vt, 2, ',', '')}}
            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"> 
                
            </td>
        </tr>
        @endif
        @if($tomador_cartao_ponto_va)
        <tr>
            <td class="small__font border-left cod text-center border-bottom">1008</td>
            <td class="small__font border-left descricao border-bottom">Vale alimentação</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">
                {{number_format((float) ceil($tomador_cartao_ponto_quantidade), 2, ',', '')}}
            </td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom">
            {{number_format((float)$tomador_cartao_ponto_va, 2, ',', '')}}
            </td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"> 
                
            </td>
        </tr>
        @endif
        @if($boletim_tabela['adiantamento']['valor'])
        <tr>
            <td class="small__font border-left cod text-center border-bottom">1010</td>
            <td class="small__font border-left descricao border-bottom">Adiantamento</td>
            <td class="small__font border-left text-center referencia text-bold border-bottom">
                {{number_format((float) $boletim_tabela['adiantamento']['quantidade'], 2, ',', '')}}
            </td>
            <td class="small__font border-left text-center vencimentos text-bold border-bottom"></td>
            <td class="small__font border-left border-right text-center descontos text-bold border-bottom"> {{number_format((float)$boletim_tabela['adiantamento']['valor'], 2, ',', '')}}
                
            </td>
        </tr>
        @endif
    </table>

    <table>
        <tr>
            <td class="small__font border-left border-top tipoTrab">Trabalhador Intermitente Conforme a Lei 13.467/2017</td>
            <td class="small__font border-left text-bold border-top total__vencimentos text-center destaque border-bottom border-right">Total Vencimento</td>
            <td class="small__font border-left text-bold border-right border-top total__descontos text-center destaque border-bottom">Total Desconto</td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab">Dispõe sobre atividades de trabalhadores categoria 04 Intermitentes</td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaque border-bottom border-right">
                {{number_format((float) $total_vencimento + $salario, 2, ',', '')}}
            </td>
            <td class="small__font border-left text-bold border-right total__descontos text-center destaque border-bottom">
            {{number_format((float) $total_desconto, 2, ',', '')}}
            </td>
        </tr>

        <tr>
            <td class="small__font border-left tipoTrab border-bottom"></td>
            <td class="small__font border-left text-bold total__vencimentos text-center destaqueDark border-top border-bottom">Valor Líquido</td>
            <td class="small__font text-bold border-right total__descontos text-center destaqueDark border-top border-bottom">
            {{number_format((float) ($total_vencimento + $salario)-$total_desconto, 2, ',', '')}}
            </td>
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
            <td class="little__font border-left border-top border-bottom servicosbase text-center">
                {{number_format((float)$salario, 2, ',', '')}}
            </td>
            <td class="little__font border-left border-top border-bottom servrsr text-center">
                {{number_format((float)$serviso_dsr, 2, ',', '')}}
            </td>
            <td class="little__font border-left border-top border-bottom bainss text-center">
                {{number_format((float)$base_inss, 2, ',', '')}}
            </td>
            <td class="little__font border-left border-top border-bottom bafgts text-center">
            {{number_format((float)$base_fgts, 2, ',', '')}}
            </td>
            <td class="little__font border-left border-top border-bottom fgtsmes text-center">
            
            {{number_format((float)$fgts_mes, 2, ',', '')}}
            </td>
            <td class="little__font border-left border-top border-bottom bairrf text-center">
            {{number_format((float)$base_irrf, 2, ',', '')}}
            </td>
            <td class="little__font border-left border-top border-bottom fairrf text-center"> {{$dados_irrf['indece']}}</td>
            <td class="little__font border-left border-right border-bottom border-top num__filho text-center">{{count($depedentes)}}
            
            </td>
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
                      if ($cartaopontodiarias === '01') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '01') {
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
                      if ($cartaopontodiarias === '09') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '09') {
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
                      if ($cartaopontodiarias === '17') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '17') {
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
                      if ($cartaopontodiarias === '25') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '25') {
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
                      if ($cartaopontodiarias === '02') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '02') {
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
                      if ($cartaopontodiarias === '10') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '10') {
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
                      if ($cartaopontodiarias === '18') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '18') {
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
                      if ($cartaopontodiarias === '26') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '26') {
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
                      if ($cartaopontodiarias === '03') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '03') {
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
                      if ($cartaopontodiarias === '11') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '11') {
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
                      if ($cartaopontodiarias === '19') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '19') {
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
                      if ($cartaopontodiarias === '27') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '27') {
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
                      if ($cartaopontodiarias === '04') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '04') {
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
                      if ($cartaopontodiarias === '12') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '12') {
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
                      if ($cartaopontodiarias === '20') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '20') {
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
                      if ($cartaopontodiarias === '28') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '28') {
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
                      if ($cartaopontodiarias === '05') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '05') {
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
                      if ($cartaopontodiarias === '13') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '13') {
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
                      if ($cartaopontodiarias === '21') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '21') {
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
                      if ($cartaopontodiarias === '29') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '29') {
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
                      if ($cartaopontodiarias === '06') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '06') {
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
                      if ($cartaopontodiarias === '14') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '14') {
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
                      if ($cartaopontodiarias === '22') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '22') {
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
                      if ($cartaopontodiarias === '30') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '30') {
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
                      if ($cartaopontodiarias === '07') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '07') {
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
                  foreach ($cartaoponto_diarias['campos']['dia'] as $key => $cartaopontodiarias) {
                      if ($cartaopontodiarias === '15') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                    if ($boletimtabelas === '15') {
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
                      if ($cartaopontodiarias === '23') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '23') {
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
                      if ($cartaopontodiarias === '31') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '31') {
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
                      if ($cartaopontodiarias === '08') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '08') {
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
                      if ($cartaopontodiarias === '16') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '16') {
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
                      if ($cartaopontodiarias === '24') {
                          $vencimento += $cartaoponto_diarias['campos']['valor'][$key];
                      }
                  }
                  foreach ($boletim_tabela['campos']['dia'] as $key => $boletimtabelas) {
                      if ($boletimtabelas === '24') {
                          $valorboletim += $boletim_tabela['campos']['valor'][$key];
                      }
                  }
              ?>
               {{number_format((float)$vencimento +  $valorboletim, 2, ',', '')}}
            </td>
            <td  class="text-center border-left border-top  small__font border-bottom destaqueDark dia text-bold">Total</td>
            <td  class="text-center small__font border-top border-bottom border-right destaqueDark valor text-bold">
             {{number_format((float)$salario, 2, ',', '')}}
            </td>
        </tr>  
       
    </table>






    <table>
        <tr>
            <td class="declaracao fontDeclaracao border-top border-left border-right">Declaro ter recebido a importância líquida neste recibo do periodo 
            <strong>
                <?php
                    $data_inicial = explode('-',$dados['ano_inicial']);
                    echo($data_inicial[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                ?>
            </strong>  a 
            <strong>
                <?php
                    $data_final = explode('-',$dados['ano_final']);
                    echo($data_final[2].'/'.$data_inicial[1].'/'.$data_inicial[0]);
                ?>
            <strong> 
            </td>
        </tr>

        <tr>
            <td class="declaracao fontDeclaracao  border-left border-right">Deposito: Banco: <strong>{{$trabalhadors->bsbanco}}</strong> Agência: <strong>{{$trabalhadors->bsagencia}}</strong> Operação:<strong>{{$trabalhadors->bsoperacao}}</strong> Conta: <strong>{{$trabalhadors->bsconta}}</strong></td>
        </tr>
    </table>

    <table>
        <tr class="assinatura">
            <td class="fontDeclaracao data border-left">Data: {{date("d/m/y")}}</td>
            <td class="fontDeclaracao border-right linhaass text-center">__________________________________________________</td>
        </tr>

        <tr class="assinatura">
            <td class="fontDeclaracao border-left border-bottom"></td>
            <td class="fontDeclaracao text-center border-right border-bottom">Assinatura Trabalhador</td>
        </tr>
    </table>
</body>
</html>