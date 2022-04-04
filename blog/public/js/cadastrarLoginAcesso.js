function validaInputQuantidade(idCampo,QuantidadeCarcteres){
    var campo = document.querySelector(idCampo);

    campo.addEventListener('input', function(){
        var campo = document.querySelector(idCampo);
        var result = campo.value;
        if(result > " " && result.length >= QuantidadeCarcteres){
          campo.classList.add('is-valid');  
        }else{
            campo.classList.remove('is-valid');
        }
         
    });
}
 var cargo = validaInputQuantidade("#cargo",1);
 var usuario = validaInputQuantidade("#usuario",2);
 var senha = validaInputQuantidade("#senha",6);