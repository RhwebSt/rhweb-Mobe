<div class="modal fade" id="modalBoletimTabela" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-sack-dollar"></i> Lançamentos cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
                
                <section class="section__search d-none ">
                    <div class="col-md-5">
                        <form action="{{  route('boletim.tabela.create',[$quantidade,$boletim,$tomador,base64_encode($id),$data])}}" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="clique ou digite para pesquisar" class="form-control" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="{{isset($trabalhador)?$trabalhador:null}}">
                                
                                <button type="submit" class="btn botao__search  modal-botao">
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
                                    <li><a class="dropdown-item dropdown__links--filter  modal-botao" id="ordemCres" href="{{route('boletim.tabela.ordem',[$quantidade,$boletim,$tomador,base64_encode($id),isset($trabalhador)?base64_encode($trabalhador):' ',$data,'asc'])}}"><i class="fad fa-sort-amount-up-alt"></i> Ordem Crescente</a></li>
                                    <li><a class="dropdown-item dropdown__links--filter  modal-botao" href="{{route('boletim.tabela.ordem',[$quantidade,$boletim,$tomador,base64_encode($id),isset($trabalhador)?base64_encode($trabalhador):' ',$data,'desc'])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>
                            
                <section class="table">
                    <div class="table-responsive-xxl">
                       
                        <table class="table" id="boletim-tabela-lancamento">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap">Trabalhador</th>
                                <th class="th__header text-nowrap" style="width:70px">Cod</th>
                                <th class="th__header text-nowrap">Descrição</th>
                                <th class="th__header text-nowrap" style="width:100px">Quantidade</th>
                                <th class="th__header text-nowrap" style="width:170px">Valor Unitário</th>
                                <th class="th__header text-nowrap" style="width:170px">Total R$</th>
                                <th class="th__header text-nowrap" style="width:70px">Editar</th>
                                <th class="th__header text-nowrap" style="width:70px">Excluir</th>
                            </thead>
                        </table>
                    </div>
                </section>
                            
            </div>
        </div>
    </div>
</div>