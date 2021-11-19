// function isCnpj(cnpj) {
//     var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
//     if (cnpj.length === 0) {
//         return false;
//     }
//     cnpj = cnpj.replace(/\D+/g, '');
//     digitos_iguais = 1;
//     for (i = 0; i < cnpj.length - 1; i++)
//         if (cnpj.charAt(i) !== cnpj.charAt(i + 1)) {
//             digitos_iguais = 0;
//             break;
//         }
//     if (digitos_iguais)
//         return false;
//     tamanho = cnpj.length - 2;
//     numeros = cnpj.substring(0, tamanho);
//     digitos = cnpj.substring(tamanho);
//     soma = 0;
//     pos = tamanho - 7;
//     for (i = tamanho; i >= 1; i--) {
//         soma += numeros.charAt(tamanho - i) * pos--;
//         if (pos < 2)
//             pos = 9;
//     }
//     resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
//     if (resultado !== digitos.charAt(0)) {
//         return false;
//     }
//     tamanho = tamanho + 1;
//     numeros = cnpj.substring(0, tamanho);
//     soma = 0;
//     pos = tamanho - 7;
//     for (i = tamanho; i >= 1; i--) {
//         soma += numeros.charAt(tamanho - i) * pos--;
//         if (pos < 2)
//             pos = 9;
//     }
//     resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
//     return (resultado === digitos.charAt(1));
// }
function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}
// function isCnpjFormatted(cnpj) {
//     var validCNPJ = /\d{2,3}.\d{3}.\d{3}\/\d{4}-\d{2}/;
//     return cnpj.match(validCNPJ);
// }
function isCpf(cpf) {
    exp = /\.|-/g;
    cpf = cpf.toString().replace(exp, "");
    var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
    var soma1 = 0,
            soma2 = 0;
    var vlr = 11;
    for (i = 0; i < 9; i++) {
        soma1 += eval(cpf.charAt(i) * (vlr - 1));
        soma2 += eval(cpf.charAt(i) * vlr);
        vlr--;
    }
    soma1 = (((soma1 * 10) % 11) === 10 ? 0 : ((soma1 * 10) % 11));
    soma2 = (((soma2 + (2 * soma1)) * 10) % 11);
    if (cpf === "11111111111" || cpf === "22222222222" || cpf === "33333333333" || cpf === "44444444444" || cpf === "55555555555" || cpf === "66666666666" || cpf === "77777777777" || cpf === "88888888888" || cpf === "99999999999" || cpf === "00000000000") {
        var digitoGerado = null;
    } else {
        var digitoGerado = (soma1 * 10) + soma2;
    }
    if (digitoGerado !== digitoDigitado) {
        return false;
    }
    return true;
}
function isCpfFormatted(cpf) {
    var validCPF = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
    return cpf.match(validCPF);
}
$.validator.addMethod("cpf", function (value, element, type) {
    if (value === "")
        return true;
    if ((type === 'format' || type === 'both') && !isCpfFormatted(value)){
        return false;
    }else{
        element.classList.remove("is-invalid")
        return ((type === 'valid' || type === 'both')) ? isCpf(value) : true;
    }
    }, function (type, element) {
        element.classList.add("is-invalid")
        return (type === 'format' || (type === 'both' && !isCpfFormatted($(element).val()))) ? 'Formato do CPF n&atilde;o &eacute; v&aacute;lido' : 'Por favor digite um CPF válido';
});
$.validator.addMethod("cnpj", function (value, element, type) {
    if (value === "")
        return true;
    if ((type === 'format' || type === 'both') && !validarCNPJ(value))
        return false;
    else
    element.classList.remove("is-invalid")
        return ((type === 'valid' || type === 'both')) ? validarCNPJ(value) : true;
}, function (type, element) {
    element.classList.add("is-invalid")
    return (type === 'format' || (type === 'both' && !validarCNPJ($(element).val()))) ? 'Formato do CNPJ n&atilde;o &eacute; v&aacute;lido' : 'Por favor digite um CNPJ válido';
});

function validarPIS(pis) {
    var multiplicadorBase = "3298765432";
    var total = 0;
    var resto = 0;
    var multiplicando = 0;
    var multiplicador = 0;
    var digito = 99;

    // Retira a mascara
    var numeroPIS = pis.replace(/[^\d]+/g, '');

    if (numeroPIS.length !== 11 ||
        numeroPIS === "00000000000" ||
        numeroPIS === "11111111111" ||
        numeroPIS === "22222222222" ||
        numeroPIS === "33333333333" ||
        numeroPIS === "44444444444" ||
        numeroPIS === "55555555555" ||
        numeroPIS === "66666666666" ||
        numeroPIS === "77777777777" ||
        numeroPIS === "88888888888" ||
        numeroPIS === "99999999999") {
        return false;
    } else {
        for (var i = 0; i < 10; i++) {
            multiplicando = parseInt(numeroPIS.substring(i, i + 1));
            multiplicador = parseInt(multiplicadorBase.substring(i, i + 1));
            total += multiplicando * multiplicador;
        }

        resto = 11 - total % 11;
        resto = resto === 10 || resto === 11 ? 0 : resto;

        digito = parseInt("" + numeroPIS.charAt(10));
        return resto === digito;
    }
}  
$.validator.addMethod("pis", function (value, element, type) {
    if (value === "")
    return true;
    if ((type === 'format' || type === 'both') && !validarPIS(value))
    return false;
    else
    element.classList.remove("is-invalid")
    return ((type === 'valid' || type === 'both')) ? validarPIS(value) : true;

}, function (type, element) {
    element.classList.add("is-invalid")
    return (type === 'format' || (type === 'both' && !validarPIS($(element).val()))) ? 'Formato do CNPJ n&atilde;o &eacute; v&aacute;lido' : 'Por favor digite um PIS válido';
})
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
        cpf:{
           required:true,
           cpf:'valid'
        },
        cnpj:{
            required: true,
            cnpj:'valid'
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
        // aliq__terceiros:{
        //     required:true
        // },
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
           
        },
        sabados:{
            required:true,
            
        },
        domingos:{
            required:true,
            
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
        pis:{
            required:true,
            pis:'valid'
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
        },
        nome:{
            required:true,
            maxlength: 20,
        },
        cnpj_mf:{
            required:true
        },
        dataregistro:{
            required:true
        },
        responsave:{
            required:true
        },
        email:{
            required:true
        },
        cnae__codigo:{
            required:true
        },
        cod__municipio:{
            required:true
        },
        sincalizado:{
            required:true
        },
        retem__ferias:{
            required:true
        },
        vt__trabalhador:{
            required:true,
        },
        va__trabalhador:{
            required:true
        },
        nro__fatura:{
            required:true
        },
        nro__reciboavulso:{
            required:true
        },
        matric__trabalhador:{
            required:true
        },
        nro__requisicao:{
            required:true
        },
        nro__boletins:{
            required:true
        },
        nro__folha:{
            required:true
        },
        nro__cartaoponto:{
            required:true
        },
        seq__esocial:{
            required:true
        },
        cbo:{
            required:true
        },
        contribuicao__sindicato:{
            required:true
        },
        usuario:{
            required:true
        },
        cargo:{
            required:true
        },
        senha:{
            required:true,
           
            maxlength:6
        },
        categoria__contrato:{
            required:true,
            maxlength:20
        },
        irrf:{
            required:true
        },
        sf:{
            required:true
        },
        ctps:{
            required:true
        },
        serie__ctps:{
            required:true
        },
        uf__ctps:{
            required:true,
            maxlength:2
        },
        situacao__contrato:{
            required:true
        },
        // data__afastamento:{
        //     required:true
        // },
        data_nascimento:{
            required:true
        },
        pais__nascimento:{
            required:true
        },
        pais__nacionalidade:{
            required:true
        },
        nome__mae:{
            required:true
        },
        entrada1:{
            required:true
        },
        saida:{
            required:true
        },
        entrada2:{
            required:true
        },
        saida2:{
            required:true
        },
    },
    messages:{
        saida2:{
            required:"O campo nome não pode esta vazio!",
        },
        entrada2:{
            required:"O campo nome não pode esta vazio!",
        },
        saida:{
            required:"O campo nome não pode esta vazio!",
        },
        entrada1:{
            required:"O campo nome não pode esta vazio!",
        },
        nome__mae:{
            required:"O campo nome não pode esta vazio!",
        },
        pais__nacionalidade:{
            required:"O campo nome não pode esta vazio!",
        },
        pais__nascimento:{
            required:"O campo nome não pode esta vazio!",
        },
        data_nascimento:{
            required:"O campo nome não pode esta vazio!",
        },
        // data__afastamento:{
        //     required:"O campo nome não pode esta vazio!",
        // },
        situacao__contrato:{
            required:"O campo nome não pode esta vazio!",
        },
        uf__ctps:{
            required:"O campo nome não pode esta vazio!",
            maxlength:'O campo não pode ter mas de 2 caracteris'
        },
        serie__ctps:{
            required:"O campo nome não pode esta vazio!",
        },
        ctps:{
            required:"O campo nome não pode esta vazio!",
        },
        sf:{
            required:"O campo nome não pode esta vazio!",
        },
        irrf:{
            required:"O campo nome não pode esta vazio!",
        },
        categoria__contrato:{
            required:"O campo nome não pode esta vazio!",
            maxlength:'O campo não pode ter mas de 20 caracteris'
        },
        pis:{
            required:"O campo nome não pode esta vazio!",
        },
        cpf:{
            required:"O campo nome não pode esta vazio!",
        },
        senha:{
            required:"O campo nome não pode esta vazio!",
            maxlength:"apenas 6 caracteres"
        },
        cargo:{
            required:"O campo nome não pode esta vazio!",
        },
        usuario:{
            required:"O campo nome não pode esta vazio!",
        },
        contribuicao__sindicato:{
            required:"O campo nome não pode esta vazio!",
        },
        cbo:{
            required:"O campo nome não pode esta vazio!",
        },
        seq__esocial:{
            required:"O campo nome não pode esta vazio!",
        },
        nro__cartaoponto:{
            required:"O campo nome não pode esta vazio!",
        },
        nro__folha:{
            required:"O campo nome não pode esta vazio!",
        },
        nro__boletins:{
            required:"O campo nome não pode esta vazio!",
        },
        nro__requisicao:{
            required:"O campo nome não pode esta vazio!",
        },
        matric__trabalhador:{
            required:"O campo nome não pode esta vazio!",
        },
        nro__reciboavulso:{
            required:"O campo nome não pode esta vazio!",
        },
        nro__fatura:{
            required:"O campo nome não pode esta vazio!",
        },
        va__trabalhador:{
            required:"O campo nome não pode esta vazio!",
        },
        vt__trabalhador:{
            required:"O campo nome não pode esta vazio!",
        },
        retem__ferias:{
            required:"O campo nome não pode esta vazio!",
        },
        sincalizado:{
            required:"O campo nome não pode esta vazio!",
        },
        cod__municipio:{
            required: "O campo nome não pode esta vazio!",
        },
        cnae__codigo:{
            required: "O campo nome não pode esta vazio!",
        },
        email:{
            required: "O campo nome não pode esta vazio!",
        },
        responsave:{
            required: "O campo nome não pode esta vazio!",
        },
        dataregistro:{
            required: "O campo nome não pode esta vazio!",
        },
        cnpj_mf:{
            required: "O campo nome não pode esta vazio!",
        },
        nome:{
            required: "O campo nome não pode esta vazio!",
            maxlength: "  O campo nome não pode tem mais de 20 caracteres!",
        },
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
        // aliq__terceiros:{
        //     required:'O campo Aliq. Terceiros não pode esta vazio!'
        // },
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