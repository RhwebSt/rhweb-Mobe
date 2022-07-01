<div class="modal fade" id="modalCertificado" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg me-1 fa-file-certificate"></i>Certificado Digital</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <form class="row g-3" id="form-certificado" action="" enctype="multipart/form-data" method="POST" autocomplete="false">
                    
                    <div class="col-md-12 div__input--foto">
                        <label for="formFileSm " class="form-label"><i class="fad fa-file-certificate"></i> Selecionar Certificado</label>
                        <input class="form-control form-control-sm color__input--foto" onchange="" id="certificado" type="file" accept=".pfx">
                    </div>
                    
                    <div class="col-md-12">
                          <label for="cnpjEmpregador" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Cnpj Empregador</label>
                          <input type="text" class="form-control" value="" name="cnpjEmpregador"  id="cnpjEmpregador" placeholder="Cnpj do Empregador" maxlength="40">
                          <span class="text-danger"></span>
                    </div>
                    
                    <div class="col-md-12">
                          <label for="razaoSocial" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Razão Social</label>
                          <input type="text" class="form-control" value="" name="razaoSocial"  id="razaoSocial" placeholder="digite sua razao social" maxlength="40">
                          <span class="text-danger"></span>
                    </div>
                    
                    <div class="col-md-12">
                          <label for="emailResponsavel" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Email do Responsável</label>
                          <input type="email" class="form-control" value="" name="emailResponsavel"  id="emailResponsavel" placeholder="digite seu email" maxlength="40" autocomplete="false">
                          <span class="text-danger"></span>
                    </div>
                    
                    <div class="col-md-12">
                          <label for="senhaCertificado" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Senha do Certificado</label>
                          <input type="password" class="form-control" value="" name="senhaCertificado"  id="senhaCertificado" placeholder="digite sua senha" maxlength="40" autocomplete="false" >
                          <span class="text-danger"></span>
                    </div>
                    
                    <div class="col-md-12">
                          <label for="apelidoCertificado" class="form-label"><i class="fa-sm required fas fa-asterisk" data-toggle="tooltip" data-placement="top" title="Campo obrigatório"></i> Apelido do Certificado</label>
                          <input type="text" class="form-control" value="" name="apelidoCertificado"  id="apelidoCertificado" maxlength="40" autocomplete="false" >
                          <span class="text-danger"></span>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button class="btn botao" type="submit">Enviar <i class="fad fa-file-import"></i></button>
                    </div>
                    
                </form>
                
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>



<section class="delete__tabela--Acesso">
    <div class="modal fade" id="deleteCertificado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered col-8">
            <div class="modal-content">
                <form action="" id="deleta-certificado" method="get">
                   
                    <div class="modal-header header__modal">
                        <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                        <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <input type="hidden" name="" id="cnpj" value="{{$user->empresa_id}}">
                    <div class="modal-body body__modal ">
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <img class="gif__warning--delete" src="{{url('imagem/complain.png')}}">
                            
                                <p class="content--deletar">Deseja realmente excluir?</p>
                                
                                <p class="content--deletar2">Obs: Ao excluir esse certificado não será possivel enviar os eventos para o E-social.</p>
                                
                            </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn botao__fechar--modal" data-bs-dismiss="modal"><i class="fad fa-times-circle"></i> Não</button>
                        <button type="submit" class="btn botao__deletar--modal  modal-botao"><i class="fad fa-trash"></i> Deletar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>