<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1">Trabalhadores cadastrados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                        <form action="{{route('trabalhador.index')}}" method="GET">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa">
                                </datalist>
                                <input type="hidden" name="codicao" value="{{isset($trabalhador->id)?$trabalhador->id:''}}">
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
                              <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.trabalhador',['asc',isset($trabalhador->id)?$trabalhador->id:''])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                              <li><a class="dropdown-item dropdown__links--filter" href="{{route('ordem.trabalhador',['desc',isset($trabalhador->id)?$trabalhador->id:''])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                            </ul>
                          </div>
                    </div>

                </div>
            </section>
            
            
            <section class="table">
                <div class="table-responsive-xxl">
                    <table class="table">
                        <thead class="tr__header">
                            <th class="th__header text-nowrap" style="width:80px;">Matrícula</th>
                            <th class="th__header text-nowrap">Trabalhador</th>
                            <th class="th__header text-nowrap" style="width:200px">CPF</th>
                            <th class="th__header text-nowrap" style="width:120px">Depedentes</th>
                            <th class="th__header text-nowrap" style="width:60px">Relatórios</th>
                            <th class="th__header text-nowrap" style="width:60px">S-2300</th>
                            <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                            <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                        </thead>
                        <tbody class="table__body">
                            @if(count($trabalhadors) > 0)
                            @foreach($trabalhadors as $trabalhador)
                            <tr class="tr__body">
                                <td class="td__body text-nowrap col" style="width:80px;">{{$trabalhador->tsmatricula}}</td>
                                <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$trabalhador->tsnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis;">
                                        <a>{{$trabalhador->tsnome}}</a>
                                </td>
                                <td class="td__body text-nowrap col" style="width:200px">
                                    {{$trabalhador->tscpf}}
                                </td>
    
                                <td class="td__body text-nowrap col" style="width:120px">
                                    <a class="btn__depedente btn modal-botao" href="{{route('depedente.mostrar.index',base64_encode($trabalhador->id))}}" class=""><i class="icon__color fad fa-users"></i></a>
                                </td>
    
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    <div class="dropdown">
                                        <button class="btn btn__relatorio modal-botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="icon__color fas fa-file-alt"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li class=""><a class="dropdown-item text-decoration-none ps-2" href="{{route('ficha.registro.trabalhador',base64_encode($trabalhador->id))}}" id="imprimir" role="button">Ficha de Registro</a></li>
                                            <li class=""><a class="dropdown-item text-decoration-none ps-2" href="{{route('epi.show',base64_encode($trabalhador->id))}}" id="fichaepi" role="button">Ficha de EPI</a></li>
                                            <li class=""><a class="dropdown-item text-decoration-none ps-2" href="{{route('declaracao.afastamento.trabalhador',base64_encode($trabalhador->id))}}" id="declaracao__afas" role="button">Declaração de Afastamento</a></li>
                                            <li class=""><a class="dropdown-item text-decoration-none ps-2" href="{{route('declaracao.admissao.trabalhador',base64_encode($trabalhador->id))}}" id="declaracao__adm" role="button">Declaração de Admissão</a></li>
                                            <li class=""><a class="dropdown-item text-decoration-none ps-2" href="{{route('cracha.trabalhador',base64_encode($trabalhador->id))}}" id="cracha" role="button">Crachá</a></li>
                                            <li class=""><a class="dropdown-item text-decoration-none ps-2" href="{{route('devolucao.ctps.trabalhador',base64_encode($trabalhador->id))}}" id="devolucao__ctps" role="button">Devolução da CTPS</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    <a class="btn__evento btn modal-botao" data-id="{{base64_encode($trabalhador->id)}}" href="{{route('esocial.trabalhador',base64_encode($trabalhador->id))}}" class=""><i class="icon__color fas fa-file-invoice"></i></a>
                                </td>
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    <button class="btn">
                                        <a class="button__editar btn modal-botao" href="{{route('trabalhador.edit',base64_encode($trabalhador->id))}}" class=""><i class="icon__color fas fa-pen"></i></a>
                                    </button>
                                </td>
                                <td class="td__body text-nowrap col" style="width:60px;">
                                    <form action="{{route('trabalhador.destroy',$trabalhador->id)}}" method="post">
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
    
                                    @if ($trabalhadors->lastPage() > 1)
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination__table pagination-sm">
        
                                            @for ($i = 1; $i <= $trabalhadors->lastPage(); $i++)
                                                <li class="page-item {{ ($trabalhadors->currentPage() == $i) ? ' active' : ''     }}">
                                                    <a class="page-link modal-botao" href="{{ $trabalhadors->url($i) }}">{{ $i }}</a>
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