function validaInputQuantidade(idCampo, QuantidadeCarcteres) {
    var telefone = document.querySelector(idCampo);

    telefone.addEventListener('input', function() {
      var telefone = document.querySelector(idCampo);
      var result = telefone.value;
      if (result > " " && result.length >= QuantidadeCarcteres) {
        telefone.classList.add('is-valid');
      } else {
        telefone.classList.remove('is-valid');
      }

    });
  }
  
                        // trabalhador//
  var nome__completo = validaInputQuantidade("#nome__completo", 1);
  var nome__social = validaInputQuantidade("#nome__social", 1);
  var cpf = validaInputQuantidade("#cpf", 14);
  var pis = validaInputQuantidade("#pis", 14);
  var pais__nascimento1 = validaInputQuantidade("#pais__nascimento", 1);
  var pais__nacionalidade = validaInputQuantidade("#pais__nacionalidade", 1);
  var nome__mae = validaInputQuantidade("#nome__mae", 1);
  var cep = validaInputQuantidade("#cep", 9);
  var logradouro = validaInputQuantidade("#logradouro", 1);
  var bairro = validaInputQuantidade("#bairro", 1);
  var localidade = validaInputQuantidade("#localidade", 1);
  var numero = validaInputQuantidade("#numero", 1);
  var uf = validaInputQuantidade("#uf", 2);
  var data_nascimento = validaInputQuantidade("#data_nascimento", 10);
  var telefone = validaInputQuantidade("#telefone", 14);
  var data__admissao = validaInputQuantidade("#data__admissao", 10);
  var categoria = validaInputQuantidade("#categoria", 2);
  var cbo1 = validaInputQuantidade("#cbo", 5);
  var ctps = validaInputQuantidade("#ctps", 14);
  var serie__ctps = validaInputQuantidade("#serie__ctps", 1);
  var uf__ctps = validaInputQuantidade("#uf__ctps", 2);
  var data__afastamento = validaInputQuantidade("#data__afastamento", 10);
  var banco = validaInputQuantidade("#banco", 2);
  var agencia = validaInputQuantidade("#agencia", 4);
  var operacao = validaInputQuantidade("#operacao", 3);
  var conta = validaInputQuantidade("#conta", 8);
  var pix = validaInputQuantidade("#pix", 1);

  var cepFocusOut = document.querySelector('#cep');
  cepFocusOut.addEventListener('focusout', function() {
    var logradouro = document.querySelector('#logradouro');
    var resultlog = logradouro.value;
    var bairro = document.querySelector('#bairro');
    var resultbairro = bairro.value;
    var localidade = document.querySelector('#localidade');
    var resultlocal = localidade.value;
    var uf = document.querySelector('#uf');
    var resultuf = uf.value;


    if (resultlog > " ") {
      logradouro.classList.add('is-valid');
    } else {
      logradouro.classList.remove('is-valid');
    }

    if (resultbairro > " ") {
      bairro.classList.add('is-valid');
    } else {
      bairro.classList.remove('is-valid');
    }

    if (resultlocal > " ") {
      localidade.classList.add('is-valid');
    } else {
      localidade.classList.remove('is-valid');
    }

    if (resultuf > " " && resultuf.length > 2) {
      uf.classList.add('is-valid');
    } else {
      uf.classList.remove('is-valid');
    }

  });
  
          //fim do trabalhador//
          
          
          
          //tomador//
    var nomeFantasia = validaInputQuantidade("#nome__fantasia",1);
    var nomeCompleto = validaInputQuantidade("#nome__completo",1);
    var telefone = validaInputQuantidade("#telefone",15);
    var cep = validaInputQuantidade("#cep",9);
    var logradouro = validaInputQuantidade("#logradouro",1);
    var bairro = validaInputQuantidade("#bairro",1);
    var localidade = validaInputQuantidade("#localidade",1);
    var numero = validaInputQuantidade("#numero",1);
    var uf = validaInputQuantidade("#uf",2);
    var diasUteis = validaInputQuantidade("#dias_uteis",1);
    var sabados = validaInputQuantidade("#sabados",1);
    var domingos = validaInputQuantidade("#domingos",1);
    var taxaAdm = validaInputQuantidade("#taxa_adm",1);
    var taxaFed = validaInputQuantidade("#taxa__fed",1);
    var deflator = validaInputQuantidade("#deflator",1);
    var das = validaInputQuantidade("#das",1);
    var cod__fpas = validaInputQuantidade("#cod__fpas",1);
    var cod__rat = validaInputQuantidade("#cod__fap",1);
    var cod__grps = validaInputQuantidade("#cod__grps",1);
    var cnae = validaInputQuantidade("#cnae",1);
    var fap__aliquota = validaInputQuantidade("#fap__aliquota",1);
    var rat__ajustado = validaInputQuantidade("#rat__ajustado",1);
    var fpas__terceiros = validaInputQuantidade("#fpas__terceiros",1);
    var aliq__terceiros = validaInputQuantidade("#aliq__terceiros",1);
    var alimentacao = validaInputQuantidade("#alimentacao",1);
    var transporte = validaInputQuantidade("#transporte",1);
    var epi__13sal = validaInputQuantidade("#epi",1);
    var seguro__trabalhador = validaInputQuantidade("#seguro__trabalhador",1);
    var folhartransporte = validaInputQuantidade("#folhartransporte",1);
    var folharalim = validaInputQuantidade("#folharalim",1);
    var banco = validaInputQuantidade("#banco",1);
    var agencia = validaInputQuantidade("#agencia",4);
    var operacao = validaInputQuantidade("#operacao",3);
    var conta = validaInputQuantidade("#conta",9);
    var pix = validaInputQuantidade("#pix",1);

           
            
    var cepFocusOut = document.querySelector('#cep');
    cepFocusOut.addEventListener('focusout', function(){
        var logradouro = document.querySelector('#logradouro');
        var resultlog = logradouro.value;
        var bairro = document.querySelector('#bairro');
        var resultbairro = bairro.value;
        var localidade = document.querySelector('#localidade');
        var resultlocal = localidade.value;
        var uf = document.querySelector('#uf');
        var resultuf = uf.value;
        
        
        if(resultlog > " "){
          logradouro.classList.add('is-valid');  
        }else{
            logradouro.classList.remove('is-valid');
        }
        
        if(resultbairro > " "){
          bairro.classList.add('is-valid');  
        }else{
            bairro.classList.remove('is-valid');
        }
        
        if(resultlocal > " "){
          localidade.classList.add('is-valid');  
        }else{
            localidade.classList.remove('is-valid');
        }
        
        if(resultuf > " " && resultuf.length > 2){
          uf.classList.add('is-valid');  
        }else{
            uf.classList.remove('is-valid');
        }
         
    });
            
        //fim do tomador//
        
        
        //tabela de preço//
        
    var descricao = validaInputQuantidade("#descricao", 1);
    var ano = validaInputQuantidade("#ano", 4);
    var valorTrabalhador = validaInputQuantidade("#valor", 1);
    var valorTomador = validaInputQuantidade("#valor__tomador", 1);
    var codigo = validaInputQuantidade("#rubricas", 1)
        //fim da tabela de preço//
        
        
        //cadastro de Acesso//
        var cargo = validaInputQuantidade("#cargo",1);
        var usuarioAcesso = validaInputQuantidade("#usuario",2);
        //fim do cadastro de acesso//
        
        //comissionado//
        
        var nomeTrablhador = validaInputQuantidade("#nome__trabalhador",1);
        var indice = validaInputQuantidade("#indice",1);
        var nome_tomador = validaInputQuantidade("#nome_tomador",1);
        
        //fim do comissionado//
