$("#telefone").mask("(00) 00000-0000");
$("#cnpj").mask("00.000.000/0000-00");
$('#cep').mask("00000-000")
$('#taxa_adm,#caixa_benef,#ferias,#13_salario,#taxa__fed').mask('000,00', {reverse: true});
$('#ferias_trab,#13__saltrab,#rsr,#das,#fap__aliquota,#rat__ajustado,#epi,#fgts__empresa,#deflator').mask('000,00', {reverse: true});
$('#matricula').mask('0000').val(Math.floor(Math.floor(Math.random() * 9999)))
$('#agencia').mask('0000')
$('#operacao').mask('000')
$('#conta').mask('00000000-0')
$('#valor_fatura').mask('000.000.000.000.000,00', {reverse: true});

