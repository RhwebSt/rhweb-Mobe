<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1">Comissionados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               
               <div class="d-flex justify-content-between">
                    <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                            <form action="{{route('tomador.index')}}" method="GET">
                                <div class="d-flex">
                                    <label for="exampleDataList" class="form-label"></label>
                                    <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                    <datalist id="listapesquisa">
                                    </datalist>
                                    <input type="hidden" name="codicao" value="{{isset($tomador->id)?$tomador->id:''}}">
                                    <button type="submit" class="modal-botao btn botaoPesquisa">
                                                <i class="fas fa-search fa-md iconsear" id="icon"></i>
                                    </button>
    
                                    <div class="text-center d-none p-1" id="refres">
                                        <div class="spinner-border" role="status" style="color:#FDFDFF; background-color: black; margin-top: 6px;width: 1.2rem; height: 1.2rem;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                            </form>
                        </div>
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
                                  <li><a class="dropdown-item dropdown__links--filter" href=""><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter" href=""><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
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
                                @foreach($comissionados as $comissionado)
                                <tr class="tr__body">               
                                    <td class="td__body text-nowrap col" style="width:115px;">{{$comissionado->tsmatricula}}</td>
                                    
                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comissionado->trabalhador}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                            <a>{{$comissionado->trabalhador}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col"style="width:200px">{{$comissionado->csindece}}</td>
                                    
                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$comissionado->tomador}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                            <a>{{$comissionado->tomador}}</a>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        
                                            <a class="button__editar btn modal-botao" href="{{route('comisionado.edit',$comissionado->id)}}"><i class="icon__color fas fa-pen"></i></a>
                                        
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <form action="{{route('comisionado.destroy',$comissionado->id)}}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn button__excluir modal-botao"><i class="icon__color fad fa-trash"></i></button>
                                        </form> 
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
                                            <ul class="pagination pagination__table pagination-sm">
                                                    <li class="">
                                                        <a class="page-link modal-botao" href=""></a>
                                                    </li>
                                            </ul>
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