
// Atalho de limpa os campos de input  SHIFT + D //
function limpaCampos(){


$(document).on('keydown', function(e) {
    // console.log(e.which); // Retorna o número código da tecla
    // console.log(e.shiftKey);
    

	if(e.shiftKey === true && e.which === 68 && e.altKey === true){
	    
	    // cartao ponto //
	    $('#nome__completo').val(""); 
	    $('#matricula').val("");
	    $('#entrada1').val("");
	    $('#saida').val("");
	    $('#entrada2').val("");
	    $('#saida2').val("");
	    $('#entrada3').val("");
	    $('#saida3').val("");
	    $('#entrada4').val("");
	    $('#saida4').val("");
	    $('#matricula').val("");
	    // fim do cartao ponto//
	    
	    
	    //tomador//
	    $("#cnpj").val("");
        $("#nome__completo").val("");
        $("#nome__fantasia").val("");
        $("#telefone").val("");
        $("#cep").val("");
        $("#logradouro").val("");
        $("#numero").val("");
        $("#complemento__endereco").val("");
        $("#bairro").val("");
        $("#localidade").val("");
        $("#uf").val("");
        $("#taxa_adm").val("");
        $("#taxa__fed").val("");
        $("#deflator").val("");
        $("#das").val("");
        $("#cod__fpas").val("");
        $("#cod__fap").val("");
        $("#cod__grps").val("");
        $("#cod__recol").val("");
        $("#cnae").val("");
        $("#fap__aliquota").val("");
        $("#rat__ajustado").val("");
        $("#fpas__terceiros").val("");
        $("#aliq__terceiros").val("");
        $("#alimentacao").val("");
        $("#transporte").val("");
        $("#epi").val("");
        $("#seguro__trabalhador").val("");
        $("#folhartransporte").val("");
        $("#folhartipotrans").val("");
        $("#folharalim").val("");
        $("#folhartipoalim").val("");
        $("#dias_uteis").val("");
        $("#sabados").val("");
        $("#domingos").val("");
        $("#inss__empresa").val("");
        $("#retencaoinss").val("");
        $("#fgts__empresa").val("");
        $("#retencaofgts").val("");
        $("#valor_fatura").val("");
        $("#banco").val("");
        $("#agencia").val("");
        $("#operacao").val("");
        $("#conta").val("");
        $("#pix").val("");
        
        // fim do tomador//
        
        
        //fatura//
        $("#pesquisa").val("");
        $("#ano_inicial").val("");
        $("#ano_final").val("");
        $("#text__adiantamento").val("");
        $("#valor__adiantamento").val("");
        $("#texto__credito").val("");
        $("#valor__creditos").val("");
        $("#vencimento").val("");
        $("#competencia").val("");
        //fim da fatura//
        
        
        // recibo avulso//
        $("#nome").val("");
        $("#cpf").val("");
        $("#ano_inicial").val("");
        $("#anoFinal").val("");
        $("#ano_inicial1").val("");
        $("#ano_final1").val("");
        
        //  fim do recibo avulso//
        
        // descontos//
        $("#competencia").val("");
        $("#matricula").val("");
        $("#nome__trab").val("");
        $("#descricao").val("");
        // fim dos descontos//
        
        //comissionado//
        $("#nome__trabalhador").val("");
        $("#matricula__trab").val("");
        $("#indice").val("");
        $("#nome_tomador").val("");
        $("#pix").val("");
        // fim do comissionado//
        
        
        //trabalhador//
        $("#cep").val("");
        $("#logradouro").val("");
        $("#numero").val("");
        $("#complemento__endereco").val("");
        $("#bairro").val("");
        $("#localidade").val("");
        $("#uf").val("");
        $("#nome__completo").val("");
        $("#nome__social").val("");
        $("#cpf").val("");
        $("#pis").val("");
        $("#data_nascimento").val("");
        $("#pais__nascimento").val("");
        $("#pais__nacionalidade").val("");
        $("#nome__mae").val("");
        $("#telefone").val("");
        $("#data__admissao").val("");
        $("#categoria").val("");
        $("#cbo").val("");
        $("#ctps").val("");
        $("#serie__ctps").val("");
        $("#uf__ctps").val("");
        $("#data__afastamento").val("");
        $("#banco").val("");
        $("#agencia").val("");
        $("#operacao").val("");
        $("#conta").val("");
        $("#pix").val("");
        //fim do trabalhador//
        
        //cadastro de acesso//
        $("#senha").val("");
        $("#cargo").val("");
        $("#usuario").val("");
        $("#nome__completo").val("");
        $("#email").val("");
        // fim do cadastro de acesso//
        
        
        // boletim com cartao ponto//
         $("#num__trabalhador").val("");
         $("#nome__completo").val("");
         $("#data").val("");
        // fim do boletim cartao ponto//
        
        // depedente//
        $("#data__nascimento").val("");
        $("#cpf__dependente").val("");
        $("#nome__dependente").val("");
        //fim do depedente//
        
        
        //boletim com tabela//
        $("#nome__completo").val("");
        $("#data").val("");
        $("#num__dependente").val("");
        //fim do boletim com tabela//
        
        
        

	}
	
    
});

}

limpaCampos();