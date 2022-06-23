function remove(index) {
    console.log(index);
        $(`.campo${index}`).remove();
}

    let index = 0;

    function conteiner(index) {
        let conteiner = '';
        conteiner += `
            <section>
                <div class="row campo${index}">
        
                    <div class="col-12 col-md-5 mt-2">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" value="" name="descricao${index}" maxlength="100" id="descricao${index}">
                    </div>

                    <div class="col-12 col-md-3 mt-2">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" class="form-control numero " value="" name="valor${index}" maxlength="100" id="valor${index}">
                    </div>

                    <div class="col-12 col-md-3 mt-2">
                        <label for="cd${index}" class="form-label">Crédito/Desconto</label>
                        <select id="cd${index}" name="cd${index}" class="form-select" >
                        <option selected>Crédito</option>
                        <option>Desconto</option>
                        </select>
                    </div>
                    
                    
                    <div class="col-md-1 align-self-center" style="margin-top:32px;">
                        <a onclick="remove(${index})">  
                            <i class="fas fa-2x fa-times icon__exit--recibo--avulso"></i>
                        </a>
                    </div>
                    
                </div>
            </section>`
        return conteiner;

    }
    
    $('.numero').mask('000.000.000.000.000,00', {reverse: true});
    $('#adicinar').click(function() {
        if ($('#quantidade').val() <= 20) {
            // index += 1;
            let quantidade = parseInt($('#quantidade').val());
    
            $('#conteiner').append(conteiner(quantidade));
            quantidade += 1;
            $('#quantidade').val(quantidade)
            $('.numero').mask('000.000.000.000.000,00', {reverse: true});
        } else {
            alerta()
            $(this).addClass('disabled')
        }
    })
    $("#pesquisatrabalhador01,#pesquisatrabalhador").on('keyup focus', function() {
        let dados = '0'
        if ($(this).val()) {
            dados = $(this).val()
            if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
            }
        }
        $('#icon').addClass('d-none').next().removeClass('d-none')
        $.ajax({
            url: "{{url('avuso')}}/pesquisa/" + dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                $('#trabfoto').removeAttr('src')
                $('#refres').addClass('d-none').prev().removeClass('d-none')
                let nome = ''
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.ascpf}  ${element.asnome}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        //   nome += `<option value="${element.ascpf}">`
                    });
                    $('#listatrabalhador01,#listatrabalhador').html(nome)
                }
                if (data.length > 0) {
                    $('#trabalhador01').val(data[0].id)
                }
            }
        });
    });
    // $("#pesquisatrabalhador").on('keyup focus', function() {
    //     let dados = '0'
    //     if ($(this).val()) {
    //         dados = $(this).val()
    //         if (dados.indexOf('  ') !== -1) {
    //             dados = monta_dados(dados);
    //         }
    //     }
    //     $('#icon').addClass('d-none').next().removeClass('d-none')
    //     $.ajax({
    //         url: "{{url('trabalhador')}}/pesquisa/" + dados,
    //         type: 'get',
    //         contentType: 'application/json',
    //         success: function(data) {
    //             $('#trabfoto').removeAttr('src')
    //             $('#refres').addClass('d-none').prev().removeClass('d-none')
    //             let nome = ''
    //             if (data.length >= 1) {
    //                 data.forEach(element => {
    //                     nome += `<option value="${element.tsnome}">`
    //                     // nome += `<option value="${element.tsmatricula}">`
    //                     nome += `<option value="${element.tscpf}">`
    //                 });
    //                 $('#listatrabalhador').html(nome)
    //             }
    //             if (data.length >= 1) {
    //                 $('#trabalhador').val(data[0].id)
    //             }
    //         }
    //     });
    // });
    function voltaPill(){
        var Back = document.getElementById('info-avulso-tab');
        Back.addEventListener("click", function() {
            localStorage.setItem('Backrb', 'backpill1');
    
        })
    
        var Back1 = document.getElementById('rol-avulso-tab');
        Back1.addEventListener("click", function() {
            localStorage.setItem('Backrb', 'backpill3');
    
        })
    
        var Back2 = document.getElementById('lista-avulso-tab');
        Back2.addEventListener("click", function() {
            localStorage.setItem('Backrb', 'backpill2');
    
        })
    
        backActive = document.getElementById("lista-avulso");
        backActive1 = document.getElementById("info-avulso");
        backActive2 = document.getElementById("rol-avulso");
    
        voltar = localStorage.getItem("Backrb");
    
    
        if (voltar === null) {
            localStorage.setItem('Backrb', 'backpill1');
            Back.classList.add("active");
            backActive1.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("info-avulso-tab").click();
        }
    
        if (voltar === "backpill1") {
            Back.classList.add("active");
            backActive1.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("info-avulso-tab").click();
    
    
        } else if (voltar === "backpill2") {
            Back2.classList.add("active");
            backActive.classList.add("show", "active");
            backActive1.classList.remove("show", "active");
            backActive2.classList.remove("show", "active");
            document.getElementById("lista-avulso-tab").click();
    
        } else if (voltar === "backpill3") {
            Back1.classList.add("active");
            backActive2.classList.add("show", "active");
            backActive.classList.remove("show", "active");
            backActive1.classList.remove("show", "active");
            document.getElementById("rol-avulso-tab").click();
    
        }
    
    
        var botao = document.getElementById("backTop");
        var botaoAdicionar = document.getElementById("adicinar");
        var quantidade = document.getElementById("quantidade");
        var acaoTopo = document.getElementById("acaoTopo");
        var backTopTitle = document.getElementById("backTopTitle");
    }

    voltaPill();

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

    var nome = validaInputQuantidade("#nome", 1);
    var cpf = validaInputQuantidade("#cpf", 14);
    var tano = validaInputQuantidade("#tano", 8);
    var tanoFinal = validaInputQuantidade("#tanoFinal", 8);



    $('#pesquisatomador').on('keyup focus', function() {
        var dados = '0';
        if ($(this).val()) {
            dados = $(this).val();
            if (dados.indexOf('  ') !== -1) {
                dados = monta_dados(dados);
            }
        }
        $('#icon').addClass('d-none').next().removeClass('d-none')
        $.ajax({
            url: "{{url('tomador')}}/pesquisa/" + dados,
            type: 'get',
            contentType: 'application/json',
            success: function(data) {
                let nome = ''
                $('#refres').addClass('d-none').prev().removeClass('d-none')
                if (data.length >= 1) {
                    data.forEach(element => {
                        nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                        // nome += `<option value="${element.tsmatricula}">`
                        // nome += `<option value="${element.tscnpj}">`
                    });
                    $('#listatomador').html(nome)
                }
                if (data.length === 1 && dados.length >= 2) {
                    $('#tomador').val(data[0].tomador)
                }
            }
        });
    })
    
    

    function alerta() {
        const Toast = Swal.mixin({
            toast: true,
            width: 500,
            color: '#ffffff',
            background: '#C53230',
            position: 'top-end',
            showCloseButton: true,
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'Não pode ser cadastrado mais de 20!'
        })
    }

    function monta_dados(dados) {
        let novodados = dados.split('  ')
        return novodados[1];
    }
    

    botaoAdicionar.addEventListener('click', function() {
        var contador = quantidade.value + 1;
        if (contador >= 71) {
            acaoTopo.classList.remove("d-none");
        }

    })

    botao.addEventListener('click', function() {
        var contador = quantidade.value + 1;
        if (contador >= 71) {
            window.scrollTo(0, 1);

        }
    })

    backTopTitle.addEventListener('click', function() {
        var contador = quantidade.value + 1;
        if (contador >= 71) {
            window.scrollTo(0, 1);

        }
    })