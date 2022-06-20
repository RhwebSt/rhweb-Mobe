$(document).ready(function(){
    
    $('#tabelaEsocial').DataTable({
      
        processing:true,
        serverSide:true,
        'ajax':{
            url:`${window.Laravel.esocial.show}`,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': window.Laravel.csrf
            }
        },
        
        'columns':[
            {'data':'id'},
            {'data':'tsmatricula'},
            {'data':'tsnome'},
            {'data':'esid'},
            {'data':'esstatus'},
            {'data':'esid',
            render: function(data, type, row){
                let dados = '';
                if (data != null)
               
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
                        'empregador':'34350915000149'
                    },
                    success: function(retorno){
                        dados = retorno;
                    }
                 });
                return erros(dados)
            }
            },
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
    function erros(dados) {
        
        return `
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEsocial">
          Visualizar
        </button>
        
        
        <div class="modal fade" id="modalEsocial" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header header__modal">
                    <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-file-alt"></i> E-social</h5>
                    <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                
                <div class="modal-body body__modal">
                    <section  class="section__accoordion row">
                                    
                        <div class="accordion div__acordion" id="accordionFlushExample">
                            
                            
                            <div id="retornoEsocial" class="accordion-item item__acorddion">
                                
                                <h2 class="accordion-header accoordion__header" id="retorno">
                                      <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#retornoEsocial" aria-expanded="false" aria-controls="retornoEsocial">
                                            Retorno <i class="fad fa-retweet"></i>
                                      </button>
                                </h2>
                                
                                <div id="retornoEsocial" class="accordion-collapse collapse" aria-labelledby="retorno" data-bs-parent="#accordionFlushExample">
                                    
                                    <div id="endereco" class="accordion-body row">
                                        
                                        <section  class="row residencia">
                                            <xml>${dados.data.xml}</xml>
                                        </section>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div id="retornoXml" class="accordion-item item__acorddion">
                                
                                <h2 class="accordion-header accoordion__header" id="retornoXml">
                                      <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#retornoXml" aria-expanded="false" aria-controls="retornoXml">
                                            XML Retorno <i class="fad fa-retweet"></i>
                                      </button>
                                </h2>
                                
                                <div id="retornoXml" class="accordion-collapse collapse" aria-labelledby="retornoXml" data-bs-parent="#accordionFlushExample">
                                    
                                    <div id="endereco" class="accordion-body row">
                                        
                                        <section  class="row residencia">
                                            <p></p>
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
})