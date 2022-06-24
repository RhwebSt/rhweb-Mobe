<div class="modal fade" id="modalTomador" data-bs-backdrop="static1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header header__modal">
                <h5 class="modal-title" id="staticBackdropLabel1"><i class="fad fa-lg fa-industry"></i> Tomadores cadastrados</h5>
                <i class="fas fa-2x fa-times icon__exit--modal" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body body__modal">
                
                <section class="section__search d-none">
                    <div class="col-md-5">
                        <form action="{{route('tomador.novo')}}" method="GET">
                            
                            <div class="d-flex">
                                
                                <input placeholder="duplo clique para pesquisar" class="form-control" list="listapesquisa" name="search" id="pesquisa">
                                <datalist id="listapesquisa"></datalist>

                                <input type="hidden" name="codicao" value="{{isset($tomador->id)?$tomador->id:''}}">
                                
                                <button type="submit" class="btn botao__search modal-botao">
                                    <i class="icon__search fas fa-search fa-md" id="icon"></i>
                                    <i class="icon__search fad fa-spinner-third fa-spin fa-lg d-none" id="refres"></i>
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
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.tomador',['asc',isset($tomador->id)?$tomador->id:''])}}"><i class="fad fa-sort-amount-down-alt"></i> Ordem Crescente</a></li>
                                  <li><a class="dropdown-item dropdown__links--filter modal-botao" href="{{route('ordem.tomador',['desc',isset($tomador->id)?$tomador->id:''])}}"><i class="fad fa-sort-amount-down"></i> Ordem Decrescente</a></li>
                                </ul>
                              </div>
                        </div>

                    </div>
                </section>

                
                
            
                <section class="table">
                    <div class="table-responsive-xxl">
                       
                        <table class="table" id="tamodor-lista">
                            <thead class="tr__header">
                                <th class="th__header text-nowrap" style="width:80px;">Matrícula</th>
                                <th class="th__header text-nowrap">Tomador</th>
                                <th class="th__header text-nowrap" style="width:120px">CNPJ</th>
                                <th class="th__header text-nowrap" style="width:80px">Tab Preço</th>
                                <th class="th__header text-nowrap" style="width:60px">Relatórios</th>
                                <th class="th__header text-nowrap" style="width:60px">S-1020</th>
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
