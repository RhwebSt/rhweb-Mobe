
<div class="modal fade" id="teste" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black fw-bold" id="staticBackdropLabel1">Tomadores cadastrados</h5>
                <button type="button" class="btn-close modalClose" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div class="col-md-5 mb-1 p-1 mt-2 pesquisar">
                        <form action="" method="GET">
                            <div class="d-flex">
                                <label for="exampleDataList" class="form-label"></label>
                                <input placeholder="pesquisar..." class="form-control fw-bold text-dark pesquisa text-uppercase" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa">
                                </datalist>
                                <input type="hidden" name="codicao" value="">
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
                                <th class="th__header text-nowrap" style="width:80px;">Matrícula</th>
                                <th class="th__header text-nowrap">Nome</th>
                                <th class="th__header text-nowrap">Descrição</th>
                                <th class="th__header text-nowrap" style="width:150px;">Quinzena</th>
                                <th class="th__header text-nowrap" style="width:150px;">Competência</th>
                                <th class="th__header text-nowrap" style="width:150px;">Valor</th>
                                <th class="th__header text-nowrap" style="width:60px;">Relatório</th>
                                <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                            </thead>
                                  
                            <tbody class="table__body">
                              @if(count($descontos) > 0)
                                @foreach($descontos as $desconto)
                                <tr class="tr__body">
                                    <td class="td__body text-nowrap col" style="width:80px;">{{$desconto->tsmatricula}}</td>
                                    
                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->tsnome}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                            <a>{{$desconto->tsnome}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$desconto->dsdescricao}}" style="max-width: 30ch; overflow: hidden; text-overflow: ellipsis; padding: 0 0; margin:0 0;">
                                            <a>{{$desconto->dsdescricao}}</a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:150px;">{{$desconto->dsquinzena}}</td>
                                    
                                    <td class="td__body text-nowrap col" style="width:150px;">
                                        <?php
                                            $data = explode('-',$desconto->dscompetencia);
                                        ?>
                                        {{$data[1]}}/{{$data[0]}}
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:150px;">{{number_format((float)$desconto->dfvalor, 2, ',', '')}}</td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <div class="dropdown">
                                            <button class="btn btn__relatorio modal-botao dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icon__color fas fa-file-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li class=""><a class="dropdown-item text-decoration-none ps-2 text-capitalize" onclick ="botaoModal()"  id="imprimir" role="button">Rol dos Descontos <i class="fas fa-file"></i></a></li>
                                                <li class=""><a class="dropdown-item text-decoration-none ps-2 text-capitalize"  id="imprimir" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Rol dos Descontos - Por trabalhador <i class="fas fa-file"></i></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                            <a class="button__editar btn" href="{{route('descontos.edit',base64_encode($desconto->id))}}" class=""><i style="color:white" class="fas fa-pen"></i></a>
                                    </td>
                                    
                                    <td class="td__body text-nowrap col" style="width:60px;">
                                        <form action="{{route('descontos.destroy',$desconto->id)}}" method="post">
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
                                    {{$descontos->links()}}
                                  </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </section>
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