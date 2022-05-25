<div class="modal fade" id="modalCadAcesso" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header modalHeader">
                <h5 class="modal-title fw-bold" id="staticBackdropLabel1"><i class="fad fa-lg fa-user-plus"></i> Acessos Cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <section class="section__search">          
                    <div class="col-md-5">
                        <form action="{{route('usuario.create')}}" method="GET">
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="search">
                                <datalist id="listapesquisa"></datalist>
                                
                                <input type="hidden" name="codicao" value="{{isset($editar->id)?$editar->id:''}}">
                                
                                <button type="submit" class="btn botao__search">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                </button>

                            </div>
                        </form>
                    </div>
                </section>
 
                <section>
                    <div class="d-flex justify-content-end">
                        <div>
                            <div class="dropdown">
                                <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-sort"></i>
                                </button>
                                <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('usuario.ordem.admin',['asc',isset($editar->id)?$editar->id:''])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('usuario.ordem.admin',['desc',isset($editar->id)?$editar->id:''])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
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
                            @if(count($lista) > 0)
                            @foreach($lista as $key=>$valoruser)
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
                                          
                                          <?php
                                                $perm = [];
                                                foreach ($valoruser->permissions as $permissao) {
                                                    array_push($perm,$permissao->pivot->permission_id);
                                                }
                                            ?>
                                            @foreach($valoruser->permissions as $permissao)
                                                @if($permissao->pivot->model_type)
                                                    <li><a class="dropdown-item dropdown-item--filter botao-modal" href="{{route('permissao',[base64_encode($permissao->id),base64_encode($permissao->pivot->permission_id),'R'])}}">{{$permissao->name}}<i class="fas fa-check text-success"></i></a></li>
                                                @endif
                                            @endforeach
                                            @foreach($permissions as $p)
                                                @if(!in_array($p->id,$perm) && $p->id != 1)
                                                    <li><a class="dropdown-item dropdown-item--filter botao-modal" href="{{route('permissao',[base64_encode($valoruser->id),base64_encode($p->id),'D'])}}">{{$p->name}}<i class="fad fa-ban text-danger"></i></a></li>
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
                                            <a class="button__editar btn" href="{{route('usuario.edit', base64_encode($valoruser->id))}}"><i class="icon__color fas fa-pen"></i></a>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteCadAcesso">
                                            <i class="icon__color fad fa-trash"></i>
                                        </button>
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
                                    {{$lista->links()}}
                                  
                                    </td>
                                </tr>
                            </tfoot>
                        
                        </table>
            
                    </div>
                </section>
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>

              
<section class="delete__tabela--Acesso">
    <div class="modal fade" id="deleteCadAcesso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered col-8">
            <div class="modal-content">
                <form action="{{route('usuario.destroy',$valoruser->id)}}" id="formdelete" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-header header__modal">
                        <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                        <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    
                    <div class="modal-body body__modal ">
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <img class="gif__warning--delete" src="{{url('imagem/warning.gif')}}">
                            
                                <p class="content--deletar">Deseja realmente excluir?</p>
                                
                                <p class="content--deletar2">Obs: Ao excluir esse usuário perderá todo o acesso ao sistema.</p>
                                
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

</script>
                