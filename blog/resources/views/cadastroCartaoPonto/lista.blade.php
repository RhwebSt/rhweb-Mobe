
<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1">Boletins cadastrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                        <form action="{{  route('cadastrocartaoponto.index')}}" method="GET">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa">
                                </datalist>
                                <input type="hidden" name="codicao" value="{{isset($dados->id)?$dados->id:null}}">
                                <button type="submit" class="modal-botao btn botaoPesquisa modal-botao">
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
                                    <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.cadastro.cartao.ponto',[isset($dados->id)?$dados->id:' ','asc'])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                    <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.cadastro.cartao.ponto',[isset($dados->id)?$dados->id:' ','desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                
                <section class="table">
                    <div class="table-responsive-xxl">
                        <table class="table">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:115px;">Boletim</th>
                                <th class="th__header text-nowrap" style="width:400px;">Tomador</th>
                                <th class="th__header text-nowrap " style="width:200px">Data</th>
                                <th class="th__header text-nowrap" style="width:200px">Quant</th>
                                <th class="th__header text-nowrap" style="width:60px">Feriado</th>
                                <th class="th__header text-nowrap" style="width:60px">Relatório</th>
                                <th class="th__header text-nowrap" style="width:60px">Boletim</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                            <tbody class="table__body">
                                @if(count($lancamentotabelas) > 0)
                                @foreach($lancamentotabelas as $lancamentotabela)
                                <tr class="tr__body">
                                    <td class="td__body text-nowrap col" style="width:115px;">{{$lancamentotabela->liboletim}}</td>
                                    
                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$lancamentotabela->tomador->tsnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                        <a>{{$lancamentotabela->tomador->tsnome}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:200px">
                                        <?php
                                        $data = explode('-', $lancamentotabela->lsdata)
                                        ?>
                                        {{$data[2]}}/{{$data[1]}}/{{$data[0]}}
                                    </td>
    
                                    <td class="td__body text-nowrap col" style="width:200px">
                                        {{$lancamentotabela->lsnumero}}
                                    </td>
    
                                    <td class="td__body text-nowrap col" style="width:120px">
                                        {{$lancamentotabela->lsferiado}}
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="btn btn__relatorio modal-botao" href="{{route('cadastrocartaoponto.relatoriocartaoponto',[base64_encode($lancamentotabela->id),base64_encode($lancamentotabela->csdomingos)?$lancamentotabela->tomador->cartaoponto[0]->csdomingos:' ',$lancamentotabela->tomador->cartaoponto[0]->cssabados?base64_encode($lancamentotabela->tomador->cartaoponto[0]->cssabados):' ',$lancamentotabela->tomador->cartaoponto[0]->csdiasuteis?base64_encode($lancamentotabela->tomador->cartaoponto[0]->csdiasuteis):' ',base64_encode($lancamentotabela->lsdata),base64_encode($lancamentotabela->liboletim),base64_encode($lancamentotabela->tomador->id),base64_encode($lancamentotabela->lsferiado)])}}"><i class="icon__color fas fa-file-alt"></i></a>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <a class="btn btn__vizualizar" href="{{route('boletimcartaoponto.create',[base64_encode($lancamentotabela->id),base64_encode($lancamentotabela->csdomingos)?$lancamentotabela->tomador->cartaoponto[0]->csdomingos:' ',$lancamentotabela->tomador->cartaoponto[0]->cssabados?base64_encode($lancamentotabela->tomador->cartaoponto[0]->cssabados):' ',$lancamentotabela->tomador->cartaoponto[0]->csdiasuteis?base64_encode($lancamentotabela->tomador->cartaoponto[0]->csdiasuteis):' ',base64_encode($lancamentotabela->lsdata),base64_encode($lancamentotabela->liboletim),base64_encode($lancamentotabela->tomador->id),base64_encode($lancamentotabela->lsferiado)])}}"><i class="icon__color fad fa-eye"></i></a>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <button class="btn">
                                            <a class="button__editar btn modal-botao" href="{{route('cadastrocartaoponto.edit',$lancamentotabela->id)}}"><i class="icon__color fas fa-pen"></i></a>
                                        </button>
                                    </td>
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <form action="{{route('cadastrocartaoponto.destroy',$lancamentotabela->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="editar" value="1">
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
                                        {{$lancamentotabelas->links()}}
                                        <!--@if ($lancamentotabelas->lastPage() > 1)-->
                                        <!--<nav aria-label="Page navigation example">-->
                                        <!--    <ul class="pagination pagination__table pagination-sm">-->
    
                                        <!--    @for ($i = 1; $i <= $lancamentotabelas->lastPage(); $i++)-->
                                        <!--        <li class="page-item {{ ($lancamentotabelas->currentPage() == $i) ? ' active' : ''     }}">-->
                                        <!--            <a class="page-link modal-botao" href="{{ $lancamentotabelas->url($i) }}">{{ $i }}</a>-->
                                        <!--        </li>-->
                                        <!--        @endfor-->
    
                                        <!--    </ul>-->
                                        <!--</nav>-->
                                        <!--@endif-->
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