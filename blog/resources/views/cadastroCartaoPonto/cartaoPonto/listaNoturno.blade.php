<div class="modal fade" id="listaNoturno" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1"><i class="fad fa-lg fa-moon"></i> Lista Noturno</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search">

                    <div class="col-md-5">
                        <form action="" method="GET">
                            <div class="d-flex">
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>
                                
                                <input type="hidden" name="codicao" value="">
                                
                                <button type="submit" class="btn botao__search modal-botao">
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
                                <th class="th__header text-nowrap" style="width:60px;">Mat</th>
                                <th class="th__header text-nowrap">Nome</th>
                                <th class="th__header text-nowrap" style="width:60px;">Entr</th>
                                <th class="th__header text-nowrap" style="width:60px;">Saída</th>
                                <th class="th__header text-nowrap" style="width:60px;">Entr</th>
                                <th class="th__header text-nowrap" style="width:60px;">Saída</th>
                                <th class="th__header text-nowrap" style="width:60px;">Hrs 50%</th>
                                <th class="th__header text-nowrap" style="width:60px;">Hrc 100%</th>
                                <th class="th__header text-nowrap" style="width:60px;">Adc.Not</th>
                                <th class="th__header text-nowrap" style="width:90px;">Total</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                            
                            <tbody class="table__body">
                            @if(count($lista) > 0)
                                @foreach($lista as $listas)
                                @if($listas->bsentradanoite && $listas->bsentradanoite ||
                                $listas->bsentradamadrugada && $listas->bssaidamadrugada)
                                <tr class="tr__body">
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->trabalhador->tsmatricula}}</td>
                                    <td class="td__body text-nowrap col limitaCarcteres" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$listas->trabalhador->tsnome}}">{{$listas->trabalhador->tsnome}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bsentradanoite}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bssaidanoite}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bsentradamadrugada}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bssaidamadrugada}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bshoraex}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bshoraexcem}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">{{$listas->bsadinortuno}}</td>
                                    <td class="td__body text-nowrap col" style="width:90px;">{{$listas->bstotal}}</td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="button__editar btn modal-botao" href=""><i class="icon__color fas fa-pen"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <form>
                                            <button type="submit" class="btn button__excluir modal-botao"><i class="icon__color fad fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                               @endif
                                @endforeach
                                @else
                                    <tr class="tr__body">
                                        <td colspan="11" class="no__register--table">Não há nenhum registro cadastrado <i class="fad fa-exclamation-triangle fa-lg"></td>
                                    </tr>
                                @endif
                            </tbody>
                            
                            <tfoot>
                                <tr class="">
                                    <td colspan="11">
                                    {{ $lista->links() }}
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
