$( "#pesquisa" ).on('keyup focus',function() {
              var dados = '0';
              if ($(this).val()) {
                dados = $(this).val();
                if (dados.indexOf('  ') !== -1) { 
                  dados = monta_dados(dados);
                }
              }
              $.ajax({
                  url: `${window.Laravel.tomador.pesquisa}/${dados}`,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    let nome = ''
                    if (data.length >= 1) {
                        data.forEach(element => {
                            nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                            // nome += `<option value="${element.tsmatricula}">`
                            // nome += `<option value="${element.tscnpj}">`
                        });
                        $('#listapesquisa').html(nome)
                    }
                    if(data.length === 1){
                        $('#tomador').val(data[0].id)
                    }           
                  }
              });
            });
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[0];
            }
            
            
            function voltaPill(){
                
                $("#gerar-fatura-tab").click(function(){
                    localStorage.setItem('Backft', 'backpill1');
                });
                
                $("#lista-fatura-tab").click(function(){
                    localStorage.setItem('Backft', 'backpill2');
                });
                
                 var voltar = localStorage.getItem("Backft");
                
                if(voltar === null){
                    localStorage.setItem('Backft', 'backpill1');
                    $('#gerar-fatura-tab').addClass("active");
                    $("#gerar-fatura").addClass("show");
                    $("#gerar-fatura").addClass("active");
                    $("#lista-fatura").removeClass("show");
                    $("#lista-fatura").removeClass("active");
                }
    
                if(voltar === "backpill1"){
                    $('#gerar-fatura-tab').addClass("active");
                    $("#gerar-fatura").addClass("show");
                    $("#gerar-fatura").addClass("active");
                    $("#lista-fatura").removeClass("show");
                    $("#lista-fatura").removeClass("active");
    
                }else if (voltar === "backpill2"){
                    $('#lista-fatura-tab').addClass("active");
                    $("#lista-fatura").addClass("show");
                    $("#lista-fatura").addClass("active");
                    $("#gerar-fatura").removeClass("show");
                    $("#gerar-fatura").removeClass("active");
  
                }
                
            }
            
            voltaPill();
            
    