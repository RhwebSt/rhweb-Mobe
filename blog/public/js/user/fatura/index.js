$( "#pesquisa" ).on('keyup focus',function() {
              var dados = '0';
              if ($(this).val()) {
                dados = $(this).val();
                if (dados.indexOf('  ') !== -1) {
                  dados = monta_dados(dados);
                }
              }
              $.ajax({
                  url: "{{url('tomador')}}/pesquisa/"+dados,
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
            
        
            var Back = document.getElementById('gerar-fatura-tab');
            Back.addEventListener("click", function(){
               localStorage.setItem('Backft', 'backpill1');
               
           })
           
        //    var Back1 = document.getElementById('pills-contact-tab');
        //     Back1.addEventListener("click", function(){
        //        localStorage.setItem('Backft', 'backpill3');
               
        //    })
           
           var Back2 = document.getElementById('lista-fatura-tab');
            Back2.addEventListener("click", function(){
               localStorage.setItem('Backft', 'backpill2');
               
           })
           
           backActive =  document.getElementById("lista-fatura");
           backActive1 =  document.getElementById("gerar-fatura");
        //    backActive2 =  document.getElementById("pills-contact");

            voltar = localStorage.getItem("Backft");

            
            if(voltar === null){
                localStorage.setItem('Backft', 'backpill1');
                Back.classList.add("active");
                backActive1.classList.add("show", "active");
                backActive.classList.remove("show", "active");
                // backActive2.classList.remove("show", "active");
                document.getElementById("gerar-fatura-tab").click();
            }

            if(voltar === "backpill1"){
                Back.classList.add("active");
                backActive1.classList.add("show", "active");
                backActive.classList.remove("show", "active");
                // backActive2.classList.remove("show", "active");
                document.getElementById("gerar-fatura-tab").click();
                

            }else if (voltar === "backpill2"){
                Back2.classList.add("active");
                backActive.classList.add("show", "active");
                backActive1.classList.remove("show", "active");
                // backActive2.classList.remove("show", "active");
                document.getElementById("lista-fatura-tab").click();

            }   
            // else if (voltar === "backpill3"){
            //     Back1.classList.add("active");
            //     backActive2.classList.add("show", "active");
            //     backActive.classList.remove("show", "active");
            //     backActive1.classList.remove("show", "active");
            //     document.getElementById("pills-contact-tab").click();

            // }    


            