$("#form").validate({
    debug: false,
    rules:{
        nome__completo:{
            required: true,
            maxlength: 20,
        },
        nome__fantasia:{
            required: true,
            maxlength: 20,
        },
        cnpj:{
            required: true,
        },
        matricula:{
            required: true,
        },
        telefone:{
            required: true,
        },
        simples:{
            required:true,
            range: [1, 9]
        },
        cep:{
            required:true,
        },
        logradouro:{
            required:true,
        },
        numero:{
            required:true,
        },
        bairro:{
            required:true,
        },
        localidade:{
            required:true,
        },
        uf:{
            required:true
        },
        tipo:{
            required:true
        },
        taxa_adm:{
            required:true
        },
        caixa_benef:{
            required:true
        },
        ferias:{
            required:true
        },
        taxa__fed:{
            required:true
        },
        deflator:{
            required:true
        },
        ferias_trab:{
            required:true
        },
        rsr:{
            required:true
        },
        das:{
            required:true
        },
        cod__fpas:{
            required:true
        },
        cod__grps:{
            required:true
        },
        cod__recol:{
            required:true
        },
        cnae:{
            required:true
        },
        fap__aliquota:{
            required:true
        },
        rat__ajustado:{
            required:true
        },
        fpas__terceiros:{
            required:true
        },
        aliq__terceiros:{
            required:true
        },
        esocial:{
            required:true
        },
        inss__empresa:{
            required:true
        },
        fgts__empresa:{
            required:true
        },
        valor_fatura:{
            required:true
        },
        dias_uteis:{
            required:true,
            range: [1, 31]
        },
        sabados:{
            required:true,
            range: [1, 31]
        },
        domingos:{
            required:true,
            range: [1, 31]
        },
        ano:{
            required:true,
        },
        rubricas:{
            required:true
        },
        descricao:{
            required:true
        },
        valor:{
            required:true
        },
        nome_tomador:{
            required:true
        },
        nome__trabalhador:{
            required:true
        },
        matricula__trab:{
            required:true
        },
        indice:{
            required:true
        },
        alimentacao:{
            required:true
        },
        transporte:{
            required:true
        },
        epi:{
            required:true
        },
        seguro__trabalhador:{
            required:true
        },
        indice__folha:{
            required:true
        },
        valor__transporte:{
            required:true
        },
        valor__alimentacao:{
            required:true
        },
        folhartransporte:{
            required:true
        },
        folhartipotrans:{
            required:true
        },
        folharalim:{
            required:true
        },
        folhartipoalim:{
            required:true
        },
        nome__conta:{
            required:true
        },
        banco:{
            required:true
        },
        agencia:{
            required:true
        },
        operacao:{
            required:true
        },
        conta:{
            required:true
        }
    },
    messages:{
        nome__completo: {
            required: "O campo nome não pode esta vazio!",
            maxlength: "  O campo nome não pode tem mais de 20 caracteres!",
        },
        nome__fantasia: {
            required: "O campo nome fantasia não pode esta vazio!",
            maxlength: "  O campo nome fantasia não pode tem mais de 20 caracteres!",
        },
        cnpj:{
            required: 'O campo CNPJ não pode esta vazio!',
        },
        matricula:{
            required: 'O campo MATRICULAR não pode esta vazio!',
        },
        simples:{
            required: 'O campo SIMPLES não pode esta vazio!',
            range: 'O campo SIMPLES não pode ter um valor maior que 9!',
        },
        telefone:{
            required: 'O campo TELEFONE não pode esta vazio!',
        },
        cep:{
            required:'O campo CEP não pode esta vazio!',
        },
        logradouro:{
            required:'O campo RUA não pode esta vazio!',
        },
        numero:{
            required:'O campo NUMERO não pode esta vazio!',
        },
        tipo:{
            required:'O campo não pode esta vazio!',
        },
        bairro:{
            required:'O campo BAIRRO não pode esta vazio!',
        },
        localidade:{
            required:'O campo MUNICIPIO não pode esta vazio!',
        },
        uf:{
            required:'O campo UF não pode esta vazio!'
        },
        taxa_adm:{
            required:'O campo Taxa Adm % não pode esta vazio!'
        },
        caixa_benef:{
            required:'O campo Caixa benef. % não pode esta vazio!'
        },
        ferias:{
            required:'O campo Férias 1,00 % não pode esta vazio!'
        },
        taxa__fed:{
            required:'O campo Taxa Fed. % não pode esta vazio!'
        }, 
        deflator:{
            required:'O campo Taxa % DEFLATOR não pode esta vazio!'
        },
        ferias_trab:{
            required:'O campo Taxa Férias % não pode esta vazio!'
        },
        rsr:{
            required:'O campo Taxa RSR % não pode esta vazio!'
        },
        das:{
            required:'O campo Taxa DAS % não pode esta vazio!'
        },
        cod__fpas:{
            required:'O campo Cod FPAS não pode esta vazio!'
        },
        cod__grps:{
            required:'O campo Cod GRPS não pode esta vazio!'
        },
        cod__grps:{
            required:'O campo Cod Recol não pode esta vazio!'
        },
        cnae:{
            required:'O campo CNAE não pode esta vazio!'
        },
        fap__aliquota:{
            required:'O campo FAP Aliquota % não pode esta vazio!'
        },
        rat__ajustado:{
            required:'O campo RAT Ajustado % não pode esta vazio!'
        },
        fpas__terceiros:{
            required:'O campo FPAS Terceiros não pode esta vazio!'
        },
        aliq__terceiros:{
            required:'O campo Aliq. Terceiros não pode esta vazio!'
        },
        esocial:{
            required:'O campo E-SOCIAL Nº não pode esta vazio!'
        },
        dias_uteis:{
            required:'O campo Dias Úteis não pode esta vazio!',
            range: 'O campo não aceita valor maiores que 31!'
        },
        sabados:{
            required:'O campo não pode esta vazio!',
            range: 'O campo não aceita valor maiores que 31!'
        },
        domingos:{
            required:'O campo não pode esta vazio!',
            range: 'O campo não aceita valor maiores que 31!'
        },
        inss__empresa:{
            required:'O campo não pode esta vazio!',
        },
        fgts__empresa:{
            required:'O campo não pode esta vazio!',
        },
        valor_fatura:{
            required:'O campo não pode esta vazio!',
        },
        ano:{
            required:'O campo não pode esta vazio!',
        },
        descricao:{
            required:'O campo não pode esta vazio!',
        },
        valor:{
            required:'O campo não pode esta vazio!',
        },
        rubricas:{
            required:'O campo não pode esta vazio!',
        },
        nome_tomador:{
            required:'O campo não pode esta vazio!',
        },
        nome__trabalhador:{
            required:'O campo não pode esta vazio!',
        },
        matricula__trab:{
            required:'O campo não pode esta vazio!',
        },
        indice:{
            required:'O campo não pode esta vazio!',
        },
        alimentacao:{
            required:'O campo não pode esta vazio!',
        },
        transporte:{
            required:'O campo não pode esta vazio!',
        },
        epi:{
            required:'O campo não pode esta vazio!',
        },
        seguro__trabalhador:{
            required:'O campo não pode esta vazio!',
        },
        indice__folha:{
            required:'O campo não pode esta vazio!',
        },
        valor__transporte:{
            required:'O campo não pode esta vazio!',
        },
        valor__alimentacao:{
            required:'O campo não pode esta vazio!',
        },
        folhartransporte:{
            required:'O campo não pode esta vazio!',
        },
        folhartipotrans:{
            required:'O campo não pode esta vazio!',
        },
        folharalim:{
            required:'O campo não pode esta vazio!',
        },
        folhartipoalim:{
            required:'O campo não pode esta vazio!',
        },
        nome__conta:{
            required:'O campo não pode esta vazio!',
        },
        banco:{
            required:'O campo não pode esta vazio!',
        },
        agencia:{
            required:'O campo não pode esta vazio!',
        },
        operacao:{
            required:'O campo não pode esta vazio!',
        },
        conta:{
            required:'O campo não pode esta vazio!',
        }
    }
});