function filtro(){
    var campoFiltro = document.querySelector("#campoFiltro");
    
    campoFiltro.addEventListener('input', function(){
      var descricoes = document.querySelectorAll(".filtro");
        
        if (this.value.length > 0) {
            for(i = 0; i < descricoes.length; i++){
                var descricao = descricoes[i];
                var tdnome = descricao.querySelector(".texto");
                var nome = tdnome.textContent
                var expressao = new RegExp(this.value, "i");
                if (!expressao.test(nome)) {
                    descricao.classList.add("invisivel");
                } else {
                    descricao.classList.remove("invisivel");
                }
                console.log(nome);
            }
        }else{
            for(i = 0; i < descricoes.length; i++){
                var descricao = descricoes[i];
                descricao.classList.remove("invisivel");
            }
        }
        
    });
    }
    
    filtro();