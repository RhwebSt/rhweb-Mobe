setInterval(function () {

    // verifica se tem algo no local storage, se não tiver ele coloca// 
    if(localStorage.getItem("configUser") === null){    
        var config = {fontSize:{tamanhoFont: "16px"}, textTransform: {formatoFont:"padrao"}, expessuraFont: {expessura: "padrao"}, animacoes: {resultAnimacoes: true }, automaticFill: {preenchimentoAutomatico: true}};
        localStorage.setItem("configUser", JSON.stringify(config) );
    }
    // fim//

    var resultado = JSON.parse(localStorage.getItem("configUser"));
    var resultTamanhoFont = resultado.fontSize.tamanhoFont;
    var resultFormatoFont = resultado.textTransform.formatoFont;
    var resultAnimacao = resultado.animacoes.resultAnimacoes;
    var resultPreenchimentoAutomatico = resultado.automaticFill.preenchimentoAutomatico;
    var resultExpessuraFont = resultado.expessuraFont.expessura;

    if(resultTamanhoFont === '16px'){
        $("#select-font-size option:contains(16px)").attr('selected', true);
    }
    
    if(resultTamanhoFont === '18px'){
        $("#select-font-size option:contains(18px)").attr('selected', true);
    }
    
    if(resultTamanhoFont === '20px'){
        $("#select-font-size option:contains(20px)").attr('selected', true);
    }
    
    if(resultTamanhoFont === '22px'){
        $("#select-font-size option:contains(22px)").attr('selected', true);
    }
    
    if(resultFormatoFont === "maiuscula"){
        $("#select-formato-font option:contains(Maiúscula)").attr('selected', true);
    }
    
    if(resultFormatoFont === "padrao"){
        $("#select-formato-font option:contains(Padrão)").attr('selected', true);
    }
    
    if(resultAnimacao === "false"){
        $("#select-animacoes option:contains(Desativado)").attr('selected', true);
    }
    
    if(resultAnimacao === "true"){
        $("#select-animacoes option:contains(Ativado)").attr('selected', true);
    }
    
    if(resultPreenchimentoAutomatico === "true"){
        $("#preenchimentoAutomatico option:contains(Sim)").attr('selected', true);
    }
    
    if(resultPreenchimentoAutomatico === "false"){
        $("#preenchimentoAutomatico option:contains(Não)").attr('selected', true);
    }

    if(resultExpessuraFont === "negrito"){
        $("#select-expessura-font option:contains(Negrito)").attr('selected', true);
    }
    
    if(resultExpessuraFont === "padrao"){
        $("#select-expessura-font option:contains(Padr���o)").attr('selected', true);
    }

    tamanhoFont = $("#select-font-size").val();
    formatoFont = $("#select-formato-font").val();
    resultAnimacoes = $("#select-animacoes").val();
    preenchimentoAutomatico = $("#preenchimentoAutomatico").val();
    expessura = $("#select-expessura-font").val();

    config = {fontSize:{tamanhoFont}, textTransform: {formatoFont}, expessuraFont: {expessura}, animacoes: {resultAnimacoes}, automaticFill: {preenchimentoAutomatico}};

    localStorage.setItem("configUser", JSON.stringify(config) );


    resultado = JSON.parse(localStorage.getItem("configUser"));
    resultTamanhoFont = resultado.fontSize.tamanhoFont;
    resultFormatoFont = resultado.textTransform.formatoFont;
    resultAnimacao = resultado.animacoes.resultAnimacoes;
    resultPreenchimentoAutomatico = resultado.automaticFill.preenchimentoAutomatico;
    resultExpessuraFont = resultado.expessuraFont.expessura;

    if(resultTamanhoFont === '16px'){
        config = {fontSize:{tamanhoFont: "16px"}, textTransform: {formatoFont}, expessuraFont: {expessura}, animacoes: {resultAnimacoes}, automaticFill: {preenchimentoAutomatico}};
        localStorage.setItem("configUser", JSON.stringify(config) );
        $("#select-font-size option:contains(16px)").attr('selected', true);
        $(".body-content").css("font-size", "16px");
        
    }
    
    if(resultTamanhoFont === '18px'){
        config = {fontSize:{tamanhoFont: "18px"}, textTransform: {formatoFont}, expessuraFont: {expessura}, animacoes: {resultAnimacoes}, automaticFill: {preenchimentoAutomatico}};
        localStorage.setItem("configUser", JSON.stringify(config) );
        $(".body-content").css("font-size", "18px");
        $("#select-font-size option:contains(18px)").attr('selected', true);
    }
    
    if(resultTamanhoFont === '20px'){
        config = {fontSize:{tamanhoFont: "20px"}, textTransform: {formatoFont}, expessuraFont: {expessura}, animacoes: {resultAnimacoes}, automaticFill: {preenchimentoAutomatico}};
        localStorage.setItem("configUser", JSON.stringify(config) );
        $(".body-content").css("font-size", "20px");
        $("#select-font-size option:contains(20px)").attr('selected', true);
        
    }
    
    if(resultTamanhoFont === '22px'){
        config = {fontSize:{tamanhoFont: "22px"}, textTransform: {formatoFont}, expessuraFont: {expessura}, animacoes: {resultAnimacoes}, automaticFill: {preenchimentoAutomatico}};
        localStorage.setItem("configUser", JSON.stringify(config) );
        $("#select-font-size option:contains(22px)").attr('selected', true);
        $(".body-content").css("font-size", "22px");
    }
    
    if(resultFormatoFont === "maiuscula"){
        $("input").css("text-transform", "uppercase");
    }
    
    if(resultFormatoFont === "padrao"){
        $("input").css("text-transform", "none");
    }
    
    if(resultAnimacao === "false"){
        $("main").css("animation", "none");
        $("main").removeClass('main__Animation');
    }
    
    if(resultAnimacao === "true"){
        $("main").addClass('main__Animation');
    }
    
    if(resultPreenchimentoAutomatico === "true"){
        $("form").attr("autocomplete", "on");
    }
    
    if(resultPreenchimentoAutomatico === "false"){
        $("form").attr("autocomplete", "off");
    }
    
    if(resultExpessuraFont === "negrito"){
        $(".body-content").css("font-weight", "bold");
    }
    
    if(resultExpessuraFont === "padrao"){
        $(".body-content").css("font-weight", "");
    }
    


}, 1000);


