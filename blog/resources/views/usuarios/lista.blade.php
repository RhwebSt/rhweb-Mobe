<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header modalHeader">
                        <h5 class="modal-title fw-bold" id="staticBackdropLabel1">Acessos Cadastrados</h5>
                        <button type="button " class="btn-close modalClose" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body modalBody">
                          
                            <div class="col-md-5 mb-4 p-1 mt-2 pesquisar">
                                <form action="{{route('user.create')}}" method="GET">
                                    <div class="d-flex">
                                        <label for="exampleDataList" class="form-label"></label>
                                        <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                        <datalist id="listapesquisa">
                                        </datalist>
                                        <input type="hidden" name="codicao" value="{{isset($editar->id)?$editar->id:''}}">
                                        <button type="submit" class="modal-botao btn botaoPesquisa">
                                            <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                        </button>
                                       
                                        <div class="text-center d-none p-1" id="refres" >
                                            <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                                              <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                
                            </div>

                            
                    
                     <section>
                        <div class="d-flex justify-content-end">
                            <div>
                                <div class="dropdown">
                                    <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fad fa-sort"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.pesquisa.user',['asc',isset($editar->id)?$editar->id:''])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                      <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.pesquisa.user',['desc',isset($editar->id)?$editar->id:''])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                    </ul>
                                  </div>
                            </div>
    
                        </div>
                    </section>
                             
                    <section class="table">    
                        <div class="table-responsive-xxl">
                            <table class="table">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap">Usuário</th>
                                    <th class="th__header text-nowrap">Email</th>
                                    <th class="th__header text-nowrap" style="width:120px;">Cargo</th>
                                    <th class="th__header text-nowrap" style="width:100px;">Permissão</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                <tbody class="table__body">
                                @if(count($users) > 0)
                                @foreach($users as $key=>$valoruser)
                                    <tr class="tr__body">   
                                        
                                      
           
                                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$valoruser->name}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$valoruser->name}}</td>
                                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$valoruser->email}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$valoruser->email}}</td>
                                        <td class="td__body text-nowrap col" style="width:120px;">{{$valoruser->cargo}}</td>
                                        
                                        <td class="td__body text-nowrap col" style="width:100px;">
                                            <div class="dropdown">
                                              <button class="btn btn__permissao dropdown-toggle" type="button" id="dropdownMenuButton{{$key}}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fad fa-user-lock"></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$key}}">
                                              
                                                  @foreach($permissao as $permisso)
                                                    @if($valoruser->id === $permisso->model_id && $permisso->name === 'user')
                                                        @if($permisso->model_type)
                                                            <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($valoruser->id),base64_encode($permisso->permission_id),'R'])}}">Bloquear</a></li>
                                                        @else
                                                        <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($valoruser->id),base64_encode($permisso->permission_id),'D'])}}">Bloqueador <i class="fa-solid fa-ban"></i></a></li>
                                                        @endif
                                                    @elseif($valoruser->id === $permisso->model_id && $permisso->name !== 'user')
                                                        @if($permisso->model_type)
                                                            <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($valoruser->id),base64_encode($permisso->permission_id),'R'])}}">{{$permisso->name}} <i class="fas fa-check text-success"></i></a></li>
                                                        @else
                                                        <li><a class="dropdown-item botao-modal" href="{{route('permissao',[base64_encode($valoruser->id),base64_encode($permisso->permission_id),'D'])}}">{{$permisso->name}} <i class="fa-solid fa-xmark"></i></a></li>
                                                        @endif
                                                    @endif
                                                    
                                                  @endforeach
        
                                                
                                                  
        
                                                    <!-- <li><a class="dropdown-item botao-modal" href="#">Cadastro <i class="fas fa-check text-success"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Rotina Mensal <i class="fad fa-check"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Fatura <i class="fad fa-check"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Recibo Avulso <i class="fad fa-check"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Cadastro de Acesso <i class="fad fa-check"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Excluir <i class="fad fa-check"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Editar <i class="fad fa-check"></i></a></li>
                                                    <li><a class="dropdown-item botao-modal" href="#">Relatórios <i class="fad fa-check"></i></a></li> -->
                                              </ul>
                                            </div>
                                        </td>
        
                                        
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                                <a class="button__editar btn modal-botao" href="{{route('usuario.edit', base64_encode($valoruser->id))}}"><i class="icon__color fas fa-pen"></i></a>
                                        </td>
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                            <button class="btn button__excluir modal-botao" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$key}}">
                                                <i class="icon__color fad fa-trash"></i>
                                            </button>
                                            <div class="modal fade" id="staticBackdrop{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <form action="{{route('usuario.destroy',$valoruser->id)}}"  method="post">
                                                      @csrf
                                                      @method('delete')
                                                      <div class="modal-header modal__delete">
                                                      <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                                      <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body modal-delbody">
                                                          <p class="mb-1 text-start">Deseja realmente excluir?</p>
                                                      </div>
                                                      <div class="modal-footer modal-delfooter">
                                                      <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                                      <button type="submit" class="btn btn__deletar">Deletar</button>
        
                                                      </div>
                                                  </form>
                                              </div>
                                              </div>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr class="tr__body">
                                    <td colspan="7" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr class=" border-bottom">
                                        <td colspan="11">
                                        @if ($users->lastPage() > 1)
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination__table pagination-sm">
        
                                                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                                                        <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : ''     }}">
                                                            <a class="page-link modal-botao" href="{{ $users->url($i) }}">{{ $i }}</a>
                                                        </li>
                                                        @endfor
        
        
                                                </ul>
                                            </nav>
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            
                        </table>
                
                    </div>
                                </div>
                              <!--<div class="modal-footer">-->
                              <!--</div>-->
                            </div>
                          </div>
                        </div>
                            
                            
                             
                          </div>
              
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" id="formdelete" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-header modal__delete">
                                <h5 class="modal-title text-white fs-5" id="staticBackdropLabel">Excluir</h5>
                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modal-delbody">
                                    <p class="mb-1 text-start">Deseja realmente excluir?</p>
                                </div>
                                <div class="modal-footer modal-delfooter">
                                <button type="button" class="btn btn__fechar" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn__deletar">Deletar</button>

                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <script>
                
                function togglePermissao(idIcone, idBotao){
              
                    var verificaClasse = document.querySelector(idIcone);
                    const botaoTeste = document.querySelector(idBotao);
                    
                    botaoTeste.addEventListener('click', function(){
                        const classe = verificaClasse.classList;
                        var result = classe.toggle("fa-times");
                        
                        if(result == true){
                            verificaClasse.classList.remove('text-success');
                            verificaClasse.classList.add('text-danger');
                        }else{
                            verificaClasse.classList.remove('text-danger');
                            verificaClasse.classList.add('text-success');
                        }
                        console.log(classe.value);
                    });
                
                }
                
                var permissaoCadastro = togglePermissao("#iconeCadastro","#botaoCadastro");
                
                
                
                            
                //             var valueClass = campos.classList.value

                //             if(valueClass == "fad fa-check"){
                //                 console.log("clicou");
                //                 campos.classList.remove("fad", "fa-check");
                //                 campos.classList.add("fad", "fa-times");
                                
                //             }
                            
                //             if(valueClass == "fad fa-times");{
                //                 campos.classList.add("fad", "fa-check");
                //                 campos.classList.remove("fad", "fa-times");
                //             }

                    

                
            //         function filtro(){
            //     var campoFiltro = document.querySelector("#campoFiltro");
          
            //   campoFiltro.addEventListener('input', function(){
            //       var descricoes = document.querySelectorAll(".filtro");
                    
            //         if (this.value.length > 0) {
            //             for(i = 0; i < descricoes.length; i++){
            //                 var descricao = descricoes[i];
            //                 var tdnome = descricao.querySelector(".texto");
            //                 var nome = tdnome.textContent
            //                 var expressao = new RegExp(this.value, "i");
            //                 if (!expressao.test(nome)) {
            //                     descricao.classList.add("invisivel");
            //                 } else {
            //                     descricao.classList.remove("invisivel");
            //                 }
            //                 console.log(nome);
            //             }
            //         }else{
            //             for(i = 0; i < descricoes.length; i++){
            //                 var descricao = descricoes[i];
            //                 descricao.classList.remove("invisivel");
            //             }
            //         }
                    
            //   });
            // }

            // filtro();
                </script>
                