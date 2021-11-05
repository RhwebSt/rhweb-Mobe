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
        }
    }
});