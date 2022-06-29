

// $(document).ready(function(){
//     data =  new Date
//     $('.btn__padrao--evento').click(function () {
//         console.log('ok');
//         let trabalhador = $(this).attr('data-id')
//         Swal.fire({
//             title: '<strong>Evento baixado com sucesso</strong>',
//             icon: 'success',
//             html: '<div class="progress mb-3" style="height: 12px;">' +
//             '<div class="progress-bar bg-success" role="progressbar" id="progress" style="width: 0;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>' +
//             '</div>' +
//             '<p id="msg">Deseja Integrar esse arquivo com o E-SOCIAL?</p>',
//             input: 'file',
//             showCloseButton: true,
//             showCancelButton: false,
//             focusConfirm: false,
//             showConfirmButton: true,
//             confirmButtonText: 'Enviar <i class="fas fa-paper-plane"></i>',
//             confirmButtonColor: '#04888B',
//             allowOutsideClick: false,
//             allowEscapeKey: false,
//             preConfirm: (event) => {
//                 console.log(event);
//             if (event) {
//                 var ext = ['text']
//                 var type = event.type.split('/')
//                 if (ext.indexOf(type[0]) !== -1) {
//                     $('#msg').text('Evento sendo enviado para SEFAZ.')
//                     $('#progress').text('25%').css({"width": "25%"});
//                     var myFormData = new FormData();
//                     myFormData.append('file', event);
//                     gerarxml(myFormData,trabalhador)
//                 }  
//             }
//             return false;
//             }
//         })
//     })
        
//     function gerarxml(dados,trabalhador){

//         $.ajax({
//             url: "https://api.tecnospeed.com.br/esocial/v1/evento/gerar/xml",
//             type: "POST",
//             data: dados,
//             // dataType: 'json',
//             processData: false,  
//             // async:false,
//             headers: {
//                 'content-type':'text/tx2',
//                 'cnpj_sh':'34350915000149',
//                 'token_sh':'3048136792bc6c57aecab949f3f79b74',
//                 'empregador':'26844068000140'
//             },
//             success: function(retorno){
//                 $('#msg').text('Lote Recebido com Sucesso.')
//                 $('#progress').text('50%').css({"width": "50%"});
//                 cadastra(retorno.data,trabalhador)
//                 // setTimeout(consultaevento(retorno.data.id,trabalhador), 100000);
//             },
//             error: function () {
//                 $('#msg').text('Não foi porssivél realizar o processo');
//                 $('#progress').text('0%').css({"width": "0%"});
//             },
//          });
//     }
//     function consultaevento(id,trabalhador) {
//         $.ajax({
//             url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/${id}?ambiente=2&versaomanual=2.5.00`,
//             type: "GET",
//             // data: dados,
//             // dataType: 'json',
//             processData: false,  
//             // async:false,
//             headers: {
//                 // 'content-type':'text/tx2',
//                 'cnpj_sh':'34350915000149',
//                 'token_sh':'3048136792bc6c57aecab949f3f79b74',
//                 'empregador':'34350915000149'
//             },
//             success: function(retorno){
//                 console.log(retorno);
//                 $('#progress').text('75%').css({"width": "75%"});
//                 $('#msg').text('Cadastrando no banco.')
//                 // consultaidevento(retorno)
//                 cadastra(retorno.data,trabalhador)
//                 // buscaxml(retorno.data.eventos[0])
//             }
//          });
//     }
//     function consultaidevento(dados) {
//         $.ajax({
//             url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/idevento/${dados.data.eventos[0].id}?ambiente=2&empregador=${dados.data.cnpj_sh}`,
//             type: "GET",
//             // data: dados,
//             // dataType: 'json',
//             processData: false,  
//             // async:false,
//             headers: {
//                 // 'content-type':'text/tx2',
//                 'cnpj_sh':'34350915000149',
//                 'token_sh':'3048136792bc6c57aecab949f3f79b74',
//                 'empregador':'34350915000149'
//             },
//             success: function(retorno){
//                 // console.log(retorno);
//                 $('#progress').text('75%').css({"width": "75%"});
//                 $('#msg').text('Cadastrando no banco.')
//                 // cadastra(retorno.data,trabalhador)
//                 // buscaxml(retorno.data.eventos[0])
//             }
//          });
//     }
//     function cadastra(dados,id) {
//         $.ajax({
//             url: `${window.Laravel.esocial.update}/${id}`,
//             type: "PUT",
//             data: {
//                 id:dados.id,
//                 codigo:dados.status_envio.codigo,
//                 status:dados.status_envio.mensagem
//             },
//             // dataType: 'json',
//             // processData: false,  
//             // async:false,
//             headers: {
//                 'X-CSRF-TOKEN': window.Laravel.csrf
//                 // 'content-type':'text/tx2',
//                 // 'cnpj_sh':'34350915000149',
//                 // 'token_sh':'3048136792bc6c57aecab949f3f79b74',
//                 // 'empregador':'34350915000149'
//             },
//             success: function(retorno){
//                 // console.log(retorno);
//                 $('#progress').text('100%').css({"width": "100%"});
//                 $('#msg').text(retorno)
//                 // console.log(trabalhador);
//                 // buscaxml(retorno.data.eventos[0])
//             }
//          });
//     }
  
//     // function consultaempregado() {
      
//     //     $.ajax({
//     //         url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/empregador/${window.Laravel.empresa.cnpj}?ambiente=1&datainicial=${data.getFullYear()}-${data.getMonth() < 9?'0':''}${data.getMonth()+1}-01&datafinal=${data.getFullYear()}-${data.getMonth() < 9?'0':''}${data.getMonth()+1}-30&pagina=20&limite=100`,
//     //         type: "GET",
//     //         // data: dados,
//     //         // dataType: 'json',
//     //         processData: false,  
//     //         headers: {
//     //             // 'content-type':'text/tx2',
//     //             'cnpj_sh':`${window.Laravel.empresa.cnpj}`,
//     //             'token_sh':'3048136792bc6c57aecab949f3f79b74',
//     //             'empregador':`${window.Laravel.empresa.cnpj}`
//     //         },
           
//     //         success: function(retorno){
//     //             // console.log(retorno);
//     //             retorno.data.forEach(element => {
//     //                 consultaevento(element._id)
//     //             });
               
//     //         }
//     //     });
//     // }
//     // consultaempregado()
    
//     // function consultaevento(id) {
//     //     $.ajax({
//     //         url: `https://api.tecnospeed.com.br/esocial/v1/evento/consultar/${id}?ambiente=1&versaomanual=S.01.00.00`,
//     //         type: "GET",
//     //         // data: dados,
//     //         // dataType: 'json',
//     //         processData: false,  
//     //         // async:false,
//     //         headers: {
//     //             // 'content-type':'text/tx2',
//     //             'cnpj_sh':`${window.Laravel.empresa.cnpj}`,
//     //             'token_sh':'3048136792bc6c57aecab949f3f79b74',
//     //             'empregador':`${window.Laravel.empresa.cnpj}`
//     //         },
//     //         success: function(retorno){
//     //             // console.log(retorno);
//     //                 let notificacao = `<div class="body__notification" id="notification">
//     //                         <div class="d-flex flex-row justify-content-between header__notification">
                            
//     //                             <div class="">
//     //                                 <p class="content__header-notification">Rhweb <i id="notification__icon-no-read" class="fas fa-circle notification__icon-no-read"></i></p>
//     //                             </div>
                                
//     //                             <div class="">
//     //                                 <p class="content__header-notification">
                                    
//     //                                 </p>
//     //                             </div>
                                
//     //                         </div>
                        

                        
//     //                         <div class="teste">
//     //                             <p class="text__body--notification">
//     //                                 Protocolo:${retorno.data.protocolo}<br>
//     //                                 Mensagem de Retorno:${retorno.data.status_consulta.mensagem}<br> 
//     //                                 Id do Lote: ${retorno.data.id}<br>
//     //                                 ${evento(retorno.data)}
//     //                             </p>
//     //                         </div>
                        
//     //                         <div class="d-flex justify-content-end footer-notification">
//     //                             <form action=""></form>
//     //                             <div class="content__footer-notification">
//     //                                 <a href="#"><i class="fas icone__footer-notification fa-trash"></i></a>
//     //                             </div>
//     //                         </div>
                            
//     //                     </div>`;
//     //                 $('#notificacaocontaine').prepend(notificacao);
             
//     //         }
//     //      });
//     // }
//     // function evento(dados) {
//     //     let ocorrencias = '';
//     //     dados.eventos[0].ocorrencias.forEach(element => {
//     //         ocorrencias += `
//     //         Ocorrencia: ${element.tipo}<br>
//     //         Código: ${element.codigo}<br>
//     //         Descrição:${element.descricao}<br>`
//     //     });
//     //     let notificacao = `  
//     //     Id Evento: ${dados.eventos[0].id}<br>
//     //     Número Recibo: <br>
//     //     Código de Status: ${dados.eventos[0].status.codigo}<br>
//     //     Mensagem: ${dados.eventos[0].status.mensagem}<br>
//     //     ${ocorrencias}`;
//     //     return notificacao;
//     // }
// })