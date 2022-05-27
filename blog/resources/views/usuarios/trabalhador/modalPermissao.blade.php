<div class="modal fade" id="modalPermissao{{$key}}" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered col-8">
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <h5 class="modal-title fw-bold" id="staticBackdropLabel1"><i class="fad fa-lg fa-user-plus"></i> Permissões</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <h1 class="title__cadAcesso"><i class="fad fa-lg fa-user-plus"></i> Permissões</h1>
                
                <section  class="section__accoordion row">
                                
                    <div class="accordion div__acordion" id="accordionFlushExample">
                        
                        
                        
                        <!--inicio do cartão Ponto-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="cartaoPontoAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cartaoPonto" aria-expanded="false" aria-controls="cartaoPonto">
                                        <i class="me-1 fad fa-alarm-clock"></i> Boletim Cartão Ponto
                                  </button>
                            </h2>
                            
                            <div id="cartaoPonto" class="accordion-collapse collapse" aria-labelledby="cartaoPontoAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                     
                                          @foreach($valoruser->permissions as $permissao)
                                                @if($permissao->pivot->model_type && mb_strpos($permissao->name, 'mbcpc') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($permissao->pivot->permission_id)}}','R')" checked>
                                                
                                                @endif
                                            @endforeach
                                            @foreach($permissions as $p)
                                                @if(!in_array($p->id,$perm) && $p->id != 1 && mb_strpos($p->name, 'mbcpc') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($p->id)}}','D')">
                                                
                                                @endif
                                            @endforeach
                                      
                                      <label class="form-check-label title__switch" for="cadastrarCartaoPonto"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                    @foreach($valoruser->permissions as $permissao)
                                                @if($permissao->pivot->model_type && mb_strpos($permissao->name, 'mbcpd') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($permissao->pivot->permission_id)}}','R')" checked>
                                                
                                                @endif
                                            @endforeach
                                            @foreach($permissions as $p)
                                                @if(!in_array($p->id,$perm) && $p->id != 1 && mb_strpos($p->name, 'mbcpd') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($p->id)}}','D')">
                                                
                                                @endif
                                            @endforeach
                                      <label class="form-check-label title__switch" for="editarCartaoPonto"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                    @foreach($valoruser->permissions as $permissao)
                                                @if($permissao->pivot->model_type && mb_strpos($permissao->name, 'mbcpe') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($permissao->pivot->permission_id)}}','R')" checked>
                                                
                                                @endif
                                            @endforeach
                                            @foreach($permissions as $p)
                                                @if(!in_array($p->id,$perm) && $p->id != 1 && mb_strpos($p->name, 'mbcpe') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($p->id)}}','D')">
                                                
                                                @endif
                                            @endforeach
                                      <label class="form-check-label title__switch" for="excluirCartaoPonto"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                    @foreach($valoruser->permissions as $permissao)
                                                @if($permissao->pivot->model_type && mb_strpos($permissao->name, 'mbcpl') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($permissao->pivot->permission_id)}}','R')" checked>
                                                
                                                @endif
                                            @endforeach
                                            @foreach($permissions as $p)
                                                @if(!in_array($p->id,$perm) && $p->id != 1 && mb_strpos($p->name, 'mbcpl') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($p->id)}}','D')">
                                                
                                                @endif
                                            @endforeach
                                      <label class="form-check-label title__switch" for="lancamentoCartaoPonto"><i class="fad fa-eye"></i> Lançamento no Boletim</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                    @foreach($valoruser->permissions as $permissao)
                                                @if($permissao->pivot->model_type && mb_strpos($permissao->name, 'mbcpr') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($permissao->pivot->permission_id)}}','R')" checked>
                                                
                                                @endif
                                            @endforeach
                                            @foreach($permissions as $p)
                                                @if(!in_array($p->id,$perm) && $p->id != 1 && mb_strpos($p->name, 'mbcpr') !== false)
                                                <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCartaoPonto" onclick="permissao('{{base64_encode($valoruser->id)}}','{{base64_encode($p->id)}}','D')">
                                                
                                                @endif
                                            @endforeach
                                      <label class="form-check-label title__switch" for="relatorioCartaoPonto"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do cartão ponto-->
                        
                        <!--inicio do boletim com tabela-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="boletimTabelaAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#boletimTabela" aria-expanded="false" aria-controls="boletimTabela">
                                        <i class="me-1 fad fa-sack-dollar"></i> Boletim com Tabela
                                  </button>
                            </h2>
                            
                            <div id="boletimTabela" class="accordion-collapse collapse" aria-labelledby="boletimTabelaAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarBoletimTabela" checked>
                                      <label class="form-check-label title__switch" for="cadastrarBoletimTabela"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarBoletimTabela" checked>
                                      <label class="form-check-label title__switch" for="editarBoletimTabela"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirBoletimTabela" checked>
                                      <label class="form-check-label title__switch" for="excluirBoletimTabela"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="lancamentoBoletimTabela" checked>
                                      <label class="form-check-label title__switch" for="lancamentoBoletimTabela"><i class="fad fa-eye"></i> Lançamento no Boletim</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="relatorioBoletimTabela" checked>
                                      <label class="form-check-label title__switch" for="relatorioBoletimTabela"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do boletim com tabela-->
                        
                        
                         <!--inicio do cadastro de acesso-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="cadAcessoAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cadAcesso" aria-expanded="false" aria-controls="cadAcesso">
                                        <i class=" me-1 fad fa-user-lock"></i> Cadastro de Acesso
                                  </button>
                            </h2>
                            
                            <div id="cadAcesso" class="accordion-collapse collapse" aria-labelledby="cadAcessoAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarCadAcesso" checked>
                                      <label class="form-check-label title__switch" for="cadastrarCadAcesso"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarCadAcesso" checked>
                                      <label class="form-check-label title__switch" for="editarCadAcesso"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirCadAcesso" checked>
                                      <label class="form-check-label title__switch" for="excluirCadAcesso"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadPermissaoAcesso" checked>
                                      <label class="form-check-label title__switch" for="cadPermissaoAcesso"><i class="fad fa-user-lock"></i> Cadastrar permissão</label>
                                    </div>

                                
                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do cadastro de acesso-->
                        
                        
                        <!--inicio do calculo da folha-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="calculoFolhaAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#calculoFolha" aria-expanded="false" aria-controls="calculoFolha">
                                        <i class=" me-1 fad fa-calculator-alt"></i> Cálculo da Folha
                                  </button>
                            </h2>
                            
                            <div id="calculoFolha" class="accordion-collapse collapse" aria-labelledby="calculoFolhaAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="calcularCalFolha" checked>
                                      <label class="form-check-label title__switch" for="calcularCalFolha"><i class="fad fa-calculator-alt"></i> Calcular</label>
                                    </div>

                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirCalFolha" checked>
                                      <label class="form-check-label title__switch" for="excluirCalFolha"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="imprimirCalFolha" checked>
                                      <label class="form-check-label title__switch" for="imprimirCalFolha"><i class="fad fa-print"></i> Imprimir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="folhaAnaliticaCalFolha" checked>
                                      <label class="form-check-label title__switch" for="folhaAnaliticaCalFolha"><i class="fad fa-analytics"></i> Folha Analítica</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="sefipCalFolha" checked>
                                      <label class="form-check-label title__switch" for="sefipCalFolha"><i class="fad fa-file-alt"></i> Sefip</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="reciboCalFolha" checked>
                                      <label class="form-check-label title__switch" for="reciboCalFolha"><i class="fad fa-user"></i> Recibo</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="depositoCalFolha" checked>
                                      <label class="form-check-label title__switch" for="depositoCalFolha"><i class="fad fa-envelope-open-dollar"></i> Depósito</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="eventoCalFolha" checked>
                                      <label class="form-check-label title__switch" for="eventoCalFolha"><i class="fas fa-file-invoice"></i> Evento s-1270</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="rubricasCalFolha" checked>
                                      <label class="form-check-label title__switch" for="rubricasCalFolha"><i class="fas fa-file-invoice"></i> Rúbricas</label>
                                    </div>

                                
                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do calculo da folha-->
                        
                        
                        <!--inicio do comissionado-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="comissionadoAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comissionado" aria-expanded="false" aria-controls="comissionado">
                                        <i class=" me-1 fad fa-percentage"></i> Comissionado
                                  </button>
                            </h2>
                            
                            <div id="comissionado" class="accordion-collapse collapse" aria-labelledby="comissionadoAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarComissionado" checked>
                                      <label class="form-check-label title__switch" for="cadastrarComissionado"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarComissionado" checked>
                                      <label class="form-check-label title__switch" for="editarComissionado"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirComissionado" checked>
                                      <label class="form-check-label title__switch" for="excluirComissionado"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do comissionado-->
                        
                        
                        <!--inicio do desconto-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="descontoAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#desconto" aria-expanded="false" aria-controls="desconto">
                                        <i class=" me-1 fad fa-tags"></i> Desconto
                                  </button>
                            </h2>
                            
                            <div id="desconto" class="accordion-collapse collapse" aria-labelledby="descontoAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarDesconto" checked>
                                      <label class="form-check-label title__switch" for="cadastrarDesconto"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarDesconto" checked>
                                      <label class="form-check-label title__switch" for="editarDesconto"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirDesconto" checked>
                                      <label class="form-check-label title__switch" for="excluirDesconto"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="relatorioDesconto" checked>
                                      <label class="form-check-label title__switch" for="relatorioDesconto"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do desconto-->
                        
                        
                        <!--inicio da fatura-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="descontoAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fatura" aria-expanded="false" aria-controls="fatura">
                                        <i class=" me-1 fad fa-calculator-alt"></i>Fatura
                                  </button>
                            </h2>
                            
                            <div id="fatura" class="accordion-collapse collapse" aria-labelledby="descontoAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="gerarFatura" checked>
                                      <label class="form-check-label title__switch" for="gerarFatura"><i class="fad fa-calculator-alt"></i> Gerar</label>
                                    </div>
                                    
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirFatura" checked>
                                      <label class="form-check-label title__switch" for="excluirFatura"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="relatorioFatura" checked>
                                      <label class="form-check-label title__switch" for="relatorioFatura"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim da fatura-->
                        
                        
                        <!--inicio do trabalhador-->
                        
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="trabAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#trabalhador" aria-expanded="false" aria-controls="trabalhador">
                                        <i class="me-1 fad fa-user-hard-hat"></i> Trabalhador
                                  </button>
                            </h2>
                            
                            <div id="trabalhador" class="accordion-collapse collapse" aria-labelledby="trabAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarTrabalhador" checked>
                                      <label class="form-check-label title__switch" for="cadastrarTrabalhador"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarTrabalhador" checked>
                                      <label class="form-check-label title__switch" for="editarTrabalhador"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirTrabalhador" checked>
                                      <label class="form-check-label title__switch" for="excluirTrabalhador"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="depedenteTrabalhador" checked>
                                      <label class="form-check-label title__switch" for="depedenteTrabalhador"><i class="fad fa-users"></i> Depedente</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="eventoTrabalhador" checked>
                                      <label class="form-check-label title__switch" for="eventoTrabalhador"><i class="fas fa-file-invoice"></i> Evento s-2300</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="relatorioTrabalhador" checked>
                                      <label class="form-check-label title__switch" for="relatorioTrabalhador"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>
                                
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <!--fim do trabalhador-->
                        
                        
                        <!--inicio do tomador-->
                        
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="tomadorAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tomador" aria-expanded="false" aria-controls="tomador">
                                        <i class="me-1 fad fa-industry"></i> Tomador
                                  </button>
                            </h2>
                            
                            <div id="tomador" class="accordion-collapse collapse" aria-labelledby="tomadorAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarTomador" checked>
                                      <label class="form-check-label title__switch" for="cadastrarTomador"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarTomador" checked>
                                      <label class="form-check-label title__switch" for="editarTomador"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirTomador" checked>
                                      <label class="form-check-label title__switch" for="excluirTomador"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="depedenteTomador" checked>
                                      <label class="form-check-label title__switch" for="depedenteTomador"><i class="fas fa-dollar-sign"></i> Tabela de preço</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="eventoTomador" checked>
                                      <label class="form-check-label title__switch" for="eventoTomador"><i class="fas fa-file-invoice"></i> Evento s-1020</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="relatorioTomador" checked>
                                      <label class="form-check-label title__switch" for="relatorioTomador"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>
                                
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <!--fim do tomador-->
                        
                        
                        <!--inicio do recibo avulso-->
                        <div id="divEndereco" class="accordion-item item__acorddion">
                        
                            <h2 class="accordion-header accoordion__header" id="reciboAvulsoAcorddion">
                                  <button class="accordion-button button__accoordion collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reciboAvulso" aria-expanded="false" aria-controls="reciboAvulso">
                                        <i class=" me-1 fad fa-calculator-alt"></i>Recibo Avulso
                                  </button>
                            </h2>
                            
                            <div id="reciboAvulso" class="accordion-collapse collapse" aria-labelledby="reciboAvulsoAcorddion" data-bs-parent="#accordionFlushExample">
                                
                                <div id="divTrab" class="accordion-body">
                                    
                                
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="cadastrarReciboAvulso" checked>
                                      <label class="form-check-label title__switch" for="cadastrarReciboAvulso"><i class="fad fa-user-plus"></i> Cadastrar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="editarReciboAvulso" checked>
                                      <label class="form-check-label title__switch" for="editarReciboAvulso"><i class="fad fa-pen"></i> Editar</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="excluirReciboAvulso" checked>
                                      <label class="form-check-label title__switch" for="excluirReciboAvulso"><i class="fad fa-trash"></i> Excluir</label>
                                    </div>
                                    
                                    <div class="form-check form-switch div__switch">
                                      <input class="form-check-input" type="checkbox" role="switch" id="relatorioReciboAvulso" checked>
                                      <label class="form-check-label title__switch" for="relatorioReciboAvulso"><i class="fas fa-file-alt"></i> Relatório</label>
                                    </div>

                                </div>
                                
                            </div>
                            
                        </div>
                        <!--fim do recibo avulso-->
                        
                    </div>
                    
                </section>
                
                
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>
<script>
  function permissao(trabalhador,permissao,condicao) {
    console.log(permissao,trabalhador);
    $.ajax({
      url: `{{url('permissao')}}/${trabalhador}/${permissao}/${condicao}`,
      type: 'get',
      contentType: 'application/json',
      success: function(data) {
       
      }
    })
  }
</script>

              

                