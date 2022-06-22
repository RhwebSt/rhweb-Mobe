  function togglePermissao(idIcone, idBotao){
  
        var verificaClasse = document.querySelector(idIcone);
        const botaoTeste = document.querySelector(idBotao);
        
        botaoTeste.addEventListener('click', function(){
            const classe = verificaClasse.classList;
            var result = classe.toggle("fa-times");
            
            if(result == true){
                verificaClasse.classList.remove('text-success');
                verificaClasse.classList.add('text-danger');
            }else{
                verificaClasse.classList.remove('text-danger');
                verificaClasse.classList.add('text-success');
            }
            console.log(classe.value);
        });
    
    }
    
    var permissaoCadastro = togglePermissao("#iconeCadastro","#botaoCadastro");