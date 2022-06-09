<div class="modal fade" id="modalComissionado" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-percentage"></i> Comissionados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search">
                    
                    <div class="col-md-5">
                            <form action="{{route('comisionado.index')}}" method="GET">
                                
                                <div class="d-flex">
                                    
                                    <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="search">
                                    <datalist id="listapesquisa"></datalist>
                                    
                                    <input type="hidden" name="codicao" value="{{isset($tomador->id)?$tomador->id:''}}">
                                    
                                    <button type="submit" class="btn botao__search modal-botao">
                                        <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                    </button>

                            </form>
                        </div>
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
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href=""><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href=""><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                            
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:115px;">Matrícula</th>
                                <th class="th__header text-nowrap">Nome Trabalhador</th>
                                <th class="th__header text-nowrap" style="width:200px">Indice %</th>
                                <th class="th__header text-nowrap">Nome Tomador</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                            
                            <tbody class="table__body">
                                @if(count($comissionados) > 0)
                                @foreach($comissionados as $key => $comissionado)
                                <tr class="tr__body">               
                                    <td class="td__body text-nowrap col" style="width:115px;">{{$comissionado->tsmatricula}}</td>
                                    
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comissionado->trabalhador}}">
                                            <a>{{$comissionado->trabalhador}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col"style="width:200px">{{$comissionado->csindece}}</td>
                                    
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comissionado->tomador}}">
                                            <a>{{$comissionado->tomador}}</a>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        
                                            <a class="button__editar btn" href="{{route('comisionado.edit',$comissionado->id)}}"><i class="icon__color fas fa-pen"></i></a>
                                        
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                      
                                            <button class="btn button__excluir" data-bs-toggle="modal" data-bs-target="#deleteComissionado{{$key}}"><i class="icon__color fad fa-trash"></i></button>
                                        
                                        <section class="delete__tabela--comissionado">
                                            <div class="modal fade" id="deleteComissionado{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered col-8">
                                                    <div class="modal-content">
                                                        <form action="{{route('comisionado.destroy',$comissionado->id)}}" id="formdelete" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-header header__modal">
                                                                <h5 class="modal-title" id="rolDescontoTrabLabel"><i class="fad fa-trash"></i> Deletar</h5>
                                                                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
                                                            </div>
                                                            
                                                            <div class="modal-body body__modal ">
                                                                    <div class="d-flex align-items-center justify-content-center flex-column">
                                                                        <img class="gif__warning--delete" src="{{url('imagem/complain.png')}}">
                                                                    
                                                                        <p class="content--deletar">Deseja realmente excluir?</p>
                                                                        
                                                                        <p class="content--deletar2">Obs: Será excluído tudo o que há vinculado á este comissionado.</p>
                                                                        
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
                                <tr class="">
                                    <td colspan="11">
                                        <nav aria-label="Page navigation example">
                                            {{$comissionados->links()}}
                                        </nav>
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


