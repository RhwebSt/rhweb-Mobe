
<div class="modal fade" id="modalTabPreco" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fa-lg fad fa-sack-dollar"></i> Preços Cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search d-none">
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

                
                <section class="d-none">
                    <div class="d-flex justify-content-end">
                        <div>
                            <div class="dropdown">
                                <button class="btn button__filter dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fad fa-sort"></i>
                                </button>
                                <ul class="dropdown-menu dropdown__filtro" aria-labelledby="dropdownMenuButton2">
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao " href="{{route('ordem.tabela.preco',[base64_encode($id), base64_encode($tomador),'asc'])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.tabela.preco',[base64_encode($id), base64_encode($tomador),'desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                
                
                <section class="table">
                    <div class="table-responsive-xxl">
                       
                        <table class="table" id="tabelapreco-lista">
                                <thead class="tr__header">
                                    <th class="th__header text-nowrap" style="width:60px;">Ano</th>
                                    <th class="th__header text-nowrap">Código</th>
                                    <th class="th__header text-nowrap">Descrição</th>
                                    <th class="th__header text-nowrap" style="width:110px;">Valor Trab</th>
                                    <th class="th__header text-nowrap" style="width:110px;">Valor Tom</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Editar</th>
                                    <th class="th__header text-nowrap" style="width:60px;">Excluir</th>
                                </thead>
                        </table>
                    </div>
                </section>
            </div>
            
            <div class="modal-footer">
            </div>
            
        </div>
    </div>
</div>


