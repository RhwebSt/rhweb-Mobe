<div class="modal fade" id="configuracoes" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-cogs"></i> Configurações</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <section  class="section__accoordion row">
                                
                    <div class="accordion div__acordion" id="accordionFlushExample">
                        
                        <div id="" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="aparenciaAccordion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#aparencia" aria-expanded="false" aria-controls="aparencia">
                                        <i class=" fa-lg fad me-1 fa-palette"></i> Aparência
                                  </button>
                            </h2>
                            
                            <div id="aparencia" class="accordion-collapse collapse" aria-labelledby="aparenciaAccordion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="" class="accordion-body">
                                    
                                    <p class="title-config">Temas</p>
                                    
                                    <div class="form-check form-switch d-flex justify-content-between div__darkmode">
                                        <label class="form-check-label align-self-center label-config" for="swicthDarkMode">Darkmode</label>
                                        <input class="form-check-input switchDark" type="checkbox" role="switch" id="swicthDarkMode">
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                    <p class="title-config">Fonte</p>
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center  label-config">Tamanho da Fonte</label>
                                        
                                        <select class="form-select select__font" id="select-font-size" aria-label="Default select example">
                                          <option value="16px">16px</option>
                                          <option value="18px">18px</option>
                                          <option value="20px">20px</option>
                                          <option value="22px">22px</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Formato da Fonte</label>
                                        
                                        <select class="form-select select__font" id="select-formato-font" aria-label="Default select example">
                                          <option value="padrao">Padrão</option>
                                          <option value="maiuscula">Maiúscula</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>

                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div id="" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="acessibilidadeAccordion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#acessibilidade" aria-expanded="false" aria-controls="acessibilidade">
                                        <i class="fad fa-lg me-1 fa-universal-access"></i> Acessibilidade
                                  </button>
                            </h2>
                            
                            <div id="acessibilidade" class="accordion-collapse collapse" aria-labelledby="acessibilidadeAccordion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="" class="accordion-body">
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Animações</label>
                                        
                                        <select class="form-select select__font" id="select-animacoes" aria-label="Default select example">
                                          <option value="true">Ativado</option>
                                          <option value="false">Desativado</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        
                        <div id="" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="esocialAccordion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#esocial" aria-expanded="false" aria-controls="esocial">
                                        <i class="fad fa-lg me-1 fa-file-certificate"></i> E-social
                                  </button>
                            </h2>
                            
                            <div id="esocial" class="accordion-collapse collapse" aria-labelledby="esocialAccordion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="" class="accordion-body">
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Enviar Certificado Digital</label>
                                        
                                        <button class="btn botao" data-bs-toggle="modal" data-bs-target="#modalCertificado">Enviar <i class="fad fa-file-import"></i></button>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Excluir Certificado Digital</label>
                                        
                                        <button class="btn button__excluir"  data-bs-toggle="modal" data-bs-target="#deleteCertificado">Excluir <i class="fad fa-trash"></i></button>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Situação Certificado Digital</label>
                                        
                                        <select class="form-select select__font" aria-label="Default select example"disabled>
                                            <option selected>Desabilitado</option>
                                            <option>Em análise</option>
                                            <option>Enviado</option>
                                            <option value="1">Inválido</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Deseja receber notifacação do E-social?</label>
                                        
                                        <select class="form-select select__font" aria-label="Default select example">
                                          <option value="true">Sim</option>
                                          <option value="false">Não</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        
                        <div id="" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="preferenciaAccordion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#preferencia" aria-expanded="false" aria-controls="preferencia">
                                        <i class="fad fa-lg me-1 fa-sliders-v"></i> Preferências
                                  </button>
                            </h2>
                            
                            <div id="preferencia" class="accordion-collapse collapse" aria-labelledby="preferenciaAccordion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="" class="accordion-body">
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Notificações</label>
                                        
                                        <select class="form-select select__font" aria-label="Default select example">
                                          <option selected value="true">Ativar</option>
                                          <option value="false">Desativar</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
                                    <div class="d-flex justify-content-between  div__config">
                                        <label class="align-self-center label-config">Preenchimento Automático</label>
                                        
                                        <select class="form-select select__font" id="preenchimentoAutomatico" aria-label="Default select example">
                                          <option value="true">Sim</option>
                                          <option value="false">Não</option>
                                        </select>
                                        
                                    </div>
                                    
                                    <p class="span__divisor"></p>
                                    
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
</div>
