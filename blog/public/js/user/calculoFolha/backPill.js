function activePill(){
    
    $("#calcula-folha-tab").click(function(){
        localStorage.setItem('Back', 'backpill1');
    });


    $("#lista-geral-tab").click(function(){
        localStorage.setItem('Back', 'backpill3');
    });

    $("#lista-tomador-tab").click(function(){
        localStorage.setItem('Back', 'backpill2');
    });

    voltar = localStorage.getItem("Back");
    
    if(voltar === null){
        localStorage.setItem('Back', 'backpill1');
        $("#calcula-folha-tab").addClass("active");
        $("#calculaFolha").addClass("show");
        $("#calculaFolha").addClass("active");
        $("#lista-tomador").removeClass("show");
        $("#lista-tomador").removeClass("active");
        $("#lista-geral").removeClass("show");
        $("#lista-geral").removeClass("active");
    }

    if(voltar === "backpill1"){
        $("#calcula-folha-tab").addClass("active");
        $("#calculaFolha").addClass("show");
        $("#calculaFolha").addClass("active");
        $("#lista-tomador").removeClass("show");
        $("#lista-tomador").removeClass("active");
        $("#lista-geral").removeClass("show");
        $("#lista-geral").removeClass("active");

    }
    
    if (voltar === "backpill2"){
        $("#lista-tomador-tab").addClass("active");
        $("#lista-tomador").addClass("active");
        $("#lista-tomador").addClass("show");
        $("#calculaFolha").removeClass("active");
        $("#calculaFolha").removeClass("show");
        $("#lista-geral").removeClass("show");
        $("#lista-geral").removeClass("active");

    }
    
    if (voltar === "backpill3"){
        $("#lista-geral-tab").addClass("active");
        $("#lista-geral").addClass("show");
        $("#lista-geral").addClass("active");
        $("#lista-tomador").removeClass("show");
        $("#lista-tomador").removeClass("active");
        $("#calculaFolha").removeClass("show");
        $("#calculaFolha").removeClass("active");
    }
}

activePill();