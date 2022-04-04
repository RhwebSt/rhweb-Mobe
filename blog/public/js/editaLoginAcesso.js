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
 const cargo = validaInputQuantidade("#cargo",1);
 const usuario = validaInputQuantidade("#usuario",2);
 const senha = validaInputQuantidade("#senha",6);