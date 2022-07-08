var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
     $('#data').on('keyup focus click change',function () {
       verificardata($(this).val(),0)
     })

     function verificardata(Y,valor) {
        var data = Y
        var dias = '';
        data = data.split('-')
        dias = new Date(`${data[0]}-${data[1]}-${ parseInt(data[2]) + valor} 08:24:30`);
        dias = dias.getDay();
        semana.forEach((element,index) => {
            if (dias == index) {
                if (element === 'Domingo') {
                  $('#feriadostatus').val(true)
                }else if (element === 'Sábado') {
                  $('#feriadostatus').val(true)
                }
                let novadata = `${data[0]}-${data[1]}-${ parseInt(data[2]) + valor}`
                if (feriador_nacionais(novadata)) {
                  $('#feriadostatus').val(true)
                }else if (element !== 'Domingo' && element !== 'Sábado') {
                  $('#feriadostatus').val(null)
                }
            }
        })
    }
    verificardata('{{$dados->lsdata}}',0)
    function feriador_nacionais(dados) {
        var verifica = false;
        $.ajax({
            url: "https://brasilapi.com.br/api/feriados/v1/2021",
            type: 'get',
            contentType: 'application/json',
            async: false,
            success:(data) => {
                data.forEach(element => {
                    if (element.date === dados) {
                        verifica = true;
                    }
                });
            }  
        })
        return verifica;
    }

    $("#pesquisa").on('keyup focus', function() {
      var dados = '0';
      if ($(this).val()) {
        dados = $(this).val();
        if (dados.indexOf('  ') !== -1) {
          dados = monta_dados_pesquisa(dados);
        }
      }
      var status = $('#status').val(); 
      $.ajax({
        url: "{{url('tabela/cartao/ponto/pesquisa')}}/" + dados + '/' + status,
        type: 'get',
        contentType: 'application/json',
        success: function(data) {
          let nome = ''
          if (data.length >= 1) {
            data.forEach(element => {
              nome += `<option value="${element.liboletim}  ${element.tsnome}">`
              // nome += `<option value="${element.tsmatricula}">`
              // nome += `<option value="${element.tscnpj}">`
            });
            $('#listapesquisa').html(nome)
          }
          if (data.length === 1 ) {
            $('#search').val(data[0].liboletim)
            // lancamentoTab(dados, status, data[0].lsdata)
          } 
          // else {
          //   // limpaCamposTab()
          // }
        }
      });
    });
            function lancamentoTab(dados,status,data) {
              $('#carregamento').removeClass('d-none')
              $.ajax({
                url: "{{url('tabela/cartao/ponto/unidade')}}/"+dados+'/'+status,
                type: 'get',
                contentType: 'application/json',
                success: function(data) {
                  camposLacamentoTab(data)
                  $('#carregamento').addClass('d-none')
                }
              })
            }
            function limpaCamposTab() {
              $('#form').attr('action', "{{ route('cartao.ponto.cadastro') }}");
              $('#incluir').removeAttr( "disabled" )
              $('#atualizar').attr('disabled','disabled')
              $('#deletar').attr('disabled','disabled')
              $('#method').val(' ')
              $('#excluir').attr( "disabled",'disabled' )
              $('#matricula').val(' ')
              $('#nome__completo').val(' ')
              $('#data').val(' ')
              $('#num__trabalhador').val(' ')
              $('#num__boletim').val(localStorage.getItem('cartao'))
            }
            function camposLacamentoTab(data) {
                  if (data.id) {
                      $('#form').attr('action', "{{ url('cadastrocartaoponto')}}/"+data.id);
                      $('#formdelete').attr('action',"{{ url('cadastrocartaoponto')}}/"+data.id)
                      $('#incluir').attr('disabled','disabled')
                      $('#atualizar').removeAttr( "disabled" )
                      $('#deletar').removeAttr( "disabled" )
                      $('#excluir').removeAttr( "disabled" )
                      $('#method').val('PUT')
                      buscatomador(data.tomador)
                  }else{
                    $('#form').attr('action', "{{ route('cartao.ponto.cadastro') }}");
                    $('#incluir').removeAttr( "disabled" )
                    $('#atualizar').attr('disabled','disabled')
                    $('#deletar').attr('disabled','disabled')
                    $('#method').val(' ')
                    $('#excluir').attr( "disabled",'disabled' ) 
                  }
                  $('#num__boletim').val(data.liboletim).removeClass('is-invalid').next().text(' ')
                  $('#matricula').removeClass('is-invalid').next().text(' ')
                  $('#nome__completo').removeClass('is-invalid').next().text(' ')
                  $('#data').val(data.lsdata).removeClass('is-invalid').next().text(' ')
                  $('#num__trabalhador').val(data.lsnumero).removeClass('is-invalid').next().text(' ')
                  for (let index = 0; index <  $('#feriado option').length; index++) {  
                    if (data.lsferiado == $('#feriado option').eq(index).text()) {
                      $('#feriado option').eq(index).attr('selected','selected')
                    }else  {
                      $('#feriado option').eq(index).removeAttr('selected')
                    }
                  }
            }
            $( "#nome__completo" ).on('keyup focus',function() {
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
                    tomador(' ')
                    let nome = ''
                      if (data.length >= 1) {
                        data.forEach(element => {
                          nome += `<option value="${element.tsmatricula}  ${element.tsnome}">`
                          // nome += `<option value="${element.tsmatricula}">`
                          nome += `<option value="${element.tscnpj}">`
                        });
                        $('#datalistOptions').html(nome)
                      }
                      if(data.length === 1){
                        tomador(data[0])
                        let tabela = tabelaPrecoTabela(data[0].id);
                        // let rublica = '';
                        // let status = '';
                        if (!tabela.length) {
                          alertatabela(data[0].id)
                            // tabela.forEach(element => {
                            //   if (!element.tstomvalor) {
                            //       status = 'vazia';
                            //       rublica += ` <li class="list-group-item">O tomador da rublica ${element.tsdescricao} está R$ 0,00</li>`
                            //   }
                            //   if (!element.tsvalor) {
                            //     status = 'vazia';
                            //     rublica += `<li class="list-group-item">O trabalhador da rublica ${element.tsdescricao} está R$ 0,00</li>`
                            //   }
                            // });
                            // if (status) {
                            //   Alerta(data[0].id,status,rublica)
                            // }
                        }
                        // else{
                        //   status = 'não a tabela'
                        //   Alerta(data[0].id,status,rublica)
                        // }
                      }           
                  }
              });
            });
            function alertatabela(tomador) {
              Swal.fire({
                title: '<strong>Algo deu Errado!</strong>',
                icon: 'error',
                html:
                  '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
                  `<a href="${window.Laravel.tabelapreco.create}/${btoa(tomador)}">Cadastrar</a> `,
                showCloseButton: true,
                allowOutsideClick: false,
                allowEnterKey: true,
              })
              // switch (status) {
              //   case 'vazia':
              //       Swal.fire({
              //         title: '<strong>Algo deu Errado!</strong>',
              //         icon: 'error',
              //         html:
              //           `<strong>Tabela de Preço</strong> existe rublica com o valor 0,
              //           <ul class="list-group">
              //            ${dados}
              //           </ul>
              //           <a href="${window.Laravel.tabelapreco.index}/ /${btoa(tomador)}">Atualizar valores</a> `,
              //         showCloseButton: true,
              //         allowOutsideClick: false,
              //         allowEnterKey: true,
              //       })
              //     break;
              //     case 'não a tabela':
              //       Swal.fire({
              //         title: '<strong>Algo deu Errado!</strong>',
              //         icon: 'error',
              //         html:
              //           '<strong>Tabela de Preço</strong> não foi <b>cadastrada</b>, ' +
              //           `<a href="${window.Laravel.tabelapreco.create}/${btoa(tomador)}">Cadastrar</a> `,
              //         showCloseButton: true,
              //         allowOutsideClick: false,
              //         allowEnterKey: true,
              //       })
              //     break;
              // }
            
            }
            function tabelaPrecoTabela(tomador) {
              var resul = false;
              $.ajax({
                  url: `${window.Laravel.tabelapreco.pesquisa}/0/${btoa(tomador)}`,
                  type: 'get',
                  contentType: 'application/json',
                  async: false,
                  success: function(data) {
                    resul = data
                  }
              })
              return resul;
            }
            function monta_dados(dados) {
              let novodados = dados.split('  ')
              return novodados[1];
            }
            function monta_dados_pesquisa(dados) {
              let novodados = dados.split('  ')
              console.log(novodados);
              return novodados[0];
            }
            function buscatomador(dados) {
              $.ajax({
                  url: "{{url('tomador')}}/"+dados,
                  type: 'get',
                  contentType: 'application/json',
                  success: function(data) {
                    if (data) {
                      tomador(data)
                      $('#nome__completo').val(data.tsnome)
                    }
                  }
              })
            }
            function tomador(data) {
              $('#tomador').val(data.id)
              $('#matricula').val(data.tsmatricula)
              $('#domingo').val(data.csdomingos?data.csdomingos: 0.00)
              $('#sabado').val(data.cssabados?data.cssabados:0.00)
              $('#diasuteis').val(data.csdiasuteis)
            }