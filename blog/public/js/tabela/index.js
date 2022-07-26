$(document).ready(function(){
    
    $('#tabelaEsocial').DataTable({
       
        processing:true,
        serverSide:true,
        searchable: false,
        orderable: false,
        'ajax':{
            url:`${window.Laravel.esocial.show}`,
            type: "get",
            
        },
        
        'columns':[
            {'data':'esnome'},
            {'data':'esinscricao'},
            {'data':'esprenome'},
            // {'data':'trabalhador_id',
            //     render:function(data, type, row){
            //         if (data) {
            //             return data.tsmatricula
            //         }
            //     }
            // },
            // {'data':'trabalhador_id',
            //     render:function(data, type, row){
            //         if (data) {
            //             return data.tsnome
            //         }
            //     }
            // },
            {'data':'esid',
                render:function(data, type, row){
                    if (!data) {
                        return `<span class="badge bg-danger">Este evento ainda não foi enviado</span>`
                    }else{
                        return data;
                    }
                }
            },
            {'data':'created_at',
                render:function (data, type, row) {
                    data = data.split('T')
                    return data[0].split('-').reverse().join('/');
                }
            },
            {'data':'esid',
            render: function(data, type, row){
                let dados = '';
                if (data){
                    $.ajax({
                        url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/${data}?ambiente=1&versaomanual=S.01.00.00`,
                        type: "GET",
                       
                        processData: false,  
                        async:false,
                        headers: {
                            // 'content-type':'text/tx2',
                            'cnpj_sh':'34350915000149',
                            'token_sh':'3048136792bc6c57aecab949f3f79b74',
                            'empregador':`${window.Laravel.empresa.cnpj}`
                        },
                        success: function(retorno){
                            dados = retorno;
                        },
                        error:function(retorno){
                            dados = retorno;
                            return  `<span class="badge bg-danger">${retorno.responseJSON.error.message}</span>`
                        }
                    });
                    if (dados.data.status_envio.codigo == 50) {
                        return xml(dados,row.folhar_id)
                    }else{
                        return ` `
                    }
                }else{
                    return ` `
                }
            }
            },
            {'data':'esid',
            render: function(data, type, row){
                let dados = '';
                let codigoerro = ["401","402","411"];
                if (data){
                    $.ajax({
                        url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/${data}?ambiente=1&versaomanual=S.01.00.00`,
                        type: "GET",
                        // data: dados,
                        // dataType: 'json',
                        processData: false,  
                        async:false,
                        headers: {
                            // 'content-type':'text/tx2',
                            'cnpj_sh':'34350915000149',
                            'token_sh':'3048136792bc6c57aecab949f3f79b74',
                            'empregador':`${window.Laravel.empresa.cnpj}`
                        },
                        success: function(retorno){
                            dados = retorno;
                           
                        },
                        error:function(retorno){
                            dados = retorno;
                            return  `<span class="badge bg-danger">${retorno.responseJSON.error.message}</span>`
                        }
                    });
                    if (dados.data.status_consulta.codigo == 101) {
                        return`<span class="badge bg-warning text-black">${dados.data.status_consulta.mensagem}</span>`
                    }else if (dados.data.eventos[0].status.codigo == 201) {
                        return`<span class="badge bg-success text-white">${dados.data.eventos[0].status.mensagem}</span>`
                    }else if (dados.data.eventos[0].status.codigo == 401) {
                        if (row.esnome == 'S1020') {
                            return erros(dados.data.eventos[0].ocorrencias[0].descricao,row.tomador_id);
                        }
                        if (row.esnome == 'S2300') {
                            return erros(dados.data.eventos[0].ocorrencias[0].descricao,row.trabalhador_id);
                        }
                        if (row.esnome == 'S1200') {
                            return erros(dados.data.eventos[0].ocorrencias[0].descricao,row.folhar_id);
                        }
                    }
                    // if (dados.data.eventos.length < 1) {
                    //     // if (dados.data.status_envio.codigo == 1) {
                    //     //     dados.data.status_envio.mensagem.forEach(element => {
                    //     //         dados += `${element}<br><br>`
                    //     //     });
                          
                    //     //     if (row.esnome == 'S1020') {
                    //     //         return erros(dados,row.folhar_id)
                    //     //     }
                    //     //     if (row.esnome == 'S2300') {
                    //     //         return erros(dados,row.folhar_id)
                    //     //     }
                    //     //     if (row.esnome == 'S1200') {
                    //     //         return erros(dados,row.folhar_id)
                    //     //     }
                    //     // }
                        
                    // }else{
                        
                    //     console.log(dados.data.eventos[0].status.codigo,dados.data.eventos[0].status.codigo.indexOf(codigoerro));
                    //     if (dados.data.eventos[0].status.codigo.indexOf(codigoerro) !== -1) {
                    //         if (row.esnome == 'S1020') {
                    //             return erros(dados.data.eventos[0].status.mensagem,row.tomador_id);
                    //         }
                    //         if (row.esnome == 'S2300') {
                    //             return erros(dados.data.eventos[0].status.mensagem,row.trabalhador_id);
                    //         }
                    //         if (row.esnome == 'S1200') {
                    //             return erros(dados.data.eventos[0].status.mensagem,row.folhar_id);
                    //         }
                    //     }
                    // }
                   
                    // if (typeof dados.data.eventos[0].ocorrencias !== 'undefined') {
                    //     dados.data.eventos[0].ocorrencias.forEach(element => {
                    //         dados += `${element.descricao}<br><br>`
                    //     });
                    //     $.ajax({
                    //         url: `${window.Laravel.esocial.update}/${dados.data.id}`,
                    //         type: "PUT",
                    //         data: {
                    //             id:dados.data.id,
                    //             codigo:dados.data.eventos[0].status.codigo,
                    //             status:dados.data.eventos[0].status.mensagem
                    //         },
                    //         // dataType: 'json',
                    //         // processData: false,  
                    //         // async:false,
                    //         headers: {
                    //             'X-CSRF-TOKEN': window.Laravel.csrf
                    //             // 'content-type':'text/tx2',
                    //             // 'cnpj_sh':'34350915000149',
                    //             // 'token_sh':'3048136792bc6c57aecab949f3f79b74',
                    //             // 'empregador':'34350915000149'
                    //         },
                    //         success: function(retorno){
                    //             // console.log(retorno);
                            
                    //         }
                    //     });
                    //     return erros(dados,row.folhar_id)
                    // }else{
                    //     return`<span class="badge bg-warning text-black">Em Processamento</span>`
                    // }
                    
                }else{
                    let url = '';
                    let id = '';
                    if (row.esnome == 'S2300') {
                        url = window.Laravel.esocial.trabalhador
                        id = btoa(row.trabalhador_id)
                    }else if (row.esnome == 'S1020') {
                        url = window.Laravel.esocial.tomador
                        id = btoa(row.tomador_id)
                    }else if (row.esnome == 'S1200') {
                        url = window.Laravel.esocial.folhar
                        id = btoa(row.folhar_id)
                    }
                    return evento(id,url,row.esnome);
                }
            }
            },
        ],
        
        "columnDefs": [
            { className: "copiaId", "targets": [ 3 ] }
        ],
       
        "language": {
            "infoEmpty": "mostrando",
            "search":         "Pesquisar",
            "info":           "Mostrando _START_ de _END_ registros",
            "infoFiltered":   "",
            "zeroRecords":    "Não há nenhum registro cadastrado <i class='fad fa-exclamation-triangle fa-lg' style='color: red !important;'>",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "emptyTable":     "Não há dados disponíveis na tabela",
            "loadingRecords": "Carregando...",
            "paginate": {
                "first":      "Primeira",
                "last":       "Última",
                "next":       "Próxima",
                "previous":   "Anterior"
            },
        }
    });
    
    
    
    
    
    
    function erros(dados,id) {
        
        return `
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEsocial${id}">
        <span class="badge bg-danger">Erros</span>
        </button>
        
        
        <div class="modal fade" id="modalEsocial${id}" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header header__modal">
                    <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-file-alt"></i> E-social</h5>
                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                
                <div class="modal-body body__modal">
                    <section  class="section__accoordion row">
                                    
                        <div class="accordion div__acordion" id="accordionFlushExample">
                            
                            
                            <div  class="accordion-item item__acorddion">
                                
                                <h2 class="accordion-header accoordion__header" id="retorno">
                                      <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#retornoEsocial${id}" aria-expanded="false" aria-controls="retornoEsocial">
                                            Retorno <i class="fad fa-retweet"></i>
                                      </button>
                                </h2>
                                
                                <div id="retornoEsocial${id}" class="accordion-collapse collapse" aria-labelledby="retorno" data-bs-parent="#accordionFlushExample${id}">
                                    
                                    <div id="endereco" class="accordion-body row">
                                        
                                        <section  class="row residencia">
                                           ${dados}
                                        </section>
                                    </div>
                                </div>
                                
                            </div>
                            
                          
                            
                        </div>
                        
                    </section>
                    
                </div>
                
                <div class="modal-footer">
                </div>
                
            </div>
        </div>
    </div>`
    }
    function xml(dados,id) {
        var xml = dados.data.xml.toString()
      
        return `
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEsocial${id}">
            <i class="fad fa-eye"></i>
        </button>
        
        
        <div class="modal fade" id="modalEsocial${id}" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header header__modal">
                    <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-file-alt"></i> E-social</h5>
                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                
                <div class="modal-body body__modal">
                    <section  class="section__accoordion row">
                                    
                        <div class="accordion div__acordion" id="accordionFlushExample">
                            
                            
                           
                            
                            <div  class="accordion-item item__acorddion">
                                
                                <h2 class="accordion-header accoordion__header" id="retornoXml">
                                      <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#retornoXml${id}" aria-expanded="false" aria-controls="retornoXml">
                                            XML Retorno <i class="fad fa-retweet"></i>
                                      </button>
                                </h2>
                                
                                <div id="retornoXml${id}" class="accordion-collapse collapse" aria-labelledby="retornoXml" data-bs-parent="#accordionFlushExample${id}">
                                    
                                    <div id="endereco" class="accordion-body row">
                                        
                                        <section  class="row residencia">
                                            <p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200">'
                                                    <foreignObject width="100%" height="100%">
                                                        ${xml}
                                                    </foreignObject>
                                                </svg>
                                            </p>
                                        </section>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </section>
                    
                </div>
                
                <div class="modal-footer">
                </div>
                
            </div>
        </div>
    </div>`
    }
  
    function evento(id,url,nome) {
        $(".enviar-evento").click(function() {
            let id = $(this).attr('data-id')
            let evento = $(this).attr('data-evento')
            Swal.fire({
                title: '<strong>Evento baixado com sucesso</strong>',
                icon: 'success',
                html: '<div class="progress mb-3" style="height: 12px;">' +
                '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
                '</div>' +
                '<p id="msg">Deseja Integrar esse arquivo com o E-SOCIAL?</p>',
                input: 'file',
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                showConfirmButton: true,
                confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
                confirmButtonColor: '#04888B',
                allowOutsideClick: false,
                allowEscapeKey: false,
                preConfirm: (event) => {
                if (event) {
                    var ext = ['text']
                    var type = event.type.split('/')
                    if (event.name.includes(evento) === false) {
                        $('#msg').text(`O txt passado não tem o evento correto. ${nome}`).addClass('text-danger')
                        $('#progress').text('0%').css({"width": "0%"}).removeClass('bg-success').addClass('bg-dange');
                        return false;
                    }else if(ext.indexOf(type[0]) === -1){
                        $('#msg').text('Não em um arquivo txt.').addClass('text-danger')
                        $('#progress').text('0%').css({"width": "0%"}).removeClass('bg-success').addClass('bg-dange');
                        return false;
                    }else{
                        $('#msg').text('Evento sendo enviado para SEFAZ.').removeClass('text-danger').addClass('text-black');
                        $('#progress').text('25%').css({"width": "25%"}).removeClass('bg-dange').addClass('bg-success');
                        var myFormData = new FormData();
                        myFormData.append('file', event);
                        gerarxml(myFormData,id,evento)
                    }  
                }
                return false;
                }
            })
        })
        return `
        <div class="dropdown">
            <button class="btn botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Evento
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li class=""><a class="dropdown-item modal-botao" href="${url}/${id}" id="baixarEvento" role="button">Baixar evento</li>
                <li class="enviar-evento" id="enviar-evento" data-evento="${nome}" data-id="${id}"><a class="dropdown-item modal-botao" href="#"  role="button">Enviar evento</li>           
            </ul>
        </div>`;
    }
    function gerarxml(dados,trabalhador,nome){

        $.ajax({
            url: "https://api.tecnospeed.com.br/esocial/v1/evento/enviar/tx2",
            type: "POST",
            data: dados,
            // dataType: 'json',
            processData: false,  
            // async:false,
            headers: {
                'content-type':'text/tx2',
                'cnpj_sh':'34350915000149',
                'token_sh':'3048136792bc6c57aecab949f3f79b74',
                'empregador':`${window.Laravel.empresa.cnpj}`
            },
            success: function(retorno){
                $('#msg').text('Lote Recebido com Sucesso.')
                $('#progress').text('50%').css({"width": "50%"});
                cadastra(retorno.data,trabalhador,nome)
                // setTimeout(consultaevento(retorno.data.id,trabalhador), 100000);
            },
            error: function () {
                $('#msg').text('Não foi porssivél realizar o processo');
                $('#progress').text('0%').css({"width": "0%"});
            },
         });
    }
    function cadastra(dados,id,nome) {
        $.ajax({
            url: `${window.Laravel.esocial.update}/${id}`,
            type: "PUT",
            data: {
                evento:nome,
                id:dados.id,
                codigo:dados.status_envio.codigo,
                status:dados.status_envio.mensagem
            },
            // dataType: 'json',
            // processData: false,  
            // async:false,
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrf
                // 'content-type':'text/tx2',
                // 'cnpj_sh':'34350915000149',
                // 'token_sh':'3048136792bc6c57aecab949f3f79b74',
                // 'empregador':'34350915000149'
            },
            success: function(retorno){
                // console.log(retorno);
                $('#progress').text('100%').css({"width": "100%"});
                $('#msg').text(retorno)
                // console.log(trabalhador);
                // buscaxml(retorno.data.eventos[0])
            }
         });
    }
    
})
