<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-black" id="staticBackdropLabel1">Boletins cadastrados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          
                            
                          
                           <div class="d-flex justify-content-between">
                                
                                <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                                    <form action="{{  route('tabcartaoponto.index')}}" method="GET">
                                        <div class="d-flex">
                                            <label for="exampleDataList" class="form-label"></label>
                                            <input placeholder="Pesquisa..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                            <datalist id="listapesquisa">
                                            </datalist>
                                            <input type="hidden" name="codicao" value="{{isset($dados->id)?$dados->id:null}}">
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
        
                                <!--<div class="dropdown  mt-2 p-1">-->
                                <!--    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#111317; color: white;">-->
                                <!--        <i class="fad fa-sort"></i> Filtro -->
                                <!--    </button>-->
                                <!--    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">-->
                                <!--    <li><a class="dropdown-item text-white modal-botao" id="ordemCres" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','asc'])}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>-->
                                <!--    <li><a class="dropdown-item text-white modal-botao" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>-->
                                <!--    </ul>-->
                                <!--</div>-->
                                
                            </div>
                            
                            <section>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fad fa-sort"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                                <li><a class="dropdown-item dropdown__links--filter" id="ordemCres" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','asc'])}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                                <li><a class="dropdown-item dropdown__links--filter" href="{{route('edit.ordem.tabela.cartao.ponto',[isset($dados->id)?$dados->id:' ','desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                            </ul>
                                          </div>
                                    </div>
            
                                </div>
                            </section>
                            
                            <section class="table">
                                <div class="table-responsive-xxl">
                                    <table class="table">
                                        <thead class="tr__header">
                                            <th class="th__header text-nowrap">Nome do Trabalhador</th>
                                            <th class="th__header text-nowrap" style="width:70px">Cod</th>
                                            <th class="th__header text-nowrap">Descrição</th>
                                            <th class="th__header text-nowrap" style="width:100px">Quantidade</th>
                                            <th class="th__header text-nowrap" style="width:170px">Valor Unitário</th>
                                            <th class="th__header text-nowrap" style="width:170px">Total R$</th>
                                            <th class="th__header text-nowrap" style="width:70px">Editar</th>
                                            <th class="th__header text-nowrap" style="width:70px">Excluir</th>
                                        </thead>
                                        <tbody class="table__body">
                                            @if(count($lista) > 0)
                                            @foreach($lista as $listas)
                                                <tr class="tr__body">
                                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->tsnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->tsnome}}</td>
                                                    <td class="td__body text-nowrap col" style="width:70px">{{$listas->licodigo}}</td>
                                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->lshistorico}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">{{$listas->lshistorico}}</td>
                                                    <td class="td__body text-nowrap col" style="width:100px">
                                                        
                                                        @if(str_contains($listas->lsquantidade,':'))
                                                                {{$listas->lsquantidade}}
                                                        @else
                                                                {{number_format((float)$listas->lsquantidade, 2, ',', '.')}}
                                                        @endif
                                                    </td>
                                                    <td class="td__body text-nowrap col" style="width:170px">R$ {{number_format((float)$listas->lfvalor, 2, ',', '')}}</td>
                                                    <td class="td__body text-nowrap col" style="width:170px">R$ {{number_format((float)calculovalores($listas->lsquantidade , $listas->lfvalor), 2, ',', '')}}</td>
                                                    <td class="td__body text-nowrap col" style="width:70px">
                                                        <a href="{{route('boletim.tabela.edit',[base64_encode($quantidade),base64_encode($boletim),base64_encode($tomador),base64_encode($listas->lancamento),base64_encode($listas->id),base64_encode($data)])}}" class="button__editar btn" ><i class="icon__color fas fa-pen"></i></a>
                                                    </td>
                                                    <td class="td__body text-nowrap col" style="width:70px">
                                                        
                                                        <form action="{{route('tabcadastro.destroy',$listas->id)}}"  method="post">
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
                                            <tr>
                                                <td colspan="8" class="text-end">
                                                    @if ($lista->lastPage() > 1)
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination pagination__table pagination-sm">
                                                           
                                                            @for ($i = 1; $i <= $lista->lastPage(); $i++)
                                                                <li class="page-item {{ ($lista->currentPage() == $i) ? ' active' : ''     }}">
                                                                    <a class="page-link modal-botao" href="{{ $lista->url($i) }}">{{ $i }}</a>
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
                            </section>
                            
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