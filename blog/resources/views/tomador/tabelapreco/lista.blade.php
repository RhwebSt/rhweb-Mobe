
<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1"><i class="fa-lg fad fa-sack-dollar"></i> Preços Cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search">
                    <div class="col-md-5">
                        <form action="{{route('tabelapreco.index',[$id, base64_encode($tomador)])}}" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="search">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="{{$id?$id:''}}">
                                
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
                                  <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.tabela.preco',[base64_encode($id), base64_encode($tomador),'asc'])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.tabela.preco',[base64_encode($id), base64_encode($tomador),'desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                
                
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:60px;">Ano</th>
                                    <th class="th__header text-nowrap">Código</th>
                                    <th class="th__header text-nowrap">Descrição</th>
                                    <th class="th__header text-nowrap" style="width:110px;">Valor Trab</th>
                                    <th class="th__header text-nowrap" style="width:110px;">Valor Tom</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                                
                                <tbody class="table__body">
                                @if(count($tabelaprecos) > 0)
                                  @foreach($tabelaprecos as $tabelapreco)
                                    <tr class="tr__body">
                                        <td class="td__body text-nowrap col" style="width:60px;">{{$tabelapreco->tsano}}</td>
                                        
                                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$tabelapreco->tsrubrica}}" style="max-width: 10ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                            <a>{{$tabelapreco->tsrubrica}}</a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$tabelapreco->tsdescricao}}" style="max-width: 60ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                                <a>{{$tabelapreco->tsdescricao}}</a>
                                        </td>
                                        
                                        <td class="td__body text-nowrap col" style="width:110px;">R$ {{number_format((float)$tabelapreco->tsvalor, 2, ',', '')}}</td>
                                        <td class="td__body text-nowrap col" style="width:110px;">R$ {{number_format((float)$tabelapreco->tstomvalor, 2, ',', '')}}</td>
                                        <td class="td__body text-nowrap col" style="width:60px;">
                                                <a href="{{route('tabela.preco.editar',[base64_encode($tabelapreco->id),base64_encode($tomador)])}}" class="button__editar btn modal-botao" ><i class="icon__color fas fa-pen"></i></a>
                                        </td>
                                        <td colspan="2" class="td__body text-nowrap col" style="width:60px;">
                                            <form action="{{route('tabelapreco.destroy',$tabelapreco->id)}}" method="post">
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
                                        <td colspan="11">
                                        {{ $tabelaprecos->links() }}
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


<section class="delete__tabela--tomador">
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
</section>